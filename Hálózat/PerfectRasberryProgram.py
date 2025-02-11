#!/usr/bin/env python3
import argparse
import asyncio
import logging
import time
from datetime import datetime
from typing import Any, Dict, List, Optional, Tuple

from netmiko import ConnectHandler
from sense_hat import SenseHat

# Setup logging
logging.basicConfig(
    level=logging.INFO, format="%(asctime)s [%(levelname)s]: %(message)s"
)
logger = logging.getLogger(__name__)

# Global shutdown event
shutdown_event = asyncio.Event()

# Globals for joystick navigation and port mapping.
cursor_x: int = 0
cursor_y: int = 0
port_mapping: Dict[Tuple[int, int], str] = {}  # (col, row) -> port name
port_status_map: Dict[str, bool] = {}  # port name -> True if up, else False

# Global for LED display caching: store the last LED matrix so we update only changed pixels.
current_led_matrix: List[Tuple[int, int, int]] = [(0, 0, 0)] * 64

# Global objects for connection and Sense HAT.
pool: Optional["ConnectionPool"] = None
sense: Optional[SenseHat] = None

# Simple cache for command outputs.
cache: Dict[str, Tuple[float, str]] = {}


# --------------------------
# Connection Pool Class
# --------------------------
class ConnectionPool:
    def __init__(
        self, host: str, username: str, password: str, secret: str, retries: int = 3
    ) -> None:
        self.host = host
        self.username = username
        self.password = password
        self.secret = secret
        self.retries = retries
        self.conn: Optional[ConnectHandler] = None

    async def get(self) -> ConnectHandler:
        if self.conn is None:
            self.conn = await self._connect_with_retries()
        return self.conn

    async def _connect_with_retries(self) -> ConnectHandler:
        for attempt in range(1, self.retries + 1):
            conn = await asyncio.to_thread(
                connect_to_switch, self.host, self.username, self.password, self.secret
            )
            if conn is not None:
                return conn
            logger.error(f"Connection attempt {attempt} failed")
            await asyncio.sleep(2**attempt)
        raise Exception("Failed to connect after retries")

    async def disconnect(self) -> None:
        if self.conn is not None:
            await asyncio.to_thread(self.conn.disconnect)
            self.conn = None


# --------------------------
# Blocking Functions (run in threads)
# --------------------------
def connect_to_switch(
    host: str, username: str, password: str, secret: str
) -> Optional[ConnectHandler]:
    """
    Establish a connection to the Cisco switch.
    """
    device = {
        "device_type": "cisco_ios",
        "host": host,
        "username": username,
        "password": password,
        "secret": secret,
        "port": 22,
        "fast_cli": False,
    }
    try:
        logger.info(f"Connecting to switch {host}...")
        net_connect = ConnectHandler(**device)
        net_connect.enable()
        return net_connect
    except Exception as e:
        logger.error(f"Connection error: {e}")
        return None


def get_connected_port(net_connect: ConnectHandler) -> Optional[str]:
    """
    Identify the port that the Raspberry Pi is using.
    """
    try:
        show_ip_output = net_connect.send_command("show ip interface brief")
        iface_output = net_connect.send_command("show interfaces status")
        for line in iface_output.splitlines():
            if "connected" in line.lower():
                port = line.split()[0]
                if port.startswith("Fa"):
                    port = port.replace("Fa", "FastEthernet")
                elif port.startswith("Gi"):
                    port = port.replace("Gi", "GigabitEthernet")
                if port in show_ip_output and "up" in show_ip_output:
                    logger.info(f"Raspberry Pi detected on port: {port}")
                    return port
        logger.warning("Could not detect Raspberry Pi port")
        return None
    except Exception as e:
        logger.error(f"Error detecting connected port: {e}")
        return None


def manage_ports(
    net_connect: ConnectHandler, ports: List[str], action: str, pi_port: Optional[str]
) -> None:
    """
    Enable or disable a list of ports while skipping the Raspberry Pi port.
    """
    try:
        logger.info(f"{'Disabling' if action == 'disable' else 'Enabling'} ports...")
        cmd = "shutdown" if action == "disable" else "no shutdown"
        desc = "DISABLED_PORT" if action == "disable" else "ENABLED_PORT"
        for port in ports:
            if pi_port and port.strip() == pi_port.strip():
                logger.info(f"Skipping local port: {port}")
                continue
            cmds = [f"interface {port}", cmd, f"description {desc}"]
            net_connect.send_config_set(cmds)
            logger.info(f"Port {port} {action}d")
        net_connect.save_config()
        logger.info("Configuration saved")
    except Exception as e:
        logger.error(f"Error {action}ing ports: {e}")


def manage_all_ports(
    net_connect: ConnectHandler, action: str, pi_port: Optional[str]
) -> None:
    """
    Retrieve all ports and apply an action.
    """
    try:
        output = net_connect.send_command("show interfaces status")
        ports = [
            line.split()[0]
            .replace("Fa", "FastEthernet")
            .replace("Gi", "GigabitEthernet")
            for line in output.splitlines()
            if ("Fa" in line or "Gi" in line)
        ]
        if ports:
            manage_ports(net_connect, ports, action, pi_port)
        else:
            logger.warning("No ports found")
    except Exception as e:
        logger.error(f"Error managing all ports: {e}")


def toggle_port_state(net_connect: ConnectHandler, port: str, action: str) -> None:
    """
    Toggle the state of a single port.
    If action is "up", send 'no shutdown'; if "down", send 'shutdown'.
    """
    try:
        if action == "up":
            cmd = "no shutdown"
            desc = "ENABLED_PORT"
        else:
            cmd = "shutdown"
            desc = "DISABLED_PORT"
        cmds = [f"interface {port}", cmd, f"description {desc}"]
        net_connect.send_config_set(cmds)
        net_connect.save_config()
        logger.info(f"Port {port} set to {'enabled' if action == 'up' else 'disabled'}")
    except Exception as e:
        logger.error(f"Error toggling port {port}: {e}")


def get_port_lists(net_connect: ConnectHandler) -> Tuple[List[str], List[str]]:
    """
    Extract lists of fast and gigabit ports from the switch.
    """
    output = net_connect.send_command("show interfaces status")
    fast_ports: List[str] = []
    giga_ports: List[str] = []
    for line in output.splitlines():
        if "FastEthernet" in line:
            port = line.split()[0].replace("Fa", "FastEthernet")
            fast_ports.append(port)
        elif "GigabitEthernet" in line:
            port = line.split()[0].replace("Gi", "GigabitEthernet")
            giga_ports.append(port)
    return fast_ports, giga_ports


# --------------------------
# Caching helper
# --------------------------
async def get_cached_command(
    pool: ConnectionPool, command: str, ttl: float = 5.0
) -> str:
    """Return cached output if recent enough."""
    now = time.time()
    if command in cache and (now - cache[command][0]) < ttl:
        return cache[command][1]
    conn = await pool.get()
    result = await asyncio.to_thread(conn.send_command, command)
    cache[command] = (now, result)
    return result


# --------------------------
# LED Matrix and Joystick Functions
# --------------------------
# Color Definitions
GREEN_COLOR: Tuple[int, int, int] = (0, 255, 0)  # Port enabled/up
RED_COLOR: Tuple[int, int, int] = (255, 0, 0)  # Port disabled/down
BLUE_COLOR: Tuple[int, int, int] = (0, 0, 255)  # Static/separator rows
OFF_COLOR: Tuple[int, int, int] = (0, 0, 0)
YELLOW_COLOR: Tuple[int, int, int] = (255, 255, 0)
WHITE_COLOR: Tuple[int, int, int] = (255, 255, 255)  # Cursor overlay


def create_infinite_scroll(offset: int) -> List[Tuple[int, int, int]]:
    """
    Generate a scrolling animation using an Among Us character.
    """
    among_us_character: List[List[int]] = [
        [0, 0, 0, 1, 1, 1, 0, 0],
        [0, 0, 1, 1, 2, 2, 2, 0],
        [0, 1, 1, 2, 2, 2, 2, 2],
        [0, 1, 1, 1, 2, 2, 2, 0],
        [0, 1, 1, 1, 1, 1, 1, 0],
        [0, 1, 1, 1, 1, 1, 1, 0],
        [0, 0, 1, 1, 1, 1, 1, 0],
        [0, 0, 1, 1, 0, 1, 1, 0],
    ]
    among_us_colors: Dict[int, Tuple[int, int, int]] = {
        0: YELLOW_COLOR,
        1: RED_COLOR,
        2: WHITE_COLOR,
    }
    character_width = 8
    return [
        among_us_colors[among_us_character[row][(col - offset) % character_width]]
        for row in range(8)
        for col in range(8)
    ]


def parse_interface_status(status_output: str) -> Tuple[List[bool], List[bool]]:
    """
    Extract port up/down status from the output.
    """
    fast_eth: List[bool] = []
    giga_eth: List[bool] = []
    for line in status_output.splitlines():
        if "FastEthernet" in line:
            parts = line.split()
            if len(parts) >= 5:
                fast_eth.append("up" in parts[4].lower())
        elif "GigabitEthernet" in line:
            parts = line.split()
            if len(parts) >= 5:
                giga_eth.append("up" in parts[4].lower())
    return fast_eth, giga_eth


def update_led_matrix(
    sense: SenseHat,
    fast_eth: List[bool],
    giga_eth: List[bool],
    fast_ports: List[str],
    giga_ports: List[str],
) -> List[Tuple[int, int, int]]:
    """
    Build the LED matrix based on port statuses.
    Also populate the global port_mapping and port_status_map.
    Fast Ethernet ports are on rows 1, 3, 5; Gigabit on row 7.
    """
    global port_mapping, port_status_map
    port_mapping.clear()
    port_status_map.clear()
    pixels: List[Tuple[int, int, int]] = []
    fe_index = 0
    giga_index = 0
    for row in range(8):
        for col in range(8):
            if row in {0, 2, 4}:
                pixels.append(BLUE_COLOR)
            elif row in {1, 3, 5}:
                if fe_index < len(fast_eth):
                    state = fast_eth[fe_index]
                    color = GREEN_COLOR if state else RED_COLOR
                    pixels.append(color)
                    port = fast_ports[fe_index]
                    port_mapping[(col, row)] = port
                    port_status_map[port] = state
                    fe_index += 1
                else:
                    pixels.append(OFF_COLOR)
            elif row == 6:
                pixels.append(BLUE_COLOR)
            elif row == 7:
                if giga_index < len(giga_eth):
                    state = giga_eth[giga_index]
                    color = GREEN_COLOR if state else RED_COLOR
                    pixels.append(color)
                    port = giga_ports[giga_index]
                    port_mapping[(col, row)] = port
                    port_status_map[port] = state
                    giga_index += 1
                else:
                    pixels.append(OFF_COLOR)
    return pixels


def draw_cursor(
    pixels: List[Tuple[int, int, int]], cx: int, cy: int
) -> List[Tuple[int, int, int]]:
    """
    Overlay a white pixel (cursor) on the LED matrix.
    """
    new_pixels = pixels.copy()
    index = cy * 8 + cx
    if 0 <= index < len(new_pixels):
        new_pixels[index] = WHITE_COLOR
    return new_pixels


async def update_led_matrix_pixels(
    sense: SenseHat, new_pixels: List[Tuple[int, int, int]]
) -> None:
    """
    Efficiently update the Sense HAT LED matrix by only changing altered pixels.
    """
    global current_led_matrix
    # If no previous state, set entire display.
    if not current_led_matrix or len(current_led_matrix) != 64:
        current_led_matrix = new_pixels.copy()
        await asyncio.to_thread(sense.set_pixels, new_pixels)
        return

    changes = []
    for idx, (old, new) in enumerate(zip(current_led_matrix, new_pixels)):
        if old != new:
            x = idx % 8
            y = idx // 8
            changes.append((x, y, new))
    if changes:
        # If many changes, update whole display.
        if len(changes) > 32:
            current_led_matrix = new_pixels.copy()
            await asyncio.to_thread(sense.set_pixels, new_pixels)
        else:
            for x, y, color in changes:
                await asyncio.to_thread(sense.set_pixel, x, y, color)
                current_led_matrix[y * 8 + x] = color


def joystick_callback(event: Any) -> None:
    """
    Handle joystick events:
    - Arrow keys update the global cursor position.
    - Middle press toggles the port state at the current cell.
    """
    global cursor_x, cursor_y, switch_conn
    if event.action != "pressed":
        return

    if event.direction == "middle":
        port = port_mapping.get((cursor_x, cursor_y))
        if port and switch_conn:
            current_state = port_status_map.get(port, True)
            if current_state:
                logger.info(f"Toggling port {port}: Disabling")
                toggle_port_state(switch_conn, port, "down")
            else:
                logger.info(f"Toggling port {port}: Enabling")
                toggle_port_state(switch_conn, port, "up")
        else:
            logger.info(f"No port assigned to cell ({cursor_x}, {cursor_y})")
    elif event.direction == "up":
        if cursor_y > 0:
            cursor_y -= 1
    elif event.direction == "down":
        if cursor_y < 7:
            cursor_y += 1
    elif event.direction == "left":
        if cursor_x > 0:
            cursor_x -= 1
    elif event.direction == "right":
        if cursor_x < 7:
            cursor_x += 1

    logger.info(f"Cursor moved to ({cursor_x}, {cursor_y})")


# --------------------------
# Async Monitor Loop
# --------------------------
async def monitor_loop(pool: ConnectionPool, low_light: bool) -> None:
    """
    Continuously monitor the switch, update the LED matrix, and handle joystick events.
    """
    global switch_conn, sense, cursor_x, cursor_y
    conn = await pool.get()
    switch_conn = conn
    # Initialize Sense HAT
    global sense
    sense = SenseHat()
    sense.low_light = low_light
    sense.clear()
    sense.stick.direction_any = joystick_callback

    last_change = datetime.now()
    previous_status: Optional[Tuple[List[bool], List[bool]]] = None
    animation_mode = False
    animation_offset = 0

    while not shutdown_event.is_set():
        try:
            status_output = await get_cached_command(
                pool, "show ip interface brief", ttl=5.0
            )
        except Exception as e:
            logger.error(f"Failed to get interface status: {e}")
            await asyncio.sleep(5)
            continue

        fast_eth, giga_eth = parse_interface_status(status_output)
        fast_ports, giga_ports = get_port_lists(conn)
        current_status = (fast_eth, giga_eth)
        if current_status != previous_status:
            last_change = datetime.now()
            animation_mode = False
            new_pixels = update_led_matrix(
                sense, fast_eth, giga_eth, fast_ports, giga_ports
            )
            logger.info("Display updated with new status")
        else:
            elapsed = (datetime.now() - last_change).total_seconds()
            if elapsed >= 60 and not animation_mode:
                animation_mode = True
                logger.info("Switching to animation mode")
            if animation_mode:
                new_pixels = create_infinite_scroll(animation_offset)
                animation_offset = (animation_offset + 1) % 8
                await asyncio.sleep(0.1)
                previous_status = current_status
                new_pixels = draw_cursor(new_pixels, cursor_x, cursor_y)
                await update_led_matrix_pixels(sense, new_pixels)
                continue
            else:
                new_pixels = update_led_matrix(
                    sense, fast_eth, giga_eth, fast_ports, giga_ports
                )
        previous_status = current_status

        new_pixels = draw_cursor(new_pixels, cursor_x, cursor_y)
        await update_led_matrix_pixels(sense, new_pixels)
        await asyncio.sleep(1)

    await pool.disconnect()
    await asyncio.to_thread(sense.clear)
    logger.info("Monitor loop terminated.")


# --------------------------
# Async Port Management Loop
# --------------------------
async def port_management_loop(pool: ConnectionPool) -> None:
    """
    Async interactive loop for port management via console.
    """
    conn = await pool.get()
    pi_port = get_connected_port(conn)
    while not shutdown_event.is_set():
        print("\nPort Management Options:")
        print("1. Disable specific ports")
        print("2. Enable specific ports")
        print("3. Disable port range")
        print("4. Enable port range")
        print("5. Disable ALL ports")
        print("6. Enable ALL ports")
        print("7. Exit")
        try:
            choice = (
                await asyncio.to_thread(input, "\nEnter your choice (1-7): ")
            ).strip()
        except EOFError:
            shutdown_event.set()
            break

        if choice in {"1", "2"}:
            ports_line = await asyncio.to_thread(
                input,
                "Enter ports (comma-separated, e.g., FastEthernet0/1,FastEthernet0/2): ",
            )
            ports = [p.strip() for p in ports_line.split(",")]
            action = "disable" if choice == "1" else "enable"
            try:
                await asyncio.to_thread(manage_ports, conn, ports, action, pi_port)
            except Exception as e:
                logger.error(f"Error in port management: {e}")
        elif choice in {"3", "4"}:
            start = (
                await asyncio.to_thread(
                    input, "Enter starting port number (e.g., 1 for FastEthernet0/1): "
                )
            ).strip()
            end = (await asyncio.to_thread(input, "Enter ending port number: ")).strip()
            port_type = (
                await asyncio.to_thread(
                    input,
                    "Enter port type (1 for FastEthernet, 2 for GigabitEthernet): ",
                )
            ).strip()
            prefix = "FastEthernet0/" if port_type == "1" else "GigabitEthernet0/"
            ports = [f"{prefix}{i}" for i in range(int(start), int(end) + 1)]
            action = "disable" if choice == "3" else "enable"
            try:
                await asyncio.to_thread(manage_ports, conn, ports, action, pi_port)
            except Exception as e:
                logger.error(f"Error in port management: {e}")
        elif choice in {"5", "6"}:
            action = "disable" if choice == "5" else "enable"
            confirm = (
                (
                    await asyncio.to_thread(
                        input, f"Confirm {action} ALL ports? (yes/no): "
                    )
                )
                .strip()
                .lower()
            )
            if confirm == "yes":
                try:
                    await asyncio.to_thread(manage_all_ports, conn, action, pi_port)
                except Exception as e:
                    logger.error(f"Error in managing all ports: {e}")
            else:
                logger.info("Operation cancelled")
        elif choice == "7":
            logger.info("Exiting port management...")
            shutdown_event.set()
            break
        else:
            logger.info("Invalid option, please try again.")
    await asyncio.to_thread(conn.disconnect)
    logger.info("Port management loop terminated.")


# --------------------------
# Main Routine
# --------------------------
async def main() -> None:
    parser = argparse.ArgumentParser(
        description="Cisco Switch Manager with Sense HAT Display and Joystick Port Control"
    )
    parser.add_argument("--host", default="192.168.1.4", help="Switch IP address")
    parser.add_argument("--username", default="admin", help="Username for the switch")
    parser.add_argument("--password", default="admin", help="Password for the switch")
    parser.add_argument(
        "--secret", default="cisco", help="Enable secret for the switch"
    )
    # By default, low light mode is enabled; use --no_low_light to disable it.
    parser.add_argument(
        "--no_low_light",
        action="store_false",
        dest="low_light",
        help="Disable low light mode for the Sense HAT",
    )
    parser.set_defaults(low_light=True)
    args = parser.parse_args()

    switch_params: Dict[str, str] = {
        "host": args.host,
        "username": args.username,
        "password": args.password,
        "secret": args.secret,
    }
    global pool
    pool = ConnectionPool(**switch_params)

    monitor_task = asyncio.create_task(monitor_loop(pool, args.low_light))
    port_task = asyncio.create_task(port_management_loop(pool))

    await asyncio.gather(monitor_task, port_task)
    logger.info("Exiting main program.")


if __name__ == "__main__":
    try:
        asyncio.run(main())
    except KeyboardInterrupt:
        logger.info("KeyboardInterrupt received; shutting down.")

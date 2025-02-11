#!/usr/bin/env python3
import argparse
import logging
import threading
import time
from datetime import datetime
from netmiko import ConnectHandler
from sense_hat import SenseHat

# Setup logging
logging.basicConfig(
    level=logging.INFO, format="%(asctime)s [%(levelname)s]: %(message)s"
)
logger = logging.getLogger(__name__)

# Global shutdown event
shutdown_event = threading.Event()

# Globals for joystick navigation and port mapping.
cursor_x = 0
cursor_y = 0
port_mapping = {}  # Maps (col, row) -> port name
port_status_map = {}  # Maps port name -> boolean state (True if port is up)

# Globals for switch connection and Sense HAT
switch_conn = None
sense = None


# --------------------------
# Connection Management
# --------------------------
def connect_to_switch(
    host: str, username: str, password: str, secret: str
) -> ConnectHandler:
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
        logger.info("Connecting to switch %s...", host)
        net_connect = ConnectHandler(**device)
        net_connect.enable()
        return net_connect
    except Exception as e:
        logger.error("Connection error: %s", e)
        return None


# --------------------------
# Port Management Functions
# --------------------------
def get_connected_port(net_connect: ConnectHandler) -> str:
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
                    logger.info("Raspberry Pi detected on port: %s", port)
                    return port
        logger.warning("Could not detect Raspberry Pi port")
        return None
    except Exception as e:
        logger.error("Error detecting connected port: %s", e)
        return None


def manage_ports(net_connect: ConnectHandler, ports: list, action: str, pi_port: str):
    """
    Enable or disable a list of ports while skipping the Raspberry Pi port.
    """
    try:
        logger.info("%s ports...", "Disabling" if action == "disable" else "Enabling")
        cmd = "shutdown" if action == "disable" else "no shutdown"
        desc = "DISABLED_PORT" if action == "disable" else "ENABLED_PORT"
        for port in ports:
            if pi_port and port.strip() == pi_port.strip():
                logger.info("Skipping local port: %s", port)
                continue
            cmds = [f"interface {port}", cmd, f"description {desc}"]
            net_connect.send_config_set(cmds)
            logger.info("Port %s %sd", port, action)
        net_connect.save_config()
        logger.info("Configuration saved")
    except Exception as e:
        logger.error("Error %sing ports: %s", action, e)


def manage_all_ports(net_connect: ConnectHandler, action: str, pi_port: str):
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
        logger.error("Error managing all ports: %s", e)


def toggle_port_state(net_connect: ConnectHandler, port: str, action: str):
    """
    Toggle the state of a single port.
    If action is "up", send 'no shutdown' (enable the port);
    if "down", send 'shutdown' (disable the port).
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
        logger.info(
            "Port %s set to %s", port, "enabled" if action == "up" else "disabled"
        )
    except Exception as e:
        logger.error("Error toggling port %s: %s", port, e)


def get_port_lists(net_connect: ConnectHandler):
    """
    Extract lists of fast and gigabit ports from the switch.
    """
    output = net_connect.send_command("show interfaces status")
    fast_ports = []
    giga_ports = []
    for line in output.splitlines():
        if "FastEthernet" in line:
            port = line.split()[0].replace("Fa", "FastEthernet")
            fast_ports.append(port)
        elif "GigabitEthernet" in line:
            port = line.split()[0].replace("Gi", "GigabitEthernet")
            giga_ports.append(port)
    return fast_ports, giga_ports


def port_management_loop(switch_params: dict):
    """
    Interactive loop for managing ports via the console.
    """
    net_connect = connect_to_switch(**switch_params)
    if net_connect is None:
        return

    pi_port = get_connected_port(net_connect)

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
            choice = input("\nEnter your choice (1-7): ").strip()
        except EOFError:
            shutdown_event.set()
            break

        if choice in {"1", "2"}:
            ports = input(
                "Enter ports (comma-separated, e.g., FastEthernet0/1,FastEthernet0/2): "
            ).split(",")
            action = "disable" if choice == "1" else "enable"
            manage_ports(net_connect, ports, action, pi_port)
        elif choice in {"3", "4"}:
            start = input(
                "Enter starting port number (e.g., 1 for FastEthernet0/1): "
            ).strip()
            end = input("Enter ending port number: ").strip()
            port_type = input(
                "Enter port type (1 for FastEthernet, 2 for GigabitEthernet): "
            ).strip()
            prefix = "FastEthernet0/" if port_type == "1" else "GigabitEthernet0/"
            ports = [f"{prefix}{i}" for i in range(int(start), int(end) + 1)]
            action = "disable" if choice == "3" else "enable"
            manage_ports(net_connect, ports, action, pi_port)
        elif choice in {"5", "6"}:
            action = "disable" if choice == "5" else "enable"
            confirm = input(f"Confirm {action} ALL ports? (yes/no): ").strip().lower()
            if confirm == "yes":
                manage_all_ports(net_connect, action, pi_port)
            else:
                logger.info("Operation cancelled")
        elif choice == "7":
            logger.info("Exiting port management...")
            shutdown_event.set()
            break
        else:
            logger.info("Invalid option, please try again.")
    net_connect.disconnect()
    logger.info("Port management loop terminated.")


# --------------------------
# Sense HAT Display & Joystick Functions
# --------------------------
# Color Definitions
GREEN = (0, 255, 0)  # Port enabled/up
RED = (255, 0, 0)  # Port disabled/down
BLUE = (0, 0, 255)  # Static/separator rows
OFF = (0, 0, 0)
YELLOW = (255, 255, 0)
WHITE = (255, 255, 255)  # Used for cursor overlay


def create_infinite_scroll(offset: int) -> list:
    """
    Generate a simple scrolling animation using an Among Us character.
    """
    among_us_character = [
        [0, 0, 0, 1, 1, 1, 0, 0],
        [0, 0, 1, 1, 2, 2, 2, 0],
        [0, 1, 1, 2, 2, 2, 2, 2],
        [0, 1, 1, 1, 2, 2, 2, 0],
        [0, 1, 1, 1, 1, 1, 1, 0],
        [0, 1, 1, 1, 1, 1, 1, 0],
        [0, 0, 1, 1, 1, 1, 1, 0],
        [0, 0, 1, 1, 0, 1, 1, 0],
    ]
    among_us_colors = {0: YELLOW, 1: RED, 2: WHITE}
    character_width = 8
    return [
        among_us_colors[among_us_character[row][(col - offset) % character_width]]
        for row in range(8)
        for col in range(8)
    ]


def parse_interface_status(status_output: str):
    """
    Extract boolean status (up/down) for FastEthernet and GigabitEthernet ports.
    """
    fast_eth = []
    giga_eth = []
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
    sense: SenseHat, fast_eth: list, giga_eth: list, fast_ports: list, giga_ports: list
) -> list:
    """
    Build the LED matrix based on current port statuses.
    Also populate the global port_mapping and port_status_map.
    Fast Ethernet ports are displayed on rows 1, 3, 5 and Gigabit Ethernet on row 7.
    """
    global port_mapping, port_status_map
    port_mapping.clear()
    port_status_map.clear()
    pixels = []
    fe_index = 0
    giga_index = 0
    for row in range(8):
        for col in range(8):
            if row in {0, 2, 4}:
                # Static indicator row
                pixels.append(BLUE)
            elif row in {1, 3, 5}:
                if fe_index < len(fast_eth):
                    state = fast_eth[fe_index]
                    color = GREEN if state else RED
                    pixels.append(color)
                    port = fast_ports[fe_index]
                    port_mapping[(col, row)] = port
                    port_status_map[port] = state
                    fe_index += 1
                else:
                    pixels.append(OFF)
            elif row == 6:
                pixels.append(BLUE)
            elif row == 7:
                if giga_index < len(giga_eth):
                    state = giga_eth[giga_index]
                    color = GREEN if state else RED
                    pixels.append(color)
                    port = giga_ports[giga_index]
                    port_mapping[(col, row)] = port
                    port_status_map[port] = state
                    giga_index += 1
                else:
                    pixels.append(OFF)
    return pixels


def draw_cursor(pixels: list, cx: int, cy: int) -> list:
    """
    Overlay a white pixel (cursor) on the LED matrix.
    """
    new_pixels = pixels.copy()
    index = cy * 8 + cx
    if 0 <= index < len(new_pixels):
        new_pixels[index] = WHITE
    return new_pixels


def joystick_callback(event):
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
            current_state = port_status_map.get(
                port, True
            )  # Default to 'up' if not mapped
            if current_state:
                logger.info("Toggling port %s: Disabling", port)
                toggle_port_state(switch_conn, port, "down")
            else:
                logger.info("Toggling port %s: Enabling", port)
                toggle_port_state(switch_conn, port, "up")
        else:
            logger.info("No port assigned to cell (%d, %d)", cursor_x, cursor_y)
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

    logger.info("Cursor moved to (%d, %d)", cursor_x, cursor_y)


def monitor_loop(switch_params: dict, low_light: bool):
    """
    Continuously monitor the switch, updating the Sense HAT LED matrix
    and handling joystick events.
    """
    global switch_conn, sense, cursor_x, cursor_y
    net_connect = connect_to_switch(**switch_params)
    if not net_connect:
        return
    switch_conn = net_connect
    sense = SenseHat()
    sense.low_light = low_light
    sense.clear()
    sense.stick.direction_any = joystick_callback

    last_change = datetime.now()
    previous_status = None
    animation_mode = False
    animation_offset = 0

    while not shutdown_event.is_set():
        status_output = net_connect.send_command("show ip interface brief")
        if status_output:
            fast_eth, giga_eth = parse_interface_status(status_output)
            fast_ports, giga_ports = get_port_lists(net_connect)
            current_status = (fast_eth, giga_eth)
            if current_status != previous_status:
                last_change = datetime.now()
                animation_mode = False
                pixels = update_led_matrix(
                    sense, fast_eth, giga_eth, fast_ports, giga_ports
                )
                logger.info("Display updated with new status")
            else:
                elapsed = (datetime.now() - last_change).total_seconds()
                if elapsed >= 60 and not animation_mode:
                    animation_mode = True
                    logger.info("Switching to animation mode")
                if animation_mode:
                    # Use a scrolling animation if no change detected
                    pixels = create_infinite_scroll(animation_offset)
                    animation_offset = (animation_offset + 1) % 8
                    time.sleep(0.1)
                    previous_status = current_status
                    # Overlay cursor and update display before next iteration
                    pixels = draw_cursor(pixels, cursor_x, cursor_y)
                    sense.set_pixels(pixels)
                    continue
                else:
                    pixels = update_led_matrix(
                        sense, fast_eth, giga_eth, fast_ports, giga_ports
                    )
            previous_status = current_status

            # Overlay cursor on current LED matrix and display
            pixels_with_cursor = draw_cursor(pixels, cursor_x, cursor_y)
            sense.set_pixels(pixels_with_cursor)
            time.sleep(1)
        else:
            time.sleep(5)
    net_connect.disconnect()
    sense.clear()
    logger.info("Monitor loop terminated.")


# --------------------------
# Main Routine
# --------------------------
def main():
    parser = argparse.ArgumentParser(
        description="Cisco Switch Manager with Sense HAT Display and Joystick Port Control"
    )
    parser.add_argument("--host", default="192.168.1.4", help="Switch IP address")
    parser.add_argument("--username", default="admin", help="Username for the switch")
    parser.add_argument("--password", default="admin", help="Password for the switch")
    parser.add_argument(
        "--secret", default="cisco", help="Enable secret for the switch"
    )
    # Use --no_low_light to disable LED dimming; by default, low light is enabled.
    parser.add_argument(
        "--no_low_light",
        action="store_false",
        dest="low_light",
        help="Disable low light mode for the Sense HAT",
    )
    parser.set_defaults(low_light=True)
    args = parser.parse_args()

    switch_params = {
        "host": args.host,
        "username": args.username,
        "password": args.password,
        "secret": args.secret,
    }

    # Start both the interactive console port management loop and the continuously running monitor loop.
    port_thread = threading.Thread(
        target=port_management_loop, args=(switch_params,), daemon=True
    )
    monitor_thread = threading.Thread(
        target=monitor_loop, args=(switch_params, args.low_light), daemon=True
    )

    port_thread.start()
    monitor_thread.start()

    try:
        while port_thread.is_alive() or monitor_thread.is_alive():
            time.sleep(1)
    except KeyboardInterrupt:
        logger.info("KeyboardInterrupt received; initiating shutdown.")
        shutdown_event.set()

    port_thread.join()
    monitor_thread.join()
    logger.info("Exiting main program.")


if __name__ == "__main__":
    main()

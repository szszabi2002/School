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
    Identify the port used by the Raspberry Pi.
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
    Retrieve all port names from the switch and apply the action.
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


def port_management_loop(switch_params: dict):
    """
    Interactive loop for port management.
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
    logger.info("Port management terminated.")


# --------------------------
# Sense HAT Display Functions
# --------------------------
# Define LED color constants
GREEN = (0, 255, 0)
RED = (255, 0, 0)
BLUE = (0, 0, 255)
OFF = (0, 0, 0)
YELLOW = (255, 255, 0)
WHITE = (255, 255, 255)

# Define an 8x8 Among Us character (values represent colors)
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


def create_infinite_scroll(offset: int) -> list:
    """
    Compute the LED matrix based on an offset for scrolling animation.
    """
    character_width = 8
    return [
        among_us_colors[among_us_character[row][(col - offset) % character_width]]
        for row in range(8)
        for col in range(8)
    ]


def get_interface_status(net_connect: ConnectHandler) -> str:
    """
    Retrieve the interface status via a Netmiko command.
    """
    try:
        return net_connect.send_command("show ip interface brief")
    except Exception as e:
        logger.error("Error retrieving interface status: %s", e)
        return None


def parse_interface_status(status_output: str):
    """
    Parse interface status to extract the up/down state of ports.
    """
    fast_ethernet = []
    gigabit_ethernet = []
    for line in status_output.splitlines():
        if "FastEthernet" in line:
            parts = line.split()
            if len(parts) >= 5:
                fast_ethernet.append("up" in parts[4].lower())
        elif "GigabitEthernet" in line:
            parts = line.split()
            if len(parts) >= 5:
                gigabit_ethernet.append("up" in parts[4].lower())
    return fast_ethernet, gigabit_ethernet


def update_led_matrix(sense: SenseHat, fast_eth: list, giga_eth: list):
    """
    Update the Sense HAT LED matrix based on the current interface statuses.
    """
    pixels = []
    fe_index = ge_index = gehe_index = 0
    for row in range(8):
        for col in range(8):
            if row in {0, 2, 4}:
                pixels.append(BLUE)
            elif row in {1, 3, 5}:
                if fe_index < len(fast_eth):
                    pixels.append(GREEN if fast_eth[fe_index] else RED)
                    fe_index += 1
                else:
                    pixels.append(OFF)
            elif row == 6:
                if gehe_index < len(giga_eth):
                    pixels.append(YELLOW)
                    gehe_index += 1
                else:
                    pixels.append(OFF)
            elif row == 7:
                if ge_index < len(giga_eth):
                    pixels.append(GREEN if giga_eth[ge_index] else RED)
                    ge_index += 1
                else:
                    pixels.append(OFF)
    sense.set_pixels(pixels)


def joystick_callback(event):
    """
    Handle joystick events on the Sense HAT.
    """
    if event.action == "pressed":
        logger.info("Joystick %s pressed", event.direction)
        # Extend functionality as needed


def monitor_loop(switch_params: dict, low_light: bool):
    """
    Continuously monitor the switch and update the Sense HAT display.
    """
    net_connect = connect_to_switch(**switch_params)
    if not net_connect:
        return
    sense = SenseHat()
    # Set low light mode to reduce LED brightness
    sense.low_light = low_light
    sense.clear()
    sense.stick.direction_any = joystick_callback

    last_change = datetime.now()
    previous_status = None
    animation_mode = False
    animation_offset = 0

    while not shutdown_event.is_set():
        status_output = get_interface_status(net_connect)
        if status_output:
            current_fe, current_ge = parse_interface_status(status_output)
            current_status = (current_fe, current_ge)
            if current_status != previous_status:
                last_change = datetime.now()
                animation_mode = False
                update_led_matrix(sense, current_fe, current_ge)
                logger.info("Display updated with new status")
            else:
                elapsed = (datetime.now() - last_change).total_seconds()
                if elapsed >= 60 and not animation_mode:
                    animation_mode = True
                    logger.info("Switching to animation mode")
                if animation_mode:
                    sense.set_pixels(create_infinite_scroll(animation_offset))
                    animation_offset = (animation_offset + 1) % 8
                    time.sleep(0.1)
                    continue
                else:
                    update_led_matrix(sense, current_fe, current_ge)
                    time.sleep(5)
            previous_status = current_status
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
        description="Refactored Cisco Switch Manager with Sense HAT Display"
    )
    parser.add_argument("--host", default="192.168.1.4", help="Switch IP address")
    parser.add_argument("--username", default="admin", help="Username for the switch")
    parser.add_argument("--password", default="admin", help="Password for the switch")
    parser.add_argument(
        "--secret", default="cisco", help="Enable secret for the switch"
    )
    # Use --no_low_light to disable low light mode; by default, low light is enabled.
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

    # Start the port management and monitor loops in separate threads.
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

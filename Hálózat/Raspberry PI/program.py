from nornir import InitNornir
from nornir_netmiko import netmiko_send_command, netmiko_send_config
from nornir_utils.plugins.functions import print_result
from sense_hat import SenseHat
import time
from datetime import datetime
import multiprocessing

# Initialize SenseHat
sense = SenseHat()
sense.clear()

# Define colors
GREEN = (0, 255, 0)
RED = (255, 0, 0)
BLUE = (0, 0, 255)
OFF = (0, 0, 0)
YELLOW = (255, 255, 0)
WHITE = (255, 255, 255)

# Among Us character definition
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


def create_infinite_scroll(offset):
    pixels = []
    character_width = 8
    for row in range(8):
        for col in range(8):
            scroll_pos = (col - offset) % character_width
            pixels.append(among_us_colors[among_us_character[row][scroll_pos]])
    return pixels


def get_interface_status(task):
    result = task.run(netmiko_send_command, command_string="show ip interface brief")
    return result[0].result


def parse_interface_status(status_output):
    fast_ethernet = []
    gigabit_ethernet = []
    for line in status_output.splitlines():
        if "FastEthernet" in line:
            parts = line.split()
            if len(parts) >= 5:
                status = "up" in parts[4].lower()
                fast_ethernet.append(status)
        elif "GigabitEthernet" in line:
            parts = line.split()
            if len(parts) >= 5:
                status = "up" in parts[4].lower()
                gigabit_ethernet.append(status)
    return fast_ethernet, gigabit_ethernet


def update_led_matrix(fast_ethernet, gigabit_ethernet):
    pixels = []
    fe_index = ge_index = gehe_index = 0
    for row in range(8):
        for col in range(8):
            if row in [0, 2, 4]:
                pixels.append(BLUE)
            elif row in [1, 3, 5]:
                if fe_index < len(fast_ethernet):
                    pixels.append(GREEN if fast_ethernet[fe_index] else RED)
                    fe_index += 1
                else:
                    pixels.append(OFF)
            elif row == 6:
                if gehe_index < len(gigabit_ethernet):
                    pixels.append(YELLOW)
                    gehe_index += 1
                else:
                    pixels.append(OFF)
            elif row == 7:
                if ge_index < len(gigabit_ethernet):
                    pixels.append(GREEN if gigabit_ethernet[ge_index] else RED)
                    ge_index += 1
                else:
                    pixels.append(OFF)
    sense.set_pixels(pixels)


def get_connected_port(task):
    result = task.run(netmiko_send_command, command_string="show ip arp")
    arp_table = result[0].result

    result = task.run(netmiko_send_command, command_string="show ip interface brief")
    ip_brief = result[0].result

    result = task.run(netmiko_send_command, command_string="show mac address-table")
    mac_table = result[0].result

    result = task.run(netmiko_send_command, command_string="show interfaces status")
    interface_status = result[0].result

    pi_port = None
    for line in interface_status.splitlines():
        if "connected" in line.lower():
            port = line.split()[0]
            if port.startswith("Fa"):
                port = port.replace("Fa", "FastEthernet")
            elif port.startswith("Gi"):
                port = port.replace("Gi", "GigabitEthernet")
            if port in ip_brief and "up" in ip_brief:
                pi_port = port
                break

    return pi_port


def manage_ports(task, ports, action, pi_port):
    command = "shutdown" if action == "disable" else "no shutdown"
    description = "DISABLED_PORT" if action == "disable" else "ENABLED_PORT"

    for port in ports:
        if pi_port and port.strip() == pi_port.strip():
            print(f"Skipping connected port: {port}")
            continue

        commands = [f"interface {port}", command, f"description {description}"]
        task.run(netmiko_send_config, config_commands=commands)
        print(f"Port {port} {action}d")

    task.run(netmiko_send_command, command_string="write memory")
    print("\nConfiguration saved")


def manage_all_ports(task, action, pi_port):
    result = task.run(netmiko_send_command, command_string="show interfaces status")
    output = result[0].result

    ports = []
    for line in output.splitlines():
        if "Fa" in line or "Gi" in line:
            port_name = line.split()[0]
            if port_name.startswith("Fa"):
                port_name = port_name.replace("Fa", "FastEthernet")
            elif port_name.startswith("Gi"):
                port_name = port_name.replace("Gi", "GigabitEthernet")
            ports.append(port_name)

    if ports:
        manage_ports(task, ports, action, pi_port)
    else:
        print("No ports found")


def main():
    nr = InitNornir(config_file="config.yaml")
    pool = multiprocessing.Pool(processes=4)

    try:
        pi_port_result = pool.apply_async(nr.run, (get_connected_port,))
        pi_port = list(pi_port_result.get().values())[0].result

        if pi_port:
            print(f"Raspberry Pi detected on port: {pi_port}")
        else:
            print("Warning: Could not detect Raspberry Pi port")

        last_change_time = datetime.now()
        previous_status = None
        animation_mode = False
        animation_offset = 0

        while True:
            print("\nPort Management Options:")
            print("1. Disable specific ports")
            print("2. Enable specific ports")
            print("3. Disable port range")
            print("4. Enable port range")
            print("5. Disable ALL ports")
            print("6. Enable ALL ports")
            print("7. Monitor port status")
            print("8. Exit")

            choice = input("\nEnter your choice (1-8): ")

            if choice in ["1", "2", "3", "4"]:
                action = "shutdown" if choice in ["1", "3"] else "no shutdown"
                if choice in ["1", "2"]:
                    ports = input(
                        "Enter ports (comma-separated, e.g., FastEthernet0/1,FastEthernet0/2): "
                    ).split(",")
                else:
                    start = input(
                        "Enter starting port number (e.g., 1 for FastEthernet0/1): "
                    )
                    end = input("Enter ending port number: ")
                    port_type = input(
                        "Enter port type (1 for FastEthernet, 2 for GigabitEthernet): "
                    )
                    prefix = (
                        "FastEthernet0/" if port_type == "1" else "GigabitEthernet0/"
                    )
                    ports = [f"{prefix}{i}" for i in range(int(start), int(end) + 1)]

                result = pool.apply_async(
                    nr.run,
                    (manage_ports,),
                    {"ports": ports, "action": action, "pi_port": pi_port},
                )
                print_result(result.get())

            elif choice in ["5", "6"]:
                action = "shutdown" if choice == "5" else "no shutdown"
                confirm = input(
                    f"Are you sure you want to {action} ALL ports? (yes/no): "
                )
                if confirm.lower() == "yes":
                    result = pool.apply_async(
                        nr.run,
                        (manage_all_ports,),
                        {"action": action, "pi_port": pi_port},
                    )
                    print_result(result.get())
                else:
                    print("Operation cancelled")

            elif choice == "7":
                print("Monitoring port status. Press Ctrl+C to stop.")
                try:
                    while True:
                        status_result = pool.apply_async(
                            nr.run, (get_interface_status,)
                        )
                        status_output = list(status_result.get().values())[0].result

                        current_fe, current_ge = parse_interface_status(status_output)
                        current_status = (current_fe, current_ge)

                        if previous_status != current_status:
                            last_change_time = datetime.now()
                            animation_mode = False
                            update_led_matrix(current_fe, current_ge)
                            print("Display updated - new status detected")
                        else:
                            time_since_change = datetime.now() - last_change_time
                            if (
                                time_since_change.total_seconds() >= 20
                                and not animation_mode
                            ):
                                animation_mode = True
                                print("Switching to animation mode")

                        if animation_mode:
                            sense.set_pixels(create_infinite_scroll(animation_offset))
                            animation_offset = (animation_offset + 1) % 8
                            time.sleep(0.1)
                        else:
                            update_led_matrix(current_fe, current_ge)
                            time.sleep(5)

                        previous_status = current_status

                except KeyboardInterrupt:
                    print("\nStopped monitoring")

            elif choice == "8":
                print("Exiting...")
                break

            else:
                print("Invalid choice. Please try again.")

    except Exception as e:
        print(f"An error occurred: {str(e)}")

    finally:
        pool.close()
        pool.join()
        sense.clear()


if __name__ == "__main__":
    main()

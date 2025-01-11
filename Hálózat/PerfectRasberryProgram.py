import sys
import subprocess


def install_required_packages():
    try:
        subprocess.check_call([sys.executable, "-m", "pip", "install", "setuptools"])
        required_packages = ["nornir", "nornir-utils", "nornir-netmiko", "sense-hat"]
        for package in required_packages:
            print(f"Installing {package}...")
            subprocess.check_call([sys.executable, "-m", "pip", "install", package])
    except Exception as e:
        print(f"Error during package installation: {str(e)}")
        sys.exit(1)


if __name__ == "__main__":
    install_required_packages()

    from nornir import InitNornir
    from nornir.core.task import Task, Result
    from nornir_utils.plugins.functions import print_result
    from nornir_netmiko.tasks import netmiko_send_command, netmiko_send_config
    from sense_hat import SenseHat
    import time
    from datetime import datetime

# Initialize SenseHat
sense = SenseHat()
sense.clear()


# Color definitions
GREEN = (0, 255, 0)
RED = (255, 0, 0)
BLUE = (0, 0, 255)
OFF = (0, 0, 0)
YELLOW = (255, 255, 0)
WHITE = (255, 255, 255)

# Among Us character and colors remain the same
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


def get_interface_status(task: Task) -> Result:
    result = task.run(
        task=netmiko_send_command, command_string="show interfaces status"
    )
    return Result(host=task.host, result=result.result)


def parse_interface_status(output):
    fast_ethernet = []
    gigabit_ethernet = []

    for line in output.splitlines():
        if "Fa" in line:
            status = "connected" in line.lower()
            fast_ethernet.append(status)
        elif "Gi" in line:
            status = "connected" in line.lower()
            gigabit_ethernet.append(status)

    return fast_ethernet, gigabit_ethernet


def manage_ports(task: Task, ports: list, action: str) -> Result:
    commands = []
    for port in ports:
        commands.extend(
            [
                f"interface {port}",
                "shutdown" if action == "disable" else "no shutdown",
                f"description {'DISABLED' if action == 'disable' else 'ENABLED'}_PORT",
            ]
        )

    result = task.run(task=netmiko_send_command, config_commands=commands)
    return Result(host=task.host, result=result.result)


def create_infinite_scroll(offset):
    pixels = []
    for row in range(8):
        for col in range(8):
            scroll_pos = (col - offset) % 8
            pixels.append(among_us_colors[among_us_character[row][scroll_pos]])
    return pixels


def update_led_matrix(fe_status, ge_status):
    pixels = []
    fe_index = ge_index = gehe_index = 0

    for row in range(8):
        for col in range(8):
            if row in [0, 2, 4]:
                pixels.append(BLUE)
            elif row in [1, 3, 5]:
                pixels.append(
                    GREEN
                    if fe_status[fe_index]
                    else RED if fe_index < len(fe_status) else OFF
                )
                fe_index += 1
            elif row == 6:
                pixels.append(YELLOW if gehe_index < len(ge_status) else OFF)
                gehe_index += 1
            else:
                pixels.append(
                    GREEN
                    if ge_status[ge_index]
                    else RED if ge_index < len(ge_status) else OFF
                )
                ge_index += 1

    sense.set_pixels(pixels)


def main():
    # Initialize Nornir
    nr = InitNornir(
        inventory={
            "plugin": "SimpleInventory",
            "options": {
                "host_file": "inventory/hosts.yaml",
                "group_file": "inventory/groups.yaml",
                "defaults_file": "inventory/defaults.yaml",
            },
        }
    )

    try:
        last_change_time = datetime.now()
        previous_status = None
        animation_mode = False
        animation_offset = 0

        while True:
            # Get interface status using Nornir
            result = nr.run(task=get_interface_status)

            if result:
                for host, host_result in result.items():
                    current_fe, current_ge = parse_interface_status(host_result.result)
                    current_status = (current_fe, current_ge)

                    if previous_status != current_status:
                        last_change_time = datetime.now()
                        animation_mode = False
                        update_led_matrix(current_fe, current_ge)
                    else:
                        time_since_change = datetime.now() - last_change_time
                        if (
                            time_since_change.total_seconds() >= 20
                            and not animation_mode
                        ):
                            animation_mode = True

                        if animation_mode:
                            sense.set_pixels(create_infinite_scroll(animation_offset))
                            animation_offset = (animation_offset + 1) % 8
                            time.sleep(0.1)
                        else:
                            update_led_matrix(current_fe, current_ge)
                            time.sleep(1)

                    previous_status = current_status

    except KeyboardInterrupt:
        print("\nProgram terminated by user")
    finally:
        sense.clear()


if __name__ == "__main__":
    main()

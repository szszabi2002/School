from netmiko import ConnectHandler
from sense_hat import SenseHat
import time
from datetime import datetime, timedelta

# Initialize SenseHat
sense = SenseHat()
sense.clear()

# Define colors
GREEN = (0, 255, 0)  # Connected
RED = (255, 0, 0)  # Disconnected
BLUE = (0, 0, 255)  # Port indicator row
OFF = (0, 0, 0)  # LED off
YELLOW = (255, 255, 0)  # Among Us background
WHITE = (255, 255, 255)  # Among Us visor

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

among_us_colors = {
    0: YELLOW,
    1: RED,
    2: WHITE,
}

# Switch connection parameters
cisco_switch = {
    "device_type": "cisco_ios",
    "host": "192.168.1.1",
    "username": "admin",
    "password": "password",
    "secret": "cisco",
    "port": 22,
    "fast_cli": False,
}


def create_infinite_scroll(offset):
    pixels = []
    character_width = 8
    for row in range(8):
        for col in range(8):
            scroll_pos = (col - offset) % character_width
            pixels.append(among_us_colors[among_us_character[row][scroll_pos]])
    return pixels


def get_interface_status(net_connect):
    try:
        output = net_connect.send_command("show ip interface brief")
        return output
    except Exception as e:
        print(f"Error getting interface status: {str(e)}")
        return None


def parse_interface_status(status_output):
    fast_ethernet = []
    gigabit_ethernet = []

    if status_output:
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
    fe_index = 0
    ge_index = 0
    gehe_index = 0

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
            elif row in [6]:
                if gehe_index < len(gigabit_ethernet):
                    pixels.append(YELLOW)
                    gehe_index += 1
                else:
                    pixels.append(OFF)
            elif row in [7]:
                if ge_index < len(gigabit_ethernet):
                    pixels.append(GREEN if gigabit_ethernet[ge_index] else RED)
                    ge_index += 1
                else:
                    pixels.append(OFF)

    sense.set_pixels(pixels)


def main():
    try:
        print("Connecting to switch...")
        net_connect = ConnectHandler(**cisco_switch)
        net_connect.enable()
        print("Connected successfully!")

        last_change_time = datetime.now()
        previous_status = None
        animation_mode = False
        animation_offset = 0
        while True:
            status_output = get_interface_status(net_connect)
            if status_output:
                current_fe, current_ge = parse_interface_status(status_output)
                current_status = (current_fe, current_ge)

                # Check if status changed
                if previous_status != current_status:
                    last_change_time = datetime.now()
                    animation_mode = False
                    update_led_matrix(current_fe, current_ge)
                    print("Display updated - new status detected")
                else:
                    # Check if we should switch to animation mode
                    time_since_change = datetime.now() - last_change_time
                    if time_since_change.total_seconds() >= 20 and not animation_mode:
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
        print("\nProgram terminated by user")
    except Exception as e:
        print(f"An error occurred: {str(e)}")
    finally:
        if "net_connect" in locals():
            net_connect.disconnect()
        sense.clear()


if __name__ == "__main__":
    main()

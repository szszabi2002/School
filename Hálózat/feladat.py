from netmiko import ConnectHandler
from sense_hat import SenseHat
import time

# Initialize SenseHat
sense = SenseHat()
sense.clear()

# Define colors
GREEN = (0, 255, 0)  # Connected
RED = (255, 0, 0)  # Disconnected
BLUE = (0, 0, 255)  # Port indicator row
YELLOW = (255, 255, 0)
OFF = (0, 0, 0)  # LED off

# Switch connection parameters
cisco_switch = {
    "device_type": "cisco_ios",
    "host": "192.168.1.1",  # Replace with your switch IP
    "username": "admin",
    "password": "password",
    "secret": "cisco",
    "port": 22,
    "fast_cli": False,
}


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

    # Create the display layout
    for row in range(8):
        for col in range(8):
            if row in [0, 2, 4]:  # Blue indicator rows
                pixels.append(BLUE)
            elif row in [1, 3, 5]:  # FastEthernet port status rows
                if fe_index < len(fast_ethernet):
                    pixels.append(GREEN if fast_ethernet[fe_index] else RED)
                    fe_index += 1
                else:
                    pixels.append(OFF)
            elif row in [6]:  # GigabitEthernet port status rows
                if gehe_index < len(gigabit_ethernet):
                    pixels.append(YELLOW)
                    gehe_index += 1
                else:
                    pixels.append(OFF)
            elif row in [7]:  # GigabitEthernet port status rows
                if ge_index < len(gigabit_ethernet):
                    pixels.append(GREEN if gigabit_ethernet[ge_index] else RED)
                    ge_index += 1
                else:
                    pixels.append(OFF)

    # Update the display
    sense.set_pixels(pixels)


def main():
    try:
        print("Connecting to switch...")
        net_connect = ConnectHandler(**cisco_switch)
        net_connect.enable()
        print("Connected successfully!")

        while True:
            status_output = get_interface_status(net_connect)
            if status_output:
                fast_ethernet, gigabit_ethernet = parse_interface_status(status_output)
                update_led_matrix(fast_ethernet, gigabit_ethernet)
                print("Display updated")

            time.sleep(5)  # Update every 5 seconds

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

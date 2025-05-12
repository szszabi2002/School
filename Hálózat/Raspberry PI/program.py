from nornir import InitNornir
from nornir_netmiko import netmiko_send_command, netmiko_send_config
from nornir.core.exceptions import NornirExecutionError
from sense_hat import SenseHat
import time
from datetime import datetime
from concurrent.futures import ThreadPoolExecutor
import re


class SenseHatManager:
    def __init__(self):
        self.sense = SenseHat()
        self.colors = {
            "GREEN": (0, 255, 0),
            "RED": (255, 0, 0),
            "BLUE": (0, 0, 255),
            "YELLOW": (255, 255, 0),
            "WHITE": (255, 255, 255),
            "OFF": (0, 0, 0),
        }
        self.sense.clear()

    def display_port_status(self, interfaces):
        pixels = []
        for row in range(8):
            for col in range(8):
                interface_index = row * 8 + col
                if interface_index < len(interfaces):
                    status = interfaces[interface_index]["status"]
                    color = (
                        self.colors["GREEN"] if status == "up" else self.colors["RED"]
                    )
                    pixels.append(color)
                else:
                    pixels.append(self.colors["OFF"])
        self.sense.set_pixels(pixels)


class NetworkManager:
    def __init__(self):
        self.nr = InitNornir(config_file="config.yaml")
        self.executor = ThreadPoolExecutor(max_workers=4)

    def get_interface_status(self, task):
        try:
            result = task.run(
                netmiko_send_command,
                command_string="show interfaces brief",
                use_genie=True,
            )
            return result[0].result
        except Exception as e:
            print(f"Error getting interface status: {str(e)}")
            return None

    def parse_interfaces(self, output):
        interfaces = []
        pattern = r"(?P<interface>\S+)\s+\S+\s+\S+\s+\S+\s+(?P<status>up|down|administratively down)\s+\S+"
        for match in re.finditer(pattern, output):
            interface = match.groupdict()
            interfaces.append(
                {
                    "name": interface["interface"],
                    "status": "up" if "up" in interface["status"] else "down",
                }
            )
        return interfaces

    def manage_ports(self, task, ports, action):
        commands = []
        for port in ports:
            commands.extend(
                [
                    f"interface {port}",
                    "shutdown" if action == "disable" else "no shutdown",
                    f"description {'DISABLED' if action == 'disable' else 'ENABLED'}",
                ]
            )
        try:
            task.run(netmiko_send_config, config_commands=commands)
            task.run(netmiko_send_command, command_string="write memory")
            return True
        except NornirExecutionError as e:
            print(f"Configuration failed: {str(e)}")
            return False


def main():
    sense_manager = SenseHatManager()
    net_manager = NetworkManager()

    try:
        while True:
            print("\nNetwork Management Menu:")
            print("1. Disable Port(s) 2. Enable Port(s)")
            print("3. Monitor Status  4. Exit")

            choice = input("Select option (1-4): ")

            if choice in ["1", "2"]:
                ports = input("Enter port(s) (comma-separated): ").split(",")
                action = "disable" if choice == "1" else "enable"
                result = net_manager.nr.run(
                    net_manager.manage_ports, ports=ports, action=action
                )
                print(result)

            elif choice == "3":
                print("Monitoring... (CTRL+C to stop)")
                try:
                    while True:
                        future = net_manager.executor.submit(
                            net_manager.nr.run, net_manager.get_interface_status
                        )
                        result = future.result()
                        interfaces = []
                        for host_result in result.values():
                            interfaces.extend(
                                net_manager.parse_interfaces(host_result.result)
                            )
                        sense_manager.display_port_status(interfaces)
                        time.sleep(5)
                except KeyboardInterrupt:
                    sense_manager.sense.clear()

            elif choice == "4":
                print("Exiting...")
                break

    except Exception as e:
        print(f"Error: {str(e)}")
    finally:
        net_manager.executor.shutdown()
        sense_manager.sense.clear()


if __name__ == "__main__":
    main()

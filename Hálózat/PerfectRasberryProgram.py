import sys
import subprocess
from datetime import datetime
import time


class NetworkMonitor:
    def __init__(self):
        self.install_dependencies()
        self.initialize_imports()
        self.initialize_hardware()
        self.initialize_colors()
        self.initialize_patterns()
        self.initialize_nornir()

    def install_dependencies(self):
        try:
            subprocess.check_call(
                [sys.executable, "-m", "pip", "install", "setuptools"]
            )
            required_packages = [
                "nornir",
                "nornir-utils",
                "nornir-netmiko",
                "sense-hat",
            ]
            for package in required_packages:
                subprocess.check_call([sys.executable, "-m", "pip", "install", package])
        except Exception as e:
            print(f"Error during package installation: {str(e)}")
            sys.exit(1)

    def initialize_imports(self):
        from nornir import InitNornir
        from nornir.core.task import Task, Result
        from nornir_utils.plugins.functions import print_result
        from nornir_netmiko.tasks import netmiko_send_command, netmiko_send_config
        from sense_hat import SenseHat

        self.InitNornir = InitNornir
        self.Task = Task
        self.Result = Result
        self.print_result = print_result
        self.netmiko_send_command = netmiko_send_command
        self.netmiko_send_config = netmiko_send_config

    def initialize_hardware(self):
        self.sense = SenseHat()
        self.sense.clear()

    def initialize_colors(self):
        self.colors = {
            "GREEN": (0, 255, 0),
            "RED": (255, 0, 0),
            "BLUE": (0, 0, 255),
            "OFF": (0, 0, 0),
            "YELLOW": (255, 255, 0),
            "WHITE": (255, 255, 255),
        }

    def initialize_patterns(self):
        self.among_us = {
            "pattern": [
                [0, 0, 0, 1, 1, 1, 0, 0],
                [0, 0, 1, 1, 2, 2, 2, 0],
                [0, 1, 1, 2, 2, 2, 2, 2],
                [0, 1, 1, 1, 2, 2, 2, 0],
                [0, 1, 1, 1, 1, 1, 1, 0],
                [0, 1, 1, 1, 1, 1, 1, 0],
                [0, 0, 1, 1, 1, 1, 1, 0],
                [0, 0, 1, 1, 0, 1, 1, 0],
            ],
            "colors": {
                0: self.colors["YELLOW"],
                1: self.colors["RED"],
                2: self.colors["WHITE"],
            },
        }

    def initialize_nornir(self):
        self.nr = self.InitNornir(
            inventory={
                "plugin": "SimpleInventory",
                "options": {
                    "host_file": "inventory/hosts.yaml",
                    "group_file": "inventory/groups.yaml",
                    "defaults_file": "inventory/defaults.yaml",
                },
            }
        )

    def get_interface_status(self, task) -> Result:
        return self.Result(
            host=task.host,
            result=task.run(
                task=self.netmiko_send_command, command_string="show interfaces status"
            ).result,
        )

    def parse_interface_status(self, output: str) -> tuple:
        return (
            [
                "connected" in line.lower()
                for line in output.splitlines()
                if "Fa" in line
            ],
            [
                "connected" in line.lower()
                for line in output.splitlines()
                if "Gi" in line
            ],
        )

    def monitor_interfaces(self):
        try:
            last_change_time = datetime.now()
            previous_status = None
            animation_mode = False
            animation_offset = 0

            while True:
                result = self.nr.run(task=self.get_interface_status)
                if not result:
                    continue

                for host, host_result in result.items():
                    current_fe, current_ge = self.parse_interface_status(
                        host_result.result
                    )
                    current_status = (current_fe, current_ge)

                    if previous_status != current_status:
                        last_change_time = datetime.now()
                        animation_mode = False
                        self.update_display(current_fe, current_ge, False)
                    else:
                        time_since_change = (
                            datetime.now() - last_change_time
                        ).total_seconds()
                        if time_since_change >= 20 and not animation_mode:
                            animation_mode = True

                        if animation_mode:
                            self.update_display(
                                current_fe, current_ge, True, animation_offset
                            )
                            animation_offset = (animation_offset + 1) % 8
                            time.sleep(0.1)
                        else:
                            self.update_display(current_fe, current_ge, False)
                            time.sleep(1)

                    previous_status = current_status

        except KeyboardInterrupt:
            print("\nMonitoring stopped")

    def port_management_menu(self):
        while True:
            print("\nPort Management Options:")
            print("1. Disable specific ports")
            print("2. Enable specific ports")
            print("3. Disable port range")
            print("4. Enable port range")
            print("5. Disable ALL ports")
            print("6. Enable ALL ports")
            print("7. Return to main menu")

            choice = input("\nEnter your choice (1-7): ")

            if choice in ["1", "2"]:
                ports = input(
                    "Enter ports (comma-separated, e.g., FastEthernet0/1,FastEthernet0/2): "
                ).split(",")
                action = "disable" if choice == "1" else "enable"
                result = self.nr.run(task=self.manage_ports, ports=ports, action=action)
                self.print_result(result)
            elif choice == "7":
                break

    def run(self):
        try:
            while True:
                print("\nMain Menu:")
                print("1. Monitor Interface Status")
                print("2. Port Management")
                print("3. Exit")

                choice = input("\nEnter your choice (1-3): ")

                if choice == "1":
                    self.monitor_interfaces()
                elif choice == "2":
                    self.port_management_menu()
                else:
                    break
        finally:
            self.sense.clear()


if __name__ == "__main__":
    monitor = NetworkMonitor()
    monitor.run()

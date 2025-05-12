from netmiko import ConnectHandler


def connect_to_switch():
    cisco_switch = {
        "device_type": "cisco_ios",
        "host": "192.168.1.4",  # Replace with your switch IP
        "username": "admin",
        "password": "admin",
        "secret": "cisco",
        "port": 22,
    }

    try:
        print("Connecting to switch...")
        net_connect = ConnectHandler(**cisco_switch)
        net_connect.enable()
        return net_connect
    except Exception as e:
        print(f"Connection error: {str(e)}")
        return None


def get_connected_port(net_connect):
    try:
        # First try to get the port from ARP table
        output = net_connect.send_command("show ip arp")
        pi_port = None

        # Get the IP address of the connection to the switch
        show_ip = net_connect.send_command("show ip interface brief")

        # Get the MAC address table
        mac_table = net_connect.send_command("show mac address-table")

        # Get the interface status
        interface_status = net_connect.send_command("show interfaces status")

        # Look for connected ports
        for line in interface_status.splitlines():
            if "connected" in line.lower():
                port = line.split()[0]
                if port.startswith("Fa"):
                    port = port.replace("Fa", "FastEthernet")
                elif port.startswith("Gi"):
                    port = port.replace("Gi", "GigabitEthernet")

                # Check if this is the port we're connected through
                if port in show_ip and "up" in show_ip:
                    pi_port = port
                    break

        if pi_port:
            print(f"Connected through port: {pi_port}")
            return pi_port
        else:
            print("Warning: Could not detect connection port")
            return None

    except Exception as e:
        print(f"Error detecting connection port: {str(e)}")
        return None


def manage_ports(net_connect, ports, action, pi_port):
    try:
        print(f"\n{action.capitalize()}ing ports...")
        command = "shutdown" if action == "disable" else "no shutdown"
        description = "DISABLED_PORT" if action == "disable" else "ENABLED_PORT"

        for port in ports:
            if pi_port and port.strip() == pi_port.strip():  # Skip the connected port
                print(f"Skipping connected port: {port}")
                continue

            commands = [f"interface {port}", command, f"description {description}"]
            output = net_connect.send_config_set(commands)
            print(f"Port {port} {action}d")

        net_connect.save_config()
        print("\nConfiguration saved")

    except Exception as e:
        print(f"Error {action}ing ports: {str(e)}")


def manage_all_ports(net_connect, action, pi_port):
    try:
        output = net_connect.send_command("show interfaces status")
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
            manage_ports(net_connect, ports, action, pi_port)
        else:
            print("No ports found")

    except Exception as e:
        print(f"Error managing all ports: {str(e)}")


def main():
    net_connect = connect_to_switch()
    if not net_connect:
        return

    try:
        # Get Raspberry Pi's connected port
        pi_port = get_connected_port(net_connect)
        if pi_port:
            print(f"Raspberry Pi detected on port: {pi_port}")
        else:
            print("Warning: Could not detect Raspberry Pi port")

        while True:
            print("\nPort Management Options:")
            print("1. Disable specific ports")
            print("2. Enable specific ports")
            print("3. Disable port range")
            print("4. Enable port range")
            print("5. Disable ALL ports")
            print("6. Enable ALL ports")
            print("7. Exit")

            choice = input("\nEnter your choice (1-7): ")

            if choice in ["1", "2"]:
                ports = input(
                    "Enter ports (comma-separated, e.g., FastEthernet0/1,FastEthernet0/2): "
                ).split(",")
                action = "disable" if choice == "1" else "enable"
                manage_ports(net_connect, ports, action, pi_port)

            elif choice in ["3", "4"]:
                start = input(
                    "Enter starting port number (e.g., 1 for FastEthernet0/1): "
                )
                end = input("Enter ending port number: ")
                port_type = input(
                    "Enter port type (1 for FastEthernet, 2 for GigabitEthernet): "
                )

                prefix = "FastEthernet0/" if port_type == "1" else "GigabitEthernet0/"
                ports = [f"{prefix}{i}" for i in range(int(start), int(end) + 1)]
                action = "disable" if choice == "3" else "enable"
                manage_ports(net_connect, ports, action, pi_port)

            elif choice in ["5", "6"]:
                action = "disable" if choice == "5" else "enable"
                confirm = input(
                    f"Are you sure you want to {action} ALL ports? (yes/no): "
                )
                if confirm.lower() == "yes":
                    manage_all_ports(net_connect, action, pi_port)
                else:
                    print("Operation cancelled")

            elif choice == "7":
                print("Exiting...")
                break

            else:
                print("Invalid choice. Please try again.")

    except Exception as e:
        print(f"An error occurred: {str(e)}")
    finally:
        net_connect.disconnect()
        print("\nDisconnected from switch")


if __name__ == "__main__":
    main()

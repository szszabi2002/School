from netmiko import ConnectHandler


def connect_to_router():
    # Device connection parameters with your actual credentials
    cisco_router = {
        "device_type": "cisco_ios",
        "host": "192.168.1.1",  # Replace with your router IP
        "username": "admin",  # Your configured username
        "password": "password",  # Your configured secret password
        "secret": "cisco",  # Your enable secret password
        "port": 22,  # SSH port
        "fast_cli": False,  # Slower but more reliable
        "global_delay_factor": 2,  # Increased delay factor for reliability
    }

    try:
        print("Connecting to router...")
        net_connect = ConnectHandler(**cisco_router)
        net_connect.enable()
        print("Successfully connected!")
        return net_connect
    except Exception as e:
        print(f"Connection error: {str(e)}")
        return None


def verify_interface(net_connect, interface):
    try:
        config_commands = [
            f"do show interfaces {interface}",
            "do sh ip int brief",
        ]
        print(f"\nVerifying interface {interface}...")
        output = net_connect.send_config_set(config_commands)
        return output
    except Exception as e:
        print(f"Error verifying interface: {str(e)}")
        return None


def configure_interface(net_connect, interface, ip_address, subnet_mask):
    try:
        config_commands = [
            f"interface {interface}",
            f"ip address {ip_address} {subnet_mask}",
            "no shutdown",
        ]

        print(f"\nConfiguring interface {interface}...")
        output = net_connect.send_config_set(config_commands)

        # Save the configuration
        print("Saving configuration...")
        net_connect.save_config()
        return output
    except Exception as e:
        print(f"Error configuring interface: {str(e)}")
        return None


def main():
    # Connect to router
    net_connect = connect_to_router()
    if not net_connect:
        return

    try:
        # Show current interface status
        interface = input("\nEnter interface (e.g., GigabitEthernet0/1): ")
        print("\nCurrent Interface Status:")
        print(verify_interface(net_connect, interface))

        # Get interface configuration details
        ip_address = input("\nEnter IP address: ")
        subnet_mask = input("Enter subnet mask: ")

        # Configure the interface
        result = configure_interface(net_connect, interface, ip_address, subnet_mask)
        if result:
            print("\nConfiguration Output:")
            print(result)

        # Show updated interface status
        print("\nUpdated Interface Status:")
        print(verify_interface(net_connect, interface))

    except Exception as e:
        print(f"An error occurred: {str(e)}")

    finally:
        print("\nDisconnecting from router...")
        net_connect.disconnect()
        print("Disconnected successfully!")


if __name__ == "__main__":
    main()

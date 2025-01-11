import multiprocessing
from nornir import InitNornir
from nornir_netmiko import netmiko_send_command, netmiko_send_config
from nornir_utils.plugins.functions import print_result
from sense_hat import SenseHat

# Initialize Nornir and SenseHat
nr = InitNornir(config_file="config.yaml")
sense = SenseHat()

def display_on_sense_hat(message):
    sense.show_message(message, text_colour=[255, 255, 0], back_colour=[0, 0, 255])

def port_management(task, action, ports=None, start=None, end=None):
    if action == "disable_specific":
        commands = [f"interface GigabitEthernet{port}", "shutdown" for port in ports]
    elif action == "enable_specific":
        commands = [f"interface GigabitEthernet{port}", "no shutdown" for port in ports]
    elif action == "disable_range":
        commands = [f"interface range GigabitEthernet{start} - {end}", "shutdown"]
    elif action == "enable_range":
        commands = [f"interface range GigabitEthernet{start} - {end}", "no shutdown"]
    elif action == "disable_all":
        commands = ["interface range GigabitEthernet0/1 - 24", "shutdown"]
    elif action == "enable_all":
        commands = ["interface range GigabitEthernet0/1 - 24", "no shutdown"]
    
    result = task.run(netmiko_send_config, config_commands=commands)
    return result

def device_info(task):
    commands = [
        "show version | include Version",
        "show ip interface brief",
        "show vlan brief"
    ]
    results = {}
    for command in commands:
        result = task.run(netmiko_send_command, command_string=command)
        results[command] = result.result
    return results

def config_backup(task):
    result = task.run(netmiko_send_command, command_string="show running-config")
    with open(f"{task.host.name}_config.txt", "w") as f:
        f.write(result.result)
    return f"Backup saved for {task.host.name}"

def run_task(task_func, **kwargs):
    result = nr.run(task=task_func, **kwargs)
    print_result(result)
    return result

if __name__ == "__main__":
    pool = multiprocessing.Pool()

    while True:
        print("\nMain Menu:")
        print("1. Port Management")
        print("2. Device Information")
        print("3. Configuration Backup")
        print("4. Exit")
        
        choice = input("\nEnter your choice (1-4): ")
        
        if choice == '1':
            print("\nPort Management Options:")
            print("1. Disable specific ports")
            print("2. Enable specific ports")
            print("3. Disable port range")
            print("4. Enable port range")
            print("5. Disable ALL ports")
            print("6. Enable ALL ports")
            
            port_choice = input("\nEnter your choice (1-6): ")
            
            if port_choice in ['1', '2']:
                ports = input("Enter port numbers separated by commas: ").split(',')
                action = "disable_specific" if port_choice == '1' else "enable_specific"
                pool.apply_async(run_task, (port_management,), {"action": action, "ports": ports})
            elif port_choice in ['3', '4']:
                start = input("Enter start port: ")
                end = input("Enter end port: ")
                action = "disable_range" if port_choice == '3' else "enable_range"
                pool.apply_async(run_task, (port_management,), {"action": action, "start": start, "end": end})
            elif port_choice == '5':
                pool.apply_async(run_task, (port_management,), {"action": "disable_all"})
            elif port_choice == '6':
                pool.apply_async(run_task, (port_management,), {"action": "enable_all"})
        
        elif choice == '2':
            pool.apply_async(run_task, (device_info,))
        
        elif choice == '3':
            pool.apply_async(run_task, (config_backup,))
        
        elif choice == '4':
            print("Exiting program...")
            display_on_sense_hat("Goodbye!")
            break
        
        else:
            print("Invalid choice. Please try again.")

    pool.close()
    pool.join()

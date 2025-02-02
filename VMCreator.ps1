foreach ($name in $vmNames) {
    # Set disk size based on VM name
    if ($name -like "*Server*") {
        $vhdSize = 120GB
    } else {
        $vhdSize = 40GB
    }

    # Create a dynamically expanding VHDX
    $vhdPath = "$path\$name\Virtual Hard Disks\$name.vhdx"
    New-VHD -Path $vhdPath -SizeBytes $vhdSize -Dynamic

    # Create the VM with the dynamically expanding VHDX
    New-VM -Name $name `
           -Version 9.0 `
           -MemoryStartupBytes $memory `
           -VHDPath $vhdPath `
           -Generation 2 `  # Use Generation 2 for UEFI (required for some OSes)
           -SwitchName "Default Switch"  # Replace with your network switch
}
# Define VM names
$vmNames = @(
    "PlasTech_WIN_Server",
    "PlasTech_WIN_Client",
    "PlasTech_DEB_Server",
    "PlasTech_DEB_Client"
)

# Configure VM settings (adjust as needed)
$memory = 2GB          # Startup memory
$path = "C:\ProgramData\Microsoft\Windows\Virtual Hard Disks"   # Base path for VM files (customize this)

# Ensure the base path exists
if (-not (Test-Path $path)) {
    New-Item -ItemType Directory -Path $path | Out-Null
}

# Create each VM
foreach ($name in $vmNames) {
    # Set disk size based on VM name
    if ($name -like "*Server*") {
        $vhdSize = 120GB  # 120 GB for server VMs
    } else {
        $vhdSize = 40GB   # 40 GB for client VMs
    }

    # Create the folder structure for the VM
    $vmFolder = "$path\$name"
    $vhdFolder = "$vmFolder\Virtual Hard Disks"
    if (-not (Test-Path $vhdFolder)) {
        New-Item -ItemType Directory -Path $vhdFolder | Out-Null
    }

    # Create a dynamically expanding VHDX
    $vhdPath = "$vhdFolder\$name.vhdx"
    try {
        New-VHD -Path $vhdPath -SizeBytes $vhdSize -Dynamic -ErrorAction Stop
    } catch {
        Write-Host "Failed to create VHDX for ${name}: $_" -ForegroundColor Red
        continue
    }

    # Create the VM with the dynamically expanding VHDX
    try {
        New-VM -Name $name `
               -Version 9.0 `
               -MemoryStartupBytes $memory `
               -VHDPath $vhdPath `
               -Generation 2 `  # Use Generation 2 for UEFI (required for some OSes)
               -SwitchName "Default Switch" -ErrorAction Stop  # Replace with your network switch
        Write-Host "Created VM: $name with a $vhdSize dynamically expanding disk at $vhdPath" -ForegroundColor Green
    } catch {
        Write-Host "Failed to create VM ${name}: $_" -ForegroundColor Red
    }
}

Write-Host "Script execution completed." -ForegroundColor Cyan
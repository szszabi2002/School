# Bekérünk egy nevet üdvözöljük a felhasználót majd kírjuk a 2. 3. karajterét a nevének
neve = input("Kérem a nevét: ")
print("Üdvözöljük ", neve)
print(neve[2], neve[3])
# kiírjuk a nevének utlsó 3 karakterét
print(neve[-3:])
# Kiírjuk a nevének minden második karakterét
print(neve[1::2])
# Kírjuk csak a keresztnevet
# Teljes néven karakterenként és kiírjuk
if " " in neve:
    name_parts = neve.split()
    print(name_parts[1])
for i in neve:
    print(i)
# Most az indexek segítségével írjuk ki az
# Indexeken megyünk végig
index = 0
for j in range(0, len(neve)):
    if neve[j] == " ":
        index = j+1  # Szóköz utáni karakter indexe
        break  # Kilép a ciklusból
print(f"A keresztneved: {neve[index:]}")
# Írjuk ki hogy a beírt névben hány kersztnév van  (1vagy2)
count = 0
for j in range(len(neve)):
    if neve[j] == " ":
        count+=1
        break
print(f"A keresztnevek száma: {count}")
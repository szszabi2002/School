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
        count += 1
print(f"A keresztnevek száma: {count}")
# Beípitett sztringkezelő függvények metódusok
# sztring hossza: LEN
hossz = len(neve)
# Tárolt sztring hosszát

ujnev = neve.capitalize()
# A .capitalize() a sztring legelső karakterét nagybetűvé alakítja

# A .upper() a sztring minden karaktere nagy betű lesz
ujnev1 = neve.upper()
# A .lower() a sztring minden karaktere kisbetű lesz
ujnev2 = neve.lower()
# A .strip() eltávolítja a szóközöket a sztring elejtől a végéig
ujnev3 = neve.strip()
# A beírt sztrineket listává darabolja szét a megadott karakter mentén .split(Megadott karakter)
ujnev4 = neve.split()
lista = []
lista = neve.split(" ")
# Írjuk ki a lista elemeit
for i in lista:
    print(i)
# A .find() keresi a karakter első előfordulásának indexét
keres = neve.find('a')
# A .startswith() igaz ha a sztring kezdődik 'a' karakternel
kezdodo = neve.startswith('a')
# A .endswith() igaz ha a sztring vége 'a' karakternel zárul
vegulo = neve.endswith('a')

# Bekérünk egy olyan mondatot és kiírjuk hogy hány karakterből áll
mondat = input("Kérek egy mondatot: ")
karakterek = len(mondat)
print(f"A mondatban {karakterek} karakter van.")
# hány szóból áll
szavak = len(mondat.split())
print(f"A mondatban {szavak} szót tartalmaz.")
# mi a harmadik szó
harmadik = mondat.split()[2]
print(f"A harmadik szó a mondatba: {harmadik}")
# mi a második szó 3. karaktere
harmadikkarakter = mondat.split()[1][2]
print(f"A második szó 3. karaktere: {harmadikkarakter}")
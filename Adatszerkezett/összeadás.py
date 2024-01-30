import random


elso = []
for i in range(1, 11):
    elso.append(i)
osszeg = 0
for i in range(len(elso)):
    osszeg += elso[i]
print("Az első listában szereplő számok összege:", osszeg)
szorzat = 1
for i in range(len(elso)):
    szorzat *= elso[i]
print("Első tíz szám szorzata:", szorzat)

# Egyjegyű páros számok átlaga
atlag = 0
osszeg = 0
db = 0

for i in range(len(elso)):
    osszeg += elso[i]
    if i == 0:
        atlag += elso[i]
    else:
        atlag += elso[i] * (i + 1) / (db + 1)
        db += 1

atlag = osszeg / db
print("\nAz első tíz szám átlaga:", round(atlag, 2))

for i in range(len(elso) - 1):
    if elso[i] % 2 == 0:
        db += 1
        osszeg += elso[i]
atlag = osszeg / db
print(atlag)

vanilyen = False
adatok = []
for i in range(100):
    x = random.randint(0, 1000)
    adatok.append(x)
for i in range(len(adatok)):
    if adatok[i] % 71 == 0:
        vanilyen = True
        break
if vanilyen:
    print("Van benne 71-gyel osztható")
else:
    print("Nincs van benne 71-gyel osztható")
# Most csináljuk meg ugyanezt while ciklusal
vanilyen = False
i = 0
while i < len(adatok) and vanilyen is True:
    if adatok[i] % 71 == 0:
        vanilyen = True
    i += 1

if vanilyen:
    print("Van benne 71-gyel osztható")
else:
    print("Nincs van benne 71-gyel osztható")

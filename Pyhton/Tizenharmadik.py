import random


def Nagy(szoveg):
    print("A Negyedik szó Csupa nagybetűvel: ", szoveg.upper())


# Hozzunk létre egy listát és töltsük fel 50 db véletlenszerű számmal 1-100 között

szamok = []
for i in range(50):
    szamok.append(random.randint(1, 100))

# számoljuk ki az átlagát, összegét, min, max

print("Átlag: ", sum(szamok) / len(szamok))
print("Összeg: ", sum(szamok))
print("Max: ", max(szamok))
print("Min: ", min(szamok))

# majd sorbarendezve írjuk ki a végül adjuk hozzá újabb 50 db számot
print(sorted(szamok))
for i in range(50):
    szamok.append(random.randint(1, 100))

# Kérjünk be egy mondatott, írjuk ki a betűk és szavak számát
mondat = input("Kerem a mondatot: ")
print(
    f"A mondatban {len(mondat)} karakter van és ennyi {len(mondat.split())} szót tartalmaz."
)
# Írjuk ki a 3.szót
print(f"A harmadik szó: {mondat.split()[2]}")
# A 2.szó 3.karakterlét
print(f"A második szó harmadik karaktere: {mondat.split()[1][2]}")
# Az első szót visszafelé kiírni
szavak = mondat.split()
print("Első szó visszafelé: ", szavak[0][-1::-1])

# Függvény segítségével csupa nagybetűvel a 4.szót
Nagy(szavak[3])

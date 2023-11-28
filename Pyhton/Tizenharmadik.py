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


# Írjunk egy fv ami kap 3 számot és visszatér egy igaz vagy hamis értékkel akkor igaz ha szerkeszthető ilyen 3 szög
def Haromszog(x, y, z):
    return x < (y + z) and y < (x + z) and z < (y + x)


def Derekszog(a, b, c):
    return a * a + b * b == c * c or a * a + c * c == b * b or b**2 + c**2 == a**2


if Haromszog(3, 4, 5):
    print("Szerkeszthető")
    if Derekszog(3, 4, 5):
        print("Derékszögű")
    else:
        print("Nem derekszögű")
else:
    print("Nem szerkeszthető")
# Ha szerkeszthető akkor fv segítségével nézzük meg hogy derékszögű háromszög e.


# Kérjünk be egy mondatott és egy számot, Írjuk ki a mondat annyiadik karakterét ammennyi a bekért a számú
# Pl.: Almafa és Círok Visszakapot érték: é
def Betu(mondat, x):
    return mondat[x - 1]


ujmondat = input("Mondat: ")
sorszamlalo = int(input("Hányadik karakter? "))
print(f"Megadott mondat {sorszamlalo}. karaktere:", Betu(ujmondat, sorszamlalo))


def Szo(mondat, x):
    reszek = mondat.split()
    return reszek[x - 1]


print(f"Megadott mondat {sorszamlalo}. szava:", Betu(ujmondat, sorszamlalo))

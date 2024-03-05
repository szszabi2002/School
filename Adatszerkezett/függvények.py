def Kiir(x):
    print(f"Szia Kedves {x}")


# fv meghívása mindig a fv nevével és paramétereivel történik

x = "Rozál"
Kiir("Dezső")
Kiir(x)
Kiir(6)


def Osszead(x, y):
    return x + y


print(Osszead(4, 5))

# Írjunk egy fv-t ami paraméternek kap 3 számot és igazzal tér vissza ha szerkeszthető 3 szög a számokból hamisal ha nem szerkeszthető


def Haromszog(a, b, c):
    if a + b > c and a + c > b and b + c > a:
        return True
    else:
        return False


print(Haromszog(4, 5, 6))
print(Haromszog(14, 5, 6))


def Haromszog1(a, b, c):
    return a + b > c and a + c > b and b + c > a


print(Haromszog(4, 5, 6))
print(Haromszog(14, 5, 6))

# fv segítségével nézd meg hogy derékszögű e


def Derekszog(a, b, c):
    return a * a + b * b == c * c or a * a + c * c == b * b or b**2 + c**2 == a**2


print(Derekszog(4, 5, 6))
print(Derekszog(5, 4, 2))

# Másodfukú egyenlet megoldása fv

import math


def masodfoku_egyenlet_megoldasa(a, b, c):
    # Számoljuk ki a diszkriminánst
    D = b**2 - 4 * a * c
    if D < 0:
        return print("Nem szerkeszthető")
    else:
        # Két gyök számolása
        gyok1 = (-b + math.sqrt(D)) / (2 * a)
        gyok2 = (-b - math.sqrt(D)) / (2 * a)
        return gyok1, gyok2


# Példa: ax^2 + bx + c = 0
a = 1
b = -2
c = 1

gyok1, gyok2 = masodfoku_egyenlet_megoldasa(a, b, c)
print(f"A gyökök: {gyok1} és {gyok2}")

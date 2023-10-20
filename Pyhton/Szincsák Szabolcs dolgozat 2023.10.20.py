# 1.Feladat Bekérünk 3 számot, ami egy másodfokú egyenlet 3 paramétere és kiírjuk az egyelnet megoldásait vagy azt, hogy nics megoldás
import math


a = float(input("Add meg az a értékét: "))
b = float(input("Add meg az b értékét: "))
c = float(input("Add meg az c értékét: "))
d = b * b - 4 * a * c
x1 = 0
x2 = 0

if d > 0:
    x1 = (-b + math.sqrt(d)) / (2 * a)
    x2 = (b + math.sqrt(d)) / (2 * a)
    print(f"A feladatnak 2 megoldás van az x1= {x1} és x2= {x2}")
elif d == 0:
    x1 = -b + math.sqrt(d) / (2 * a)
    print(f"A feladatnak 1 megoldás van x1= {x1}")
else:
    print("Az x^2 együtthatója nem lehet 0.")

# 2.Feladat Bekérünk egy vasgolyó átmérőjét és kiírjúk a súlyűt (7.871 g/cm^3)
atmero = float(input("Add meg a vasgolyó átmérőjét (cm): "))
tomeg = 7.871
r = atmero / (2 * math.pi)
v = 4 / 3 * r**3 * math.pi
suly = v * tomeg
print(f"A vasgolyó: {suly/1000:.2f} kg.")

# 3.Feladat Bekérünk egy számot és kiírjuk az osztói összegét
osszeg = 0
a = int(input("Ajd megy egy számot és megmodom az osztói összegét: "))
for i in range(1, a + 1):
    if a % i == 0:
        osszeg += i
print("Osztói összege: ", osszeg)

# 4.Feladat Bekérünk egy számot és kiírjuk a prímeket addig a számig pl. prímek 1000-ig
szam = int(input("Add meg egy számot: "))

# Kiírjuk a prímeket addig a számig
print("A prímek", szam, "ig:")
for i in range(2, szam + 1):
    is_prime = True
    for j in range(2, i):
        if i % j == 0:
            is_prime = False
            break
    if is_prime:
        print(i)

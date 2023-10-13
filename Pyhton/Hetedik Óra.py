# Kérjünk be egy másodfokú egyenlet 3 együtthatóját
# Írjuk ki hány megoldása van a valós számok körében
# Kiírjuk az egyenlet megoldásait
# Mennyi a kétjegyű pűrps számok összege
# Mennyi a 17-el osztható 3 jegyű számok átlaga
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
    print(f"A feladatnak 2 megoldás van az x1={x1} és x2={x2}")
elif d == 0:
    x1 = -b + math.sqrt(d) / (2 * a)
    print(f"A feladatnak 1 megoldás van x1={x1}")
else:
    print("Az x^2 együtthatója nem lehet 0.")

összeg = 0
for i in range(10, 100, 2):
    összeg += i
    # print(i)

print("A kétjegyű páros számok összege: ", összeg)

db = 0
összeg = 0
for i in range(100, 999):
    if i % 17 == 0:
        db += 1
        összeg += i
result = db / összeg * 100
print("{:.2f}".format(result))

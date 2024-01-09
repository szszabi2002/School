import random

n = int(input("Mennyi szám legyen generálva: "))
szamok = []
print("A generált számok:")
for i in range(n):
    szam = random.randint(10, 99)
    szamok.append(szam)
    print(szam)
print("Páros számok: ", end="")
for i in szamok:
    if i % 2 == 0:
        print(i, end=" ")
print()
print("Páratlan számok: ", end="")
for i in szamok:
    if i % 2 != 0:
        print(i, end=" ")
print()
print("A számok összege: ", sum(szamok))
print("A számok átlaga: ", int(sum(szamok) / len(szamok)))

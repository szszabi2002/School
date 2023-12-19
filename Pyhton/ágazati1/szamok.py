import random

n = int(input("Mennyi szám legyen legenerálva: "))
szamok = []
print("A generált számok:")
for i in range(n):
    x = random.randint(10, 99)
    print(x)
    szamok.append(x)
    szamok.sort()
print("Páros számok:", end=" ")
for i in szamok:
    if i % 2 == 0:
        print(i, end=" ")

print("\nPáratlan számok:", end=" ")
for i in szamok:
    if i % 2 != 0:
        print(i, end=" ")
print("\nA számok összege:", sum(szamok))
print("A számok átlaga:", sum(szamok) / len(szamok))

import random

n = int(input("Mennyi húzás legyen: "))
szamok = []
print("A húzott számok:")
for i in range(n):
    szam = random.randint(1, 40)
    szamok.append(szam)
    print(szam)
print("Legendary tárgyak: ", end="")
sorsz = 0
for i in szamok:
    if i % 10 == 0 or i % 5 == 0:
        print(f"{sorsz}:{i}", end=" ")
    sorsz += 1
print()
print(f"Rare tárgyak: ", end="")
sorsz = 0
for i in szamok:
    if i % 5 != 0 and i % 2 != 0:
        print(f"{sorsz}:{i}", end=" ")
    sorsz += 1
print()
print("A húzások összege: ", sum(szamok))
print("A húzások átlaga: ", int(sum(szamok) / len(szamok)))

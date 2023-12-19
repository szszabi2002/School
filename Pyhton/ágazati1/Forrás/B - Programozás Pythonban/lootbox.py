import random

n = int(input("Adj megy egy számot: "))
szamok = []
print("A húzott számok: ")
for i in range(n):
    szam = random.randint(1, 40)
    szamok.append(szam)
    szamok.sort()
    print(szam)
print(f"Legendary tárgyak: ", end="")
sorsz = 0
for i in szamok:
    if i % 5 == 0 or i % 10 == 0:
        print(f"{sorsz}:{i}", end=" ")
    sorsz += 1

import random

n = int(input("Hány számot generáljunk: "))
print("A generált számok: ")
szamok = []
for i in range(n):
    szam = random.randint(100, 999)
    print(szam)
    szamok.append(szam)
print("500-nál kisebb számok: ", end="")
for i in szamok:
    if i < 500:
        print(i, end=" ")
print()
print("500-nál nem kisebb számok: ", end="")
for i in szamok:
    if i > 500:
        print(i, end=" ")
print()
print("A számok összege:", sum(szamok))
print("A számok átlaga:", sum(szamok) / len(szamok))

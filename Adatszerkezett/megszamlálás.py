import random

osztaly = []
for i in range(32):
    osztaly.append(random.randint(152, 190))
print(osztaly)
db = 0
for i in range(len(osztaly)):
    if osztaly[i] < 180:
        db += 1
print(f"Az osztályban 180 cm fölött enyien vannak {db}")

# 2.Feladat
# Esős feladat
napok = []
for i in range(365):
    x = random.randint(0, 1)
    napok.append(x)

db = 0
for i in napok:
    if i == 1:
        db += 1
print("Esős napok száma az évbe:", db)

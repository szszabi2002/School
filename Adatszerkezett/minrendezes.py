import random

szamok = []

for i in range(5):
    szam = random.randint(1, 100000)
    szamok.append(szam)
print(szamok)
for i in range(len(szamok) - 1):
    minimum = 1
    for j in range(i + 1, len(szamok)):
        if szamok[minimum] > szamok[j]:
            minimum = j
    temp = szamok[minimum]
    szamok[minimum] = szamok[i]
    szamok[i] = temp
print(szamok)

import random

szamok = []

for i in range(15):
    szam = random.randint(1, 40)
    szamok.append(szam)
    print(szam, end=" ")
print("")
for i in range(0, len(szamok)):
    for j in range(i + 1, len(szamok)):
        if szamok[i] > szamok[j]:
            temp = szamok[i]
            szamok[i] = szamok[j]
            szamok[j] = temp
print(szamok)

szamok = []

for i in range(15):
    szam = random.randint(1, 40)
    szamok.append(szam)
    print(szam, end=" ")
print("")
for i in range(len(szamok) - 1):
    minimum = i
    for j in range(i + 1, len(szamok)):
        if szamok[minimum] > szamok[j]:
            minimum = j
    temp = szamok[minimum]
    szamok[minimum] = szamok[i]
    szamok[i] = temp

print(szamok)

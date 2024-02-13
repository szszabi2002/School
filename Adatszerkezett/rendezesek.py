from timeit import default_timer as timer
import random
import math

# 1-10-ig feltöltünk egy listát számokal

szamok = []
for i in range(10):
    szamok.append(random.randint(1, 10))

szamok = []
szamok = list(range(1, 11))
print(*szamok)  # Zárójel nélkül
# Cseréljük fel a 2 és a 7 számot
# 1 7 3 4 5 6 2 8 9 10
a = szamok[1]
szamok[1] = szamok[6]
szamok[6] = a

print(*szamok)  # 1 7 3 4 5 6 2 8 9 10
tmp = 0
print(5 / 2)
print(7 / 2)
# Tükrőzés
for i in range(len(szamok) // 2):
    tmp = szamok[i]
    szamok[i] = szamok[len(szamok) - i - 1]
    szamok[len(szamok) - i - 1] = tmp
print(*szamok)

# Vissza forgatjuk
fele = len(szamok) / 2
# meghatározzuk a legnagyobb indexet
maxindex = len(szamok) - 1

for i in range(int(fele)):
    tmp = szamok[i]
    szamok[i] = szamok[maxindex]
    szamok[maxindex] = tmp
    maxindex -= 1

print(*szamok)

# bekérünk egy számot és megnézzük, hogy szimmetrikus-e
x = input("Adj meg egy számot:")
# fel bontjuk a beolvasot számokat karakterenként
betu = []
for i in x:
    betu.append(i)
print(betu)
elso = [1, 2, 3]
masodik = elso
print(masodik)
elso = [4, 5, 6]
print(masodik)

fele = len(betu) // 2

for i in range(int(fele)):
    tmp = betu[i]
    betu[i] = betu[len(betu) - i - 1]
    betu[len(betu) - i - 1] = tmp

print(betu)

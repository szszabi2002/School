# Bekérünk három számot és megnézzük hogy szerkeszthető e?
# Ha szerkeszthető belőle 3-szög akkor az derékszögű-e?
import math
import random


a = int(input("Háromszög egyik oldala: "))
b = int(input("Háromszög másik oldala: "))
c = int(input("Háromszög harmadik oldala: "))
szerkeszthető = False
if a < (b + c) and b < (a + c) and c < (b + a):
    print("Szerkeszthető")
    szerkeszthető = True
    if a**2 + b**2 == c**2 or a * a + c * c == b * b or b * b + c * c == a * a:
        print("Derékszögű!")
else:
    {print("Nem szerkeszthető")}
# Ha szerkeszthető belőle 3 szög akkor számoljuk ki a területét
# Heron képlet
# if szerkeszthető:
#    s = (a + b + c) / 2
#    t = math.sqrt(s(s - a)*(s - b)*(s - c))
#    print(f"A háromszög területe: {t}")
k = input("Jó napod van? (Igen vagy Nem): ")
if k.lower() == "igen":
    print("Remek")
elif k.lower() == "nem":
    print("Sajnálatal hallom")
else:
    print("Sajnos nem értem a válaszodat!")
pvp = int(input("Ajd meg egy számot és megmodnom hogy páros: "))
if pvp % 2 == 0:
    print("Páros")
else:
    print("Páratlan")
# Véletlen szám előállítása

r = random.randint(1, 50)
print(r)

r = random.randint(100, 999)
if r % 3 == 0:
    print("Osztható 3-mal Szám ennyi volt:", r)
elif r % 4 == 0:
    print("Osztható 4-gyel Szám ennyi volt:", r)
elif r % 3 == 0 and r % 4 == 0:
    print("Osztható 3-mal és 4-gyel is Szám ennyi volt:", r)
else:
    print("Sem 3-mal, sem 4-gyel nem osztható! Szám ennyi volt:", r)

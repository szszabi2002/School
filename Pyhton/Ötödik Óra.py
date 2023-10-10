# Ciklusok: iterációk
# előírt lépés számú ciklus megadjuk hányszor fusson le Kulcsszó: For
# Nem előírt lépés számú ciklus nem tudjuk hányszor fog lefutni Kulcsszó: While
# Van olyan csoportosítás hogy elől és hátultesztelős
# ezek enyenértékűek
# For szintaktikája:
# for i in range():
#     ciklusváltozó in tartomány
# A ciklus tőrzse sokszor fog lefutni
# Írjuk ki 10 hogy Dezső
for i in range(10):
    print("Dezső")
# A range 1 paraméterrel (lásd fent) 0-tól a paraméter-1 fut
# fent 0-9 fog futni Soha nem éri el a felsőhatárt
# A Pythonba a tagolás tabulátornyi behuzásal történik.
for i in range(1, 11):
    print(f"{i}. Dezső")

# Írjuk ki a kétjegyű páros számok
for i in range(10, 100):
    if (i % 2 == 0):
        print(i)

for i in range(10, 100, 2):
    print(i)
# Hány db 14-el osztható 3 jegyű szám van?
# Első módszer
db = 0
for i in range(100, 1000):
    if (i % 14 == 0):
        db += 1
print(f"Ennyi darab 14 osztható 3 jegyű szám van: {db}")
#Másik módszer
db = 0
for i in range(112, 1000, 14):
    db += 1
print(f"Ennyi darab 14 osztható 3 jegyű szám van: {db}")

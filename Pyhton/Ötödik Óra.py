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

a = int(input("Adj meg egy egész számot: "))


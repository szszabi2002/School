# Eddig szekvenciát használtunk, utasitások egymás után
# Szelekció (elágazás)
# Ha igaz  egy logikai vizsgálat eredménye akkor végrehajtódik ha pedig hamis akkor valami más fog törtéin
# Felépítése: Kulcsszava az IF; majd logikai állítás; majd utasítások; igaz vagy hamis
# A logikai vizsgálat tratalmaza a Logikai Operátorokat
# Egyenlő: ==
# Kisebb, nagyabobb: < , >
# Kisebb v egyenlő, nagyabobb vagy egyenlő: <= , >=
# Nem egynlő: !=
# Az IF után több logikai vizsgálat lehet az (and) vagy (or)

# Kérjünk be egy nevet és gratuláljunk neki

nev = input("Add meg a neved: ")
if nev == "Dezső" or nev == "DEZSŐ":
    {print("Szép a neved")}
else:
    {print("Miért nem vagy DEZSŐ!")}
# A hamis ágat else kulsszó vezeti be.
# A beljebb kezdődő programrészek összetartóznak

# Bekérünk egy számot és kiírjuk hogy kisseb vagy nagyobb 10.
szam = int(input("Add meg egy számot: "))
if szam < 10:
    print(f"A szám amit beírtál {szam} kisebb mint 10.")
if szam > 10:
    print(f"A szám amit beírtál {szam} nagyobb mint 10.")
# Elálgazásba további elágazosok betehetők ezek csak akkor hajtódnak végre ha az előtük levő hamis.
# Ha elérkezik egy igaz kérdéshez akkor nem fogllkozik az utána lévő elágazásokal
# További elágazés kulcsszav az ELIF
szam = int(input("Add meg egy számot: "))
if szam < 10:
    print(f"A szám amit beírtál {szam} kisebb mint 10. \nEnnyivel: {10-szam}")
elif szam > 10:
    print(f"A szám amit beírtál {szam} nagyobb mint 10. \nEnnyivel: {szam-10}")
else:
    {print(f"A szám amit beírtál {szam} pontosan 10.")}
# Be kérünk egy ket 2 oldalát
# Ha a kert kerülete kisebb mint 1000 m^2-nél akkor írja ki hogy kicsi
# ha 1000-nél nagyobb de 4000-nél kisebb írja ki hogy közepes
# minden más esetbe írka ki hogy nagy
a = int(input("Kert egyik oldala: "))
b = int(input("Kert másik oldala: "))
kerulet = 2 * (a + b)
if kerulet < 1000:
    print("Kicsi mert ", kerulet)
elif kerulet < 4000:
    print("Közepes mert ", kerulet)
else:
    print("Nagy mert ", kerulet)
c = int(input("Adj meg egy számot: "))
if c < 10:
    print("Egyjegyű a szám")
elif c < 100:
    print("Kétjegyű a szám")
elif c < 1000:
    print("Háromjegyű a szám")
else:
    print("Sokjegyű")
x = input("Adj meg egy számot: ")
if len(x) == 1:
    print("1 egy jegy")
elif len(x) == 2:
    print("2 egy jegy")
elif len(x) == 3:
    print("3 egy jegy")
else:
    print("Sok jegyű")
# Len a sztring hosszával tér vissza

# Bekérjük egy háromszög három oldalát döntsük el hogy valóban szerkeszthető e belőle háromszög
a = int(input("Háromszög egyik oldala: "))
b = int(input("Háromszög másik oldala: "))
c = int(input("Háromszög harmadik oldala: "))
if a < (b + c) or b < (a + c) or c < (b + a):
    {print("Szerkeszthető")}
else:
    {print("Nem szerkeszthet")}

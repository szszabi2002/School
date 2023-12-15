def Nev(fajlegysora):
    resz = fajlegysora.split(";")
    return resz[0]


def Kat(fajlegysora):
    resz = fajlegysora.split(";")
    return resz[2]


def Atvalt(arfolyam, ertek):
    return round(ertek / arfolyam, 2)


def Ertek(fajlegysora):
    resz = fajlegysora.split(";")
    return int(resz[1])


with open(
    "C:/Users/szincsak.szabolcs/Documents/GitHub/School/Pyhton/Védett madarak/vedett.txt",
    "r",
    encoding="utf8",
) as in_file:
    beolvas = []
    beolvas = in_file.readlines()
    # print(beolvas)

    adatok = []

    for i in beolvas:
        enternelkul = i.strip()  # a fájl egy sora /n nélkül
        adatok.append(enternelkul)
    # kiírjuk a fájl tartalmát az adatok lista saegítségével
    # for i in adatok:
    #    print(i)

    # a LEN írja ki, hány eleme van egy listának

    print(f"Állatok száma: {len(adatok)}")

    # írjuk ki az összes állat nevét

    # for i in adatok:
    #    print(Nev(i))
    # egy sztringből az első 3 karakter
    # print(Nev(adatok[0])[:3])
    # írjuk ki a 4-6-ig a karaktereket a második sorból
    # print(Nev(adatok[1])[3:6])
    # írjuk ki az utolsó karaktert a 3. sorból
    # print(Nev(adatok[2])[-1])
    # írjuk ki az utolsó 4 karaktert a 4. sorból
    # print(Nev(adatok[1])[-4:])
    print("Sas madarak: ")
    for i in adatok:  # Végig megy a sor összes során
        if Nev(i)[-4::] == "sas":
            print(Nev(i))
    # Írjuk ki az összes olyan állatot, amelynek a nevében szerepel a "sas" szó
    for i in adatok:
        if Nev(i).count("sas") > 0:
            print(Nev(i))
    kategoria = input("Rendszertani kategória: ")
    db = 0
    for i in adatok:
        if Kat(i) == kategoria.lower():
            db += 1
    print(f"Ebbe a kategóriába tartozó állatok száma: {db}")
    # forintba számolunk végig és a végén váltunk euróra
    arfolyam = 400
    # Először végig FT-ban számolunk
    osszeg = 0
    # kiszámoljuk, hogy mennyit érnek az állatok összesen
    for i in adatok:
        osszeg = osszeg + Ertek(i)
    # kiszámoljuk az átlagot
    atlag = osszeg / len(adatok)
    # kiírjuk euroban:
    print(f"Az állatok átlagos eszmei értéke: {Atvalt(arfolyam,atlag)} EUR")

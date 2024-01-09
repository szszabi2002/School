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
    "C:/Users/szincsak.szabolcs/Documents/GitHub/School/Pyhton/Python feladat ágazati vizsgára/vedett.txt",
    "r",
    encoding="utf8",
) as in_file:
    beolvas = []
    beolvas = in_file.readlines()
    # print(beolvas)

    adatok = []

    for i in beolvas:
        enternelkul = i.strip()
        adatok.append(enternelkul)
    print(f"Állatok száma: {len(adatok)}")
    print("Sas madarak: ")
    for i in adatok:
        if Nev(i)[-4:] == " sas":
            print(Nev(i))
    kategoria = input("Rendszertani kategória: ")
    db = 0
    for i in adatok:
        if Kat(i) == kategoria.lower():
            db += 1
    print(f"Ebbe a kategóriába tartozó állatok száma: {db}")
    arfolyam = 400
    osszeg = 0
    for i in adatok:
        osszeg = osszeg + Ertek(i)
    atlag = osszeg / len(adatok)
    print(f"Az állatok átlagos eszmei értéke: {Atvalt(arfolyam,atlag)} EUR")

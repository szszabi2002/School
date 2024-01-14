def Cim(sor):
    x = sor.split(";")
    return x[0]


def Evszam(sor):
    x = sor.split(";")
    return int(x[1])


def Bevetel(sor):
    x = sor.split(";")
    return float(x[2])


def dollarToEuro(arfolyam, ertek):
    return round(arfolyam * ertek, 2)


with open(
    "C:/Users/szsza/OneDrive/School/School/Pyhton/ágazati1/Forrás/B - Programozás Pythonban/movies.txt",
    "r",
    encoding="utf8",
) as in_file:
    beolvas = in_file.readlines()
    # print(beolvas)
    adatok = []
    for i in beolvas:
        sor = i.strip()
        adatok.append(sor)
    print("Filmek száma:", len(adatok))
    print("Love szó szerepel a film nevében:")
    for i in adatok:
        if "love" in Cim(i).lower():
            print(Cim(i))
    ahatar = int(input("Alsó határ: "))
    fhatar = int(input("Felső határ: "))
    szaz = 0
    if fhatar < ahatar:
        print("Hibás bevitel")
    else:
        for i in adatok:
            if ahatar <= Evszam(i) <= fhatar and Bevetel(i) >= 100:
                szaz += 1
    print("100 millió dollár feletti bevétel:", szaz)
    with open(
        "C:/Users/szsza/OneDrive/School/School/Pyhton/ágazati1/Forrás/B - Programozás Pythonban/100felett.txt",
        "w",
        encoding="utf8",
    ) as out_file:
        for i in adatok:
            if ahatar <= Evszam(i) <= fhatar and Bevetel(i) >= 100:
                out_file.write(Cim(i) + "\n")

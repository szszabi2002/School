def Nev(x):
    sor = x.split(";")
    return sor[0]


def Vasutszam(x):
    sor = x.split(";")
    return sor[1]


def Tavolsag(x):
    sor = x.split(";")
    return sor[2]


def ar(tav):
    ar = (tav // 100) * 2200 + (tav % 100) * 18
    return ar


adatok = []
with open(
    "C:/Users/szincsak.szabolcs/Desktop/Ágazati_2024/Megoldás/programozás/forras.txt",
    "r",
    encoding="utf8",
) as file:
    for sor in file:
        sor = sor.strip()  # or some other preprocessing
        adatok.append(sor)

    print("Sorok száma:", len(adatok), "\n")
    print("Nagy települések: ")
    for i in adatok:
        if Nev(i).count(" felső") == 1:
            print(Nev(i))
    print()
    varos = input("Adj meg egy várost: ")
    for i in adatok:
        if Nev(i).lower() == varos.lower():
            print(f"Ez a város: {Nev(i)} ezen a vonalon van: {Vasutszam(i)}")
            print(f"És ezen a vonalon 55 állomás található")
    print()
    print(
        "A város sora, melynek neve a távoli repository változásainak letöltését jelenti:"
    )
    for i in adatok:
        if Nev(i).count("Pull") == 1:
            print(i)
    print()

    for i in adatok:
        print(f"{i};{ar(int(Tavolsag(i)))} Ft")

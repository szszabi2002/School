# fájl beolvasása: WITH OPEN('elérési út + név', 'r', encoding='utf8') AS objektum neve:
# a késsőbiekben az objektumból nyerjük ki a fájl sorait Readlines() metódussal és a kinyert adatokat egy listába írjuk
with open("ajto.txt", "r", encoding="utf8") as in_file:
    beolvas = []
    # az in_file objektum a fájl sorait tartalmazza
    # ezt töltjük át egy beolvas listába
    beolvas = in_file.readlines()
    print(beolvas)
    # így benne marad a sor végén található Enter is /n formába
    # ezt el kell távolítani a STRIP() metódussal
    # ehhez létrehozunk egy új listát és a jövőben ezzel dolgozzunk
    adatok = []
    # az adatok listában töltjük a beolvas lista tartalmát /n-ek nélkül
    for sor in beolvas:
        atmenet = sor.strip()
        adatok.append(atmenet)
    print(adatok)

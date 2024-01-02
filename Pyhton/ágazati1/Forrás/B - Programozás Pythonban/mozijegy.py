egysegar = int(input("Mozijegy egységár: "))
darabszam = int(input("Darabszám: "))
if egysegar < 10000:
    print("Jegy ára: ", egysegar)
    print("Darabszám: ", darabszam)
    print("Fizetendő összeg: ", egysegar * darabszam + 500)
    print(
        "Kedvezményes ár: ",
        (egysegar * darabszam + 500) - (10 * (egysegar * darabszam + 500) / 100),
    )
else:
    print("Jegy ára: ", egysegar)
    print("Darabszám: ", darabszam)
    print("Fizetendő összeg: ", egysegar * darabszam + 500)
    print(
        "Kedvezményes ár: ",
        (egysegar * darabszam + 500) - (15 * (egysegar * darabszam + 500) / 100),
    )

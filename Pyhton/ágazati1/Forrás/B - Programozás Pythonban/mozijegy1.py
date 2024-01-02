ar = int(input("Jegy ára: "))
db = int(input("Darabszám: "))
fizetendo = ar * db + 500
if fizetendo < 10000:
    print("Jegy ára:", ar)
    print("Darabszam:", db)
    print("Fizetendő összeg:", fizetendo, "Ft")
    print("Kedvezményes ár:", int(fizetendo * 0.9), "Ft")
else:
    print("Jegy ára:", ar)
    print("Darabszam:", db)
    print("Fizetendő összeg:", fizetendo, "Ft")
    print("Kedvezményes ár:", int(fizetendo * 0.85), "Ft")

ar = int(input("Jegy ára: "))
db = int(input("Darabszám: "))
fizetendo = ar * db + 500
print("Fizetendő összeg:", fizetendo, "Ft")
if fizetendo <= 10000:
    print("Kedvezményes ár:", int(fizetendo * 0.9), "Ft")
else:
    print("Kedvezményes ár:", int(fizetendo * 0.85), "Ft")

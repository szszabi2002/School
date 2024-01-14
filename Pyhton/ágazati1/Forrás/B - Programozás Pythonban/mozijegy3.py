ar = int(input("Jegy ára: "))
db = int(input("Darabszám: "))
osszeg = ar * db + 500
print(f"Fizetendő összeg: {osszeg} Ft")
if osszeg <= 10000:
    print(f"Kedvezményes ár: {int(osszeg*0.90)} Ft")
else:
    print(f"Kedvezményes ár: {int(osszeg*0.85)} Ft")

szam = -1
while szam < 0:
    szam = int(input("Adj meg egy számot: "))
oszto = 2
i = 1
while szam > 1:
    while szam % oszto == 0:
        print(f"{i}.", oszto)
        szam = szam / oszto
        i += 1
    oszto += 1

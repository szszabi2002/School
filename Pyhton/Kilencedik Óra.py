# hozzuni létre egy 10-es szorzótáblát
for i in range(0, 11):
    print(f"{i}x10=", i*10)
# bekérünk egy számot és kiírjuk hogy prím-e
a = int(input("Adj meg egy számot és kiírjuk a prímeket addig a számig: "))
is_Prime = False
if (a >= 2):
    for i in range(2, a+1):
        is_Prime = True
        for j in range(2, i):
            if (i % j == 0):
                is_Prime = False
                break
else:
    print("A szám nem lehet kisebb 2-nél")

if (is_Prime):
    print(f"A szám {a} prím")
else:
    print(f"A szám {a} nem prím")
# bekérünk egy számot és kiírjuk a prímeket addig a számig
a = int(input("Adj meg egy számot és kiírjuk a prímeket addig a számig: "))
is_Prime = False
if (a >= 2):
    for i in range(2, a+1):
        is_Prime = True
        for j in range(2, i):
            if (i % j == 0):
                is_Prime = False
                break
        if (is_Prime):
            print(f"{i}, ", end="")
else:
    print("A szám nem lehet kisebb 2-nél")
print()
# Listák összetet adatszerkezet, tratalmazhatja bármely típúst
# általábban több elemet tartalmazhat egyszere ás ezekre az elemekre
# INDEX haszálatával hívatkozhtunk
# az index minding 0-val kezdődnek és [] -ben vannak
# Üres lista  deklalárása: []
# hivatkozás az lista első elemére lista[0]
# hivatkozás az lista 10. elemére lista[9]
# sztringek valójában karakterek listája hivatkozhatok index
# akármelyik karakter

nev = "Kiss Dezső"
# Vegyük ki a névből az ő-betüt
print(nev[9])
print(nev[-1])

# Írjuk ki q z betűt és az i betűt
print(nev[-3], nev[1])
# Részeket is kiemelhetünk a lístából
print(nev[1:3])
# Írjuk ki a KISS és a Dezsőt indexekel
print(nev[0:4])
print(nev[5:10])

# print(nev[11])
# Írjuk ki hogy a s De
print(nev[3:7])

print(nev[:4])  # elejétől a 3 indexig

print(nev[5:])  # 5 indextől a végéig

# Kiírjuk minden 2. 3. n-dik elemet is minetha ciklussal írnm ki
# ennek a jele a ::

print(nev[0::2])

# írjuk ki at összes páros elemet
print(nev[1::2])

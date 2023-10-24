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
                print(i)
else:
    print("A szám nem lehet kisebb 2-nél")

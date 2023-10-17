# Mennyi a 7-el osztható 3 jegyű számok átlaga
db = 0
osszeg = 0
for i in range(100, 1000):
    if i % 7 == 0:
        db += 1
        osszeg += i
print(osszeg / db)
# Beolvassunk egy számot és kiírjuk osztóit
a = int(input("Ajd megy egy számot és megmodom az osztóit: "))
for i in range(1, a + 1):
    if a % i == 0:
        print(i)
# Beolvasunk egy számot és kiírjuk hogy prim vagy összetet szám
b = int(input("Adj meg egy számot és megmondom hogy prim e: "))


if b > 2 and not any([True for x in range(2, b // 2 + 1) if b % x == 0]):
    print(f"{b} prim szám")
else:
    print(f"{b} összetett szám")

# if b > 2:
#    for i in range(2, (b % 2)+1):
#        if (b % i == 0):
#            print(f"{b} összetett szám")
#            break
#    else:
#        print(f"{b} prim szám")
# else:
#    print(f"{b} összetett szám")
#
db = 0
for i in range(1, b + 1):
    if a % i == 0:
        db += 1
if db == 2:
    print("prim")
else:
    print("össetett")
# Beolvasunk egy számot és eldöntjük róla hogy tökéletes szám e?
# A tökéletes számok osztóinak az összege a szám kétszeresével
c = int(input("Adj meg egy számot és megmondom hogy tökéletes szám e: "))
osztoksum = 0
for i in range(1, c + 1):
    if c % i == 0:
        osztoksum += i
if osztoksum == (c * 2):
    print(c, "tökéletes szam")
else:
    print(c, "nem tökéletes szam")

# Egymásba ágyazott ciklusok
# ha két ciklus egymásba ágyazzunk az egyiket külsö ciklusnak a másikat pedig belső ciklusnak nevezzük
# a külső ciklus minden egyes lépésnél a teljes a belső ciklusra lép
# Kérjünk be egy számot és rajzoljunk ki egy csillagból egy ilyen oldalu négyzetet
oldal = int(input("Adj egy számot 1 és 10 között: "))
# Egymás mellé
for i in range(oldal):
    print("*")
# Egymás allá
for i in range(oldal):
    print("*", end="")
print("\n")
for i in range(oldal):
    print()
    for j in range(oldal):
        print("*\t", end="")
print("\n")
# Beolvasunk két számot és csinálunk *-ból téglalapot
x = int(input("Adj egy számot 1 és 10 között: "))
y = int(input("Adj egy számot 1 és 10 között: "))
for i in range(x):
    print()
    for j in range(y):
        print("*\t", end="")
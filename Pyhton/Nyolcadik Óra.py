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
b = int(input("Adj meg egy számot:"))


if b > 2 and not any([True for x in range(2, b // 2 + 1) if b % x == 0]):
    print(f"{b} prim szám")
else:
    print(f"{b} összetett szám")

if b > 2:
    for i in range(2, (b % 2)+1):
        if (b % i == 0):
            print(f"{b} összetett szám")
            break
    else:
        print(f"{b} prim szám")
else:
    print(f"{b} összetett szám")
db = 0
for i in range(1, b + 1):
    if a % i == 0:
        db += 1
if db == 2:
    print('prim')
else:
    print('össetett')

# 1.Feladat
x = int(input("Adj meg egy pontszámot és memondom az érdem jegyet: "))
if x < 50:
    print(f"A {x} pontszám érdemjegy: 1")
elif 50 <= x < 60:
    print(f"A {x} pontszám érdemjegy: 2")
elif 60 <= x < 70:
    print(f"A {x} pontszám érdemjegy: 3")
elif 70 <= x < 85:
    print(f"A {x} pontszám érdemjegy: 4")
else:
    print(f"A {x} pontszám érdemjegy: 5")

# 2.Feladat
eszam = int(input("Adj meg egy pozitív egész számot: "))
for i in range(1, eszam):
    if i % 3 == 0:
        print(i)

# 3.Feladat
A = float(input("Adj meg egy valós számot: "))
K = int(input("Adj meg egy egész számot: "))
hatvany = 1
for i in range(K):
    hatvany *= A
print("Az A^K érték:", hatvany)

# 4.Feladat
szamok = []
while True:
    szam = int(input("Adj meg egy pozitív számot: "))
    if szam == 0:
        break
    szamok.append(szam)

for szam in szamok[::-1]:
    print(szam)

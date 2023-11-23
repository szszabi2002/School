def koszont(n):
    print(f"Szia kedves {n}")


def mondatszavak(m):
    print(f"A mondatban {len(m.split())} szót tartalmaz.")


def mondatszavak1(m):
    reszek = m.split(" ")
    return len(reszek)


# Nem előírt lépésszámú előltesztelő ciklus: While
# szintaktikailag while logikai kiértékelés: ciklustörzs
# csak akkor lép a ciklustörzsbe, ha a kiértékelés eredménye Igaz
# A ciklusváltozónak a ciklus törzsében általában új értéket kell kapnia
# ha nem kap új értéket, akkor végtelen ciklust írtunk!
# Írjuk ki 1-től 10-ig a számokat
for i in range(10):
    print("A jelenlegi szám:", i + 1)

i = 1
while i <= 10:
    print(i)
    i += 1
# Írjuk ki a 2 jegyű páros számokat While ciklussal
print(" ")
num = 10
while num < 100:
    print(num)
    num += 2
# Kérjünk be a felhasználó jelszavát és euz egészen addig tegyük, amíg jó jelszót nem ír be
password = ""
count = 0
while password != "Dezső":
    password = input("Adja meg a jelszót:")
    count += 1
if count < 5:
    print("Ügyes vagy csak ennyi próbálkozásba került: ", count)
else:
    print("Gyakorolj még mert csak ennyi próbálkozásba került: ", count)
# Kérjünk be egy 11-gyel osztható számot és csak akkor fogadjuk el ha osztható
number = 1
while number % 11 != 0:
    number = int(input("Kérem adja meg az osztható számot:"))
print("Ügyes vagy")

szam = int(input("Kérem adja meg az osztható számot:"))
while szam <= 0:
    szam = int(input("Nem megfelelő szám. Adjon meg egy pozitív számot."))
print("Ügyesebb vagy")

# Adj meg egy legalább 5 szóból álló mondatott majd írd ki hogy karakterből áll és hány szóból
mondat = input("Kérek egy mondatot: ")
karakterek = len(mondat)
szavak = len(mondat.split())
while szavak < 5:
    mondat = input(
        "Nem megfelelő mondat. Adjon meg egy legalább 5 szóból álló mondatott: "
    )
    szavak = len(mondat.split())
karakterek = len(mondat)
szavak = mondat.split()
print(f"A mondatban {karakterek} karakter van és ennyi {len(szavak)} szót tartalmaz.")
# Írd le az első szót csupa nagy betűvel a másodikat csupa kicsi karakterel
print(
    f"Az első szó csupa nagybetűvel: {szavak[0].upper()}\nA második szó csupa kiss betűvel: {szavak[1].lower()}\nA harmadik szó {szavak[2].capitalize()}"
)
# Írjuk ki a 4. szót
print(f"A negyedik szó: {szavak[3]}")
# Írjuk ki az öttödik szó második karakterét
print(f"Az ötödik szó harmadik karaktere: {szavak[4][2]}")
# Írjuk ki a harmadik szó páratlan számú karaktereit
print(f"A harmadik szó páratlan számú karaktere: {szavak[2][::2]}")

# Függvények
# A gyakkran végrehajtandó müveleteket szervezzünk ki függvényekbe, segítségükkel sokkal általábban és szerkeszthetőbb lesz a kód
# Kulcss szava: DEF (def)
# A fv-nek vagy van visszatérési értéke, ekkor kell kell RETURN visszatérési értéke, ekkor általábban kiírunk valamit
# A fv-et általábban a program ELEJÉN helyezzük el ez nem kötelező de erősen ajánlot
# fv-ek vannak paraméterei is
# Kérjük be a felhasználó nevét majd kösszöntsük függvény segítségével
nev = input("Kérem adjon nevet:")
# A fv meghícása a nevének a begépelésével és a paraméter átadássával történik
print(nev)
koszont("Jolán")
koszont("Rozál")
koszont("Csoki manó és társai")
# Kérjük be egy mondatot és írjuk ki hány szóból áll függvényel
mondatok = input("Kérek egy mondatot: ")
mondatszavak(mondatok)

# Nezzünk olyan fv, ami a hívás helyére vissza ad értéket és ezt az értéket ott kell feldolgoznunk

# Folytassuk az előző példát annyi külömbséggel hogy a fv nem írja ki a szavak számát hanem a hívás helyán kell gondoskodni róla
print(f"A mondat szavainak száma: {mondatszavak1(mondatok)}")

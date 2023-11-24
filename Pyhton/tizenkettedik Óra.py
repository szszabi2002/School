szamok = [10, 9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
# Számokat tartalmazó listák kezelése
# Elemek összeadása: SUM
print(sum(szamok))
# Az elemek száma: LEN
print(len(szamok))
# A legnagyobb elem: MAX
print(max(szamok))
# A legkisebb elem: MIN
print(min(szamok))
# Az elemek átlaga: SUM/LEN
print(sum(szamok) / len(szamok))
# Lista elemek sorbarendezése: SORTED
print(sorted(szamok))

# A lista tartalmaza-e egy bizonyos elemet (Nem csak számoknál műkődik)
# Ezt a tartmazást a COUNT (Keresett elem) metódussal kérdezzük le egy számot
# Ha a szám 0-a akkor NEM TARTALMAZZA a LISTA
# HA nem 0-a akkor az azt jelenti hogy ennyiszer van a listába
# ELÁGAZÁSBAN szoktuk használni (nezzük meg hogy a 6-os a listában van-e)
if szamok.count(6) != 0:
    print("A listában szerepel a 6-os")
# A listához az APPEND paranccsal tudunk új elemet adni
# adjuk hozzá a 11-es és 12-es számokat a listához
szamok.append(11)
szamok.append(12)
# Lista kiírása egy sorba [] között
print(szamok)
# Lista kiírása kifejtve [] nélkül a * karakter használatával
print(*szamok)
# Lista elemeinek kiírása egymás alá ciklusba
for i in szamok:
    print(i)
# Kiírásban a sorvégi enter lecserélése vesszőre
for i in szamok:
    print(i, end=", ")
# Lista eleminek a törlése: CLEAR()
szamok.clear()
print()
print(szamok)
# Lista törlése II. létrehuzunk azonos névvel egy új üres listát
szamok = []


# Hozzunk létre egy fv.-t ami kiírja 2 szám összegét és külömbségét a paraméter cs a fv. törzsében létezik
# Ez a kód elejére kerül
def muvelet(x, y):
    print(f"{x} + {y} = {x+y}")
    print(f"{x} - {y} = {x-y}")


muvelet(10, 2)
muvelet(8, 11)
muvelet(7, 3)


# Írjunk meg a kivonó fv-t úgy hogy értéket adjon vissza és a visszaadott értékkel a hívó helyén dolgoza fel
# Ez is az elejére kell
def kulonbseg(a, b):
    return a - b


print(kulonbseg(20, 5))
# Kapja meg egy változó
x = kulonbseg(15, 8)
print(x)


def hatvany(a, b):
    return a**b


print(hatvany(3, 4))


# Négyzetgyök fv.
def gyok(gy):
    return gy**0.5


print(gyok(16))

# A fv-ek egymásba is lehet őket ágyazni. A kiértékelés minding belülről kifelé történik
print(gyok(gyok(16)))
print(hatvany(5, gyok(gyok(625))))


# Írjunk fv.-t ami a megkapott szöveget kiírja visszafelé
def vissza(s):
    print(s[-1::-1])


vissza("HEllO Dezső!")

# Írjunk fv anu 3 számot kap és kiírja ezekből hogy ezekből lehet e háromszöget szerkeszteni (Igaz/Hamis)


def szerkesztheto(a, b, c):
    return a < (b + c) and b < (a + c) and c < (b + a)


print(szerkesztheto(3, 3, 4))
print(szerkesztheto(15, 3, 4))
x = 5
y = 6
z = 17
if szerkesztheto(x, y, z):
    print("Szerkeszthető háromszög")
else:
    print("Nem szerkeszthető háromszög")

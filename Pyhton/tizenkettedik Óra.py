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

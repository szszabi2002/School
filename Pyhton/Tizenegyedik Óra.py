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
print("Ügyes vagy csak ennyi próbálkozásba került: ", count)
# Fogadja el a Dezső-t és Rozál-t Jelszónak

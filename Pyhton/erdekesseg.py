a = -1
b = -1
c = -1
while a <= 0:
    a = -int(input("Add meg az 'A' oldalát (Legyen 0-nál nagyobb): "))
    if a <= 0:
        print("Negatív számot adtál meg")
while b <= 0:
    b = int(input("Add meg az 'B' oldalát (Legyen 0-nál nagyobb): "))
    if b <= 0:
        print("Negatív számot adtál meg")
while c <= 0:
    c = int(input("Add meg az 'C' oldalát (Legyen 0-nál nagyobb): "))
    if c <= 0:
        print("Negatív számot adtál meg")
print(a)
print(b)
print(c)
if a**2 + b**2 == c**2 or c**2 + b**2 == a**2 or c**2 + a**2 == b**2:
    print("Szerkeszthető")
else:
    print("Nem szerkeszthető")

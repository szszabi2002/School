# Kérjünk be 3 számot téglatest felszinét, térfogat,
a = int(input("A oldala: "))
b = int(input("B oldala: "))
c = int(input("C oldala: "))
print("Térfogat:", a * b * c, "cm^3")
print("Felszine:", 2 * (a * b + a * c + b * c), "cm^2")

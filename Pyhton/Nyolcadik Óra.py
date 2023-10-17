# Mennyi a 7-el osztható 3 jegyű számok átlaga
db = 0
osszeg = 0
for i in range(100, 1000):
    if i % 7 == 0:
        db += 1
        osszeg += i
print(osszeg / db)
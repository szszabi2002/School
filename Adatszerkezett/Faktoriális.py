def ifak(n):
    f = 1
    for i in range(1, n + 1):
        f = f * i
        print(f)


n = int(input("Enter a number:"))
ifak(n)  # Limit 1558


def faktor(n):
    if n < 1:
        return 1
    else:
        return n * faktor(n - 1)


print("\nFactorial of", n, "is", faktor(n))  # Limit 989

import random

szamok = []
for i in range(5):
    szam = random.randint(1, 100000)
    szamok.append(szam)
    print(szamok)


def gyors(lista, kezdo, veg):
    i = kezdo
    j = veg
    pivot = lista[(kezdo + veg) // 2]
    while i <= j:
        while lista[i] < pivot:
            i += 1
        while lista[j] > pivot:
            j -= 1
        if i <= j:
            tmp = lista[i]
            lista[i] = lista[j]
            lista[j] = tmp
            i += 1
            j -= 1
    if kezdo < j:
        gyors(lista, kezdo, j)
    if i < veg:
        gyors(lista, i, veg)


lista = [10, 120, 3, 4, 50, 6, 7, 8, 9, 10]

gyors(lista, 0, len(lista) - 1)

print("Sorted list:\n")
print(lista)

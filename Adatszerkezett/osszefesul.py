import random


def mergeSort(myList):
    if len(myList) > 1:
        mid = len(myList) // 2
        left = myList[:mid]
        right = myList[mid:]

        # Rekurzívan meghívjuk mindkét részlistára a fv-t
        mergeSort(left)
        mergeSort(right)

        # A két félre létrehozunk két ciklusváltozót
        i = 0
        j = 0

        # A fő lista ciklusváltozója
        k = 0

        while i < len(left) and j < len(right):
            if left[i] <= right[j]:
                # A bal oldali félből tesszük a listába az értéket
                myList[k] = left[i]
                i += 1
            else:
                myList[k] = right[j]
                j += 1

            k += 1

        # a kimaradt elemeket hozzáadjuk a listához
        while i < len(left):
            myList[k] = left[i]
            i += 1
            k += 1

        while j < len(right):
            myList[k] = right[j]
            j += 1
            k += 1


sz = []
for i in range(5):
    x = random.randint(1, 100)
    sz.append(x)
print(sz)
print()
mergeSort(sz)
print(sz)

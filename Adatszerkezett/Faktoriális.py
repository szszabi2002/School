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

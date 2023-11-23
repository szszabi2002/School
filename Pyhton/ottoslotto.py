import random


# random number generator 5 number between 0-100 but don't be any duplicate number
lotto = []

while len(lotto) < 5:
    num = random.randint(1, 90)
    if lotto.count(num) == 0:
        lotto.append(num)

print(sorted(lotto))

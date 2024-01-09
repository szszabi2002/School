irasbeli = int(input("Írásbeli eredmény: "))
szobeli = int(input("Szóbeli eredmény: "))
if irasbeli + szobeli >= 30:
    print(f"A vizsga sikeres, eredmény: {(irasbeli + szobeli) * 2}%")
else:
    print("A vizsga sikertelen.")

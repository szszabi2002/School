elmelet = int(input("Az elméleti vizsga eredménye (0-80): "))
gyakorlat = int(input("A gyakorlati vizsga eredménye (0-120): "))
osszeg = elmelet + gyakorlat
if osszeg >= 120:
    print(f"A vizsgazó összesen: {osszeg} pontot szerzett")
    print("Az elméleti vizsga eredménye:", elmelet)
    print("A gyakorlati vizsga eredménye:", gyakorlat)
    print(f"A vizsga sikeres: {osszeg/200 * 100}%")
else:
    print(f"A vizsgazó összesen: {osszeg} pontot szerzett")
    print("Az elméleti vizsga eredménye:", elmelet)
    print("A gyakorlati vizsga eredménye:", gyakorlat)
    print(f"A vizsga sikertelen!")

# Ha igazi aranyból lenne a labda Hány kg?
# Labda max. kerület 71cm.
# Labda sugara: 2*r*pi = kerület.
k = 71
r = k / (2 * 3.14)
v = (4 * r**3 * 3.14) / 3
m = v * 19.3
print(f"A labda: {m/1000:.2f} kg.")

k = float(input("Add meg a labda kerületét (cm): "))
fajsuly = float(input("Add meg a test anyagának fajsúlyét (g/köbcenti): "))
r = k / (2 * 3.14)
v = (4 * r**3 * 3.14) / 3
m = v * fajsuly
print(f"A labda: {m/1000:.2f} kg.")

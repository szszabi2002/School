console.log("hello")
const bevasarloLista = [
    { mit: "alma", mennyit: 1, mertekEgyseg: "kg" },
    { mit: "liszt", mennyit: 2, mertekEgyseg: "kg" },
    { mit: "tej", mennyit: 6, mertekEgyseg: "l" },
    { mit: "sonka", mennyit: 25, mertekEgyseg: "dkg" }
];
const matrix = [
    [1, 3, 3],
    [1, 1, 2],
    [3, 2, 2]
];
const darabok = {
    "1": 0,
    "2": 0,
    "3": 0
};
for (let sor of matrix) {
    for (let ertek of matrix) {
        darabok[ertek] += 1;
    }
};

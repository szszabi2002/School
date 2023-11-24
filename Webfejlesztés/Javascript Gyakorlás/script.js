/*
JS alapok
    Változók típusa 
        - Number
        - String
        - Booleen
        - Object (Objektum)
        - Function (Függvény)
        - Array (Tömb)
        - Null
        - Undefined    
    DOM = Document Object Model
    DOM Függvények:
            document.getElementById
            document.getElementByName
            document.getElementByClass
            ...
            Tulajdonságai:
                value
                innerHTML
    
    Sztring típus:
        'Ez egy szöveg'
        "Ez egy szöveg"
        ""Ez egy idézet"" Hibás
        '"Ez egy idézet"'
        "'Ez egy idézet'"

        "It's a string"
        'It\'s a string'
        'It\\\'s a string'

        "\"Ez egy idézet\""
    
    Változók hatóköre
        for(let i = 0; i<5; i++){
            console.log(i);
        }

        i = 12
        for(let i = 0; i<5; i++){
            console.log(i);
        }
        console.log(i)
    Függvények paraméterei
        Paraméter nélküli:
            Pl.: function szamol(){}
        Paramétres:
            Pl.: function osszead(szamA, szamB){osszeg= szamA+szamB;return osszeg;}
            osszead(2,3)
*/
function szamitas() {
    var szam1 = Number(document.getElementById("szam1").value);
    var szam2 = Number(document.getElementById("szam2").value);
    document.getElementById("eredmeny").innerHTML = szam1 + szam2;
}

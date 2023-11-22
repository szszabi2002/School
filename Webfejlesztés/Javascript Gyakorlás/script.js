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

*/
function szamitas() {
    var szam1 = document.getElementById("szam1").value;
    var szam2 = document.getElementById("szam2").value;
    var eredmeny = szam1 * 1 + szam2 * 1;
    document.getElementById("eredmeny").innerHTML = eredmeny;
}

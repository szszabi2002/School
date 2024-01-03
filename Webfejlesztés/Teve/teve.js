/*Ha a tevék számánál 5, a struccok számánál pedig 19 érték szerepel, akkor a minta
szerinti helyen a parancsgomb mellett jelenjen meg a „Helyes! 5 teve és 19 strucc”
szöveg! Ügyeljen rá, hogy ez a felirat más esetben ne látszódjon a weboldalon!*/
function szamol() {
    var Teve = document.getElementById("teve").value;
    var Struccs = document.getElementById("strucc").value;
    if (Teve == 5 && Struccs == 19) {
        document.getElementById("megoldas").innerHTML = "Helyes! 5 teve és 19 strucc";
    }
    else {
        document.getElementById("megoldas").innerHTML = "";
    }
}


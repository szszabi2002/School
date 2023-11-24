/**
 * Cikluskódok generálása
 */

function $(id) {
    return document.getElementById(id);
}


function general() {
    var kodszovege = ""
    var varos = document.getElementById('varosok').value;
    kodszovege += varos + "\n";

    var szam = document.getElementById('szamok').value;
    kodszovege += (szam * 500) + "\n";


    if (document.getElementById('rb1').checked == true)
        kodszovege += "While";
    if (document.getElementById('rb2').checked == true)
        kodszovege += "Do";
    if (document.getElementById('rb3').checked == true)
        kodszovege += "For";

    document.getElementById("kod").innerHTML = kodszovege;


    var fkod = "";
    var szam1 = $('szamok').value;
    var szam2 = $('szamok2').value;
    var rel = $('relacio').value;

    fkod = szam1 + rel + szam2;
    $('kod2').innerHTML = "";
    $('kod2').innerHTML += fkod + " <- ";
    $('kod2').innerHTML += eval(fkod) + "\n";

    var kod3 = 'for (var i = 0; i < 10; i++) { $("kod2").innerHTML += i +" ";};';
    eval(kod3);


    /*for (var i = 0; i < 10; i++) {
     $('kod2').innerHTML += i + ' ';
     }*/


}



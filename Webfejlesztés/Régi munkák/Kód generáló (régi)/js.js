function $(id) {
    return document.getElementById(id);
}
function generalas() {
    var kodsz = "";
    var fkod = "";
    var szam1 = $('szam1').value;
    var szam2 = $('szam2').value;
    var szam3 = $('szam3').value;
    var relacio = $('relacio').value;
    var lepeskoz = $('lepeskoz').value;
    if ($('rb1').checked === true) {
        kodsz += "while(";
    }
    else if ($('rb2').checked === true) {
        kodsz += "do";
    }
    else if ($('rb3').checked === true) {
        kodsz += 'for(var i = " + szam1 + "; i " + relacio + " " + szam2 + "; i = " + lepeskoz + " " + szam3 + ")\n{\n    fkod += i + " ";\n\n}';
    }
    else {
        alert("Nem választotál típust!")
    }

    $('kod').innerHTML = eval(fkod);
    //eval(fkod);
}
    /*var város = $('varosok').value;
var számok = $('szamok').value;
kodsz += "\t" + város + "\t" + számok * 500;
var fkod = "";
var relacio = $('relacio').value;
fkod +=kodsz+relacio;
$('kod2').innerHTML="";
$('kod2').innerHTML+=eval(fkod);
document.getElementById('kod').innerHTML = kodsz;*/
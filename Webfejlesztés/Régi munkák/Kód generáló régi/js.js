function $(id) {
    return document.getElementById(id);
}
function generalas() {
    var kodsz = "";
    var szam1 = $('szam1').value;
    var szam2 = $('szam2').value;
    var szam3 = $('szam3').value;
    var relacio = $('relacio').value;
    var lepeskoz = $('lepeskoz').value;
    if ($('rb1').checked === true) {
        kodsz += 'while(i' + relacio + szam2 + ')\n{\n\t$("eredmeny").innerHTML += i + "<br>";\n\ti' + lepeskoz + '=' + szam3 + ';\n}';
    }
    else if ($('rb2').checked === true) {
        kodsz += 'do\n{\n\t$("eredmeny").innerHTML += i + "<br>";\n\ti' + lepeskoz + '=' + szam3 + ';\n} while (i' + relacio + szam2 + ');';
    }
    else if ($('rb3').checked === true) {
        kodsz += 'for(var i = ' + szam1 + '; i ' + relacio + ' ' + szam2 + '; i = ' + lepeskoz + szam3 + ')\n{\n    $("eredmeny").innerHTML += i + "<br>";\n}';
    }
    else {
        alert("Nem választotál típust!")
    }
    $('kod').innerHTML = kodsz;

}
function futtat() {
    var fkod = "";
    var szam1 = $('szam1').value;
    var szam2 = $('szam2').value;
    var szam3 = $('szam3').value;
    var relacio = $('relacio').value;
    var lepeskoz = $('lepeskoz').value;
    if ($('rb1').checked === true) {
        var i = szam1;
        fkod = 'while(i' + relacio + szam2 + ')\n{\n\t$("eredmeny").innerHTML += i + "<br>";\ni' + lepeskoz + '=' + szam3 + ';\n}';
    }
    else if ($('rb2').checked === true) {
        var i = szam1;
        fkod = 'do\n{\n\t$("eredmeny").innerHTML += i + "<br>";\ni' + lepeskoz + '=' + szam3 + ';} while (i' + relacio + szam2 + ');';
    }
    else if ($('rb3').checked === true) {
        fkod = 'for (var i = ' + szam1 + '; i ' + relacio + ' ' + szam2 + '; i' + lepeskoz + '=' + szam3 + ') {$("eredmeny").innerHTML += i + "<br>";\n}';
    }
    $('eredmeny').innerHTML = fkod;
    eval(fkod);
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
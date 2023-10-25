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
        kodsz += 'var i = ' + szam1 + ';\nwhile(i' + relacio + szam2 + ')\n{\n\t$("eredmeny").innerHTML += i + \"<br>\";\n\ti' + lepeskoz + '=' + szam3 + ';\n}';
    }
    else if ($('rb2').checked === true) {
        kodsz += 'var i = ' + szam1 + ';\ndo\n{\n\t$("eredmeny").innerHTML += i + \"<br>\";\n\ti' + lepeskoz + '=' + szam3 + ';\n} while (i' + relacio + szam2 + ');';
    }
    else if ($('rb3').checked === true) {
        kodsz += 'for(var i = ' + szam1 + '; i ' + relacio + ' ' + szam2 + '; i' + lepeskoz + '=' + szam3 + ') \n{$("eredmeny").innerHTML += i + \"<br>\";\n}';
    }
    else {
        alert("Nem választotál típust!")
    }
    $('kod').innerHTML = kodsz;
}
function futtat() {
    var fkod = $('kod').value;
    if (eval($('szam1').value + $('relacio').value + $('szam2').value) == false) {
        alert("Hibás megadás pontosítsa !");
    }
    else {
        eval(fkod);
    }
}
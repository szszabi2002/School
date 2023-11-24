
function tombs() {
// 1D tömb adatok megjelenítésének törlése
    document.getElementById('tombok').innerHTML = '';
    var uresTomb = []; //Üres tömb létrehozása   
    var tomb = [12, 'alma', true]; //Tömb létrehozása előre feltöltött elemekkel
    tomb_kiir(tomb);
    tomb_kirajzol(tomb);
    tomb_hossza(tomb);
    tomb[0] = 13;
    tomb_kiir2(tomb);
    tomb_kirajzol(tomb);
    //Új elem beszúrása a tömb végére
    tomb[tomb.length] = 'uj';
    tomb_kiir(tomb);
    tomb_kirajzol(tomb);
    //Új elem felvétele tetszőleges indexre - a  köztes elemek undefined értékűek
    tomb[11] = 'messze';
    tomb_kiir2(tomb);
    tomb_kirajzol2(tomb);
    tomb_hossza(tomb);
    delete tomb[1];
    tomb_kiir(tomb);
    tomb_kirajzol(tomb);
    tomb_hossza(tomb);
    // 2D tömb adatok megjelenítésének törlése
    document.getElementById('tombok2D').innerHTML = '';
}
//Hivatkozás a tömb elemeire tomb[index], tömb elemeinek kiírása - az undefined elemeket nem írja ki
function tomb_kiir(tomb) {
    document.getElementById("tombok").innerHTML += "A tömb elemei:" + "<br>";
    for (var elem in tomb) {
        document.getElementById("tombok").innerHTML += "tomb[" + elem + "] = " + tomb[elem] + "<br>";
    }
    document.getElementById("tombok").innerHTML += "<hr>";
}

function tomb_kirajzol(tomb) {
    var tombhtml = '';
    tombhtml += "A tömb elemei: <table><thead><tr>";
    for (var elem in tomb) {
        tombhtml += "<th>" + elem + "</th>";
    }
    tombhtml += "</tr></thead><tbody><tr>";
    for (var elem in tomb) {
        tombhtml += "<td>" + tomb[elem] + "</td>";
    }
    tombhtml += "</tr></tbody></table>";
    document.getElementById("tombok").innerHTML += tombhtml;
}



//Hivatkozás a tömb elemeire tomb[index], tömb elemeinek kiírása, kiírja az undefined elemek is 
function tomb_kiir2(tomb) {
    document.getElementById("tombok").innerHTML += "A tömb elemei:" + "<br>";
    for (var i = 0; i < tomb.length; i++) {
        document.getElementById("tombok").innerHTML += "tomb[" + i + "] = " + tomb[i] + "<br>";
    }
    document.getElementById("tombok").innerHTML += "<hr>";
}


function tomb_kirajzol2(tomb) {
    var tombhtml = '';
    tombhtml += "A tömb elemei: <table><thead><tr>";
    for (var i = 0; i < tomb.length; i++) {
        tombhtml += "<th>" + i + "</th>";
    }
    tombhtml += "</tr></thead><tbody><tr>";
    for (var i = 0; i < tomb.length; i++) {
        tombhtml += "<td>" + tomb[i] + "</td>";
    }
    tombhtml += "</tr></tbody></table>";
    document.getElementById("tombok").innerHTML += tombhtml;
}


//A tömb hosszának lekérdezése: tomb.length
function tomb_hossza(tomb) {
    document.getElementById("tombok").innerHTML += "A tömb hossza: " + tomb.length + "<br>";
    document.getElementById("tombok").innerHTML += "<hr>";
}

function tombs2D() {
// 2D tömb adatok megjelenítésének törlése
    document.getElementById('tombok2D').innerHTML = '';
    var uresTomb2D = [[], []]; //Üres 2D tömb létrehozása   
    tomb_kiir_2D(uresTomb2D);
    tomb_kirajzol_2D(uresTomb2D)
    tomb_hossza_2D(uresTomb2D);
    var tomb2D = [[1, 2, 3], [4, 5, 6]]; //Mátrix
    tomb_kiir_2D(tomb2D);
    tomb_kirajzol_2D(tomb2D);
    tomb_hossza_2D(tomb2D);
    // tömb tetszőleges elemének törlése és felülírása
    delete tomb2D[1][1];
    tomb2D[1][2] *= 2;
    tomb_kiir_2D(tomb2D);
    tomb_kirajzol_2D(tomb2D);
    tomb_hossza_2D(tomb2D);
    //Új elem beszúrása a az első sor végére végére

    tomb2D[1][tomb2D[1].length] = 'uj elem';
    tomb_kiir_2D(tomb2D);
    tomb_kirajzol_2D(tomb2D);
    //Új elem felvétele tetszőleges indexre - a  köztes elemek undefined értékűek
    tomb2D[0][6] = 'sorvége';
    //tomb2D[2][0] = 'valami'; // <-- a sorok száma így nem bővíthető
    tomb_kiir_2D(tomb2D);
    tomb_kirajzol_2D(tomb2D);
    tomb_hossza_2D(tomb2D);
    const a = '12';
    // 1D tömb adatok megjelenítésének törlése
    document.getElementById('tombok').innerHTML = '';
}

function tomb_kiir_2D(tomb) {
    document.getElementById("tombok2D").innerHTML += "A tömb elemei:" + "<br>";
    for (var i = 0; i < tomb.length; i++) {
        for (var j = 0; j < tomb[i].length; j++)
            document.getElementById("tombok2D").innerHTML += "tomb[" + i + "][" + j + "] = " + tomb[i][j] + " | ";
        document.getElementById("tombok2D").innerHTML += "<br>";
    }
    document.getElementById("tombok2D").innerHTML += "<hr>";
}


function tombMaxVektorHossz(tomb) {
    max = 0;
    for (var i = 0; i < tomb.length; i++) {
        if (tomb[i].length >= max) {
            max = tomb[i].length;
        }
    }
    return max;
}

function tomb_kirajzol_2D(tomb) {
    var tombhtml = '';
    tombhtml += "A tömb elemei: <table><thead><tr><th></th>";
    var maxhossz = tombMaxVektorHossz(tomb);
    //az elso index sor kiirása
    for (var i = 0; i < maxhossz; i++) {
        tombhtml += "<th>" + i + "</th>";
    }
    tombhtml += "</tr></thead><tbody>";
    //adatsorok kiiratása

    for (var i = 0; i < tomb.length; i++) {
        tombhtml += "<tr><th>" + i + "</th>";
        for (var j = 0; j < tomb[i].length; j++) {
            tombhtml += "<td>" + tomb[i][j] + "</td>";
        }
        tombhtml += "</tr>";
    }
    tombhtml += "</tr></tbody></table>";
    document.getElementById("tombok2D").innerHTML += tombhtml;
}

function tomb_hossza_2D(tomb) {
    document.getElementById("tombok2D").innerHTML += "A tömb sorainak szám: " + tomb.length + "<br>";
    for (var i = 0; i < tomb.length; i++) {
        document.getElementById("tombok2D").innerHTML += "A tömb " + i + ". sorának hossza: " + tomb[i].length + "<br>";
    }
    document.getElementById("tombok2D").innerHTML += "<hr>";
}


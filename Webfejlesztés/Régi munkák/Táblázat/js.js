function $(id) {
    return document.getElementById(id);
}

function ß(className) {
    return document.getElementsByClassName(className);
}

function szamol() {
    var kod = "<table>";
    var tablazat = [];
    var meret = parseInt($("meret").value);
    if (isNaN(meret)) {
        $("eredmeny").innerHTML = kod;
        alert("Nem jó adatott adtál meg!");
    } else {
        //Táblázat feltöltés
        for (var i = 0; i < meret; i++) {
            tablazat[i] = [];
            for (var j = 0; j < meret; j++) {
                tablazat[i][j] = (Math.random() * 1000).toFixed(3);
            }
        }
        //Sorok összeadása
        for (var i = 0; i < meret; i++) {
            var s = 0;
            for (var j = 0; j < meret; j++) {
                s += parseFloat(tablazat[i][j], meret);
            }
            tablazat[i][meret] = s.toFixed(3);
        }
        //Oszlopok összeadása
        tablazat[meret] = [];
        for (var i = 0; i < meret; i++) {
            var s = 0;
            for (var j = 0; j < meret; j++) {
                s += parseFloat(tablazat[j][i], meret);
            }
            tablazat[meret][i] = s.toFixed(3);
        }
        for (var i = 0; i < meret + 1; i++) {
            kod += "<tr>";
            for (var j = 0; j < meret + 1; j++) {
                if (i == meret && j == meret) {
                    kod += "<td id='sarok'></td>";
                } else if (j == meret || i == meret) {
                    kod += "<td class='elrejtve'>" + tablazat[i][j] + "</td>";
                } else {
                    kod += "<td>" + tablazat[i][j] + "</td>";
                }
            }
            kod += "</tr>";
        }
        kod += "</table>";
        $("eredmeny").innerHTML = kod;
    }
}
function osszead() {
    var elrejt = ß("elrejtve");
    for (var i = 0; i < elrejt.length; i++) {
        elrejt[i].style.visibility = "visible";
    }
}
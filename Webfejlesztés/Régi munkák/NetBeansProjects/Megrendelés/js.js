function $(id) {
    return document.getElementById(id);
}
function Szamol() {
    var szam1;
    var szam2;
    var szam3;
    var szam4;
    var szam5;
    if ($('cb1').checked === true) {
        szam1 = 4500;
    }
    else {
        szam1 = 0;
    }
    if ($('cb2').checked === true) {
        szam2 = 7400;
    }
    else {
        szam2 = 0;
    }
    if ($('cb3').checked === true) {
        szam3 = 3700;
    }
    else {
        szam3 = 0;
    }
    if ($('cb4').checked === true) {
        szam4 = 3500;
    }
    else {
        szam4 = 0;
    }
    if ($('cb5').checked === true) {
        szam5 = 4100;
    }
    else {
        szam5 = 0;
    }
    if ($('lemez').checked === true) {
        if ($('cb1').checked === true) {
            szam1 += 500;
        }
        if ($('cb2').checked === true) {
            szam2 += 500;
        }
        if ($('cb3').checked === true) {
            szam3 += 500;
        }
        if ($('cb4').checked === true) {
            szam4 += 500;
        }
        if ($('cb5').checked === true) {
            szam5 += 500;
        }
        $('hidden').style.visibility = 'visible';
    }
    else if ($('letolt')) { $('hidden').style.visibility = 'hidden'; }
    $('eredmeny').innerHTML = szam1 + szam2 + szam3 + szam4 + szam5;
}
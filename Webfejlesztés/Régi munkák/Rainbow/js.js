function $(id) {
    return document.getElementById(id);
}
function szamol() {
    var tablazat = "<table>";
    var meret = parseInt($('meret').value);
    for (var i = 0; i < meret; i++) {
        tablazat += "<tr>"
        for (var j = 0; j < meret; j++) {
            tablazat += "<td>" + (Math.random()*200).toFixed(0) + "</td>";
        }
        tablazat += "</tr>";
    }
    tablazat+="<table>";
    console.log(tablazat)
    $('eredmeny').innerHTML=tablazat;
}
/*var kod = "<table>";
for (var i = 0; i < 10; i++) {
    kod += "<tr>";
    for (var j = 0; j < 10; j++) {
        kod += "<td>" + (Math.random()*1000).toFixed(3) + "</td>";
    }
    kod += "</tr>";
}
kod += "</table>";
$('tombok').innerHTML = kod;
console.log(kod)*/
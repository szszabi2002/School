
function tablazatrajzol(x, y) {
    var kod = "<table>";
    for (var i = 0; i < x; i++) {
        kod += "<tr>";
        for (var j = 0; j < y; j++) {
            kod += "<td>" + (i + 1) * (j + 1) + "</td>";
        }
        kod += "</tr>";
    }
    kod += "</table>";
    document.getElementById('tablazat').innerHTML = kod;
}


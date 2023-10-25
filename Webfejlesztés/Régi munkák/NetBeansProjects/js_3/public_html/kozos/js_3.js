function tablazatrajzol() {
    var x = document.getElementById('x').value;
    var y = document.getElementById('y').value;
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
function számol()
var a = document.getElementById('a').value;
var b = document.getElementById('b').value;
var c = document.getElementById('c').value;
{

    if (a==0)
    {
        alert("Első fokú")
    }
    else
    {
        alert("Másodfokú")
    }
}

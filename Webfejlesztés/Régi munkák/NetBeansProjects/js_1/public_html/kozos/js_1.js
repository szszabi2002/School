

function kulso_elso() {
//    alert("ez itt a külső szkript!");
    max = 10;
    for (var i = 0; i < max; i++) {

        if (i % 2 == 0) {
            console.log(i);
        }
    }
}


function tablazatrajzol(x, y) {
//    var x = 5;
//    var y = 4;
    document.write("<table>");
    for (var i = 0; i < x; i++) {
        document.write("<tr>");
        for (var j = 0; j < y; j++) {
            document.write("<td>" + (i + 1) * (j + 1) + "</td>");
        }
        document.write("</tr>");
    }
    document.write("</table>");
}


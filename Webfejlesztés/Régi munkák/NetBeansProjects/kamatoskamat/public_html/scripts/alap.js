
function $(id) {
    return document.getElementById(id);

}

function szamit() {
    let betet = parseInt($("B").value);
    let evek = parseInt($("N").value);
    let kamat = parseFloat($("K").value);
    let text = "";
    text += "<table>";
    text += "<thead><th>Év</th><th>"+ kamat +"%</th><th>"+ 2*kamat +"%</th><th>"+ 3*kamat +"%</th><th>"+ 4*kamat +"%</th> <thead><tbody>";
    for (let i = 0; i < evek + 1; i++)
    {
        text += "<tr>";
        text += "<td>" + i + ". </td>";
        text += "<td>" + (betet * Math.pow((1 + kamat / 100), i)).toFixed(2) + "</td>";
        text += "<td>" + (betet * Math.pow((1 + 2 * kamat / 100), i)).toFixed(2) + "</td>";
        text += "<td>" + (betet * Math.pow((1 + 3 * kamat / 100), i)).toFixed(2)  + "</td>";
        text += "<td>" + (betet * Math.pow((1 + 4 * kamat / 100), i)).toFixed(2) + "</td>";
        text += "</tr></tbody>";
    }
    text += "</table>";
    $("eredmeny").innerHTML += text;
}
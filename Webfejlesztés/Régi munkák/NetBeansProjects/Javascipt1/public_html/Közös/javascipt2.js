function táblázat() {
    var x = document.getElementById('x').value;
    var y = document.getElementById('y').value;
  var kód = "<table>";
  for (var i = 0; i < x; i++) {
    kód += "<tr>";
    for (var j = 0; j < y; j++) {
      kód += "<td>" + (i + 1) * (j + 1) + "</td>";
    }
    kód += "</tr>";
  }
  kód += "</table>";
  document.getElementById("Táblázat").innerHTML = kód;
}

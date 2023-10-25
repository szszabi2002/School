function szamolas() {
    with (document.másodf) {
        var va = a.value;
        var vb = b.value;
        var vc = c.value;
        var vd = (vb * vb) - (4 * va * vc);
        if (a.value == "" && b.value == "" && c.value == "") {
            alert("Nem adtál meg számokat!");
        }
        else {
            if (vd === 0) {
                x1.value = -vb / (2.0 * va);
                x2.value = x1.value;
                document.getElementById("dmegold").innerHTML = "Egy megoldás van";
                document.getElementById("diszkrimináns").innerHTML = vd;
            }
            else if (vd < 0) {
                alert("A gyökvonás alatt az érték kevesebb volt mint 0!");
            }
            else if (vd > 0) {
                x1.value = (-vb + Math.sqrt(vd)) / (2 * va);
                x2.value = (-vb - Math.sqrt(vd)) / (2 * va);
                document.getElementById("dmegold").innerHTML = "Két megoldás van";
                document.getElementById("diszkrimináns").innerHTML = vd;
            }
        }
    }
}
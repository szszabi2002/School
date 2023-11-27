function szamol() {
    perc = document.getElementById("futasPerc").value;
    perc = parseInt(perc);
    document.getElementById("futasKal").value = (perc / 60 * 680).toFixed(2);
}
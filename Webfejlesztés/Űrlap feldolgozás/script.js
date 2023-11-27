function futasszamol() {
    perc = document.getElementById('futasPerc').value;
    perc = Number(perc);
    //perc = parseInt(perc);
    document.getElementById('futasKal').value = (perc / 60 * 680).toFixed(2);
}
function szamol(orankent, bePerc, eredmeny) {
    perc = document.getElementById(bePerc).value;
    perc = Number(perc);
    if (isNaN(perc)) return perc = 0;
    perOra = document.getElementById(orankent).innerHTML;
    perOra = Number(perOra);
    kiEredmeny = document.getElementById(eredmeny);
    kiEredmeny.value = (perOra / 60 * perc).toFixed(2)
    osszegez()
}
function osszegez(){
    osszPerc = 0;
    osszPerc +=  Number(document.getElementById('futasPerc').value)
    osszPerc +=  Number(document.getElementById('fociPerc').value)
    osszPerc +=  Number(document.getElementById('bringazasPerc').value)
    if (isNaN(perc)) return perc = 0;
    osszPerc += futasPerc;
    futasPerc = document.getElementById('hegymaszasPerc').value
    if (isNaN(perc)) return perc = 0;
    osszPerc += futasPerc;
    futasPerc = document.getElementById('lovaglasPerc').value
    if (isNaN(perc)) return perc = 0;
    osszPerc += futasPerc;
    futasPerc = document.getElementById('turaPerc').value
    if (isNaN(perc)) return perc = 0;
    osszPerc += futasPerc;
    futasPerc = document.getElementById('kajakPerc').value
    if (isNaN(perc)) return perc = 0;
    osszPerc += futasPerc;
    futasPerc = document.getElementById('sulyedzPerc').value
    if (isNaN(perc)) return perc = 0;
    osszPerc += futasPerc;
    futasPerc = document.getElementById('pingpongPerc').value
    if (isNaN(perc)) return perc = 0;
    osszPerc += futasPerc;
    futasPerc = document.getElementById('kutyasetaPerc').value
    if (isNaN(perc)) return perc = 0;
    osszPerc += futasPerc;

    document.getElementById('osszPerc').value = osszPerc;
}
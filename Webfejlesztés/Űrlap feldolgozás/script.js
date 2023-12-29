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
    kaloriaosszegzes()
}
function osszegez() {
    osszPerc = 0;
    percek = document.getElementsByName('perc')
    for (i = 0; i < percek.length; i++) {
        perc = percek[i].value
        perc = Number(perc);
        if (isNaN(perc)) perc = 0
        osszPerc += perc
    }
    document.getElementById('osszPerc').value = osszPerc;
    //for(inicializáló kifejezések; ciklusfeltétel; léptető utasítás)

    /*osszPerc += Number(document.getElementById('futasPerc').value)
    osszPerc += Number(document.getElementById('fociPerc').value)
    osszPerc += Number(document.getElementById('bringazasPerc').value)
    osszPerc += Number(document.getElementById('hegymaszasPerc').value)
    osszPerc += Number(document.getElementById('lovaglasPerc').value)
    osszPerc += Number(document.getElementById('turaPerc').value)
    osszPerc += Number(document.getElementById('kajakPerc').value)
    osszPerc += Number(document.getElementById('sulyedzPerc').value)
    osszPerc += Number(document.getElementById('pingpongPerc').value)
    osszPerc += Number(document.getElementById('kutyasetaPerc').value)
    if (isNaN(perc)) return perc = 0;
    document.getElementById('osszPerc').value = osszPerc;*/
}
function kaloriaosszegzes() {
    osszKal = 0;
    kal = document.getElementsByName('kaloria')
    for (i = 0; i < kal.length; i++) {
        kaloria = kal[i].value
        kaloria = Number(kaloria);
        if (isNaN(kaloria)) kaloria = 0
        osszKal += kaloria
    }
    document.getElementById('osszKaloria').value = osszKal.toFixed(2);
    document.getElementById('napiArany').value = Math.round(osszKal / 2000 * 100);
}

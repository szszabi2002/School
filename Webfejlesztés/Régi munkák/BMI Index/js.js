function $(id) {
    return document.getElementById(id);
}
function szamol() {
    var test = $('testsuly').value;
    var mag = $('magassag').value;
    var BMI = parseFloat(test / Math.pow(mag, 2) * 10000).toFixed(1);
    if (BMI <= 18) {
        $('bmi').value = BMI;
        $('bmi').style.backgroundColor = 'yellow';
        $('sulytoblet').style.visibility = 'hidden';
    }
    else if (18 <= BMI && BMI <= 25) {
        $('bmi').value = BMI;
        $('bmi').style.backgroundColor = '#8F8';
        $('sulytoblet').style.visibility = 'hidden';
    }
    else if (BMI >= 25) {
        $('bmi').value = BMI;
        $('bmi').style.backgroundColor = '#FF7F7F';
        $('sulytoblet').style.visibility = 'visible';
        $('sulyt').value = Math.round(test - 25 * Math.pow(mag / 100, 2));
    }
}
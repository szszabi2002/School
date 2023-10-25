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
    }
    else if (18 <= BMI && BMI <= 25) {
        $('bmi').value = BMI;
        $('bmi').style.backgroundColor = 'green';
    }
    else if (BMI >= 25) {
        $('bmi').value = BMI;
        $('bmi').style.backgroundColor = 'red';
        $('sulyt').value = Math.round(BMI) - 25;
    }
}
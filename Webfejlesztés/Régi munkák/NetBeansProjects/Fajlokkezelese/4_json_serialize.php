<?php

$filmek = array(
    array(
        'cim' => 'Passió',
        'rendezo' => 'Mel Gibson',
        'ev' => '2004',
        'szereplok' => array(
            'Jim Caviezel',
            'Maia Morgenstern',
            'Christo Jivkov',
        ),
    ),
    array(
        'cim' => 'Pio atya - A csodák embere',
        'rendezo' => 'Carlo Carlei',
        'ev' => '2000',
        'szereplok' => array(
            'Sergio Castellitto',
            'Sergio Albelli',
        ),
    ),
);

echo $filmek_serialize = serialize($filmek);
echo '<hr>';
print_r($filmek2 = unserialize($filmek_serialize));
echo '<hr><hr>';
echo $filmek_json = json_encode($filmek);
echo '<hr>';
print_r($filmek3 = json_decode($filmek_json));

//Betöltés fájlból
function fajlbol_betolt($fajlnev) {
    $s = file_get_contents($fajlnev);
    return json_decode($s, true);
}

$fajl_nev = 'adatok3.txt';

//Mentés fájlba
function fajlba_ment($fajlnev, $adat) {
    $s = json_encode($adat);
    return file_put_contents($fajlnev, $s, LOCK_EX);
}

function fajlbol_betolt2($fajlnev, $alap = array()) {
    $s = @file_get_contents($fajlnev);
    return ($s === false ? $alap : json_decode($s, true));
}

echo '<hr><hr><hr>';
fajlba_ment($fajl_nev, $filmek);
$filmek4 = fajlbol_betolt('adatok3.txt');
print_r($filmek4);
?>
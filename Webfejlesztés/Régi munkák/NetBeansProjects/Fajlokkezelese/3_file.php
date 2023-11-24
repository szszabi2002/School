<?php

$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

/* array file ( string $filename [, int $flags = 0 [, resource $context ]] )
 * egy állomyány sorainak bemásolása  egy tömbbe
 * módosítók:
 *  FILE_IGNORE_NEW_LINES   üres sorok is megjelenjenek-e a tömbben üres elemként vagy sem
 *  FILE_SKIP_EMPTY_LINES   a sorok végén lévő új sor karaktereket a PHP levegye-e
 */

$lines = file("$DOCUMENT_ROOT/fajlokkezelese/adatok.txt");
$lines3 = file("$DOCUMENT_ROOT/fajlokkezelese/adatok.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line_num => $line) {
    echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
}
echo "<hr>";

foreach ($lines3 as $line3_num => $line3) {
    echo "Line #<b>{$line3_num}</b> : " . htmlspecialchars($line3) . "<br />\n";
}
echo "<hr>";

$lines2 = file('http://www.example.com/');
foreach ($lines2 as $line2_num => $line2) {
    echo "Line #<b>{$line2_num}</b> : " . htmlspecialchars($line2) . "<br />\n";
}
?>


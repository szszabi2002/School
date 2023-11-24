<!DOCTYPE html>
<?php
$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'];
$POJECT_NAME = "filetoform";
$DB_FILE = "adatok.txt";
$MODE = "rw";
$fh1 = fopen($DOC_ROOT . "/" . $POJECT_NAME . "/" . $DB_FILE, $MODE);
$file_content = [];
$cnt = 0;
while (!feof($fh1)) {
    $file_content[$cnt] = fgets($fh1);
    $cnt++;
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <select id="id">
            <?php
            $cnt = 0;
            foreach ($file_content as $sor) {
                $adatok = explode(",", $sor);
                ?>
                <option value="<?= $cnt; ?>"><?= $adatok[0]; ?></option>
                <?php
                $cnt++;
            }
            ?>
        </select>
        <select id="name">
            <?php
            $cnt = 0;
            foreach ($file_content as $sor) {
                $adatok = explode(",", $sor);
                ?>
                <option value="<?= $cnt; ?>"><?= $adatok[1]; ?></option>
                <?php
                $cnt++;
            }
            ?>
        </select>
        <select id="address">
            <?php
            $cnt = 0;
            foreach ($file_content as $sor) {
                $adatok = explode(",", $sor);
                ?>
                <option value="<?= $cnt; ?>"><?= $adatok[2]; ?></option>
                <?php
                $cnt++;
            }
            ?>
        </select>
        <select id="id">
            <?php
            $cnt = 0;
            foreach ($file_content as $sor) {
                $adatok = explode(",", $sor);
                ?>
                <option value="<?= $cnt; ?>"><?= $adatok[3]; ?></option>
                <?php
                $cnt++;
            }
            ?>
        </select>


    </body>
</html>

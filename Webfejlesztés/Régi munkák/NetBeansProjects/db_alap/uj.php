<!DOCTYPE html>
<?php
include 'adatkapcsolat.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Új rekord rögzítése</title>
        <link href="db_alap.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <form name="uj_alkalmazott" method="POST">
            <h2>Új alkalmazott adatai:</h2>
            <div class="mezo">
                <label for="name">Név:</label>
                <input type="text" name="name" id='name' value="" />
            </div>
            <div class="mezo">
                <label for="address">Cím:</label>
                <input type="text" name="address" id='adress' value="" />
            </div >
            <div class="mezo">
                <label for="salary">Fizetés:</label>
                <input type="text" name="salary" id='salary' value="" />
            </div>
            <input type="submit" value="Rögzítés" name="insert" />
        </form>

    </body>
</html>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Táblázat</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    echo "<table>";
    for ($i = 0; $i < 10; $i++) {
        echo "<tr>";
        for ($j = 0; $j < 10; $j++) {
            echo "<td>";
            echo ($i + 1) * ($j + 1);
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>

</html>
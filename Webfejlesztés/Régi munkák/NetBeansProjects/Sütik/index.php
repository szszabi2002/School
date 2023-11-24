<!DOCTYPE html>
<?php
echo $_POST['username'];
setcookie('Teszt', 'Tesztelek', time() + 360);
if (isset($_POST['submit'])) {
    setcookie('username', $_POST['username'], time() + 360);
}
print_r($_COOKIE);
?>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sütik</title>
</head>

<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">Felhasználó név:</label>
        <input type="text" name="username" id="username" value="">
        <input type="submit" name="submit" value="elküld">
    </form>
</body>

</html>
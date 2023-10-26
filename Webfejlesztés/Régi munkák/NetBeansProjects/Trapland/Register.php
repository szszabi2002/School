<?php
$con = mysqli_connect('localhost','id18623828_root','L=M\7-dJvYwbe|dv','id18623828_trapland');
//Csatlakozás ellenőrzés
if(mysqli_connect_errno())
{
   echo "Connection failed";
   exit();
}
$username = $_POST["name"];
$password = $_POST["password"];

//Felhasználónév ellenőrzése
$namecheckquery = "SELECT Username FROM username WHERE Username='" .$username . "';";
$namecheck=mysqli_query($con, $namecheckquery) or die("Name check query failed.");
if (mysqli_num_rows ($namecheck)> 0)
{
   echo "Name already exists";
   exit();
}
//Adat hozzáadása
$salt="\$5\$rounds=5000\$" . "database" . $username . "\$";
$hash= crypt($password,$salt);
$insertuserquery ="INSERT INTO username (Username, hash, salt,) VALUES(" . $username . "', '" . $hash . "', '" . $salt . "');";
mysqli_query($con, $insertuserquery)or die ("Insert Player query failed");
echo ("0");
?>
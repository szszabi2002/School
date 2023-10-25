<?php
$con = mysqli_connect('localhost','id18623828_root','L=M\7-dJvYwbe|dv','id18623828_trapland');
//check that connection happened
if(mysqli_connect_errno())
{
   echo "1: Connection failed";
   exit();
}
$username = $_POST["username"];
$password = $_POST["password"];
//Felhasználónév ellenőrzése
$namecheckquery = "SELECT Username FROM username WHERE Username='" .$username . "';";
$namecheck=mysqli_query($con, $namecheckquery) or die("2: Name check query failed.");
if (mysqli_num_rows ($namecheck)> 0)
{
   echo "3: Name already exists";
   exit();
}
//Adat hozzáadása
$salt="\$5\$rounds=5000\$" . "sajtoskenyer" . $username . "\$";
$hash= crypt($password,$salt);
$insertuserquery ="INSERT INTO username (Username, hash, salt, ReachedLevel) VALUES('" . $username . "', '" . $hash . "', '" . $salt . "', 1);";
mysqli_query($con, $insertuserquery)or die ("4: Insert Player query failed");
echo ("0");
?>
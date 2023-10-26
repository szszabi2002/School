<?php
$con = mysqli_connect('localhost', 'id18623828_root', 'L=M\7-dJvYwbe|dv', 'id18623828_trapland');
if (mysqli_connect_errno()) {
    echo "1: Connection failed"; //error code #1 = connection failed
    exit();
}
$username = $_POST["usernamePost"];
$level = $_POST["LevelPost"];
$time = $_POST["TimePost"];
$deathcounter = $_POST["DeathCounterPost"];
$reachedlevel = $_POST["ReachedLevelPost"];
$useridquery = "SELECT ID FROM username WHERE Username='" . $username ."';";
$userid = mysqli_query($con, $useridquery)->fetch_object()->ID or die("105: Fetching userID failed");
$namecheckquery = "SELECT Username FROM username WHERE Username='" . $username . "';";
$namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed."); //error code #2 - name check
if (mysqli_num_rows($namecheck) != 1) {
    echo "5: Either no user with name, or more than one"; //error code #5 - number of names matching != 1
    exit();
}
$updatequery = "UPDATE username SET ReachedLevel='" . $reachedlevel . "' WHERE Username='" . $username . "';";
mysqli_query($con, $updatequery) or die("7: Update query failed"); //error code #7 - update query failed
$insertquery = "INSERT INTO stats (Username_ID, Level, Time, DeathCounter) VALUES('" . $userid . "', '" . $level . "', '" . $time . "', '" . $deathcounter . "');";
mysqli_query($con, $insertquery) or die("9: Update query failed"); //error code #9 - update query failed
echo "0";
?>
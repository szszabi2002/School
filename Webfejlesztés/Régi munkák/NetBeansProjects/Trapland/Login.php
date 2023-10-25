<?php
   $con = mysqli_connect('localhost','id18623828_root','L=M\7-dJvYwbe|dv','id18623828_trapland');
    //check that connection happened
    if (mysqli_connect_errno()) {
        echo "1: Connection failed"; //error code #1 = connection failed
        exit();
    }
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];
    //check if name exists
    $namecheckquery = "SELECT Username, hash, salt, ReachedLevel FROM username WHERE Username='" . $username . "';";
    $namecheck = mysqli_query($con, $namecheckquery) or die("2: Name check query failed"); //error code #2 - name check query failed
   if (mysqli_num_rows($namecheck) != 1) {
       echo "5: Either no user with name, or more than one"; //error code #5 - number of names matching != 1
       exit();
   }
    //get login info from query
    $existinginfo = mysqli_fetch_assoc($namecheck);
    $hash = $existinginfo["hash"];
    $salt = $existinginfo["salt"];
    $loginhash = crypt($password, $salt);
   if ($hash != $loginhash) {
       echo "6: Incorrect password"; //error code #6 password does not hash to match table
       exit();
   }
    echo "0\t" . $existinginfo["ReachedLevel"];
    ?>
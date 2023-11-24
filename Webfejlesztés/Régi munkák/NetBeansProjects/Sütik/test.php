<?php
setcookie('test',"Teszt Elek", time()-360);
/*$tomb = ['name'=>'Gergő', 'email'=>'gergo@localhost.com', weight='=>']*/
$tombszoveg = serialize($tomb);
echo $tombszoveg;
setcookie('tomb',$tombszoveg, time()+360000000000000000);
$tomb2 = unserialize($_COOKIE['$tomb']);
print_r($tomb2);
foreach($tomb2 as $kulcs => $ertek){
    echo "<br>$kulcs:$ertek";
}
?>
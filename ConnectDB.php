<?php
    $host="localhost";
    $username="root";
    $password="";
    $db="project";
    $connect= mysqli_connect($host,$username,$password,$db) or die ("ติดต่อกับฐานข้อมูล Mysql ไม่ได้ ".  mysqli_error());
    MYSQLI_set_charset($connect,'utf8');
    if (!$connect) {
        echo "Error: ไม่สามารถเชื่อมต่อฐานข้อมูล MySQL. ได้ " . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    
?>

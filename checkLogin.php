<?php
include 'connect.php';
$username = mysqli_real_escape_string($connect,$_POST['username']);
$sql = "SELECT * FROM `user` WHERE username='$username' ";
$query = mysqli_query($connect,$sql);
$fetch = mysqli_fetch_assoc($query);
if ($fetch) {
    echo "user นี้มีผู้ใช้แล้ว";
}else{
    echo "user $username ใช้ได้";
    
    
}?>
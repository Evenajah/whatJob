<?php
include 'ConnectDB.php';
include 'session.php';

//recive variable
$oldPass = $_POST['passwordOld'];
$newPass = $_POST['passwordNew'];

$salt="qwertyuiop[]ssdfvchnmhjhjkltnbcx";//เข้ารหัส

$hash_password = hash_hmac('sha256',$oldPass,$salt); //เข้ารหัสกับรหัสเก่า

//select
$select = "SELECT `password` from user WHERE user_id = '$row_userID' AND password = '$hash_password'";
$querypassword = mysqli_query($connect,$select);

//fetch
$num_rowPass = mysqli_num_rows($querypassword);//ตัวแปร 1 

//เช็คว่ามีใน table ไหม
if($num_rowPass != 0){
    $hash_Newpassword = hash_hmac('sha256',$newPass,$salt); //เข้ารหัสกับรหัสใหม่
    $changePassword = "UPDATE `user` SET `password`= '$hash_Newpassword' WHERE user_id = '$row_userID'";
    $queryChangePassword = mysqli_query($connect,$changePassword);?>
    <script>
        alert("Successfully Changepassword");window.location="Home.php";
    </script>
<?php
}else{?>
    <script>
        alert("Old password not match");window.location="ChangePassword.php";
    </script>
<?php
}?>
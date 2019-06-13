<?php
include 'ConnectDB.php';
include 'session.php';
//recive variable from accept.php
$interview = $_POST['interview'];
$user_host = $_POST['user_host'];
$user_id = $_POST['user_id'];
$jobs_id = $_POST['jobs_id'];
 
//เช็คว่าได้ส่ง สอบสัมภาษไปยัง
$checkAccept = "SELECT `user_host`, `user_regis`, `jobs_id` from confirm where user_host = '$user_host' AND jobs_id = '$jobs_id' AND user_regis = '$user_id'";
$queryCheck = mysqli_query($connect,$checkAccept);
$num_rowCheck = mysqli_num_rows($queryCheck);

//เงื่อนไข
if($num_rowCheck != 0){?>
    <script>
        alert("You have already sent interview");window.location = "History.php"
    </script>
<?php 
}else{
    $insertConfirm = "INSERT INTO `confirm`(`user_host`, `user_regis`, `jobs_id`, `date`, `dialog`) VALUES ('$user_host','$user_id','$jobs_id',NOW(),'$interview')";
    $queryConfirm = mysqli_query($connect,$insertConfirm);
    if($queryConfirm){?>
        <script>
            alert("Interview send seccessfully!");window.location = "Home.php";
        </script>
<?php }

}

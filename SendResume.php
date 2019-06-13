<?php
include 'ConnectDB.php';
include 'session.php';
include 'SelectDatabase.php';

$jobs_id = $_POST['jobs_id'];
$user_id = $_POST['user_id'];
$jobs_host = $_POST['jobs_host'];


//Select table (ห้ามส่งเรซูเม่ซ้ำ)
$Spam = "SELECT jobs_id from notification WHERE user_id = '$user_id' AND jobs_id = '$jobs_id'";
$querySpam = mysqli_query($connect,$Spam);

//เช็คแถว
$num_row_spam = mysqli_num_rows($querySpam);

?>

<script>
    //add id 
    var id = <?php echo $jobs_id ?>;
</script>

<?php
//ห้ามใช้ไอดีเดียวกับที่สร้างสมัคร
if($user_id == $jobs_host){?>
    <script>
        alert("Cannot apply for self-employment.");window.location="PageNew.php?id=" +  id;
    </script>
<?php
}
//ห้ามส่งเรซูเม่ซ้ำ
else if($num_row_spam != 0){?>
    <script>
        alert("Do not send resume repeatedly");window.location.href = "PageNew.php?id=" +  id;
    </script>
<?php
}
//ต้องสร้างเรซูแม่ก่อน
else if(!$Resume || !$Personal){?>
    <script>
        alert("Please Create PersonalData and Resume");window.location="CreatePersonalData.php";
    </script>
<?php
}
//สามารถสมัครได้
else{
    $insertNoti = "INSERT INTO `notification`(`jobs_id`, `user_id`,`date`) VALUES ('$jobs_id','$user_id',NOW())";
    $queryNoti = mysqli_query($connect,$insertNoti);
    ?>
    <script>
        alert("Successfully Send Resume");window.location.href = "PageNew.php?id=" +  id;
    </script>
    <?php
}
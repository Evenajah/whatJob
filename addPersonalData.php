<?php
include 'ConnectDB.php';
include  'session.php';
$Name = $_POST['Name'];
$LastName = $_POST['LastName'];
$Nationality = $_POST['Nationality'];
$Race = $_POST['Race'];
$Weight = $_POST['Weight'];
$Height = $_POST['Height'];
$Birth = $_POST['Birth'];   
$Religion = $_POST['Religion'];
$Status = $_POST['Status'];
$Age = $_POST['Age'];

//upload img
$img = pathinfo(basename($_FILES['news_img']['name']),PATHINFO_EXTENSION);//ดึงนามสกุลไฟล์
$new_img_name = 'user_'.uniqid()/*ฟังก์ชั่นสุ่มชื่อไฟล์*/.".".$img;
$img_path ="./UserImage/";
$upload = $img_path.$new_img_name;
$success = move_uploaded_file($_FILES['news_img']['tmp_name'],$upload);
if($success==false){
    echo "ไม่สามารถอัพโหลดได้";
    exit();
}


//insert
$insert = "INSERT INTO `personal_data`(`user_id`, `Name`, `LastName`, `Nationality`, `Race`, `height`, `weight`, `birth`, `Religion`, `status`, `age`,`image`) 
          VALUES ('$row_userID','$Name','$LastName','$Nationality','$Race','$Height','$Weight','$Birth','$Religion','$Status','$Age','$new_img_name')";
$Personal = mysqli_query($connect,$insert);
if ($Personal){
    header('Location:CreateResume.php');
}else{
    echo "ข้อผิดพลาด".mysqli_error($connect);
}



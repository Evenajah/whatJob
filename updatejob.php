<?php
include 'ConnectDB.php';
include 'session.php';
$jobs_id = $_POST['jobs_id'];
$jobs_head = $_POST['jobs_head'];
$jobs_data = $_POST['jobs_data'];
$jobs_class = $_POST['jobs_class'];
$jobs_edu= $_POST['jobs_edu'];
$jobs_salary= $_POST['jobs_salary'];
$employment_type = $_POST['employment_type'];
$jobs_loca = $_POST['jobs_loca'];
$jobs_exp = $_POST['jobs_exp'];

//update รูป
if(is_uploaded_file($_FILES['news_img']['tmp_name'])){

    //ลบรูปเก่า
    $selectOldImage = "SELECT image FROM jobs_detail WHERE jobs_id = '$jobs_id'";//เอาชื่อรูปออกมาจากตาราง
    $resultDeleteImage = mysqli_query($connect,$selectOldImage);
    $row_image = mysqli_fetch_assoc($resultDeleteImage);
    $imageOld = $row_image['image'];
    unlink("./imgNew/".$imageOld);//ลบรูปออกจากโฟลเดอร์

    //upload img
    $img = pathinfo(basename($_FILES['news_img']['name']),PATHINFO_EXTENSION);//ดึงนามสกุลไฟล์
    $new_img_name = 'news_'.uniqid()/*ฟังก์ชั่นสุ่มชื่อไฟล์*/.".".$img;
    $img_path ="./imgNew/";
    $upload = $img_path.$new_img_name;
    $success = move_uploaded_file($_FILES['news_img']['tmp_name'],$upload);//อัพโหลดไฟล์
    $updateImage = "UPDATE `jobs_detail` SET image = '$new_img_name' where jobs_id = '$jobs_id'";//คำสั่งอัพเดท
    $queryImage = mysqli_query($connect,$updateImage);//query รูปภาพใหม่
    if($success==false){
        echo "ไม่สามารถอัพโหลดได้";
    exit();
    }
}


$update = "UPDATE `jobs_detail` SET `jobs_head`= '$jobs_head',`jobs_data`= '$jobs_data',`jobs_edu`= '$jobs_edu',`jobs_contact`='$jobs_loca',
           `jobs_salary`= '$jobs_salary',`employment_type`='$employment_type',`jobs_date`= NOW(),
           `jobs_exp`='$jobs_exp',`jobs_class`='$jobs_class' where jobs_id = '$jobs_id'";
$query = mysqli_query($connect,$update);
if ($query){?>
    <script>
        alert("Succesfully edit job");window.location = "myjob.php";
    </script>
<?php
}else{
    echo "ข้อผิดพลาด".mysqli_error($connect);
}

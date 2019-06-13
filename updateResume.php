<?php
include 'ConnectDB.php';
include 'session.php';


$name = $_POST['Name'];
$lastName = $_POST['LastName'];
$address = $_POST['Address'];
$target_jobs = $_POST['TargetJobs'];
$education = $_POST['Education'];
$edu_name = $_POST['EducationName'];
$skill = $_POST['Skills'];
$exp = $_POST['exp'];
$email = $_POST['Email'];
$tel = $_POST['Tel'];


//update รูป
if(is_uploaded_file($_FILES['news_img']['tmp_name'])){

    //ลบรูปเก่า
    $selectOldImage = "SELECT image FROM resume WHERE user_id = '$row_userID' ";//เอาชื่อรูปออกมาจากตาราง
    $resultDeleteImage = mysqli_query($connect,$selectOldImage);
    $row_image = mysqli_fetch_assoc($resultDeleteImage);
    $imageOld = $row_image['image'];
    unlink("./ResumeImage/".$imageOld);//ลบรูปออกจากโฟลเดอร์

    //upload img
    $img = pathinfo(basename($_FILES['news_img']['name']),PATHINFO_EXTENSION);//ดึงนามสกุลไฟล์
    $new_img_name = 'resume_'.uniqid()/*ฟังก์ชั่นสุ่มชื่อไฟล์*/.".".$img;
    $img_path ="./ResumeImage/";
    $upload = $img_path.$new_img_name;
    $success = move_uploaded_file($_FILES['news_img']['tmp_name'],$upload);//อัพโหลดไฟล์
    $updateImage = "UPDATE `resume` SET image = '$new_img_name' where user_id = '$row_userID' ";//คำสั่งอัพเดท
    $queryImage = mysqli_query($connect,$updateImage);//query รูปภาพใหม่
    if($success==false){
        echo "ไม่สามารถอัพโหลดได้";
    exit();
    }
}

//อัพเดทชื่อ
$updatename = "UPDATE `personal_data` SET `Name`= '$name',`LastName`= '$lastName' WHERE user_id = $row_userID";
$queryname = mysqli_query($connect,$updatename);


//อัพเดท resume
$updateResume = "UPDATE `resume` SET `resume_address`='$address',`target_jobs`='$target_jobs',`education`='$education' \n"
               . ",`education_name`='$edu_name',`skill`='$skill',`jobs_exp`='$exp',`resume_email`='$email',`resume_tel`='$tel' \n"
               . "WHERE user_id = '$row_userID' ";

$queryResume = mysqli_query($connect,$updateResume);
if($queryResume){?>
    <script>
        alert("Successfully Edit");window.location = "myresume.php?id=<?php echo $row_userID ?>";
    </script>
<?php
}?>
<?php
include 'ConnectDB.php';
include  'session.php';
$Address = $_POST['Address'];
$TargetJobs = $_POST['TargetJobs'];
$Education = $_POST['Education'];
$Skills= $_POST['Skills'];
$exp = $_POST['exp'];
$Email = $_POST['Email'];
$Tel = $_POST['Tel'];
$EducationName = $_POST['EducationName'];


//upload img
$img = pathinfo(basename($_FILES['news_img']['name']),PATHINFO_EXTENSION);//ดึงนามสกุลไฟล์
$new_img_name = 'Reseme_'.uniqid()/*ฟังก์ชั่นสุ่มชื่อไฟล์*/.".".$img;
$img_path ="./ResumeImage/";
$upload = $img_path.$new_img_name;
$success = move_uploaded_file($_FILES['news_img']['tmp_name'],$upload);
if($success==false){
    echo "ไม่สามารถอัพโหลดได้";
    exit();
}


//insert
$insert = "INSERT INTO `resume`(`user_id`, `resume_address`, `target_jobs`, `education`,`education_name`, `skill`, `jobs_exp`, `resume_email`, `resume_tel`, `image`) 
           VALUES ('$row_userID','$Address','$TargetJobs','$Education','$EducationName','$Skills','$exp','$Email','$Tel','$new_img_name')";
$Resume = mysqli_query($connect,$insert);
if ($Resume){?>
    <script>
        alert("Successfully Create resume");window.location = "Home.php";    
    </script>
<?php
}else{
    echo "ข้อผิดพลาด".mysqli_error($connect);
}



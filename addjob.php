<?php
include 'ConnectDB.php';
include  'session.php';
$jobs_head = $_POST['jobs_head'];
$jobs_data = $_POST['jobs_data'];
$jobs_class = $_POST['jobs_class'];
$jobs_edu= $_POST['jobs_edu'];
$jobs_salary= $_POST['jobs_salary'];
$employment_type = $_POST['employment_type'];
$jobs_loca = $_POST['jobs_loca'];
$jobs_exp = $_POST['jobs_exp'];

//upload img
$img = pathinfo(basename($_FILES['news_img']['name']),PATHINFO_EXTENSION);//ดึงนามสกุลไฟล์
$new_img_name = 'news_'.uniqid()/*ฟังก์ชั่นสุ่มชื่อไฟล์*/.".".$img;
$img_path ="./imgNew/";
$upload = $img_path.$new_img_name;
$success = move_uploaded_file($_FILES['news_img']['tmp_name'],$upload);
if($success==false){
    echo "ไม่สามารถอัพโหลดได้";
    exit();
}


//insert
$insert = "INSERT INTO `jobs_detail`
            (`user_id`, `jobs_head`,`jobs_data`,`jobs_edu`, `jobs_contact`, `jobs_salary`, 
            `employment_type`, `jobs_date`, `jobs_exp`, `jobs_class`,`image`) 
            VALUES ('$row_userID','$jobs_head','$jobs_data','$jobs_edu','$jobs_loca','$jobs_salary','$employment_type',NOW(),'$jobs_exp','$jobs_class','$new_img_name')";
$jobs = mysqli_query($connect,$insert);
if ($jobs){?>
    <script>
        alert("Successfully Create job");window.location = "Home.php";
    </script>
<?php
}else{
    echo "ข้อผิดพลาด".mysqli_error($connect);
}



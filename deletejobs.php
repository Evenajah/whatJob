<?php
    include "ConnectDB.php";
    include "session.php";
    $id = $_GET['id'];
    $select = "select image from jobs_detail where jobs_id = '$id'";
    $queryImg = mysqli_query($connect,$select);//ดึงรูปภาพออกมาก่อน
    $news_img = mysqli_fetch_row($queryImg);//ดึงออกมาจากตาราง
    $filename = $news_img[0]; //เลือกตำแหน่งโดยอ้างIndex(0)เพราะมีแถวเดียว
    unlink('./imgNew/'.$filename);//คำสั่งลบรูปภาพ

    //ลบข้อมูลจากตาราง(query ปกติ)
    $deleteNoti = "DELETE FROM `notification` WHERE jobs_id =  '$id'";
    $deleteCount = "DELETE FROM `counter` WHERE jobs_id = '$id'";
    $deleteHost = "DELETE FROM `confirm` WHERE jobs_id = '$id' ";
    $delete = "DELETE FROM `jobs_detail` where jobs_id = '$id'";
    $Noti_delete = mysqli_query($connect,$deleteNoti);
    $Count_delete = mysqli_query($connect,$deleteCount);
    $host_delete = mysqli_query($connect,$deleteHost);
    $res_delete = mysqli_query($connect,$delete);

    if($res_delete && $host_delete && $Count_delete && $Noti_delete){?>
        <script>
            alert("Succesfully delete job");window.location="myjob.php";
        </script>
      <?php
    }else{
        echo"เกิดข้อผิดพลาด".mysqli_error($connect);
    }
    mysqli_close($connect);
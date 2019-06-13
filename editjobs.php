<!DOCTYPE html>
<html>
<head>
    <title>Editjob</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/design.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="img/logo01.png"/>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body>
<style>
      label{
        text-align:left;
        margin-left:150px;
        font-size:25px;
        padding:10px;
        display:block;
        
    }
    body{
        font-family:san-serif;
        background:url(img/vector09.jpg) no-repeat;
        background-size:cover;
        width:100%;
        height:100%;
        margin:0;
        padding:0;
    }   
    h2{
        font-size:40px;
        letter-spacing:3px;
        font-weight:bold;
    }
    h3{
        font-size:30px;
        letter-spacing:2px;
        font-weight:bold;
    }      
    a:hover{
        color:grey;
    }
</style>


<!--include php-->
<?php
include 'ConnectDB.php';
include 'session.php';
include 'SelectDatabase.php';
include 'timestamp.php';

$jobs_id = $_GET['id'];

//ต่อสตริง
$Noti .="WHERE jobs_detail.user_id =  '$row_userID' ORDER BY notification.noti_id DESC LIMIT 3";
$accept .="WHERE confirm.user_regis = '$row_userID' ORDER BY confirm.confirm_id DESC LIMIT 3";

//query
$queryNoti = mysqli_query($connect,$Noti);
$queryAccept = mysqli_query($connect,$accept);

$select = "SELECT * FROM `jobs_detail` where jobs_id = '$jobs_id'";
$query = mysqli_query($connect,$select);
$fetch = mysqli_fetch_array($query);


?>


<!-- Navbar -->
<div class="wrap">
<div class="w3-top">
  <div class="w3-bar w3-black w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="Home.php" class="w3-bar-item w3-button w3-padding-small w3-hover-black "><img src="img/logo02.png" width="38px"></a>
    <?php

// เช็คว่ามี Resume ไหม 
    if($Personal && $Resume){?>
        <a href="Myresume.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">MY RESUME</a>
    <?php }

//ไม่มี ขึ้น javascript
    else{?>
      <a onclick = "pop()" class="w3-bar-item w3-button w3-padding-large w3-hide-small">MY RESUME</a>
        <div id = "boxAlert">
          <span class ="ion-android-alert"></span>
          <h2>Please Create PersonalData & Resume</h2><br>
          <a onclick = "pop()" class = "go">Close</a>&nbsp;&nbsp;
          <a href = "CreatePersonalData.php" class = "go">Go to Create</a><br><br>
        </div> 
    <?php }

//เช็คว่ามี resume ไหม
    if($Personal && $Resume){?>
        <a href="Myresume.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">CREATE RESUME</a>
    <?php }

//ไม่มี ให้ Create ได้
    else{?>
        <a href="CreatePersonalData.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">CREATE RESUME</a>
    <?php } ?>
    <a href="FindJobs.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">FIND JOBS</a>
    <a href="CreateJob.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">CREATE JOBS</a>

    <!--userData-->
    <div class="w3-dropdown-hover w3-hide-small w3-right w3-margin-right">
      <button class="w3-padding-small w3-button w3-margin-right" title="ACCOUNT"><div class="w3-margin-right">
      <img class="w3-margin-right" src="img/people.png" width = "38px"></div></button>
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="account.php" class="w3-bar-item w3-button"><?php echo $row_username;?></a>
        <a href="myjob.php" class="w3-bar-item w3-button">My job</a>
        <a href="logout.php" class="w3-bar-item w3-button">Sign out</a>
        
      </div>
    </div>

    <!--Notification-->
    <div class="w3-dropdown-hover w3-right w3-hide-small">
      <a href = "Mailbox.php"><button class="w3-padding-large w3-button" title="Mailbox"><i class="far fa-envelope"></i></button></a>
      <div class="w3-dropdown-content w3-bar-block w3-card-3">

      <?php 
// นำค่า Notification มาแสดง
       while($rows_Noti = mysqli_fetch_assoc($queryNoti)){?> 

       <!--Call function-->
        <?php $ago = timestamp($rows_Noti['date'])?>  
        <a href="reciveResume.php?id=<?php echo $rows_Noti['user_id'];?>&job=<?php echo $rows_Noti['jobs_id'];?>" class="w3-bar-item w3-button">

          <b><?php echo $rows_Noti['username'];?></b>&nbsp;Have sent Resume <b>jobs_id : <?php echo $rows_Noti['jobs_id'];?></b><br>
          <i class="fas fa-clock"></i>&nbsp;<?php echo $ago?></a>

      <?php }
      //คืน Memory
      mysqli_free_result($queryNoti);

//นำค่า accept resume มาแสดง
      while($rows_Accept = mysqli_fetch_assoc($queryAccept)){?> 

      <!--Call function-->
        <?php $ago2 = timestamp($rows_Accept['date'])?>  
        <a href="agreement.php?id=<?php echo $rows_Accept['confirm_id'];?>" class="w3-bar-item w3-button w3-sand">

          <b><?php echo $rows_Accept['username'];?></b>&nbsp;Has Accept Resume <b>jobs_id : <?php echo $rows_Accept['jobs_id'];?></b><br>
          <i class="fas fa-clock"></i>&nbsp;<?php echo $ago2?></a>

      <?php } 
      //คืน Memory
      mysqli_free_result($queryAccept);
      ?>
      </div>
    </div>

<!--SearchPopUp >> javascriptFunctionSearching-->
<a onclick = "searching()" class="w3-padding-large w3-hover-dark-grey w3-hide-small w3-right w3-black"><i class="fa fa-search"></i></a>
            <!--Searching(funtion pop)-->
      <div id="searching">

<!--Form ค้นหา-->
            <form action = "Search.php" method ="post" name = "searchBar">
                <div class="inputWithIconSearch inputIconBgSearch">
                    <input type="text" name="keyword" class="inputSearch" placeholder="Type to search..." autofocus required >
                    <i class="fa fa-search fa-lg fa-fw" ></i>
                </div>
              <input type = "submit" class="ButtonSearch" value="GO!">
            </form>
            <span class = "btnClose"><a onclick = "searching()" class = "close"><i class="fa fa-times fa-lg fa-fw"></i></a></span>
              <br><br><br>
              <p></p>
            </div>
      </div>     
  </div>
  </div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
  <?php
// เช็คว่ามี Resume ไหม 
    if($Personal && $Resume){?>
    <a href="Myresume.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">MY RESUME</a>
    <?php }

//ไม่มี ขึ้น javascript
    else{?>
      <a onclick = "pop()" class="w3-bar-item w3-button w3-padding-large w3-hide-small">MY RESUME</a>
        <div id = "boxAlert">
          <span class ="ion-android-alert"></span>
          <h2>Please Create PersonalData & Resume</h2><br>
          <a onclick = "pop()" class = "go">Close</a>&nbsp;&nbsp;
          <a href = "CreatePersonalData.php" class = "go">Go to Create</a><br><br>
        </div> 
    <?php }?>

  <a href="CreateResume.php" class="w3-bar-item w3-button w3-padding-large">CREATE RESUME</a>
  <a href="FindJobs.php" class="w3-bar-item w3-button w3-padding-large">FIND JOBS</a>
  <a href="CreateJob.php" class="w3-bar-item w3-button w3-padding-large">CREATE JOBS</a>
</div>



<div class="CreateJob">
<br>
<span class="icon"><i class="fas fa-edit"></i></span>
<h2 class = "heading">EDIT JOB ID : <?php echo $jobs_id?></h2>
<h3 class = "heading">Please fill in the application form.</h3>
<form name="editjobs" action = updatejob.php method="POST" enctype="multipart/form-data">
   

<!--jobs_head-->
    <label for="่jobs_head">Topic</label>
    <input type="text" name="jobs_head"class="TextFrame" required size = "40" value = "<?php echo $fetch['jobs_head']; ?>" >
    <br><br>


<!--jobs_img-->
    <label for "imageOld"></label>
    <label for="news_img" >Image</label>
    <a name = "imageOld" class="TextFrame"  href = "./imgNew/<?php echo $fetch['image'];/*ลิ้งไปยังที่อยู่ของรูปภาพ*/?>">link</a><br>
    <br>
    <img src = "./imgNew/<?php echo $fetch['image'];/*ลิ้งไปยังที่อยู่ของรูปภาพ*/?>" width="200" >
    <br> <br>
    <input type ="file"  name ="news_img">
    <br><br>


<!--jobs_detail-->
    <label for="jobs_data">Detail</label>
    <textarea name ="jobs_data" size="50" class="TextFrame" rows="10" required>
        <?php echo $fetch['jobs_data']; ?>
    </textarea>
    <br><br>


<!--jobs_class-->
    <label for="jobs_class">Class</label>
    <select name="jobs_class" class="TextFrame" required>
        <?php
        $select_jobsclass = "SELECT * FROM `jobs_class`";//ดึงข้อมูลจากตารางคีย์นอกออกมาก่อน
        $queryjobsclass = mysqli_query($connect,$select_jobsclass);
        while($rowsOfClass = mysqli_fetch_assoc($queryjobsclass)){//เงื่อนไขเปรียบเทียบ id ระหว่างตาราง
            if($rowsOfClass['jobs_class_id'] == $fetch['jobs_class']){//หากเท่ากันให้ select auto
                echo '<option value ="'.$rowsOfClass['jobs_class_id'].'" selected>'/*<<คำสั่ง select auto*/.$rowsOfClass['jobs_class']. "</option>";
            }else{
                echo '<option value ="'.$rowsOfClass['jobs_class_id'].'">'.$rowsOfClass['jobs_class']. "</option>";
            }
        }
        ?>
    </select>
    <br><br>


<!--jobs_edu-->
    <label for="jobs_edu">Education</label>
    <select name="jobs_edu" class="TextFrame" required>
        <?php
        $select_edu = "SELECT * FROM `jobs_edu`";
        $queryedu = mysqli_query($connect,$select_edu);
        while($rowsOfEdu = mysqli_fetch_assoc($queryedu)){
            if($rowsOfEdu['edu_id'] == $fetch['jobs_edu']){
                echo '<option value ="'.$rowsOfEdu['edu_id'].'" selected>'.$rowsOfEdu['edu_name']. "</option>";
            }else{
                echo '<option value ="'.$rowsOfEdu['edu_id'].'">'.$rowsOfEdu['edu_name']. "</option>";
            }
        }
        ?>
    </select>
    <br><br>


<!--jobs_salary-->
    <label for="jobs_salary">Salary</label>
    <input type="number" name="jobs_salary" class="TextFrame" size = "40"value = "<?php echo $fetch['jobs_salary']; ?>" required>
    <br><br>



<!--jobs_employment-->
    <label for="employment_type">Employment</label>
    <select name="employment_type" class="TextFrame" required>
        <?php
        $select_employment = "SELECT * FROM `employment`";
        $queryEmployment = mysqli_query($connect,$select_employment);
        while($rowsOfEmployment = mysqli_fetch_assoc($queryEmployment)){
            if($rowsOfEmployment['employment_id'] == $fetch['employment_type']){
                echo '<option value ="'.$rowsOfEmployment['employment_id'].'" selected>'.$rowsOfEmployment['employment_name']. "</option>";
            }else{
                echo '<option value ="'.$rowsOfEmployment['employment_id'].'">'.$rowsOfEmployment['employment_name']. "</option>";
            }
        }
        ?>
    </select>
    <br><br>


<!--jobs_location-->
    <label for="jobs_loca">Location</label>
    <textarea name="jobs_loca" size="50" rows="6" class="TextFrame" required>
        <?php echo $fetch['jobs_contact']; ?>
    </textarea>
    <br><br>


<!--jobs_exp-->
    <label for="jobs_exp">Experience</label>
    <select name="jobs_exp" class="TextFrame" required>
        <?php
        $select_exp = "SELECT * FROM `jobs_exp`";
        $queryEXP = mysqli_query($connect,$select_exp);
        while($rowsOfExp = mysqli_fetch_assoc($queryEXP)){
            if($rowsOfExp['exp_id'] == $fetch['jobs_exp']){
                echo '<option value ="'.$rowsOfExp['exp_id'].'" selected>'.$rowsOfExp['exp_year']. "</option>";
            }else{
                echo '<option value ="'.$rowsOfExp['exp_id'].'">'.$rowsOfExp['exp_year']. "</option>";
            }
        }
        ?>
    </select>
    <br><br>


    <input type="hidden" name="jobs_id" value="<?php echo $fetch['jobs_id']; //ส่งรหัสข่าวด้วยอินพุท hidden = "แฝง"?>"> 
    <br>

<!--submit-->
    <input type="submit"  class="CreateBtn" value = "Edit" >
    <br><br><br>
    </div>
</form>
<br><br>
<!--Footer-->
<section>
  <div class = "Newsjob">     
        <!--footer-->
        <div class ="footer">          
              <br>      
              <p id = "Copyright">&copy; Copyright 2018</p>
              <hr id = "hrFooter" align="center">
              <p id = "Contact">Contact Us</p>
              <span class = "iconFB"><a class = "linkFooter" href = "https://www.facebook.com/evee.boonma"><i class="fab fa-facebook"></i></a></span>
              &nbsp;
              <span class = "iconFB"><a class = "linkFooter" href = "https://twitter.com/Boblennon41"><i class="fab  fa-twitter"></i></a></span>
              &nbsp;
              <span class = "iconFB"><a class = "linkFooter" href = "https://mail.google.com/mail/u/0/?tab=mm#inbox"><i class="fa fa-envelope"></i></a></span> 
              &nbsp;
              <span class = "iconFB"><a class = "linkFooter" href = "https://www.twitch.tv/Evenajah"><i class="fab fa-twitch"></i></a></span> 
              &nbsp;
              <span class = "iconFB"><a class = "linkFooter" href = "https://www.youtube.com/channel/UCFdghTb_LywZmiu4HNySw4A"><i class="fab fa-youtube"></i></a></span>
              &nbsp;
              <span class = "iconFB"><a class = "linkFooter" href = "https://github.com/Evenajah"><i class="fab fa-github"></i></a></span> 
              <br><br>        
        </div>
</section>
    </div>

<!--FunctionPop--> 
<script type= "text/javascript">
        var c = 0;
        function pop(){
          if(c==0){
            document.getElementById("boxAlert").style.display = "block";
            c = 1;
          }else{
            document.getElementById("boxAlert").style.display = "none";
            c = 0;
          }
        }
        var s = 0;
        function searching(){
          if(s==0){
            document.getElementById("searching").style.display = "block";
            s = 1;
          }else{
            document.getElementById("searching").style.display = "none";
            s = 0;
          }
        }
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html>

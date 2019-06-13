<!DOCTYPE html>
<html>
<title>PageNew</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css/design.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="icon" type="image/png" href="img/logo01.png"/>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<style>
        body {
          font-family:san-serif;
          background:url(img/vector09.jpg) no-repeat;
          background-size:cover;
          width:100%;
          height:100%;
          margin:0;
          padding:0;
      }                
       h2,h6,h3{
           margin-left:20px;
       }                                              
</style>
<body>
<?php
     include 'session.php';
     include 'ConnectDB.php';
     include 'SelectDatabase.php';
     include 'timestamp.php';

     $id = $_GET['id'];
//หาข้อมูลคนสร้างงาน -> เช็คให้ไม่สามารุสมัครงานตัวเองได้ -> ส่งผ่าน form
       $SelectJobHost = "SELECT user_id from jobs_detail WHERE jobs_id = '$id'";
       $queryHost = mysqli_query($connect,$SelectJobHost);
       $fetchHost = mysqli_fetch_assoc($queryHost);
       mysqli_free_result($queryHost);


//noti bar
        $Noti .="WHERE jobs_detail.user_id =  '$row_userID' ORDER BY notification.noti_id DESC LIMIT 3";
        $accept .="WHERE confirm.user_regis = '$row_userID' ORDER BY confirm.confirm_id DESC LIMIT 3";
        $queryNoti = mysqli_query($connect,$Noti);
        $queryAccept = mysqli_query($connect,$accept);


//การนับจำนวนผู้เข้าชม
     $date  =date("d-m-Y");
     $SelectFirst = "Select * from counter where jobs_id = '$id'";
     $queryFirst = mysqli_query($connect,$SelectFirst);
     $fetchFirst = mysqli_fetch_assoc($queryFirst);
     mysqli_free_result($queryFirst);

//เพิ่มค่าจำนวนผู้เข้าชม
     if($fetchFirst){
       $plus = $fetchFirst['visit'];
       $plusVisit = $plus+1;
       $updatevisit = "UPDATE `counter` SET `date_visit`='$date',`visit`='$plusVisit' WHERE jobs_id = $id";
       $queryUpdate = mysqli_query($connect,$updatevisit);
     }else{
       $insertCount ="INSERT INTO counter(`jobs_id`, `date_visit`, `visit`)VALUES
           ('$id','$date','1')";
       mysqli_query($connect,$insertCount);
       $plusVisit = 1;
     }            
     

//query แสดงงานด้วย id
     $sql .="WHERE jobs_id = '$id'";
     $queryjobs = mysqli_query($connect,$sql);
     $jobs  = mysqli_fetch_assoc($queryjobs);
     mysqli_free_result($queryjobs);

     //ตัดวันที่และเพิ่มเวลา (Function timestamp)
     $CutDate = substr($jobs['jobs_date'],0,10);
     $Time = timestamp($jobs['jobs_date']);
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
        <a href="Myresume.php?id=<?php echo $row_userID?>" class="w3-bar-item w3-button w3-padding-large w3-hide-small">MY RESUME</a>
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
        <a href="Myresume.php?id=<?php echo $row_userID?>" class="w3-bar-item w3-button w3-padding-large w3-hide-small">CREATE RESUME</a>
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

            
<!--Form ค้นหา-->
<div id="searching">
          <span class = "Closebtn"><a onclick = "searching()" class = "close"><i class="fa fa-times fa-lg fa-fw"></i></a></span>
            <form action = "Search.php" method ="post" name = "searchBar">
              <br>
            <span class = "iconSearch"><i class="fa fa-search fa-lg fa-fw" ></i></span>
            <br>
                    <input type="text" size = "30" name="keyword" class="SearchInput" placeholder="Type to search..." autofocus required >
                    <br>            
                <input type = "submit" value="GO!"  class="SearchBtn">
            </form>
              <br><br><br>
              <p></p>
            </div>
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

<br><br>
<div class = "wrapNew">
    <img src="./imgNew/<?php echo $jobs['image']?>"width = "1000" height="500">
    <div class = "jobsHead">
      <br>
        <h2 class="newsItem"><?php echo $jobs['jobs_head']?></h2>
        <hr align="center">
        <h6 class="newsItem"><i class="fa fa-calendar fa-fw w3-margin-right w3-large w3-black-teal"></i><?php echo $CutDate;?><h6>
        <h6 class="newsItem"><i class="fas fa-clock fa-fw w3-margin-right w3-large w3-black-teal"></i><?php echo $Time;?><h6>
        <h6 class="newsItem"><i class="fa fa-suitcase fa-fw w3-margin-right w3-large w3-black-teal"></i><?php echo $jobs['jobs_class'];?><h6>
        <h6 class="newsItem"><i class="fab fa-black-tie fa-fw w3-margin-right w3-large w3-black-teal"></i><?php echo $jobs['employment_name'] ;?><h6>
        <h6 class="newsItem"><i class="fa fa-eye fa-fw w3-margin-right w3-large w3-black-teal"></i><?php echo $plusVisit ;?><h6>
     
            <br>
    </div>
    
    
    <?php 
        //ตัดคำขึ้นบรรทัดใหม่(เผื่อไว้)
        $newtext = wordwrap($jobs['jobs_data'],100,"<br>");
    ?>

    <h3 class="newsItem">Detail</h3>
    <br>
    <p><h6 class="newsItem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $jobs['jobs_data'] ?></h6></p>
   <hr>
    <h3 class="newsItem">Requirement</h3>
    <br>
    <h6 class="newsItem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Education : <?php echo $jobs['edu_name']?></h6>
    <h6 class="newsItem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Experience : <?php echo $jobs['exp_year']?></h6>
    <p></p>
    <hr>
    <h3 class="newsItem">Compensational</h3>
    <br>
    <h6 class="newsItem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Salary : <?php echo $jobs['jobs_salary']?> BATH</h6>
    <p></p>
    <hr>
    <h3 class="newsItem">Contact</h3>
    <br>
    <h6 class="newsItem">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Location : <?php echo $jobs['jobs_contact']?></h6>
    <p></p>
  <br>

<form action="SendResume.php" name = "send" method="post">
     <input type="hidden" name="jobs_id" value ="<?php echo $id ;?>">
     <input type="hidden" name="user_id" value="<?php echo $row_user['user_id'] //ส่งรหัสuserด้วยอินพุท hidden = "แฝง";?>">
     <input type="hidden" name="jobs_host" value ="<?php echo $fetchHost['user_id'] ;?>">
   
     <input type="submit" class = "SendResume"  value = "SEND RESUME">
    <br><br><br>
</form>
</div>

<?php 
    mysqli_close($connect);
?>

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
</script>  
</body>
</html>

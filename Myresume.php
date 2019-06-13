<!DOCTYPE html>
<html>
<title>Myresume</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css/design.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="icon" type="image/png" href="img/logo01.png"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<?php
    include 'session.php';
    include 'ConnectDB.php';
    include 'SelectDatabase.php';
    include 'timestamp.php';
    $user_id = $_GET['id'];
       
//noti bar
        $Noti .="WHERE jobs_detail.user_id =  '$row_userID' ORDER BY notification.noti_id DESC LIMIT 3";
        $accept .="WHERE confirm.user_regis = '$row_userID' ORDER BY confirm.confirm_id DESC LIMIT 3";
        $queryNoti = mysqli_query($connect,$Noti);
        $queryAccept = mysqli_query($connect,$accept);

 
//ต่อสตริง
    $recivePersonalData .="WHERE user_id = '$user_id'";
    $reciveResume .="WHERE user_id = '$user_id'";
    $reciveEdu .="WHERE user_id = '$user_id'";
    $reciveExp .="WHERE user_id = '$user_id'";
    

//query
    $queryPersonal = mysqli_query($connect,$recivePersonalData);
    $queryResume = mysqli_query($connect,$reciveResume);
    $queryEdu = mysqli_query($connect,$reciveEdu);
    $queryExp = mysqli_query($connect,$reciveExp);
   


//fetch
    $Personal = mysqli_fetch_assoc($queryPersonal);
    $Resume = mysqli_fetch_assoc($queryResume);
    $Edu = mysqli_fetch_assoc($queryEdu);
    $Exp= mysqli_fetch_assoc($queryExp);
?>
<style>

@import "http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css";

html,body,h1,h2,h3,h4,h5,h6 {
    font-family: "Roboto", sans-serif
}
body{
    background-image:url(img/vector10.jpg);
    
}
</style>
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




    <!-- The Grid -->
  <div class="w3-row-padding">
  
  <!-- Left Column -->
  <br><br><br>
  <h2 class ="ResumeID">ResumeID : <?php echo $user_id?></h2>
  <br><br>
  <div class="w3-third">
  
    <div class="w3-white w3-text-black w3-card-4">
      <div class="w3-display-container">
        <img src="./ResumeImage/<?php echo $Resume['image'] ;?>" style="width:100%" alt="Avatar">
      </div>
      <div class="w3-container">
        <br>
        <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>Looking for : <?php echo $targetJob['jobs_class'];?></p>
        <br>
        <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $Resume['resume_address'];?></p>
        <br>
        <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $Resume['resume_email'];?></p>
        <br>
        <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i><?php echo $Resume['resume_tel'];?></p>
        <hr>

        <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-teal"></i>Skills</b></p>
        <div class="w3-container">
        <br>
        <?php echo $Resume['skill'];?>
      </div>
      <br>        
      </div>
    </div>

  <!-- End Left Column -->
  </div>

  <!-- Right Column -->
  <div class="w3-twothird">
  
    <div class="w3-container w3-card w3-white w3-margin-bottom">
      <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i></i>
      <?php echo $Personal['Name']; ?>&nbsp;<?php echo $Personal['LastName'];?></h2>
      <div class="w3-container">
        <p class="w3-opacity"><b>Nationality : <?php echo $Personal['Nationality'];?></b><p>
        <br>
        <p class="w3-opacity"><b>Race : <?php echo $Personal['Race'];?></b></p>
        <br>
        <p class="w3-opacity"><b>Religion : <?php echo $Personal['Religion'];?></b></p>
        <br>
        <p class="w3-opacity"><b>Status : <?php echo $Personal['status'];?></b></p>
        <br>
        <p class="w3-opacity"><b>Age : <?php echo $Personal['age'];?></b></p>
        <hr>
        
      </div>
      <div class="w3-container">
        <h5 class="w3-opacity"><b>Education</b></h5>
        <br>
        <p class="w3-opacity"><b>Grade : <?php echo $Edu['edu_name'];?></b></p>
        <br>
        <p class="w3-opacity"><b>Place : <?php echo $Resume['education_name'];?></b></p>
        <br>
        
      </div>
      <hr>
      <div class="w3-container">
        <h5 class="w3-opacity"><b>Experience</b></h5>
        <br>
        <p class="w3-opacity"><b>Exp : <?php echo $Exp['exp_year'];?></b></p>
        <br><br>
      </div>
      
    <a href = "EditResume.php"><span class = "editIcon"><i class="fas fa-edit"></i></span></a>
    <br><br>
    </div>     
    
  <!-- End Right Column -->
  </div>
  
<!-- End Grid -->
</div>

<!-- End Page Container -->
</div>  
<br><break>
  
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

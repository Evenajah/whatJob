<!DOCTYPE html>
<html>
<title>Result keyword</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css/design.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="icon" type="image/png" href="img/logo01.png"/>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<?php
        include 'session.php';
        include 'ConnectDB.php';
        include 'SelectDatabase.php';
        include 'timestamp.php';
        include 'CutString.php';

        //recive from Search bar >> Home.php
        $keyword = $_POST['keyword'];
        $sql .=   "WHERE jobs_detail.jobs_head LIKE '%$keyword%'"
                ."OR jobs_detail.jobs_data LIKE '%$keyword%'"
                ."OR jobs_detail.jobs_contact LIKE '%$keyword%'"
                ."OR employment.employment_name LIKE '%$keyword%'"
                ."OR jobs_class.jobs_class LIKE '%$keyword%'
                ORDER BY jobs_detail.jobs_id DESC";
        $querySearch = mysqli_query($connect,$sql);
        $rows = mysqli_num_rows($querySearch);

//ต่อสตริง
    $Noti .="WHERE jobs_detail.user_id =  '$row_userID' ORDER BY notification.noti_id DESC LIMIT 3";
    $accept .="WHERE confirm.user_regis = '$row_userID' ORDER BY confirm.confirm_id DESC LIMIT 3";

//query
    $queryNoti = mysqli_query($connect,$Noti);
    $queryAccept = mysqli_query($connect,$accept);
     
?>
<style>
  @import "http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css";
        body {
            font-family: "Lato", sans-serif;
            background-image: url(img/vector09.jpg)}
        .mySlides {
            display: none}
       
        #Head{
         position:absolute;
         top:1%;
         left:45%;
       }   
       
                           
</style>
<body>
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


<!--content-->
<?php
if($rows != 0){?>
<!-- Page content -->
<br><br><br>
<section>


  <div class = "Newsjob">
      <div class="new">
        <p></p>
        <div class="liner"> 
        <span class="icon"><i class="fas fa-list-alt"></i></span><br>             
					<h1 id = "New">RESULT OF <?php echo $keyword ?></h1>					      
        <p></p>
        </div>
        <hr>
       
				<div id="ourserv">
        <?php
  while($rows_jobs = mysqli_fetch_assoc($querySearch)){
        //ตัดสตริง
          $CutHead = CutString($rows_jobs['jobs_head'],0,18);
          $CutDetail = CutString($rows_jobs['jobs_data'],0,35);
        ?>
					<article>
            <h1><?php echo $CutHead?></h1>
        <div class="post">
            <a href = "#"><img src="./imgNew/<?php echo $rows_jobs['image'];?>" alt="" /></a>
            <div class = "post-s">
                <h2><a href = "PageNew.php?id=<?php echo $rows_jobs['jobs_id']; ?>">Read More</a></h2>
            </div>
        </div>
            <p></p>
          <div class ="HomeContent">
            <p class = "detail">&nbsp;&nbsp;&nbsp;<?php echo $CutDetail?></p>

            <!--Call funtion-->
            <?php $agoNews = timestamp($rows_jobs['jobs_date'])?> 

            <p class = "dateclass">&nbsp;&nbsp;&nbsp;<i class="fas fa-list-alt"></i>&nbsp;&nbsp;&nbsp;<?php echo $rows_jobs['jobs_id'] ?></p>
            <p class = "dateclass">&nbsp;&nbsp;&nbsp;<i class="fas fa-suitcase">&nbsp;&nbsp;&nbsp;</i>&nbsp;&nbsp;&nbsp;<?php echo $rows_jobs['jobs_class'] ?></p>
            <p class = "dateclass">&nbsp;&nbsp;&nbsp;<i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;<?php echo $agoNews ?></p>
					</article>
          <?php } 
          //คืน Memory
          mysqli_free_result($queryjobs);
          ?>

        </div>
        </div>
        <br>
    </div>
    <br><br>


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
<?php }else{?>
        <script>
            alert('ไม่พบผลลัพธ์การค้นหา');window.location ="Home.php";
        </script>
        <?php
        }?>
				
<script>
// Automatic Slideshow - change image every 4 seconds
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 4000);    
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

// When the user clicks anywhere outside of the modal, close it
var modal = document.getElementById('ticketModal');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>




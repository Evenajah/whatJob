<!DOCTYPE html>
<html>
<title>Create interview</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css/design.css">
<link rel="stylesheet" href="css/style.css">
<link rel="icon" type="image/png" href="img/logo01.png"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<?php
        include 'session.php';
        include 'ConnectDB.php';
        include 'SelectDatabase.php';
        include 'timestamp.php';

    //ต่อสตริง
        $Noti .="WHERE jobs_detail.user_id =  '$row_userID' ORDER BY notification.noti_id DESC LIMIT 3";
        $accept .="WHERE confirm.user_regis = '$row_userID' ORDER BY confirm.confirm_id DESC LIMIT 3";
        
    //query
        $queryNoti = mysqli_query($connect,$Noti);
        $queryAccept = mysqli_query($connect,$accept);


    //รับตัวแปร
        $userHost = $_POST['user_host'];
        $userID = $_POST['user_id'];
        $jobs_id = $_POST['jobs_id'];
    
?>
<style>
  @import "http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css";
      body{
          font-family: sans-serif;
          background-image: url(img/raster04.jpg);
      }
     
     
      a:hover{
        color:black;
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




<div class = "dialogAccept">
    <form action = "insertAccept.php" name = "dialogAccept" method="post">
      
    <!--input hidden-->
            <input type="hidden" name="jobs_id" value ="<?php echo $jobs_id ;?>">
            <input type="hidden" name="user_host" value="<?php echo $userHost //ส่งรหัสuserด้วยอินพุท hidden = "แฝง";?>">
            <input type="hidden" name="user_id" value ="<?php echo $userID ;?>">
            <br>     

    <!--นัด-->
        <label for="interview" class = "HeadConfirm">Detail of Interview</label><br><br>
        <textarea name="interview"  required  class="TextConfirm"></textarea>
        <br><br>
        
      
    <!--submit-->
            <input type ="submit" class ="btnConfirm" value ="CONFIRM">
    </form>

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

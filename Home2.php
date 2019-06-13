<!DOCTYPE html>
<html>
<title>Home2</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="css/design.css">
<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="icon" type="image/png" href="img/logo01.png"/>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<?php
        include 'CutString.php';
        include 'session.php';
        include 'ConnectDB.php';
        include 'SelectDatabase.php';
        include 'timestamp.php';

        //Select
        $other = $sql;
        $sql .="ORDER BY jobs_id DESC LIMIT 8";  
        $hot .="ORDER BY visit DESC LIMIT 6";
        $other .= "ORDER BY jobs_id DESC LIMIT 10,15";
        $Noti .="WHERE jobs_detail.user_id =  '$row_userID' ORDER BY notification.noti_id DESC LIMIT 3";
        $accept .="WHERE confirm.user_regis = '$row_userID' ORDER BY confirm.confirm_id DESC LIMIT 3";


        //query
        $queryAlljobs = mysqli_query($connect,$All);
        $queryJobsClass = mysqli_query($connect,$SelectClass);
        $queryNoti = mysqli_query($connect,$Noti);
        $queryAccept = mysqli_query($connect,$accept);
        $queryOther = mysqli_query($connect,$other);
        $queryhot = mysqli_query($connect,$hot);
        $queryjobs = mysqli_query($connect,$sql); 

        //ตัวแปรใช้เก็บตัวนับ jobs_class
        $arrayClass = array();

        //เลือกjobsClassทั้งหมดใน Database
        $queryJobsClass = mysqli_query($connect,$SelectClass);
    while($rows_class = mysqli_fetch_assoc($queryJobsClass)){
          $rows_class = $rows_class['jobs_class'];

          //Select นับจำนวน reccord
          $CountClass = "SELECT COUNT(jobs_detail.jobs_class) as CountClass FROM jobs_detail INNER JOIN jobs_class ON jobs_detail.jobs_class = jobs_class.jobs_class_id\n"
          . "WHERE jobs_class.jobs_class = '$rows_class'";;
          
          $queryCountClass = mysqli_query($connect,$CountClass);
          $fetch = mysqli_fetch_assoc($queryCountClass);
          //เก็บค่าที่ได้ใน array
          array_push($arrayClass,$fetch['CountClass']);
      }
      mysqli_free_result($queryCountClass);
?>
<style>
  @import "http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css";
      body{
          font-family: sans-serif;
          background-image: url(img/vector25.jpg);
         
      }      
      a:hover{
        color:black;
      }             
      body{
        margin:0;
    }
    .navbarAll{
        width:100%;
        background-color:black;
        color:white;
        height:50px;
        position:fixed; 
        z-index:1000;
    }
    .navbar{
        margin-top:-50px;
        font-size:25px;
        padding:10px;
        text-decoration:none;
        color:white;    
    }
    .navbar img{
        width:50px;
        height:50px;
    }
    .navbar:hover{
        background-color:#DCDCDC;
        color:black;
        transition:0.3s;
    }      
    .mail{
        float:right;
        background-color:black;
        color:white;
        border:none;
        padding:10px;
        margin-bottom:50px;
    } 
    .mail:hover{
        cursor:pointer;
        background-color:#DCDCDC;
        color:black;
        transition:0.3s;
    } 
    #searching{
    position : absolute;
    transform:translate(-50%,-50%);
    top: 50%;
    left:50%;
    opacity:0.9;
    overflow:hidden;
    border:none;
    box-shadow:0 0 20px black;
    border-radius:15px;
    width:500px;
    background:#DCDCDC;
    font-size:20px;
    z-index:9999;
    padding:10px;
    text-align:center;  
    display:none;
  }
</style>
<body>
  
<!-- Navbar -->
<!--navbar-->
<div class = "navbarAll">
    <p></p>
    <a class = "navbar" href = "Home2.php">หน้าแรก</a>
    <a class = "navbar" href = "Myresume.php">เรซูเม่ของฉัน</a>
    <a class = "navbar" href = "CreatePersonalData.php">สร้างรีซูเม่</a>
    <a class = "navbar" href = "FindJobs.php">ค้นหางาน</a>
    <a class = "navbar" href = "CreateJob.php">สร้างงาน</a>
    <a href = "Mailbox.php"><button class="mail" title="Mailbox"><i class="far fa-envelope"></i></button></a>
    <a href="account.php" class="mail"><?php echo $row_username;?></a>
    <a onclick = "searching()" class="mail"><i class="fa fa-search"></i></a>
 </div>
<br>

 


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




<!-- Page content -->
<div class="w3-content" style="max-width:5000px;margin-top:40px">


<!-- Automatic Slideshow Images -->
<div id="slider" >
<figure>
  <img src="img/vector03.jpg">
  <img src="img/vector09.jpg" >
  <img src="img/vector15.jpg" >
  <img src="img/vector06.jpg" >
  <img src="img/vector08.jpg" >
  <img src="img/vector04.jpg" >
  <img src="img/vector13.jpg" >
  <img src="img/vector03.jpg" >
  <img src="img/vector11.jpg" >
  <img src="img/vector09.jpg" >
  <img src="img/vector06.jpg" >
  <img src="img/vector16.jpg" >
  <img src="img/vector03.jpg" >
  <img src="img/vector09.jpg" > 
 
  
</figure>	
</div>




<br>
<div class = Ribbon>
  <h2>หมวดหมู่</h2><br><br>
  <?php $Alljobs = mysqli_fetch_assoc($queryAlljobs);?>
  <p><a class = "CategoryClass" href="Category.php?id=""" class="w3-bar-item w3-button w3-sand">All jobs(<?php echo $Alljobs['jobs_id'];?>)</a></p>
  <hr>
  <?php 
  $queryJobsClass2 = mysqli_query($connect,$SelectClass);
  $i = 0;
  while($Name_class = mysqli_fetch_assoc($queryJobsClass2)){
      $Name_class = $Name_class['jobs_class'];?>
      <a class = "CategoryClass" href="Category.php?id=<?php echo $Name_class;?>" class="w3-bar-item w3-button w3-sand"><?php echo $Name_class." ($arrayClass[$i])"?></a>
   <?php  
      $i++;     
  }
mysqli_free_result($queryJobsClass2)?>
</div>
<br>
<!--Content-->
<section>

<!--งานใหม่-->
  <div class = "Newsjob">
      <div class="new">
        <p></p>
        <div class="liner">              
					<h1 id = "New">งานใหม่</h1>					      
        <p></p>
        </div>
        <hr>
       
				<div id="ourserv">
        <?php
  while($rows_jobs = mysqli_fetch_assoc($queryjobs)){
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

<div class = "Newsjob2">


<!--งานยอดนิยม-->   
        <div class="liner">              
					<h1 id = "HeadHot">งานแนะนำ</h1>					      
        <p></p>
        </div>
        <hr>
        
				<div id="ourserv">
        <?php
  while($rows_hot = mysqli_fetch_assoc($queryhot)){
          //ตัดสตริง
          $CutHeadHot = CutString($rows_hot['jobs_head'],0,18);
          $CutDetailHot = CutString($rows_hot['jobs_data'],0,35);
        ?>
        <article>
						<h1><?php echo $CutHeadHot ?></h1>
				<div class="post">
              <a href = "#"><img src="./imgNew/<?php echo $rows_hot['image'];?>" alt="" /></a>
            <div class = "post-s">
              <h2><a href = "PageNew.php?id=<?php echo $rows_hot['jobs_id']; ?>">Read More</a></h2>
            </div>
        </div>
        <p></p>
        <div class = "HomeContent">
            <p></p>

             <!--Call funtion-->
             <?php $agoRecommend = timestamp($rows_hot['jobs_date'])?> 


            <p class = "detail">&nbsp;&nbsp;&nbsp;<?php echo $CutDetailHot?></p>
            <p class = "dateclass">&nbsp;&nbsp;&nbsp;<i class="fas fa-list-alt"></i>&nbsp;&nbsp;&nbsp;<?php echo $rows_hot['jobs_id'] ?></p>
            <p class = "dateclass">&nbsp;&nbsp;&nbsp;<i class="fas fa-suitcase"></i>&nbsp;&nbsp;&nbsp;<?php echo $rows_hot['jobs_class'] ?></p>
            <p class = "dateclass">&nbsp;&nbsp;&nbsp;<i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;<?php echo $agoRecommend ?></p>
            <p></p>
					</article>
          <?php }
          //คืน Memory
          mysqli_free_result($queryhot);?>
        
        </div>
        <br><br>
        </div>
        


<!--งานอื่นๆ-->
<div class = "Newsjob3">
      <div class="new">
        <p></p>
        <div class="liner">              
					<h1 id = "New">งานอื่นๆ</h1>					      
        <p></p>
        </div>
        <hr>
       
				<div id="ourserv">
        
        <?php
        
  while($rows_other = mysqli_fetch_assoc($queryOther)){
        //ตัดสตริง
          $CutHead = CutString($rows_other['jobs_head'],0,18);
          $CutDetail = CutString($rows_other['jobs_data'],0,35);
        ?>
					<article>
            <h1><?php echo $CutHead?></h1>
        <div class="post">
            <a href = "#"><img src="./imgNew/<?php echo $rows_other['image'];?>" alt="" /></a>
            <div class = "post-s">
                <h2><a href = "PageNew.php?id=<?php echo $rows_other['jobs_id']; ?>">Read More</a></h2>
            </div>
        </div>
            <p></p>
          <div class ="HomeContent">

          <!--Call funtion-->
          <?php $agoOther = timestamp($rows_other['jobs_date'])?> 

            <p class = "detail">&nbsp;&nbsp;&nbsp;<?php echo $CutDetail?></p>
            <p class = "dateclass">&nbsp;&nbsp;&nbsp;<i class="fas fa-list-alt"></i>&nbsp;&nbsp;&nbsp;<?php echo $rows_other['jobs_id'] ?></p>
            <p class = "dateclass">&nbsp;&nbsp;&nbsp;<i class="fas fa-suitcase">&nbsp;&nbsp;&nbsp;</i>&nbsp;&nbsp;&nbsp;<?php echo $rows_other['jobs_class'] ?></p>
            <p class = "dateclass">&nbsp;&nbsp;&nbsp;<i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;<?php echo $agoOther ?></p>
					</article>
          <?php } 
          //คืน Memory
          mysqli_free_result($queryOther);
          mysqli_close($connect);
          ?>
        <p></p>
        <div class="liner">              
					<a href = "Category.php?id="""><h3 class = "more">ดูทั้งหมด</h1></a>		      
        <p></p>
         <p></p>
        </div>
        </div>
      
    </div>
<br>

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

<?php
    require 'ConnectDB.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['Email'];
    //เข้ารหัส
    $salt = 'qwertyuiop[]ssdfvchnmhjhjkltnbcx';
    $hash_login_password = hash_hmac('sha256',$password,$salt);
    $sql = "select * from user where username = '$username'";
    $db_query = mysqli_query($connect,$sql);
    $check = mysqli_fetch_array($db_query,MYSQLI_ASSOC);
    if($check){?>
        <script>
            alert('user มีอยู่แล้ว');window.location='register.html';
        </script>
    <?php
        }
    else {
        $query = "INSERT INTO `user`(`username`, `password`, `email`) VALUES ('$username','$hash_login_password','$email')";
        $result = mysqli_query($connect,$query);
        if ($result) {?>
            <script>
                alert('สมัครสมาชิกเสร็จสิ้น');window.location='Login.html';
            </script>
            <?php
        }else{?>
            <script>
                alert('Email มีอยู่แล้ว');window.location='register.html';
            </script>
            <?php
        }
    }
    mysqli_close($connect);
    ?>



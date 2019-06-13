<?php
    require 'ConnectDB.php';
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location:first.html");
    }
    $session_login = $_SESSION['user_id'];
    $query = "SELECT `user_id`,`username` FROM `user` WHERE user_id= '$session_login'";
    $user = mysqli_query($connect,$query);
    if ($user){
        $row_user = mysqli_fetch_array($user,MYSQLI_ASSOC );
        $row_userID = $row_user['user_id'];
        $row_username = $row_user['username'];
        mysqli_free_result($user);
    }

?>
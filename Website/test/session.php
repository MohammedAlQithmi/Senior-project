<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   //$Enterprise_id=$_SESSION['Enterprise_id'];
   $ses_sql = mysqli_query($conn,"select Email from enrollment where Email = '$user_check' UNION select Email from system_admin where Email = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['Email'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>
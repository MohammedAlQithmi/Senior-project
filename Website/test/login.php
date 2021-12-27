<?php
include_once 'config.php';
//echo "fdgkdf";
session_start();


   if($_SERVER["REQUEST_METHOD"] == "POST") {
	
    $myusername =$_POST['email'];
    $mypassword=$_POST['password'];
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING );

    if($type=="system"){
        $sql="SELECT * from System_administrator where Email='$myusername' AND Password='$mypassword' limit 1";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        
        // If result matched $myusername and $mypassword, table row must be 1 row
          echo $count;
        if($count == 1) {
          
           $_SESSION['login_user'] = $myusername;
		   
           header("Location: ../system/index.html");
           exit;
        }else {
           $error = "Your Login Name or Password is invalid";
        }

    }
    else{
        $sql="SELECT User.User_id, User.Email, Enterprise_administrator.Password , User.Enterprise_id FROM (User INNER JOIN Enterprise_administrator ON User.User_id = Enterprise_administrator.User_id) where User.Type_id=2 and Enterprise_administrator.Password= '$mypassword' and User.Email= '$myusername' ";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);
        echo $count;
		$row = $result->fetch_assoc();
        // If result matched $myusername and $mypassword, table row must be 1 row
          
        if($count == 1) {
           
           $_SESSION['login_user'] = $myusername;
           $_SESSION['Enterprise_id'] = $row["Enterprise_id"];
           header("Location: ../enterprise/index.html");
           exit;
        }else {
           $error = "Your Login Name or Password is invalid";
        }


    }

    

  

   }
?>

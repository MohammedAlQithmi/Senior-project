<?php
include_once 'config.php';

mysql_connect($host, $email, $password);
mysql_select_db($db);
if(isset($_POST['email'])){
    $uname=$_POST['email'];
    $password=$_POST['password'];

    $sql="select * from xxxxx where user='".$uname."'And pass='".$password."'limit 1";

    $result=mysql_query($sql);

    if(mysql_num_rows($result)==1){
        echo "you have successfully logged in";
        exit();
    }
    else{
        echo "you have entered incorrect info";
        exit();
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>index_enterprise (Backup 1638711700706)</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Article-List.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <section class="login-dark">
        <div class="container">
            <form method="post" action="#" >
                <h2 class="visually-hidden">Login Form</h2>
                <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
                <div class="mb-3"><input class="form-control" type="email" name="email" placeholder="Email"></div>
                <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password" required="" minlength="8">
                    <div><select class="form-select" style="color: var(--bs-blue);">
                            <optgroup label="select type">
                                <option value="12" selected="">System admin</option>
                                <option value="13">Enterprise admin</option>
                            </optgroup>
                        </select></div>
                </div>
                <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit"><a href="#" style="color: var(--bs-white);">Log In</a></button></div><a class="forgot" href="#">Forgot your email or password?</a>
            </form>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
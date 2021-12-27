<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>System Admin (Backup 1638712301777)</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Article-List.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Header-Blue.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/styles.css">

  <style>
        
        .container{
            display : Grid;
            grid-auto-rows: auto;
            gap: 1em;
            margin: 3em 3em 3em 3em;
            height: 90%;

        }

        .panel{
            display : Grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            justify-content: center;
            padding : 0.5em;
            border-radius: 2px;
            

        }
        .items {
            display : Grid;
            grid-auto-rows: auto;
            gap: 0.5em;
        }
        .user {
            display : Grid;
            grid-template-columns:1fr 1fr 1fr 2fr 1fr 2fr 1fr;
            padding : 0.5em;
            border-radius: 2px;
        
            
        }
        .user:hover {
            background-color: rgba(255,255,255,.075);;
        }
        
        #alert {
            padding: 20px;
            background-color: #343A40;
            color: white;
            margin-bottom: 15px;
            display:none;
        }

        
        }
    </style>
</head>

<body>
    <section>
        <div class="container" style="background: url(&quot;assets/img/star-sky.jpg&quot;) center / cover no-repeat, url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;), var(--bs-indigo);width: 614px;">
            <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search">
                <div class="container-fluid"><a class="navbar-brand" href="index.html">Smart Workplace</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                            <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">Services</a>
                              <div class="dropdown-menu"><a class="dropdown-item" href="enrollment.html">Enrollment</a><a class="dropdown-item" href="Time.html">Time</a><a class="dropdown-item" href="Location.html">Location<br></a><a class="dropdown-item" href="APIs.php">APIs</a><a class="dropdown-item" href="Context.php">Context</a><a class="dropdown-item" href="delete_account.php">Delete Account</a></div>
                            </li>
                        </ul><span class="navbar-text" style="margin-left: 561px;"> <button class="btn btn-primary" type="button"><a href="http://34.89.127.223/web/test/logout.php">logout</a></button></span>
                    </div>
                </div>
            </nav>
			 
			

			<form  method="POST" >
			<label class="form-label" style="color: var(--bs-white);">User ID</label><input class="form-control" type="text" name= "User_Enterprise_id" placeholder="Enter the user ID ">
			<input type="submit" class="btn btn-primary btn-round mr-md-3 mb-md-0 mb-2" value="Delete" name="Delete" >
			</form>
			
    </section>
	
	
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

<?php  
require 'config.php';
session_start();
$Enterprise_id=$_SESSION['Enterprise_id'];
$userID = $_POST['User_Enterprise_id'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
$sql = "SELECT User_id FROM User WHERE User_Enterprise_id='$userID' and Enterprise_id='$Enterprise_id' " ;
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
$User_id=$row["User_id"];
	
$sql = "DELETE FROM Context WHERE User_id='$User_id'";
mysqli_query($conn, $sql);
$sql = "DELETE FROM User WHERE User_id='$User_id'";
mysqli_query($conn, $sql);

if ($conn->query($sql) === TRUE) {
  echo '<p style="color:white; text-align:center;" >Record updated successfully</p>';
} else {
  echo '<p style="color:white; text-align:center;" >Error updating record:</p>' . $conn->error;
}
}
?>

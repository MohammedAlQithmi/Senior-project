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
    <section>
        <div class="container" style="background: url(&quot;assets/img/star-sky.jpg&quot;) center / cover no-repeat, url(&quot;https://cdn.bootstrapstudio.io/placeholders/1400x800.png&quot;), var(--bs-white);">
            <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search">
                <div class="container-fluid"><a class="navbar-brand" href="#">Smart Workplace</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
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
            <form method="POST">

                <?php
			require 'config.php';
			session_start();
			$Enterprise_id=$_SESSION['Enterprise_id'];
			
			$sql = "SELECT Building_number FROM Location where Enterprise_id='$Enterprise_id'";
			$result = mysqli_query($conn,$sql);
			
			?>
			<div><label class="form-label" style="color: var(--bs-white);">Context</label></div>
            <label class="form-label" style="color: var(--bs-white);">building number</label>
			<select  name="Building_number" >
				<?php while ($row =  $result->fetch_assoc()) { ?>
				<option><?php echo $row["Building_number"] ?></option>
				<?php }  ?>
			</select><br>

						
               
            <?php
             //require 'config.php';
            $sql = "SELECT Room_number FROM Location where Enterprise_id='$Enterprise_id'";
            $result = $conn->query($sql);
            ?>
            <label class="form-label" style="color: var(--bs-white);">Room number</label>
            <select  name="Room_number" >
            <?php while ($row = $result->fetch_assoc()) { ?>
            <option><?php echo $row["Room_number"] ?></option>
            <?php }  ?>
            </select><br>

            <?php
            			//require 'config.php';
            			$sql = "SELECT Day FROM Time_slot where Enterprise_id='$Enterprise_id'";
            			$result = $conn->query($sql);
            			?>
            			<label class="form-label" style="color: var(--bs-white);">days</label>
            			<select  name="Day" >
            				<?php while ($row = $result->fetch_assoc()) { ?>
            				<option><?php echo $row["Day"] ?></option>
            				<?php }  ?>
            			</select><br>

                        
            <?php
			//require 'config.php';

			$sql = "SELECT Begin_time FROM Time_slot where Enterprise_id='$Enterprise_id' ";
			$result = $conn->query($sql);
			?>
			<label class="form-label" style="color: var(--bs-white);">Begin_time</label>
			<select  name="Begin_time" >
				<?php while ($row = $result->fetch_assoc()) { ?>
				<option><?php echo $row["Begin_time"] ?></option>
				<?php }  ?>
			</select><br>
            
            <?php
			//require 'config.php';
			$sql = "SELECT End_time FROM Time_slot where Enterprise_id='$Enterprise_id'";
			$result = $conn->query($sql);
			?>
			<label class="form-label" style="color: var(--bs-white);">End_time</label>
			<select  name="End_time" >
				<?php while ($row = $result->fetch_assoc()) { ?>
				<option><?php echo $row["End_time"] ?></option>
				<?php }  ?>
			</select><br>
                <?php

			//require 'config.php';
			$sql = "SELECT User_Enterprise_id FROM User where Enterprise_id='$Enterprise_id'";
			$result = $conn->query($sql);
			?>
			<label class="form-label" style="color: var(--bs-white);">User ID</label>
			<select  name="User_Enterprise_id" >
				<?php while ($row = $result->fetch_assoc()) { ?>
				<option><?php echo $row["User_Enterprise_id"] ?></option>
				<?php }  ?>
			</select><br> 
                
                <button class="btn btn-primary" type="submit" style="margin-bottom: 1px;margin-top: 24px;">Submit</button>
            </form>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

<?php  

if($_SERVER["REQUEST_METHOD"] == "POST"){
$user_check = $_SESSION['login_user'];



$Building_number = filter_input(INPUT_POST, 'Building_number', FILTER_SANITIZE_STRING );
$Day = filter_input(INPUT_POST, 'Day', FILTER_SANITIZE_STRING );
$Room_number = filter_input(INPUT_POST, 'Room_number', FILTER_SANITIZE_STRING );
$Begin_time = filter_input(INPUT_POST, 'Begin_time', FILTER_SANITIZE_STRING );
$End_time = filter_input(INPUT_POST, 'End_time', FILTER_SANITIZE_STRING );

$User_Enterprise_id = filter_input(INPUT_POST, 'User_Enterprise_id', FILTER_SANITIZE_STRING );
$sql = "SELECT Location_id FROM Location WHERE Building_number='$Building_number' and Room_number='$Room_number' and Enterprise_id='$Enterprise_id' " ;
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
$Location_id=$row["Location_id"];
$sql = "SELECT Time_slot_id FROM Time_slot WHERE Begin_time='$Begin_time' and End_time='$End_time' and Enterprise_id='$Enterprise_id' and Day='$Day'" ;
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
$Time_slot_id=$row["Time_slot_id"];
$sql = "SELECT User_id FROM User WHERE User_Enterprise_id='$User_Enterprise_id' and Enterprise_id='$Enterprise_id' " ;
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
$User_id=$row["User_id"];

$sql = "INSERT INTO Context (Location_id, Time_slot_id, User_id) VALUES ('$Location_id', '$Time_slot_id', '$User_id'); " ;
mysqli_query($conn, $sql);



}
?>

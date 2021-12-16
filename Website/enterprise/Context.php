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
                            <li class="nav-item"><a class="nav-link" href="#">home</a></li>
                            <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">servces</a>
                                <div class="dropdown-menu"><a class="dropdown-item" href="#">enrollment</a><a class="dropdown-item" href="#">Time</a><a class="dropdown-item" href="#">Location<br></a><a class="dropdown-item" href="#">APIs</a><a class="dropdown-item" href="#">Authorization</a></div>
                            </li>
                        </ul><span class="navbar-text" style="margin-left: 531px;"> <button class="btn btn-primary" type="button"><a href="Login.html">login</a></button></span>
                    </div>
                </div>
            </nav>
            <form method="POST">

                <?php
			require 'config.php';
			$sql = "SELECT Building_numbrer FROM Location";
			$result = $conn->query($sql);
			?>
			<div><label class="form-label" style="color: var(--bs-white);">Context</label></div>
            <label class="form-label" style="color: var(--bs-white);">Location ID_building number</label>
			<select  name="Building_numbrer" >
				<?php while ($row = $result->fetch_assoc()) { ?>
				<option><?php echo $row["Building_numbrer"] ?></option>
				<?php }  ?>
			</select><br>
                
            <?php
			require 'config.php';
			$sql = "SELECT Room_number FROM Location";
			$result = $conn->query($sql);
			?>
			<label class="form-label" style="color: var(--bs-white);">Room number</label>
			<select  name="Room_numbrer" >
				<?php while ($row = $result->fetch_assoc()) { ?>
				<option><?php echo $row["Room_numbrer"] ?></option>
				<?php }  ?>
			</select><br>
                
            <?php
			require 'config.php';
			$sql = "SELECT Begin_time FROM Time_slot";
			$result = $conn->query($sql);
			?>
			<label class="form-label" style="color: var(--bs-white);">Begin_time</label>
			<select  name="Begin_time" >
				<?php while ($row = $result->fetch_assoc()) { ?>
				<option><?php echo $row["Begin_time"] ?></option>
				<?php }  ?>
			</select><br>
            
            <?php
			require 'config.php';
			$sql = "SELECT End_time FROM Time_slot";
			$result = $conn->query($sql);
			?>
			<label class="form-label" style="color: var(--bs-white);">End_time</label>
			<select  name="End_time" >
				<?php while ($row = $result->fetch_assoc()) { ?>
				<option><?php echo $row["End_time"] ?></option>
				<?php }  ?>
			</select><br>
                
            <?php
			require 'config.php';
			$sql = "SELECT day FROM Time_slot";
			$result = $conn->query($sql);
			?>
			<label class="form-label" style="color: var(--bs-white);">days</label>
			<select  name="day" >
				<?php while ($row = $result->fetch_assoc()) { ?>
				<option><?php echo $row["day"] ?></option>
				<?php }  ?>
			</select><br>

            <?php
			require 'config.php';
			$sql = "SELECT User_Enterprise_id FROM User";
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
	
$user = filter_input(INPUT_POST, 'users', FILTER_SANITIZE_STRING );
$sql = "DELETE FROM users WHERE user='$user'";
 mysqli_query($conn, $sql);

if ($conn->query($sql) === TRUE) {
  echo '<p style="color:white; text-align:center;" >Record updated successfully</p>';
} else {
  echo '<p style="color:white; text-align:center;" >Error updating record:</p>' . $conn->error;
}
}
?>
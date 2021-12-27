<?php
include_once 'config.php';
session_start();
$Enterprise_id=$_SESSION['Enterprise_id'];
$beginTime = $_POST['Begin_time'];
$endTime = $_POST['End_time'];
$Day = $_POST['Day'];



$sql = "INSERT INTO Time_slot (End_time, Begin_time, Day,Enterprise_id) VALUES ('$endTime', '$beginTime', '$Day','$Enterprise_id')";
 
 if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    //<div><label class="form-label" style="color: var(--bs-white);">Bigin Time</label>
    header("Location: ./Time.html?Submit=success");

  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
 
//echo $result;
?>

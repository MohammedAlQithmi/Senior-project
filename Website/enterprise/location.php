<?php
include_once 'config.php';
session_start();
$Enterprise_id=$_SESSION['Enterprise_id'];
$buildingNumber = $_POST['buildingNumber'];
$RFID_Reader = $_POST['RFID_Reader'];
$CameraID = $_POST['CameraID'];
$RoomNumber = $_POST['RoomNumber'];


$sql = "INSERT INTO Location (Building_number, RFID_reader_id, Camera_id, Room_number ,Enterprise_id) VALUES ('$buildingNumber', '$RFID_Reader', '$CameraID', '$RoomNumber','$Enterprise_id')";
 //mysqli_connect
 mysqli_query($conn, $sql);
 header("Location: ./Location.html?Submit=success");
?>

<?php
include_once 'config.php';

$buildingNumber = $_POST['buildingNumber'];
$RFID_Reader = $_POST['RFID_Reader'];
$CameraID = $_POST['CameraID'];
$RoomNumber = $_POST['RoomNumber'];

$sql = "SELECT FROM API (User_Enterprise_id, Phone_number, Email, First_name, Last_name, RFID_tag_id, Image_reference,type)
 VALUES ('$userID', '$phoneNumber', '$email', '$firstName', '$lastName', '$RFID_ID', '$image', '$type');";
 
 mysqli_query($conn, $sql);
 
 
?>

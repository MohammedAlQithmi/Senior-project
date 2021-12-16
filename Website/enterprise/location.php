<?php
include_once 'config.php';

$buildingNumber = $_POST['buildingNumber'];
$RFID_Reader = $_POST['RFID_Reader'];
$CameraID = $_POST['CameraID'];
$RoomNumber = $_POST['RoomNumber'];


$sql = "INSERT INTO Location (Building_number, RFID_reader_id, Camera_id, Room_number)
 VALUES ('$buildingNumber', '$RFID_Reader', '$CameraID', '$RoomNumber');";
 
 mysql_query($conn, $sql);
 header("Location: ../index.php?Submit=success");
?>
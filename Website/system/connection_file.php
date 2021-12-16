<?php
include_once 'config.php';

$Connection_URL = $_POST['Connection_URL'];
$Context_recognition1 = $_POST['Context_recognition1'];
$Context_recognition2 = $_POST['Context_recognition2'];
$Context_recognition3 = $_POST['Context_recognition3'];


$sql = "INSERT INTO Smart_Workplace_infrastructure . Location ('Connection_URL', 'Context_recognition1', 'Context_recognition2', 'Context_recognition3')
 VALUES ('$Connection_URL', '$Context_recognition1', '$Context_recognition2', '$Context_recognition3');";
 
 mysql_query($conn, $sql);
 header("Location: ../connection_file.php?Submit=success");

?>
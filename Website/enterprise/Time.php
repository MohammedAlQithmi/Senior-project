<?php
include_once 'config.php';

$beginTime = $_POST['Begin_time'];
$endTime = $_POST['End_time'];
$Day = $_POST['Day'];



$sql = "INSERT INTO Smart_Workplace_infrastructure . Time ('End_time', 'Begin_time', 'Day')
 VALUES ('$endTime', '$beginTime', '$Day');";
 
 mysql_query($conn, $sql);
 header("Location: ../Time.php?Submit=success");

?>
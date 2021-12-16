<?php
include_once 'config.php';

$Phone = $_POST['Phone'];
$enterprise_ID = $_POST['enterprise_ID'];
$Email = $_POST['Email'];
$City = $_POST['City'];


$sql = "INSERT INTO Smart_Workplace_infrastructure . Location ('Phone', 'enterprise_ID', 'Email', 'City')
 VALUES ('$Phone', '$enterprise_ID', '$Email', '$City');";
 
 mysql_query($conn, $sql);
 header("Location: ../create_enterprise.php?Submit=success");

?>
<?php
include_once 'config.php';

$Phone = $_POST['Phone'];
$enterprise_ID = $_POST['enterprise_ID'];
$Email = $_POST['Email'];
$City = $_POST['City'];
$Enterprise_Name=$_POST['Enterprise_Name'];
$Files=$_POST['Files'];
$System_Admin_ID=$_POST['System_Admin_ID'];

$sql = "INSERT INTO Enterprise (`Phone_number`, `Enterprise_id`, `Enterprise_name`, `Email`, `City`, `Files`, `System_administrator_id`) VALUES ('$Phone', '$enterprise_ID', '$Enterprise_Name', '$Email', '$City', '$Files', '$System_Admin_ID');";


mysqli_query($conn, $sql);
    header("Location: ./index.html?Submit=success");
?>


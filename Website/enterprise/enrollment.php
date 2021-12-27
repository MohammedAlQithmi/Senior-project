<?php
require 'config.php';

$sql ="SELECT User_id FROM User ORDER BY User_id DESC LIMIT 1;";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
$refrenceNumber = $row["User_id"] +1 ;// will get the last refrenceNumber , So the next refrence = refrenceNumber +1


header('Content-Type: text/plain; charset=utf-8');

try {
	
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES['ImageReference']['error']) ||
        is_array($_FILES['ImageReference']['error'])
    ) {
        throw new RuntimeException('Invalid parameters.');
    }

    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['ImageReference']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }

    // You should also check filesize here.
    if ($_FILES['ImageReference']['size'] > 1000000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }

    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['ImageReference']['tmp_name']),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ),
        true
    )) {
        throw new RuntimeException('Invalid file format.');
    }

    // You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    if (!move_uploaded_file(
        $_FILES['ImageReference']['tmp_name'],
        sprintf('./%s.%s',
            "face",
            $ext
        )
    )) {
        throw new RuntimeException('Failed to move uploaded file.');
    }

    echo 'File is uploaded successfully.';


} catch (RuntimeException $e) {

    echo $e->getMessage();

}

$command = " python3 faceFiles/test.py $refrenceNumber ";
    $retval=shell_exec($command);
    
	
	$imageRefrenceNumber= "$refrenceNumber.txt" ;// add it to the select below 
	
session_start();
$Enterprise_id=$_SESSION['Enterprise_id'];
 $userID = $_POST['User_Enterprise_id'];
$phoneNumber = $_POST['Phone_number'];
$email = $_POST['Email'];
$firstName = $_POST['First_name'];
$lastName = $_POST['Last_name'];
$RFID_ID = $_POST['RFID_tag_id'];

//$image = $_POST['ImageReference'];// check how to get the refrence from clould
// how to post select items?
$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING );

$sql="INSERT INTO User (User_Enterprise_id, Phone_number, Email, First_name, Last_name, RFID_tag_id, Image_reference, Enterprise_id, Type_id) VALUES ('$userID', '$phoneNumber', '$email', '$firstName', '$lastName', '$RFID_ID', '$imageRefrenceNumber', '$Enterprise_id', '$type')";
if(mysqli_query($conn, $sql)){
echo "done";
}else{
echo mysqli_error($conn);

}
 header("Location: ./enrollment.html?Submit=success");

?>

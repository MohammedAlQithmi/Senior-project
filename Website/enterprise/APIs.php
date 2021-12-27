
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
                <div class="container-fluid"><a class="navbar-brand" href="index.html">Smart Workplace</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                            <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">Services</a>
                                <div class="dropdown-menu"><a class="dropdown-item" href="enrollment.html">Enrollment</a><a class="dropdown-item" href="Time.html">Time</a><a class="dropdown-item" href="Location.html">Location<br></a><a class="dropdown-item" href="APIs.php">APIs</a><a class="dropdown-item" href="Context.php">Context</a><a class="dropdown-item" href="delete_account.php">Delete Account</a></div>
                            </li>
                        </ul><span class="navbar-text" style="margin-left: 561px;"> <button class="btn btn-primary" type="button"><a href="http://34.89.127.223/web/test/logout.php">logout</a></button></span>
                    </div>
                </div>
            </nav>
            <?php 
require 'config.php';
session_start();
$Enterprise_id=$_SESSION['Enterprise_id'];
$sql="SELECT Files FROM Enterprise WHERE Enterprise_id='$Enterprise_id'";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
$Files=$row["Files"];
?>
                <div><label class="form-label" style="color: var(--bs-white);font-size: 20px;">Get APIs</label></div>
                <label class="form-label" style="color: var(--bs-white);"><?php echo $Files ?></label>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- check for mobile phones resizing done at scale 1-->

    <meta name="description" content="">
    <meta name="Romain" content="">
    <!--<link rel="icon" href="../../favicon.ico"> -->
    <title>LinkedECE</title>

    <link href="bootstrap/css/bootstrap.css" rel="stylesheet"> <!--this is bootstrap CSS-->
    <link href="css/bordersStyle.css" rel="stylesheet"> <!--this is bootstrap CSS-->
    <link href="bootstrap/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="bootstrap/css/profileSummaryStyle.css" rel="stylesheet">
    <link href="bootstrap/css/myInformation.css" rel="stylesheet">

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="http_ajax.googleapis.com_ajax_libs_jquery_3.3.1_jquery.js"></script>

</head>
<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="home.php">Home</a></li>
                <li id="myNetwork"><a href="network.php">My Network</a></li>
                <li><a href="you.php">You</a></li>
                <li><a href="notifications.php">Notifications</a></li>
                <li><a href="jobs.php">Jobs</a></li>
            </ul>
            <div class="rightSideNavbar">
            <form class="form-inline my-2 my-lg-0 searchBar" method="post" action="searchBar.php">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="searchBarField">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
                <ul class="nav">
                    <li>
                        <form action="logout.php" method="POST">
                            <button action="logout.php" name="submit" style="background: none; border: none;"><i class="glyphicon glyphicon-off"></i> </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div><!--/.nav-collapse -->
</nav>

<div class="page">

    <div class="myInformations profileSummary">

        <h2>My Information : </h2>
        <?php
        session_start();
        //include_once dirname(__DIR__).'database.php';
        include_once "database.php";
        $admin = false;
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM `user` WHERE IDUser = '$id'";
        $result = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_assoc($result)) {
            $media = "SELECT Path FROM media WHERE IDMedia = $row[Background]";
            $mediaResult = mysqli_query($conn,$media);
            $media2 = "SELECT Path FROM media WHERE IDMedia = $row[PP]";
            $mediaResult2 = mysqli_query($conn,$media2);
            $admin = $row['Admin'];
            if($row2 = mysqli_fetch_assoc($mediaResult) AND $row3 = mysqli_fetch_assoc($mediaResult2)) {
                ?>

                <img src="<?php echo $row3['Path'] ?>" alt="Profile Picture" class="pp">

                <p class="alias"><?php echo $row['Pseudo'] ?></p>
                <p class="name"><?php echo $row['FirstNameUser'] ?> <?php echo $row['NameUser'] ?></p>
                <p class="mail"><?php echo $row['MailUser'] ?></p>
                <p class="status">Works at: <?php echo $row['Status'] ?></p>

                <?php
            }
                }
                ?>
    </div>

    <div id="jquery">
        <script>
            $(document).ready(function(){
                $("#myNetwork").click(function(){
                    <?php
                    //unset($_SESSION['idLoad']);
                    //unset($_POST['idLoad']);
                    ?>
                });
            });
        </script>
    </div>

    <div class="content">



<?php
	//session_start();
    include_once "database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- check for mobile phones resizing done at scale 1-->

    <meta name="description" content="">
    <meta name="Romain" content="">
    <!--<link rel="icon" href="../../favicon.ico"> -->
    <title>Learning Bootstrap</title>

    <link href="bootstrap/css/bootstrap.css" rel="stylesheet"> <!--this is bootstrap CSS-->
    <link href="css/bordersStyle.css" rel="stylesheet"> <!--this is bootstrap CSS-->
    <link href="bootstrap/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="bootstrap/css/profileSummaryStyle.css" rel="stylesheet">

</head>
<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="network.php">My Network</a></li>
                <li><a href="you.php">You</a></li>
                <li><a href="notifications.php">Notifications</a></li>
                <li><a href="jobs.php">Jobs</a></li>
            </ul>
            <div class="rightSideNavbar">
            <form class="form-inline my-2 my-lg-0 searchBar">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
                <ul class="nav">
                    <li>
                        <form action="logout.php" method="POST">
                            <button action="logout.php" method="POST" name="submit" style="background: none; border: none;"><i class="glyphicon glyphicon-off"></i> </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div><!--/.nav-collapse -->
</nav>

<div class="page">

    <div class="profileSummary">
        <h2>My Information.</h2>
    </div>

    <div class="content">
        <p>Page Content</p>

<?php
	session_start();
?>
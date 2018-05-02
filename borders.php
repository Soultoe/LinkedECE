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
    <link href="bootstrap/css/jumbotron.css" rel="stylesheet">
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
                    <li><a href="disconnect.php"><i class="glyphicon glyphicon-off"></i></a></li>
                </ul>
            </div>
        </div><!--/.nav-collapse -->
</nav>

    <div class="profileSummary">
        <h2>My Information.</h2>
    </div>



<footer class="footer">
    <div class="container">
        <p class="text-muted">This website was developped by Romain Brisse, Alexis Martin and Gabriel Padis.</p>
    </div>
</footer>

    <script src="bootstrap/js/bootstrap.min.js"></script> <!-- This is bootstrap JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- this is JQuery-->
</body>
</html>
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


</head>
<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="network.php">My Network</a></li>
                <li><a href="you.php">You</a></li>
                <li><a href="notifications.php">Notifications</a></li>
                <li><a href="jobs.php">Jobs</a></li>
                <li><a href="disconnect.php">Disconnect</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container" style="background-color: #007179">
    <div class="row">
        <div class="col-lg-3">
            <p>Je suis l'encadré de profil</p>
        </div>
        <div class="col-lg-9" style="background-color: #2b669a">
            <p>Je suis le contenu variable de la page.</p>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="text-muted">Place sticky footer content here.</p>
    </div>
</footer>

    <script src="bootstrap/js/bootstrap.min.js"></script> <!-- This is bootstrap JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- this is JQuery-->
</body>
</html>
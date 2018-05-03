<?php
	if(isset($_POST['submit'])) {
		session_start();
	    include_once ("database.php");

	    $sql = "UPDATE `user` SET `lastDeconnection` = CURRENT_TIMESTAMP WHERE IDUser = $_SESSION[id]";
        $result = mysqli_query($conn, $sql);

		session_unset();
		session_destroy();
		header("Location: index.php");
		exit();
	}
<?php
session_start();
	if(!isset($_POST['submit']) || $_POST['comment']=="") {
		header("Location: home.php");
		exit();
	}
	include_once "database.php";
	$text = mysqli_real_escape_string($conn, $_POST['comment']);
	$sql = "INSERT INTO comment (Publication, Content, User) VALUES ($_POST[post], '$text', $_POST[User])";
	mysqli_query($conn, $sql);
	header("Location: home.php");
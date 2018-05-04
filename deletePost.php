<?php
	include_once "database.php";
	if(!isset($_GET['DEL'])){
		header("Location: home.php");
		exit();
	}
	$sql = "DELETE FROM `publication` WHERE IDPublication=$_GET[DEL]";
	mysqli_query($conn, $sql);
	echo "<script>alert($sql)</script>";
	header("Location: home.php");
	exit();
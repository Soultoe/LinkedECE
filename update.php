<?php
	session_start();
	if(!isset($_SESSION['id'])) {
		header("Location: index.php");
		exit();
	}
	include_once "database.php";
	$id = $_SESSION['id'];
	$sql = "SELECT * FROM `user` WHERE IDUser = '$id'";
	$res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
	$pseudo = $res['Pseudo'];
	$newPseudo = $res['Pseudo'];
	$toTest = $_POST['pseudo'];
	$newFirst = (!isset($_POST['firstName']) ? $res['FirstNameUser'] : $_POST['firstName']);
	$newLast = (!isset($_POST['lastName']) ? $res['NameUser'] : $_POST['lastName']);
	if(isset($_POST['pseudo']) && $pseudo != $_POST['pseudo']) {
		$sql = "SELECT * FROM `user` WHERE Pseudo = '$toTest'";
		if(mysqli_query($conn, $sql)!=false)
			$newPseudo = $toTest;
	}
	$sql = "UPDATE `user` SET FirstNameUser = '$newFirst', NameUser = '$newLast', Pseudo = '$newPseudo' WHERE IDUser = '$id';";
	
	
	header("Location: modifyUserInfo.php?error=".(mysqli_query($conn, $sql) ? "success" : "noUpdate"));
?>
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
	$pseudo = mysqli_real_escape_string($conn, $res['Pseudo']);
	$newPseudo = $res['Pseudo'];
	$toTest = mysqli_real_escape_string($conn, $_POST['pseudo']);
	$pwd1 = mysqli_real_escape_string($conn, $_POST['pwd1']);
	$pwd2 = mysqli_real_escape_string($conn, $_POST['pwd2']);
	$pwd3 = mysqli_real_escape_string($conn, $_POST['pwd3']);
	$newFirst = (!isset($_POST['firstName']) ? $res['FirstNameUser'] : mysqli_real_escape_string($conn, $_POST['firstName']));
	$newLast = (!isset($_POST['lastName']) ? $res['NameUser'] : mysqli_real_escape_string($conn, $_POST['lastName']));
	if(isset($_POST['pseudo']) && $pseudo != mysqli_real_escape_string($conn, $_POST['pseudo'])) {
		$sql = "SELECT * FROM `user` WHERE Pseudo = '$toTest'";
		if(mysqli_query($conn, $sql)!=false)
			$newPseudo = $toTest;
	}
	$sql = "UPDATE `user` SET FirstNameUser = '$newFirst', NameUser = '$newLast', Pseudo = '$newPseudo' WHERE IDUser = '$id';";
	$err = mysqli_query($conn, $sql) ? "success" : "noUpdate";
	if(isset($_POST['pwd1']) && isset($_POST['pwd2']) && isset($_POST['pwd3'])) {
		$sql = "SELECT * FROM choucroutte WHERE User = '$id'";
		$result = mysqli_query($conn, $sql);
		if($result && ($pwd2 == $pwd3)) {
			$check = password_verify($pwd1, mysqli_fetch_assoc($result)['Hash']);
			if($check==true) {
				$sql = "UPDATE choucroutte SET Hash = '".password_hash($pwd2, PASSWORD_DEFAULT)."' WHERE User = '$id'";
				$err = $err.(mysqli_query($conn, $sql) ? "" : "failUpdatePwd");
			}
			else
				$err = $err."prevFail";
		}
		else {
			$err = $err."samePassword";
		}
	}
	else
		$err = $err."pwdFail";
	header("Location: modifyUserInfo.php?error=".$err);
	exit();
?>
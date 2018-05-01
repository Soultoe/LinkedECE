<?php
	session_start();
	if(!isset($_POST['submit'])) {
		header("Location: index.php");
		exit();
	}

	include_once 'database.php';

	$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
	$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	$pwd2 = mysqli_real_escape_string($conn, $_POST['pwd2']);
	$pseudo = mysqli_real_escape_string($conn, $_POST['pseudo']);
	
	if(empty($firstName) || empty($lastName) || empty($email) || empty($pwd) || empty($pseudo)) {
		header("Location: index.php?error=emptyField");
		exit();
	}
	else {
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			header("Location: index.php?error=invalidEmail");
			exit();
		}
		else if($pwd != $pwd2){
			header("Location: index.php?error=wrongPassword");
			exit();
		}
		else{
			$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
			$sql = "INSERT INTO `user` (NameUser, FirstNameUser, MailUser, Admin, Pseudo) VALUES ('$lastName', '$firstName', '$email', False, '$pseudo');";
			echo '$sql';
			$result = mysqli_query($conn, $sql);
			if($result == false) {
				header("Location: index.php?error=existingAccount");
				exit();
			}
			$result = mysqli_query($conn, "SELECT IDUser FROM `user` WHERE user.MailUser = '$email'");
			$IDUser = mysqli_fetch_assoc($result)['IDUser'];
			$sql = "INSERT INTO choucroutte (User, Hash) VALUES ('$IDUser', '$hashedPwd')";
			$result = mysqli_query($conn, $sql);
			$_SESSION['id'] = $IDUser;
			header("Location: home.php");
			exit();
		}
	}
<?php

	session_start();
	if(isset($_POST['submit'])) {
		include_once 'database.php';
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
		
		if(empty($id) || empty($pwd)) {
			header("Location: index.php?error=loginEmpty");
			exit();
		}
		else {
			$sql = "SELECT * FROM `user` WHERE MailUser = '$id' OR Pseudo = '$id'";
			$result1 = mysqli_query($conn, $sql);
			$res = mysqli_fetch_assoc($result1);
			if(!$res){
				header("Location: index.php?error=loginError");
				exit();
			}
			if(mysqli_num_rows($result1) < 1) {
				header("Location: index.php?error=loginError");
				exit();
			}
			else {
				$var = $res['IDUser'];
				$sql = "SELECT * FROM choucroutte WHERE User = '$var'";
				$result = mysqli_query($conn, $sql);
				if($res) {
					$check = password_verify($pwd, mysqli_fetch_assoc($result)['Hash']);
					if($check==true) {
						$row = mysqli_fetch_assoc($result1);
						$_SESSION['id'] = $res['IDUser'];
						header("Location: home.php");
						exit();
					}
					else {
						header("Location: index.php?error=loginError");
						exit();
					}
				}
			}
		}
	}
	else {
		header("Location: index.php?error=loginError");
		exit();
	}
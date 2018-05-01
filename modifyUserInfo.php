<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header("Location: index.php");
		exit();
	}
?>
<html>
	<body>
		<section>
			<form action="update.php" method="POST">
				<?php
					include_once "database.php";
					$id = $_SESSION['id'];
					$sql = "SELECT * FROM `user` WHERE IDUser = '$id'";
					$res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
					$first = $res['FirstNameUser'];
					$last = $res['NameUser'];
					$pseudo = $res['Pseudo'];
					echo '<input type="text" name="firstName" value="'.$first.'">
				<input type="text" name="lastName" value="'.$last.'">
				<input type="text" name="pseudo" value="'.$pseudo.'">
				<input type="password" name="pwd" placeholder="Previous password">
				<input type="password" name="pwd2" placeholder="New Password">
				<input type="password" name="pwd3" placeholder="New Password Verif">
				';
				?>
				<button type="submit" name="submit">Update</button>
			</form>
		</section>
	</body>
</html>
<?php
	include_once "borders.php";
	if(!isset($_SESSION['id'])){
		header("Location: index.php");
		exit();
	}
?>
	<div class="container">
		<form action="update.php" method="POST" enctype="multipart/form-data">
			<?php
				include_once "database.php";
				$id = $_SESSION['id'];
				$sql = "SELECT * FROM `user` WHERE IDUser = '$id'";
				$res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
				$first = $res['FirstNameUser'];
				$last = $res['NameUser'];
				$pseudo = $res['Pseudo'];
				echo '<label>Prénom</label><input type="text" name="firstName" value="'.$first.'">
			<label>Nom de famille</label>
			<input type="text" name="lastName" value="'.$last.'">
			<label>Pseudo</label>
			<input type="text" name="pseudo" value="'.$pseudo.'">
			<label>Changer mot de passe</label>
			<input type="password" name="pwd1" placeholder="Previous password">
			<input type="password" name="pwd2" placeholder="New Password">
			<input type="password" name="pwd3" placeholder="New Password Verif">
			<label>Photo de profil</label>
			<input type="file" name="pp">
			<label>Photo de fond</label>
			<input type="file" name="bp">
			<label>CV</label>
			<input type="file" name="cv">
			';
			?>
			<button type="submit" name="submit">Update</button>
		</form>
	</div>
	</body>
</html>
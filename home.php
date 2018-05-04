<?php
	include_once "borders.php";
	if(!isset($_SESSION['id'])) {
		header("Location: index.php");
		exit();
	}
?>
<div class = "newPublish">
	<form action="newPost.php" method="POST" enctype="multipart/form-data">
		<label>Insérer une photo/courte video</label>
		<input type="file" name="doc">
		<label>Insérer la date</label>
		<input type="date" name="date">
		<label>Insérer le lieu</label>
		<input type="text" name="place">
		<label>Texte</label>
		<textarea name="text", placeholder = "Ecrivez votre nouvelle publication ici"></textarea>
		<button action="logout.php" method="POST" name="submit">Publier</button>
	</form>
</div>
<?php
	$arrayID = null;
	$sql = "SELECT DISTINCT User2 FROM `user` INNER JOIN connection ON `user`.IDUser = connection.User1 WHERE User1 = $_SESSION[id]";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)){
		$arrayID[] = $row['User2'];
	}
	$sql2 = "SELECT DISTINCT User1 FROM `user` INNER JOIN connection ON `user`.IDUser = connection.User2 WHERE User2 = $_SESSION[id]";
	$result2 = mysqli_query($conn, $sql2);
	while($row2 = mysqli_fetch_assoc($result2)){
		if(! in_array($row2['User1'], $arrayID)) {
			$arrayID[] = $row2['User1'];
		}
	}

	if($arrayID == null) {
		?>
		<p>You don't have any friends yet.</p>
		<?php
	}
	else{
		$sql = "SELECT DISTINCT User, Description, Media, DatePublication, DateUser, PlaceUser, Visibility FROM `publication` ORDER BY `DatePublication` DESC";
		//$res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
		?>
		<div>
			<?php
			$tmp = mysqli_query($conn, $sql);
			while($res = mysqli_fetch_assoc($tmp)){
				if ($res['User'] == $_SESSION['id'] || in_array($res['User'], $arrayID)) {
					echo "<div>";
					$sql = "SELECT NameUser, FirstNameUser FROM `user` WHERE IDUser = $res[User]";
					$res2 = mysqli_fetch_assoc(mysqli_query($conn, $sql));
					echo " $res2[FirstNameUser] $res2[NameUser] : ";
					if($res['Description'] != NULL)
						echo " $res[Description]";
					if($res['DateUser'] != NULL)
						echo " $res[DateUser]";
					if($res['PlaceUser'] != NULL)
						echo " $res[PlaceUser]";
					if($res['Media'] != NULL){
					}
					echo " $res[DatePublication]";
					echo "</div>";
				}
			}
			?>
		</div>
		<?php
	}
?>


<?php
	include_once "footer.php";
?>
<?php
	include_once "borders.php";
	if(!isset($_SESSION['id'])) {
		header("Location: index.php");
		exit();
	}
?>
    <link href="bootstrap/css/home.css" rel="stylesheet">
<div class="feed">
<div class = "newPublish">

	<form action="newPost.php" method="POST" enctype="multipart/form-data">

        <div class="content">
            <textarea class="publishArea" name="text", placeholder = "Ecrivez votre nouvelle publication ici"></textarea>
        </div>

        <div class="precisions">

        <div class="file">
        <label>Insérer une photo/courte video</label>
		<input type="file" name="doc">
        </div>

        <div class="date">
        <label>Insérer la date</label>
		<input type="date" name="date">
        </div>

        <div class="place">
        <label>Insérer le lieu</label>
		<input type="text" name="place">
        </div>

        </div>

        <button action="logout.php" method="POST" name="submit" class="btn btn-success publishButton">Publier</button>

    </form>
</div>
<?php
	$arrayID = array();
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
	$sql = "SELECT DISTINCT IDPublication, User, Description, Media, DatePublication, DateUser, PlaceUser, Visibility FROM `publication` ORDER BY `DatePublication` DESC";
	$admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Admin FROM `user` WHERE IDUser = $_SESSION[id]"))['Admin'];
		$tmp = mysqli_query($conn, $sql);
		while($res = mysqli_fetch_assoc($tmp)){
			echo "<div>"; //debut div Publication
			if ($res['User'] == $_SESSION['id'] || in_array($res['User'], $arrayID)) {
				$sql = "SELECT NameUser, FirstNameUser, Admin FROM `user` WHERE IDUser = $res[User]";
				$res2 = mysqli_fetch_assoc(mysqli_query($conn, $sql));
				echo " $res2[FirstNameUser] $res2[NameUser] : ";
				if($res['Description'] != NULL)
					echo " $res[Description]";
				if($res['DateUser'] != NULL)
					echo " $res[DateUser]";
				if($res['PlaceUser'] != NULL)
					echo " $res[PlaceUser]";
				if($res['Media'] != NULL){
					$sql = "SELECT Path FROM Media WHERE IDMedia = $res[Media]";
					$vidArray = array('mp4', 'ogg');
					$res3 = mysqli_fetch_assoc(mysqli_query($conn, $sql));
					$tmp2 = explode('.', $res3['Path']);
					if(in_array(end($tmp2), $vidArray)) {
						?>
						<video controls>
							<source src="<?php echo $res3['Path']?>" type="video/mp4">Sorry, your browser doesn't support the video element.
						</video>
						<?php
					}
					else {
						?>
						 <img src="<?php echo $res3['Path']?>" alt="PHOTO NON AFFICHEE"> 
						<?php
					}
				}
				echo " $res[DatePublication]";
				if($res['User'] == $_SESSION['id'] || $admin[0] == 1) {
					?>
					<form action="deletePost.php" method="POST">
						<input type="hidden" name= "DEL" value="<?php echo $res['IDPublication'] ?>">
						<input type="submit" name="submit" value="DELETE POST">
					</form>
					<?php
				}
				?>
					<form action="toggleReact.php" method="POST">
						<input type="hidden" name="post" value="<?php echo $res['IDPublication'] ?>">
						<input type="submit" name="submit" value="<?php
							$sql = "SELECT COUNT(DISTINCT User) AS 'Num' FROM reaction WHERE Publication=$res[IDPublication]";
							$react = mysqli_fetch_assoc(mysqli_query($conn, $sql))['Num'];
							$sql = "SELECT COUNT(DISTINCT User) AS 'Num' FROM reaction WHERE Publication=$res[IDPublication] AND reaction.User=$_SESSION[id]";
							$already = mysqli_fetch_assoc(mysqli_query($conn, $sql))['Num'];
							echo ($already==0 ? "LIKE" : "LIKED")." $react";
						?>">
					</form>
					<form action="newComment.php" method="POST">
						<input type="hidden" name= "User" value="<?php echo $_SESSION['id'] ?>">
						<input type="hidden" name= "post" value="<?php echo $res['IDPublication'] ?>">
						<textarea name="comment", placeholder = "Ecrivez votre commentaire ici"></textarea>
						<input type="submit" name="submit" value="commenter">
					</form>
				<?php
				$sql = "SELECT * FROM comment INNER JOIN `user` ON IDUser = User WHERE Publication=$res[IDPublication] ORDER BY `DateComment` ASC";
				$comments = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_assoc($comments)) {
					?>
					<div>
						<p><?php echo $row['Pseudo'] ?> has left a comment : <?php echo $row['Content'] ?></p>
						<?php
						if($row['User'] == $_SESSION['id'] || $admin[0] == 1) { ?>
						<form action = "deleteComment" method="POST">
							<input type="hidden" name="DEL" value=<?php echo $row['IDComment'] ?>>
							<input type="submit" name="submit" value="Delete Comment">
						</form>
						<?php } ?>
					</div>
				<?php
				}
			}
			echo "</div>"; //fin div publication
		}
		?>
	</div>
</div>
	<?php
?>


<?php
	include_once "footer.php";
?>
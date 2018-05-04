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
	include_once "footer.php";
?>
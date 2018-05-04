<?php
	include_once "borders.php";
	if(!isset($_SESSION['id'])) {
		header("Location: index.php");
		exit();
	}
?>
<div class = "newPublish">
	<form method="post" action="newPost.php" method="POST">
		<label>Insérer un document</label>
		<textarea name="text", placeholder = "Ecrivez votre nouvelle publication ici"></textarea>
		<button action="logout.php" method="POST" name="submit">Publier</button>
	</form>
</div>

<?php
	include_once "footer.php";
?>
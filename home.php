<?php
	include_once "borders.php";
	if(!isset($_SESSION['id'])) {
		header("Location: index.php");
		exit();
	}
	else {
?>

        <p> BLABLABLA </p>

        <?php
            include_once "footer.php";
        ?>
<?php
	}
?>

<?php
include_once "database.php";
if (!isset($_POST['submit'])) {
    header("Location: home.php");
    exit();
}
$sql = "DELETE FROM `publication` WHERE IDPublication=$_POST[DEL]";
mysqli_query($conn, $sql);
header("Location: home.php");
exit();
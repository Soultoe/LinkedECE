<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

include_once "database.php";

$id = $_SESSION['id'];
$project = $_POST['projectID'];

$sql = "DELETE FROM realisation WHERE Projet = $project AND `User` = $id;";
$test = mysqli_query($conn, $sql);

header("Location: modifyUserInfo.php");
exit();
?>
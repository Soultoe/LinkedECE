<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

include_once "database.php";
$id = $_SESSION['id'];

$description = mysqli_real_escape_string($conn, $_POST['Pdescription']);
$projet = $_POST['project'];

$sql = "INSERT INTO realisation(projet,`User`,description)VALUES($projet,$id,'$description');";
$test = mysqli_query($conn, $sql);

header("Location: modifyUserInfo.php");
exit();
?>
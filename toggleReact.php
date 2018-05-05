<?php
session_start();
if (!isset($_POST['submit'])) {
    header("Location: home.php");
    exit();
}
include_once "database.php";
if (!isset($_POST['submit'])) {
    header("Location: home.php");
    exit();
}
$sql = "SELECT COUNT(DISTINCT User) AS 'Num' FROM reaction WHERE Publication=$_POST[post] AND reaction.User=$_SESSION[id]";
if (mysqli_fetch_assoc(mysqli_query($conn, $sql))['Num'] == 0) {
    $sql = "INSERT INTO reaction (Publication, `User`) VALUES ($_POST[post], $_SESSION[id])";
    mysqli_query($conn, $sql);
} else {
    $sql = "DELETE FROM reaction WHERE Publication=$_POST[post] AND `User` = $_SESSION[id]";
    mysqli_query($conn, $sql);
}
header("Location: home.php");
exit();
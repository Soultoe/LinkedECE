<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

include_once "database.php";

$sql = "DELETE FROM `connection` WHERE user1 = $_SESSION[id] AND user2 = $_SESSION[idLoad] ";
$result = mysqli_query($conn, $sql);
$sql2 = "DELETE FROM `connection` WHERE user1 = $_SESSION[idLoad] AND user2 = $_SESSION[id] ";
$result2 = mysqli_query($conn, $sql2);

header("Location: network.php");
exit();
?>
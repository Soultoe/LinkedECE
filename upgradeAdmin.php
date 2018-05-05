<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 05/05/2018
 * Time: 10:19
 */

session_start();
include_once "database.php";

$sql = "UPDATE `user` SET Admin = 1 WHERE IDUser = $_SESSION[idLoad]";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "update upgrade successful";
}

header("Location: network.php");
exit();

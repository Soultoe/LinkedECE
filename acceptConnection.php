<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 04/05/2018
 * Time: 20:06
 */

session_start();
include_once "database.php";

$relationString = mysqli_real_escape_string($conn, $_POST['Relationship']);
$userID = mysqli_real_escape_string($conn, $_POST['userID']);



//insert the new connection
$sql = "INSERT INTO connection(User1, User2, Relationship) VALUES($_SESSION[id], $userID, '$relationString')";
$result = mysqli_query($conn, $sql);
if($result != null){
    echo "success insert";
}

//delete the request
$sql = "DELETE FROM connectionrequest WHERE User1 = $userID AND User2 = $_SESSION[id]";
$result = mysqli_query($conn, $sql);
if($result != null){
    echo "success delete";
}

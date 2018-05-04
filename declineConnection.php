<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 04/05/2018
 * Time: 20:19
 */

session_start();
include_once "database.php";

$userID = mysqli_real_escape_string($conn, $_POST['userID']);

//delete the request
$sql = "DELETE FROM connectionrequest WHERE User1 = $userID AND User2 = $_SESSION[id]";
$result = mysqli_query($conn, $sql);
if($result != null){
    echo "success delete";
}
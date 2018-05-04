<?php
session_start();
if(!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

include_once "database.php";
$id = $_SESSION['id'];

$position = mysqli_real_escape_string($conn, $_POST['position']);
$name = mysqli_real_escape_string($conn, $_POST['company']);

$company = "SELECT * FROM company WHERE NameCompany LIKE '$name';";
$result = mysqli_query($conn, $company);


if($row = mysqli_fetch_assoc($result))
{
    $sql = "DELETE FROM experience WHERE Company = $row[IDCompany] AND Position = '$position';";
    $test = mysqli_query($conn,$sql);
}

header("Location: modifyUserInfo.php");
exit();
?>
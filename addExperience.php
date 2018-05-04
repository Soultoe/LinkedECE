<?php
session_start();
if(!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

include_once "database.php";
$id = $_SESSION['id'];

$description = mysqli_real_escape_string($conn, $_POST['Edescription']);

$name = mysqli_real_escape_string($conn, $_POST['companyName']);

$company = "SELECT * FROM company WHERE NameCompany LIKE '$name';";

$result = mysqli_query($conn, $company);


if($row = mysqli_fetch_assoc($result))
{
    $sql = "INSERT INTO experience(`User`,Company,`Position`)VALUES($id,$row[IDCompany],'$description');";
    $test = mysqli_query($conn,$sql);
}

header("Location: modifyUserInfo.php");
exit();
?>
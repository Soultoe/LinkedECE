<form action="addCompany.php" method="POST">
    <input type="text" name="CompanyName" placeholder="Company Name">
    <input type="text" name="CompanyMail" placeholder="Company Mail">
    <button type="submit" name="add">Add Company</button>
</form>

<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 02/05/2018
 * Time: 15:39
 */

session_start();
if(isset($_POST['add'])) {
include_once '../database.php';
$name = mysqli_real_escape_string($conn, $_POST['CompanyName']);
$mail = mysqli_real_escape_string($conn, $_POST['CompanyMail']);

if(empty($name) || empty($mail)) {
    header("Location: addCompany.php?error=fieldEmpty");
    exit();
}
else {
    $sql = "INSERT INTO company(NameCompany, MailCompany) SET ($name, $mail)";
    $result1 = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($result1);
    if(!$res){
        header("Location: addCompany.php?error=loginError");
        exit();
    }
    else{
        //login successful
        header("Location : index.php");
    }
}
}

?>


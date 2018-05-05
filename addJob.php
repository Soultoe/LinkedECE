<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 02/05/2018
 * Time: 15:39
 */

include_once "borders.php";
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

$comp = null;

$sql = "SELECT Company FROM user WHERE IDUser = '$_SESSION[id]'";
$result1 = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result1);
?>
<form action="addJob.php" method="POST">
    <input type="text" name="Position" placeholder="Position">
    <input type="text" name="Description" placeholder="Description">
    <input type="time" name="DateBegin" placeholder="Date Debut">
    <input type="time" name="DateEnd" placeholder="Date Fin">
    <?php
    if($row['Company'] != null) $comp = $row['Company'];
    else {
        ?>
        <input type="text" name="Company" placeholder="Company">
        <?php
    }
    ?>
    <button type="submit" name="add">Add Job</button>
</form>

<?php

if(isset($_POST['add'])) {

    $position = mysqli_real_escape_string($conn, $_POST['Position']);
    $description = mysqli_real_escape_string($conn, $_POST['Description']);
    $datebegin = mysqli_real_escape_string($conn, $_POST['DateBegin']);
    $dateend = mysqli_real_escape_string($conn, $_POST['DateEnd']);
    if($comp == null) $comp = mysqli_real_escape_string($conn, $_POST['Company']);

    if(empty($position) || empty($description) || empty($datebegin) || empty($dateend)) {
        header("Location: addJob.php?error=fieldEmpty");
        exit();
    }
    else {
        $sql = "INSERT INTO job(Company, Description, DateBegin, DateEnd) SET ($comp, $position, $description, $datebegin, $dateend)";
        $result1 = mysqli_query($conn, $sql);
        $res = mysqli_fetch_assoc($result1);
        if(!$res){
            header("Location: addJob.php?error=loginError");
            exit();
        }
        else{
            //add successful
            header("Location : index.php");
        }
    }
}

include_once "footer.php";
?>


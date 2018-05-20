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
//var_dump($row);

?>
<form action="addJob.php" method="POST">
    <input type="text" name="Position" placeholder="Position">
    <input type="text" name="Description" placeholder="Description">
    <input type="date" name="DateBegin" placeholder="Date Debut">
    <input type="date" name="DateEnd" placeholder="Date Fin">
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
        //TO DO : if put the company name : look for this name in the bdd if exists, if so put then according Company ID, otherwise create a new company and use the newly created ID


        $position = "'". $position ."'" ;
        $description = "'". $description ."'";
        $datebegin = "'". $datebegin ."'";
        $dateend = "'". $dateend ."'";

        //INSERT INTO job(User, Company, Position, Description, DateBegin, DateEnd) VALUES (10, 1, hdg, fdghd, 2018-05-20, 2018-05-22)'
        $sql = "INSERT INTO job(User, Company, Position, Description, DateBegin, DateEnd) VALUES ($_SESSION[id], $comp, $position, $description, $datebegin, $dateend)";
        //var_dump($sql);
        $result1 = mysqli_query($conn, $sql);
        //var_dump($result1);
        //$res = mysqli_fetch_assoc($result1);
        if(!$result1){
            header("Location: addJob.php?error=addJobError");
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


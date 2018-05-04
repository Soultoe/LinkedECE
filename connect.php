<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 04/05/2018
 * Time: 17:23
 */

session_start();
include_once "database.php";

$relationString = mysqli_real_escape_string($conn, $_POST['Relationship']);

?>
<div>
    <?php ($_SESSION); ?>
</div>
<?php

if(empty($relationString)){
    header("Location: network.php?error=pb");
    exit();

} else {
    $sql = "INSERT INTO connectionrequest (User1, User2, Relationship) VALUES ($_SESSION[id], $_SESSION[idLoad], '$relationString')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Connection sent";
    }
}

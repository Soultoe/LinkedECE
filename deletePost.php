<?php
include_once "database.php";
if (!isset($_POST['submit'])) {
    header("Location: home.php");
    exit();
}

/**
 * Publication Media of the user
 */
$sql = "SELECT * FROM publication WHERE IDPublication=$_POST[DEL]";
$result = mysqli_query($conn, $sql);
if ($row = mysqli_fetch_assoc($result)) {
    if ($row['Media'] != null) {
        $sql2 = "SELECT * FROM publication INNER JOIN media ON Media = IDMedia WHERE IDPublication=$_POST[DEL] ";
        $result2 = mysqli_query($conn, $sql2);
        if ($row2 = mysqli_fetch_assoc($result2)) {
            $string = __DIR__."/".$row2['Path'];
            $string = str_replace("/", "\\", $string);

            unlink($string);
        }
        $sql = "DELETE FROM media WHERE $row[Media] = IDMedia";
        $result = mysqli_query($conn, $sql);
        if ($result != null) {
            echo "delete pubication media successful";
        }
    }
    $sql = "DELETE FROM publication WHERE IDPublication=$_POST[DEL]";
    $result = mysqli_query($conn, $sql);
    if ($result != null) {
        echo "delete publication successful";
    }
}

header("Location: home.php");
exit();
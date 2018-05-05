<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 05/05/2018
 * Time: 10:28
 */

session_start();
include_once "database.php";

/**
 * All the simple ones
 */
$sql = "DELETE FROM choucroutte WHERE User = $_SESSION[idLoad]";
$result = mysqli_query($conn, $sql);
if ($result != null) {
    echo "delete pswd successful";
}

$sql = "DELETE FROM comment WHERE User = $_SESSION[idLoad]";
$result = mysqli_query($conn, $sql);
if ($result != null) {
    echo "delete comment successful";
}

$sql = "DELETE FROM connection WHERE User1 = $_SESSION[idLoad]";
$result = mysqli_query($conn, $sql);
if ($result != null) {
    echo "delete connection successful";
}

$sql = "DELETE FROM connection WHERE User2 = $_SESSION[idLoad]";
$result = mysqli_query($conn, $sql);
if ($result != null) {
    echo "delete connection successful";
}

$sql = "DELETE FROM connectionrequest WHERE User1 = $_SESSION[idLoad]";
$result = mysqli_query($conn, $sql);
if ($result != null) {
    echo "delete connection request  successful";
}

$sql = "DELETE FROM connectionrequest WHERE User2 = $_SESSION[idLoad]";
$result = mysqli_query($conn, $sql);
if ($result != null) {
    echo "delete connection request successful";
}

$sql = "DELETE FROM experience WHERE User = $_SESSION[idLoad]";
$result = mysqli_query($conn, $sql);
if ($result != null) {
    echo "delete experience successful";
}

$sql = "DELETE FROM job WHERE User = $_SESSION[idLoad]";
$result = mysqli_query($conn, $sql);
if ($result != null) {
    echo "delete job successful";
}

$sql = "DELETE FROM reaction WHERE User = $_SESSION[idLoad]";
$result = mysqli_query($conn, $sql);
if ($result != null) {
    echo "delete reaction successful";
}

$sql = "DELETE FROM realisation WHERE User = $_SESSION[idLoad]";
$result = mysqli_query($conn, $sql);
if ($result != null) {
    echo "delete realisation successful";
}

/**
 * Publication Media of the user
 */
$sql = "SELECT * FROM publication INNER JOIN `user` ON IDUser = User WHERE IDUser = $_SESSION[idLoad]";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['Media'] != null) {
        $sql2 = "SELECT * FROM publication INNER JOIN media ON Media = IDMedia";
        $result2 = mysqli_query($conn, $sql2);
        if ($row2 = mysqli_fetch_assoc($result2)) {
            unlink($row2['Path']);
        }
        $sql = "DELETE FROM media WHERE $row[Media] = IDMedia";
        $result = mysqli_query($conn, $sql);
        if ($result != null) {
            echo "delete pubication media successful";
        }
    }
    $sql = "DELETE FROM publication WHERE User = $_SESSION[idLoad]";
    $result = mysqli_query($conn, $sql);
    if ($result != null) {
        echo "delete publication successful";
    }
}


/**
 * Media
 */
/**
 * PP
 */
$sql = "SELECT * FROM `user` INNER JOIN media on PP = IDMedia WHERE IDUser = $_SESSION[idLoad]";
$result = mysqli_query($conn, $sql);
if ($row = mysqli_fetch_assoc($result)) {
    if (strcmp($row['Path'], "src/pp_anonymous.jpg") != 0) {
        unlink($row['Path']);
    }
    $sql = "DELETE FROM media WHERE $row[PP] = IDMedia";
    $result = mysqli_query($conn, $sql);
    if ($result != null) {
        echo "delete PP successful";
    }
}


/**
 * Background
 */
$sql = "SELECT * FROM `user` INNER JOIN media on Background = IDMedia WHERE IDUser = $_SESSION[idLoad]";
$result = mysqli_query($conn, $sql);
if ($row = mysqli_fetch_assoc($result)) {
    if (strcmp($row['Path'], "src/defaultBackground.jpg") != 0) {
        unlink($row['Path']);
    }
    $sql = "DELETE FROM media WHERE $row[Background] = IDMedia";
    $result = mysqli_query($conn, $sql);
    if ($result != null) {
        echo "delete background successful";
    }
}


/**
 * CV
 */
$sql = "SELECT * FROM `user` INNER JOIN media on CV = IDMedia WHERE IDUser = $_SESSION[idLoad]";
$result = mysqli_query($conn, $sql);
if ($row = mysqli_fetch_assoc($result)) {
    unlink($row['Path']);
    $sql = "DELETE FROM media WHERE $row[Media] = IDMedia";
    $result = mysqli_query($conn, $sql);
    if ($result != null) {
        echo "delete CV successful";
    }
}


/**
 * User table
 */
$sql = "DELETE FROM `user` WHERE IDUser = $_SESSION[idLoad]";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "delete successful";
}

header("Location: network.php");
exit();
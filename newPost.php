<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}
include_once "database.php";
$id = $_SESSION['id'];
$file = $_FILES['doc'];
$err = "";
if (isset($file)) {
    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];
    $a = explode('.', $fileName);
    $fileExt = strtolower(end($a));
    $allowed = array('jpg', 'jpeg', 'png', 'gif', 'mp4', 'ogg');
    if (!in_array($fileExt, $allowed)) {
        $err = $err . "+CVExtNotAllowed" . $fileExt . $fileName;
    } else {
        if ($fileError != 0)
            $err = $err . "+fileUploadError";
        else {
            if ($fileSize > 2000000) {
                $err = $err . '+fileTooBig';
            } else {
                $newFileName = uniqid('', true) . "." . $fileExt;
                move_uploaded_file($fileTmp, "src/" . $newFileName);
                $sql = "INSERT INTO media (Path) VALUES ('" . "src/" . $newFileName . "');";
                mysqli_query($conn, $sql);
                $sql = "SELECT IDMedia FROM media WHERE Path LIKE '" . "src/" . $newFileName . "'";
                $idMedia = mysqli_fetch_assoc(mysqli_query($conn, $sql))['IDMedia'];
            }
        }
    }
    if (isset($_POST['date'])) $date = date('Y-m-d', strtotime($_POST['date']));
    if (isset($_POST['lieu'])) $lieu = $_POST['lieu'];
}
if (isset($_POST['text'])) $text = $_POST['text'];
if (($file['error'] == 0 && $err == "") || !empty($text)) {
    $sql = "INSERT INTO publication (User" . (!empty($text) ? ", Description" : "") . (($file['error'] == 0 && $err == "") ? ", Media" : "") . ($_POST['place'] != '' ? ", PlaceUser" : "") . ($_POST['date'] != '' ? ", DateUser" : "") . ") VALUES ($id" . (!empty($text) ? ", '" . mysqli_real_escape_string($conn, $text) . "'" : "") . (($file['error'] == 0 && $err == "") ? ", $idMedia" : "") . ($_POST['place'] != '' ? ", '" . mysqli_real_escape_string($conn, $_POST['place']) . "'" : "") . ($_POST['date'] != '' ? ", '" . date('Y-m-d', strtotime($_POST['date'])) . "'" : "") . ")";
    mysqli_query($conn, $sql);
    header("Location: home.php");
} else {
    header("Location: home.php?error=emptyFields");
    exit();
}
?>
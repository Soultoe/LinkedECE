<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}
include_once "database.php";
$id = $_SESSION['id'];
$sql = "SELECT * FROM `user` WHERE IDUser = '$id'";
$res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
$pseudo = mysqli_real_escape_string($conn, $res['Pseudo']);
$newPseudo = $res['Pseudo'];
$toTest = mysqli_real_escape_string($conn, $_POST['pseudo']);
$pwd1 = mysqli_real_escape_string($conn, $_POST['pwd1']);
$pwd2 = mysqli_real_escape_string($conn, $_POST['pwd2']);
$pwd3 = mysqli_real_escape_string($conn, $_POST['pwd3']);
$newFirst = (!isset($_POST['firstName']) ? $res['FirstNameUser'] : mysqli_real_escape_string($conn, $_POST['firstName']));
$newLast = (!isset($_POST['lastName']) ? $res['NameUser'] : mysqli_real_escape_string($conn, $_POST['lastName']));
if (isset($_POST['pseudo']) && $pseudo != mysqli_real_escape_string($conn, $_POST['pseudo'])) {
    $sql = "SELECT * FROM `user` WHERE Pseudo = '$toTest'";
    if (mysqli_query($conn, $sql) != false)
        $newPseudo = $toTest;
}
$sql = "UPDATE `user` SET FirstNameUser = '$newFirst', NameUser = '$newLast', Pseudo = '$newPseudo' WHERE IDUser = '$id';";
$err = mysqli_query($conn, $sql) ? "success" : "noUpdate";
if (!empty($_POST['pwd1']) && !empty($_POST['pwd2']) && !empty($_POST['pwd3'])) {
    $sql = "SELECT * FROM choucroutte WHERE User = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result && ($pwd2 == $pwd3)) {
        $check = password_verify($pwd1, mysqli_fetch_assoc($result)['Hash']);
        if ($check == true) {
            $sql = "UPDATE choucroutte SET Hash = '" . password_hash($pwd2, PASSWORD_DEFAULT) . "' WHERE User = '$id'";
            $err = $err . (mysqli_query($conn, $sql) ? "" : "+failUpdatePwd");
        } else
            $err = $err . "+prevFail";
    } else {
        $err = $err . "+samePassword";
    }
}
$file = $_FILES['pp'];
$fileName = $file['name'];
$fileTmp = $file['tmp_name'];
$fileSize = $file['size'];
$fileError = $file['error'];
$fileType = $file['type'];
$fileExt = strtolower(end(explode('.', $fileName)));
$allowed = array('jpg', 'jpeg', 'png', 'gif', 'PNG');
if (!in_array($fileExt, $allowed)) {
    $err = $err . "+PPExtNotAllowed" . $fileExt . $fileName;
} else {
    if ($fileError != 0)
        $err = $err . "+fileUploadError";
    else {
        if ($fileSize > 1000000) {
            $err = $err . '+fileTooBig';
        } else {
            $newFileName = uniqid('', true) . "." . $fileExt;
            move_uploaded_file($fileTmp, "src/" . $newFileName);
            $sql = "INSERT INTO media (Path) VALUES ('" . "src/" . $newFileName . "');";
            mysqli_query($conn, $sql);
            $sql = "SELECT IDMedia FROM media WHERE Path LIKE '" . "src/" . $newFileName . "'";
            $idMedia = mysqli_fetch_assoc(mysqli_query($conn, $sql))['IDMedia'];
            $sql = "UPDATE `user` SET PP = '$idMedia' WHERE IDUser = '$id';";
            mysqli_query($conn, $sql);
        }
    }
}
$file = $_FILES['bp'];
$fileName = $file['name'];
$fileTmp = $file['tmp_name'];
$fileSize = $file['size'];
$fileError = $file['error'];
$fileType = $file['type'];
$fileExt = strtolower(end(explode('.', $fileName)));
$allowed = array('jpg', 'jpeg', 'png', 'gif');
if (!in_array($fileExt, $allowed)) {
    $err = $err . "+BPExtNotAllowed" . $fileExt . $fileName;
} else {
    if ($fileError != 0)
        $err = $err . "+fileUploadError";
    else {
        if ($fileSize > 1000000) {
            $err = $err . '+fileTooBig';
        } else {
            $newFileName = uniqid('', true) . "." . $fileExt;
            move_uploaded_file($fileTmp, "src/" . $newFileName);
            $sql = "INSERT INTO media (Path) VALUES ('" . "src/" . $newFileName . "');";
            mysqli_query($conn, $sql);
            $sql = "SELECT IDMedia FROM media WHERE Path LIKE '" . "src/" . $newFileName . "'";
            $idMedia = mysqli_fetch_assoc(mysqli_query($conn, $sql))['IDMedia'];
            $sql = "UPDATE `user` SET Background = '$idMedia' WHERE IDUser = '$id';";
            mysqli_query($conn, $sql);
        }
    }
}
$file = $_FILES['cv'];
$fileName = $file['name'];
$fileTmp = $file['tmp_name'];
$fileSize = $file['size'];
$fileError = $file['error'];
$fileType = $file['type'];
$fileExt = strtolower(end(explode('.', $fileName)));
$allowed = array('pdf');
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
            $sql = "UPDATE `user` SET CV = '$idMedia' WHERE IDUser = '$id';";
            mysqli_query($conn, $sql);
        }
    }
}
header("Location: modifyUserInfo.php?error=" . $err);
exit();
?>
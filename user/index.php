<!DOCTYPE html>
<html>

<head>
    <title>

    </title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="container">
    <?php
    /**
     * Created by PhpStorm.
     * User: Gabriel
     * Date: 30/04/2018
     * Time: 14:50
     */
    //include_once dirname(__DIR__).'database.php';
    include_once "../database.php";

    $sql = "SELECT * FROM user WHERE IDUser = '$_SESSION[id]'";
    $result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result)) {
        ?>

        <!-- Information User -->

        <img id="profilePicture" src="<?php echo $row['PP']?>" alt="Profile Picture" height="42" width="42">
        <img id="backgroundPicture" src="<?php echo $row['Background']?>" alt="Background Picture" height="60" width="80%">

        <p id="NameUser"><?php echo $row['NameUser'] ?></p>
        <p id="FirstNameUser"><?php echo $row['FirstNameUser'] ?></p>
        <p id="Pseudo"><?php echo $row['Pseudo'] ?></p>
        <p id="MailUser"><?php echo $row['MailUser'] ?></p>
        <p id="Status"><?php echo $row['Status'] ?></p>


        <?php
    }

    $sql = "SELECT * FROM Job inner join user on Job.User = user.IDUser inner join Company on Company.IDCompany = Job.Company WHERE Job.User = '$_SESSION[id]' ORDER BY DateEnd Desc";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        ?>
        <!-- Information Job -->
        <div id="jobs">
            <div id="job">
                <p id="titleJob"> <em><?php echo $row['Pseudo']?></em> a eu une expérience chez <em><?php echo $row['NameCompany']?></em></p><br>
                <p id="descriptionJob"> <em><?php echo $row['Poste']?></em> : <?php echo $row['Description']?></p>
                <p id="dateJob"> Du : <?php echo $row['DateBegin']?> Au : <?php echo $row['DateEnd']?></p>
            </div>
        </div>
    <?php
    }

    $sql = "SELECT * FROM Realisation inner join user on Realisation.User = user.IDUser WHERE IDUser = '$_SESSION[id]'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){

        $sql2 = "SELECT * FROM Realisation inner join user on user.IDUser = Realisation.User WHERE Projet = $row[Projet]";
        $result2 = mysqli_query($conn, $sql2);
        ?>
        <!-- <!-- Information Realisation --> -->
        <div id="realisations">
            <div id="realisation">
                <p id="descriptionRealisation"><?php echo $row['Description']?></p>
                <p id="membersRealisation"> Avec : <?php while($row2 = mysqli_fetch_assoc($result2)){ echo $row2['NameUser']; }?> </p>
            </div>
        </div>
        <?php
    }

    ?>

</div>

<a href="modifyUserInfo.php"></a>

</body>
<footer>

</footer>
</html>
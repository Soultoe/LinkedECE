<?php
include_once "borders.php";
if(!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}
?>
    <link href="bootstrap/css/you.css" rel="stylesheet">
    <div class="container">
        <?php
        /**
         * Created by PhpStorm.
         * User: Gabriel
         * Date: 30/04/2018
         * Time: 14:50
         */
        //include_once dirname(__DIR__).'database.php';
        include_once "database.php";
        //session_start();
        $admin = false;
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM `user` WHERE IDUser = '$id'";
        $result = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_assoc($result)) {
            $media = "SELECT Path FROM media WHERE IDMedia = $row[Background]";
            $mediaResult = mysqli_query($conn,$media);
            $media2 = "SELECT Path FROM media WHERE IDMedia = $row[PP]";
            $mediaResult2 = mysqli_query($conn,$media2);
            $admin = $row['Admin'];
            if($row2 = mysqli_fetch_assoc($mediaResult) AND $row3 = mysqli_fetch_assoc($mediaResult2)) {
                ?>

                <!-- Information User -->

                <div class="userProfile">

                    <img class="backgroundPicture" src="<?php echo $row2['Path'] ?>" alt="Background Picture">

                    <h1>My Informations</h1>
                    <div class="userInfo">

                        <img class="profilePicture" src="<?php echo $row3['Path'] ?>" alt="Profile Picture">


                    <div class="contactInfo">
                        <p id="Pseudo"><?php echo $row['Pseudo'] ?></p>
                        <p id="NameUser"><?php echo $row['NameUser'] ?></p>
                        <p id="FirstNameUser"><?php echo $row['FirstNameUser'] ?></p>
                        <p id="MailUser"><?php echo $row['MailUser'] ?></p>
						<?php 
							$sql = "SELECT Path FROM media WHERE IDMedia = $row[CV]";
							$myQuery = mysqli_query($conn, $sql);
							if($myQuery!=false && $cv = mysqli_fetch_assoc($myQuery)) {
						?>
						<p id="CV"><a href="<?php echo $cv['Path'] ?>">Mon CV ici</a></p>
						<?php
						}
						?>
                    </div>

                        <div class="otherInfo">
                            <p id="Status"><?php echo $row['Status'] ?></p>
                        </div>
                    </div>

                </div>


                <?php
            }
        }

        $sql = "SELECT * FROM experience inner join user on experience.User = user.IDUser inner join Company on Company.IDCompany = experience.Company WHERE experience.User = '$_SESSION[id]'";
        $result = mysqli_query($conn, $sql);?>
        <h1 style="margin-left: 20px;">My Experiences</h1>
        <div id="experiences">

            <?php while($row = mysqli_fetch_assoc($result)){
            ?>
            <!-- Information Job -->

                <div id="experience">
                    <p id="company"> <em><?php echo $row['Pseudo']?></em> a eu une expérience chez <i id="companyName"><?php echo $row['NameCompany']?></i></p>
                    <p id="position"> as <?php echo $row['Position']?></p>
                </div>

            <?php
        }?>
        </div>
        <?php

        $sql = "SELECT * FROM Realisation inner join user on Realisation.User = user.IDUser WHERE IDUser = '$_SESSION[id]'";
        $result = mysqli_query($conn, $sql);
        ?>
        <h1 style="margin-left: 20px;">My Realisations</h1>
        <div id="realisations">
        <?php while($row = mysqli_fetch_assoc($result)){

            $sql2 = "SELECT * FROM Realisation inner join user on user.IDUser = Realisation.User WHERE Projet = $row[Projet]";
            $result2 = mysqli_query($conn, $sql2);
            ?>
            <!-- <!-- Information Realisation -->

                <div id="realisation">
                    <p id="descriptionRealisation"><?php echo $row['Description']?></p>
                    <p id="membersRealisation"> Avec : <?php while($row2 = mysqli_fetch_assoc($result2)){ echo $row2['NameUser']; }?> </p>
                </div>
            <?php
        }?>
        </div>

    </div>

    <div class="buttons">
        <form action="modifyUserInfo.php">
            <input type="submit" value="Update profile" class="btn btn-success"/>
        </form>
    </div>



<?php
include_once "footer.php";
?>
<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 01/05/2018
 * Time: 11:23
 */

include_once "borders.php";
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

//$idLoad = null;

function connect($relationString)
{
    $sql = "INSERT INTO connectionrequest(User1, User2, Relationship) VALUES ($_SESSION[id], $_SESSION[idLoad], $relationString)";
    $server = "localhost";
    $username = "root";
    $pwd = "";
    $db = "linkedece";
    $conn = mysqli_connect($server, $username, $pwd, $db);

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Connection sent";
    }
}


if (isset($_POST['idLoad'])) {
    $_SESSION["idLoad"] = $_POST['idLoad'];
}


if (isset($_SESSION["idLoad"])) { //if has to load a specifique user page
    //if user is not is current user network
    //see image, name and a connect button
    $isInNetwork = null;

    $sql = "SELECT * FROM `user` INNER JOIN connection ON IDUser = User1 WHERE IDUser = '$_SESSION[idLoad]' AND User2 = '$_SESSION[id]'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        if ($row['IDUser']) $isInNetwork = true;
        else $isInNetwork = false;
    }

    $sql = "SELECT * FROM `user` INNER JOIN connection ON IDUser = User2 WHERE IDUser = '$_SESSION[idLoad]' AND User1 = '$_SESSION[id]'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        if ($isInNetwork == false && $row['IDUser']) $isInNetwork = true;
        else $isInNetwork = false;
    }

    if (!$isInNetwork) {
        $sql = "SELECT * FROM `user` WHERE IDUser = '$_SESSION[idLoad]'";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div id="unconnected">
                <img src="<?php echo $row['PP'] ?>">
                <img src="<?php echo $row['Background'] ?>">
                <p><em><?php echo $row['NameUser'] ?></em></p>
                <p><?php echo $row['FirstNameUser'] ?></p>

                <button id="Connect" action="connect('Friends')">Connect as a Friend</button>
                <button id="Connect" action="connect('Contact')">Connect as a Pro</button>
            </div>
            <?php
        }
    }
    //else is a connection
    //print the relationship and the user's info
    else {
        ?>
        <div id="connected">
            <?php
            //put the Relationship with the current user
            $relationship = null;
            $sql = "SELECT Relationship FROM connection WHERE User1 = $_SESSION[idLoad] AND User2 = $_SESSION[id]";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            if ($row['Relationship']) $relationship = $row['Relationship'];

            if (!$relationship) {
                $sql = "SELECT Relationship FROM connection WHERE User2 = $_SESSION[idLoad] AND User1 = $_SESSION[id]";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                if ($row['Relationship']) $relationship = $row['Relationship'];
            }
            ?>

            <div id="relationship">
                <p>Your are a <?php echo $relationship ?> of this person</p>
            </div>

            <?php

            //exactly the same code as user/index.php
            $sql = "SELECT * FROM `user` WHERE IDUser = '$_SESSION[idLoad]'";
            $result = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_assoc($result)) {
                ?>

                <!-- Information User -->

                <img id="profilePicture" src="<?php echo $row['PP'] ?>" alt="Profile Picture" height="42" width="42">
                <img id="backgroundPicture" src="<?php echo $row['Background'] ?>" alt="Background Picture" height="60"
                     width="80%">

                <p id="NameUser"><?php echo $row['NameUser'] ?></p>
                <p id="FirstNameUser"><?php echo $row['FirstNameUser'] ?></p>
                <p id="Pseudo"><?php echo $row['Pseudo'] ?></p>
                <p id="MailUser"><?php echo $row['MailUser'] ?></p>
                <p id="Status"><?php echo $row['Status'] ?></p>


                <?php
            }

            $sql = "SELECT * FROM Job inner join `user` on Job.User = `user`.IDUser inner join Company on Company.IDCompany = Job.Company WHERE Job.User = '$_SESSION[idLoad]' ORDER BY DateEnd Desc";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <!-- Information Job -->
                <div id="jobs">
                    <div id="job">
                        <p id="titleJob"><em><?php echo $row['Pseudo'] ?></em> a eu une expérience chez
                            <em><?php echo $row['NameCompany'] ?></em></p><br>
                        <p id="descriptionJob"><em><?php echo $row['Position'] ?></em>
                            : <?php echo $row['Description'] ?></p>
                        <p id="dateJob"> Du : <?php echo $row['DateBegin'] ?> Au : <?php echo $row['DateEnd'] ?></p>
                    </div>
                </div>
                <?php
            }

            $sql = "SELECT * FROM Realisation inner join `user` on Realisation.User = `user`.IDUser WHERE IDUser = '$_SESSION[idLoad]'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {

                $sql2 = "SELECT * FROM Realisation inner join `user` on `user`.IDUser = Realisation.User WHERE Projet = $row[Projet]";
                $result2 = mysqli_query($conn, $sql2);
                ?>
                <!-- <!-- Information Realisation --> -->
                <div id="realisations">
                    <div id="realisation">
                        <p id="descriptionRealisation"><?php echo $row['Description'] ?></p>
                        <p id="membersRealisation"> Avec : <?php while ($row2 = mysqli_fetch_assoc($result2)) {
                                echo $row2['NameUser'];
                            } ?> </p>
                    </div>
                </div>
                <?php
            }

            ?>
        </div>
        <?php
    }

} else { //load the list of member in network
    ?>
    <div class="members">
        <?php
        $arrayID = null;

        $sql = "SELECT DISTINCT User2 FROM `user` INNER JOIN connection ON `user`.IDUser = connection.User2 WHERE User1 = $_SESSION[id]";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $arrayID[] = $row['User2'];
        }

        $sql2 = "SELECT DISTINCT User1 FROM `user` INNER JOIN connection ON `user`.IDUser = connection.User1 WHERE User2 = $_SESSION[id]";
        $result2 = mysqli_query($conn, $sql2);
        while ($row2 = mysqli_fetch_assoc($result2)) {
            if (!in_array($row2['User1'], $arrayID)) {
                $arrayID[] = $row2['User1'];
            }
        }

        if ($arrayID == null) {
            ?>
            <p>You don't have any friends yet.</p>
            <?php
        } else {
            foreach ($arrayID as $id) {
                $sql = "SELECT DISTINCT  NameUser, FirstNameUser, PP FROM `user` INNER JOIN connection ON `user`.IDUser = connection.User2  WHERE IDuser = '$id'";
                $result = mysqli_query($conn, $sql);
                if ($row = mysqli_fetch_assoc($result)) {
                    $sql2 = "SELECT Path FROM user INNER JOIN media ON media.IDMedia = PP WHERE IDUser = '$id'";
                    $result2 = mysqli_query($conn, $sql2);
                    if ($row2 = mysqli_fetch_assoc($result2)) {
                        //$idLoad = $id;
                        ?>
                        <div class="member" id="<?php echo $id; ?>">
                            <img src="<?php echo $row2['Path'] ?>">
                            <p><em><?php echo $row['NameUser'] ?></em></p>
                            <p><?php echo $row['FirstNameUser'] ?></p>
                        </div>
                        <?php
                    }
                }
            }
        }
        ?>
    </div>
    <?php
}

?>
    <div id="jquery">
        <script>
            $(document).ready(function () {
                $(".member").click(function () {
                    /*
                     var xhttp = new XMLHttpRequest();
                     xhttp.onreadystatechange=function() {
                     if (this.readyState == 4 && this.status == 200) {
                     document.getElementById("member #id").innerHTML = this.responseText;
                     }
                     };
                     xhttp.open("GET", "network.php?idLoad=" + $(this.id), true);
                     xhttp.send();
                     */

                    var id = this.id;
                    alert(id);

                    $.ajax({
                        url: "network.php",
                        type: "post",
                        data: {idLoad: id}
                    }).done(function (msg) {

                        location.reload(true);
                    });

                });
            });
        </script>
    </div>
<?php
include_once "footer.php";

?>
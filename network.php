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
/*
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
*/
/*
if(isset($_SESSION['idLoad'])){
    unset($_SESSION['idLoad']);
}
*/

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
            <link href="bootstrap/css/network.css" rel="stylesheet">
            <link href="bootstrap/css/you.css" rel="stylesheet">
            <div id="unconnected">
                <?php
                $media2 = "SELECT Path FROM media WHERE IDMedia = $row[PP]";
                $mediaResult2 = mysqli_query($conn, $media2);
                if ($row3 = mysqli_fetch_assoc($mediaResult2)) {
                    ?>

                    <div class="nameAndPic">
                        <img class="friendPic" src="<?php echo $row3['Path'] ?>" alt="Profile Picture">
                        <p class="nameFriend"><?php echo $row['FirstNameUser'] ?><?php echo $row['NameUser'] ?></p>
                    </div>

                    <button id="ConnectFriend">Connect as a Friend</button>
                    <button id="ConnectPro">Connect as a Pro</button>
                    <?php
                }
                /**
                 * Handle the admin possibity to Upgrade a user, Downgrade an Admin and Delete a User
                 */
                $sql = "SELECT * FROM user WHERE IDUser = $_SESSION[id]";
                $result = mysqli_query($conn, $sql);
                if ($row = mysqli_fetch_assoc($result)) {
                    if ($row['Admin'][0] == 1) {
                        ?>
                        <p><em>Admin powers : </em></p><br>
                        <form action="upgradeAdmin.php" method="post" class="upgradeAdmin">
                            <button type="submit" name="submit" class="btn btn-info btn-sm upgradeAdmin">Upgrade User to
                                Admin
                            </button>
                        </form>

                        <form action="downgradeAdmin.php" method="post" class="downgradeAdmin">
                            <button type="submit" name="submit" class="btn btn-warning btn-sm downgradeAdmin">Downgrade
                                Admin to User
                            </button>
                        </form>

                        <form action="deleteAccount.php" method="post" class="deleteAccount">
                            <button type="submit" name="submit" class="btn btn-danger btn-sm deleteAccount">Delete this
                                account
                            </button>
                        </form>
                        <?php
                    }
                }

                ?>
            </div>
            <?php
        }

    }
    //else is a connection
    //print the relationship and the user's info
    else {
        ?>
        <link href="bootstrap/css/network.css" rel="stylesheet">
        <link href="bootstrap/css/you.css" rel="stylesheet">
        <div id="connected">
            <?php
            /**
             * CODE of you.php
             *
             */

            /**
             * Handle the relationship
             *
             */
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
            <h1 style="margin-left: 20px;">Informations</h1>
            <div id="relationship">
                <p>Your are a <?php echo $relationship ?> of this person</p>
            </div>

            <?php

            /**
             * exactly the same code as you.php
             *
             * Basic User information
             */
            $sql = "SELECT * FROM `user` WHERE IDUser = '$_SESSION[idLoad]'";
            $result = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_assoc($result)) {
                $media = "SELECT Path FROM media WHERE IDMedia = $row[Background]";
                $mediaResult = mysqli_query($conn, $media);
                $media2 = "SELECT Path FROM media WHERE IDMedia = $row[PP]";
                $mediaResult2 = mysqli_query($conn, $media2);
                $admin = $row['Admin'];
                if ($row2 = mysqli_fetch_assoc($mediaResult) AND $row3 = mysqli_fetch_assoc($mediaResult2)) {
                    ?>

                    <!-- Information User -->
                    <img class="backgroundPicture" src="<?php echo $row2['Path'] ?>" alt="Background Picture">

                    <div class="userInfo">

                        <img class="profilePicture" src="<?php echo $row3['Path'] ?>" alt="Profile Picture">


                        <div class="contactInfo">

                            <p id="NameUser"><?php echo $row['NameUser'] ?></p>
                            <p id="FirstNameUser"><?php echo $row['FirstNameUser'] ?></p>
                            <p id="Pseudo"><?php echo $row['Pseudo'] ?></p>
                            <p id="MailUser"><?php echo $row['MailUser'] ?></p>
                            <?php
                            $sql = "SELECT Path FROM media WHERE IDMedia = $row[CV]";
                            $myQuery = mysqli_query($conn, $sql);
                            if ($myQuery != false && $cv = mysqli_fetch_assoc($myQuery)) {
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


                    <?php
                }
            }

            /**
             * Handle Experience
             */
            $sql = "SELECT * FROM experience inner join user on experience.User = user.IDUser inner join Company on Company.IDCompany = experience.Company WHERE experience.User = '$_SESSION[idLoad]'";
            $result = mysqli_query($conn, $sql); ?>
            <h1 style="margin-left: 20px;">Experiences</h1>
            <div id="experiences">

                <?php while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <!-- Information Job -->

                    <div id="experience">
                        <p id="company"><em><?php echo $row['Pseudo'] ?></em> a eu une expérience chez <i
                                    id="companyName"><?php echo $row['NameCompany'] ?></i></p>
                        <p id="position"> as <?php echo $row['Position'] ?></p>
                    </div>

                    <?php
                } ?>
            </div>
            <?php

            /**
             * Handle Realisation
             */
            $sql = "SELECT * FROM Realisation inner join `user` on Realisation.User = `user`.IDUser WHERE IDUser = '$_SESSION[idLoad]'";
            $result = mysqli_query($conn, $sql);
            ?>
            <h1 style="margin-left: 20px;">Realisations</h1>
            <div id="realisations">
                <?php while ($row = mysqli_fetch_assoc($result)) {

                    $sql2 = "SELECT * FROM Realisation inner join `user` on `user`.IDUser = Realisation.User WHERE Projet = $row[Projet]";
                    $result2 = mysqli_query($conn, $sql2);
                    ?>
                    <!-- <!-- Information Realisation -->

                    <div id="realisation">
                        <p id="descriptionRealisation"><?php echo $row['Description'] ?></p>
                        <p id="membersRealisation"> Avec : <?php while ($row2 = mysqli_fetch_assoc($result2)) {
                                echo "$row2[NameUser], ";
                            } ?> </p>
                    </div>
                    <?php
                }


                ?>
            </div>
            <?php
            /**
             * Handle the admin possibity to Upgrade a user, Downgrade an Admin and Delete a User
             */
            $sql = "SELECT * FROM user WHERE IDUser = $_SESSION[id]";
            $result = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_assoc($result)) {
                if ($row['Admin'][0] == 1) {
                    ?>
                    <p><em>Admin powers : </em></p><br>
                    <form action="upgradeAdmin.php" method="post" class="upgradeAdmin">
                        <button type="submit" name="submit" class="btn btn-info btn-sm upgradeAdmin">Upgrade User to
                            Admin
                        </button>
                    </form>

                    <form action="downgradeAdmin.php" method="post" class="downgradeAdmin">
                        <button type="submit" name="submit" class="btn btn-warning btn-sm downgradeAdmin">Downgrade
                            Admin to User
                        </button>
                    </form>

                    <form action="deleteAccount.php" method="post" class="deleteAccount">
                        <button type="submit" name="submit" class="btn btn-danger btn-sm deleteAccount">Delete this
                            account
                        </button>
                    </form>
                    <?php
                }
            }

            ?>
        </div>
        <?php
    }

} else { //load the list of member in network
    ?>
    <link href="bootstrap/css/network.css" rel="stylesheet">
    <div class="members">
        <?php
        $arrayID = null;

        $sql = "SELECT DISTINCT User2 FROM `user` INNER JOIN connection ON `user`.IDUser = connection.User1 WHERE User1 = $_SESSION[id]";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $arrayID[] = $row['User2'];
        }

        $sql2 = "SELECT DISTINCT User1 FROM `user` INNER JOIN connection ON `user`.IDUser = connection.User2 WHERE User2 = $_SESSION[id]";
        $result2 = mysqli_query($conn, $sql2);
        while ($row2 = mysqli_fetch_assoc($result2)) {
            if ($arrayID != null) {
                if (!in_array($row2['User1'], $arrayID)) {
                    $arrayID[] = $row2['User1'];
                }
            } else {
                $arrayID[] = $row2['User1'];
            }
        }

        //var_dump($arrayID);

        if ($arrayID == null) {
            ?>
            <p>You don't have any friends yet.</p>
            <?php
        } else {
            foreach ($arrayID as $id) {
                $sql = "SELECT DISTINCT  NameUser, FirstNameUser, PP FROM `user` INNER JOIN connection ON `user`.IDUser = connection.User2  WHERE IDuser = '$id' UNION SELECT DISTINCT  NameUser, FirstNameUser, PP FROM `user` INNER JOIN connection ON `user`.IDUser = connection.User1  WHERE IDuser = '$id'";
                $result = mysqli_query($conn, $sql);
                if ($row = mysqli_fetch_assoc($result)) {
                    $sql2 = "SELECT Path FROM user INNER JOIN media ON media.IDMedia = PP WHERE IDUser = '$id'";
                    $result2 = mysqli_query($conn, $sql2);
                    if ($row2 = mysqli_fetch_assoc($result2)) {
                        //$idLoad = $id;
                        ?>
                        <div class="member" id="<?php echo $id; ?>">
                            <img src="<?php echo $row2['Path'] ?>" class="friendPic">
                            <p class="nameFriend"><?php echo $row['FirstNameUser'] ?><?php echo $row['NameUser'] ?></p>

                            <form action="deleteFriend.php" method="post" class="deleteFriendButton">
                                <button type="submit" name="submit" class="btn btn-danger btn-xs deleteFriendButton">
                                    Delete
                                </button>
                            </form>
                        </div>
                        <?php
                    }
                }

                /*
                $sql = "SELECT DISTINCT  NameUser, FirstNameUser, PP FROM `user` INNER JOIN connection ON `user`.IDUser = connection.User1  WHERE IDuser = '$id'";
                $result = mysqli_query($conn, $sql);
                if ($row = mysqli_fetch_assoc($result)) {
                    $sql2 = "SELECT Path FROM user INNER JOIN media ON media.IDMedia = PP WHERE IDUser = '$id'";
                    $result2 = mysqli_query($conn, $sql2);
                    if ($row2 = mysqli_fetch_assoc($result2)) {
                        //$idLoad = $id;
                        ?>
                        <div class="member" id="<?php echo $id; ?>">
                            <img src="<?php echo $row2['Path'] ?>" class="friendPic">
                            <p class="nameFriend"><?php echo $row['FirstNameUser'] ?><?php echo $row['NameUser'] ?></p>

                            <form action="deleteFriend.php" method="post" class="deleteFriendButton">
                                <button type="submit" name="submit" class="btn btn-danger btn-xs deleteFriendButton">
                                    Delete
                                </button>
                            </form>
                        </div>
                        <?php
                    }
                }
                */
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
                    var id = this.id;
                    //alert(id);

                    $.ajax({
                        url: "network.php",
                        type: "post",
                        data: {idLoad: id}
                    }).done(function () {

                        location.reload(true);
                    });

                });

                $("#ConnectFriend").click(function () {
                    var id = this.id;
                    //alert(id);
                    $.ajax({
                        type: "POST",
                        url: "connect.php",
                        data: {
                            Relationship: "Friend",
                            Id: id
                        }
                    }).done(function () {
                        //alert("Data Saved: " + msg);
                        //alert("Connection request sent");
                        $("#ConnectFriend").hide();
                        $("#ConnectPro").hide();
                    });
                });

                $("#ConnectPro").click(function () {
                    var id = this.id;
                    $.ajax({
                        type: "POST",
                        url: "connect.php",
                        data: {
                            Relationship: "Contact",
                            Id: id
                        }
                    }).done(function () {
                        //alert("Data Saved: " + msg);
                        //alert("Connection request sent");
                        $("#ConnectPro").hide();
                        $("#ConnectFriend").hide();
                    });
                });
            });
        </script>
    </div>
<?php
include_once "footer.php";


?>
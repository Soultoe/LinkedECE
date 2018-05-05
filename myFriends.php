<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 05/05/2018
 * Time: 11:38
 */

include_once "borders.php";
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

?>
    <link href="bootstrap/css/network.css" rel="stylesheet">
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
                            <img src="<?php echo $row2['Path'] ?>" class="friendPic">
                            <p class="nameFriend"><?php echo $row['FirstNameUser'] ?><?php echo $row['NameUser'] ?></p>

                            <form action="deleteFriend.php" method="post" class="deleteFriendButton">
                                <button type="submit" name="submit" class="btn btn-danger btn-xs deleteFriendButton">Delete</button>
                            </form>
                        </div>
                        <?php
                    }
                }
            }
        }
        ?>
    </div>
<?php

include_once "footer.php";
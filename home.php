<?php
include_once "borders.php";
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}
?>
    <link href="bootstrap/css/home.css" rel="stylesheet">
    <div class="feed">
    <div class="newPublish">

        <form action="newPost.php" method="POST" enctype="multipart/form-data">

            <div class="content">
                    <textarea class="publishArea" name="text"
                              placeholder="Ecrivez votre nouvelle publication ici"></textarea>
            </div>

            <div class="precisions">

                <div class="file">
                    <i class="glyphicon glyphicon-plus" style="height: 20px; width: 20px;"></i>
                    <input type="file" name="doc">
                </div>

                <div class="date">
                    <i class="glyphicon glyphicon-calendar" style="height: 20px; width: 20px;"></i>
                    <input type="date" name="date">
                </div>


                <div class="place">
                    <i class="glyphicon glyphicon-map-marker" style="height: 20px; width: 20px;"></i>
                    <input type="text" name="place">
                </div>


            </div>

            <button action="logout.php" method="POST" name="submit" class="btn btn-success publishButton">Publier
            </button>

        </form>
    </div>
<?php
$arrayID = array();
$sql = "SELECT DISTINCT User2 FROM `user` INNER JOIN connection ON `user`.IDUser = connection.User1 WHERE User1 = $_SESSION[id]";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $arrayID[] = $row['User2'];
}
$arrayID = array_unique($arrayID);
$sql2 = "SELECT DISTINCT User1 FROM `user` INNER JOIN connection ON `user`.IDUser = connection.User2 WHERE User2 = $_SESSION[id]";
$result2 = mysqli_query($conn, $sql2);
while ($row2 = mysqli_fetch_assoc($result2)) {
    if (!in_array($row2['User1'], $arrayID)) {
        $arrayID[] = $row2['User1'];
    }
}
$sql = "SELECT DISTINCT IDPublication, User, Description, Media, DatePublication, DateUser, PlaceUser, Visibility FROM `publication` ORDER BY `DatePublication` DESC";
$admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT Admin FROM `user` WHERE IDUser = $_SESSION[id]"))['Admin'];
$tmp = mysqli_query($conn, $sql);
while ($res = mysqli_fetch_assoc($tmp)){
    ?>
<link href="bootstrap/css/home.css" rel="stylesheet">
    <div style="display: flex;
			            flex-direction: column;
                        border-style: solid;
                        border-width: 2px;
                        border-color: #007179;
                        border-radius: 10px;
                        color: #007179;
                        padding-left: 20px;">


    <?php if ($res['User'] == $_SESSION['id'] || in_array($res['User'], $arrayID)) {

    $sql = "SELECT NameUser, FirstNameUser, Admin FROM `user` WHERE IDUser = $res[User]";
    $res2 = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    if ($res['User'] == $_SESSION['id'] || $admin[0] == 1) {
        ?>
        <form action="deletePost.php" method="POST" style="margin-top: 20px;">
            <input type="hidden" name="DEL" value="<?php echo $res['IDPublication'] ?>">
            <button type="submit" name="submit" class="glyphicon glyphicon-remove"
                    style="float: right; margin-right: 20px; border:none; background-color: #bfecef; height: 30px; width: 30px;"></button>
        </form>
        <?php
    }

    echo "<div>";
    echo " <div style='font-size: large; font-weight: bolder; '> $res2[FirstNameUser] $res2[NameUser] published:  </div>";
    echo " <div style='font-size: small; font-style: italic; margin-left: 20px; '> <p>at $res[DatePublication]";

    if ($res['DateUser'] != NULL) {
        echo " <div style='font-size: smaller; font-style: italic; margin-left: 10px; '> <p>$res[DateUser], ";
        if ($res['PlaceUser'] != NULL)
            echo " $res[PlaceUser] </br>";
    }

    if ($res['Description'] != NULL)
        echo "<i style='color: black; font-size: medium'> </br> $res[Description]</i> </p> </div>";


    if ($res['Media'] != NULL) {
        $sql = "SELECT Path FROM Media WHERE IDMedia = $res[Media]";
        $vidArray = array('mp4', 'ogg');
        $res3 = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $tmp2 = explode('.', $res3['Path']);
        if (in_array(end($tmp2), $vidArray)) {
            ?>
            <video controls>
                <source src="<?php echo $res3['Path'] ?>" type="video/mp4">
                Sorry, your browser doesn't support the video element.
            </video>
            <?php
        } else {
            ?>
            <img style='height: auto; width=auto; max-height: 800px; max-width: 800px; border-radius: 10px; margin-bottom: 20px;'
                 src="<?php echo $res3['Path'] ?>" alt="PHOTO NON AFFICHEE">
            <?php
        }
    }
    echo "</div>";

    ?>
    <form action="toggleReact.php" method="POST">
        <input type="hidden" name="post" value="<?php echo $res['IDPublication'] ?>">
        <input type="submit" name="submit" style='margin-left: 20px; margin-bottom: 20px;' class='btn btn-success'
               value="<?php
               $sql = "SELECT COUNT(DISTINCT User) AS 'Num' FROM reaction WHERE Publication=$res[IDPublication]";
               $react = mysqli_fetch_assoc(mysqli_query($conn, $sql))['Num'];
               $sql = "SELECT COUNT(DISTINCT User) AS 'Num' FROM reaction WHERE Publication=$res[IDPublication] AND reaction.User=$_SESSION[id]";
               $already = mysqli_fetch_assoc(mysqli_query($conn, $sql))['Num'];
               echo ($already == 0 ? "LIKE" : "LIKED") . " $react";
               ?>">
    </form>
    <form action="newComment.php" method="POST">
        <input type="hidden" name="User" value="<?php echo $_SESSION['id'] ?>">
        <input type="hidden" name="post" value="<?php echo $res['IDPublication'] ?>">
        <textarea style='margin-left: 20px; border-radius: 10px;' name="comment"
                  placeholder="Ecrivez votre commentaire ici"></textarea>
        <div>
            <input type="submit" name="submit" value="commenter" class="btn btn-primary"
                   style="margin-left: 20px; margin-bottom: 20px;">
        </div>
    </form>
    <?php
    $sql = "SELECT * FROM comment INNER JOIN `user` ON IDUser = User WHERE Publication=$res[IDPublication] ORDER BY `DateComment` ASC";
    $comments = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($comments)) {
        ?>
        <div>
            <p><?php echo $row['Pseudo'] ?> has left a comment : <?php echo $row['Content'] ?></p>
            <?php
            if ($row['User'] == $_SESSION['id'] || $admin[0] == 1) { ?>
                <form action="deleteComment.php" method="POST">
                    <div style="display: flex;">
                        <input type="hidden" name="DEL" value=<?php echo $row['IDComment'] ?>>
                        <button type="submit" name="submit" value="Delete Comment" class="glyphicon glyphicon-remove"
                                style="border:none; background-color: #bfecef; height: 30px; width: 30px; margin-bottom: 20px;"></button>
                    </div>
                </form>
            <?php } ?>
        </div>
        <?php
    }
}
    echo "</div>"; //fin div publication
}
?>
    </div>
<?php
?>


<?php
include_once "footer.php";
?>
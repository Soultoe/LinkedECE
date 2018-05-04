<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 01/05/2018
 * Time: 10:37
 */
include_once "borders.php";
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

$arrayID = null;
$idLoad = null;

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

                    window.location.href ="network.php";
                });
            });
        });
    </script>
</div>
<?php

$string = mysqli_real_escape_string($conn, $_POST["searchBarField"]);

if (empty($string)) {
    header("Location: index.php?error=emptySearch");
    exit();
} else {
    $string = '%' . $string . '%';
    $sql = "SELECT IDUser FROM `user` WHERE NameUser LIKE '$string' OR FirstNameUser LIKE '$string' OR MailUser LIKE '$string' OR Pseudo LIKE '$string'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayID[] = $row['IDUser'];
    }

    ?>
    <div class="members">
        <?php
        if($arrayID != null){
            foreach ($arrayID as $id) {
                $sql = "SELECT NameUser, FirstNameUser, PP FROM `user` WHERE IDUser = $id";
                $result = mysqli_query($conn, $sql);

                if ($row = mysqli_fetch_assoc($result)) {
                    $sql2 = "SELECT Path FROM user INNER JOIN media ON media.IDMedia = PP WHERE IDUser = '$id'";
                    $result2 = mysqli_query($conn, $sql2);
                    if ($row2 = mysqli_fetch_assoc($result2)) {
                        $idLoad = $id;
                    ?>
                        <div class="member" id="<?php echo $id; ?>">
                        <img src="<?php echo $row2['Path'] ?>">
                        <p><em><?php echo $row['NameUser'] ?></em> <?php echo $row['FirstNameUser'] ?></p>
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

include_once "footer.php";


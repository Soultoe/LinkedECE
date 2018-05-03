<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 03/05/2018
 * Time: 14:25
 */
include_once  "borders.php";
if(!isset($_SESSION['id'])){
    header("Location: index.php");
    exit();
}

$user = null;
?>
<div id="connectionRequests">
<?php
$sql = "SELECT * FROM connectionrequest INNER JOIN user ON IDUser = User1 WHERE User2 = $_SESSION[id]";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    $user = $row['NameUser'];
    ?>
    <div id="connectionRequest">
        <p><?php echo $row['NameUser']?> souhaite vous ajouter en tant que <? $row['Relationship']?> : </p><br>
        <button type="button" class="btn btn-success" id="accept">Accepter</button>
        <button type="button" class="btn btn-danger" id="decline">Décliner</button>
    </div>
    <?php
}


    ?>
</div>
<div id="messages">
<?php
$sql ="SELECT * FROM publication INNER JOIN user ON IDUser = publication.User WHERE (publication.DatePublication > user.lastDeconnection) AND IDUser=$_SESSION[id]";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    ?>
    <div id="message">
        <p><em><?php echo $row['NameUser']?></em> a publié un nouveau post à <?php echo $row['DatePublication']?></p>
    </div>
    <?php
}
?>
</div>
<div id="jquery">
    <script>
        $(document).ready(function(){
            $("#accept").click(function(){
                <?php
                //insert the new connection
                $sql = "INSERT INTO connection(User1, User2, Relationship) VALUES($_SESSION[id], $user, $row[Relationship])";
                $result = mysqli_query($conn, $sql);

                //delete the request
                $sql = "DELETE FROM connectionrequest WHERE IDConnectionRequest = $row[IDConnectionRequest]";
                $result = mysqli_query($conn, $sql);
                ?>
            });

            $("#decline").click(function(){
                <?php
                //delete the request
                $sql = "DELETE FROM connectionrequest WHERE IDConnectionRequest = $row[IDConnectionRequest]";
                $result = mysqli_query($conn, $sql);
                ?>
            });
        });
    </script>
</div>
<?php
include_once "footer.php";


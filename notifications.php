<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 03/05/2018
 * Time: 14:25
 */
include_once "borders.php";
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

$user = null;
?>
    <div class="connectionRequests">
        <?php
        $sql = "SELECT * FROM connectionrequest INNER JOIN user ON IDUser = User1 WHERE User2 = $_SESSION[id]";
        $result = mysqli_query($conn, $sql);
        while ($rowRequest = mysqli_fetch_assoc($result)) {
            //$user = $rowRequest['NameUser'];
            ?>
            <div class="connectionRequest" id="<?php echo $rowRequest['User1'] ?>">
                <p><?php echo $rowRequest['NameUser'] ?> wants to add you as a <?php echo $rowRequest['Relationship'] ?>
                    : </p><br>
                <button type="button" class="btn btn-success" id="accept">Accept</button>
                <button type="button" class="btn btn-danger" id="decline">Decline</button>
            </div>
            <?php
        }


        ?>
    </div>
    <div id="messages">
        <?php
        $sql = "SELECT * FROM publication INNER JOIN user ON IDUser = publication.User WHERE (publication.DatePublication > user.lastDeconnection) AND IDUser=$_SESSION[id]";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div id="message">
                <p style="font-size: medium; font-weight: bold; font-style: normal; color: #007179;"> <i class="glyphicon glyphicon-heart" style="margin-right: 10px;"></i>    <?php echo $row['NameUser'] ?> published a new post at <?php echo $row['DatePublication'] ?>
                </p>
            </div>
            <?php
        }
        ?>
    </div>
    <div id="jquery">
        <script>
            $(document).ready(function () {
                $("#accept").click(function (e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    var id = $(this).parent()[0].id;
                    //alert(id);
                    $.ajax({
                        type: "POST",
                        url: "acceptConnection.php",
                        data: {
                            userID: id
                        }
                    }).done(function () {
                        $(".connectionRequest").hide();
                    });

                });

                $("#decline").click(function () {
                    $.ajax({
                        type: "POST",
                        url: "declineConnection.php",
                        data: {
                            userID: id
                        }
                    }).done(function () {
                        $(".connectionRequest").hide();
                    });
                });

            });
        </script>
    </div>
<?php
include_once "footer.php";


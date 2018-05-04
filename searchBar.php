<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 01/05/2018
 * Time: 10:37
 */

include_once "database.php";

session_start();
$arrayID = null;
$idLoad = null;

?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
        $("#result").click(function(){
            <?php
                $_SESSION["idLoad"] = $idLoad;
            ?>
        });
        });
    </script>

<?php

$string = $_POST["searchBarField"];
$string = '%'.$string.'%';
$sql = "SELECT IDUSer FROM 'user' WHERE NameUser = $string OR FirstNameUser = $string OR MailUser = $string OR Pseudo = $string";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
    $arrayID[] = $row['IDUser'];
}

?>
<div id="results">
<?php
foreach ($arrayID as $id){
    $sql = "SELECT NameUser, FirstNameUser, PP FROM 'user' WHERE IDUser = $id";
    $result = mysqli_query($conn, $sql);

    if($row = mysqli_fetch_assoc($result)){
        $idLoad = $id;
        ?>
        <div id="result">
            <img src="<?php echo $row['PP'] ?>">
            <p><em><?php echo $row['NameUser']?></em> <?php echo $row['FirstNameUser']?></p>
        </div>
        <?php
    }
}
?>
</div>
<?php


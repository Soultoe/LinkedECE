<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 02/05/2018
 * Time: 09:40
 */

include_once  "borders.php";
if(!isset($_SESSION['id'])){
    header("Location: index.php");
    exit();
}

/*
 * Only an admin as the right to post a job
 * He can create the corresponding company and then post the job
 *
 * A normal user can see the avalable jobs
 */

$sql = "SELECT Admin FROM user WHERE IDUser = '$_SESSION[id]'";
$result = mysqli_query($conn, $sql);
if($row = mysqli_fetch_assoc($result)) {
    if($row['Admin'] == true){ //Is an admin

        ?>
        <div id="companies">
            <?php
            $sql = "SELECT * FROM company";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <div id="company">
                    <img src="<?php echo $row['PP'] ?>">
                    <p><em><?php echo $row['NameCompany']?></em></p>
                </div>
                <?php
            }
            ?>
            <div id="addCompany">
                <button> add Company </button>
            </div>
        </div>
        <?php


        ?>
        <div id="jobs">
            <?php
            $sql = "SELECT * FROM job INNER JOIN user ON IDUser = job.User INNER JOIN company ON company.IDCompany = job.Company ";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <div id="job">
                    <p><em><?php echo $row['NameCompany']?></em></p>
                    <p><?php echo $row['Position']?></p>
                    <p><?php echo $row['Description']?></p>
                    <p><?php echo $row['DateBegin']?></p>
                    <p><?php echo $row['DateEnd']?></p>
                    <p><?php echo $row['NameUser']?></p>
                    <p><?php echo $row['MailCompany']?></p>
                </div>
                <?php
            }
            ?>
            <div id="addJob">
                <button> add Job </button>
            </div>
        </div>
        <?php

    }
    else { //Is a normal user

        /*
         * has a company or nor
         * if has one : can only see his company jobs proposition and can add one
         * if doesn't have one then can see all proposition
         *
         */
        $sql = "SELECT Company FROM user";
        $result = mysqli_query($conn, $sql);
        if($row = mysqli_fetch_assoc($result)) {
            if($row['Company'] != null){ //has a company
                ?>
                <div id="jobs">
                    <?php
                    $comp = null;

                    $sql = "SELECT Company FROM user WHERE IDUser = $_SESSION[id]";
                    $result = mysqli_query($conn, $sql);
                    if($row = mysqli_fetch_assoc($result)) $comp = $row['company'];

                    $sql = "SELECT * FROM job INNER JOIN user ON IDUser = job.User INNER JOIN company ON company.IDCompany = job.Company WHERE job.Company = $comp";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div id="job">
                            <p><em><?php echo $row['NameCompany']?></em></p>
                            <p><?php echo $row['Position']?></p>
                            <p><?php echo $row['Description']?></p>
                            <p><?php echo $row['DateBegin']?></p>
                            <p><?php echo $row['DateEnd']?></p>
                            <p><?php echo $row['NameUser']?></p>
                            <p><?php echo $row['MailCompany']?></p>
                        </div>
                        <?php
                    }
                    ?>
                    <div id="addJob">
                        <button> add Job </button>
                    </div>
                </div>
                <?php
            }
            else{ //doesn't have a company
                ?>
                <div id="jobs">
                    <?php
                    $sql = "SELECT * FROM job INNER JOIN user ON IDUser = job.User INNER JOIN company ON company.IDCompany = job.Company ";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div id="job">
                            <p><em><?php echo $row['NameCompany']?></em></p>
                            <p><?php echo $row['Position']?></p>
                            <p><?php echo $row['Description']?></p>
                            <p><?php echo $row['DateBegin']?></p>
                            <p><?php echo $row['DateEnd']?></p>
                            <p><?php echo $row['NameUser']?></p>
                            <p><?php echo $row['MailCompany']?></p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
        }
    }

}

?>

<div id="jquery">
    <script>
        $(document).ready(function(){
            $("#addCompany").click(function(){
                $.load("addCompany.php");
            });
            $("#addJob").click(function(){
                $.load("addJob.php");
            });
        });
    </script>
</div>

<?php
include_once "footer.php";
?>
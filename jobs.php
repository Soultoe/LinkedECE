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
 * A normal user can see the available jobs
 */


$sql = "SELECT Admin FROM user WHERE IDUser = '$_SESSION[id]'";
$result = mysqli_query($conn, $sql);
if($row = mysqli_fetch_assoc($result)) {
    if($row['Admin'] == true){ //Is an admin

        ?>
        <link href="bootstrap/css/jobs.css" rel="stylesheet">
        <div id="companies">
            <?php
            $sql = "SELECT * FROM company";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                $media = "SELECT Path FROM media WHERE IDMedia = $row[PP]";
                $mediaResult = mysqli_query($conn,$media);
                while($row2 = mysqli_fetch_assoc($mediaResult)) {
                    ?>
                    <div id="company">
                        <img class="companyLogo" src="<?php echo $row2['Path'] ?>">
                        <p id="companyName"><em><?php echo $row['NameCompany'] ?></em></p>
                    </div>
                    <?php
                }
            }
            ?>
            <div id="addCompany">
                <button class="btn btn-success"> add Company </button>
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
                    <p id="companyName" class="strong"><?php echo $row['NameCompany']?> is searching for a:</p>
                    <p class="jobDescription"><?php echo $row['Position']?></p>
                    <p class="jobDescription2"><?php echo $row['Description']?></p>
                    <p class="jobDescription2">From: <?php echo $row['DateBegin']?></p>
                    <p class="jobDescription2">To: <?php echo $row['DateEnd']?></p>
                    <p class="jobDescription">Offered by: <?php echo $row['NameUser']?></p>
                    <p class="jobDescription"><?php echo $row['MailCompany']?></p>
                </div>
                <?php
            }
            ?>
            <div id="addJob">
                <button class="btn btn-success addJobButton"> add Job </button>
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
                <link href="bootstrap/css/jobs.css" rel="stylesheet">
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
                            <p id="companyName" class="strong"><em><?php echo $row['NameCompany']?></em></p>
                            <p class="jobDescription"><?php echo $row['Position']?></p>
                            <p class="jobDescription2"><?php echo $row['Description']?></p>
                            <p class="jobDescription2"><?php echo $row['DateBegin']?></p>
                            <p class="jobDescription2"><?php echo $row['DateEnd']?></p>
                            <p class="jobDescription"><?php echo $row['NameUser']?></p>
                            <p class="jobDescription"><?php echo $row['MailCompany']?></p>
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
                <link href="bootstrap/css/jobs.css" rel="stylesheet">
                <div id="jobs">
                    <?php
                    $sql = "SELECT * FROM job INNER JOIN user ON IDUser = job.User INNER JOIN company ON company.IDCompany = job.Company ";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div id="job" class="test">
                            <p id="companyName" class="strong"><em><?php echo $row['NameCompany']?></em></p>
                            <p class="jobDescription"><?php echo $row['Position']?></p>
                            <p class="jobDescription2"><?php echo $row['Description']?></p>
                            <p class="jobDescription2"><?php echo $row['DateBegin']?></p>
                            <p class="jobDescription2"><?php echo $row['DateEnd']?></p>
                            <p class="jobDescription"><?php echo $row['NameUser']?></p>
                            <p class="jobDescription"><?php echo $row['MailCompany']?></p>
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
<?php
	include_once "borders.php";
	if(!isset($_SESSION['id'])){
		header("Location: index.php");
		exit();
	}
?>
    <link href="bootstrap/css/modifyUserInfoStyle.css" rel="stylesheet">
    <form action="you.php" method="post" class="backForm">
        <input type="submit" name="submit" value="Back" class="btn btn-primary"/>
    </form>

    <div class="updateProfile">

        <h2>Update Information</h2>

        <form action="update.php" method="POST" enctype="multipart/form-data">
		<?php
			include_once "database.php";
			$id = $_SESSION['id'];
			$sql = "SELECT * FROM `user` WHERE IDUser = '$id'";
			$res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
			$first = $res['FirstNameUser'];
			$last = $res['NameUser'];
			$pseudo = $res['Pseudo'];
			echo '

                <div class="form-group">
                <label>Nouveau Prénom</label>
                <input type="text" name="firstName" value="'.$first.'" class="form-control field">
                </div>
		
		        <div class="form-group">
		        <label>Nouveau Nom de famille</label>
		        <input type="text" name="lastName" value="'.$last.'" class="form-control field">
		        </div>
		
		        <div class="form-group">
		        <label> Nouveau Pseudo</label>
		        <input type="text" name="pseudo" value="'.$pseudo.'" class="form-control field">
		        </div>
		
		        <div class="form-group">
		        <label>Nouveau mot de passe</label>
		        <input type="password" name="pwd1" placeholder="Previous password" class="form-control field">
		        </div>
		
		        <div class="form-group">
		        <input type="password" name="pwd2" placeholder="New Password" class="form-control field">
		        <input type="password" name="pwd3" placeholder="Confirm New Password" class="form-control field">
		        </div>
		
		        <div class="form-group">
		        <label>Photo de profil</label>
		        <input type="file" name="pp" class="field"> 
		        </div>
		
		        <div class="form-group">
		        <label>Photo de fond</label>
		        <input type="file" name="bp" class="field">
		        </div>
		
		        <div class="form-group">
		        <label>CV</label>
		        <input type="file" name="cv" class="field">
		        </div>
		';
		?>
		<button type="submit" name="submit" class="btn btn-success">Update</button>
	</form>
    </div>

    <div class="updateExperiences">

        <h2>Add or Update Experiences</h2>

        <form action="addExperience.php" method="post">

            <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="companyName" placeholder="company Name" class="form-control field">
            </div>

            <div class="form-group">
                <label>Experience description</label>
                <input type="text" name="Edescription" placeholder="Edescription" class="form-control field">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Add</button>
        </form>

        <form action="" method="post" enctype="multipart/form-data">
            <?php
            include_once "database.php";
            $id = $_SESSION['id'];
            $exp = "SELECT * FROM `user` WHERE IDUser = '$id'";
            $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            $companyID = $result['Company'];
            //$position = mysqli_real_escape_string($conn,$result['Position']);
            echo '

            <div class="form-group">
                <label>Nouveau Prénom</label>
                <input type="text" name="firstName" value="'.$first.'" class="form-control field">
            </div>
            
            ';
            ?>
            <button type="submit" name="submit" class="btn btn-success">Update</button>
        </form>
    </div>

    <div class="updateRealisations">

        <h2>Add or Update Realisations</h2>

        <form action="addRealisation.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Projet Name</label>
                <input type="text" name="project" value="project" class="form-control field">
            </div>

            <div class="form-group">
                <label>Project Description</label>
                <input type="text" name="Pdescription" value="Pdescription" class="form-control field">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Add</button>
        </form>

        <form action="" method="post" enctype="multipart/form-data">
            <?php
            include_once "database.php";
            $id = $_SESSION['id'];
            $sql = "SELECT * FROM experience WHERE `User` = $id";
            $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            echo '

            <div class="form-group">
                <label>Nouveau Prénom</label>
                <input type="text" name="firstName" value="'.$first.'" class="form-control field">
            </div>
            
            ';
            ?>
            <button type="submit" name="submit" class="btn btn-success">Update</button>
        </form>
    </div>


<?php
    include_once "footer.php";
?>
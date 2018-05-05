<?php
	include_once "borders.php";
if (!isset($_SESSION['id'])) {
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
                <label>New first name</label>
                <input type="text" name="firstName" value="'.$first.'" class="form-control field">
                </div>
		
		        <div class="form-group">
		        <label>New surname</label>
		        <input type="text" name="lastName" value="'.$last.'" class="form-control field">
		        </div>
		
		        <div class="form-group">
		        <label> New alias</label>
		        <input type="text" name="pseudo" value="'.$pseudo.'" class="form-control field">
		        </div>
		
		        <div class="form-group">
		        <label>New Password</label>
		        <input type="password" name="pwd1" placeholder="Previous password" class="form-control field">
		        </div>
		
		        <div class="form-group">
		        <input type="password" name="pwd2" placeholder="New Password" class="form-control field">
		        <input type="password" name="pwd3" placeholder="Confirm New Password" class="form-control field">
		        </div>
		
		        <div class="form-group">
		        <label>Change profile picture</label>
		        <input type="file" name="pp" class="field"> 
		        </div>
		
		        <div class="form-group">
		        <label>Change background picture</label>
		        <input type="file" name="bp" class="field">
		        </div>
		
		        <div class="form-group">
		        <label>upload a Curriculum Vitae</label>
		        <input type="file" name="cv" class="field">
		        </div>
		';
		?>
		<button type="submit" name="submit" class="btn btn-success">Update</button>
	</form>
    </div>

    <div class="updateExperiences">

        <h2>Add or Delete Experiences</h2>

        <form action="addExperience.php" method="post">

            <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="companyName" placeholder="company Name" class="form-control field">
            </div>

            <div class="form-group">
                <label>Experience description</label>
                <input type="text" name="Edescription" placeholder="description" class="form-control field">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Add</button>
        </form>

        <form action="deleteExperience.php" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label>Company</label>
                <input type="text" name="company" placeholder="company Name" class="form-control field">
            </div>
            <div class="form-group">
                <label>Position</label>
                <input type="text" name="position" placeholder="Position" class="form-control field">
            </div>
            <button type="submit" name="submit" class="btn btn-danger">Delete</button>

        </form>
    </div>

    <div class="updateRealisations">

        <h2>Add or Delete Realisations</h2>

        <form action="addRealisation.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Project Name</label>
                <input type="text" name="project" placeholder="project" class="form-control field">
            </div>

            <div class="form-group">
                <label>Project Description</label>
                <input type="text" name="Pdescription" placeholder="description" class="form-control field">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Add</button>
        </form>

        <form action="deleteRealisation.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Realisation to delete (project number)</label>
                <input type="number" name="projectID" placeholder="project number" class="form-control field">
            </div>
            <button type="submit" name="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>


<?php
    include_once "footer.php";
?>
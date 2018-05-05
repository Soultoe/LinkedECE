<?php
include_once "signUpAndLoginBorders.php";
if (isset($_SESSION['id'])) {
    header("Location: home.php");
    exit();
}
?>

    <link href="bootstrap/css/signUp.css" rel="stylesheet">

    <div class="signUpForm">
        <form action="signup.php" method="POST">
            <div class="form-group">
                <input type="text" name="firstName" placeholder="First Name" id="firstName" class="form-control">
            </div>

            <div class="form-group">
                <input type="text" name="lastName" placeholder="Last Name" id="lastName" class="form-control">
            </div>

            <div class="form-group">
                <input type="text" name="email" placeholder="Mail" id="mail" class="form-control">
            </div>

            <div class="form-group">
                <input type="text" name="pseudo" placeholder="Pseudo" id="pseudo" class="form-control">
            </div>

            <div class="form-group">
                <input type="password" name="pwd" placeholder="Password" id="pwd" class="form-control">
            </div>

            <div class="form-group">
                <input type="password" name="pwd2" placeholder="Password Verif" id="pwd2" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-success">Sign Up</button>
            </div>
        </form>
    </div>

<?php
include_once "footer.php";
?>
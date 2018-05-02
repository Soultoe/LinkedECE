<?php
include_once "signUpAndLoginBorders.php";
?>

<div>
	<form action="signup.php" method="POST">
		<input type="text" name="firstName" placeholder="First Name">
		<input type="text" name="lastName" placeholder="Last Name">
		<input type="text" name="email" placeholder="Mail">
		<input type="text" name="pseudo" placeholder="Pseudo">
		<input type="password" name="pwd" placeholder="Password">
		<input type="password" name="pwd2" placeholder="Password Verif">
		<button type="submit" name="submit">Sign Up</button>
	</form>
	<form action="logout.php" method="POST">
		<button action="logout.php" method="POST" name="submit">logout</button>
	</form>
</div>

<?php
include_once "footer.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>TEST</title>
</head>
<body>

<header>
	<nav>
		<div class = "main-wrapper">
			<ul>
				<li><a href="index.php">Home</a></li>
			</ul>
			<div>
				<form action="login.php" method="POST">
					<input type="text" name="id" placeholder="Username">
					<input type="password" name="pwd" placeholder="Password">
					<button type="submit" name="submit">Login</button>
				</form>
			</div>
		</div>
	</nav>
</header>
<section>
	<form action="signup.php" method="POST">
		<input type="text" name="firstName" placeholder="First Name">
		<input type="text" name="lastName" placeholder="Last Name">
		<input type="text" name="email" placeholder="Mail">
		<input type="text" name="pseudo" placeholder="Pseudo">
		<input type="password" name="pwd" placeholder="Password">
		<input type="password" name="pwd2" placeholder="Password Verif">
		<button type="submit" name="submit">Sign Up</button>
	</form>
</section>
</body>
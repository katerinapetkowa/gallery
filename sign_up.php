<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>My Gallery</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?php
			include_once 'header.php';
		?>
		<main>
			<form name="myForm" action="includes/signup.php" method="post">
				<div class="container">
					<div class="title">Sign up</div><br>
					<label>First name</label><br>
					<input type="text" id="first_name" name="first_name">
					<label>Last name</label><br>
					<input type="text" id="last_name" name="last_name">
					<label>Username</label><br>
					<input type="text" id="username" name="username">
					<label>Email</label><br>
					<input type="text" id = "email" name="email">
					<label>Password</label><br>
					<input type="password" id="password" name="password">
					<label>Confirm password</label><br>
					<input type="password" id="password2" name="password">
					<button type="submit" name="submit" class="button"> Sign Up </button>
				</div>
			</form>
		</main>
	</body>
</html>

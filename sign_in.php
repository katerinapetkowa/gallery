<?php
$_SESSION['username'] = "Admin";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>My Gallery</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<header>
			<nav>
				<ul>
					<li><a href="gallery.php">Home</a></li>
					<li>
						<form action="search.php" method="post">
							<input type="text" name="search" placeholder="Search..." style="display: inline-block;">
						</form>
					</li>
				</ul>
			</nav>
		</header>
		<main>
			<form name="myForm" action="gallery.php" method="post">
				<div class="container">
					<div class="title">Sign in</div><br>
					<label>Username</label><br>
					<input type="text" id="username" name="username" placeholder="username">
					<p id="response" style="color:red"></p>
					<label>Password</label><br>
					<input type="text" id="pass" name="password" placeholder="***********">
					<button class="button"> Sign in </button><br>
					<label>Not a member?</label>
					<a href="sign_up.php" class="signin">Sign Up</a>
				</div>
			</form>
		</main>
	</body>
</html>

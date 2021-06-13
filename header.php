<?php
	session_start();
?>
<header>
	<nav>
			<ul>
				<li>
					<a href="index.php">Home</a>
				</li>
				<li>
					<?php
						if(isset($_SESSION['user_id'])){
							echo '<a href="profile.php?user_id='.$_SESSION['user_id'].'">My Profile</a>';
						}
					?>
				</li>
				<?php
					if(isset($_SESSION['user_id'])){
						echo '<li><a id="myBtn">Upload Photo</a></li>';
					}
				?>
				<li>
					<a href="hashtag-chart.php">Hashtags</a>
				</li>
				<li>
					<form action="search.php" method="post">
						<input type="text" name="search" placeholder="Search..." required="required">
					</form>
				</li>
			</ul>
		<div class="wrapper">
			<div class="nav-login">
				<?php
					if(isset($_SESSION['user_id'])) {
						echo '<form action="includes/logout.php" method="POST">
							<button type="submit" name="submit">Log out</button>
							</form>';
					} else {
						echo '<form action="includes/login.php" method="POST">
					<input type="text" name="uid" placeholder="Username/E-mail" required="required">
					<input type="password" name="password" placeholder="password" required="required">
					<button type="submit" name="submit">Log in</button>
					</form>
					<ul><li><a href="sign_up.php">Sign up</a></li></ul>';
					}
				?>
			</div>
		</div>
	</nav>
</header>

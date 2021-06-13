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

	<?php
		include_once 'header.php';
	?>
	
	<main>
		<div class="row">
			<div class="column">
				<?php
					include_once 'includes/dbh.php';
					$id = $_GET['id'];
					$sql = "SELECT posts.image_full_name, posts.upload_time, users.username, posts.description, posts.user_id FROM posts JOIN users ON posts.user_id=users.id WHERE posts.id=?;";
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						echo  "SQL statement failed!";
					} else {
						mysqli_stmt_bind_param($stmt, "s", $id);
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);

						while ($row = mysqli_fetch_assoc($result)) {
							echo	'<div class="card">
							<div class="img"style="background-image: url(img/gallery/'.$row["image_full_name"].');"></div>
							<h6>Posted on '.$row["upload_time"].'</h6>
							<h5>By <a href="profile.php?user_id='.$row['user_id'].'">'.$row['username'].'</a></h5>';
							$imageDesc = $row['description'];
							$htag = "#";
							$arr = explode(" ",$imageDesc);
							$i = 0;
							while($i < count($arr)){
								if(substr($arr[$i], 0, 1) === $htag){
									$par = $arr[$i];
									$par = preg_replace("#[^0-9a-z]#i","",$par);
									$arr[$i] = "<a href='search.php?search=$par'>".$arr[$i]."</a>";
								}
								$i++;
							}
							$imageDesc = implode(" ", $arr);

							echo '<p>'.$imageDesc.'</p>
							</div>';
						}
					}
					?>
			</div>
		</div>
	</main>
</body>
</html>

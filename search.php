<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>My Gallery</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="myModal" class="modal">
		<div class="modal-content">
			<span class="close">&times;</span>
			<br>
			<div class="modal-body">
				<label>Select image to upload</label><br><br>
				<form action="includes/upload.php" method="post" enctype="multipart/form-data" >
					<input type="text" name="filedesc" placeholder="Image description...">
					<input type="file" name="file" id="fileToUpload"><br><br>
					<button type="submit" name="submit">Upload</button><br><br>
				</form>
			</div>
		</div>
	</div>
	<?php
		include_once 'header.php';
	?>
	<main>
		<div class="row">
			<div class="column">
				<?php
					include_once 'includes/dbh.php';

					if(isset($_POST['search'])){
						$search = $_POST['search'];
					} else if(isset($_GET['search'])){
						$search = $_GET['search'];
					}

					$sql = "SELECT posts.id, posts.description, posts.image_full_name
					FROM posts JOIN post_hashtag ON posts.id=post_hashtag.post_id
					JOIN hashtags on hashtags.id=post_hashtag.hashtag_id
					WHERE hashtags.hashtag=? ORDER BY posts.upload_time DESC;";
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						echo  "SQL statement failed!";
					} else {
						mysqli_stmt_bind_param($stmt, "s", $search);
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);

						while ($row = mysqli_fetch_assoc($result)) {
							$id = $row["id"];
						echo	'<div class="card">
						<a href="picture.php?id=',$id,'">
						<div class="img" style="background-image: url(img/gallery/'.$row["image_full_name"].');"></div></a>';
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
	<script type="text/javascript">
		var modal = document.getElementById('myModal');
		var btn = document.getElementById("myBtn");
		var span = document.getElementsByClassName("close")[0];
		btn.onclick = function() {
			modal.style.display = "block";
		}
		span.onclick = function() {
			modal.style.display = "none";
		}
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
	</script>
</body>
</html>

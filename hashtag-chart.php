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
					<button class="button" type="submit" name="submit">Upload</button><br><br>
				</form>
			</div>
		</div>
	</div>
	<?php
		include_once 'header.php';
	?>
	<main>

		<div id="chart-container">
			<canvas id="mycanvas"></canvas>
		</div>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/Chart.min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>

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

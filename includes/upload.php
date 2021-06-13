<?php
session_start();
if (isset($_POST['submit'])) {

	$imageDesc = $_POST['filedesc'];

	$file = $_FILES['file'];
	$fileName = $file["name"];
	$fileType = $file["type"];
	$fileTempName = $file["tmp_name"];
	$fileError = $file["error"];
	$fileSize = $file["size"];

	$fileExt = explode(".", $fileName);
		$fileActualExt = strtolower(end($fileExt)); //gets the extension of the image

		$allowed  = array("jpeg", "jpg", "png" ); //allowed file types

		if (in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 200000000) {
					$post_id = 0;
					$hashtag_id = 0;
					//making the new name of the file
					$imageFullName = uniqid("", true) . "." . $fileActualExt; //using true to use big id ensuring that nothing is the same
					$fileDestination = "../img/gallery/" . $imageFullName;

					include_once "dbh.php";

					$sql = "INSERT INTO posts (description, image_full_name, user_id) VALUES(?, ?, ?);";
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						echo "SQL statement failed!";
					} else {
						mysqli_stmt_bind_param($stmt, "sss", $imageDesc, $imageFullName, $_SESSION['user_id']);
						mysqli_stmt_execute($stmt);

						$post_id = mysqli_insert_id($conn);

						move_uploaded_file($fileTempName, $fileDestination);

					}

					$htag = "#";
					$arr = explode(" ",$imageDesc);
					$i = 0;
					while($i < count($arr)){
						if(substr($arr[$i], 0, 1) === $htag){
							$par = $arr[$i];
							$par = preg_replace("#[^0-9a-z]#i","",$par);

							$sql = "SELECT * FROM hashtags WHERE hashtag=?;";
							if (!mysqli_stmt_prepare($stmt, $sql)) {
								echo  "SQL statement failed!";
							} else {
								mysqli_stmt_bind_param($stmt, "s", $par);
								mysqli_stmt_execute($stmt);

								$result = mysqli_stmt_get_result($stmt);
								while ($row = mysqli_fetch_assoc($result)) {
									$hashtag_id = $row["id"];
								}

								if($hashtag_id === 0){
									$sql = "INSERT INTO hashtags (hashtag) VALUES(?);";
									if (!mysqli_stmt_prepare($stmt, $sql)) {
										echo  "SQL statement failed!";
									} else {
										mysqli_stmt_bind_param($stmt, "s", $par);
										mysqli_stmt_execute($stmt);
									}
									$hashtag_id = mysqli_insert_id($conn);
								}

								$sql = "INSERT INTO post_hashtag (post_id, hashtag_id) VALUES(?, ?);";
								if (!mysqli_stmt_prepare($stmt, $sql)) {
									echo  "SQL statement failed!";
								} else {
									mysqli_stmt_bind_param($stmt, "ss", $post_id, $hashtag_id);
									mysqli_stmt_execute($stmt);
								}

							}
						}
						$i++;
						$hashtag_id = 0;
					}
					header("Location: ../index.php?upload=success");


				}else {
					echo "File size is too big!";
					exit();
				}
			}else {
				echo "You had an error!";
				exit();
			}
		}else {
			echo "You need to upload proper file type!";
			exit();
		}


	}
?>

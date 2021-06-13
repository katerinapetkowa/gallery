<?php

session_start();
#checks if the button submit in signup.php file had been selected
if (isset($_POST['submit'])) {
	
	include_once 'dbh.php';

	$first = mysqli_real_escape_string($conn, $_POST['first_name']); 
	$last = mysqli_real_escape_string($conn, $_POST['last_name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$pwd = mysqli_real_escape_string($conn, $_POST['password']);

	#Error handlers
	#Check for empty fields
	if (empty($first) || empty($last) || empty($email) || empty($username) || empty($pwd)) {
		header("Location: ../sign_up.php?signup=empty");
		exit();
	} else {
		#Check if input characters are valid
		if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
			header("Location: ../sign_up.php?signup=invalid");
			exit();
		} else {
			#Check if email is valid
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				header("Location: ../sign_up.php?signup=email");
				exit();	
			} else {
				$sql = "SELECT * FROM users WHERE username='$username'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if ($resultCheck > 0) {
					header("Location: ../sign_up.php?signup=usertaken");
					exit();	
				} else {
					#Hashing the password
					$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
					#Insert the user into the database
					$sql = "INSERT INTO users (first_name, last_name, email, username, password) VALUES (?,?,?,?,?);";

					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						echo "SQL statement failed!";
					} else {
						mysqli_stmt_bind_param($stmt, "sssss", $first, $last, $email, $username, $hashedPwd);
						mysqli_stmt_execute($stmt);

						$user_id = mysqli_insert_id($conn);
						$_SESSION['user_id'] = $user_id;
						$_SESSION['user_first_name'] = $first;
						$_SESSION['user_last_name'] = $last;
						$_SESSION['user_email'] = $email;
						$_SESSION['username'] = $username;
						header("Location: ../index.php?signup=success");
						exit();
					}
				}
			}
		}

	}

} else {
	header("Location: ../sign_up.php");
	exit();
}
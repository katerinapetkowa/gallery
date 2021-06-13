<?php

session_start();

if (isset($_POST['submit'])) {

	include 'dbh.php';

	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['password']);

	#Error handlers
	#Check if inputs are empty
	if (empty($uid) || empty($pwd)) {
		header("Location: ../index.php?login=empty");
		exit();
	} else {
		$sql = "SELECT * FROM users WHERE username='$uid' OR email='$uid'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			header("Location: ../index.php?login=error");
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)) {
				$hashedPwdCheck = password_verify($pwd, $row['password']);
				if ($hashedPwdCheck == false) {
					header("Location: ../index.php?login=error");
					exit();
				} elseif ($hashedPwdCheck == true) {
					$_SESSION['user_id'] =$row['id'];
					$_SESSION['user_first_name'] =$row['first_name'];
					$_SESSION['user_last_name'] =$row['last_name'];
					$_SESSION['user_email'] =$row['email'];
					$_SESSION['username'] =$row['username'];
					header("Location: ../index.php?login=success");
					exit();
				}
			}
		}
	}
} else {
	header("Location: ../index.php?login=error");
	exit();
}

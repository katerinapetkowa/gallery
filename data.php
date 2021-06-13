<?php
	//setting header to json
	header('Content-Type: application/json');

	//database
	include_once 'includes/dbh.php';

	$sql = "SELECT hashtags.hashtag, COUNT(post_hashtag.post_id) AS times_used FROM post_hashtag JOIN hashtags ON hashtags.id = post_hashtag.hashtag_id GROUP BY hashtag_id ORDER BY times_used DESC LIMIT 5;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		echo  "SQL statement failed!";
	} else {
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$data = array();
		foreach ($result as $row) {
			$data[] = $row;
		}
		print json_encode($data);
	}
?>
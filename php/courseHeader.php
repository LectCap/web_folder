<?php
/* Used as a header for the course related pages to check if the user has permission to visit the page
and also to check if user is teacher or not */
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
if(!isset($_SESSION['username'])) {
	header('Location: http://localhost:8080/index.php');
	die();
}
else {
	$course_id = $_GET['course'];
	$user_id = $_GET['user'];
	$result = db_query("SELECT * FROM users WHERE id = '$user_id'");
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if(!$result || ($row['username'] != $_SESSION['username']))
	{
		header('Location: http://localhost:8080/index.php');
		die();
	} else {
		$result = db_query("SELECT * FROM user_course WHERE user_id = '$user_id' AND course_id = '$course_id'");
		if(!$result || (mysqli_num_rows($result) != 1)) {
			header('Location: http://localhost:8080/index.php');
			die();
		}  else {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$teacher = $row['teacher'];
			$result = db_query("SELECT * FROM courses WHERE id = $course_id");
			if(!$result) {
				header('Location: http://localhost:8080/index.php');
				die();
			}
			else {
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$course_name = $row['name'];
				$course_code = $row['code'];
				$course_description = $row['description'];
			}
		}
	}
}
?>
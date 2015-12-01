<?php
/* Gets the current attributes for a course */
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
getCourseinfo();
function getCourseinfo() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$course_id = db_quote($values['course_id']);
	$username = $_SESSION['username'];
	$result = db_query("SELECT * FROM users WHERE username = '$username'");
	if(!$result) {
		$return = array('code' => -2);
		echo json_encode($return);
	}
	else {
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$user_id = $row['id'];
		$result = db_query("SELECT * FROM user_course WHERE user_id = '$user_id' AND course_id = $course_id");
		if(!$result || (mysqli_num_rows($result) != 1)) {
			$return = array('code' => -2);
			echo json_encode($return);
		} else {
			$result = db_query("SELECT * FROM courses WHERE id = $course_id");
			if (!$result) {
				$return = array('code' => -2);
				echo json_encode($return);
			} else {
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$course_code = $row['code'];
				$course_name = $row['name'];
				$course_description = $row['description'];
				$return = array('code' => 1, 'course_code' => $course_code, 'course_name' => $course_name, 'course_description' => $course_description);
				echo json_encode($return);
			}
		}
	}
}
?>
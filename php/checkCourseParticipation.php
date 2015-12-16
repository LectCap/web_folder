<?php
/* Used to check if the user has applied to a course or is already in a course.
 * Used by viewCourses.js */
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
checkCourseParticipation();
function checkCourseParticipation() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$course_id = db_quote($values['course_id']);
	$user_id = $_SESSION['user_id'];
	$result = db_query("SELECT * FROM user_course WHERE (course_id = $course_id AND user_id = '$user_id')");
	$nr = mysqli_num_rows($result);
	if($nr == 0) {
		$return = array('code' => 0);
		echo json_encode($return);
	} else {
		$return = array('code' => 1);
		echo json_encode($return);
	}
}
?>
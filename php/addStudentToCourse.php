<?php
/** Called by viewCourses.js in order to enroll student in course **/
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
addStudentToCourse();
function addStudentToCourse() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$course_id = db_quote($values['course_id']);
	$user_id = db_quote($values['user_id']);
	$teacher_id = $_SESSION['user_id'];
	$result = db_query("SELECT * FROM user_course WHERE user_id = '$teacher_id' AND course_id = $course_id");
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	/* Check if user is teacher for course */
	if($row['teacher'] != 1) {
		$return = array('code' => -3);
		echo json_encode($return);
	} else {
		$result = db_query("INSERT INTO user_course (user_id,course_id,teacher, status) VALUES ($user_id, $course_id, '0', '1')");
		if(!$result) {
			$return = array('code' => -2);
			echo json_encode($return);
		} else {
			$return = array('code' => 1);
			echo json_encode($return);					
		}
	}
}
?>
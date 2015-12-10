<?php
/* Removes user from course. Called from exitCourse.js */
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
exitCourse();
function exitCourse() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$course_id = db_quote($values['course_id']);
	$user_id = $values['user_id'];
	$teacher = db_quote($values['teacher']);
	/* Checks if user has been tampering with JavaScript code, prevents malicious users */
	if($user_id != $_SESSION['user_id']) {
		$return = array('code' => -3);
		echo json_encode($return);
	} else {
		$user_id = db_quote($user_id);
		/* Check if user is the only teacher for a course. This prevents user from exiting course */
		$teacher = str_replace("'", "", $teacher);
		if($teacher == 1) {
			$result = db_query("SELECT * FROM user_course WHERE course_id = $course_id AND teacher = '1'");
			if(!$result) {
				$return = array('code' => -2);
				echo json_encode($return);
			} else if(mysqli_num_rows($result) == 1) {
				$return = array('code' => -1);
				echo json_encode($return);
			} else {
				$result = db_query("DELETE FROM user_course WHERE user_id = $user_id AND course_id = $course_id");
				if(!$result) {
					$return = array('code' => -2);
					echo json_encode($return);
				} else {
					$return = array('code' => 1);
					echo json_encode($return);
				}
			}
		} else {
			$result = db_query("DELETE FROM user_course WHERE user_id = $user_id AND course_id = $course_id");
			if(!$result) {
				$return = array('code' => -2);
				echo json_encode($return);
			} else {
				$return = array('code' => 1, 'teacher' => $teacher);
				echo json_encode($return);
			}
		}
	}
}
?>
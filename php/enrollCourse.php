<?php
/** Called by viewCourses.js in order to enroll student in course **/
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
enrollCourse();
function enrollCourse() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$course_id = db_quote($values['course_id']);
	$user_id = $values['user_id'];
	/* Check if user has been manipulating with JavaScript code */
	if($user_id != $_SESSION['user_id']) {
		$return = array('code' => -3);
		echo json_encode($return);
	} else {
		$user_id = db_quote($_SESSION['user_id']);
		/* Check if user is already enrolled */
		$result = db_query("SELECT * FROM user_course WHERE user_id = $user_id AND course_id = $course_id");
		if(!$result) {
			$return = array('code' => -2);
			echo json_encode($return);	
		} else if(mysqli_num_rows($result) > 0) {
			$return = array('code' => -1);
			echo json_encode($return);
		} else {
			$result = db_query("INSERT INTO user_course (user_id,course_id,teacher, status) VALUES ($user_id, $course_id, '0', '0')");
			if(!$result) {
				$return = array('code' => -2);
				echo json_encode($return);
			} else {
				$return = array('code' => 1);
				echo json_encode($return);					
			}
		}
	}
}
?>
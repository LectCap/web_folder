<?php
/* Edits course information according to user input. Called from editCourse.js */
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
editCourseinfo();
function editCourseinfo() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$user_id = $_SESSION['user_id'];
	/* Checks if user has been tampering with JavaScript code, prevents malicious users */
	if($user_id != $_GET['user']) {
		$return = array('code' => -3);
		echo json_encode($return);
	}
	$course_id = db_quote($_GET['course']);
	$course_code = db_quote($values['course_code']);
	$course_name = db_quote($values['course_name']);
	$course_description = db_quote($values['course_description']);
	/* Check if user is a teacher for the course */
	$result = db_query("SELECT * FROM user_course WHERE user_id = '$user_id' AND course_id = $course_id");
	if(!$result) {
		$return = array('code' => -2);
		echo json_encode($return);
	} else if(mysqli_num_rows($result) != 1) {
		$return = array('code' => -3);
		echo json_encode($return);		
	} else {
		/* Check if course code is taken */
		$result = db_query("SELECT * FROM courses WHERE code = $course_code");
		if(!$result) {
			$return = array('code' => -2);
			echo json_encode($return);
		} else if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$db_course_id = db_quote($row['id']);
			if($db_course_id != $course_id) {
				$return = array('code' => -1);
				echo json_encode($return);
			}
			else {
				/* An update query. $result will be `true` if successful */
				$result = db_query("UPDATE courses SET code = $course_code, name = $course_name, description = $course_description WHERE id = $course_id");
				if($result === false) {
					$return = array('code' => -2);
					echo json_encode($return);
				} else {
					$return = array('code' => 1);
					echo json_encode($return);
				}			
			}
		} else {
			/* An update query. $result will be `true` if successful */
			$result = db_query("UPDATE courses SET code = $course_code, name = $course_name, description = $course_description WHERE id = $course_id");
			if($result === false) {
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
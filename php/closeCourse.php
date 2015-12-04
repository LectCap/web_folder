<?php
/* Edits course information according to user input. Called from editCourse.js */
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
closeCourse();
function closeCourse() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$password = db_quote($values['password']);
	$user_id = $_SESSION['user_id'];
	/* Checks if user has been tampering with JavaScript code, prevents malicious users */
	if($user_id != $_GET['user']) {
		$return = array('code' => -3);
		echo json_encode($return);
	}
	$course_id = db_quote($_GET['course']);
	/* Check if user is a teacher for the course */
	$result = db_query("SELECT * FROM user_course WHERE user_id = '$user_id' AND course_id = $course_id");
	if(!$result) {
		$return = array('code' => -2);
		echo json_encode($return);
	} else if(mysqli_num_rows($result) != 1) {
		$return = array('code' => -3);
		echo json_encode($return);		
	} else {
		/* Check password */
		$result = db_query("SELECT * FROM users WHERE id = $user_id");
		if(!$result) {
			$return = array('code' => -2);
			echo json_encode($return);
		} else if(mysqli_num_rows($result) != 1) {
			$return = array('code' => -3);
			echo json_encode($return);				
		} else {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if(password_verify($password, $row['password'])) {
				/* A delete query. Will delete entries in user_course table as well as courses table */
				$result = db_query("DELETE FROM user_course WHERE course_id = $course_id");
				if(!$result) {
					$return = array('code' => -2);
					echo json_encode($return);
				} else {
					$result = db_query("DELETE FROM courses WHERE id = $course_id");
					if(!$result) {
						$return = array('code' => -2);
						echo json_encode($return);
					} else {
						$return = array('code' => 1);
						echo json_encode($return);
					}
				}
			} else {
				$return = array('code' => -1);
				echo json_encode($return);
			}
		}
	}
}
?>
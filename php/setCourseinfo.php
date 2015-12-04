<?php
/** Called by createCourse.js in order to create a course entry in the database **/
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
setCourseinfo();
function setCourseinfo() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$course_code = db_quote($values['course_code']);
	$course_name = db_quote($values['course_name']);
	$course_description = db_quote($values['course_description']);
	$username = db_quote($_SESSION['username']);
	/* Check if course code is taken */
	$result = db_query("SELECT * FROM courses WHERE code = $course_code");
	if(!$result) {
		$return = array('code' => -2);
		echo json_encode($return);
	} else if(mysqli_num_rows($result) > 0){
			$return = array('code' => -1);
			echo json_encode($return);	
	} else {
		/* Get username id to confirm user is online and prepare for user_course table entry */
		$result = db_query("SELECT * FROM users WHERE username = $username");
		if(!$result) {
			$return = array('code' => -2);
			echo json_encode($return);
		} else if(mysqli_num_rows($result) != 1) {
			$return = array('code' => -5);
			echo json_encode($return);
		} else {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$user_id = $row['id'];
			$result = db_query("INSERT INTO courses (name,description,code) VALUES ($course_name, $course_description, $course_code)");
			if (!$result){
				$return = array('code' => -2);
				echo json_encode($return);
			} else {
				/* Get course id to form user_course table entry */
				$result = db_query("SELECT * FROM courses WHERE code = $course_code");
				if(!$result) {
					$return = array('code' => -2);
					echo json_encode($return);
				} else {
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
					$course_id = $row['id'];
					$result = db_query("INSERT INTO user_course (user_id,course_id,teacher) VALUES ('$user_id', '$course_id', '1')");
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
	}
}
?>
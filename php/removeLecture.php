<?php
/* Removes user from course. Called from exitCourse.js */
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
removeLecture();
function removeLecture() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$course_id = db_quote($values['course_id']);
	$lecture_id = db_quote($values['lecture_id']);
	$user_id = db_quote($values['user_id']);
	$teacher = db_quote($_SESSION['user_id']);
	/* Check if user is teacher for the course */
	$result = db_query("SELECT * FROM user_course WHERE course_id = $course_id AND user_id = $teacher");
	$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
	if(!$result) {
		$return = array('code' => -2);
		echo json_encode($return);
	} else if($row['teacher'] != 1) {
		$return = array('code' => -3);
		echo json_encode($return);
	} else {
			$result = db_query("DELETE FROM videos WHERE id = $lecture_id AND course_id = $course_id");
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
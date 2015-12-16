<?php
/* Will accept a student into a course or reject the student.
 * Called by getWaitingStudents.php */
session_start();
require($_SERVER['DOCUMENT_ROOT']."/php/db.php");
checkStatus();
/* Checks whether teacher accepted or rejected request to join course */
function checkStatus() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$accept = $values['accept'];
	if ($accept == 1) {
		acceptStudent($values);
	} else if ($accept == 0) {
		rejectStudent($values);
	} else {
		$return = array('code' => -5);
		echo json_encode($return);
	}
}
/* If teacher has accepted student's request to enroll, the student is accepted into the course */
function acceptStudent($values) {
	$course_id = db_quote($values['course_id']);
	$user_id =  db_quote($values['user_id']);
	// Check if user and course id exist
	$result = db_query("UPDATE user_course SET status = '1' WHERE (course_id = $course_id AND user_id = $user_id)");
	if(!$result) {
		$return = array('code' => -2);
		echo json_encode($return);
	} else {
		$return = array('code' => 1);
		echo json_encode($return);
	}
}

function rejectStudent($values) {
	$course_id = db_quote($values['course_id']);
	$user_id =  db_quote($values['user_id']);
	// Check if user and course id exist
	$result = db_query("DELETE FROM user_course WHERE (user_id = $user_id AND course_id = $course_id)");
	if(!$result) {
		$return = array('code' => -2);
		echo json_encode($return);
	} else {
		$return = array('code' => 1);
		echo json_encode($return);
	}
}
?>
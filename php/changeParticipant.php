<?php
/* Will change a course participant's status from teacher to student or vice versa.
 * Called by viewParticipants.js */
session_start();
require($_SERVER['DOCUMENT_ROOT']."/php/db.php");
changeParticipant();
/* Checks whether teacher accepted or rejected request to join course */
function changeParticipant() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$teacher = $values['teacher'];
	$user_id = db_quote($values['user_id']);
	$course_id = db_quote($values['course_id']);
	//Requesting teacher's user id
	$teacher_id = db_quote($_SESSION['user_id']);
	/* Check if user is teacher for the course */
	$result = db_query("SELECT * FROM user_course WHERE course_id = $course_id AND user_id = $teacher_id");
	$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
	if(!$result) {
		$return = array('code' => -2);
		echo json_encode($return);
	} else if($row['teacher'] != 1) {
		$return = array('code' => -3);
		echo json_encode($return);
	} else {
		//Check if user wishes to demote him/herself. Deny if true
		if($user_id == $teacher_id) {
			$return = array('code' => -1);
			echo json_encode($return);
		} else if ($teacher == 1){
			$result = db_query("UPDATE user_course SET teacher = '1' WHERE (course_id = $course_id AND user_id = $user_id)");
			if(!$result) {
				$return = array('code' => -2);
				echo json_encode($return);
			} else {
				$return = array('code' => 1);
				echo json_encode($return);				
			}
		} else {
			$result = db_query("UPDATE user_course SET teacher = '0' WHERE (course_id = $course_id AND user_id = $user_id)");
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
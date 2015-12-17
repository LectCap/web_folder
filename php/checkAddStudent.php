<?php
/* Used to check if a user in a DataTables row has applied or is enrolled in the course
 * Used by addStudents.js */
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
checkAddStudent();
function checkAddStudent() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$course_id = db_quote($values['course_id']);
	$user_id = db_quote($values['user_id']);
	$result = db_query("SELECT * FROM user_course WHERE (course_id = $course_id AND user_id = $user_id)");
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
<?php
/* Used to get the amount of students awaiting enrollment confirmation for a specific course.
 * Used by getWaitingNr.js */
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
getWaitingNr();
function getWaitingNr() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$course_id = db_quote($values['course_id']);
	$username = $_SESSION['username'];
	$result = db_query("SELECT * FROM user_course WHERE course_id = $course_id AND status = '0'");
	$nr = mysqli_num_rows($result);
	$return = array('nr' => $nr);
	echo json_encode($return);
}
?>
<?php
/** Belongs to editVideo.js
 ** Edits attributes in VIDEOS table according to user input **/
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
editVideoinfo();
function editVideoinfo() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$lecture_id = db_quote($values['lecture_id']);
	$title = db_quote($values['title']);
	$description = db_quote($values['description']);
	$url = db_quote($values['url_id']);
	$user_id = db_quote($_SESSION['user_id']);
	/* Check if user is teacher for the course */
	//Get course that video (and lecture) belong to
	$result = db_query("SELECT * FROM videos WHERE id = $lecture_id");
	$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
	$course_id = $row['course_id'];
	//Get user and course association
	$result = db_query("SELECT * FROM user_course WHERE course_id = $course_id AND user_id = $user_id");
	$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
	if(!$result) {
		$return = array('code' => -2);
		echo json_encode($return);
	//Check if user is participating in course
	} else if(mysqli_num_rows($result) != 1) {
		$return = array('code' => -1);
		echo json_encode($return);
	//Check if user is teacher for course
	} else if($row['teacher'] != 1) {
		$return = array('code' => -1);
		echo json_encode($return);
	//Provide the information
	} else {
		$result = db_query("UPDATE videos SET title = $title, description = $description, url = $url WHERE id = $lecture_id");
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
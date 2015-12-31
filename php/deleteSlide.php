<?php
/* Removes user from course. Called from exitCourse.js */
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
deleteSlide();
function deleteSlide() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$slide_id = db_quote($values['slide_id']);
	$user_id = db_quote($_SESSION['user_id']);
	/* Check if user is teacher for the course */
	//Get video that lecture belongs to
	$result = db_query("SELECT * FROM slides WHERE slide_id = $slide_id");
	$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
	$video_id = $row['id'];
	//Get course that video (and lecture) belong to
	$result = db_query("SELECT * FROM videos WHERE id = $video_id");
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
	//Delete the slide
	} else {
		$result = db_query("DELETE FROM slides WHERE slide_id = $slide_id");
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
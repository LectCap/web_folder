<?php
/** Called by createVideo.js in order to create a video entry in the database **/
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
setCourseinfo();
function setCourseinfo() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$video_title = db_quote($values['video_title']);
	$video_desc = db_quote($values['video_desc']);
	$url = db_quote($values['url']);
	$username = db_quote($_SESSION['username']);
	/* Get username id to confirm user is online and prepare for user_course table entry */
	$result = db_query("SELECT * FROM users WHERE username = $username");
	if(!$result) {
		$return = array('code' => -2);
		echo json_encode($return);
	} else if(mysqli_num_rows($result) != 1) {
		$return = array('code' => -5);
		echo json_encode($return);
	} else {
		//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		//$user_id = $row['id'];
		$result = db_query("INSERT INTO videos (title,description,course_id,slide_id, url) VALUES ($video_title, $video_desc, 0, 0, $url)");
	}
	
}
?>
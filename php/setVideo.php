 <?php
/** Called by createCourse.js in order to create a course entry in the database **/
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
setCourseinfo();
function setCourseinfo() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$video_title = db_quote($values['video_title']);
	$video_description = db_quote($values['video_description']);
	$url = db_quote($values['url']);
	$user_id = $values['user_id'];
	$course_id = db_quote($values['course_id']);
	/* Checks if user has been tampering with JavaScript code, prevents malicious users */
	if($user_id != $_SESSION['user_id']) {
		$return = array('code' => -3);
		echo json_encode($return);
	} else {
		$user_id = db_quote($_SESSION['user_id']);
		/* Get username id to confirm user is online and prepare for user_course table entry */
		$result = db_query("SELECT * FROM users WHERE id = $user_id");
		if(!$result) {
			$return = array('code' => -2);
			echo json_encode($return);
		} else if(mysqli_num_rows($result) != 1) {
			$return = array('code' => -5);
			echo json_encode($return);
		} else {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$user_id = $row['id'];
			$result = db_query("INSERT INTO videos (title,description,course_id, slide_id, url) VALUES ($video_title, $video_description, $course_id, 2, $url)");
			if (!$result){
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
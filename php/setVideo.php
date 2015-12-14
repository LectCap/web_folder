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
	$username = db_quote($_SESSION['username']);
	echo "CHECK 1";
	/* Get username id to confirm user is online and prepare for user_course table entry */
	$result = db_query("SELECT * FROM users WHERE username = $username");
	if(!$result) {
		$return = array('code' => -2);
		echo "CHECK 2";
		echo json_encode($return);
	} else if(mysqli_num_rows($result) != 1) {
			echo "CHECK 3";
		$return = array('code' => -5);
		echo json_encode($return);
	} else {
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo "CHECK 4";
		echo $video_description;
		$user_id = $row['id'];
		$result = db_query("INSERT INTO videos (title,description,course_id, slide_id, url) VALUES ($video_title, $video_description, 41, 2, $url)");
		echo "VALUES UPLOADED";
		if (!$result){
			$return = array('code' => -2);
			echo json_encode($return);
		} else {
				$return = array('code' => 1);
				echo "VALUES UPLOADED";
				echo json_encode($return);
		}
	}
	
}
?>
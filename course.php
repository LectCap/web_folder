<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
if(!isset($_SESSION['username'])) {
	header('Location: http://localhost:8080/index.php');
	die();
}
else {
	$course_id = $_GET['course'];
	$user_id = $_GET['user'];
	$result = db_query("SELECT * FROM users WHERE id = '$user_id'");
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if(!$result || ($row['username'] != $_SESSION['username']))
	{
		header('Location: http://localhost:8080/index.php');
		die();
	} else {
		$result = db_query("SELECT * FROM user_course WHERE user_id = '$user_id' AND course_id = '$course_id'");
		if(!$result || (mysqli_num_rows($result) != 1)) {
			header('Location: http://localhost:8080/index.php');
			die();
		}  else {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$teacher = $row['teacher'];
			$result = db_query("SELECT * FROM courses WHERE id = $course_id");
			if(!$result) {
				header('Location: http://localhost:8080/index.php');
				die();
			}
			else {
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				$course_name = $row['name'];
			}
		}
	}
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Welcome</title>
    </head>
    <body>
        <h2>Main start page</h2>
		<?php
		echo "<p>Welcome ". $_SESSION['username'] ."</p>";
		echo "<br><p>You are visiting the course $course_name </p>";
		if($teacher == 1) {
			echo "<br><p>You are the teacher for this course </p>";
		}
		else {
			echo "<br><p>You are a student in this course </p>";
		}
		?>
		<form action="start.php" method="POST">
           <input type="submit" name="submit" value="Start page"/>
        </form>
		<form action="php/logout.php" method="POST">
           <input type="submit" name="submit" value="Logout"/>
        </form>
		<form action="editAcc.php" method="POST">
           <input type="submit" name="edit_submit" value="Edit Account"/>
        </form>
		<form action="createCourse.php" method="POST">
           <input type="submit" name="create_course_submit" value="Create a Course"/>
        </form>
    </body>
</html>
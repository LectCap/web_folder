<?php
include($_SERVER['DOCUMENT_ROOT']."/php/courseHeader.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php echo "<title>$course_name</title>" ?>
    </head>
    <body>
        <?php echo "<h2>Welcome to $course_name</h2>";
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
		<?php 
			if($teacher == 1) {
				echo '<form action="editCourse.php?user='.$user_id.'&course='.$course_id.'" method="POST">';
				echo '<input type="submit" name="create_course_submit" value="Edit or close course"/>';
				echo '</form>';
			}
		?>
    </body>
</html>
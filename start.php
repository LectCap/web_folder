<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('Location: http://localhost:8080/index.php');
	die();
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
		?>
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
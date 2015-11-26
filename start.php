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
        <title>My first PHP Website</title>
    </head>
    <body>
        <h2>Main start page</h2>
		<?php
		echo "<p>Welcome ". $_SESSION['username'] ."</p>";
		?>
		<form action="php/logout.php" method="POST">
           <input type="submit" name="submit" value="Logout"/>
        </form>
    </body>
</html>
<?php
include 'db.php';
include 'register.php';
register();
function register() {
	if(isset($_POST['submit'])) {
		$username = db_quote($_POST['username']);
		$password = db_quote($_POST['password']);
		$result = db_query("SELECT username FROM users WHERE username = '$username'");
		if(mysqli_num_rows($result) > 0) {
			header('Location: http://localhost:8080/register.php?name_taken');
		} else {
			$password = password_hash($password, PASSWORD_DEFAULT);
			/* An insertion query. $result will be `true` if successful */
			$result = db_query("INSERT INTO `users` (`username`,`password`) VALUES ($username,'$password')");
			if($result === false) {
				$error = db_error();
				header('Location: http://localhost:8080/register.php?db_error');
			} else {
				echo '<script>alert("Should redirect!");</script>';
				header('Location: http://localhost:8080/index.php?success');
			}
		}
	} else {
		echo '<script>alert("Something went really wrong!");</script>';
		header('Location : http://localhost:8080/register?unknownerr.php');
	}
}
?>
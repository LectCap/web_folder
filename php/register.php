<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
register();
function register() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$username = db_quote($values['username_reg']);
	$password = db_quote($values['password_reg']);
	$password2 = db_quote($values['password_confirm']);
	$firstname = db_quote($values['firstname']);
	$lastname = db_quote($values['lastname']);
	$email = db_quote($values['email']);
	$school = db_quote($values['school']);
	$programme = db_quote($values['programme']);
	/* Password check */
	if($password != $password2) {
		$return = array('code' => -1);
		echo json_encode($return);
	}
	else {
		/* Check if name is taken */
		$result = db_query("SELECT username FROM users WHERE username = $username");
		if(mysqli_num_rows($result) > 0) {
			$return = array('code' => 0);
			echo json_encode($return);
		}
		else {
			/* Check if email is taken */
			$result = db_query("SELECT email FROM users WHERE email = $email");
			if (mysqli_num_rows($result) > 0){
				$return = array('code' => -3);
				echo json_encode($return);
			} else {
				$password = password_hash($password, PASSWORD_DEFAULT);
				/* An insertion query. $result will be `true` if successful */
				$result = db_query("INSERT INTO `users` (`username`,`password`,`firstname`,`lastname`,`school`,`programme`,`email`) VALUES ($username,'$password', $firstname, $lastname, $school, $programme, $email)");
				if($result === false) {
					$return = array('code' => -2);
					echo json_encode($return);
				} else {
					$_SESSION['username'] = $username;
					$return = array('code' => 1);
					echo json_encode($return);
				}
			}
		}
	}
}
?>
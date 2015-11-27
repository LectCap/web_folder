<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
setEmail();
function setEmail() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$username = $_SESSION['username'];
	$email = db_quote($values['email']);
	$password = db_quote($values['password']);
	//$current_email = db_query("SELECT email FROM users WHERE username = $username");
	$result = db_query("SELECT email FROM users WHERE email = $email");
	/* Database failure */
	if(!$result) {
		$return = array('code' => -1);
		echo json_encode($return);
	} else if (mysqli_num_rows($result) > 0){ /* Check if email is already taken by someone else */
			$return = array('code' => 0);
			echo json_encode($return);
	}
	else {
		$result = db_query("SELECT * FROM users WHERE username = '$username'");
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if(!$result) {
			$return = array('code' => -1);
			echo json_encode($return);
		}
		else if(password_verify($password, $row['password'])){
			$result = db_query("UPDATE users SET email = $email WHERE username = '$username'");
			if(!$result) {
				$return = array('code' => -1);
				echo json_encode($return);
			}
			else {
				$return = array('code' => 1);
				echo json_encode($return);
			}
		}
		else {
			$return = array('code' => -2);
			echo json_encode($return);
		}
	}
}
?>
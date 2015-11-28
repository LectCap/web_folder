<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
setPwd();
function setPwd() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$username = $_SESSION['username'];
	$current_password = db_quote($values['current_password']);
	$new_password = db_quote($values['new_password']);
	$password_confirm = db_quote($values['password_confirm']);
	$result = db_query("SELECT * FROM users WHERE username = '$username'");
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	/* Database failure */
	if(!$result) {
		$return = array('code' => -1);
		echo json_encode($return);
	/* Check that the two entered passwords match */
	} else if ($new_password != $password_confirm){
			$return = array('code' => 0);
			echo json_encode($return);
	}
	/* Check that current password is correct */
	else if(password_verify($current_password, $row['password'])){
		$password = password_hash($new_password, PASSWORD_DEFAULT);
		$result = db_query("UPDATE users SET password = '$password' WHERE username = '$username'");
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
?>
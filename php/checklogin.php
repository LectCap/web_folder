<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
//include 'login.php';

checklogin();

function checklogin() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$username = db_quote($values['username']);
	$password = db_quote($values['password']);
	$result = db_query("SELECT * FROM users WHERE username = $username");
	if($result === false) {
		$return = array('code' => -1);
		echo json_encode($return);
	} else {
		if(mysqli_num_rows($result) === 0) {
			$return = array('code' => 0);
			echo json_encode($return);				
		}
		else if(mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if(password_verify($password, $row['password'])) {
				$_SESSION['username'] = $username;
				$return = array('code' => 1);
				echo json_encode($return);
			} else {
				$return = array('code' => 0);
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
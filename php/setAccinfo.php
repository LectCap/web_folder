<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
setAccinfo();
function setAccinfo() {
	header('Content-Type: application/json; charset=UTF-8');
	$json = file_get_contents('php://input');
	$values = json_decode($json, true);
	$username = $_SESSION['username'];
	$firstname = db_quote($values['firstname']);
	$lastname = db_quote($values['lastname']);
	//$email = db_quote($values['email']);
	$school = db_quote($values['school']);
	$programme = db_quote($values['programme']);
	/* An insertion query. $result will be `true` if successful */
	$result = db_query("UPDATE users SET firstname = $firstname, lastname = $lastname, school = $school, programme = $programme WHERE username = '$username'");
	
	if($result === false) {
		$return = array('code' => -1);
		echo json_encode($return);
	} else {
		$return = array('code' => 1);
		echo json_encode($return);
	}
}
?>
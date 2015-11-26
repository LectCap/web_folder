<?php
session_start();
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");
getAccinfo();
function getAccinfo() {
	header('Content-Type: application/json; charset=UTF-8');
	$username = $_SESSION['username'];
	$result = db_query("SELECT * FROM users WHERE username = '$username'");
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$firstname = $row['firstname'];
	$lastname = $row['lastname'];
	$email = $row['email'];
	$school = $row['school'];
	$programme = $row['programme'];
	
	$return = array('firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'school' => $school, 'programme' => $programme);
	echo json_encode($return);
}
?>
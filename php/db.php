<?php
/* File containing database commands */
function db_connect() {

	// Define connection as a static variable, to avoid connecting more than once 
	static $connection;

	// Try and connect to the database, if a connection has not been established yet
	if(!isset($connection)) {
		 // Load configuration as an array. Use the actual location of your configuration file
		$config = parse_ini_file('C:/config.ini'); 
		$connection = mysqli_connect($config['host'],$config['username'],$config['password'],$config['dbname']);
	}

	// If connection was not successful, handle the error
	if($connection === false) {
		echo '<p>Failed to establish connection with database</p>';
		return mysqli_connect_error(); 
	}
	return $connection;
}

function db_query($query)
{
	// Connect to the database
    $connection = db_connect();

    // Query the database
    $result = mysqli_query($connection,$query);
	// If query failed, return `false`
	if($result === false) {
		return false;
	}

    return $result;
}

function db_select($query) {
	$rows = array();
	$result = db_query($query);

	// If query failed, return `false`
	if($result === false) {
		return false;
	}

	// If query was successful, retrieve all the rows into an array
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function db_quote($value) {
	$connection = db_connect();
	return "'" . mysqli_real_escape_string($connection,$value) . "'";
}

function db_error() {
	$connection = db_connect();
	return mysqli_error($connection);
}

function db_begin_transaction () {
	$connection = db_connect();
	if(!$connection) {
		return false;
	} else {
		return mysqli_begin_transaction($connection);
	}
}

function db_rollback() {
	$connection = db_connect();
	if(!$connection) {
		return false;
	} else {
		return mysqli_rollback($connection);
	}
}

function db_commit() {
	$connection = db_connect();
	if(!$connection) {
		return false;
	} else {
		return mysqli_commit($connection);
	}
}
?>
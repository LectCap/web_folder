<?php
session_start();
logout();

function logout() {
	session_destroy();
	header('Location: http://localhost:8080/');
}
?>
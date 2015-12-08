<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('Location: http://localhost:8080/index.php');
	die();
}
?>
<!DOCTYPE HTML>
<html lang=''>
    <head>
        <title>Welcome</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/master.css">
		<script src="/js/login_register.js"></script>
		
		<meta charset='utf-8'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/startmenu.css">
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="/js/startmenu.js"></script>
    </head>
    <body>
		<div class="wrapper">
<<<<<<< HEAD
		<?php include($_SERVER['DOCUMENT_ROOT']."/php/navigator.php"); ?>
=======
			<h1>Online Lecture</h1>
			<h2>Log in <span>or register</span> to take part of online lectures</h2>
			
					<div id='cssmenu'>
						<ul>
						   <li class='active'><a href='php/logout.php'>Logout</a></li>
						   <li><a href='editAcc.php'>Edit Account</a></li>
						   <li><a href='createCourse.php'>Create a Course</a></li>
						   <li><a href='addVideo.php'>Add video</a></li>
						   <li><a href='viewCourses.php'>View courses</a></li>
						</ul>
					</div>	
>>>>>>> e39a105e85b545d1216e8b25731217dd75068afd
					
			<div class="content">
			</div>
		</div>
	</body>
</html>
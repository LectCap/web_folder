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
			<h1>Online Lecture</h1>
			<h2>Log in <span>or register</span> to take part of online lectures</h2>
			
					<div id='cssmenu'>
						<ul>
						   <li class='active'><a href='php/logout.php'>Logout</a></li>
						   <li><a href='editAcc.php'>Edit Account</a></li>
						   <li><a href='createCourse.php'>Create a Course</a></li>
						</ul>
					</div>	
					
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
				
					<form id="startpage" class="start active">
							<p class="startheadline">
								Welcome to<span> Online Lecture</span>!
							</p>
							<p class="startpage">
								Lorem ipsum dolor sit amet, 
								consectetur adipiscing elit, 
								sed do eiusmod tempor incididunt 
								ut labore et dolore magna aliqua. 
								Ut enim ad minim veniam, quis nostrud 
								exercitation ullamco laboris nisi ut 
								aliquip ex ea commodo consequat.
								Duis aute irure dolor in reprehenderit in voluptate 
								velit esse cillum dolore eu fugiat nulla pariatur. 
								Excepteur sint occaecat cupidatat non proident, 
								sunt in culpa qui officia deserunt mollit anim id est laborum
							</p>
						<div class="bottom">
							<p class="contact">Contact information: onlinelecture@team7.net</p>
						</div>
					</form>	
					
					<!--<?php
						echo "<h2>Welcome ". $_SESSION['username'] ."</h2>";
					?>-->
					
				</div>
			</div>
		</div>
	</body>
</html>
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
		<link rel="icon" href="images/favicon.ico">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>OnlineLecture</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="bootstrap/css/style.css" rel="stylesheet">
		<link href="css/master.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="/js/viewCourses.js"></script>
		<script src="/js/login_register.js"></script>
		<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    </head>
<body>

<nav class="navbar navbar-inverse navbar-static-top no-margin" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
		    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand">			<?php
				echo "<h2boot>Logged in as: <span>". $_SESSION['username'] ."</span></h2boot>";
			?>	</a>
		</div>
		
		<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				   <li><a href='createCourse.php'>Create a Course</a></li>
				   <li><a href='editAcc.php'>Edit Account</a></li>
				   <li><a href='myCourses.php'>My Courses</a></li>
				   <li><a href='viewCourses.php'>View all courses</a></li>
				   <li><a href='php/logout.php'>Logout</a></li>
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">Separated link</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">One more separated link</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div id="startdiv" class="startdiv">

	<div class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<img src="bootstrap/images/logo.png" class="img-responsible pull-left" >
				</div>
				<div class="col-lg-6">
					<p>"Lorem ipsum dolor sit amet,
					consectetur adipiscing elit,
					sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
					Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
					Duis aute irure dolor in reprehenderit in voluptate
					velit esse cillum dolore eu fugiat nulla pariatur.
					Excepteur sint occaecat cupidatat non proident,
					sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
				</div>
			</div>
		</div>	
	</div>

	<div>	
		<?php //include($_SERVER['DOCUMENT_ROOT']."/php/navigator.php");
		if(isset($_GET['info'])) {
			if($_GET['info'] == 'courseClosed') {	
					echo "</br><p>The course has been successfully closed</p>";				
			} else if($_GET['info'] == 'exitedCourse')	{
				echo "</br><p>You have successfully left the course</p>";	
			}		
		}
		?>
	</div>

	<div class="container">
		<h2>Browse for <span>courses</span> below</h2>
		<table id="course_list" class="display" cellspacing="0" width="100%" data-userid="<?php echo $_SESSION['user_id']; ?>">
			<thead>
				<tr>
					<th>Course code</th>
					<th>Course name</th>
					<th>Course Description</th>
					<th>Enroll</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Course code</th>
					<th>Course name</th>
					<th>Course Description</th>
					<th>Enroll</th>
				</tr>
			</tfoot>
		</table>
		<div id="viewCourses_error"></div>
	</div>
	
	<div class="pagedivider"></div>
	
</div>

		

<footer class="site-footer no-margin">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<h4>Contact Address</h4>
				<address>
					#999, Street <br>
					City <br>
					Country <br>
				</address>
			</div>
		</div>
		<div class="bottom-footer">
			<div class="col-md-5">© Copyright OnlineLecture 2015</div>
			<div class="col-md-7">
				<ul class="footer-nav">
				   <li><a href='createCourse.php'>Create a Course</a></li>
				   <li><a href='editAcc.php'>Edit Account</a></li>
				   <li><a href='myCourses.php'>My Courses</a></li>
				   <li><a href='viewCourses.php'>View all courses</a></li>
				   <li><a href='php/logout.php'>Logout</a></li>
				</ul>
			</div>
		</div>
	</div>
</footer>

</body>
</html>
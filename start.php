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
		<?php include($_SERVER['DOCUMENT_ROOT']."/php/headerIncluder.php"); ?>
		<script src="/js/viewCourses.js"></script>
		<script src="/js/login_register.js"></script>
		<script src="js/editAcc.js"></script>
		<script src="/js/createCourse.js"></script>
		<script src="/js/myCourses.js"></script>
    </head>
<body>

<?php include($_SERVER['DOCUMENT_ROOT']."/php/headermenu.php"); ?>
<script>
	$( "#start" ).addClass( "active" );
</script>

<div id="startdiv" class="startdiv">

	<div class="page-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-4">
					<img src="bootstrap/images/logo.png" class="img-responsible pull-left" >
				</div>
				<div class="col-lg-6" style="font-family:'Trebuchet MS', 'Myriad Pro', sans-serif font-size: 14px;font-weight: bold">
					<p>Welcome to Online Lecture! This is a free website where anyone can host courses as a teacher
					and participate in courses as a student. On the start page you can browse for interesting courses you wish
					to enroll to, and also see the courses you are participating in.
					You are also able to create a new course which you will become the teacher in. If you so wish you are able  to edit
					your account information, email or password.</p>
				</div>
			</div>
		</div>	
	</div>

	<div class="container-fluid">
		<?php
		if(isset($_GET['info'])) {
			if($_GET['info'] == 'courseClosed') {	
					echo "</br><p>The course has been successfully closed!</p>";				
			} else if($_GET['info'] == 'exitedCourse')	{
				echo "</br><p>You have successfully left the course!</p>";	
			}		
		}
		?>
	<h2 class="tableHeader">View all <span>courses</span> you have enrolled in below</h2>
	<table id="myCourses_list" class="display" cellspacing="0" width="100%" data-userid="<?php echo $_SESSION['user_id']; ?>">
		<thead>
			<tr>
				<th>Course code</th>
				<th>Course name</th>
				<th>Course Description</th>
				<th>Role</th>
				<th>Link</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Course code</th>
				<th>Course name</th>
				<th>Course Description</th>
				<th>Role</th>
				<th>Link</th>
			</tr>
		</tfoot>
	</table>
	<div id="myCourses_error"></div>
	</div>
	
	<div class="pagedivider"></div>
	
	<div class="container-fluid">	
		<h2 class="tableHeader">Browse for new <span>courses</span> and enroll below</h2>
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
	<?php include($_SERVER['DOCUMENT_ROOT']."/php/footermenu.php"); ?>
</footer>

</body>
</html>
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
		<link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="/js/viewCourses.js"></script>
		<script src="/js/login_register.js"></script>
		<script src="js/editAcc.js"></script>
		<script src="/js/createCourse.js"></script>
		<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
    </head>
<body>

<?php include($_SERVER['DOCUMENT_ROOT']."/php/headermenu.php"); ?>
<script>
	$( "#start" ).addClass( "active" );
</script>

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
		<h2>Browse for new <span>courses</span> and enroll below</h2>
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
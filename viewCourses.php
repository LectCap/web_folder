<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('Location: http://localhost:8080/index.php');
	die();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>View courses</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
		<script src="/js/viewCourses.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/master.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
    </head>
    <body>
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
		<div id="viewCourses_error">
		</div>
    </body>
</html>
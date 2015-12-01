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
        <title>Create a Course</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="/js/createCourse.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/master.css">
    </head>
    <body>
		<div class="wrapper">
			<h1>Online Lecture</h1>
			<h2>Log in <span>or register</span> to take part of online lectures</h2>
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">					
					<form id="createCourse-form" class="edit active">
						<h3>Create a Course <i class="fa fa-book"></i></h3>
						<div>
							<label>Course code<em class="reqfield"> *</em></label>
							<input type="text" name="course_code" required="required" maxlength="45"/>
							<span class="error">This is an error</span>
						</div>
						<div>
							<label>Course name<em class="reqfield"> *</em></label>
							<input type="text" name="course_name" required="required" maxlength="45"/>
							<span class="error">This is an error</span>
						</div>
						<div>
							<label>Course description</label>
							<textarea rows="5" cols="40" name="course_description" placeholder="Write a short course description" maxlength="250"></textarea>
						</div>
						<div class="bottom">
							<div id="createCourse_error"></div>
							<input type="submit" name="createCourse" value="Create course" />
							<div class="clear"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
    </body>
</html>
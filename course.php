<?php
include($_SERVER['DOCUMENT_ROOT']."/php/courseHeader.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="/js/createVideo.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/master.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/startmenu.css">
		<script src="/js/startmenu.js"></script>
		<script src="/js/exitCourse.js"></script>
        <?php echo "<title>$course_name</title>" ?>
    </head>
    <body>
		<div class="wrapper">
		<?php include($_SERVER['DOCUMENT_ROOT']."/php/navigator.php"); ?>
		<?php echo "<h2>Welcome to $course_name</h2>";
		echo "<p>Welcome ". $_SESSION['username'] ."</p>";
		echo "<br><p>You are visiting the course $course_name </p>";
		if($teacher == 1) {
			echo "<br><p>You are the teacher for this course </p>";
		}
		else {
			echo "<br><p>You are a student in this course </p>";
		}
		?>
		</br>
		<form id="exitCourse_form" data-user="<?php echo $_SESSION['user_id'] ?>" data-course="<?php echo $_GET['course'] ?>" data-teacher="<?php echo $teacher ?>">
			<input type="submit" value="Exit course">
		</form>
		<div id="exitCourse_error">
		</div>
		<?php if($teacher == 1): ?>
			<div class="content">
			<form action="editCourse.php?user=<?php echo $user_id; ?>&course=<?php echo $course_id; ?>" method="POST">
			<input type="submit" name="create_course_submit" value="Edit or close course"/>
			</form>
			</div>
			
			<div id="form_wrapper" class="form_wrapper">
				<form id="createVideo-form" class="vid active">
				<h3>Upload Lecture <i class="fa fa-eject"></i></h3>
					<div>
						<label>Title</label> 
						<input type="text" name="video_title" required="required" />
					</div>
					<div>
						<label>Description</label> 
						<input type="text" name="video_description" required="required" />
					</div>
					<div>
						<label>YouTube-Link</label> 
						<input type="text" name="url" required="required" />
					</div>
					<div class="bottom">
						<input type="submit" name="setVideo" value="Add video"/>
						<div class="clear"></div>
					</div>
				</form>
			</div>
		<?php endif; ?>
		</div>
    </body>
</html>
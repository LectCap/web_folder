<?php
include($_SERVER['DOCUMENT_ROOT']."/php/courseHeader.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php echo "<title>Edit course $course_name </title>"; ?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="/js/editCourse.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/master.css">
    </head>
    <body>
		<div class="wrapper">
			<h1>Online Lecture</h1>
			<h2>Log in <span>or register</span> to take part of online lectures</h2>
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">					
					<form id="editCourse-form" class="edit active" data-id="<?php echo $course_id; ?>">
						<?php echo '<h3>Edit course '.$course_code.' <i class="fa fa-book"></i></h3>'; ?>
						<div>
							<label>Course code<em class="reqfield"> *</em></label>
							<input type="text" name="edit_course_code" required="required" maxlength="45"/>
							<span class="error">This is an error</span>
						</div>
						<div>
							<label>Course name<em class="reqfield"> *</em></label>
							<input type="text" name="edit_course_name" required="required" maxlength="45"/>
							<span class="error">This is an error</span>
						</div>
						<div>
							<label>Course description</label>
							<textarea rows="5" cols="40" name="edit_course_description" placeholder="Write a short course description" maxlength="250"></textarea>
						</div>
						<div class="bottom">
							<div id="editCourse_error"></div>
							<input type="submit" name="editCourse" value="Apply changes" />
							<div class="clear"></div>
						</div>
					</form>
				</div>
			</div>
		</div>
    </body>
</html>
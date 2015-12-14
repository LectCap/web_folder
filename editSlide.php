<?php
//include($_SERVER['DOCUMENT_ROOT']."/php/courseHeader.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php echo "<title>Add slide</title>"; ?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="/js/editCourse.js"></script>
		<script src="/js/closeCourse.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/master.css">
    </head>
    <body>
		<div class="wrapper">

			<div class="content">
				<div id="form_wrapper" class="form_wrapper">					
					<form id="editCourse-form" class="edit active" >
						<h3>Add new slide [page x]</h3>
						<div>
							<label>Path(upload soon)<em class="reqfield"> *</em></label>
							<input type="text" name="edit_course_name" required="required" maxlength="45"/>
							<span class="error">This is an error</span>
						</div>
						<div>
							<label>Seconds</label>
							<input type="text" name="edit_course_name" required="required" maxlength="45"/>
						</div>
						<div class="bottom">
							<div id="editCourse_error" style="color: #ffa800"></div>
							<input type="submit" name="editCourse" value="Add slide" />
							<div class="clear"></div>
						</div>
					</form>
				</div>
				
			</div>
		</div>
    </body>
</html>
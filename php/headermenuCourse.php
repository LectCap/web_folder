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
				if($teacher == 1) {
					echo "<h2boot>Teacher: <span>". $_SESSION['username'] ."</span></h2boot>";
				}
				else {
					echo "<h2boot>Student: <span>". $_SESSION['username'] ."</span></h2boot>";
				}
			?>	</a>
		</div>
		
		<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href='start.php'>Start</a></li>
			    <li><a href="#form_wrapper_video" class="addVideoButton">Add Video</a></li>
				<li><a href='start.php'>Start</a></li>
			    <li><a href='php/logout.php'>Logout</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Edit Course <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#form_wrapper_editC" class="editCourseButton">Edit Course info</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#form_wrapper_closeC" class="closeCourseButton">Close Course</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div id="form_wrapper_video" class="form_wrapper lightboxWrap" style="display:none">

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

<div id="form_wrapper_editC" class="form_wrapper lightboxWrap" style="display:none">					
	<form id="editCourse-form" class="edit active" data-courseid="<?php echo $course_id; ?>" data-userid="<?php echo $_SESSION['user_id']; ?>">
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
			<div id="editCourse_error" style="color: #ffa800"></div>
			<input type="submit" name="editCourse" value="Apply changes" />
			<div class="clear"></div>
		</div>
	</form>
</div>

<div id="form_wrapper_closeC" class="form_wrapper lightboxWrap" style="display:none">					
	<form id="closeCourse-form" class="edit active" data-courseid="<?php echo $course_id; ?>" data-userid="<?php echo $_SESSION['user_id']; ?>">
		<?php echo '<h3>Close course '.$course_code.' <i class="fa fa-trash"></i></h3>'; ?>
		<div id="close_course_confirm" style="display: none">
			<label>Confirm with password<em class="reqfield"> *</em></label>
			<input type="password" name="close_course_password" maxlength="45"/>
			<span class="error">This is an error</span>
		</div>
		<div class="bottom">
			<div id="closeCourse_error" style="color: #ffa800"></div>
			<input type="submit" name="closeCourse" value="Close course" />
			<div class="clear"></div>
		</div>
	</form>
</div>

<?php if($teacher == 1): ?>
<script type="text/javascript">
    $(".addVideoButton").fancybox({
		"scrolling":"no",
		"arrows":false,
		"padding":[0,15,15,15]
	});
</script>

<script type="text/javascript">
    $(".editCourseButton").fancybox({
		"scrolling":"no",
		"arrows":false,
		"padding":[0,15,15,15]
	});
</script>

<script type="text/javascript">
    $(".closeCourseButton").fancybox({
		"scrolling":"no",
		"arrows":false,
		"padding":[0,15,15,15]
	});
</script>
<?php endif; ?>
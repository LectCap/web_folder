<?php
include($_SERVER['DOCUMENT_ROOT']."/php/courseHeader.php");
$lectnr = 1;
?>
<!DOCTYPE HTML>
<html>
    <head>
		<?php include($_SERVER['DOCUMENT_ROOT']."/php/headerIncluder.php"); ?>
		<?php if($teacher == 1): ?>
		<script src="/js/getWaitingNr.js"></script>
		<?php endif; ?>
		<script src="/js/exitCourse.js"></script>
		<script src="/js/viewParticipants.js"></script>
		<script src="/js/createVideo.js"></script>
		<script src="/js/editCourse.js"></script>
		<script src="/js/closeCourse.js"></script>
		<script src="/js/getLecturesList.js"></script>	
        <?php echo "<title>$course_name</title>" ?>
    </head>
    <body>
	<?php include($_SERVER['DOCUMENT_ROOT']."/php/headermenuCourse.php"); ?>
	<script>
		$( "#editLecture" ).addClass( "hidden" );
	</script>
	<script>
		$( "#editSlide" ).addClass( "hidden" );
	</script>
	<script>
		$( "#course" ).addClass( "active" );
	</script>
	
		<div id="coursediv" class="startdiv">
		
		<div class="page-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<img src="bootstrap/images/logo.png" class="img-responsible pull-left" >
					</div>
					<div class="col-lg-6" style="font-family:'Trebuchet MS', 'Myriad Pro', sans-serif font-size: 14px;font-weight: bold">
						<p>This is the course page where you are participating as teacher or student.
						Here you can find a list of lectures for this course, as well as a list of other participants
						in this course. As a teacher you are able to assign teacher status to other students and
						remove participants. A teacher can add new lectures by uploading a video and also edit course
						information or close down the course.</p>
					</div>
				</div>
			</div>	
		</div>
		<div class="container">
			<div id="form_wrapper_exit_slide">
		<?php //echo "<h1>Course $course_name</p>";?>
				<form id="exitCourse_form" data-user="<?php echo $_SESSION['user_id'] ?>" data-course="<?php echo $_GET['course'] ?>" data-teacher="<?php echo $teacher ?>">
					<h1 style="text-align: left;"><?php echo "Course $course_name ";?><input type="submit" class="exitCourseBtn" value="Exit course" style=""></h1>
				</form>
				<div id="exitCourse_error"></div>
			</div>
		<?php $result = db_query("SELECT * FROM videos WHERE course_id = $course_id");
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo "<b>Lecture " . $lectnr." - </b><a href='./lecture.php?user=".$user_id."&course=".$course_id."&lecture_id=".$row['id']."'>".$row['title']."</a><br>";
			$lectnr++;
		}
		$lectnr = 0;
		?>
		<table id="lectures_list" class="display" cellspacing="0" width="100%" data-courseid="<?php echo $_GET['course']; ?>" data-userid="<?php echo $_SESSION['user_id'] ?>">
					<thead>
						<tr>
							<th>Lecture</th>
							<th>Description</th>
							<th>Link</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Lecture</th>
							<th>Description</th>
							<th>Link</th>
						</tr>
					</tfoot>
				</table>
		</div>
		
		</br>

		<div class="container">
			<h2>View all <span>courses</span> you have enrolled to below</h2>
			<table id="viewParticipants_list" class="display" cellspacing="0" width="100%" data-course="<?php echo $_GET['course']; ?>">
				<thead>
					<tr>
						<th></th>
						<th>Username</th>
						<th>Role</th>
						<?php if($teacher == 1): ?>
						<th>Change Role</th>
						<th>Remove from course</th>
						<?php endif; ?>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th></th>
						<th>Username</th>
						<th>Role</th>
						<?php if($teacher == 1): ?>
						<th>Change Role</th>
						<th>Remove from course</th>
						<?php endif; ?>
					</tr>
				</tfoot>
			</table>
			<div id="viewParticipants_error"></div>
		</div>
		
		<div class="pagedivider"></div>		

		</div>
		
	<footer class="site-footer no-margin">
		<?php include($_SERVER['DOCUMENT_ROOT']."/php/footermenu.php"); ?>
	</footer>
		
    </body>
</html>
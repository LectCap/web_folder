<?php
include($_SERVER['DOCUMENT_ROOT']."/php/courseHeader.php");
$lectnr = 1;
?>
<!DOCTYPE HTML>
<html>
    <head>
		<link rel="icon" href="images/favicon.ico">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="utf-8">		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/master.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php if($teacher == 1): ?>
		<script src="/js/getWaitingNr.js"></script>
		<?php endif; ?>
		<script src="/js/exitCourse.js"></script>
		<script src="/js/createVideo.js"></script>
		<script src="/js/editCourse.js"></script>
		<script src="/js/closeCourse.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="bootstrap/css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
		<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>		
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
		<div class="container">
		<?php echo "<h1>Course $course_name</h1>";

		$result = db_query("SELECT * FROM videos WHERE course_id = $course_id");
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo "<b>Lecture " . $lectnr." - </b><a href='./lecture.php?user=".$user_id."&course=".$course_id."&lecture_id=".$row['id']."'>".$row['title']."</a><br>";
			$lectnr++;
		}
		$lectnr = 0;
		?>
		</div>
		
		</br>
		<form id="exitCourse_form" data-user="<?php echo $_SESSION['user_id'] ?>" data-course="<?php echo $_GET['course'] ?>" data-teacher="<?php echo $teacher ?>">
			<input type="submit" value="Exit course">
		</form>
		<div id="exitCourse_error">
		</div>

		</div>
		
	<footer class="site-footer no-margin">
		<?php include($_SERVER['DOCUMENT_ROOT']."/php/footermenu.php"); ?>
	</footer>
		
    </body>
</html>
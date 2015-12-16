<?php
include($_SERVER['DOCUMENT_ROOT']."/php/courseHeader.php");
$course_id = db_quote($_GET['course']);
$lecture_id = db_quote($_GET['lecture_id']);
$result = db_query("SELECT * FROM videos WHERE course_id = $course_id AND id = $lecture_id");
$lect = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
<!DOCTYPE HTML>
<html>
    <head>
		<link rel="icon" href="images/favicon.ico">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="utf-8">		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="/js/createVideo.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/master.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="/js/exitCourse.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="bootstrap/css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
		<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>	

<script language="JavaScript">

var slideimages = new Array()
var slidespeed = new Array()

var step = 0
function startSlide()
{
  setTimeout(switchPic, slidespeed[step]) //wait for next slide
}
function switchPic()
{
	document.getElementById('slide').src = slideimages[step].src
	step++;
	if(step<4){
		startSlide()
	}
   //finish doing things after the pause
}
function slideshowimages(){ //adding image to cache
for (i=0;i<slideshowimages.arguments.length;i++){
	if(slideshowimages.arguments[i] != ""){
	slideimages[i]=new Image()
	slideimages[i].src=slideshowimages.arguments[i]
	}
	}
}
</script>

        <?php echo "<title>".$lect['title']."</title>" ?>
    </head>
    <body>
		<?php include($_SERVER['DOCUMENT_ROOT']."/php/headermenuCourse.php");?>
		<script>
			$( "#dropdownCourse" ).addClass( "hidden" );
		</script>
		<script>
			$( "#addLecture" ).addClass( "hidden" );
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
		
		<?php
		echo "<h1>".$lect['title']."</h1>";
		
		echo "Welcome ". $_SESSION['username'];
		if($teacher == 1) {
			echo "<br><p>You are the teacher for this course </p>";
		}
		else {
			echo "<br><p>You are a student in this course </p>";
		}
		?>
		<iframe title="YouTube video player" class="youtube-player" type="text/html" 
		width="640" height="390" src="<?php echo $lect['url']; ?>"
		frameborder="0" allowFullScreen></iframe>
		</br>
		
		<img src="images/default.png" id="slide" width="640" height="390" />
		
		
		<script type="text/javascript">
		
		<?php 
			$result = db_query("SELECT * FROM slides WHERE id = ".$lect['slide_id']."");
			echo "slideshowimages(";
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				echo '"'.$row['path'].'",';
			} 
		?>"")
		var slidespeed = [0, 4000, 8000, 5000];
		startSlide();
		</script>
		
		<?php if($teacher == 1): ?>
			<div class="content">
			<form action="" method="POST">
			<input type="submit" name="edit_lecture" value="Edit lecture"/>
			</form>
			<form action="editslide.php" method="POST">
			<input type="submit" name="editslides" value="Edit slides"/>
			</form>
			
			</div>
		
			</div>
		<?php endif; ?>
		
		</div>
		
	<footer class="site-footer no-margin">
		<?php include($_SERVER['DOCUMENT_ROOT']."/php/footermenu.php"); ?>
	</footer>
	
    </body>
</html>
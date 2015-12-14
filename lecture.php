<?php
include($_SERVER['DOCUMENT_ROOT']."/php/courseHeader.php");
$course_id = $_GET['course'];
$result = db_query("SELECT * FROM videos WHERE course_id = $course_id");
$lect = mysqli_fetch_array($result, MYSQLI_ASSOC);


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
		<div class="wrapper" align="center">
		<?php include($_SERVER['DOCUMENT_ROOT']."/php/navigator.php");
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
		var slidespeed = [4000, 8000, 5000];
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
    </body>
</html>
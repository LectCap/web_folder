<?php
include($_SERVER['DOCUMENT_ROOT']."/php/courseHeader.php");
$course_id = db_quote($_GET['course']);
$lecture_id = db_quote($_GET['lecture_id']);
$user= db_quote($_GET['user']);
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
var player;

function start(time)
{
	if(step<4){
	switchPic(time)
	start();
	}
}
function switchPic(time)
{	
	if(slidetime[step] < time && time < slidetime[step+1]){
	document.getElementById('slide').src = slideimages[step].src
	step++;
	}
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
		
		<div id="lecturediv" class="lecturediv">
		
		<div class="page-header">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<img src="bootstrap/images/logo.png" class="img-responsible pull-left" >
					</div>
					<div class="col-lg-6">
						<p></p>
					</div>
				</div>
			</div>	
		</div>
		
		<?php echo "<h>".$lect['title']."</h><br>".$lect['description']."<br>"; ?>
		
		
		<?php
		$times = array();
		$result = db_query("SELECT time FROM slides WHERE id=".$lect['id']." ORDER by time");
		/* numeric array */
		while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			array_push($times, $row[0]);
		}?>
	    <div id="player" align="left">
		</div>
		<img src="images/bgslide.png" id="slide" align="right" width="558" height="390" />

		<script type="text/javascript">
				//loads the pictures
		<?php 
			$result = db_query("SELECT * FROM slides WHERE id = ".$lect['id']."");
			echo "slideshowimages(";
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo '"'.$row['path'].'",';
			} 
			echo '"");';
		?>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '390',
          width: '640',
          videoId: '<?php echo $lect['url']; ?>',
          events: {
			'onReady': onPlayerReady,
          }
        });
      }
		var videotime = 0;
		var timeupdater = null;

		// when the player is ready, start checking the current time every 100 ms.
		function onPlayerReady() {
		  function updateTime() {
			var oldTime = videotime;
			if(player && player.getCurrentTime) {
			  videotime = player.getCurrentTime();
			}
			if(videotime !== oldTime) {
			  onProgress(videotime);
			}
		  }
		  timeupdater = setInterval(updateTime, 3000);
		}
		
		
		function onProgress(currentTime) {
		<?php 
		if(sizeof($times)>0){
		$ind = 0;
		for($i = 0; $i<sizeof($times)-1; $i++){
			echo "if(currentTime > ".$times[$i]." && currentTime < ".$times[$i+1]."){ document.getElementById('slide').src = slideimages[".$i."].src }";
			$ind++;
		}
		echo "if(currentTime > ".$times[$ind]."){ document.getElementById('slide').src = slideimages[".$ind."].src }";
		$ind = 0;
		}

		?>
		}
		</script>
		
		<?php if($teacher == 1): ?>
			<div class="content">
			<form action="" method="POST">
			<input type="submit" name="edit_lecture" value="Edit lecture"/>
			</form>
			<form action="editslide.php" method="GET">
			<input type="submit" name="edit_slide" value="Edit slides"/>
			<input type="hidden" name="user" value="<?php echo $user;?>"/>
			<input type="hidden" name="lecture_id" value="<?php echo $lecture_id; ?>"/>

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
<?php
include($_SERVER['DOCUMENT_ROOT']."/php/courseHeader.php");
$course_id = db_quote($_GET['course']);
$lecture_id = db_quote($_GET['lecture_id']);
$user= db_quote($_GET['user']);
$result = db_query("SELECT * FROM videos WHERE course_id = $course_id AND id = $lecture_id");
$lect = mysqli_fetch_array($result, MYSQLI_ASSOC);
$_SESSION['lect_name'] = $lect['title'];
?>
<!DOCTYPE HTML>
<html>
<head>

		<link rel="icon" href="images/favicon.ico">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>OnlineLecture</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="bootstrap/css/style.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
		
		
		
		<link rel="stylesheet" type="text/css" href="css/jquery-comments.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
		
       <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="css/jquery-comments.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

        <!-- Data -->
        <script type="text/javascript" src="data/comments-data.js"></script>

        <!-- Libraries -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery-comments.js"></script>
		

		<script type="text/javascript">
            $(function() {
                $('#comments-container').comments({
                    profilePictureURL: 'https://app.viima.com/static/media/user_profiles/user-icon.png',
                    roundProfilePictures: true,
                    textareaRows: 1,
                    getComments: function(success, error) {
                        setTimeout(function() {
                            success(commentsArray);
                        }, 500);
                    },
                    putComment: function(data, success, error) {
                      setTimeout(function() {
                        success(data);
                      }, 200)
                    },
                    deleteComment: function(data, success, error) {
                      setTimeout(function() {
                        success();
                      }, 200)
                    },
                    upvoteComment: function(data, success, error) {
                      setTimeout(function() {
                        success(data);
                      }, 200)
                    }
                });
            });
        </script>
		
<script src="/js/createVideo.js"></script>
<script src="/js/exitCourse.js"></script>
<?php if($teacher == 1): ?>
<script src="/js/getWaitingNr.js"></script>
<?php endif; ?>

<script language="JavaScript">
function editVideo(){
	if(document.getElementById("url")){
		$('#url').remove();
		$('#ed_url_but').remove();
	}
	else{
	document.getElementById("url_field").innerHTML='<input type="text" value="<?php echo $lect['url'];?>" id="url" /><br><button class="exitCourseBtn" id="ed_url_but" onClick="changeURL()">Edit</button>';
	}
}
function changeURL(){
	location.href='./php/editVideo.php?url=' + document.getElementById("url").value + "&lecture_id=<?php echo $_GET['lecture_id'];?>";
}
function editSlide(){
	location.href='./editSlide.php?user=<?php echo $_GET['user']; ?>&lecture_id=<?php echo $_GET['lecture_id']; ?>'
}
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
		<script>
			$( "#addStudents" ).addClass( "hidden" );
		</script>
		
		<div id="lecturediv" class="startdiv">
		
		<div class="page-header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-4">
						<img src="bootstrap/images/logo.png" class="img-responsible pull-left" >
					</div>
					<div class="col-lg-6" style="font-family:'Trebuchet MS', 'Myriad Pro', sans-serif font-size: 14px;font-weight: bold">
						<p>On the lecture page you watch the lecture that has been uploaded
						by the course teacher. Teachers are also able to upload slides to accompany
						their lecture video, these slides will automatically switch pages at
						appropriate timers during the duration of the lecture video. 
						A teacher can edit both the video content and the slides.</p>
					</div>
				</div>
			</div>	
		</div>
		
		<?php echo "<h1 style='margin-left: 10px'>".$lect['title']."</h1><p style='margin-left: 10px'>".$lect['description']."<p>"; ?>
		
		
		<?php
		$times = array();
		$result = db_query("SELECT time FROM slides WHERE id=".$lect['id']." ORDER by time");
		/* numeric array */
		while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
			array_push($times, $row[0]);
		}?>
		<div class="container-fluid" style="max-width: none">
			<div id="lectureContainer" class="row-fluid">
				<div style="min-width: 640px" class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
					<div id="player"  class="lecture_content" ></div>
				</div>
				<div style="min-width: 640px" class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
					<img src="images/default.png" id="slide" class="lecture_content" width="640" height="390"/>
					<!--Clear div necessary to prevent overlapping divs. DO NOT REMOVE -->
					<div class="clear"></div>
				</div>
			</div>
		</div>

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
      var player;
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
		}else{
			echo "document.getElementById('slide').src ='images/noslide.png'";
		}

		?>
		}
		</script>
		<?php if($teacher == 1): ?>
			<div class="content">
			
			<button onClick = "editVideo()" class='tableButton'>Edit Video</button>
			<button onClick = "editSlide()" class='tableButton'>Edit slides</button>
			<p id="url_field"></p>
			</div>
		<?php endif; ?>
		
				<div id="comments-container"></div>

		</div>
			<div class="pagedivider" style="margin-top: 30px; margin-bottom: 30px"></div>
	<footer class="site-footer no-margin">
		<?php include($_SERVER['DOCUMENT_ROOT']."/php/footermenu.php"); ?>
	</footer>
	
    </body>
</html>
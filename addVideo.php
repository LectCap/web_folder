<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('Location: http://localhost:8080/index.php');
	die();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Video upload</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="/js/createVideo.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/master.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/startmenu.css">
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="/js/startmenu.js"></script>
    </head>
    <body>
	<div class="wrapper">
			<?php include($_SERVER['DOCUMENT_ROOT']."/php/navigator.php"); ?>
					
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
				</div
		</div>
		
	

		
    </body>
</html>
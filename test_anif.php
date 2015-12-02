<?php
session_start();
if(isset($_SESSION['username'])) {
	header('Location: http://localhost:8080/start.php');
	die();
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>My first PHP Website</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/master.css">
    </head>
    <body>
		<div class="wrapper">
			<h1>Online Lecture</h1>
			<h2>Upload a new <span>video</span> lecture!</h2>
			<div class="content">
				<div id="form_wrapper" class="form_wrapper">
				
					<form id="addVid-form" class="vid active">
					<h3>Upload Lecture <i class="fa fa-eject"></i></h3>
						<div>
							<label>Title</label> 
							<input type="text" name="title" required="required" />
						</div>
						<div>
							<label>Description</label> 
							<input type="text" name="desc" required="required" />
						</div>
						<div>
							<label>YouTube-Link</label> 
							<input type="text" name="y_link" required="required" />
						</div>
						<div class="bottom">
							<div id="upload_error"></div>
							<input type="submit" name="upload" value="Upload"/>
							<div class="clear"></div>
						</div>
					</form>
					
				</div>
			</div>
		</div>
    </body>
</html>
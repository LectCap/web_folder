<?php
include($_SERVER['DOCUMENT_ROOT']."/php/courseHeader.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php echo "<title>$course_name - View Participants</title>" ?>
		<link rel="icon" href="images/favicon.ico">
		<meta charset='utf-8'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="bootstrap/css/style.css" rel="stylesheet">
		<link href="css/master.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="/js/viewParticipants.js"></script>
		<script src="/js/login_register.js"></script>
		<script src="/js/getWaitingNr.js"></script>
		<script src="js/editAcc.js"></script>
		<script src="/js/createCourse.js"></script>
		<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
    </head>
    <body>
		<?php include($_SERVER['DOCUMENT_ROOT']."/php/headermenuCourse.php"); ?>
		<script>
			// Highlights the page in the menu
			$( "#viewParticipants" ).addClass( "active" );
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
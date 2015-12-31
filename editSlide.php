<?php
//include($_SERVER['DOCUMENT_ROOT']."/php/courseHeader.php");
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");

?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php echo "<title>Add slide</title>"; ?>
		<?php include($_SERVER['DOCUMENT_ROOT']."/php/headerIncluder.php"); ?>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="/js/viewCourses.js"></script>
		<script src="/js/login_register.js"></script>
		<script src="js/editAcc.js"></script>
		<script src="/js/createCourse.js"></script>
		<script src="/js/myCourses.js"></script>
		<script> 
		
		$('#slides').on( 'click', 'button.tableButton', function () {
			   alert('test');
    } );
	</script>
    </head>
    <body>
	<?php session_start(); include($_SERVER['DOCUMENT_ROOT']."/php/headermenu.php");?>
	<script>
	$(document).ready( function () {
    $('#slides').DataTable({
    dom: 'Bfrtip',
	"bFilter": false,
	
    buttons: [
        'colvis',
        'excel',
        'print'
    ]
}
	);
	});
		
	function deleteSlide(id){
		location.href='./php/deleteSlide.php?slide_id=' + id;
	}
</script>
		<div id="editSlidediv" class="startdiv">
			<div class="page-header">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-4">
							<img src="bootstrap/images/logo.png" class="img-responsible pull-left" >
						</div>
						<div class="col-lg-6">
							<h1><?php echo $_SESSION['lect_name']; ?></h1>
						</div>
					</div>
				</div>	
		<div class="container-fluid">
		
			<div class="content container-fluid">
			<h1>Slides</h1>
		    <table id="slides" class="display" cellspacing="0" width="100%"><thead><tr>
			<?php
			// sending query
			$result = db_query("SELECT * FROM slides WHERE id = ".$_GET['lecture_id']);
			if (!$result) {
				die("Query to show fields from table failed");
			}
			// printing table headers
			echo "<td>Start time</td>";
			echo "<td>Slide</td>";
			echo "<td align=\"center\">Action</td>";
			echo "</thead></tr>\n";
			// printing table rows
			while($row = mysqli_fetch_array($result, MYSQLI_NUM))
			{
				echo "<tr>";
				echo "<td>".$row[2]."</td>";
				echo "<td align=\"center\"><img src=\"".$row[3]."\" id=\"slide\" width=\"228\" height=\"190\" /></td>";
				echo "<td align=\"right\"><button onclick=\"deleteSlide(".$row[0].")\" class='tableButton'>Delete</button></td>";
				echo "</tr>\n";
			}
			?>
			</table>
			<div>
			<form id="add_slide" method="POST" action="php/upload_slide.php" enctype="multipart/form-data">
			<input type="number" name="start_sec" placeholder="Enter start time">
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="hidden" name="lect_id" value="<?php echo $_GET['lecture_id']; ?>">
			<input type="submit" value="upload" name="submit">
			</div>
			</div>
		</div>
		</div>

    </body>
</html>
<?php
//include($_SERVER['DOCUMENT_ROOT']."/php/courseHeader.php");
include($_SERVER['DOCUMENT_ROOT']."/php/db.php");

?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php echo "<title>Add slide</title>"; ?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="/js/editCourse.js"></script>
		<script src="/js/closeCourse.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/master.css">
    </head>
    <body>
		<?php //include($_SERVER['DOCUMENT_ROOT']."/php/headermenuCourse.php");?>
		<div class="wrapper">
			<div class="content">
			<?php
			// sending query
			$result = db_query("SELECT * FROM slides WHERE id = ".$_GET['lecture_id']);
			if (!$result) {
				die("Query to show fields from table failed");
			}


			echo "<h1>Slides</h1>";
			echo "<table border='1'><tr>";
			// printing table headers
			echo "<td>Start ime</td>";
			echo "<td>Path</td>";
			echo "<td>Action</td>";
			echo "</tr>\n";
			// printing table rows
			while($row = mysqli_fetch_array($result, MYSQLI_NUM))
			{
				echo "<tr>";
				echo "<td>".$row[2]."</td>";
				echo "<td>".$row[3]."</td>";
				echo "<td><input type=\"submit\" value=\"edit\" name=\"edit\"><input type=\"submit\" value=\"delete\" name=\"delete\"></td>";
				echo "</tr>\n";
			}
			?>
			<form method="POST" action="php/upload_slide.php" enctype="multipart/form-data">
			<td><input type="number" value="0" name="start_sec"></td>
			<td><input type="file" name="fileToUpload" id="fileToUpload"></td>
			<input type="hidden" name="lect_id" value="<?php echo $_GET['lecture_id']; ?>">
			<td><input type="submit" value="upload" name="submit"></td>
			</form>

</body></html>
			</div>
		</div>
    </body>
</html>
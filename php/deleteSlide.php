<?php
include($_SERVER['DOCUMENT_ROOT']."php/db.php");
session_start();
$slide_id = $_GET['slide_id'];
$result = db_query("DELETE FROM slides WHERE slide_id =".$slide_id);
?>
<script>
 window.history.go(-1);
</script>";
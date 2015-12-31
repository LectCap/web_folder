<?php
include($_SERVER['DOCUMENT_ROOT']."php/db.php");
session_start();
$url = $_GET['url'];
$lecture_id = $_GET['lecture_id'];

$result = db_query("UPDATE videos SET url='".$url."' WHERE id='".$lecture_id."'");
?>
<script>
window.history.go(-1)
</script>
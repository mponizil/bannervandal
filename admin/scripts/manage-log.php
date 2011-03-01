<?php
include_once("../../config.php");

$act = $_POST['act'];

if($act=="delete") {
	
	$log_id = $_POST['log_id'];
	
	mysql_query("DELETE FROM log WHERE `id`='$log_id'");
	
}

?>
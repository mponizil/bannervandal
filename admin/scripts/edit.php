<?php
include_once("../../config.php");

$act = $_POST['act'];

if($act == "edit") {
	
	$banner_id = $_POST['banner_id'];
	$category_id = $_POST['category_id'];
	$title = mysql_real_escape_string($_POST['title']);
	
	mysql_query("UPDATE banners SET `category_id`='$category_id', `title`='$title' WHERE `id`='$banner_id'");
	
}
?>
<?php
include_once("../../config.php");

$act = $_POST['act'];

if($act == "approve") {
	
	$banner_id = $_POST['banner_id'];
	$category_id = $_POST['category_id'];
	$title = mysql_real_escape_string($_POST['title']);
	
	mysql_query("UPDATE banners SET `category_id`='$category_id', `title`='$title', `approved`=1 WHERE `id`='$banner_id'");
	
} else if($act == "deny") {
	
	$banner_id = $_POST['banner_id'];
	
	mysql_query("UPDATE banners SET `public`=0 WHERE `id`='$banner_id'");
	
} else if($act == "delete") {
	
	$banner_id = $_POST['banner_id'];
	
	$banner = mysql_fetch_array(mysql_query("SELECT * FROM banners WHERE `id`='$banner_id'"));
	
	if(file_exists(ABS_PATH . "img/_banners/full/" . $banner['slug'] . ".jpg")) {
		unlink(ABS_PATH . "img/_banners/full/" . $banner['slug'] . ".jpg");
	}
	
	for($i = 1; $i <= 5; $i++) {
		if(file_exists(ABS_PATH . "img/_banners/cuts/" . $banner['slug'] . "-" . $i . ".jpg")) {
			unlink(ABS_PATH . "img/_banners/cuts/" . $banner['slug'] . "-" . $i . ".jpg");
		}
	}
	
	mysql_query("DELETE FROM banners WHERE `id`='$banner_id'");
	
}
?>
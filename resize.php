<?php

if($_FILES['upload']['name']) {
	
	include_once("config.php");
	
	$name = $_FILES['upload']['name'];
	$tmp_name = $_FILES['upload']['tmp_name'];
	
	$path_info = pathinfo($name);
	$extension = $path_info['extension'];
	if($extension != "jpg" && $extension != "jpeg" && $extension != "png" && $extension != "gif") {
		echo("please upload a jpg, gif, or png");
		exit;
	}
	
	$uploaded_image_name = "tmp_" . time() . "." . $path_info['extension'];
	$uploaded_image = "img/_banners/tmp/" . $uploaded_image_name;
	$uploaded_image_abs = ABS_PATH . $uploaded_image;
	
	move_uploaded_file($tmp_name, $uploaded_image_abs);
	
} else if($_POST['link']) {
	
	include_once("config.php");
	
	$link = $_POST['link'];
	$path_info = pathinfo($link);
	$extension = $path_info['extension'];
	if($extension != "jpg" && $extension != "jpeg" && $extension != "png" && $extension != "gif") {
		echo("please upload a jpg, gif, or png");
		exit;
	}
	
	$uploaded_image_name = "";
	$uploaded_image = $link;
	$uploaded_image_abs = $link;
	
} else {
	header("Location: upload.php");
}

$page_name = "resize";
include("header.php");

?>

<img src="<?=$uploaded_image?>" id="cropbox" />

<form name="crop_photo" id="crop_photo">
	<input type="hidden" name="tmp_name" value="<?=$uploaded_image_name?>" />
	<input type="hidden" name="full_path" value="<?=$uploaded_image_abs?>" />
	<input type="hidden" id="x" name="x" value="0" />
	<input type="hidden" id="y" name="y" value="0"  />
	<input type="hidden" id="w" name="w" value="<?=BANNER_WIDTH?>" />
	<input type="hidden" id="h" name="h" value="<?=BANNER_HEIGHT?>" />
	<input type="hidden" name="public" value="<?=$_POST['public']?>" />
	<button>crop!</button>
</form>

<?php

include("footer.php");

?>
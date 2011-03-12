<?php
include_once("../config.php");
$time = time();

$tmp_name = $_POST['tmp_name'];
$name = $fb_user_id . "_" . $time;
$file_name = $name . ".jpg";
$image_jpeg = ABS_PATH . "img/_banners/full/" . $file_name;

$jpeg_quality = 100;

// resize and crop to banner size
$src = $_POST['full_path'];

$path_info = pathinfo($src);
$extension = $path_info['extension'];
if($extension == "jpg" || $extension == "jpeg")
	$full_img_r = @imagecreatefromjpeg($src);
else if($extension == "png")
	$full_img_r = @imagecreatefrompng($src);
else if($extension == "gif")
	$full_img_r = @imagecreatefromgif($src);

$full_dst_r = @imagecreatetruecolor(BANNER_WIDTH, BANNER_HEIGHT);

@imagecopyresampled($full_dst_r, $full_img_r, 0, 0, $_POST['x'], $_POST['y'], BANNER_WIDTH, BANNER_HEIGHT, $_POST['w'], $_POST['h']);

// create watermark
$im = $full_dst_r;
$stamp = imagecreatefrompng("../img/global/watermark.png");
$marge_right = 0;
$marge_bottom = 1;
$sx = imagesx($stamp);
$sy = imagesy($stamp);
imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

@imagejpeg($im, $image_jpeg, $jpeg_quality);

// cut into five pieces
for($i = 0; $i < 5; $i++) {
	$cut_img_r = $full_dst_r;
	$cut_dst_r = @imagecreatetruecolor(CUT_WIDTH, CUT_HEIGHT);
	$cut_jpeg = ABS_PATH . "img/_banners/cuts/" . $name . "-" . ($i+1) . ".jpg";
	
	@imagecopy($cut_dst_r, $cut_img_r, 0, 0, CUT_WIDTH * $i, 0, CUT_WIDTH, CUT_HEIGHT);
	@imagejpeg($cut_dst_r, $cut_jpeg, $jpeg_quality);
}

// add to database
$slug = $name;
$public = ($_POST['public']) ? 1 : 0;
$title = ($_POST['title'] && $public) ? $_POST['title'] : $slug;
mysql_query("INSERT INTO banners (`category_id`,`user_id`,`timestamp`,`title`,`slug`,`public`) VALUES('0','$fb_user_id','$time','$title','$slug','$public')");

// delete tmp banner
if(file_exists(ABS_PATH . "img/_banners/tmp/" . $tmp_name)) {
	@unlink(ABS_PATH . "img/_banners/tmp/" . $tmp_name);
}

// return data
$data = array("id" => mysql_insert_id());
echo(json_encode($data));
?>
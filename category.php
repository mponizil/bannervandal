<?php

$category_id = (int)$_GET['id'];
if(!$category_id)
	header("Location: index.php");

include_once("config.php");
$category = mysql_fetch_array(mysql_query("SELECT * FROM categories WHERE `id`='$category_id'"));

if(!$category)
	header("Location: index.php");

$page_name = "category";
include("header.php");

$category = mysql_fetch_array(mysql_query("SELECT * FROM categories WHERE `id`='$category_id'"));

?>

<div class="banner-list">
	
	<h1><?=$category['title']?></h1>
	
	<h2>click an image to vandalize someone's profile</h2>

	<?php

	$row = mysql_query("SELECT * FROM banners WHERE `category_id`='$category_id' AND `public`=1 AND `approved`=1 ORDER BY `timestamp` DESC");

	while($banner = mysql_fetch_array($row)) {
	
		echo($banner['title']);
	
	?>
	
	<div class="banner-option">
		
		<a href="view-banner.php?id=<?=$banner['id']?>"><img src="img/_banners/full/<?=$banner['slug']?>.jpg" /></a>
	
	</div>

	<?php } ?>

</div>

<?php

include("footer.php");

?>
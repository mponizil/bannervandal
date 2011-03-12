<?php

header("Location: category.php?id=1");

$page_name = "index";
include("header.php");

?>

<div class="banner-list">
	
	<h2>click an image to vandalize someone's profile</h2>

	<?php

	$row = mysql_query("SELECT * FROM banners WHERE `public`=1 AND `approved`=1 ORDER BY `timestamp` DESC");

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
<?php

$page_name = "index";
include("header.php");

?>

<div class="banner-list">
	
	<h2>click an image to vandalize someone's profile</h2>

	<?php

	$row = mysql_query("SELECT * FROM banners ORDER BY `timestamp` DESC");

	while($banner = mysql_fetch_array($row)) {
	
		echo($banner['title']);
	
	?>
	
	<div class="banner-option">

		<ul class="banner-images">

			<?php for($i = 1; $i <= 5; $i++) { ?>

			<li>
		
				<a href="view-banner.php?id=<?=$banner['id']?>"><img src="img/_banners/<?=$banner['slug']?>-<?=$i?>.jpg" /></a>
		
			</li>

			<?php } ?>

		</ul>
	
		<div style="clear:both;"></div>
	
	</div>

	<?php } ?>

</div>

<?php

include("footer.php");

?>
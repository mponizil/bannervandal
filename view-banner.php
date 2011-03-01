<?php

$banner_id = (int)$_GET['id'];
if(!$banner_id)
	header("Location: index.php");

include_once("config.php");
$banner = mysql_fetch_array(mysql_query("SELECT * FROM banners WHERE `id`='$banner_id'"));
if(!$banner)
	header("Location: index.php");

$page_name = "view-banner";
include("header.php");

?>

<div class="view-banner" id="<?=$banner['id']?>">

	<?=$banner['title']?>

	<ul class="banner-images">

		<?php for($i = 1; $i <= 5; $i++) { ?>

		<li>
		
			<img src="img/_banners/<?=$banner['slug']?>-<?=$i?>.jpg" />
		
		</li>

		<?php } ?>
	
	</ul>
	
	<div style="clear:both;"></div>
	
	<a href="javascript:void(0)" class="choose-friend-link">choose a friend to vandalize</a>

</div>

<div class="loading-friends"><img src="img/global/dark-loader.gif" /> loading friends...</div>

<div class="find-friend">
	
	<h2>choose a friend to vandalize</h2>

	<div class="choose-friend">
	
		<input type="text" name="tag_friend" id="tag_friend" class="tag-friend" />
	
		<ul id="friend-suggest"></ul>
	
	</div>
	
	<div class="victim">
	
		<h2>your victim</h2>
	
		<div class="chosen-friend">
			
			<img align="middle" />
			
			<em></em>
			
		</div>
	
	</div>

</div>

<div class="submit">
	
	<div class="loading-vandalize"><img src="img/global/dark-loader.gif" /> vandalizing (takes about 20 seconds)...</div>

	<button id="vandalize">vandalize!</button>

</div>

<?php

include("footer.php");

?>
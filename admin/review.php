<?php include("header.php"); ?>

<script type="text/javascript">
$(function() {
	reviewInit();
})
function reviewInit() {
	$(".approve").click(function() {
		var li = $(this).parents("li");
		
		var bannerID = li.attr("id");
		var categoryID = $(this).siblings("select[name='category']").val();
		var title = $(this).siblings(".title").val();
		$.post("scripts/review.php", { act: "approve", banner_id: bannerID, category_id: categoryID, title: title }, function(data) {
			li.fadeOut();
		})
	})
	
	$(".deny").click(function() {
		var li = $(this).parents("li");
		var bannerID = li.attr("id");
		$.post("scripts/review.php", { act: "deny", banner_id: bannerID }, function(data) {
			li.fadeOut();
		})
	})
	
	$(".delete").click(function() {
		var li = $(this).parents("li");
		
		var bannerID = li.attr("id");
		$.post("scripts/review.php", { act: "delete", banner_id: bannerID }, function(data) {
			li.fadeOut();
		})
	})
}
</script>

<h1>banners to review</h1>

<ul>

<?php

$row = mysql_query("SELECT * FROM banners WHERE `public`=1 AND `approved`=0 ORDER BY `timestamp` DESC");

while($banner = mysql_fetch_array($row)) {

?>

	<li id="<?=$banner['id']?>">
		
		<img src="../img/_banners/full/<?=$banner['slug']?>.jpg" /> by <a href="http://www.facebook.com/profile.php?id=<?=$banner['user_id']?>" target="_blank"><img src="https://graph.facebook.com/<?=$banner['user_id']?>/picture" /></a><br />
		
		<select name="category">
			
			<?php
			$cat_row = mysql_query("SELECT * FROM categories");
			while($category = mysql_fetch_array($cat_row)) {
			?>
			
			<option value="<?=$category['id']?>"><?=$category['title']?></option>
			
			<?php } ?>
			
		</select><br />
		
		title <input type="text" name="title" class="title" /><br />
		
		<button class="approve">yes public</button>
		
		<button class="deny">no public</button>
		
		<button class="delete">delete this crap</button>
	
	</li>

<?php } ?>

</ul>

<?php include("footer.php"); ?>
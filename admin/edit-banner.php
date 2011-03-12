<?php

$banner_id = (int)$_GET['id'];
if(!$banner_id)
	header("Location: index.php");

include_once("../config.php");
$banner = mysql_fetch_array(mysql_query("SELECT * FROM banners WHERE `id`='$banner_id'"));
if(!$banner)
	header("Location: index.php");

$page_name = "edit-banner";
include("header.php");

?>

<script type="text/javascript">
$(function() {
	editInit();
})
function editInit() {
	$("#edit").click(function() {
		var bannerID = $(".edit-banner").attr("id");
		var categoryID = $("select[name='category']").val();
		var title = $("#title").val();
		$.post("scripts/edit.php", { act: "edit", banner_id: bannerID, category_id: categoryID, title: title }, function(data) {
			window.location.reload();
		})
	})
	
	$("#delete").click(function() {
		var bannerID = $(".edit-banner").attr("id");
		var title = $("#title").val();
		$.post("scripts/review.php", { act: "delete", banner_id: bannerID }, function(data) {
			window.location = "index.php";
		})
	})
}
</script>

<div class="edit-banner" id="<?=$banner['id']?>">
	
	<img src="../img/_banners/full/<?=$banner['slug']?>.jpg" /> by
	<?php if($banner['user_id']!=0) { ?><a href="http://www.facebook.com/profile.php?id=<?=$banner['user_id']?>" target="_blank"><img src="https://graph.facebook.com/<?=$banner['user_id']?>/picture" /></a><?php } else { echo("bv team"); } ?><br />
	
	<select name="category">
		
		<?php
		$row = mysql_query("SELECT * FROM categories");
		while($category = mysql_fetch_array($row)) {
		?>
		
		<option value="<?=$category['id']?>"<?php if($category['id']==$banner['category_id']) { echo(" selected"); } ?>><?=$category['title']?></option>
		
		<?php } ?>
		
	</select><br />
	
	<input type="text" name="title" id="title" value="<?=$banner['title']?>" /><br />
	
	<button id="edit">edit</button>
	
	<button id="delete">delete</button>

</div>

<?php

include("footer.php");

?>
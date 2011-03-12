<?php include("header.php"); ?>

<script type="text/javascript">
$(function() {
	deleteInit();
})
function deleteInit() {
	$(".delete").click(function() {
		var vandalism = $(this).parents(".vandalism");
		var logID = vandalism.attr("id");
		$.post("scripts/manage-log.php", { act: "delete", log_id: logID }, function(data) {
			vandalism.fadeOut();
		})
	})
}
</script>

<?php $log = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS count FROM log WHERE `vandal_id`!='831670161' AND `vandal_id`!='712351321'")); ?>

<?php $users = mysql_fetch_array(mysql_query("SELECT COUNT(DISTINCT vandal_id) AS count FROM log")); ?>

<h1><?=$users['count']?> different people have used bannervandal</h1>

<h1>Last 20 Vandalisms (<?=$log['count']?> total)</h1>

<?php

$row = mysql_query("SELECT * FROM log WHERE `vandal_id`!='831670161' AND `vandal_id`!='712351321' ORDER BY `timestamp` DESC LIMIT 30");

while($log = mysql_fetch_array($row)) {
	
	$flag = 0;

	$banner_id = $log['banner_id'];
	$banner = mysql_fetch_array(mysql_query("SELECT * FROM banners WHERE `id`='$banner_id'"));
	if(!$banner) { $flag = 1; }

	try { $vandal = $facebook->api('/'.$log['vandal_id']); } catch(FacebookApiException $e) { $flag = 1; }
	$vandal_name = $vandal['name'];

	try { $friend = $facebook->api('/'.$log['friend_id']); } catch(FacebookApiException $e) { $flag = 1; }
	$friend_name = $friend['name'];
	
	if($flag == 0) {

?>

<div class="vandalism" id="<?=$log['id']?>">
	
	<div class="delete">delete log</div>

	<a href="http://www.facebook.com/profile.php?id=<?=$log['vandal_id']?>">
		<img src="http://graph.facebook.com/<?=$log['vandal_id']?>/picture" align="middle" />
	</a> <?=$vandal_name?>

	vandalized

	<a href="http://www.facebook.com/profile.php?id=<?=$log['friend_id']?>">
		<img src="http://graph.facebook.com/<?=$log['friend_id']?>/picture" align="middle" />
	</a> <?=$friend_name?>

	with <?=$banner['title']?><br />
	
	<a href="edit-banner.php?id=<?=$banner['id']?>"><img src="../img/_banners/full/<?=$banner['slug']?>.jpg" /></a>

</div>

<?php } } ?>

<?php include("footer.php"); ?>
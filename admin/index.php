<?php include_once("../config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>BANNERVANDAL admin</title>
	
	<link type="text/css" href="../css/global.css" rel="stylesheet" />
	<style type="text/css">
	a {
		text-decoration:none;
	}
	.vandalism {
		margin-bottom:20px;
		border-bottom:2px solid #000;
	}
	.delete {
		color:red;
		cursor:pointer;
		float:right;
	}
	</style>
	
	<script type="text/javascript" src="../js/jquery.js"></script>
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
	
</head>

<body>
	
<div class="container">
	
	<?php $log = mysql_fetch_array(mysql_query("SELECT COUNT(id) AS count FROM log WHERE `vandal_id`!='831670161' AND `vandal_id`!='712351321'")); ?>
	
	<h1>Last 20 Vandalisms (<?=$log['count']?> total)</h1>

	<?php

	$row = mysql_query("SELECT * FROM log WHERE `vandal_id`!='831670161' AND `vandal_id`!='712351321' ORDER BY `timestamp` DESC LIMIT 20");

	while($log = mysql_fetch_array($row)) {
	
		$banner_id = $log['banner_id'];
		$banner = mysql_fetch_array(mysql_query("SELECT * FROM banners WHERE `id`='$banner_id'"));
	
		try { $vandal = $facebook->api('/'.$log['vandal_id']); } catch(FacebookApiException $e) { echo($e); }
		$vandal_name = $vandal['name'];
	
		try { $friend = $facebook->api('/'.$log['friend_id']); } catch(FacebookApiException $e) { echo($e); }
		$friend_name = $friend['name'];
	

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

		<ul class="banner-images">
	
			<?php for($i = 1; $i <= 5; $i++) { ?>
		
				<li><img src="../img/_banners/<?=$banner['slug']?>-<?=$i?>.jpg" /></li>
		
			<?php } ?>
	
		</ul>
	
		<div style="clear:both;"></div>

	</div>

	<?php } ?>

</div>

</body>
</html>

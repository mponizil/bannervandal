<?php include_once("config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<?=$metatags?>

	<title><?=PAGE_TITLE?></title>
	
	<link rel="shortcut icon" href="/img/global/favicon.png" type="image/x-icon" />
	
	<link type="text/css" href="css/global.css" rel="stylesheet" />
	<link type="text/css" href="js/jcrop/jquery.Jcrop.css" rel="stylesheet" />
	<?php if(file_exists("css/".$page_name.".css")) { ?>
	<link type="text/css" href="css/<?=$page_name?>.css" rel="stylesheet" />
	<?php } ?>
	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jcrop/jquery.Jcrop.min.js"></script>
	<script type="text/javascript">
	var bannerWidth = <?=BANNER_WIDTH?>;
	var bannerHeight = <?=BANNER_HEIGHT?>;
	</script>
	<script type="text/javascript" src="js/global.js"></script>
	<?php if(file_exists("js/".$page_name.".js")) { ?>
	<script type="text/javascript" src="js/<?=$page_name?>.js"></script>
	<?php } ?>
	
</head>

<body>

<div id="fb-root"></div>
<script type="text/javascript">
window.fbAsyncInit = function() {
	FB.init({
		appId: '195323770487042',
		status: true,
		cookie: true,
		xfbml: true
	});
	FB.getLoginStatus(fbResponse);
};
(function() {
	var e = document.createElement('script');
	e.async = true;
	e.src = 'https://connect.facebook.net/en_US/all.js';
	document.getElementById('fb-root').appendChild(e);
}());
</script>

<div class="container">
	
	<header>
		
		<a href="index.php"><img src="img/global/vandal.jpg" /></a><br />
		
        <img src="img/global/HOWTO.jpg" />
		
	</header>
	
	<nav>
		
		<h3>actions</h3>
		
		<ul>
			
			<?php if($admin) { ?>
			<li><a href="admin/">admin</a></li>
			<?php } ?>
			
			<li><a href="upload.php">submit your own</a></li>
			
		</ul>
		
		<h3>categories</h3>
		
		<ul>
			
			<?php
			
			$row = mysql_query("SELECT * FROM categories WHERE `parent_id`=0");
			
			while($category = mysql_fetch_array($row)) {
			
			?>
			
			<li><a href="category.php?id=<?=$category['id']?>"><?=$category['title']?></a></li>
			
			<?php } ?>
			
		</ul>
		
		<fb:like href="http://bannervandal.com" layout="box_count" show_faces="true" width="200" font=""></fb:like>
		
	</nav>
	
	<section class="content">
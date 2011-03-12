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
	li {
		margin-bottom:10px;
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
	
	<header><a href="index.php"><img src="../img/global/vandal.jpg" /></a></header>

	<nav>
		
		<ul>
			
			<li><a href="../index.php">view site</a></li>
			
			<li><a href="log.php">log</a></li>
			
			<li><a href="review.php">review</a></li>
			
		</ul>
		
	</nav>
	
	<section class="content">
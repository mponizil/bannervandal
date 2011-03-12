<?php
define("ABS_PATH",dirname(__FILE__)."/");
define("SITE_ROOT","http://".$_SERVER['SERVER_NAME']."/");

define("PAGE_TITLE","BANNERVANDAL");
define("ERROR","there was a problem. tell misha he's an idiot.");

define("BANNER_WIDTH",490);
define("BANNER_HEIGHT",68);
define("CUT_WIDTH",98);
define("CUT_HEIGHT",68);

$metatags = '<meta property="og:type" content="website"/>
<meta property="og:image" content="http://www.bannervandal.com/img/global/logo.jpg"/>
<meta property="og:site_name" content="Banner Vandal"/>
<meta property="fb:admins" content="831670161,712351321"/>

<meta name="title" content="BANNERVANDAL" />
<meta name="description" content="Customize your friend\'s Facebook banners." />
<link rel="image_src" href="http://www.bannervandal.com/img/global/logo.jpg" />';

include_once(ABS_PATH."lib/connect.php");
include_once(ABS_PATH."lib/facebook.php");

$facebook = new Facebook(array(
	'appId'  => '195323770487042',
	'secret' => '942c73eee2bb1700c4b10315753507ea',
	'cookie' => true
));
$fb_session = $facebook->getSession();
if($fb_session) { $fb_user_id = $facebook->getUser(); if($fb_user_id) { $fb_user = $facebook->api('/me'); } }

$admin = false;
if($fb_user_id == 831670161 || $fb_user_id == 712351321) { $admin = true; }
?>
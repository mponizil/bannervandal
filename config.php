<?php
define("ABS_PATH",dirname(__FILE__)."/");
define("SITE_ROOT","http://".$_SERVER['SERVER_NAME']."/");

define("PAGE_TITLE","BANNERVANDAL");
define("ERROR","there was a problem. tell misha he's an idiot.");

include_once(ABS_PATH."lib/connect.php");
include_once(ABS_PATH."lib/facebook.php");

$facebook = new Facebook(array(
	'appId'  => '195323770487042',
	'secret' => '942c73eee2bb1700c4b10315753507ea',
	'cookie' => true
));
$fb_session = $facebook->getSession();
if($fb_session) { $fb_user_id = $facebook->getUser(); }
?>
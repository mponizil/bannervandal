<?php

include_once("../config.php");

$friends = $facebook->api('/'.$fb_user_id.'/friends');

session_start();
$_SESSION['fb_friends'] = $friends['data'];

$me = array("name" => $fb_user['name'], "id" => $fb_user_id);
array_push($_SESSION['fb_friends'], $me);

?>
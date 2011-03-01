<?php

include_once("../config.php");

$friends = $facebook->api('/'.$fb_user_id.'/friends');

session_start();
$_SESSION['fb_friends'] = $friends['data'];

?>
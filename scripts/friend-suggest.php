<?php

include_once("../config.php");

if($_POST['friend_name']) {
	
	session_start();
	$friends = $_SESSION['fb_friends'];
	
	$amount = 0;
	foreach($friends as $key => $value) {
		
		if(stristr($value['name'],$_POST['friend_name']) && $amount < 20) {
			
			echo("<li id=\"friend".$value['id']."\">".$value['name']."</li>\n");
			
			$amount++;
			
		}
		
	}

}

?>
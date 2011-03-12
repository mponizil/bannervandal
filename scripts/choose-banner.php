<?php

include_once("../config.php");

$banner_id = $_POST['banner_id'];
$banner = mysql_fetch_array(mysql_query("SELECT * FROM banners WHERE `id`='$banner_id'"));

$friend_id = $_POST['friend_id'];

$facebook->setFileUploadSupport(true);

$fb_albums = $facebook->api('/'.$fb_user_id.'/albums');
foreach($fb_albums['data'] as $key => $album) {
	if($album['name'] == "Banner Vandal Album") {
		$album_id = $album['id'];
		$aid_details =  array(
			'method'	=> 'fql.query',
			'query'		=> 'SELECT object_id, aid FROM album WHERE object_id = ' . $album_id);
		try { $aid_data = $facebook->api($aid_details); } catch(FacebookApiException $e) { echo($e); }
		$album_aid = $aid_data[0]['aid'];
	}
}

if(!$album_id) {
	
	$album_details = array(
		'message' => 'Banner Vandal Album',
		'name' => 'Banner Vandal Album');

	try { $album = $facebook->api('/'.$fb_user_id.'/albums', 'post', $album_details); } catch(FacebookApiException $e) { echo($e); }

	$album_id = $album['id'];
	
}

$photo_ids = array();

for($i = 5; $i >= 1; $i--) {
	
	$photo_details = array('message'=> 'Vandalized by bannervandal.com');
	
	$file = $banner['slug'] . '-' . $i . '.jpg';

	$photo_details['image'] = '@' . ABS_PATH . 'img/_banners/cuts/' . $file;
	
	try { $photo = $facebook->api('/'.$album_id.'/photos', 'post', $photo_details); } catch(FacebookApiException $e) { echo($e); }
	
	array_push($photo_ids,$photo['id']);
	
}

/*
 * delete from feed
 *
 */
$feed = $facebook->api('/'.$fb_user_id.'/feed');
foreach($feed['data'] as $key => $entry) {
	if($entry['name'] == "Banner Vandal Album") {
		$entry_id = $entry['id'];
	}
}
if($entry_id) {
	try { $facebook->api('/'.$entry_id, 'delete'); } catch(FacebookApiException $e) { echo($e); }
}

/*
 * tag photos
 *
 */
for($i = 0; $i < 5; $i++) {

	$pid_details =  array(
		'method'	=> 'fql.query',
		'query'		=> 'SELECT pid FROM photo WHERE object_id = ' . $photo_ids[$i]);

	try { $pid_data = $facebook->api($pid_details); } catch(FacebookApiException $e) { echo($e); }

	$pid = $pid_data[0]['pid'];

	$tag_details = array(
		'method'	=> 'photos.addTag',
		'pid'		=> $pid,
		'tag_uid'	=> $friend_id,
		'x'			=> 50,
		'y'			=> 50);

	try { $facebook->api($tag_details); } catch(FacebookApiException $e) { echo($e); }

}

$time = time();
mysql_query("INSERT INTO log (`timestamp`,`vandal_id`,`friend_id`,`banner_id`) VALUES('$time','$fb_user_id','$friend_id','$banner_id')");

echo("done now go see your work!");

?>
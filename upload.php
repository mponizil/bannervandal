<?php

$page_name = "upload";
include("header.php");

?>

<form name="upload" id="upload_form" method="post" action="resize.php" enctype="multipart/form-data">
	
	<input type="file" name="upload" /><br />
	
	or link to a file online<br />
	
	<input type="text" name="link" /><br />
	
	<input type="checkbox" name="public" value="1" checked> public?<br />
	
	<div class="loading-upload"><img src="img/global/dark-loader.gif" /></div>

</form>

<button id="<?php if(!$fb_user_id) { echo("guest-"); } ?>upload">upload!</button>

<?php

include("footer.php");

?>
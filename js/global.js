var fbSession;

function fbResponse(response) {
	
	if(response.session) {
		
		fbSession = response.session;
		
		$.post("scripts/store-friends.php");
		
	}
	
}
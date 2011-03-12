$(function() {
	uploadInit();
	fbLoginInit();
})

function uploadInit() {
	$("#upload").click(function() {
		$("#upload_form").submit();
	})
	
	$("#upload_form").submit(function() {
		
		$("#upload").hide();
		$(".loading-upload").show();
		
	})
}

function fbLoginResponse(response) {
	
	if(response.session) {
		
		fbSession = response.session;
		
		$("#guest-upload").attr("id","upload");
		
		$("#upload_form").submit();
		
	} else {
		
		$("#guest-upload").show();
		
	}
	
}

function fbLoginInit() {
	
	$("#guest-upload").click(function() {
		
		FB.login(fbLoginResponse, { perms: 'publish_stream,user_photos,read_stream' });
		
	})
	
}
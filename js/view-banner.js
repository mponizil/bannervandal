var bannerID;
var friendID;

$(function() {
	chooseBannerInit();
})

function fbResponse(response) {
	
	if(response.session) {
		
		fbSession = response.session;
		
		$(".loading-friends").show();
		
		$.post("scripts/store-friends.php", "", findFriendInit);
		
	} else {
		
		$(".choose-friend-link").show();
		
	}
	
}

function chooseBannerInit() {
	
	bannerID = $(".view-banner").attr("id");
	
	$(".choose-friend-link").click(function() {
		
		if(!fbSession) { FB.login(fbLoginResponse, { perms: 'publish_stream,user_photos,read_stream' }); }
		
	})
	
}

function fbLoginResponse(response) {
	
	if(response.session) {
		
		fbSession = response.session;
		
		$(".loading-friends").show();
		
		$.post("scripts/store-friends.php", "", findFriendInit);
		
	} else { alert('you suck'); }
	
}

function findFriendInit() {
	
	$(".choose-friend-link").hide();
	$(".loading-friends").hide();
	$(".find-friend").show();
	
	$("#tag_friend").focus();
	
	$("#tag_friend").keyup(function() {
		
		var friendName = $(this).val();
		
		$.post("scripts/friend-suggest.php", { friend_name: friendName }, function(data) {
			
			$("#friend-suggest").html(data);
			
			if(data) {
				
				$("#friend-suggest").show();
			
				$("#friend-suggest li").hover(
					function() {
						$(this).addClass("blue-bg");
					},
					function() {
						$(this).removeClass("blue-bg");
				})
				$("#friend-suggest li").click(chooseFriend);
				
			} else { $("#friend-suggest").hide(); }
			
		})
		
	})
	
}

function chooseFriend() {
	
	$("#friend-suggest").hide();
	$(".victim").show();
	
	friendID = $(this).attr("id").substring(6);
	var friendName = $(this).text();
	
	$(".chosen-friend img").attr("src","http://graph.facebook.com/" + friendID + "/picture");
	$(".chosen-friend em").html(friendName);
	
	vandalizeInit();
	
}

function vandalizeInit() {
	
	$("#vandalize").show();
	
	$("#vandalize").click(function() {
		
		$("#vandalize").hide();
		$(".loading-vandalize").show();
		
		$.post("scripts/choose-banner.php", { banner_id: bannerID, friend_id: friendID }, function(data) {
			
			$(".loading-vandalize").hide();
			
			alert(data);
			
			$(".see-work a").attr("href","http://www.facebook.com/profile.php?id=" + friendID);
			$(".see-work").show();

		})
		
	})
	
}
$(function() {
	jQuery('#cropbox').Jcrop({
		onChange: showPreview,
		onSelect: showPreview,
		setSelect:   [ 0, 0, bannerWidth, bannerHeight ],
		aspectRatio: (bannerWidth / bannerHeight)
	});
	$("#crop_photo").submit(function() {
		$.post("scripts/crop-photo.php", $("#crop_photo").serialize(), function(data) {
			var banner = eval('('+data+')');
			window.location = "view-banner.php?id=" + banner.id;
		});
		return false;
	});
});
function showPreview(coords) {
	if (parseInt(coords.w) > 0)
	{
		var rx = bannerWidth / coords.w;
		var ry = bannerHeight / coords.h;
		
		var imgw = $("#cropbox").width();
		var imgh = $("#cropbox").height();

		$('#preview').css({
			width: Math.round(rx * imgw) + 'px',
			height: Math.round(ry * imgh) + 'px',
			marginLeft: '-' + Math.round(rx * coords.x) + 'px',
			marginTop: '-' + Math.round(ry * coords.y) + 'px'
		});
	}
	updateCoords(coords);
}
function updateCoords(c) {
	$('#x').val(c.x);
	$('#y').val(c.y);
	$('#w').val(c.w);
	$('#h').val(c.h);
};
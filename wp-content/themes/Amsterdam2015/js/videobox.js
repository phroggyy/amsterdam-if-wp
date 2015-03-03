$(function() {
	$('.playvideo').click(function() {
		var modal = $(this).attr('data-target');
		var url = $(this).attr('data-url');
		$(modal+' modal-body').append();
	});
})
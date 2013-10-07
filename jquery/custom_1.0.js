$(function() {
	$("h2.pagetitle span").html(function(i, text) {
		return text.replace(/[a-zàâîïôèéêëèùûü]+/i, function(match) {
			return '<span class="firstword">' + match + '</span>';
		});
	});
	
	$('#da-slider').cslider({
		autoplay	: true,
		interval : 6000
	});
});
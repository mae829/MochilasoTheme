/*
	Description: Javascript & jQuery coding for Internet Explorer 6
	Author: Miguel Estrada
	Author URI: http://bleucellar.com/
*/

$(function() {
	// Add first-child and last-child classes to lists for css styling.
	$('li:last-child').addClass('last-child');
	$('li:first-child').addClass('first-child');

	function hoverOn() {
		var currentClass = $(this)
			.attr('class')
			.split(' ')[0]; // Get first class name
		$(this).addClass(currentClass + '-hover');
	}
	function hoverOff() {
		var currentClass = $(this)
			.attr('class')
			.split(' ')[0]; // Get first class name
		$(this).removeClass(currentClass + '-hover');
	}
	// $(".nav-item").hover(hoverOn,hoverOff);
});

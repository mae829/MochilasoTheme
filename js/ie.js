/*
	Description: Javascript & jQuery coding for Internet Explorer 6
	Author: Miguel Estrada
	Author URI: http://bleucellar.com/
*/

$( function() {
	// ADD FIRST-CHILD AND LAST-CHILD CLASSES TO LISTS FOR CSS STLYING //
	$( "li:last-child" ).addClass( "last-child" );
	$( "li:first-child" ).addClass( "first-child" );

	function hoverOn(){
		var currentClass = $( this ).attr( 'class' ).split( ' ' )[0]; // Get first class name
		$( this ).addClass( currentClass + '-hover' );
	}
	function hoverOff(){
		var currentClass = $( this ).attr( 'class' ).split( ' ' )[0]; // Get first class name
		$( this ).removeClass( currentClass + '-hover' );
	}
	// $(".nav-item").hover(hoverOn,hoverOff);
} );

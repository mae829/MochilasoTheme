$(function() {
	$( '.no-js' ).hide();
	$( 'body.home #post-listing' ).hide();
	$( '#map-holder' ).show();

	var custom_icon = $theme_location + '/images/yellow_pin.png',
	$locations      = $( '.coordinates' ),
	locationArray   = [],
	$newLocations   = [],
	$titles         = $( '.location' ),
	$newTitles      = [];

	$locations.each( function( i ) {
		$locations[i] = $(this).text();
	} );

	$titles.each( function( i ) {
		$titles[i] = $(this).text();
	} );

	$locations = $.grep( $locations, function( n ) {
		return n;
	} );

	$.each( $locations, function( i, el ) {
		el = el.substring( 1 );
		el = el.substring( 0, el.length - 1 );
		if ( $.inArray( el, $newLocations ) === -1 ) {
			$newLocations.push( el );
		}
	} );

	$titles = $.grep( $titles, function( n ) {
		return n;
	} );

	$.each( $titles, function( i, el ) {
		if ( $.inArray( el, $newTitles ) === -1 ) {
			$newTitles.push( el );
		}
	} );

	function initializeMap() {
		var html      = '';
		var i         = 0;
		var locations = [];
		var myOptions = {
			center: new google.maps.LatLng( -25, -60 ),
			zoom: 3,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		},
		map1          = new google.maps.Map(
			document.getElementById( 'map' ),
			myOptions
		),
		infowindow;

		var $newLocationsLength = $newLocations.length;

		for ( i = 0; i < $newLocationsLength; i++ ) {
			var $locationsplit = $newLocations[i].split( ',' ),
				newLat         = $locationsplit[0],
				newLng         = $locationsplit[1],
				newLatLng      = new google.maps.LatLng( newLat, newLng ),
				marker         = {};

			locations[i] = newLatLng;

			marker.title = $newTitles[i];
			createMarker( marker.title, newLatLng );
		}

		var trailPath = new google.maps.Polyline({
			path: locations,
			strokeColor: '#D36C00',
			strokeOpacity: 0.8,
			strokeWeight: 2
		});
		trailPath.setMap( map1 );

		function createMarker( name, LatLng ) {
			var marker = new google.maps.Marker({
				position: LatLng,
				map: map1,
				icon: custom_icon
			});

			infowindow = new google.maps.InfoWindow();
			infowindow.setOptions({
				maxWidth: 150
			});

			google.maps.event.addListener( marker, 'click', function() {
				if ( infowindow ) {
					infowindow.close();
				}
				infowindow.setContent( name );
				infowindow.open( map1, marker );
			} );
		}
	}
	initializeMap();
} );

google.maps.Map.prototype.addMarker = function( marker ) {
	this.markers[ this.markers.length ] = marker;
};

function removeDuplicateElement( arrayName ) {
	var newArray = [];
	label: for ( var i = 0; i < arrayName.length; i++ ) {
		for ( var j = 0; j < newArray.length; j++ ) {
			if ( newArray[j] == arrayName[i] ) {
				continue label;
			}
		}
		newArray[ newArray.length ] = arrayName[i];
	}
	return newArray;
}

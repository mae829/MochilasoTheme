$(function(){
	//hide alert if javascript is enabled
	$('.no-js').hide();
	$('body.home #post-listing').hide();
	$('#map-holder').show();
	
	var custom_icon		=  $theme_location + '/images/yellow_pin.png',
		$locations		= $('.coordinates'),
		locationArray	= [],
		$newLocations	= [],
		$titles			= $('.location'),
		$newTitles		= [];

	$locations.each(function(i){
		$locations[i] = $(this).text();
	});
	$titles.each(function(i){
		$titles[i] = $(this).text();
	});
	//clean up arrays
	$locations = $.grep($locations,function(n){
        return(n);
    });
	$.each($locations, function(i, el){
		el = el.substring(1);
		el = el.substring(0, el.length - 1);
    	if($.inArray(el, $newLocations) === -1) $newLocations.push(el);
	});
	$titles = $.grep($titles,function(n){
        return(n);
    });
	$.each($titles, function(i, el){
    	if($.inArray(el, $newTitles) === -1) $newTitles.push(el);
	});
	//noDuplicates = removeDuplicateElement($locations);
	
	/*for(var i = 0; i < noDuplicates.length; i++){
		var theSplit = noDuplicates[i].split(", ");
		locationArray[i] = {city: theSplit[0] , country: theSplit[1]};
	}	
	//initialize map
	if ( $.browser.msie && ($.browser.version <= 7.0)) {//make map behave in windows 7 and earlier
		$(window).load(function(){
			MQA.withModule('geocoder', function(){
				MQA.Geocoder.geocode(locationArray, null, null, initializeMap);
			});
		});
	}else{
		MQA.withModule('geocoder', function(){
			MQA.Geocoder.geocode(locationArray, null, null, initializeMap);
		});
	}*/
	//geocode results from mapquest due to limitation using google maps api
	//
	function initializeMap(){
		var html = '';
		var i = 0;
		var locations = [];
		var myOptions = {
				center: new google.maps.LatLng(-25, -60),
				zoom: 3,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			},
			map1 = new google.maps.Map(document.getElementById("map"), myOptions),
			infowindow;
			
		for(i = 0; i < $newLocations.length; i++){
			var $locationsplit	= $newLocations[i].split(","),
				newLat			= $locationsplit[0],
				newLng			= $locationsplit[1],
				newLatLng		= new google.maps.LatLng(newLat,newLng);
				
				locations[i] = newLatLng;
					
				var marker = new Object();
				marker.title = $newTitles[i];
					
				createMarker(marker.title, newLatLng);
		};
		
		
		/*if (response.results.length > 0 && response.results[0].locations.length > 0) { // Location ambiguities!
			//place all the markers
			for (i = 0; i < response.results.length; i++) {
				var location = response.results[i].locations[0],
					newLat = location.latLng.lat,
					newLng = location.latLng.lng,
					newLatLng = new google.maps.LatLng(newLat,newLng);
					
				locations[i] = newLatLng;
					
				var marker = new Object();
				marker.title = noDuplicates[i];
					
				createMarker(marker.title, newLatLng);
				
				/*var marker = new google.maps.Marker({
					map:		map1,
					title:		noDuplicates[i],
					position:	newLatLng,
					icon:		custom_icon
					//winContent:	noDuplicates[ij]
				});
				google.maps.event.addListener(marker, 'click', function(){
					if(infowindow){
						infowindow.close()
					};
					infowindow = new google.maps.InfoWindow({content: marker.title});
					infowindow.open(map1, marker);
				})*/
				
			/*}//end for loop placing markers
		}*///end if statement checking for results
		var trailPath = new google.maps.Polyline({
			path: locations,
			strokeColor: '#D36C00',
			strokeOpacity: 0.8,
			strokeWeight: 2
		});
		trailPath.setMap(map1);
		
		function createMarker(name, LatLng){
			var marker = new google.maps.Marker({
				position: LatLng,
				map: map1,
				icon: custom_icon
			});
			
			infowindow = new google.maps.InfoWindow();
			infowindow.setOptions({
				maxWidth:150//,
				//disableAutoPan: true
			});
			google.maps.event.addListener(marker, "click", function(){
				if(infowindow) infowindow.close();
				infowindow.setContent(name);
				infowindow.open(map1, marker);
			});
		}
	}//end function initializeMap
	initializeMap();
});



////////FUNCTIONS////////
google.maps.Map.prototype.addMarker = function(marker) {
    this.markers[this.markers.length] = marker;
  };

//from http://www.roseindia.net/java/javascript-array/javascript-array-remove-duplicat.shtml
function removeDuplicateElement(arrayName){
	var newArray=new Array();
	label:for(var i=0; i<arrayName.length;i++ ){
		for(var j=0; j<newArray.length;j++ ){
			if(newArray[j]==arrayName[i]){continue label;}
		}
		newArray[newArray.length] = arrayName[i];
	}
	return newArray;
}
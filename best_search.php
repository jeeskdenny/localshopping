<h3><p class="text-center"><strong>Map </strong></p></h3></br>
	
	<?php 
	echo $lat. "\n";
	echo $lon. "\n";
	echo $radius. "\n";
	$rad = $radius * 1000;

	?>
	
	
<div><select id="locationSelect" style="width:100%;visibility:hidden"></select></div>
<div id="map" style="width:100%; height:500px"></div>

 
   <script>
   	var map;
    var markers = [];
   	var rad='<?php echo $rad ; ?>';
    var radius = '<?php echo $radius; ?>';
    var latitude = '<?php echo $lat; ?>';
	var longitude = '<?php echo $lon; ?>';
	
	function initialize() {
	
		var zoom = 12;
		var LatLngi = new google.maps.LatLng(latitude, longitude);
		var mapOptions = {
			zoom: zoom,
			center: LatLngi,
			panControl: true,
			zoomControl: true,
			scaleControl: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
		}	
		var map = new google.maps.Map(document.getElementById('map'),mapOptions);
     	
      /*// Create marker 
	   var mark = new google.maps.Marker({
       map: map,
       position: new google.maps.LatLng('<?php echo $lat; ?>', '<?php echo $lon; ?>'),
       title: 'Your Location '
       });

	  // Add circle overlay and bind to marker
		var circle = new google.maps.Circle({
 	 	map: map,
 	 	fillColor: '#AA0000',
  		radius: radius *1000     // 10 miles in metres
		});
		circle.bindTo('center', mark, 'position');*/
		
		searchLocationsNear();
		
	}

	function searchLocationsNear() {

  	var searchUrl = 'create_xml.php?lat=' + latitude + '&lng=' + longitude + '&radius=' + rad;
  	downloadUrl(searchUrl, function(data) {
  	var xml = parseXml(data);
  	var markerNodes = xml.documentElement.getElementsByTagName("marker");
  	var bounds = new google.maps.LatLngBounds();
  	for (var i = 0; i < markerNodes.length; i++) {
    var name = markerNodes[i].getAttribute("sell_id");
    var address = markerNodes[i].getAttribute("product_name");
    var distance = parseFloat(markerNodes[i].getAttribute("distance"));
    var latlng = new google.maps.LatLng(
        parseFloat(markerNodes[i].getAttribute("lat")),
        parseFloat(markerNodes[i].getAttribute("lng")));
        
         createMarker(latlng, name, address);
    bounds.extend(latlng);
  }
  map.fitBounds(bounds);
 });
}

	function createMarker(latlng, name, address) {
      var html = "<b>" + name + "</b> <br/>" + address;
      
      var marker = new google.maps.Marker({
        map: map,
        position: latlng
      }); 
      infoWindow = new google.maps.InfoWindow();
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
      markers.push(marker);
    }
    
    
    function downloadUrl(url,callback) {
 	var request = window.ActiveXObject ?
     new ActiveXObject('Microsoft.XMLHTTP') :
     new XMLHttpRequest;

 	request.onreadystatechange = function() {
   	if (request.readyState == 4 && request.status==200) {
     request.onreadystatechange = doNothing;
     callback(request.responseText);
  	 }
 	};

 	request.open('GET', url, true);
 	request.send(null);
	}
	
	function parseXml(str) {
      if (window.ActiveXObject) {
        var doc = new ActiveXObject('Microsoft.XMLDOM');
        doc.loadXML(str);
        return doc;
      } else if (window.DOMParser) {
        return (new DOMParser).parseFromString(str, 'text/xml');
      }
    }
    function doNothing() {}
    
	initialize();
	</script>

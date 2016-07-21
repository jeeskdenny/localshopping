

						<h3><p class="text-center"><strong>Map </strong></p></h3></br>
	
	<?php 
	echo $lat. "\n";
	echo $lon. "\n";
	echo $radius. "\n";
	$rad = $radius * 1000;


	?>
	
							 <div id="map" style="width:100%; height:500px"></div>


 
    <script>
	function initialize() {
	    var radius = '<?php echo $radius; ?>';
		var $latitude = document.getElementById('latitude');
		var $longitude = document.getElementById('longitude');
		var latitude = '<?php echo $lat; ?>';
		var longitude = '<?php echo $lon; ?>';
		var zoom = 12;
		
		var LatLng = new google.maps.LatLng(latitude, longitude);
		
		var mapOptions = {
			zoom: zoom,
			center: LatLng,
			panControl: true,
			zoomControl: true,
			scaleControl: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}	
		var map = new google.maps.Map(document.getElementById('map'),mapOptions);
      
      // Create marker 
	   var marker = new google.maps.Marker({
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

		circle.bindTo('center', marker, 'position');

	}
	initialize();

	</script>



	
	<html>
   <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/roboto.min.css" rel="stylesheet">
        <link href="css/material.css" rel="stylesheet">
        <link href="css/ripples.min.css" rel="stylesheet">
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

   </head>
   <body onload="load()">
 <div class="container">
   	<?php include 'header.php' ;?>
  	<?php //include 'config/dbc.php';?>
			
		<div class="row">
              <div class="col-sm-2">
             <?php  include 'sidebar.php';?>
           	  </div>
           	  
            <div class="col-sm-10">
            		 	

						<div class="panel panel-body">
						<h3><p class="text-center"><strong>Your Product List </strong></p></h3></br>
						
							<?php 
							session_start();
	  						include 'config/dbc.php';
	  						require_once 'config/functions.php';
	  							if (isset($_GET['did'])) {
      							delete_cart($_GET['did']);
    						}
	  						$query="SELECT * FROM cart WHERE user_id = '$_SESSION[id]'";
     			 			$result=mysql_query($query);
      							echo '<table class="table table-striped table-hover table-responsive" border="1">';
      							echo "<thead>";
      							echo "<th>cart id</th>";
     					 		echo "<th>sub id</th>";
      							echo "<th> Name</th>";
      							echo "<th>Options</th>";
      							echo "</thead>";
      							echo '<tbody>';
      								while ($row = mysql_fetch_array($result)){
        							echo "<tr>";
        							echo "<td>",$row['cart_id'],"</td>";
        							echo "<td>",$row['sub_cat_id'],"</td>";
									echo "<td>",$row['sub_cat_name'],"</td>";
									echo '<td><a href="cartt.php?did=',$row['cart_id'],'" class="btn btn-danger btn-raised"><i class="mdi-navigation-cancel"></i></a></td>';                                                                            
        							echo "</tr>";
      								}
      							echo '</tbody>';
     							echo '</table>';
     							
     							$queryy="SELECT sub_cat_name FROM cart WHERE user_id = '$_SESSION[id]'";
     							$$product_name = array();
     			 				$resultt=mysql_query($queryy);
     			 				while ($roww = mysql_fetch_array($resultt)){
        							$product_name[]= $roww['sub_cat_name'];
      								}
      								//print_r($product_name);
      								$url_data = http_build_query($product_name);
      								//echo $url_data;
      								
						 ?>
						 
						

            			</div>
            			
   										
						<div class="panel panel-body panel-primary">
 								<input type="text" id="addressInput" size="10"/>
    								<select id="radiusSelect">
     						 			<option value="25" selected>25mi</option>
      									<option value="100">100mi</option>
      									<option value="200">200mi</option>
   						 			</select>
    						
    						<div><select id="locationSelect" style="width:100%;visibility:hidden" ></select></div>
   							 <div id="map" style="width: 100%; height: 500px"></div>
							
							
						
						</div>
       					

       					<div class="panel panel-body panel-primary">
							</br> 	
							
							  <input type="submit" onclick="searchLocations()" value="Best search" name="best" class="btn btn-raised btn-success" style="float:right" />
							 
						</div>
   					    </div>
   					    
   					  </form>   
			</div>
			
				
		</div>


 <?php include 'footer.php';?>

 </div>
 
        <script src="js/jquery-1.10.2.min.js"></script>
      	<script src="js/bootstrap.min.js"></script>
        <script src="js/ripples.min.js"></script>
        <script src="js/material.min.js"></script>
        
         <script type="text/javascript">
    //<![CDATA[
    var map;
    var markers = [];
    var infoWindow;
    var locationSelect;
    var urldata='<?php echo $url_data; ?>';
   
    function load() {
      map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(10.371894997119782, 76.41997265625002),
        zoom: 8,
        mapTypeId: 'roadmap',
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU}
      });
      
      infoWindow = new google.maps.InfoWindow();
      locationSelect = document.getElementById("locationSelect");
      locationSelect.onchange = function() {
        var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
        if (markerNum != "none"){
          google.maps.event.trigger(markers[markerNum], 'click');
        }
      };
      
   }
   
   
   function searchLocations() {
     var address = document.getElementById("addressInput").value;
     var geocoder = new google.maps.Geocoder();
     geocoder.geocode({address: address}, function(results, status) {
       if (status == google.maps.GeocoderStatus.OK) {
        searchLocationsNear(results[0].geometry.location);
       } else {
         alert(address + ' not found');
       }
     });
   }
   
   function clearLocations() {
     infoWindow.close();
     for (var i = 0; i < markers.length; i++) {
       markers[i].setMap(null);
     }
     markers.length = 0;
     locationSelect.innerHTML = "";
     var option = document.createElement("option");
     option.value = "none";
     option.innerHTML = "See all results:";
     locationSelect.appendChild(option);
     //circle.setMap(null);
   }

   function searchLocationsNear(center) {
     clearLocations(); 

		
     var radius = document.getElementById('radiusSelect').value;
     var searchUrl = 'create_xml.php?lat=' + center.lat() + '&lng=' + center.lng() + '&radius=' + radius + '&' + urldata;
     createCircle(center.lat() , center.lng(),radius);
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
         createOption(name, distance, i);
         createMarker(latlng, name, address);
         bounds.extend(latlng);
       }
       map.fitBounds(bounds);
       locationSelect.style.visibility = "visible";
       locationSelect.onchange = function() {
         var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
         google.maps.event.trigger(markers[markerNum], 'click');
       };
      });
    }
    
    function createCircle(latit , longi,radi){
       var mark = new google.maps.Marker({
       map: map,
       position: new google.maps.LatLng( latit , longi),
       title: 'Your Location '
       });

	  // Add circle overlay and bind to marker
		var circle = new google.maps.Circle({
 	 	map: map,
 	 	fillColor: '#AA0000',
  		radius: radi*3959    // 10 miles in metres
		});

		circle.bindTo('center', mark, 'position');
    
    }
  
    function createMarker(latlng, name, address) {
      var html = "<b>" + name + "</b> <br/>" + address;
      var marker = new google.maps.Marker({
        map: map,
        position: latlng
      });
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
      markers.push(marker);
    }
    function createOption(name, distance, num) {
      var option = document.createElement("option");
      option.value = num;
      option.innerHTML = name + "(" + distance.toFixed(1) + ")";
      locationSelect.appendChild(option);
    }
    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;
      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request.responseText, request.status);
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
    //]]>
  </script>

     <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>
    </body>
</html>

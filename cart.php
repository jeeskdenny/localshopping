	
	<html>
   <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/roboto.min.css" rel="stylesheet">
        <link href="css/material.css" rel="stylesheet">
        <link href="css/ripples.min.css" rel="stylesheet">
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

   </head>
   <body>
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
									echo '<td><a href="cart.php?did=',$row['cart_id'],'" class="btn btn-danger btn-raised"><i class="mdi-navigation-cancel"></i></a></td>';                                                                            
        							echo "</tr>";
      								}
      							echo '</tbody>';
     							echo '</table>';
						 ?>
						 
						

            			</div>
            			
   						<form name="form1" method="post"  enctype="multipart/form-data" action="validate_algoritham.php" >						
						<div class="panel panel-body panel-primary">
						<h4><p class="text-center"><strong>Add Your Location by Dragging The Map</strong></p></h4>
						                    	  	<input name="latitude" type="text" id="latitude" placeholder="latitude">
  													<input name="longitude" type="text" id="longitude" placeholder="longitude">
							 <div id="map" style="width:100%; height:500px"></div>
							 
							</br> 						
						</div>
       					
       					<div class="panel panel-body panel-primary">
						<h4><p class="text-center"><strong>Add A Distance </strong></p></h4>
						     <input name="km" type="number" id="km" placeholder="distance in km">

							</br> 						
						</div>


       					<div class="panel panel-body panel-primary">
       					<h4><p class="text-center"><strong>Find Your Best Method </strong></p></h4>
							</br> 	
							
							  <input type="submit" value="Best search" name="best" class="btn btn-raised btn-success" style="float:right" />
							 <!-- <input type="submit" value="Less Price" name="price"  class="btn btn-raised btn-primary" style="float:right"/>
							  <input type="submit" value="Less Time" name="time"  class="btn btn-raised btn-primary" style="float:right" /> --!>
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
                        <script>
	function initialize() {
		var $latitude = document.getElementById('latitude');
		var $longitude = document.getElementById('longitude');
		var latitude = 10.380;
		var longitude = 76.398;
		var zoom = 8;
		
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
      
		
		var marker = new google.maps.Marker({
			position: LatLng,
			map: map,
			title: 'Drag Me!',
			draggable: true
		});
		
		google.maps.event.addListener(marker, 'dragend', function(marker){
			var latLng = marker.latLng;
			$latitude.value = latLng.lat();
			$longitude.value = latLng.lng();
		});
		
		
	}
	initialize();
	</script>
        
     <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>
    </body>
</html>

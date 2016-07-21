<?php
include_once 'config/dbc.php';
/*
echo $_POST["shop_name"];
echo $_POST["description"];
echo $_POST["price"];
echo $_POST["latitude"];
echo $_POST["longitude"];*/
$product = $_GET["sid"];
//echo $product;

if ($_POST['submit'] == 'Update')
{
$errors = array();
if (empty($product)) {
    $errors['shopnameErr']= "No Product Selected."; 
  	} 	
if (!$errors) { 		
// Get parameters from URL
session_start(); 
	if(!empty($_POST["shop_name"])){
	$sql = "UPDATE sell
	 SET prod_name = '$_POST[shop_name]' 
	 WHERE sell_id = '$product'";
	 $result=mysql_query($sql);
    	if (!$result) {
    	die('Invalid query: ' . mysql_error());
    	}
	}
	if(!empty($_POST["description"])){
	$sql = "UPDATE sell
	 SET prod_description = '$_POST[description]' 
	 WHERE sell_id = '$product'";
	 $result=mysql_query($sql);
    	if (!$result) {
    	die('Invalid query: ' . mysql_error());
    	}
	}
	if(!empty($_POST["price"])){
	$sql = "UPDATE sell
	 SET prod_price = '$_POST[price]' 
	 WHERE sell_id = '$product'";
	 $result=mysql_query($sql);
    	if (!$result) {
    	die('Invalid query: ' . mysql_error());
    	}
	}		
	if(!empty($_POST["latitude"]) && !empty($_POST["longitude"])){
	$sql = "UPDATE sell
	 SET sell_lat='$_POST[latitude]' ,sell_lon='$_POST[longitude]'
	 WHERE sell_id = '$product'";
	 $result=mysql_query($sql);
    	if (!$result) {
    	die('Invalid query: ' . mysql_error());
    	}
	}
	mysql_close($link);
			$sucess = array();
    		$sucess['sucess'] = "Sucessfully Updated Information" ;

}
}
?>

<html>
   <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/roboto.min.css" rel="stylesheet">
        <link href="css/material.min.css" rel="stylesheet">
        <link href="css/ripples.min.css" rel="stylesheet">  
    	<link href="font/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-fileupload.css" />
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
            						 <?php include 'top_bar_sell.php';?>
              <?php if (!empty($errors)){
  			?>
    		<div class="alert alert-dismissible alert-danger">
  			<button type="button" class="close" data-dismiss="alert">×</button>
  			<strong>Error!</strong>
  				<?php echo '<ul></br>';
				foreach($errors as $error) {
    			echo "<li>$error</li>";
				}
				echo '</ul>';		
				?>
				</div>
   				 <?php }?>	
              <?php if (!empty($sucess)){
  			?>
    		<div class="alert alert-dismissible alert-success">
  			<button type="button" class="close" data-dismiss="alert">×</button>
  			<strong>Sucess !</strong>
  				<?php echo '<ul></br>';
				foreach($sucess as $error) {
    			echo "<li>$error</li>";
				}
				echo '</ul>';		
				?>
				</div>
   				 <?php }?>	
   				
   			
   						<form name="form1" method="post"  enctype="multipart/form-data" action="update_sell_item.php?sid=<?php echo $product; ?>" >						
						<!--<h3><p class="text-center"><strong>Add New item</strong></p></h3></br>--!>

						<div class="panel panel-body">							
						<h4><p class="text-center"><strong>Update Product Basic Details</strong></p></h4>						
						<p align="center">  
  							<div class="form-control"><input name="shop_name" type="text" id="shop_name" placeholder="Name"/></div>
						</p>
						<p align="center"> 						
           			 		<div class="form-control"><input name="description" type="text" id="description" placeholder="Description"/></div>
						</p>
						<p align="center"> 						
           			 		<div class="form-control"><input name="price"  type="number" id="price" placeholder="Price"/></div>
						</p>
            			</div>
	
            
						<div class="panel panel-body panel-primary">
						<h4><p class="text-center"><strong>Update Product Location by Dragging The Map</strong></p></h4>
						                    	  	<input name="latitude" type="text" id="latitude" placeholder="latitude">
  													<input name="longitude" type="text" id="longitude" placeholder="longitude">
							 <div id="map" style="width:100%; height:500px"></div>
							 
							</br> 						
 						<p align="center"> 
          				<input class="btn btn-primary" type="submit" name="submit" value="Update">
        				</p>
						</div>
       
   						</form> 


     
   					    </div>
			</div>
			
				
		</div>


 <?php include 'footer.php';?>

 </div>
 
        <script src="js/jquery-1.10.2.min.js"></script>
      	<script src="js/bootstrap.min.js"></script>
        <script src="js/ripples.min.js"></script>
        <script src="js/material.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-fileupload.js"></script>

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

<?php 
if ($_POST['submit'] == 'Add')
{

$errors = array();
  	
  	if (empty($_POST["shop_name"])) {
    //$firstnameErr = "First Name is Required. ";
    $errors['shopnameErr']= "Shop Name is Required."; 
  	} 
    //$firstname = test_input($_POST["firstname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$_POST["shop_name"])) {
      //$firstnameErr = "Only letters and white space allowed. "; 
      $errors['shopname']= "Only letters and white space allowed in Shop Name. "; 
    }
	

  	if (empty($_POST["tag_line"])) {
    //$lastnameErr  = "Last Name is Required. ";
    $errors['tag_lineErr']= "Tag Line is Required. ";
  	} //else {
   // $lastname = test_input($_POST["lastname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$_POST["tag_line"])) {
     //$lastnameErr  = "Only letters and white space allowed"; 
     $errors['tag_line']="Only letters and white space allowed in Tag Line"; 
    }
  //  }


  if (empty($_POST["address_line"])) {
    //$emailErr = "Email id is Required. ";
    $errors['address_lineErr']="Address required. ";
  } 

  if (empty($_POST['contact_num'])) {
   // $pass1Err = "Password is Required. ";
   $errors['contact_num']= "Contact Number is Required. ";
  }

 if (empty($_POST["latitude"])) {
   // $pass1Err = "Password is Required. ";
   $errors['latitude']= "Location Details is Required. ";
  }
  if (empty($_POST["longitude"])) {
   // $pass1Err = "Password is Required. ";
   $errors['longitude']= "Location Details is Required.. ";
  }
    
    
     if (!$errors) {

   	 include ('config/dbc.php'); 
   	 session_start(); 
			$sql="INSERT INTO shop (shop_id,shop_name,shop_tag,shop_website,shop_address,shop_contact,shop_lat,shop_lon,user_id)VALUES('','$_POST[shop_name]','$_POST[tag_line]','$_POST[website]','$_POST[address_line]','$_POST[contact_num]','$_POST[latitude]','$_POST[longitude]','$_SESSION[id]')";
			$result= mysql_query($sql) or die(mysql_error());
			mysql_close($link);
            
			$sucess = array();
    		$sucess['sucess'] = "Sucessfuly Added Shop" ;

                }
    
    
    }

?> 
<html>
   <head>
   <title>Add Shop</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/roboto.min.css" rel="stylesheet">
        <link href="css/material.min.css" rel="stylesheet">
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
   
   
            
            			<div class="panel panel-body panel-primary">
            			
            			<form name="form1" method="post" action="ad_new_shop.php">
							<h3><p class="text-center"><strong>Add Shop</strong></p></h3>
						<p align="center">  
  							<input type="text" name="shop_name" class="form-control"  placeholder="Shop Name" />
						</p>
						<p align="center">  
  							<input type="text" name="tag_line" class="form-control"  placeholder="Tagline" />
						</p>
						<p align="center">  
  							<input type="text" name="website" class="form-control"  placeholder="Website" />
						</p>
						<p align="center">  
  							<input type="text" name="address_line" class="form-control"  placeholder="Address Line" />
						</p>
						<p align="center">
  							<input type="text" name="contact_num" class="form-control"  placeholder="Contact Number" />
						</p>
						
						<p align="center">  
       					<div class="form-group">
      					<label for="inputFile" class="col-md-2 control-label">Logo</label>
      					<div class="col-md-10">
        				<input type="file" class="form-control" id="inputFile" multiple=" placeholder="Browse..."">
      					</div>
    					</div>
						</p>
						
						
            			</div>
            
						<div class="panel panel-body panel-primary">
						<h4><p class="text-center"><strong>Add Your Shop Location by Dragging The Map</strong></p></h4>
						                    	  	<input name="latitude" type="text" id="latitude" placeholder="latitude">
  													<input name="longitude" type="text" id="longitude" placeholder="longitude">
							 <div id="map" style="width:100%; height:500px"></div>
							 
							</br> 						
 						<p align="center"> 
          				<input class="btn btn-primary" type="submit" name="submit" value="Add">
        				</p>
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

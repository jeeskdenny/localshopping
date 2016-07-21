<?php
include_once 'config/dbc.php';
/*echo $_POST["shop_name"];
echo $_POST["sub_category"];
echo $_POST["description"];
echo $_POST["price"];
echo $_POST["latitude"];
echo $_POST["longitude"];*/

if ($_POST['submit'] == 'Add')
{
$errors = array();

if (empty($_POST["shop_name"])) {
    $errors['shopnameErr']= "Product Name is Required."; 
  	} 
if (empty($_POST["sub_category"])) {
    $errors['CatErr']= "Category Name is Required."; 
  	}

if (empty($_POST["description"])) {
    $errors['description']= "Product Description is Required. ";
  	}
if (empty($_POST["price"])) {
    $errors['price']= "Product Price is Required. ";
  	}
  	
 
 if (empty($_POST["latitude"])) {
   $errors['latitude']= "Location Details is Required. ";
  }
  if (empty($_POST["longitude"])) {
   $errors['longitude']= "Location Details is Required.. ";
  }
     	
 function rand_string( $length ) {

    $chars = "abcdefghijklmnopqrstuvwxyz";
    return substr(str_shuffle($chars),0,$length);

} 	
  	
      $tmp=$_FILES["passport"]["tmp_name"];
      $extension = explode("/", $_FILES["passport"]["type"]);
	  $ext=$extension[1];
	  $random_pass = rand_string(5);
	  
	  date_default_timezone_set("Asia/Kolkata");
	  $date = date("d_m_y_h_i_s_A");
	  $dat = date("y-m-d h:i:s");
      $rename=$date.$random_pass.".".$extension[1];
	  

$target_dir = "img/uploads/";
$target_file = $target_dir . basename($_FILES["passport"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["passport"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
		$errors['not_img']= "File is not an image.";
        //echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
	$errors['not_exi']= "Sorry, file already exists.";
    //echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["passport"]["size"] > 500000) {
    $errors['not_lar']= "Sorry, your file is too large.";
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
	$errors['not_file']= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

	  
   if (!$errors) {	  
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	$errors['not_file']= "Sorry, your file was not uploaded.";
   //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    move_uploaded_file($tmp, "img/upload/" . $rename);
}
session_start(); 
$sql = "INSERT INTO sell (sell_id,category_id,sub_category_id,prod_name,prod_price,prod_description,prod_img,added_date,sell_lat,sell_lon,user_id)
VALUES ( '','','$_POST[sub_category]','$_POST[shop_name]','$_POST[price]','$_POST[description]','$rename','$dat','$_POST[latitude]','$_POST[longitude]','$_SESSION[id]')";

$result=mysql_query($sql);
    if (!$result) {
    die('Invalid query: ' . mysql_error());
    }
mysql_close($link);
            
			$sucess = array();
    		$sucess['sucess'] = "Sucessfuly Added Product" ;
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
   				 
   						<div class="panel panel-body ">	
   						<form name="form1" method="post"  enctype="multipart/form-data" action="ad_single_item.php" >						
						<!--<h3><p class="text-center"><strong>Add New item</strong></p></h3></br>--!>
						
						<h4><p class="text-center"><strong>Select Category</strong></p></h4>						
							
						<?php 
	  						include 'config/dbc.php';
	  						require_once 'config/functions.php';
							$query="SELECT * FROM category";
     			 			$result=mysql_query($query);
								while ($row = mysql_fetch_array($result)){
								echo '<div class="col-xs-6 col-md-3">';                                                                           				
								echo '<a href="ad_single_item.php?cid=',$row['category_id'],'" class="btn btn-success btn-fab btn-fab-mini"></a>'; 
								echo '<div class="caption">';                                                                           
                      			echo "<td>",$row['category_name'],"</td>";
                      			echo '</div>';
                      			echo '</div>';

                      			}
						 ?>
						
            			</div>
            			<?php 
            			if (isset($_GET['cid'])) {
      						$sub_category = show_sub_category($_GET['cid']);
      							if ($sub_category) {
								
      							echo '<div class="panel panel-body ">'; 
      							echo '<h4><p class="text-center"><strong>Select Sub Category</strong></p></h4>	';
    							//echo $sub_category;
      							//print_r($sub_category);
      							echo '<p align="center">';
      							echo '<select name="sub_category"  id="select" placeholder="subcategory">';
      							$arrlength=count($sub_category);
      							for($x=0;$x<$arrlength;$x++)
 								 {
  									echo '<option>',$sub_category[$x]['sub_cat_name'],'</option>';
  									echo "<br>";
  								}
  				 				echo '</select>';  
        						echo '</p>'; 
      							echo '</div>';
    							}
    						} 
						?>
            			
            		 	
						<div class="panel panel-body">							
						<h4><p class="text-center"><strong>Product Basic Details</strong></p></h4>						
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
									<h4><p class="text-center"><strong>Product Image</strong></p></h4>
										<div class="form-group last">
											<div class="col-md-9">
												<div class="fileupload fileupload-new" data-provides="fileupload">
													<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
														<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
													</div>
													<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
													<div>
															   <span class="btn btn-white btn-file">
															   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
															   <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
															   <input type="file" class="default" name="passport"  id="passport"/>
															   </span>
														<a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
													</div>
												</div>
											</div>
										</div>
												
						</div>
            			
            
						<div class="panel panel-body panel-primary">
						<h4><p class="text-center"><strong>Add Your Product Location by Dragging The Map</strong></p></h4>
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

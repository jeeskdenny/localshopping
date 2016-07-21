


<html>
   <head>
   
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/roboto.min.css" rel="stylesheet">
        <link href="css/material.min.css" rel="stylesheet">
        <link href="css/ripples.min.css" rel="stylesheet">
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
		 
		 		<div class="jumbotron">
  				<h1>Welcome</h1>
<h2>
Enhancing and Speeding-Up Online Shopping: Location Based Approach built up in Web Application
</h2>
</br>
  				<p>Here we present a Smart Shopping System to provide customers with a smart shopping experience with a lowest budget. The proposed system allows a user to view real-time positioning of products via a mobile handset. The Geo-position of the user’s mobile device is utilized to produce location information in shopping application. In addition to purchasing products, the user can use his account for different needs. For example, the user can reserve a train ticket using the same account, which is used to purchase the products. Like doing reservation in train, the user can use single account for different needs, such asnet banking, access to the social networks, access to office account, and all other accounts related to the user.</p>

  				
				</div>
		 
			</div>
		</div>


 <?php include 'footer.php';?>

 </div>
 
        <script src="js/jquery-1.10.2.min.js"></script>
      	<script src="js/bootstrap.min.js"></script>
        <script src="js/ripples.min.js"></script>
        <script src="js/material.min.js"></script>
     <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>
    </body>
</html>

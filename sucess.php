


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
             <?php  include 'manage_sidebar.php';?>
           	  </div>
           	  
            <div class="col-sm-10">
		 
		 		<div class="panel panel-primary">
  					<div class="panel-heading">
   						 <h3 class="panel-title">Panel primary</h3>
  					</div>
  					<div class="panel-body">
   					 
   					 
   					 
   					  Result of form displayed here..
   					  <?php
   					  $lat = $_POST["latitude"];
   					  $lon = $_POST["longitude"];
   					  
   					  echo $lat;
   					  echo $lon;
   					  
   					  ?>
   					  
  					</div>
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

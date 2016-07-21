	
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
            		 	
						<?php
							$radius = $_POST["km"];						
							$lat = $_POST["latitude"];
							$lon = $_POST["longitude"];
							 
				
							?>
						    						    
						<div class="panel panel-body">
						
						<?php
						if($_POST["best"]) {
						?>
  						 <?php  include 'best_search.php';?>
						<?php } ?>
						
						<?php 
						if($_POST["price"]) {
						?>
						
						<?php  } ?>
						
						<?php
						if($_POST["time"]) { 
						?>

						<?php } ?>
						
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

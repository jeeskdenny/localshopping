<html>
   <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/roboto.min.css" rel="stylesheet">
        <link href="css/material.css" rel="stylesheet">
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
            		 	<div class="panel panel-body panel-primary">
							<a href="ad_single_item.php" class="btn btn-success btn-fab btn-fab-mini"  class="icon-preview" ><i class="mdi-action-note-add"></i> </a>
							<a href="#" class="btn btn-warning btn-fab btn-fab-mini"  class="icon-preview" ><i class="mdi-action-cached"></i> </a>		
							<a href="#" class="btn btn-danger btn-fab btn-fab-mini"  class="icon-preview" ><i class="mdi-action-delete"></i> </a>	

							</br>

							
						</div>
						<div class="panel panel-body">


      <?php
	  include 'config/dbc.php';
	  session_start(); 

	  echo '<div class="list-group">';
	  $query="SELECT * FROM sell WHERE sell_id = '$_GET[sid]'";
      $result=mysql_query($query);
      $row = mysql_fetch_array($result);
        echo '<div class="list-group-item">';
        	echo '<div class="row-picture">';
        		echo'<img src="img/upload/'.$row['prod_img'].'" alt="icon">';
        	echo '</div>';
        	
	        echo ' <div class="row-content">';
	        
		        echo '<div class="least-content">';
		        echo $row['added_date'];		        	
		        echo '</div>';
		        
		        echo '<div class="action-secondary">';
		        echo $row['prod_price'];		        	
		        echo '</div>';
		        
		        echo '<h4 class="list-group-item-heading">';
		        echo '<a href="sell_prod_ful_view.php?sid=',$row['sell_id'],'">';
		        echo $row['prod_name'];		        	
		        echo '</a>';
		        echo '</h4>';
		        
		        echo '<p class="list-group-item-text">';
		        echo $row['prod_description'];	
		        echo '</p>';
		        
        	echo '</div>';
      echo '</div>';
	  echo '<div class="list-group-separator">';
      echo '</div>';
		        
      
	  echo '</div>';
    ?>
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

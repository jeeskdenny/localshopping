	
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
						<!--<h3><p class="text-center"><strong>Add New item</strong></p></h3></br>--!>
						
						<h4><p class="text-center"><strong>Select Category</strong></p></h4>						
							
						<?php 
	  						include 'config/dbc.php';
	  						require_once 'config/functions.php';
							$query="SELECT * FROM category";
     			 			$result=mysql_query($query);
								while ($row = mysql_fetch_array($result)){
								echo '<div class="col-xs-6 col-md-3">';                                                                           				
								echo '<a href="buy.php?cid=',$row['category_id'],'" class="btn btn-success btn-fab btn-fab-mini"></a>'; 
								echo '<div class="caption">';                                                                           
                      			echo "<td>",$row['category_name'],"</td>";
                      			echo '</div>';
                      			echo '</div>';

                      			}
						 ?>
						
            			</div>
            			<?php 
            			/*if (isset($_GET['cid'])) {
      						$sub_category = show_sub_category($_GET['cid']);
      							if ($sub_category) {
								
      							echo '<div class="panel panel-body ">'; 
      							echo '<h4><p class="text-center"><strong>Select Sub Category</strong></p></h4>	';
    							//echo $sub_category;
      							print_r($sub_category);
      							echo '<p align="center">';
      							echo '<select name="sub_category" class="form-control" id="select" placeholder="subcategory">';
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
    						} */
    						
							if (isset($_GET['sid'])&&isset($_GET['sname'])) {
      						add_to_cart($_GET['sid'],$_SESSION['id'],$_GET['sname']);
    						}
	
            			if (isset($_GET['cid'])) {
      						$sub_category = show_sub_category($_GET['cid']);
      							if ($sub_category) {
							 echo '<div class="panel panel-body ">'; 
							 echo '<p align="center">';
							 echo '<h4><p class="text-center"><strong>Select Sub Category</strong></p></h4></br>	';

      						echo '<table class="table table-striped table-hover table-responsive">';
      						echo "<thead>";
      						echo "<th>Sl.No</th>";
      						echo "<th>Id</th>";
      						echo "<th>Name</th>";
      						echo "<th>Options</th>";
      						echo "</thead>";
      						echo '<tbody>';
      						$arrlength=count($sub_category);
      						for($x=0,$y=1;$x<$arrlength;$x++,$y++)
 							{
        					echo "<tr>";
        					echo "<td>",$y,"</td>";
        					echo "<td>",$sub_category[$x]['sub_cat_id'],"</td>";
        					echo "<td>",$sub_category[$x]['sub_cat_name'],"</td>";        
        					echo '<td><a href="buy.php?sid=',$sub_category[$x]['sub_cat_id'],'&sname=',$sub_category[$x]['sub_cat_name'],'" class="btn btn-info btn-raised"><i class="mdi-action-note-add"></i></a></td>';                                                                            
        					echo "</tr>";
      						}
      						echo '</p>'; 
      							echo '</div>';
      							}
    								} 
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

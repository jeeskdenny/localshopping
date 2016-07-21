<?php 
include_once 'config/dbc.php';
session_start();		
$query="SELECT * FROM users WHERE id = '$_SESSION[id]'";
$result=mysql_query($query);
while ($row = mysql_fetch_array($result)){
        $name= $row['first_name'];
       
        $adress_1 = $row['address_1'];
        $adress_2=$row['address_2'];
      }						
     	
?>
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
		 
		 
				<div class="row">
					<div class="col-lg-6">
						<div class="panel panel-body panel-primary">
							<img class="img-circle center-block" src="img/apolegy.jpg" alt="..." />
								<address>
										<p class="text-center">
										<strong><?php echo $name; ?></strong><br>
										<strong>
										<?php echo $_SESSION['user'] ?></br>
										<?php echo $adress_1; ?></br>
										<?php echo $adress_2; ?></br>	</strong>
										</p>
								</address>
								<a href="bas_prof_upd.php" class="btn btn-warning btn-fab btn-fab-mini"  class="icon-preview" style="float:right"><i class="mdi-action-thumb-down"></i> </a>
                    	


						</div>
					</div>
					<div class="col-lg-6">
						<div class="panel panel-body panel-primary">
						<h4><p class="text-center"><strong>Shop Details</strong></p></h4>
							</br>
							<?php include 'shoplist.php';?>	
							
	 
							</br>
							<a href="ad_new_shop.php" class="btn btn-success btn-fab btn-fab-mini"  class="icon-preview" style="float:right"><i class="mdi-action-note-add"></i> </a>

							
						</div>
						<div class="panel panel-body alert-success">
							<h4 class="text-center">Purchase History</h4>
							<h2 class="text-center">Your last purchase ....</h2>
						</div>
					</div>
				</div>
				<div class="row">

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

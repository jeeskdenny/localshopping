<?php
	include_once 'config/dbc.php';
	
	if ($_POST['submit'] == 'Update')
	{
	$errors = array();
	
	if (empty($_POST["address_1"])) {
    $errors['shopnameErr']= "Address Line 1 is Required."; 
  	} 
  	
	if (empty($_POST["address_2"])) {
    $errors['shopnameErr']= "Address Line 2 is Required."; 
  	} 
	if (!$errors){
	session_start(); 
	
	$sql = "UPDATE users
	 SET address_1= '$_POST[address_1]', address_2='$_POST[address_2]' 
	 WHERE id = '$_SESSION[id]'";
	 
	$result=mysql_query($sql);
    	if (!$result) {
    	die('Invalid query: ' . mysql_error());
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
							<h3><p class="text-center"><strong>Edit Profile</strong></p></h3>
                    				<form name="form1" method="post" action="bas_prof_upd.php">
        							  <p>&nbsp;</p>

        								<p align="center">
         								<input name="address_1" type="address_1" class="form-control" id="fullname" placeholder="Address Line 1">
        								</p>
        								<p align="center">  
          								<input name="address_2"  id="address_2" type="name" class="form-control" placeholder="Address Line 2">
        								</p>
        								<p align="center"> 
          								<input class="btn btn-primary" type="submit" name="submit" value="Update">
        								</p>
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
     <script>
            $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
            });
        </script>
    </body>
</html>

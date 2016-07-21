<?php
session_start();

  		include 'config/dbc.php';
  		require_once 'config/functions.php';
  		log_in_check();
  		$error= "";
  		if (isset($_POST['submit'])) {
  			$password = $_POST["pwd"];
    		$username= $_POST["email"];
    		$found_user = attempt_login($username,$password);
				if ($found_user) {
				    session_start(); 
        			$_SESSION['id']= $found_user["id"];
       				$_SESSION['user']= $found_user["email_id"];
        			redirect_to_page("my_account.php");
    			}else {
       				$error="Username or Password is Incorrect";	
   		 		}
   		 }
    	mysql_close($link);
?>  		

<html>
    <head>
    <title>Shopunified | Login </title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/roboto.min.css" rel="stylesheet">
        <link href="css/material.min.css" rel="stylesheet">
        <link href="css/ripples.min.css" rel="stylesheet">
    </head>
    <style type="text/css">
    	body {
    	background-image: url("img/bgi.jpg");
		}
		.wrapper{
		position:absolute;
		top: 0; left: 0; right: 0; bottom: 0;
		margin:10%;
		height:auto;
		}
		</style>
        
    <body>

<div class="wrapper">
<div class="container">
   <div class="row">
    <div class="col-md-4"> 
	  </div>
	  
  	  <div class="col-md-4"> 
  	   	<?php
  		if (!empty($error))
  		{ ?>	
  	 	<div class="alert alert-dismissible alert-danger">
 		<button type="button" class="close" data-dismiss="alert">×</button>
  		<strong>Error!</strong>
  		<?php echo " " . $error . "<br>";?>
		</div>
  		<?php unset($_SESSION['sucess']); }?>
  		
  		<?php
  		if(isset($_SESSION['err']))
  		{ ?>
  	 	<div class="alert alert-dismissible alert-success">
 		<button type="button" class="close" data-dismiss="alert">×</button>
  		<strong>Error!</strong> 
  		<?php echo " " . $_SESSION['err'] . "<br>";?>
		</div>
  		<?php unset($_SESSION['err']); }?>
  		
  	 	
  	 	<?php
  		if(isset($_SESSION['sucess']))
  		{ ?>
  	 	<div class="alert alert-dismissible alert-success">
 		<button type="button" class="close" data-dismiss="alert">×</button>
  		<strong>Well done!</strong> 
  		<?php echo " " . $_SESSION['sucess'] . "<br>";?>
		</div>
  		<?php unset($_SESSION['sucess']); }?>
  		
  		
		 
		 <div class="panel panel-body"> 
  		<div align="center"><font size="5"><strong>Login</strong></font></div>

    	  <form name="form2" method="post" action="login.php">
        <p>&nbsp;</p>
        <p align="center">
         <input name="email" type="email" class="form-control " id="email" placeholder="Email">
        </p>
        <p align="center">  
          <input name="pwd"  id="pwd" type="password" class="form-control"  placeholder="Password">
        </p>
        <p align="center"> 
          <input class="btn btn-primary" type="submit" name="submit" value="submit">
        </p>
        <p align="center"><a href="register.php">New User Register</a> | <a href="forgot.php">Forgot Password</a></p>
      </form>
      </div>
	</div>
  </div>
</div>
</div>
		<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

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

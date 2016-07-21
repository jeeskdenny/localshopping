<?php
include 'config/dbc.php';
if ($_POST['Submit']=='send'){

$errors = array();

	if(!empty($_POST['email']) && !empty($_POST['email1'])){
	
		if(strcmp($_POST['email'],$_POST['email1'])){
			$errors['first']="Email Address Filed do not match";
		}else{
			//$host = $_SERVER['HTTP_HOST'];
			$result = mysql_query("SELECT email_id FROM users WHERE email_id='$_POST[email]'");
			$user_count = mysql_num_rows($result);

				if ($user_count==1){
					$newpwd = rand(1000,9999);
					$host = $_SERVER['HTTP_HOST'];
					$newmd5pwd = md5($newpwd);
					mysql_query("UPDATE users SET activation='$newmd5pwd' WHERE email_id='$_POST[email]'");
					/*
						$to = $_POST['email'];
						$subject = "Shopunified | Forgot Password";
						$txt = "localhost:8888/localshopping/login.php?msg=" . $newpwd ;
						$headers = "From: example@examble.com" . "\r\n";
						mail($to,$subject,$txt,$headers);
						if($mail){
 						echo "success";
 						}else{
 						echo "failed."; 
  						}*/

				} else die("Account with given email does not exist");
		}
	}else{
	$errors['second'] ="Please Enter Email Address";
	
	}
}
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
  	  
  	    <div class="panel panel-body"> 
  		<div align="center"><font size="5"><strong>Forgot Password</strong></font></div>
    	  <form name="form3" method="post" action="forgot.php">
        <p>&nbsp;</p>
        <p align="center">
         <input name="email" type="email" class="form-control" id="email" placeholder="Email">
        </p>
        <p align="center">
         <input name="email1" type="email" class="form-control" id="email1" placeholder="Renter Email">
        </p>       
        <p align="center"> 
          <input class="btn btn-primary" type="submit" name="Submit" value="send">
        </p>
        <p align="center"><a href="login.php">Login</a> | <a href="register.php">New User Register</a></p>

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

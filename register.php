<?php 
session_start();

include ('config/dbc.php'); 


if ($_POST['Submit'] == 'Register')
{
//$firstnameErr = $lastnameErr = $emailErr = $pass1Err = $pass2Err = $verifErr = $emailerror=  "";
//$firstname  = $lastname = $email = $pass1 = $pass2 = $verif = "";  
$errors = array();
  	
  	if (empty($_POST["firstname"])) {
    //$firstnameErr = "First Name is Required. ";
    $errors['firstnameErr']= "First Name is Required."; 
  	} 
    //$firstname = test_input($_POST["firstname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$_POST["firstname"])) {
      //$firstnameErr = "Only letters and white space allowed. "; 
      $errors['firstname']= "Only letters and white space allowed in First name. "; 
    }
	

  	if (empty($_POST["lastname"])) {
    //$lastnameErr  = "Last Name is Required. ";
    $errors['lastnameErr']= "Last Name is Required. ";
  	} //else {
   // $lastname = test_input($_POST["lastname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$_POST["lastname"])) {
     //$lastnameErr  = "Only letters and white space allowed"; 
     $errors['lastname']="Only letters and white space allowed in Last name"; 
    }
  //  }


  if (empty($_POST["email"])) {
    //$emailErr = "Email id is Required. ";
    $errors['emailErr']="Email id is Required. ";
  } else {
    //$email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      //$emailErr = "Invalid Email Format"; 
      $errors['email']= "Invalid Email Format";
    }
  }


  if (empty($_POST['pass1']) && empty($_POST['pass2'])) {
   // $pass1Err = "Password is Required. ";
   $errors['pass1']= "Password is Required. ";
  }elseif(strcmp($_POST['pass1'],$_POST['pass2']))
    { 
   // $pass2Err = "Password does not match ";
    $errors['pass2']="Password does not match ";
    }else{
    $pass1 = $_POST['pass1'];
    }
    
   
    if (strcmp(md5($_POST['user_code']),$_SESSION['vkey']))
    { 
             //$verifErr="Invalid Verification Code. ";
             $errors['verifErr']= "Invalid Verification Code. ";
        } 
    $rs_duplicates = mysql_query("select id from users where email_id='$_POST[email]'");
    $duplicates = mysql_num_rows($rs_duplicates);
    
    if ($duplicates > 0)
    {   
    //$emailerror="User account already exists";
     $errors['emailerror']= "User account already exists";
    //die ("ERROR: User account already exists.");
    //header("Location: register.php?msg=$errors");
    }
    
        
     
     if (!$errors) {
    $md5pass = md5($_POST['pass1']);
    
    mysql_query("INSERT INTO users
                  (`id`,`first_name`,`last_name`,`email_id`,`password`,`address_1`,`address_2`)
                  VALUES
                  ('','$_POST[firstname]','$_POST[lastname]','$_POST[email]','$md5pass','','')") or die(mysql_error());
    
    unset($_SESSION['vkey']);
    //echo("Registration Successful! "); 
    $_SESSION['sucess'] = "Registration Successful! Please Login to Continue";
    header("Location: login.php");

    exit(); 
    }
    } 

?> 



<html>
    <head>
    <title>Shopunified | Register </title>
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
		margin:5%;
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
	<div align="center"><font size="5"><strong>Register</strong></font></div>
    <form name="form1" method="post" action="register.php">
        <p>&nbsp;</p>

        <p align="center">
         <input name="firstname" type="firstname" class="form-control" id="fullname" placeholder="First Name">
        </p>
        <p align="center">  
          <input name="lastname"  id="lastname" type="name" class="form-control" placeholder="Last Name">
        </p>
         <p align="center">
         <input name="email" type="email" class="form-control"id="email" placeholder="Email">
        </p>
        <p align="center">  
          <input name="pass1"  id="pwd" type="password" class="form-control"  placeholder="Password">
        </p>
        <p align="center">  
          <input name="pass2"  id="pwd" type="password" class="form-control"  placeholder="Renter Password">
        </p>
        <p align="center"> 
          <input name="user_code" type="text" size="10" class="form-control" placeholder="Enter verification code" >
          <img src="pngimg.php" align="left">&nbsp;
        </p>  </br>
        <p align="center"> 
          <input class="btn btn-primary" type="submit" name="Submit" value="Register">
        </p>
        <p align="center"><a href="login.php">Login</a> | <a href="forgot.php">Forgot Password</a></p>
      </form>
      </div>
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

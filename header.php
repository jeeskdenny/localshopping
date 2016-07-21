<?php
      session_start();
  	  require_once 'config/functions.php';
	  log_in_chek_status();  
	                 
	 ?>
	  
	<div class="row">
     <div class="col-lg-12">
        <div class="bs-component">
          <div class="navbar navbar-default">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="my_account.php"><div class="icon-preview"><i class="mdi-action-home"></i></div>Shopunified</a>
              </div>
              <div class="navbar-collapse collapse navbar-responsive-collapse">
   
                <form class="navbar-form navbar-left">
                  <div class="form-group">
                    <input type="text" class="form-control col-md-8" placeholder="Search">
                  </div>
                </form>
                
                
                
                <ul class="nav navbar-nav navbar-right">    
                
        		<li><a href="cartt.php"><div class="icon-preview"><i class="mdi-action-add-shopping-cart"></i></div>Cart</a></li>


                  <li class="dropdown">
                    <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown"> 
                    Settings
                      <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="profile.php">Profile</a></li>
                      <li><a href="manage.php">Manage</a></li>
                      <li class="divider"></li>
                      <li><a href="logout.php">Logout</a></li>
                    </ul>

                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

</div>
</div> 
	  
      
    

      
    
     


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
		 
		 		<?php 
				include 'config/dbc.php';
				require_once 'config/functions.php';
				date_default_timezone_set("Asia/Kolkata");
				$date = date("Y-m-d");
				if (isset($_POST['submit'])) {
  				mysql_query("INSERT INTO employee 
                  (emp_id,emp_name,emp_email,emp_position,emp_add_date)
                  VALUES
                  ('','$_POST[name]','$_POST[email]','$_POST[level]','$date')") or die(mysql_error());
}
?>
						<div class="panel panel-body panel-primary">
							<a href="add_employee.php" class="btn btn-success btn-fab btn-fab-mini"  class="icon-preview" ><i class="mdi-action-note-add"></i> </a>
							<a href="upd_emp_pos.php" class="btn btn-warning btn-fab btn-fab-mini"  class="icon-preview" ><i class="mdi-action-cached"></i> </a>		
							<a href="dele_employee.php" class="btn btn-danger btn-fab btn-fab-mini"  class="icon-preview" ><i class="mdi-action-delete"></i> </a>	

							</br>

							
						</div>

<div class="panel panel-body">
 <form name="form1" method="post" action="add_employee.php">
         <P align="center"><legend>Add Employee</legend></p>

        <p>&nbsp;</p>
        <p align="center">
         
         <select name="level" class="form-control" id="select" placeholder="I am A">
                                                <option value="1">Manager</option>
                                                <option value="2">Clerk</option>
                                                <option value="3">Stock Handler</option>
                                               	<option value="4">Order Handler</option>  
                                            </select>
        </p>
        <p align="center">
         <input name="name" type="text" class="form-control" id="name" placeholder="Name">
        </p>
        <p align="center">  
          <input name="email"  id="email" type="email" class="form-control"  placeholder="Email">
        </p>
       
        <p align="center"> 
          <input class="btn btn-primary" type="submit" name="submit" value="submit">
        </p>
       
      </form>
     
    </div>	
		 		
		 	<div class="panel panel-body">
      <?php
    	if (isset($_GET['sid'])) {
      	delete_employee($_GET['sid']);
    }
      $query="SELECT * FROM employee";
      $result=mysql_query($query);
      echo '<table class="table table-striped table-hover table-responsive">';
      echo "<thead>";
      echo "<th>Id</th>";
      echo "<th>Name</th>";
      echo "<th>Email</th>";
      echo "<th>Position</th>";
      echo "<th>Add Date</th>";

      echo "<th>Options</th>";
      echo "</thead>";
      echo '<tbody>';
      while ($row = mysql_fetch_array($result)){
        echo "<tr>";
        echo "<td>",$row['emp_id'],"</td>";
        echo "<td>",$row['emp_name'],"</td>";
        echo "<td>",$row['emp_email'],"</td>";
        
        switch($row['emp_position'])
        {
        case 1: echo "<td>Manager</td>";break;
        case 2: echo "<td>Clerk</td>";break;
        case 3: echo "<td>Stock Handler</td>";break;
        case 4: echo "<td>Order Handler</td>";break;
        }

        echo "<td>",$row['emp_add_date'],"</td>";
        
        echo '<td><a href="add_employee.php?sid=',$row['emp_id'],'" class="btn btn-danger btn-raised"><i class="mdi-navigation-cancel"></i></a></td>';                                                                            
        echo "</tr>";
      }
      echo '</tbody>';
      echo '</table>';
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
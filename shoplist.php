   <?php
	  include 'config/dbc.php';
	     	 session_start(); 

	  echo '<div class="panel">';
	  $query="SELECT * FROM shop WHERE user_id = '$_SESSION[id]'";
      $result=mysql_query($query);
      echo '<table class="table table-striped table-hover table-responsive" border="1">';
      echo "<thead>";
      echo "<th>id</th>";
      echo "<th> Name</th>";
      echo "<th> Tagline</th>";
      echo "<th> Address</th>";
      echo "<th>Contact</th>";
      echo "</thead>";
      echo '<tbody>';
      while ($row = mysql_fetch_array($result)){
        echo "<tr>";
        echo "<td>",$row['shop_id'],"</td>";
        echo "<td>",$row['shop_name'],"</td>";
        echo "<td>",$row['shop_tag'],"</td>";
        echo "<td>",$row['shop_address'],"</td>";
        echo "<td>",$row['shop_contact'],"</td>";
        
        echo "</tr>";
      }
      echo '</tbody>';
      echo '</table>';
	  echo '</div>';
    ?>
<?php include_once 'paginating.php';?>


<?php 
 	function time_elapsed_string($datetime, $full = false) {
 	date_default_timezone_set("Asia/Kolkata");
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}?>

													<?php
													$per_page = 4;         // number of results to show per page
												
													
													
													$total_pages = ceil($your_res / $per_page);//total pages we going to have
													//-------------if page is setcheck------------------//
													if (isset($_GET['page'])) {
														$show_page = $_GET['page']; //current page
														if ($show_page > 0 && $show_page <= $total_pages) {
															$start = ($show_page - 1) * $per_page;
															$end = $start + $per_page;
														} else {
															// error - show first set of results
															$start = 0;              
															$end = $per_page;
														}
													} else {
														// if page isn't set, show first set of results
														$start = 0;
														$end = $per_page;
													}
													// display pagination
													
													
													$page = intval($_GET['page']);
													
													if ($page <= 0)
														$page = 1;
													 

														$reload = "http://localhost/localshopping/sell.php" . "&page=1";

														
														echo '<div class="pagination pagination-sm pull-right"><li>';
														if ($total_pages > 1) {
														    
															echo paginate($reload, $show_page, $total_pages);
															
														}

														echo "</li></div>";
														
														// display data in table
														echo "<table class='table table-bordered'>";
														echo "<thead><tr><th>Book id</th> <th>Book Name</th><th>Issued Date</th><th>Return Date</th></tr></thead>";
														// loop through results of database query, displaying them in the table 
														for ($i = $start; $i < $end; $i++) {
															// make sure that PHP doesn't try to show results that don't exist
															if ($i == $your_res) {
																break;
															}
															// echo out the contents of each row into a table
															//echo "<tr " . $cls . ">";
															echo '<td>' . mysql_result($reslt, $i, 'book_id') . '</td>';
															echo '<td>' . mysql_result($reslt, $i, 'book_name') . '</td>';
															echo '<td>' . mysql_result($reslt, $i, 'issue_date') . '</td>';
															echo '<td>' . mysql_result($reslt, $i, 'return_date') . '</td>';

															echo "</tr>";
														}       
														// close table>
													echo "</table>";
													// pagination
													?>
      <?php
	  include 'config/dbc.php';
	  session_start(); 

	  echo '<div class="list-group">';
	  $query="SELECT * FROM sell WHERE user_id = '$_SESSION[id]'";
      $result=mysql_query($query);
      while ($row = mysql_fetch_array($result)){
        echo '<div class="list-group-item">';
        	echo '<div class="row-picture">';
        		echo'<img src="img/upload/'.$row['prod_img'].'" alt="icon">';
        	echo '</div>';
        	
	        echo ' <div class="row-content">';
	        
		        echo '<div class="least-content">';
		        echo time_elapsed_string($row['added_date']);
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
		        
      }
	  echo '</div>';
    ?>
<?php include_once 'paginating.php';?>
											
      <?php
	  include 'config/dbc.php';
	  session_start(); 
	  $query="SELECT * FROM sell WHERE user_id = '$_SESSION[id]'";
      $result=mysql_query($query);
      		$your_res = mysql_num_rows($result);	
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
													 

			$reload = "http://localhost:8888/localshopping/delete_sell.php" . "?page=1";
			
			
			 echo '<div class="list-group">';

		for ($i = $start; $i < $end; $i++) {
		// make sure that PHP doesn't try to show results that don't exist
			if ($i == $your_res) {
			break;
			}
			// echo out the contents of each row 

      
            echo '<div class="list-group-item">';
        	echo '<div class="row-picture">';
        		echo'<img src="img/upload/' . mysql_result($result, $i, 'prod_img') .'" alt="icon">';
        	echo '</div>';
        	
	        echo ' <div class="row-content">';
	        
		        echo '<div class="least-content">';
		        //echo time_elapsed_string(mysql_result($result, $i, 'added_date'));
		        echo mysql_result($result, $i, 'added_date');		
		        echo '</div>';
		        
		        echo '<div class="action-secondary">';
		        echo mysql_result($result, $i, 'prod_price');
        		echo '<br><a href="delete_sell.php?sid=',mysql_result($result, $i, 'sell_id'),'" class="btn btn-danger btn-raised"><i class="mdi-navigation-cancel"></i></a></br>';                                                                            
		        	
		        //echo $row['prod_price'];		        	
		        echo '</div>';
		        
		        echo '<h4 class="list-group-item-heading">';
		        echo '<a href="sell_prod_ful_view.php?sid=',mysql_result($result, $i, 'sell_id'),'">';	
		        echo mysql_result($result, $i, 'prod_name');		        			        	        
		        //echo $row['prod_name'];		        	
		        echo '</a>';
		        echo '</h4>';
		        
		        echo '<p class="list-group-item-text">';
		        echo mysql_result($result, $i, 'prod_description');		        			        	        		        
		        //echo $row['prod_description'];	
		        echo '</p>';
		        
        	echo '</div>';
      echo '</div>';
	  echo '<div class="list-group-separator">';
      echo '</div>';
		        
 	}  
	  echo '</div>';     
	// close for loop >

														
			echo '<div class="pagination pagination-lg pull-right"><li>';
			if ($total_pages > 1) {
														    
			echo paginate($reload, $show_page, $total_pages);
															
			}

			echo "</li></div>";      
      
      	
    ?>
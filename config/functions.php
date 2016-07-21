<?php
function attempt_login($username,$password){
	//global $connection;

			$md5pass=md5($password);
            $query = "SELECT id,email_id FROM users WHERE 
            email_id = '$username' AND 
            password = '$md5pass'"; 
            $result = mysql_query($query);
            
			 if($user =mysql_fetch_assoc($result)){
            	return $user;

            }  else {
            	return null;
            }
}

function redirect_to_page($new_location) {
	header("Location:".$new_location);
	exit;
}

function log_in_chek_status()
{
     if (!isset($_SESSION['user'])&& !isset($_SESSION['id']))
         {
          $error="Invalid Session! Please Login to Continue";	
          $_SESSION['err']= $error;
          
          redirect_to_page("login.php");
        
         }
}
function log_in_check()
{
if (isset($_SESSION['user']))
         {
          redirect_to_page("my_account.php");
        
         }

}
 function delete_employee($user_id){
   if ($user_id>0) { 
    $sid=$user_id;
     $query ="DELETE  FROM employee WHERE emp_id = '$sid'";
     $result=mysql_query($query) or die("Query Failed".mysql_error());
   }
 }  
 
 function delete_sell($sell_id){
   if ($sell_id>0) { 
    $sid=$sell_id;
     $query ="DELETE  FROM sell WHERE sell_id = '$sid'";
     $result=mysql_query($query) or die("Query Failed".mysql_error());
   }
 }  
 function show_sub_category($category_id){
   if ($category_id>0) { 
    $cid=$category_id;
    $query="SELECT * FROM sub_category WHERE category_id = '$_GET[cid]'";
     //$query ="SELECT * FROM sub_category WHERE category_id = '$cid'";
     $result=mysql_query($query) or die("Query Failed".mysql_error());
		$rows = array();
		while ($row = mysql_fetch_assoc($result, MYSQL_ASSOC)) {
    	$rows[] = $row;
		}
		return $rows;
   }
 }  

 function add_to_cart($sub_cat_id,$session_id,$sub_cat_name){
  
   if (isset($sub_cat_id) && isset($session_id)) { 
    
    $query="INSERT INTO cart (cart_id,user_id,sub_cat_id,sub_cat_name) VALUES ('','$session_id','$sub_cat_id','$sub_cat_name')";
     $result=mysql_query($query) or die("Query Failed".mysql_error());
     /*if($result){
     redirect_to_page("buy.php");
     }*/
	 	
   }
 }  


function delete_cart($cart_id){
   if ($cart_id>0) { 
    $did=$cart_id;
     $query ="DELETE  FROM cart WHERE cart_id = '$did'";
     $result=mysql_query($query) or die("Query Failed".mysql_error());
   }
 }  
?>

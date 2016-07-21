<?php 
	/*echo $lat. "\n";
	echo $lon. "\n";
	echo $radius. "\n";
	$rad = $radius * 1000;*/
	
  		include 'config/dbc.php';
  		require_once 'config/functions.php';
  		
  		
// Get parameters from URL
$lat = $_GET["lat"];
$lon = $_GET["lng"];
$radius = $_GET["radius"];
//echo $lat."\n". $lon ."\n". $radius ."\n";

$product_name= array();
$n=0;
while(isset($_GET[$n])){
$product_name[]= $_GET[$n];
$n=$n+1;
}
//print_r($product_name);
//$imploded_arr = implode(',', $product_name);
//print_r($imploded_arr);

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Search the rows in the markers table
$query = sprintf("SELECT sell_id, prod_name, sell_lat, sell_lon, ( 3959 * acos( cos( radians('%s') ) * cos( radians( sell_lat ) ) * cos( radians( sell_lon ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( sell_lat ) ) ) ) AS distance FROM sell WHERE sub_category_id IN ('".implode("','",$product_name)."') HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
 
 mysql_real_escape_string($lat),
  mysql_real_escape_string($lon),
  mysql_real_escape_string($lat),
  mysql_real_escape_string($radius));
$result = mysql_query($query);

$result = mysql_query($query);
if (!$result) {
  die("Invalid query: " . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("sell_id", $row['sell_id']);
  $newnode->setAttribute("product_name", $row['prod_name']);
  $newnode->setAttribute("lat", $row['sell_lat']);
  $newnode->setAttribute("lng", $row['sell_lon']);
  $newnode->setAttribute("distance", $row['distance']);
}

echo $dom->saveXML();

<?php
$dbname = 'shopunified';
$link = mysql_connect("localhost","root","root") or die("Couldn't make connection.");
$db = mysql_select_db($dbname, $link) or die("Couldn't select database");
?>
<?php
 require_once 'config/functions.php';
session_start(); 
unset($_SESSION['user']);
unset($_SESSION['id']);
session_unset(); 
session_destroy(); 
redirect_to_page("index.php");
?> 

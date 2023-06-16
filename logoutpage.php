<?php 
include "inc.php";  
error_reporting(0);   
setcookie("username", '', time() -3600);
setcookie("password", '', time() -3600); 
unset($_SESSION['agentUsername']); 
unset($_SESSION['agentUserid']); 
unset($_SESSION['manualVoucherPin']);
unset($_SESSION['parentAgentId']);
session_destroy(); 
header('Location: login'); 
exit;  
?>
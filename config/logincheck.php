<?php 
if($_SESSION['agentUserid']=="" || $_SESSION['agentUsername']==""){ 
header("Location:".$fullurl."login");
exit(); }  
?>
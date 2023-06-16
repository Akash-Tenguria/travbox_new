<?php 
include "agenturlinc.php";

$rs=GetPageRecord('*','sys_userMaster','id=1'); 
$getcompanybasicinfo=mysqli_fetch_array($rs);
?>

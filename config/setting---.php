<?php
$systemname="Earn My Travel";
$footerversion="V. 3.0 - Earn My Travel"; 
$adminurl="https://travbizz.in/earnmytravel/masteradmin/";
$websiteurl="https://travbizz.in/earnmytravel/agent/";
$fullurl="https://travbizz.in/earnmytravel/agent/";
$logoutUrl="https://travbizz.in/earnmytravel/agent/";
$imgurl="https://travbizz.in/earnmytravel/masteradmin/upload/";
$cabimgurl="https://travbizz.in/earnmytravel/masteradmin/upload/";



$rs=GetPageRecord('*','sys_companyMaster','id=1'); 
$getcompanybasicinfo=mysqli_fetch_array($rs);
?>

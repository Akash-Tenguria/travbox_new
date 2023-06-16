<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$page='hotels';



if(decode($_REQUEST['i'])>0){

$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['i']).'" and agentId="'.$_SESSION['agentUserid'].'"');
$rest=mysqli_fetch_array($a);

}

if($_REQUEST['r']!=''){
$ab=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['r']).'" and agentId="'.$_SESSION['agentUserid'].'"');
$resreturn=mysqli_fetch_array($ab);
}

 



if($rest['id']!=''){
$a=GetPageRecord('*','flightBookingMaster',' id="'.$rest['id'].'" '); 
$editresult=mysqli_fetch_array($a); 
 
 
} 



 
$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['i']).'" and agentId="'.$_SESSION['agentUserid'].'"');
$restone=mysqli_fetch_array($a);


$ab=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['r']).'" and agentId="'.$_SESSION['agentUserid'].'"');
$restreturntwo=mysqli_fetch_array($ab);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Flight Voucher - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
<?php include "headerinc.php"; ?>

<style>
.showonlyaftercheck{display:none;}
#DivIdToPrint{width:958px; margin:auto; padding:10px; border:1px solid #ddd;}
#DivIdToPrint2{width:958px; margin:auto; padding:10px; border:1px solid #ddd;}
.container table tr td{padding:5px !important;}
</style>
 

</head>

<body>

<?php include "header.php"; ?>

 
 


 


<div class="container" style="margin-top:20px; margin-bottom:20px;"> 

 
<h2>Confirm Hotel Booking</h2>

 <div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">
<?php 
$_REQUEST['id']=$_REQUEST['i'];   

  include "hotel-voucher.php"; ?>
</div>
</div>
</div>
</div>
  

</div>
 
 </div> 
 <?php
 
 sendhoteltickettomail($fullurl,$_REQUEST['i']);
  
		  
		  ?>
 
 
<?php include "footer.php";  ?>
 
  
 
 
</body>
</html>

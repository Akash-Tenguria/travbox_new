<?php
include "inc.php"; 
include "config/logincheck.php";  
$selectedpage=''; 
$selectleft='online-recharge'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Online Recharge - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title> 
<?php include "headerinc.php"; ?>
<style>
.topupcol .card { border: 0px; background-color: transparent; border: 1px solid #ddd; height: 90px; }
</style>
</head>

<body class="greyouter">
  <?php include "header.php"; ?>



<!--------------Left Menu---------------->


<?php include "left.php"; ?>





<!--------------Mid Body---------------->


<section class="profile">
        <div class="listcontent">

            <div class="card">
                <div class="card-body">
                    <div class="bodysection bodypricesection">
                        <h1>Online Recharge  </h1>
                         
						
                        <div class="tbtabcontent" style="border-top-left-radius: 14px;">
 
                        
	<div class="table-responsive">
 

	 
<div class="card-body" style="padding:15px;">
 
 
  <div class="row">
  <div  style="font-weight:600;">SELECT AMOUNT</div>
  <div class="col-lg-2 topupcol">
<div class="card">
<label>
<div class="card-body" style="text-align:center; cursor:pointer;">
<div style="font-size:22px; text-align:center; font-weight:600;">₹5000</div>
<input name="amount" type="radio" style="height: 20px; width: 20px;" value="5000" checked="">
</div>
</label>
</div>
</div>
<div class="col-lg-2 topupcol">
<div class="card">
<label>
<div class="card-body" style="text-align:center; cursor:pointer;">
<div style="font-size:22px; text-align:center; font-weight:600;">₹10000</div>
<input name="amount" type="radio" value="10000" style="height: 20px; width: 20px;">
</div>
</label>
</div>
</div>
<div class="col-lg-2 topupcol">
<div class="card">
<label>
<div class="card-body" style="text-align:center; cursor:pointer;">
<div style="font-size:22px; text-align:center; font-weight:600;">₹15000</div>
<input name="amount" type="radio" value="15000" style="height: 20px; width: 20px;">
</div>
</label>
</div>
</div>
<div class="col-lg-2 topupcol">
<div class="card">
<label>
<div class="card-body" style="text-align:center; cursor:pointer;">
<div style="font-size:22px; text-align:center; font-weight:600;">₹20000</div>
<input name="amount" type="radio" value="20000" style="height: 20px; width: 20px;">
</div>
</label>
</div>
</div>

<div class="col-lg-2 topupcol">
<div class="card">
<label>
<div class="card-body" style="text-align:center; cursor:pointer;">
<div style="font-size:22px; text-align:center; font-weight:600;"><div style="font-size:12px;">Enter Amount</div><input min="1" name="customamount" id="customamount" type="number" value="" style="font-size: 15px; width: 100%; text-align: center; padding:7px; border: 1px solid #ddd;">
</div>
 
</div>
</label>
</div>
</div>
  </div>
<hr>
<div style="width:100%; margin-top:10px;"><button type="button" class="btn btn-secondary btn-icon btn-sm" onclick="payonlinenow();" style="background-color: #09b598; font-weight:600; border: 0px; padding: 12px 30px; font-size:14px;">Pay Now</button></div>

</div>
		    </div>

					  

            </div>

        </div>
        </div>
        </div>
        </div>
    </section>




<!-- HTML -->
<?php
$_SESSION['serviceId']=encode(time()+$_SESSION['agentUserid']);
?>

<script>

function bookingFormSubmit(){
window.location.href = "<?php echo $fullurl; ?>balance-sheet";
}

function allBookingSubmit(){
window.location.href = "<?php echo $fullurl; ?>balance-sheet";
}



function payonlinenow(){

var amount = $('input[name="amount"]:checked').val();
var totalamount = Number($('#customamount').val());
var finalamount=0;
if(totalamount>0){
finalamount =  totalamount;
} else {  
finalamount =  amount;
}
 

window.open('onlinerecharge?b=1&bamount='+finalamount+'&z=<?php echo encode($_SESSION['agentUserid']); ?>&type=wallet&bType=<?php echo $_SESSION['serviceId']; ?>', '_blank', 'location=yes,height=600,width=1000,scrollbars=yes,status=yes');
}
</script>



  <?php include "footerinc.php"; ?>

</body>
</html>

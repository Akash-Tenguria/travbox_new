<?php 
include "inc.php"; 
//include "config/logincheck.php";  
//$cookie_value=$_SESSION;
//setcookie('flyshopkafila', $cookie_value, time() + (86400 * 30), "/");
//file_put_contents("usersession/".$_SESSION['agentUserid'].".txt",json_encode($_SESSION));


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

#searchform .form-control { font-size: 12px !important; height: 33px; border-radius: 4px !important; }

#searchform .col-xl-3 { padding-left: 5px !important; padding-right: 5px !important; }
html{background-color:#ededed;}
body{background-color: transparent;}
</style>

</head>


<?php
if($_REQUEST["o"]==1){
	
	$payment_confirm=1;
?>


<body id="bookingpage">

	 

	<div class="sections" style="max-width: 60%; margin: auto; margin-top: 14%;">

		<div class="container"> 

			<div class="row">

				<div class="col-lg-12">

					<div class="card">

						<div class="payment-sec-f">

							<ul class="rtabs">

								<li><a id="dbpays" class="text-center " href="<?php echo $fullurl; ?>">< Back </a></li>

							 

							</ul>

						</div>

					<div class="row">

						<div class="col-lg-12">

							<div class="card-body" style="padding:15px;">

<div class="row">

	<div class="col-xl-12 col-lg-12 col-md-12"> 
	<h2>Online Recharge</h2>
<?php
if($_REQUEST['type']!='' && decode($_REQUEST['bType'])>0 && $_REQUEST['bamount']>0)
{
?>
		<form method="post" action="<?php echo $fullurl; ?>frmaction.html"> 

		<input type="hidden" name="action" value="onlineRecharge">
		<input type="hidden" name="booking_payment_type" value="recharge">
		<input type="hidden" name="type" value="<?php echo $_REQUEST['type']; ?>">
		<input type="hidden" name="bType" value="<?php echo $_REQUEST['bType']; ?>">

		

			<div class="row"> 

				<div class="col-xl-3 col-lg-3 col-md-12">

					<div class="form-group">

						<label>Recharge Amount<span style="color:#FF0000;">*</span></label>

						<input name="amount" id="amount" required="required" type="number" class="form-control" value="<?php if($_REQUEST['type']!='') { echo decode($_REQUEST['bamount']); } ?>">

					</div>

				</div>

			</div>



			<div class="row"> 

				<div class="col-xl-12 col-lg-12 col-md-12">

					<div class="form-group">

						<label>Note</label>

						<textarea name="notes" cols="5" class="form-control"></textarea>

					</div>

				</div>

				<div style="text-align: right; width: 100%; margin-top: 10px; margin-right: 10px;"><button type="submit" class="btn btn-danger">Recharge</button></div>

			</div>

	</form>
<?php } ?>
</div>





</div>







 









</div>



</div>





 

</div>





 

</div>







</div>







			</div>

</div>

</div>
 



<?php 
}


if($_REQUEST["b"]=="1" && $_REQUEST["bamount"]>0){
$payment_confirm=1;
?>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> 
<style>
html{background-color:#FFFFFF;}
body{background-color:#FFFFFF !important; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:0px; margin:0px;}
</style>
<div style="padding:30px 15%; ">
<form   method="post" id="bookingForm" action="<?php echo $fullurl; ?>frmaction.html"> 


<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td colspan="3" align="center" style="font-size:20px; font-weight:600;">Select Payment Mode</td>
    </tr>
  <tr>
    <td colspan="3" align="center"><table width="100%" border="1" cellpadding="10" cellspacing="0" bordercolor="#B7FFEB" style="font-size:13px;">
      <tr style="font-weight:500;">
        <td width="10%" align="left" valign="middle" bgcolor="#E0FEF9">&nbsp;</td>
        <td width="20%" align="center" valign="middle" bgcolor="#E0FEF9">&nbsp;</td>
        <td width="20%" align="left" valign="middle" bgcolor="#E0FEF9">MODE</td>
		<td width="20%" align="left" valign="middle" bgcolor="#E0FEF9">CONVENIENCE FEES</td>
		<td width="20%" align="left" valign="middle" bgcolor="#E0FEF9">PAYABLE AMOUNT</td>
      </tr>
      <tr style=" border-bottom:1px solid #B7FFEB;">
        <td width="10%" align="left" valign="middle"><input name="pg_name" type="radio" value="DC"> </td>
        <td width="20%" align="center" valign="middle"><i class="fa fa-credit-card-alt" aria-hidden="true" style="color:#09b598; font-size:24px;"></i></td>
        <td width="20%" align="left" valign="middle">Debit Card </td>
        <td width="20%" align="left" valign="middle">0.85% </td>
        <td width="20%" align="left" valign="middle"><?php echo round($_REQUEST["bamount"]+($_REQUEST["bamount"]*0.0085)); ?> </td>
      </tr>

      <tr style=" border-bottom:1px solid #B7FFEB;">
        <td width="10%" align="left" valign="middle"><input name="pg_name" type="radio" value="CC"></td>
        <td width="20%" align="center" valign="middle"><i class="fa fa-credit-card-alt" aria-hidden="true" style="color:#09b598; font-size:24px;"></i></td>
        <td width="20%" align="left" valign="middle">Credit Card </td>
        <td width="20%" align="left" valign="middle">1.90% </td>
		<td width="20%" align="left" valign="middle"><?php echo round($_REQUEST["bamount"]+($_REQUEST["bamount"]*0.019)); ?> </td>
      </tr>
	  <tr style=" border-bottom:1px solid #B7FFEB;">
        <td width="10%" align="left" valign="middle"><input name="pg_name" type="radio" value="MW"></td>
        <td width="20%" align="center" valign="middle"><i class="fa fa-credit-card-alt" aria-hidden="true" style="color:#09b598; font-size:24px;"></i></td>
        <td width="20%" align="left" valign="middle">Wallet (ANY WALLET)</td>
        <td width="20%" align="left" valign="middle">1.75% </td>
		<td width="20%" align="left" valign="middle"><?php echo round($_REQUEST["bamount"]+($_REQUEST["bamount"]*0.0175)); ?> </td>
      </tr>
      <tr style=" border-bottom:1px solid #B7FFEB;">
        <td width="10%" align="left" valign="middle"><input name="pg_name" type="radio" value="NB"></td>
        <td width="20%" align="center" valign="middle"><i class="fa fa-university" aria-hidden="true" style="color:#09b598; font-size:24px;"></i></td>
        <td width="20%" align="left" valign="middle">Net Banking </td>
        <td width="20%" align="left" valign="middle">17&#8377; </td>
		<td width="20%" align="left" valign="middle"><?php echo round($_REQUEST["bamount"]+17); ?> </td>
      </tr>
      <tr>
        <td width="10%" align="left" valign="middle"><input name="pg_name" type="radio" value="UPI" checked></td>
        <td width="20%" align="center" valign="middle"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACaklEQVR4nO2Xu49NURTGf94SIRidRzTeCTMejVehGFFIKLRKxRQoKBRcGgohhMZ/IKYyU00hJnGRUFCMR6cYIhKRmAwJgytb1o6TNWefdfYZEZL1JTvnfud+37fOvmeffdcBh8PhcDgcDofD4fh30A10MsZ18W0S/tTI17oyvrvmtc4A+lJfnsycyEXxnVA8Ba0r4yPATCNnLtBfVW9IgvcaQVoXeW9NX6/B+yoyFgPtqnphlp+AL8C8iqA5ohsFZssYr+HTuhTvAB+AJSUZK4GXoknW25OxpCaAfQ18YdxRPs076vmL2Ay8LcmZhAsZFzNe+DXOZ07klPJpPiTHb8BG+S4soTEZD5RvEh6LYBvVeCS6Zcq31fBpXRUflM/DwGHgK/AO2GLV6wK+y9oM21oKi+SXirroew9Mr/BpncXXyMXHu/gKWF2n3qHM5dGvfLeMu6F1Fg+4JudGCnffrHcjYxJvCssv+o6kghM6iyO71m1gIb9Rt57jv8Co3M6lhu610kVeZ4SHuSxnGnBAzh+cyiTWSegzQ7de6SKvO54ncjZIO7IWeDiViRyV4CuG7lhNXSr/aoIfB34Al+X8KhpiQAL2/yGd5RtQfLDQEoXj6QZz+NVKf5SQBRm6yOsuK+2bqMh50WQiO8V8L1MXeZ0ROtiW8rWF7yrRX2oykbNiPmPozomupXythvVaKje2KjeNNiiJ+xKwPVMXX3p2ZNZrK1/ocu9Kkzos70HZmK+aNmuE9npWwRd5br2xQs4TYLkcQ7PaCCsKb2vW+CzbL7LbdGT3yYH29cgfYnehYXQ4HA6Hw+Fw8PfxEyWmf5sEmp4DAAAAAElFTkSuQmCC" style="height:32px;"></td>
        <td width="20%" align="left" valign="middle">UPI (Recommend)</td>
        <td width="20%" align="left" valign="middle">0%</td>
		<td width="20%" align="left" valign="middle"><?php echo round($_REQUEST["bamount"]); ?> </td>
      </tr>
      
    </table></td>
  </tr>
</table>


		<input type="hidden" name="action" value="onlineRecharge">
		<input type="hidden" name="booking_payment_type" value="booking">
		<input name="token" type="hidden" value="<?php echo rand(89898,543132113).strtotime(date('YmdHis')); ?>" />
		<input type="hidden" name="type" value="<?php echo $_REQUEST['type']; ?>">
		<input type="hidden" name="bType" value="<?php echo $_REQUEST['bType']; ?>">
		<input type="hidden" name="amount" value="<?php echo trim($_REQUEST["bamount"]); ?>">
			<div  style="text-align:center; width:100%;"> 

				 <input type="submit" value="Continue Payment" style="padding:10px 20px; background-color:#09b598; color:#FFFFFF; font-size:14px; font-size:15px; font-weight:600; border:0px; outline:0px;border-radius:5px;">
			</div>
	</form>
</div>
<script>
//$('#bookingForm').submit();
</script>

<?php
}



if($_REQUEST["c"]=="1" && $_REQUEST["camount"]>0){
$payment_confirm=1;
?>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> 
<style>
html{background-color:#FFFFFF;}
body{background-color:#FFFFFF !important; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:0px; margin:0px;}
</style>
<div style="padding:30px 15%; ">
<form   method="post" id="bookingForm" action="<?php echo $fullurl; ?>frmaction.html"> 
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
    <td colspan="3" align="center" style="font-size:20px; font-weight:600;">Select Payment Mode</td>
    </tr>
  <tr>
    <td colspan="3" align="center"><table width="100%" border="1" cellpadding="10" cellspacing="0" bordercolor="#B7FFEB" style="font-size:13px;">
      <tr style="font-weight:500;">
        <td width="4%" align="left" valign="middle" bgcolor="#E0FEF9">&nbsp;</td>
        <td width="10%" align="center" valign="middle" bgcolor="#E0FEF9">&nbsp;</td>
        <td width="22%" align="left" valign="middle" bgcolor="#E0FEF9">MODE</td>
        <td width="19%" align="left" valign="middle" bgcolor="#E0FEF9"><div align="center">CHARGES</div></td>
        <td width="45%" align="right" valign="middle" bgcolor="#E0FEF9">AMOUNT</td>
      </tr>
      <tr style=" border-bottom:1px solid #B7FFEB;">
        <td width="4%" align="left" valign="middle"><input name="pg_name" type="radio" value="DC"> </td>
        <td width="10%" align="center" valign="middle"><i class="fa fa-credit-card-alt" aria-hidden="true" style="color:#09b598; font-size:24px;"></i></td>
        <td align="left" valign="middle">Debit Card </td>
        <td align="left" valign="middle"><div align="center" style="font-size:14px;"><strong>1%</strong></div></td>
        <td align="right" valign="middle" style="font-size:16px; font-weight:500;">₹<?php echo round($_REQUEST["camount"])+round($_REQUEST["camount"]*1/100); ?></td>
      </tr>
      <tr style=" border-bottom:1px solid #B7FFEB;">
        <td align="left" valign="middle"><input name="pg_name" type="radio" value="CC"></td>
        <td width="10%" align="center" valign="middle"><i class="fa fa-credit-card-alt" aria-hidden="true" style="color:#09b598; font-size:24px;"></i></td>
        <td align="left" valign="middle">Credit Card </td>
        <td align="left" valign="middle"><div align="center" style="font-size:14px;"><strong>1.9%</strong></div></td>
        <td align="right" valign="middle"  style="font-size:16px; font-weight:500;">₹<?php echo round($_REQUEST["camount"])+round($_REQUEST["camount"]*1.9/100); ?></td>
      </tr>
      <tr style=" border-bottom:1px solid #B7FFEB;">
        <td align="left" valign="middle"><input name="pg_name" type="radio" value="NB"></td>
        <td width="10%" align="center" valign="middle"><i class="fa fa-university" aria-hidden="true" style="color:#09b598; font-size:24px;"></i></td>
        <td align="left" valign="middle">Net Banking </td>
        <td align="left" valign="middle"><div align="center" style="font-size:14px;"><strong>₹20 </strong></div></td>
        <td align="right" valign="middle"  style="font-size:16px; font-weight:500;">₹<?php echo trim($_REQUEST["camount"]+20); ?></td>
      </tr>
      <tr>
        <td align="left" valign="middle"><input name="pg_name" type="radio" value="UPI" checked></td>
        <td width="10%" align="center" valign="middle"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACaklEQVR4nO2Xu49NURTGf94SIRidRzTeCTMejVehGFFIKLRKxRQoKBRcGgohhMZ/IKYyU00hJnGRUFCMR6cYIhKRmAwJgytb1o6TNWefdfYZEZL1JTvnfud+37fOvmeffdcBh8PhcDgcDofD4fh30A10MsZ18W0S/tTI17oyvrvmtc4A+lJfnsycyEXxnVA8Ba0r4yPATCNnLtBfVW9IgvcaQVoXeW9NX6/B+yoyFgPtqnphlp+AL8C8iqA5ohsFZssYr+HTuhTvAB+AJSUZK4GXoknW25OxpCaAfQ18YdxRPs076vmL2Ay8LcmZhAsZFzNe+DXOZ07klPJpPiTHb8BG+S4soTEZD5RvEh6LYBvVeCS6Zcq31fBpXRUflM/DwGHgK/AO2GLV6wK+y9oM21oKi+SXirroew9Mr/BpncXXyMXHu/gKWF2n3qHM5dGvfLeMu6F1Fg+4JudGCnffrHcjYxJvCssv+o6kghM6iyO71m1gIb9Rt57jv8Co3M6lhu610kVeZ4SHuSxnGnBAzh+cyiTWSegzQ7de6SKvO54ncjZIO7IWeDiViRyV4CuG7lhNXSr/aoIfB34Al+X8KhpiQAL2/yGd5RtQfLDQEoXj6QZz+NVKf5SQBRm6yOsuK+2bqMh50WQiO8V8L1MXeZ0ROtiW8rWF7yrRX2oykbNiPmPozomupXythvVaKje2KjeNNiiJ+xKwPVMXX3p2ZNZrK1/ocu9Kkzos70HZmK+aNmuE9npWwRd5br2xQs4TYLkcQ7PaCCsKb2vW+CzbL7LbdGT3yYH29cgfYnehYXQ4HA6Hw+Fw8PfxEyWmf5sEmp4DAAAAAElFTkSuQmCC" style="height:32px;"></td>
        <td align="left" valign="middle">UPI</td>
        <td align="left" valign="middle"><div align="center" style="font-size:14px;"><strong style="color:#09b598;">FREE</strong></div></td>
        <td align="right" valign="middle"  style="font-size:16px; font-weight:500;">₹<?php echo trim($_REQUEST["camount"]); ?></td>
      </tr>
      
    </table></td>
  </tr>
</table>

		<input type="hidden" name="action" value="onlineRecharge">
		<input type="hidden" name="booking_payment_type" value="recharge">
		<input name="token" type="hidden" value="<?php echo rand(89898,543132113).strtotime(date('YmdHis')); ?>" />
		<input type="hidden" name="type" value="<?php echo $_REQUEST['type']; ?>">
		<input type="hidden" name="bType" value="<?php echo $_REQUEST['bType']; ?>">
		<input type="hidden" name="amount" value="<?php echo trim($_REQUEST["camount"]); ?>">
			<div style="text-align:center; width:100%;"> 
				 <input type="submit" value="Continue Payment" style="padding:10px 20px; background-color:#09b598; color:#FFFFFF; font-size:14px; font-size:15px; font-weight:600; border:0px; outline:0px;border-radius:5px;">
			</div>
	</form>
</div>

<script>
//$('#bookingForm').submit();
</script>

<?php
}







if($payment_confirm<1){ ?>

<body>
	<h2 style="text-align:center;">Something went wrong, please try again!!</h2>
</body>

<?php
	
	
}
 ?>


</body>
</html>


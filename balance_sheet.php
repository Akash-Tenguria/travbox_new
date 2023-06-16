<?php
include "inc.php"; 
include "config/logincheck.php";  
$selectedpage=''; 
$selectleft='balancesheet'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Balance Sheet - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title> 
<?php include "headerinc.php"; ?>
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
                        <h1>Balance Sheet<div style="font-size:14px;">Remaining Balance: <span style=" color:#dc3545; font-size:14px; ">&#8377;<?php echo round($totalwalletBalance); ?></span></div></h1>
                         
						
                        <div class="tbtabcontent" style="border-top-left-radius: 14px;">
						<div class="row">
						<div class="col-lg-12">
<div  style="float:left; margin-bottom:20px;"> 
<form method="get" id="searchform">
		<div class="row newinputbookrow">
		 
		<input name="stage" type="hidden" value="<?php echo $_REQUEST['stage']; ?>" />
		
		<div class="col-xl-3"style="padding-right: 0px;">
			<div class="input-group">
	 	<input type="text" id="fromdate" name="fromdate" class="form-control" placeholder="From Date" value="<?php echo $_REQUEST['fromdate']; ?>"  readonly >
		
			</div>
			</div>
				
		<div class="col-xl-3"style="padding-right: 0px;padding-left:7px;">
			<div class="input-group">
	 	<input type="text" id="todate" name="todate" class="form-control" placeholder="To Date"  value="<?php echo $_REQUEST['todate']; ?>" readonly>
		
			</div>
			</div>
			
			
		<script>
			$( function() {
			$( "#fromdate" ).datepicker({ dateFormat: 'dd-mm-yy' });
			$( "#todate" ).datepicker({ dateFormat: 'dd-mm-yy' });
			} );
		</script>
			 
				
		 
		
		<div class="col-xl-6"style="padding-right: 0px;padding-left:7px;">
			<div class="input-group">
			<input name="keyword" type="text" class="form-control" id="keyword" placeholder="Reference No." value="<?php echo $_REQUEST['keyword']; ?>"  >
			<span class="input-group-append">
			<button class="btn btn-light bg-primary border-primary text-white" type="submit" style="padding: 6px 12px;height:37px; border-top-right-radius:6px;border-bottom-right-radius:6px;border-bottom-left-radius:0px;border-top-left-radius: 0px; margin-left: 7px; width:100%;"><i class="fa fa-search" aria-hidden="true"></i></button>
			</span>
			</div>
			</div>
				
				
				 	</div>
		</form>
</div>
</div>
						 
</div>
                        
	<div class="table-responsive">
 

	<table border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" class="table balancesheettable" style=" margin-bottom:0px;">
							<thead>
								<tr style="background-color: #f6f6f6;">
								  <th align="left">Date</th>
								  <th align="left">Reference No.</th>
								  <th align="left">Description</th>
								  <th align="center"><div align="center">Method</div></th>
								  <th align="right"><div align="right">Credit</div></th>
								  <th align="right"><div align="right">Debit</div></th>
								  <th align="right"><div align="right">Running Balance</div></th>
								</tr>
							</thead>
							<tbody> 
<?php
$search='';
if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}

if($_REQUEST['keyword']!=''){
$search.=' and  (bookingId like "%'.decode($_REQUEST['keyword']).'%" ) ';
}
							
$totalCreditAmt=0;
$totalDebitAmt=0;
$balance=0;
								
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1;
  
$targetpage='balance-sheet?view=1&agentCategory='.$_REQUEST['agentCategory'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 

$rs=GetRecordList('*','sys_balanceSheet',' where 1 '.$search.' and agentId="'.$_SESSION['agentUserid'].'"  order by id desc  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($agentWebsitePages=mysqli_fetch_array($rs[0])){ 
if($agentWebsitePages['amount']>0){
	
//Opening Balance Debit Amount
$openBalDebited=GetPageRecord('SUM(amount)','sys_balanceSheet',' agentId="'.$agentWebsitePages['agentId'].'" and paymentType="Debit" and id<="'.$agentWebsitePages["id"].'" order by id asc'); 
$openBalDebitedData=mysqli_fetch_array($openBalDebited);
$openBalDebitedAmount = $openBalDebitedData["SUM(amount)"];


//Opening Balance Credit Amount
$openBalCredited=GetPageRecord('SUM(amount)','sys_balanceSheet',' agentId="'.$agentWebsitePages['agentId'].'" and paymentType="Credit" and id<="'.$agentWebsitePages["id"].'" order by id asc'); 
$openBalCreditedData=mysqli_fetch_array($openBalCredited);
$openBalCreditedAmount = $openBalCreditedData["SUM(amount)"];
$balance = round($openBalCreditedAmount-$openBalDebitedAmount);	
	

$totalDebit+=$openBalDebitedAmount;

$totalCredit+=$openBalCreditedAmount;

?>
<tr>
	<td align="left" valign="top"><?php echo date('l d M Y h:i A', strtotime($agentWebsitePages['addDate'])); ?></td>
	<td align="left" valign="top"> 
	<?php if($agentWebsitePages['transactionId']!=''){ ?><strong><?php echo $agentWebsitePages['transactionId']; ?></strong><?php } else { ?>
	
	
	
	<?php if($agentWebsitePages['bookingId']>0 && $agentWebsitePages['bookingType']=='flight'){
	$b=GetPageRecord('*','flightBookingMaster','id="'.$agentWebsitePages['bookingId'].'" '); 
	$getflightbookingdata=mysqli_fetch_array($b); 
	?>
	<a href="#" onClick="loadpop('View Ticket',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewTicket&id=<?php echo encode($getflightbookingdata['id']); ?>"><strong><?php echo encode($getflightbookingdata['id']); ?></strong> </a> 
	<?php } ?>
	<?php if($agentWebsitePages['bookingType']=='flight_commision'  || $agentWebsitePages['bookingType']=='flight_GST' || $agentWebsitePages['bookingType']=='RejectBankRefund' || $agentWebsitePages['bookingType']=='TDS'){ ?>
	<strong><?php echo encode($agentWebsitePages['bookingId']); ?></strong>  
	<?php } ?>
	
	<?php if( $agentWebsitePages['bookingType']=='bus'){ ?>
	<strong><?php echo encode($agentWebsitePages['bookingId']); ?></strong>  
	<?php } ?>
	<?php if($agentWebsitePages['bookingType']=='hotel'||  $agentWebsitePages['bookingType']=='hotel_GST' || $agentWebsitePages['bookingType']=='hotel_commision' || $agentWebsitePages['bookingType']=='TDS' || $agentWebsitePages['bookingType']=='hotelTDS'){ 
	
	$b=GetPageRecord('*','hotelBookingMaster','id="'.$agentWebsitePages['bookingId'].'" '); 
	$gethotelbookingdata=mysqli_fetch_array($b); 
	?>
	<strong><?php echo encode($gethotelbookingdata['id']); ?></strong>  
	<?php } ?><?php } ?>	</td>
	<td align="left" valign="top">
	 <?php if($agentWebsitePages['paymentMethod']!=''){ ?>
	<strong><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Wallet Recharge</strong>
	<?php } else { ?>
 
	
	<?php if($agentWebsitePages['bookingType']=='Facilitating' || $agentWebsitePages['bookingType']=='Facilitating_GST'){?>
	
	<?php if($agentWebsitePages['bookingType']=='Facilitating'){ ?>
	<strong style="color:#CC0000;">Facilitating Charges</strong>
	<?php } ?>
	<?php if($agentWebsitePages['bookingType']=='Facilitating_GST'){ ?>
	<strong style="color:#CC0000;">18% GST on Facilitating Charges</strong>
	<?php } ?>
	
	
	<?php } else { ?>
	
	
	
	<?php if( $agentWebsitePages['bookingType']=='flight_GST' || $agentWebsitePages['bookingType']=='flight_commision' || $agentWebsitePages['bookingType']=='TDS' || $agentWebsitePages['bookingType']=='hotel_GST' || $agentWebsitePages['bookingType']=='hotel_commision' || $agentWebsitePages['bookingType']=='hotelTDS' || $agentWebsitePages['bookingType']=='hotelMarkup'){ ?>
	
		
	<?php if($agentWebsitePages['bookingType']=='flight_commision'){ echo '<strong>Flight commission return after detect 18% GST</strong>'; } ?>
	<?php if($agentWebsitePages['bookingType']=='TDS'){ echo '<strong>Flight TDS dedection 5%</strong>'; } ?>
	
	
	 
	 
	<?php if($agentWebsitePages['bookingType']=='hotel_commision'){ echo '<strong>Hotel commission return after detect 18% GST</strong>'; } ?>
	<?php if($agentWebsitePages['bookingType']=='hotelTDS'){ echo '<strong>Hotel TDS dedection 5%</strong>'; } ?>
	
	
	
	
	<?php  } else { ?>
	<?php if($agentWebsitePages['bookingId']>0 && $agentWebsitePages['bookingType']=='flight'){
	$b=GetPageRecord('*','flightBookingMaster','id="'.$agentWebsitePages['bookingId'].'" '); 
	$getflightbookingdata=mysqli_fetch_array($b);
	?>
	Flight: <strong><?php echo stripslashes($getflightbookingdata['flightName']); ?> <?php echo stripslashes($getflightbookingdata['flightNo']); ?></strong><br>
	Destination: <strong><?php echo stripslashes($getflightbookingdata['source']); ?> > <?php echo stripslashes($getflightbookingdata['destination']); ?></strong><br>
	Fare Type: <strong><?php  echo getfaretypedisplayname(stripslashes($getflightbookingdata['flightName']),stripslashes($getflightbookingdata['pcc']));  ?></strong></strong><br>
	Class: <strong><?php echo stripslashes($getflightbookingdata['flightClass']); ?></strong>
	<?php } else { 
	
	if($agentWebsitePages['billType']=='hotel'){
	?>
	Hotel: <strong><?php echo $gethotelbookingdata['HotelName']; ?></strong> <br>
City: <strong><?php echo $gethotelbookingdata['Destination']; ?></strong><br>
Check-In: <strong><?php echo date('d-m-Y',strtotime($gethotelbookingdata['CheckIn'])); ?></strong><br>
Check-Out: <strong><?php echo date('d-m-Y',strtotime($gethotelbookingdata['CheckOutDate'])); ?></strong>
 
 							   
<?php }
if($agentWebsitePages['billType']=='bus'){

$b=GetPageRecord('*','busbookingMaster','id="'.$agentWebsitePages['bookingId'].'" '); 
	$busdata=mysqli_fetch_array($b);
if($busdata['ticket_no']!=''){
 ?>
Ticket No.: <strong><?php echo $busdata['ticket_no']; ?></strong><br>
From: <strong><?php echo $busdata['from_city']; ?></strong><br>
To: <strong><?php echo $busdata['to_city']; ?></strong><br>
Date: <strong><?php echo date('d-m-Y',strtotime($busdata['booking_date'])); ?></strong>
	 
 
 
 							   
<?php
} 
}
 } ?><?php } ?>

<?php if($agentWebsitePages['bookingType']=='Markup'){ ?><span style="color:#339900; font-weight:600;"><?php echo 'Flight Markup'; ?></span><?php } ?>
<?php if($agentWebsitePages['bookingType']=='hotelMarkup'){ ?><span style="color:#339900; font-weight:600;"><?php echo 'Hotel Markup'; ?></span><?php } ?>
<?php } ?>

<?php if($agentWebsitePages['bookingType']=='RejectBankRefund'){ ?> <strong><?php if($agentWebsitePages['remarks']!=''){ ?><div style="font-size:12px; color:#666666;"><?php echo $agentWebsitePages['remarks']; ?></div><?php } ?></strong> <?php }  ?>
 
<?php } ?>
<?php if($agentWebsitePages['remarks']!=''){ ?><div style="font-size:12px; color:#666666;"><?php echo $agentWebsitePages['remarks']; ?></div><?php } ?></td>
	<td align="center" valign="top"><div align="center">
	
	
	
	<?php if($agentWebsitePages['paymentType']=='Credit'){ ?> 
	<span class="badge badge-dark"><?php echo strip($agentWebsitePages['paymentMethod']); ?></span>
	<?php } else { ?>
 
	<span class="badge badge-primary">Wallet</span>
	<?php } ?>	
	
	
								  
	</div></td>
	<td align="right" valign="top"><div align="right">
	<?php if($agentWebsitePages['paymentType']=='Credit'){ $totalCreditAmt+=$agentWebsitePages['amount']; ?>
	<?php echo strip($agentWebsitePages['amount']); ?> INR
	<?php } ?>
	</div></td>
	<td align="right" valign="top"><div align="right">
	<?php if($agentWebsitePages['paymentType']=='Debit'){ $totalDebitAmt+=$agentWebsitePages['amount']; ?>
	<?php echo strip($agentWebsitePages['amount']); ?> INR
	<?php } ?>
	</div></td>
	
	<td align="right" valign="top"><div align="right"><?php echo strip($balance); ?> INR</div></td>
						      </tr>
								
								<?php } } ?>
								<tr>
								  <td colspan="7" valign="top" style="padding:0px;"><div class="card-footer text-right" style="overflow:hidden;width: 100%; ">
		 
										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
											<div class="pagingnumbers"><?php echo $paging; ?></div>
											
						 
			  </div></td>
							  </tr>
							</tbody>
		      </table>
					 

		    </div>

					  

            </div>

        </div>
        </div>
        </div>
        </div>
    </section>




<!-- HTML -->




  <?php include "footerinc.php"; ?>

</body>
</html>

<?php
include "inc.php"; 
include "config/logincheck.php";  
$selectedpage=''; 
$selectleft='bookings';
$selectintab='flight';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Bookings - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title> 
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
                        <h1>Bookings</h1>
                        <?php include "bookingtabs.php"; ?>
						
                        <div class="tbtabcontent">
						<div class="row">
						<div class="col-lg-12">

<div  style="float: left; margin-top: 0px; margin-bottom: 20px;"> 

<form method="get" id="searchform">

		<div class="row newinputbookrow">

		 

		<input name="stage" type="hidden" value="<?php echo $_REQUEST['stage']; ?>" />

		

		<div class="col-xl-3 mobileforncol">

			<div class="input-group">

	 	<input type="text" id="fromdate" name="fromdate" class="form-control" placeholder="From Date" value="<?php echo $_REQUEST['fromdate']; ?>"  readonly >

		

			</div>

			</div>

				

		<div class="col-xl-3 mobileforncol">

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

			 

				

		<div class="col-xl-3 mobileforncol">

			<div class="input-group">

			<select id="status" name="status" class="form-control" data-placeholder="Select Status" autocomplete="off" style="-webkit-appearance: listbox !important;height: 37px;">   

				<option value="">All Bookings</option>

				<option value="1" <?php if($_REQUEST['status']==1){ ?>selected="selected"<?php } ?>>Pending</option>

				<option value="2" <?php if($_REQUEST['status']==2){ ?>selected="selected"<?php } ?>>Confirm</option>

				<option value="3" <?php if($_REQUEST['status']==3){ ?>selected="selected"<?php } ?>>Cancelled</option>

				<option value="4" <?php if($_REQUEST['status']==4){ ?>selected="selected"<?php } ?>>Rejected</option>

			</select> 

			</div>

			</div>

		

		<div class="col-xl-3 mobileforncol">

			<div class="input-group">

			<input name="keyword" type="text" class="form-control" id="keyword" placeholder="Enter Keyword" value="<?php echo $_REQUEST['keyword']; ?>"  >

			<span class="input-group-append">

			<button class="btn btn-light bg-primary border-primary text-white" type="submit" style="padding: 6px 12px; border-radius: 3px; margin-left: 7px; width:100%;border-top-right-radius:6px;border-bottom-right-radius:6px;border-bottom-left-radius:0px;border-top-left-radius: 0px;height:37px;"><i class="fa fa-search" aria-hidden="true"></i></button>

			</span>

			</div>

			</div>

				

				

				 	</div>

		</form>

</div>

</div>
</div>
                        
	<div class="table-responsive">

	<table border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" class="table">

							<thead>

								<tr style="background-color: #f6f6f6;">

								  <th align="left" valign="middle">Booking </th>

								  <th align="left" valign="middle">Flight</th>

								  <th align="left" valign="middle">Sector</th>

								  <th align="left" valign="middle">Passanger</th>
								  <th align="left" valign="middle">Status </th>

								  <th align="center" valign="middle"><div align="center">Total Fare </div></th>

									<th align="right" valign="middle">&nbsp;</th>
								</tr>
							</thead>

							<tbody>

								<?php 

$limit=clean($_GET['records']);

$page=clean($_GET['page']); 

$sNo=1; 





$search='';



if($_REQUEST['status']!=''){

$search.=' and  status="'.$_REQUEST['status'].'" ';

}



if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){

$search.=' and  DATE(journeyDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(journeyDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';

}





if($_REQUEST['keyword']!=''){

$search.=' and  (flightName like "%'.$_REQUEST['keyword'].'%" or flightNo like "%'.$_REQUEST['keyword'].'%" or  source like "%'.$_REQUEST['keyword'].'%" or  destination like "%'.$_REQUEST['keyword'].'%" or pnrNo like "%'.$_REQUEST['keyword'].'%" or bookingNumber like "%'.$_REQUEST['keyword'].'%" or totalFare like "%'.$_REQUEST['keyword'].'%" or agentId in (select id from sys_userMaster where companyName like "%'.$_REQUEST['keyword'].'%" )) ';

}

 

$targetpage='flight-bookings?status='.$_REQUEST['status'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 

$rs=GetRecordList('*','flightBookingMaster',' where 1 and agentBookingType=0 and bookingType=0   '.$search.' and agentId="'.$_SESSION['agentUserid'].'" group by roundTripId order by id desc  ','10',$page,$targetpage); 

$totalentry=$rs[1]; 

$paging=$rs[2];  

while($rest=mysqli_fetch_array($rs[0])){ 


$rto=GetPageRecord('SUM(agentTotalFare) as totalagentTotalFare, SUM(agentCommision) as totalagentCommision, SUM(agentFixedMakup) as totalagentFixedMakup','flightBookingMaster',' roundTripId="'.$rest['roundTripId'].'"  '); 
$totalcostings=mysqli_fetch_array($rto);


$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" '); 

$agentcate=mysqli_fetch_array($rs6);



$cft=GetPageRecord('*','flightBookingMaster',' uniqueSessionId="'.$rest['uniqueSessionId'].'" '); 

$cont=mysqli_num_rows($cft);



$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 

$agentData=mysqli_fetch_array($ag);



$ba=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="flight" '); 

 





?>

								

								<tr <?php if($rest['status']==3 || $rest['status']==4){ ?>style="background-color:#fee;"<?php } ?>>

								  <td align="left" valign="middle">
								  <strong>Ref.:</strong> <a href="<?php echo $fullurl; ?>flight-booking-details?id=<?php echo encode($rest['id']); ?>" style="color:#2196fc; font-weight:600;" ><?php echo encode($rest['id']); ?></a><br>
								  <?php echo date('d-m-Y h:i A', strtotime($rest['bookingDate'])); ?>
								  
								  
								  <?php if($rest['status']==2){



$abc=GetPageRecord('id,addDate','ticketCancelRequest',' flightBookingId="'.$rest['id'].'"'); 

$cancelrequestdata=mysqli_fetch_array($abc);



if($cancelrequestdata['id']>0){

 ?>

<div style="color:#CC0000;"><strong>Cancellation Request</strong><div style=" font-size:12px;"><?php echo date("d-m-Y H:i:s",strtotime($cancelrequestdata['addDate'])); ?></div></div>

<?php } } ?></td>

								  <td align="left" valign="middle"><span style="color:#000;"><i class="fa fa-plane" aria-hidden="true"></i> <strong><?php echo stripslashes($rest['flightName']); ?>&nbsp;(<?php echo stripslashes($rest['flightNo']); ?>)<br>
</span>
	<div style="color:#CC0000; margin-top:2px;"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?php echo date('d-m-Y', strtotime($rest['journeyDate'])); ?></div>
	
	<?php if($rest['pnrNo']!=''){?><div style="border:1px dashed #ddd; padding:2px 4px; background-color:#E6FFF5; float:left; border:1px solid #88FFED; font-weight:500;"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo stripslashes($rest['pnrNo']); ?></div><?php } ?>	 	</td>

								  <td align="left" valign="middle"><strong>From: </strong><?php echo $rest['source']; ?><br><strong>To:</strong> <?php echo $rest['destination']; ?></td>

								  <td align="left" valign="middle">
								  <table width="100%" border="0" cellpadding="2" cellspacing="0">
 
								  <?php 
				$rs6to=GetPageRecord('count(id) as totalpass','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" and firstName!="" '); 
				$totalpaxData=mysqli_fetch_array($rs6to);							  
	  $ns=1;
		$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" and firstName!="" '); 
		while($paxData=mysqli_fetch_array($rs6)){
	  
	  ?> 
								  <tr>
								    <td width="1%" style="border:1px solid #ddd; font-size:11px; font-weight:500; padding:2px 5px;"><?php echo ucfirst($paxData['paxType']); ?></td>
    <td colspan="2" style="border:1px solid #ddd;"><div><i class="fa fa-user" aria-hidden="true"></i> <strong><?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?></strong> </div></td>
    <td align="center" style="border:1px solid #ddd;"><i class="fa fa-file-text-o" aria-hidden="true" style="cursor:pointer; color:#CC3300; font-size:16px;" onClick="loadpop('View Ticket',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewTicket&id=<?php echo encode($rest['id']); ?>&psid=<?php echo $paxData['id']; ?>&tp=<?php echo $totalpaxData['totalpass']; ?>"></i></td>
  </tr><?php } ?>
</table>	  </td>
								  <td align="left" valign="middle"> 



 

 <?php if($rest['status']==1 || $rest['status']==0){ ?><span class="badge bg-blue" style="background-color:#FF6600;">Pending</span><?php } ?>

									<?php if($rest['status']==2){ ?><span class="badge bg-blue" style="background-color:#46cd93;">Confirm</span><?php } ?>

									<?php if($rest['status']==3){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Cancelled</span><?php } ?><?php if($rest['status']==4){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Rejected</span><?php } ?>					 </td>

								  <td align="center" valign="middle" ><div align="center" style="text-align:left;">Fare: <strong>&#8377;<?php echo stripslashes($totalcostings['totalagentTotalFare']); ?> </strong><br>
Commission: <strong>&#8377;<?php echo stripslashes($totalcostings['totalagentCommision']); ?> </strong><br>
Markup: <strong>&#8377;<?php echo stripslashes($totalcostings['totalagentFixedMakup']); ?> </strong></div></td>

									<td align="right" valign="middle">

									<div style="width:150px;">
									<?php if($rest['pnrNo']!=''){?><a href="<?php echo $fullurl; ?>flight-booking-details?id=<?php echo encode($rest['id']); ?>" ><div style="border: 1px solid #32d479; padding: 5px 9px; float: left; border-radius: 4px; background-color: #32d479; cursor: pointer; color: #fff; margin-right: 8px;" title="View Details"><i class="fa fa-list-ul" aria-hidden="true"></i></div></a><?php } ?>
									
									<div style="border: 1px solid #ddd; padding: 5px 10px; float: left; border-radius: 4px; background-color: #e52b30; cursor:pointer; color: #fff;" title="View Ticket" onClick="loadpop('View Ticket',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewTicket&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i></div>

							 

									

									<?php if($rest['pnrNo']!=''){?>

									<a onClick="loadpop('Flight Invoice (<?php echo encode($rest['id']); ?>)',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewInvoice&id=<?php echo encode($rest['id']); ?>&invtype=flight" style="cursor:pointer;"><div style="border: 1px solid #329ad4; padding: 5px 13px; float: left; border-radius: 4px; background-color: #329ad4; cursor: pointer; color: #fff; margin-left: 8px;" title="View Invoice"><i class="fa fa-info" aria-hidden="true"></i></div></a>

									<?php } ?>
									 </div>

							 	  <?php // if($rest['updateDatePNR']!=""){ echo date('d M Y h:i a', strtotime($rest['updateDatePNR'])); } ?>					 								</td>
								</tr>

								 <?php $sNo++; } ?>
							</tbody>
						</table>
									<?php if($sNo==1){?>
<div style="text-align:center; padding:40px;">No Booking Found</div>
<?php } ?>	

		    </div>

					 <div class="card-footer text-right" style="overflow:hidden;">

		 

										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>

											<div class="pagingnumbers"><?php echo $paging; ?></div>

											

						 

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

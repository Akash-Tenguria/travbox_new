<?php
include "inc.php"; 
include "config/logincheck.php";  
$selectedpage=''; 
$selectleft='invoice';
$selectintab='flight';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Invoice - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title> 
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
                        <h1>Invoice</h1>
                        <?php include "invoicetabs.php"; ?>
						
                        <div class="tbtabcontent">
						<div class="row">
						 
</div>
                        
	<div class="table-responsive">

	<table class="table">
							<thead>
								<tr style="background-color: #f6f6f6;">
								  <th>Date</th>
								  <?php if($_SESSION['agentUserid']==1){ ?>
								  <?php } ?>
								  <th>Booking No. </th>
								  <th>Airline</th>
									<th>Departure</th>
									<th>Arrival</th>
								    <th><div align="center">PNR</div></th>
								    <th align="center"><div align="center">Commission</div></th>
									 
								  <th align="center" style="text-align:center;"><div align="center">GST</div></th>
						 
								    <th align="center"><div align="center">TDS</div></th>
								    <th align="center"><div align="center">Amount</div></th>
								    <th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 


$search='';

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(bookingDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(bookingDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['agent']!=''){
$search.=' and agentId="'.$_REQUEST['agent'].'" ';
}


if($_REQUEST['keyword']!=''){
$search.=' and  (flightName like "%'.$_REQUEST['keyword'].'%" or flightNo like "%'.$_REQUEST['keyword'].'%" or  source like "%'.$_REQUEST['keyword'].'%" or  destination like "%'.$_REQUEST['keyword'].'%" or pnrNo like "%'.$_REQUEST['keyword'].'%" or bookingNumber like "%'.$_REQUEST['keyword'].'%" or totalFare like "%'.$_REQUEST['keyword'].'%" or agentId in (select id from sys_userMaster where gstin like "%'.$_REQUEST['keyword'].'%" ) or agentId in (select id from sys_userMaster where pan like "%'.$_REQUEST['keyword'].'%" ) ) ';
}
 
 $targetpage='flight-bookings-invoice?ga='.$_REQUEST['ga'].'&agent='.$_REQUEST['agent'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','flightBookingMaster',' where   status=2  and agentId="'.$_SESSION['agentUserid'].'" '.$search.'  order by id desc  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 

$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" '); 
$agentcate=mysqli_fetch_array($rs6);

$cft=GetPageRecord('*','flightBookingMaster',' uniqueSessionId="'.$rest['uniqueSessionId'].'" '); 
$cont=mysqli_num_rows($cft);

$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);


$c=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="flight_GST"'); 
$balanceSheetData=mysqli_fetch_array($c); 

$cd=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="TDS"'); 
$balanceSheetDataTDS=mysqli_fetch_array($cd); 
?>							
								<tr>
								  <td align="left" valign="top"><div style="color:#999999; font-size:12px;"><?php echo date('d-m-Y', strtotime($rest['bookingDate'])); ?></div></td>
								  
<?php if($_SESSION['agentUserid']==1){ ?>
<?php } ?>
								  <td align="left" valign="top"><?php echo encode($rest['id']); ?><?php if($cont>1){ ?><br />
<span class="badge bg-blue" style="background-color: #5d5d5e;">Round Trip</span><?php } ?><?php if($rest['fixedDeparture']==1){ ?><br />
<span class="badge bg-blue" >Fixed Departure</span><?php } ?></td>
								  <td align="left" valign="top"><strong><?php echo stripslashes($rest['flightName']); ?>&nbsp;(<?php echo stripslashes($rest['flightNo']); ?>)</strong> </td>
									<td align="left" valign="top" style="font-size:11px;"><?php echo stripslashes($rest['source']); ?></td>

									<td align="left" valign="top" style="font-size:11px;"><?php echo stripslashes($rest['destination']); ?></td>
								    <td align="left" valign="top" style="font-size:11px;"><?php echo stripslashes($rest['pnrNo']); ?></td>
								    <td align="center" valign="top" style="font-size:11px;"><?php echo stripslashes($rest['agentCommision']); ?></td>
									
									
 
<td align="center" valign="top"> 

<?php echo round($rest['agentCommision']*18/100); $totalgst=($totalgst+round($rest['agentCommision']*18/100)); ?></td>							  
 
									
									
									
								    <td align="center" valign="top" style="font-size:11px;"><?php echo stripslashes($balanceSheetDataTDS['amount']); ?></td>
								    <td align="left" valign="top" style="font-size:11px;"><div align="center"><?php echo stripslashes($rest['agentTotalFare']); ?></div></td>
								    <td align="left" valign="top" style="font-size:11px;"><a onClick="loadpop('Flight Invoice (<?php echo encode($rest['id']); ?>)',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewInvoice&id=<?php echo encode($rest['id']); ?>&invtype=flight" style="cursor:pointer;" class="btn btn-primary btn-sm"><i class="fa fa-print" aria-hidden="true" style="font-size:16px;"></i></a></td>
								</tr>
								 <?php $sNo++; } ?>
							</tbody>
						</table>
									<?php if($sNo==1){?>
<div style="text-align:center; padding:40px;">No Invoice Found</div>
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

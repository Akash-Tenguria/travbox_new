<?php  
include "inc.php";  
include "config/logincheck.php"; 
$todaydate=$_REQUEST['todaydate'];
?> 

<h1>Tour Calendar</h1>

<div class="todaydate" style="cursor:pointer;" onclick="tourcal('<?php echo date('d-m-Y'); ?>');"><strong>Today:</strong> <?php echo date('j F Y'); ?></div>
<div class="calgrid">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><i class="fa fa-angle-left" aria-hidden="true" onclick="tourcal('<?php echo date('d-m-Y',strtotime($todaydate . "-1 days")); ?>');"></i></td>
    <td width="18%">
	<div class="caltab"  onclick="tourcal('<?php echo date('d-m-Y',strtotime($todaydate . "-2 days")); ?>');">
	<div class="boxcont"><?php $before2days=date('d-m-Y',strtotime($todaydate . "-2 days"));  echo date('D',strtotime($before2days)); ?></div>
	<div class="boxcont2"><?php echo date('d M',strtotime($before2days)); ?></div>
	</div>	</td>
	
	
    <td width="18%"><div class="caltab"  onclick="tourcal('<?php echo date('d-m-Y',strtotime($todaydate . "-1 days")); ?>');">
		<div class="boxcont"><?php $before1days=date('d-m-Y',strtotime($todaydate . "-1 days"));  echo date('D',strtotime($before1days)); ?></div>
	<div class="boxcont2"><?php echo date('d M',strtotime($before1days)); ?></div>
	</div></td>
    <td width="18%"><div class="active"  onclick="tourcal('<?php echo date('d-m-Y',strtotime($todaydate . "+0 days")); ?>');" style="    width: 50px;">
<div class="boxcont"><?php $before0days=date('d-m-Y',strtotime($todaydate . "-0 days"));  echo date('D',strtotime($before0days)); ?></div>
	<div class="boxcont2"><?php echo date('d M',strtotime($before0days)); ?></div>
	</div></td>
    <td width="18%"><div class="caltab"  onclick="tourcal('<?php echo date('d-m-Y',strtotime($todaydate . "+1 days")); ?>');">
	<div class="boxcont"><?php $after1days=date('d-m-Y',strtotime($todaydate . "+1 days"));  echo date('D',strtotime($after1days)); ?></div>
	<div class="boxcont2"><?php echo date('d M',strtotime($after1days)); ?></div>
	</div></td>
    <td width="18%"><div class="caltab"  onclick="tourcal('<?php echo date('d-m-Y',strtotime($todaydate . "+2 days")); ?>');">
<div class="boxcont"><?php $after2days=date('d-m-Y',strtotime($todaydate . "+2 days"));  echo date('D',strtotime($after2days)); ?></div>
	<div class="boxcont2"><?php echo date('d M',strtotime($after2days)); ?></div>
	</div></td>
    <td><i class="fa fa-angle-right" aria-hidden="true"  onclick="tourcal('<?php echo date('d-m-Y',strtotime($todaydate . "+1 days")); ?>');"></i></td>
  </tr>
</table> 
</div>

<?php  
$ax=0;
$todaydate=date('Y-m-d',strtotime($todaydate));
$limit=clean($_GET['records']); 
$page=clean($_GET['page']);  
$sNo=1;  

$search='';  
$targetpage='flight-booking?status='.$_REQUEST['status'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&';  
$rs=GetRecordList('*','flightBookingMaster',' where 1 and agentBookingType=0 and bookingType=0   and agentId="'.$_SESSION['agentUserid'].'" and journeyDate="'.$todaydate.'" order by id desc  ','50',$page,$targetpage); 
 

$totalentry=$rs[1]; 

$paging=$rs[2];  

while($rest=mysqli_fetch_array($rs[0])){  

$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" ');  
$agentcate=mysqli_fetch_array($rs6); 

$cft=GetPageRecord('*','flightBookingMaster',' uniqueSessionId="'.$rest['uniqueSessionId'].'" ');  
$cont=mysqli_num_rows($cft); 

$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" ');  
$agentData=mysqli_fetch_array($ag); 

$ba=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="flight" ');  

?>

<div class="caleventouter">

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="right" style="padding-right:5px; font-weight:700;"><?php echo $rest['departureTime']; ?></td>
    <td width="70%"><div class="calevent" onClick="loadpop('View Ticket',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewTicket&id=<?php echo encode($rest['id']); ?>">
	<div class="head">Flight  <?php if($rest['status']==1 || $rest['status']==0){ ?><span class="badge bg-blue" style="background-color:#FF6600;">Pending</span><?php } ?>

									<?php if($rest['status']==2){ ?><span class="badge bg-blue" style="background-color:#46cd93;">Confirm</span><?php } ?>

									<?php if($rest['status']==3){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Cancelled</span><?php } ?><?php if($rest['status']==4){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Rejected</span><?php } ?></div>
	<?php echo $rest['flightName']; ?>: <?php echo $rest['flightCode']; ?>-<?php echo $rest['flightNo']; ?> - <?php echo $rest['source']; ?>: <?php echo $rest['departureTime']; ?> - <?php echo $rest['destination']; ?> : <?php echo $rest['arrivalTime']; ?> - <?php echo $editresult['flightStop']; ?> Stop(s)

	</div></td>
  </tr>
</table>


</div>

<?php $ax=1;} ?>


<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 


$search='';
 
 $targetpage='hotels-bookings??ga='.$_REQUEST['ga'].'&status='.$_REQUEST['status'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&';
   
$rs=GetRecordList('*','hotelBookingMaster',' where 1 and BookingNumber!="" and agentBookingType=0 and bookingType=0 and CheckIn="'.$todaydate.'" and  status!=0 and agentId="'.$_SESSION['agentUserid'].'" '.$search.' order by id desc  ','50',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 

$ag=GetPageRecord('COUNT(id) as totaladult','hotelBookingPaxDetailMaster',' BookingNumber="'.$rest['BookingNumber'].'" and paxType="adult" '); 
$totalbookungpax_adult=mysqli_fetch_array($ag);


$ag=GetPageRecord('COUNT(id) as totalchild','hotelBookingPaxDetailMaster',' BookingNumber="'.$rest['BookingNumber'].'" and paxType="child" '); 
$totalbookungpax_child=mysqli_fetch_array($ag);
 
$ag=GetPageRecord('roomNo','hotelBookingPaxDetailMaster',' BookingNumber="'.$rest['BookingNumber'].'"  order by roomNo desc '); 
$totalbookungpax_room=mysqli_fetch_array($ag);

$ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);
$clientName='';
$clientEmail='';
$clientPhone='';

$clientName=strip($agentData['companyName']);

 
$ag=GetPageRecord('*','clientMaster',' id="'.$rest['clientId'].'" '); 
$clientData=mysqli_fetch_array($ag);

if($agentData['isAgent']==0){
$clientName= ($clientData['name']);
}
$clientEmail= ($clientData['email']);
$clientPhone= ($clientData['phone']);


?>

<div class="caleventouter">

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="right" style="padding-right:5px; font-weight:700;"><?php echo $rest['departureTime']; ?></td>
    <td width="70%"><div class="calevent" onClick="loadpop('View Hotel Voucher',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewHotelVoucher&id=<?php echo encode($rest['id']); ?>&page=<?php echo $_REQUEST['ga']; ?>">
	<div class="head">Hotel <?php if($rest['status']==1){ ?><span class="badge bg-blue" style="background-color:#FF6600;">Pending</span><?php } ?>
									<?php if($rest['status']==2){ ?><span class="badge bg-blue" style="background-color:#46cd93;">Confirm</span><?php } ?>
									<?php if($rest['status']==3){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Cancelled</span><?php } ?>
									<?php if($rest['status']==4){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Rejected</span><?php } ?>									</div>
	<?php echo stripslashes($rest['HotelName']); ?> <?php for($i=1; $i<=$rest['Rating']; $i++){ ?>
						  						 <i class="fa fa-star" aria-hidden="true" style="font-size:12px; color: #ffbc00;"></i>
												 <?php } ?> - <?php echo stripslashes($rest['Destination']); ?> - Rooms: <?php echo  stripslashes($totalbookungpax_room['roomNo']); ?> - Adult: <?php echo  stripslashes($totalbookungpax_adult['totaladult']); ?> - Child: <?php echo  stripslashes($totalbookungpax_child['totalchild']); ?>
												 
												 
												 </div></td>
  </tr>
</table>


</div>
<?php $ax=1; } ?>


<?php if($ax==0){?>
<div style="text-align:center; font-size:14px; padding:20px;">No Trip Found</div>
<?php } ?>

 
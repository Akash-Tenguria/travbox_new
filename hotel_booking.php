<?php
include "inc.php"; 
include "config/logincheck.php";  
$selectedpage=''; 
$selectleft='bookings';
$selectintab='hotel';
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
<div class="row newinputbookrow">
<div class="col-lg-12">
<div  style="float: left; margin-top: 0px; margin-bottom: 20px;"> 
<form method="get" id="searchform">
		<div class="row">
		 
		<input name="stage" type="hidden" value="<?php echo $_REQUEST['stage']; ?>" />
		
		<div class="col-xl-3" style="padding-right: 0px;">
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
			<input name="keyword" type="text" class="form-control" id="keyword" placeholder="Enter Keyword" value="<?php echo $_REQUEST['keyword']; ?>"  >
			<span class="input-group-append">
			<button class="btn btn-light bg-primary border-primary text-white" type="submit" style="padding: 6px 12px; width:100%;border-top-right-radius:6px;border-bottom-right-radius:6px;border-bottom-left-radius:0px;border-top-left-radius: 0px; margin-left: 7px;height:37px;"><i class="fa fa-search" aria-hidden="true"></i></button>
			</span>
			</div>
			</div>
				
				
				 	</div>
		</form>
</div>
</div>
</div>

</div>
</div>
                        
	<div class="table-responsive">

	<table class="table">
							<thead>
								<tr  style="background-color: #f6f6f6;">
								  <th>Booking ID </th>
								  <th>Hotel</th>
									<th>Date</th>
									<th>Room Type</th>
									<th>Pax  </th>
									<th>Amount</th>
									<th align="left">Status</th>
								    <th align="left">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 


$search='';

if($_REQUEST['status']!=''){
$search.=' and status="'.$_REQUEST['status'].'" ';
}

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['keyword']!=''){
$search.=' and  (BookingNumber = "'.$_REQUEST['keyword'].'" or  HotelName like "%'.$_REQUEST['keyword'].'%"  or  Destination like "%'.$_REQUEST['keyword'].'%"   ) ';
}
 
 $targetpage='hotels-bookings??ga='.$_REQUEST['ga'].'&status='.$_REQUEST['status'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&';
   
$rs=GetRecordList('*','hotelBookingMaster',' where 1 and BookingNumber!="" and agentBookingType=0 and bookingType=0 and status!=0 and agentId="'.$_SESSION['agentUserid'].'" '.$search.' order by id desc  ','25',$page,$targetpage); 
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
								
								<tr>
								  <td align="left" valign="top">
								  <strong><?php echo $rest['BookingNumber']; ?></strong>
								  <div style="font-size:11px; color:#666666;">Ref. <?php echo encode($rest['id']); ?></div>
								  <div style="width:140px; font-size:11px;"><?php echo date('d-m-Y h:i A', strtotime($rest['addDate'])); ?></div></td>
								  <td align="left" valign="top"><div class="green-lighter" >
								  				<div>
								  				<?php for($i=1; $i<=$rest['Rating']; $i++){ ?>
						  						 <i class="fa fa-star" aria-hidden="true" style="font-size:12px; color: #ffbc00;"></i>
												 <?php } ?></div>  
												  <strong><?php echo stripslashes($rest['HotelName']); ?></strong></div>
												  City: <strong><?php echo stripslashes($rest['Destination']); ?></strong>												  </td>
									<td align="left" valign="top"><div style="width:130px;"><strong>Checkin: </strong><?php echo date('d-m-Y', strtotime($rest['CheckIn'])); ?><br />
<strong>Checkout: </strong><?php echo date('d-m-Y', strtotime($rest['CheckOutDate'])); ?></div></td>
									<td align="left" valign="top"><div style="width:150px; font-size:11px;"><?php echo stripslashes($rest['RoomType']); ?></div></td>
									<td align="left" valign="top"><div style="width:60px;"><strong>Room: </strong><?php echo  stripslashes($totalbookungpax_room['roomNo']); ?><br />
<strong>Adult: </strong><?php echo  stripslashes($totalbookungpax_adult['totaladult']); ?><br />
<strong>Child: </strong><?php echo  stripslashes($totalbookungpax_child['totalchild']); ?> </div></td>
									<td align="left" valign="top">&#8377;<?php echo round($rest['agentTotalFare']); ?></td>
									<td align="left" valign="top"><?php if($rest['status']==1){ ?><span class="badge bg-blue" style="background-color:#FF6600;">Pending</span><?php } ?>
									<?php if($rest['status']==2){ ?><span class="badge bg-blue" style="background-color:#46cd93;">Confirm</span><?php } ?>
									<?php if($rest['status']==3){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Cancelled</span><?php } ?>
									<?php if($rest['status']==4){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Rejected</span><?php } ?>									</td>
								    <td align="left" valign="top"> 
									<button type="button" class="btn btn-primary btn-sm" onClick="loadpop('View Hotel Voucher',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewHotelVoucher&id=<?php echo encode($rest['id']); ?>&page=<?php echo $_REQUEST['ga']; ?>">Voucher</button></td>
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

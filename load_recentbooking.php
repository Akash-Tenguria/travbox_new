<?php
include "inc.php";
$id=$_REQUEST['id'];
if($id!=''){
?>
<div class="tbtabsouter">
<a onClick="recentbooking('flight');" <?php if($id=='flight'){ ?>class="active"<?php } ?>>Flights</a>
<a  onClick="recentbooking('hotel');"  <?php if($id=='hotel'){ ?>class="active"<?php } ?>>Hotels</a>
<a  onClick="recentbooking('hotel_enquiries');" <?php if($id=='hotel_enquiries'){ ?>class="active"<?php } ?>>Hotels Enquiries</a>
<a  onClick="recentbooking('holiday_enquiries');"  <?php if($id=='holiday_enquiries'){ ?>class="active"<?php } ?>>Holidays Enquiries</a> 
</div>
<?php if($id=='flight'){ 

$b=GetPageRecord('count(id) as totalcountbooking','flightBookingMaster','  agentBookingType=0 and bookingType=0  and agentId="'.$_SESSION['agentUserid'].'" ');  
$totalbookings=mysqli_fetch_array($b); 
?>
<div class="tbtabcontent">
<?php if($totalbookings['totalcountbooking']>0){?>

<table border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" class="table" style="margin-bottom:0px;"> 
                                <thead> 
                                    <tr style="background-color: #f6f6f6;"> 
                                        <th align="left" valign="middle">Booking </th> 
                                        <th align="left" valign="middle">Flight</th> 
                                        <th align="left" valign="middle">Sector</th> 
                                        <th align="left" valign="middle">Status </th> 
                                        <th align="center" valign="middle"><div align="center"> Fare </div></th>
                                    </tr>
                                </thead>

                                <tbody>
<?php  
$limit=clean($_GET['records']); 
$page=clean($_GET['page']);  
$sNo=1;  

$search='';  
$targetpage='flight-booking?status='.$_REQUEST['status'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&';  
$rs=GetRecordList('*','flightBookingMaster',' where 1 and agentBookingType=0 and bookingType=0   '.$search.' and agentId="'.$_SESSION['agentUserid'].'" order by id desc  ','5',$page,$targetpage); 

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

<tr  onClick="loadpop('View Ticket',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewTicket&id=<?php echo encode($rest['id']); ?>">

<td align="left" valign="middle">
<strong>Ref.:</strong> <?php echo encode($rest['id']); ?><br>
<span style="font-size:11px;"><?php echo date('d-m-Y h:i A', strtotime($rest['bookingDate'])); ?></span></td>

<td align="left" valign="middle"><span style="color:#000;"><i
class="fa fa-plane" aria-hidden="true"></i>
<strong><?php echo stripslashes($rest['flightName']); ?>&nbsp;(<?php echo stripslashes($rest['flightNo']); ?>)<br>
</strong></span><strong>
<div style="color:#CC0000; margin-top:2px;"><i
class="fa fa-calendar-check-o" aria-hidden="true"></i>
<?php echo date('d-m-Y', strtotime($rest['journeyDate'])); ?></div>

<?php if($rest['pnrNo']!=''){?><div class="pnrtag"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo stripslashes($rest['pnrNo']); ?></div><?php } ?>	

</strong></td>

<td align="left" valign="middle"><strong>From:
</strong><?php echo $rest['source']; ?><br><strong>To:</strong> <?php echo $rest['destination']; ?></td>

<td align="left" valign="middle"> <?php if($rest['status']==1 || $rest['status']==0){ ?><span class="badge bg-blue" style="background-color:#FF6600;">Pending</span><?php } ?>

									<?php if($rest['status']==2){ ?><span class="badge bg-blue" style="background-color:#46cd93;">Confirm</span><?php } ?>

									<?php if($rest['status']==3){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Cancelled</span><?php } ?><?php if($rest['status']==4){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Rejected</span><?php } ?></td>

<td align="center" valign="middle" style="font-size:14px;">
<div align="center">&#8377;<?php echo stripslashes($rest['agentTotalFare']); ?> </div>
 
</td>
</tr>
<?php $sNo++; } ?>
                </table>
				
<?php }  else { ?>
<div style="text-align:center; padding:30px;"><img src="data:image/png;base64,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">
<div style="margin-top:10px; ">No Booking Found</div>
</div>
<?php } ?>
 

</div>
<?php } ?>




<?php if($id=='hotel'){ 

$b=GetPageRecord('count(id) as totalcountbooking','hotelBookingMaster','  BookingNumber!="" and agentBookingType=0 and bookingType=0 and status!=0 and agentId="'.$_SESSION['agentUserid'].'" ');  
$totalbookings=mysqli_fetch_array($b); 
?>
<div class="tbtabcontent">
<?php   if($totalbookings['totalcountbooking']>0){?>

<table border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" class="table" style="margin-bottom:0px;"> 
                                <thead> 
                                    <tr style="background-color: #f6f6f6;"> 
                                        <th align="left" valign="middle">Booking </th> 
                                        <th align="left" valign="middle">Hotel</th> 
                                        <th align="left" valign="middle">Date</th> 
                                        <th align="left" valign="middle">Room Type </th>
                                        <th align="left" valign="middle">Pax</th>
                                        <th align="left" valign="middle">Status </th> 
                                        <th align="center" valign="middle"><div align="center"> Fare </div></th>
                                    </tr>
                                </thead>

                                <tbody>
<?php 
$limit=clean($_GET['records']); 
$page=clean($_GET['page']);  
$sNo=1;  

$search='';
$targetpage='display.html?ga='.$_REQUEST['ga'].'&status='.$_REQUEST['status'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&';

$rs=GetRecordList('*','hotelBookingMaster',' where 1 and BookingNumber!="" and agentBookingType=0 and bookingType=0 and status!=0 and agentId="'.$_SESSION['agentUserid'].'"  order by id desc  ','5',$page,$targetpage);  
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

<tr onClick="loadpop('View Hotel Voucher',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewHotelVoucher&id=<?php echo  encode($rest['id']); ?>&page=<?php echo $_REQUEST['ga']; ?>">

<td align="left" valign="middle">
<strong>Ref.:</strong> <?php echo encode($rest['id']); ?><br>
<span style="font-size:11px;"><?php echo date('d-m-Y h:i A', strtotime($rest['addDate'])); ?></span></td>

<td align="left" valign="middle"><span style="color:#000;"><?php for($i=1; $i<=$rest['Rating']; $i++){ ?><i class="fa fa-star" aria-hidden="true" style="font-size:12px; color: #ffbc00;"></i><?php } ?><br>
<strong><?php echo stripslashes($rest['HotelName']); ?></strong><br>
City: <strong><?php echo stripslashes($rest['Destination']); ?>
 
<div style="color:#CC0000; margin-top:2px;"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
<?php echo date('d-m-Y', strtotime($rest['CheckIn'])); ?></div>

<?php if($rest['pnrNo']!=''){?><div class="pnrtag"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo stripslashes($rest['pnrNo']); ?></div><?php } ?>	

</strong></td>

<td align="left" valign="middle"><strong>Check-in:</strong> </strong><?php echo date('d-m-Y', strtotime($rest['CheckIn'])); ?><br /><strong>Check-out:</strong><?php echo date('d-m-Y', strtotime($rest['CheckOutDate'])); ?></td>

<td align="left" valign="middle"><div style="width:150px; font-size:11px;"><?php echo stripslashes($rest['RoomType']); ?></div></td>
<td align="left" valign="middle"><strong>Room: </strong><?php echo  stripslashes($totalbookungpax_room['roomNo']); ?><br />

<strong>Adult: </strong><?php echo  stripslashes($totalbookungpax_adult['totaladult']); ?><br />

<strong>Child: </strong><?php echo  stripslashes($totalbookungpax_child['totalchild']); ?> </td>
<td align="left" valign="middle"><?php if($rest['status']==1){ ?><span class="badge bg-blue" style="background-color:#FF6600;">Pending</span><?php } ?>

									<?php if($rest['status']==2){ ?><span class="badge bg-blue" style="background-color:#46cd93;">Confirm</span><?php } ?>

									<?php if($rest['status']==3){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Cancelled</span><?php } ?>

									<?php if($rest['status']==4){ ?><span class="badge bg-blue" style="background-color:#f9392f;">Rejected</span><?php } ?>									</td>

<td align="center" valign="middle" style="font-size:14px;">
<div align="center">&#8377;<?php echo round($rest['agentTotalFare']); ?> </div>                                        </td>
</tr>
<?php $sNo++; } ?>
                </table>
				
<?php }  else { ?>
<div style="text-align:center; padding:30px;"><img src="data:image/png;base64,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" style="height:64px;">
<div style="margin-top:10px; ">No Booking Found</div>
</div>
<?php } ?>
 

</div>
<?php } ?>



<?php if($id=='hotel_enquiries'){ 

$b=GetPageRecord('count(id) as totalcountbooking','hotelEnquiry','   1   and agentId="'.$_SESSION['agentUserid'].'" ');  
$totalbookings=mysqli_fetch_array($b); 
?>
<div class="tbtabcontent">
<?php   if($totalbookings['totalcountbooking']>0){?>

<table border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" class="table" style="margin-bottom:0px;"> 
                                <thead> 
                                    <tr style="background-color: #f6f6f6;"> 
                                        <th align="left" valign="middle">Hotel</th> 
                                        <th align="left" valign="middle">Room</th> 
                                        <th align="left" valign="middle">Date</th>
                                        <th align="left" valign="middle">Contact</th>
                                        <th align="left" valign="middle">Notes </th> 
                                    </tr>
                                </thead>

                                <tbody>
<?php 
$limit=clean($_GET['records']); 
$page=clean($_GET['page']);  
$sNo=1;  

$search='';
$targetpage='display.html?ga='.$_REQUEST['ga'].'&status='.$_REQUEST['status'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&';

$rs=GetRecordList('*','hotelEnquiry',' where 1   and agentId="'.$_SESSION['agentUserid'].'"   order by id desc  ','5',$page,$targetpage);  
$totalentry=$rs[1];  
$paging=$rs[2];   
while($rest=mysqli_fetch_array($rs[0])){  
 

?>

<tr  >

<td align="left" valign="middle"><span style="color:#000;"><?php echo strip($rest['hotelName']); ?> <br />

<strong>Destination: </strong><?php echo strip($rest['city']); ?>	<br>

<div style="width:140px;"><?php echo date('d-m-Y h:i A', strtotime($rest['addDate'])); ?></div>	</td>

<td align="left" valign="middle"><?php echo strip($rest['roomName']); ?><br />

<strong>Rooms:</strong> <?php echo strip($rest['room']); ?> |  <strong>Adult:</strong> <?php echo strip($rest['room']); ?> | <strong>Child:</strong> <?php echo strip($rest['child']); ?></td>

<td align="left" valign="middle"><div style="width:130px;"><strong>Checkin: </strong><?php echo date('d-m-Y', strtotime($rest['startDate'])); ?><br />

<strong>Checkout: </strong><?php echo date('d-m-Y', strtotime($rest['endDate'])); ?></div></td>
<td align="left" valign="middle"><?php echo strip($rest['name']); ?><br />

                                      <strong>Phone:</strong> <?php echo strip($rest['mobile']); ?><br />

<strong>Email:</strong> <?php echo strip($rest['email']); ?></td>
<td align="left" valign="middle"><?php echo strip($rest['notes']); ?></td>
</tr>
<?php $sNo++; } ?>
                </table>
				
<?php }  else { ?>
<div style="text-align:center; padding:30px;"><img src="data:image/png;base64,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" style="height:64px;">
<div style="margin-top:10px; ">No Enquiry Found</div>
</div>
<?php } ?>
 

</div>
<?php } ?>





<?php if($id=='holiday_enquiries'){ 

$b=GetPageRecord('count(id) as totalcountbooking','packageEnquiry','     agentId="'.$_SESSION['agentUserid'].'" ');  
$totalbookings=mysqli_fetch_array($b); 
?>
<div class="tbtabcontent">
<?php   if($totalbookings['totalcountbooking']>0){?>

<table border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" class="table" style="margin-bottom:0px;"> 
							<thead>
								<tr style="background-color: #f6f6f6;">
								  <th>Package </th>
									<th>Destination</th>
									<th>Departure</th>
									<th>Departure Date </th>
									<th>Contact</th>
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
$search.=' and  DATE(CheckIn)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(CheckIn)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['keyword']!=''){
$search.=' and  (Destination like "%'.$_REQUEST['keyword'].'%" or  HotelName like "%'.$_REQUEST['keyword'].'%" or  HotelCode like "%'.$_REQUEST['keyword'].'%" or RoomType like "%'.$_REQUEST['keyword'].'%" or agentId in (select id from sys_userMaster where companyName like "%'.$_REQUEST['keyword'].'%" ) ) ';
}
 
 $targetpage='holidays-enquiries?ga='.$_REQUEST['ga'].'&status='.$_REQUEST['status'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&';
  
$rs=GetRecordList('*','packageEnquiry',' where 1   '.$search.'  and agentId="'.$_SESSION['agentUserid'].'" order by id desc','2005',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 
 $ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);
?>
								
								<tr>
								  <td align="left" valign="top"><strong><?php echo strip($rest['packageName']); ?></strong><div style="width:140px;"><?php echo date('d-m-Y h:i A', strtotime($rest['addDate'])); ?></div></td>
									<td align="left" valign="top"><?php echo strip($rest['citydestination']); ?></td>
									<td align="left" valign="top"><?php echo strip($rest['departureCity']); ?></td>
									<td align="left" valign="top"><?php echo strip($rest['departureDate']); ?></td>
								  <td align="left" valign="top"><?php echo strip($rest['name']); ?><br />
                                      <strong>Phone:</strong> <?php echo strip($rest['mobile']); ?><br />
<strong>Email:</strong> <?php echo strip($rest['email']); ?></td>
								</tr>
								 <?php $sNo++; } ?>
							</tbody>
						</table>
				
<?php }  else { ?>
<div style="text-align:center; padding:30px;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFPklEQVR4nO2ba0/bVhiA8239A5v27/p1WgItNw213ELCPU4ICYSSkhPihIRLLgRaIKlW0Zato6ZboaRQCBujQKtKa6kYdNOkdzrnYONAUgK244j4SK+U2OfYfp5ztWXrdFrSkpa0dAVT13e+bxi9h2MM6LGuNOHRMmNAYDGgZ7pSSvaywa8tBrSE4Rm951Xn9+hbXakkuwaPtJpntGaPpPX5xuvomsXgsTEGzx4ZSK5AWPSeXUaPrJjtXAEWAq/+RSsUzLkCmOOan/hpF5Kb/6gW3N5/sPkRhMD/+X0zK/vQ2xQlUAPGCKS2DzPybvwFMLf1r5B/Yn6H5LWVe9/nIQCRzMUEv3gB+PVT8PzxeC7FBLjMcXC1TBZVzYuPJ6uAUHQZQrGVjG3ZyrG+BfD5flG15vn9sgrorhkmeaJz2zkFhBNp2u8q/JDYOFIVXnYBPu9TkqeveSJnF+htjJA8geCi6vCyCJh9fXjye/UAHHVj4GwM54TqM8Whv2Uqo1xi/RCS6cLDSxYQHFsC6w0fqXkMT2DSR3k1bQKS+gRe9zww5V4YGpxXfMBTRABzvN1xaxQSa38L+yIPt+BO1zTYKv1gu+kjXWF0MiXUNBbVc2uUli9DEIosF7TmZesC4UQanPVhcDaEBQGBkd8IlLUcgbcZgb8NQfdNLyk/6HwIyfRnEnhscLVOkgWJGvCyD4JJvLp68obAu+sQvFu6C/DeTeJT2g3BTiohFHmpyoBXEAGDjh9Jvp3nJ/B8HPzuBkf1EDjrxosCXpIAlzkuFBZPc466ceivRWfg+YjYaZmZNTpoDrSeHAd1TBUUXhEBzvovCwjbaTeYXTsgF+tpnxSO426bLCi8Ml3ASbvAm8XsXaCnykskqdnsFRUQm6eD4MBtBG/Fg+CGG4Y76DHiUytFAY/PK1lAdG4b+kwTZBrEzRpvGx49Ow3abtCm7++fg80PxQGPy0sSEIq9PBkHzHG6pBXE/AkDzAx0VwXAWsGSceJe4nVRwcsioOeHIAyPvchc/p5a16s91eU6r2QBySw3Rn3GKGkNasGv7n0mkQ+87AICwUWSB9/y8tvwPI/nd6XhV3eOIOB4IADh33jbl+BlFZDYOAJbBUvy4PsD/mL5ckrDu00x+qClmgVbtY+uK0wxsi8XvOwtwOd9CoGRXzMuli+nJPxdM4XvaRqBmkcREt1NQbLtjilKzlcQAcksF4tXekqt8MQ132McgepHYahciJKoehIB5lgCfkBzf3m/MAI4iQPeg9Q+3Fv6cLGaN9Ka5+H5wNssDQH6mM6YvSXIKoCTAL+yfQSD1oRwQfhhys/pg0vDiyV0NfgFCdOnJMgmgJMIjy+OnKNmiIYBEUjxSH5ReD5w1+hsYLNKkEUAJxHe1Uz324x+cL2aJYF/UwlRQcJl4LNJEK9TJAvg5Ib/I0lDJMFtjsKL9Y+XhhdLaG9iwdkWk0cApxT8cfSlZgQJ1jKvJPgMEQsTwK5uSRPAKQzPR+/zaWDK6bntxlDGVCclqp7FAKU2LieAkxEe13IueHE3sDSyssELEhaiFxfAXRF4Pi4sYPMKwUsS4BY9zS22aDOxAmCbkT2738xeXkAlf+AmesdVjNHaLBJgOiugtUUGAZXHy8z2eiqi4/YQVM9Jm57UiLwFWPArZQYEtfGxKwNfe3+cjjN6z24+LYBRu2krGF3nCmi8jq4RCXrP2yK4YFkC17xF77HYy+xf6fJJdu2ta6S9dc1ob10j7UuLkkkM/boK8IdG+IMjXaklxoAe46+rShJeS1rSkq6U0/+pKf+JjuWW9QAAAABJRU5ErkJggg==">
<div style="margin-top:10px; ">No Enquiry Found</div>
</div>
<?php } ?>
 

</div>
<?php } ?>






<?php } ?>

  
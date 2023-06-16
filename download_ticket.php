<?php 
include "inc.php"; 

 

if($_REQUEST['id']!=''){ 
$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" '); 
$editresult=mysqli_fetch_array($a); 

$detailArray = json_decode(stripslashes(unserialize($editresult['detailArray'])));

$urs=GetPageRecord('*','sys_userMaster',' id="'.$editresult['agentId'].'" '); 
$agentData=mysqli_fetch_array($urs); 
} 




$rto=GetPageRecord('SUM(agentTotalFare) as totalagentTotalFare, SUM(agentCommision) as totalagentCommision, SUM(agentBaseFare) as totalagentBaseFare, SUM(agentFixedMakup) as totalagentFixedMakup, SUM(mealPrice) as totalmealPrice, SUM(extraBaggagePrice) as totalextraBaggagePrice, SUM(tax) as totaltax','flightBookingMaster',' roundTripId="'.$editresult['roundTripId'].'"  '); 
$totalcostings=mysqli_fetch_array($rto);
?>

<div id="DivIdToPrint" style="max-width: 890px; margin: auto; background-color:#F8F8F8;">
<div style="width:100%; background-color:#FFFFFF;">
<style>
@media print {
table tr td { font-family:Arial, Helvetica, sans-serif;  font-size:13px; }
}

@page { margin: 0; }
.multiflightbox{padding:10px; border:1px solid #000; margin-left:0px; margin-right:0px; margin-bottom:10px;}
</style>
 


<table width="100%" border="1" cellpadding="20" cellspacing="0" bordercolor="#CCCCCC">
   
  <tr>
    <td colspan="3" style="border-bottom:1px solid #ddd;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      
      
      <tr>
        <td style="font-size:20px; font-weight:500;">
		<img src="<?php echo $imgurl; ?><?php echo $agentData['companyLogo']; ?>" height="55">	
		
		
		
 
		
		 
		
		
		
			      </td>
        <td width="50%" align="right">
		<?php if($_REQUEST['ta']!=3){ ?>
		<strong style="font-size:18px;"><?php echo stripslashes($agentData['companyName']); ?></strong><br>

          

<strong> </strong> <?php echo stripslashes($agentData['phone']); ?><br>
<strong> </strong> <?php echo stripslashes($agentData['email']); ?><br />
</strong> <?php echo stripslashes($agentData['address']); ?><?php } ?> </td>
      </tr>
      
    </table></td>
    </tr>
  <tr>
    <td colspan="3"><table width="100%" border="1" cellpadding="10" cellspacing="0" bordercolor="#000000">
      <tr>
        <td colspan="2" align="left" valign="top" style="border-right:1px solid #000;">
		
		Booking Status: <strong> <?php if($editresult['status']==1 || $editresult['status']==0){ ?>
          Pending
          <?php } ?>
          <?php if($editresult['status']==2){ ?>
          Confirmed
          <?php } ?>
          <?php if($editresult['status']==3){ ?>
          Cancelled
          <?php } ?></strong>  <br />

		Booking Id: <strong><?php echo encode($editresult['id']); ?></strong>  <br />
          Booking Type: <strong><?php if($editresult['refundyes']==1){ echo 'Refundable'; } else { echo 'Non-Refundable'; } ?></strong>  <br />
          Booking Time: <?php echo date('D, j M Y', strtotime($editresult['bookingDate'])); ?>ddd</td>
        <td width="50%" align="center" valign="top"><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td colspan="2" align="center"><img src="<?php echo $imgurl.getflightlogo(stripslashes($editresult['flightName'])); ?>" height="45"></td>
            <td width="50%" align="center">
			<div style="font-size:18px; color:#000; text-transform:uppercase;"><?php echo $editresult['pnrNo']; ?></div>
			<div style="font-size:11px; color:#666666; text-transform:uppercase;">Airline PNR</div></td>
          </tr>
          
        </table></td>
      </tr>
      
    </table>
	
	<div style="margin:10px 0px; color:#000000; font-weight:500; text-align:left;">Flight Details</div>
	
	<?php if($editresult['searchArrey']!='' && $editresult['flightStop']>0){ ?>
	
	<?php if($editresult['apiType']=='kafila' && $editresult['searchArrey']!=''){
foreach((array) unserialize(stripslashes($editresult['searchArrey'])) as $layoverFlight){

if($layoverFlight->FLIGHT_NAME!=''){
?>
<div class="row multiflightbox">
<div class="col-3">
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" style="padding-right:10px;"><img src="<?php echo $imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])); ?>" width="32" height="32"></td>
    <td>
	<div class="flightname"><?php echo $layoverFlight->FLIGHT_NAME; ?> </div>
	<div class="flightnumber"><?php echo $layoverFlight->FLIGHT_CODE; ?> <?php echo $layoverFlight->FLIGHT_NO; ?></div>
	
	</td>
  </tr>
</table>

</div>

<div class="col-9">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div class="coltime">
	<?php echo $layoverFlight->DEP_TIME; ?></div>
	<div class="graysmalltext">
	<?php echo $layoverFlight->ORG_NAME; ?></div>
	</td>
    <td width="33%" align="center"><div class="nostops"><?php echo $layoverFlight->DURATION; ?></div> </td>
    <td width="33%" align="center"><div class="coltime">
	<?php echo $layoverFlight->ARRV_TIME; ?></div>
	<div class="graysmalltext">
	<?php echo $layoverFlight->DES_NAME; ?></div></td>
  </tr>
</table>

</div>

<?php if($layoverFlight->LAYOVER_INFO!=''){ ?>
  <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600; border-radius: 24px; margin-top:20px;"><?php echo $layoverFlight->LAYOVER_INFO; ?></div>
<?php } ?>
</div>

	  <?php  $j++; } }
	  
	  
	  
	  } ?>
	  
	  
	  
	  
	   <?php  if($editresult['apiType']=='tbo' && $editresult['searchArrey']!=''){ 
		
		$segmentsDataArr=(array) unserialize(stripslashes($editresult['searchArrey']));
		
		$numberOfStop=count($segmentsDataArr['Segments'][0]);
		if(count($numberOfStop)>0)
		{
		
			foreach($segmentsDataArr['Segments'][0] as $segmentsDataArrValue)
			{
			
			
		?>
		
		<div class="row multiflightbox">
<div class="col-3">
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" style="padding-right:10px;"><img src="<?php echo $imgurl.getflightlogo(stripslashes( $segmentsDataArrValue['Airline']['AirlineName'])); ?>" width="32" height="32"></td>
    <td>
	<div class="flightname"><?php echo $segmentsDataArrValue['Airline']['AirlineName']; ?> </div>
	<div class="flightnumber"><?php echo $segmentsDataArrValue['Airline']['AirlineCode']; ?> <?php echo $segmentsDataArrValue['Airline']['FlightNumber']; ?></div>
	
	</td>
  </tr>
</table>

</div>

<div class="col-9">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div class="coltime">
	<?php echo date('d-m-Y H:i A',strtotime($segmentsDataArrValue['Origin']['DepTime'])); ?></div>
	<div class="graysmalltext">
	<?php echo $segmentsDataArrValue['Origin']['Airport']['CityCode']; ?></div>
	</td>
    <td width="33%" align="center"><div class="nostops"><?php echo sprintf("%d:%02d",   floor($segmentsDataArrValue['Duration']/60), $segmentsDataArrValue['Duration']%60);  ?></div> </td>
    <td width="33%" align="center"><div class="coltime">
	<?php echo date('d-m-Y H:i A',strtotime($segmentsDataArrValue['Destination']['ArrTime'])); ?></div>
	<div class="graysmalltext">
	<?php echo $segmentsDataArrValue['Destination']['Airport']['CityCode']; ?></div></td>
  </tr>
</table>

</div>

<?php if($layoverFlight->LAYOVER_INFO!=''){ ?>
  <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600; border-radius: 24px; margin-top:20px;"><?php echo $layoverFlight->LAYOVER_INFO; ?></div>
<?php } ?>
</div>
			
		<?php
		
		$j++; }
		}
		
		
		//echo "<pre>";
		//print_r($segmentsDataArr);
		//die;
		
	  
	  		//foreach( as $layoverFlight){
			
			
			
			//}
	  
 
	  
	  
	  } ?>
	
	
	 <table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
      <tr>
        <td width="50%" bgcolor="#E9E9E9">Baggage / Cabin</td>
        <td width="50%" bgcolor="#E9E9E9">Class</td>
      </tr>
      <tr>
        <td width="50%" align="left" valign="top"><?php echo $editresult['totalBaggage']; ?></td>
        <td width="50%" align="left" valign="top"><strong><?php echo $editresult['fareClass']; ?></strong></td>
      </tr>
    </table>
	
	<?php } else { ?>
	
	<?php
	$flightway=GetPageRecord('*','flightBookingMaster',' roundTripId="'.$editresult['roundTripId'].'"  order by id asc '); 
		while($flightwayres=mysqli_fetch_array($flightway)){
		?>
	<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000" style="margin-bottom:10px;">
      <tr>
        <td bgcolor="#E9E9E9">Flight</td>
        <td bgcolor="#E9E9E9">Departure</td>
        <td bgcolor="#E9E9E9">Arrival</td>
        <td bgcolor="#E9E9E9"> Stop </td>
        <td bgcolor="#E9E9E9">Baggage / Cabin</td>
        <td bgcolor="#E9E9E9">Class</td>
      </tr>
      <tr>
        <td align="left" valign="top"><div style="font-size:14px; font-weight:500; color:#000000;"><?php echo $flightwayres['flightName']; ?></div>
<?php echo $flightwayres['flightCode']; ?> <?php echo $flightwayres['flightNo']; ?> </td>
        <td align="left" valign="top">
		<div style="font-size:14px; font-weight:500; color:#000000;"><?php echo date('D, j M Y', strtotime($flightwayres['journeyDate'])); ?>, <?php echo $flightwayres['departureTime']; ?></div>
		<?php  $fareType=explode('-',$flightwayres['source']); 
 			echo getflightdestination($fareType[1]); ?> - Terminal: <?php echo $flightwayres['flightTerminal']; ?></td>
        <td align="left" valign="top">
		<div style="font-size:14px; font-weight:500; color:#000000;"><?php echo date('D, j M Y', strtotime($flightwayres['arrivalDate'])); ?>, <?php echo $flightwayres['arrivalTime']; ?></div>
		<?php  $fareType=explode('-',$flightwayres['destination']);  echo getflightdestination($fareType[1]); ?><br></td>
        <td align="left" valign="top"><div style="font-size:14px; font-weight:500; color:#000000;"><?php echo $flightwayres['flightStop']; ?> Stop(s)</div></td>
        <td align="left" valign="top">15kgs / 7kg</td>
        <td align="left" valign="top"><strong><?php echo $flightwayres['fareClass']; ?></strong></td>
      </tr>
    </table>
	<?php } ?>
	
	
	<?php } ?>
	
	<div style="margin:10px 0px; color:#000000; font-weight:500; text-align:left;">Traveller's Details</div>
	
	<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
      <tr>
        <td width="5%" align="center" bgcolor="#E9E9E9"><strong>Sr.</strong></td>
        <td bgcolor="#E9E9E9"><strong>Type</strong></td>
        <td colspan="2" bgcolor="#E9E9E9"><strong>Passenger&nbsp;Name</strong></td>
        <td bgcolor="#E9E9E9"><strong>PNR & Ticket No</strong></td>
        <td bgcolor="#E9E9E9"><strong>Seat</strong></td>
        <td bgcolor="#E9E9E9"><strong>Meal</strong></td>
        <td bgcolor="#E9E9E9"><strong>Extra&nbsp;Baggage</strong></td>
      </tr>
	  <?php 
	  $wheretp='';
	  if($_REQUEST['psid']!=''){
	  $wheretp=' and id="'.$_REQUEST['psid'].'" ';
	  }
	  
	  $ns=1;
		$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$editresult['id'].'" '.$wheretp.' and firstName!="" '); 
		while($paxData=mysqli_fetch_array($rs6)){
	  ?>
      <tr>
        <td width="5%" align="center"><?php echo $ns; ?></td>
        <td><?php echo ucfirst($paxData['paxType']); ?></td>
        <td colspan="2" style="text-transform:uppercase;"><strong><?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?></strong></td>
        <td><?php echo $editresult['pnrNo']; ?> <?php if($paxData['ticketNo']!=''){ echo '-'; ?><?php echo $paxData['ticketNo']; } ?></td>
        <td><?php echo stripslashes($paxData['seatAdultCode']); ?></td>
        <td><?php  $meal=explode(",",stripslashes($paxData['meal'])); echo $meal[0].', '.$meal[1]; ?></td>
        <td><?php  $baggages=explode(',',stripslashes($paxData['baggage'])); echo $baggages[0]; ?></td>
      </tr>
	  <?php $ns++; } ?>
    </table>
	
	
	<?php  if($_REQUEST['ta']!=2){ ?>
	<div style="margin:10px 0px; color:#000000; font-weight:500; text-align:left;">Fare Details </div>
	<?php  if($_REQUEST['psid']!=''){?>
	
	<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#CCCCCC">
      <tr>
        <td width="25%"><strong>Basic Fare</strong></td>
        <td colspan="2">Rs.<?php echo number_format(round(($totalcostings['totalagentBaseFare']+$totalcostings['totalagentFixedMakup'])/$_REQUEST['tp'])); ?></td>
        </tr>
      <tr>
        <td width="25%"><strong>Taxes </strong></td>
        <td colspan="2">Rs.<?php echo number_format(round((($totalcostings['totaltax']/$_REQUEST['tp'])+$totalcostings['totalagentMarkup']/$_REQUEST['tp'])+($_REQUEST['markup']))); ?></td>
      </tr>
     <?php if($editresult['seatPrice']>0){ ?> <tr>
        <td><strong>Seat Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['seatPrice']); ?></td>
      </tr>
	  <?php } ?>
	     <?php if($editresult['mealPrice']>0){ ?> 
      <tr>
        <td><strong>Meal Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($totalcostings['totalmealPrice']); ?></td>
      </tr>
	    <?php } ?>
		    <?php if($editresult['extraBaggagePrice']>0){ ?> 
      <tr>
        <td><strong>Extra Baggage Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($totalcostings['totalextraBaggagePrice']); ?></td>
      </tr>
	      <?php } ?>
      <tr>
        <td width="25%"><strong>Total Fare </strong></td>
        <td colspan="2">Rs.<?php echo number_format(round(round(($totalcostings['totalagentTotalFare']+$totalcostings['totalagentFixedMakup'])/$_REQUEST['tp'])+($_REQUEST['markup']))); ?>
		 
		</td>
      </tr>
    </table>
	<?php } else { ?>
	<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#CCCCCC">
      <tr>
        <td width="25%"><strong>Basic Fare</strong></td>
        <td colspan="2">Rs.<?php echo number_format($totalcostings['totalagentBaseFare']+$totalcostings['totalagentFixedMakup']); ?></td>
        </tr>
      <tr>
        <td width="25%"><strong>Taxes </strong></td>
        <td colspan="2">Rs.<?php echo number_format($totalcostings['totaltax']+$totalcostings['totalagentMarkup']+($_REQUEST['markup'])); ?></td>
      </tr>
     <?php if($editresult['seatPrice']>0){ ?> <tr>
        <td><strong>Seat Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($totalcostings['totalseatPrice']); ?></td>
      </tr>
	  <?php } ?>
	     <?php if($editresult['mealPrice']>0){ ?> 
      <tr>
        <td><strong>Meal Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($totalcostings['totalmealPrice']); ?></td>
      </tr>
	    <?php } ?>
		    <?php if($editresult['extraBaggagePrice']>0){ ?> 
      <tr>
        <td><strong>Extra Baggage Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($totalcostings['totalextraBaggagePrice']); ?></td>
      </tr>
	      <?php } ?>
      <tr>
        <td width="25%"><strong>Total Fare </strong></td>
        <td colspan="2">Rs.<?php echo number_format($totalcostings['totalagentTotalFare']+$totalcostings['totalagentFixedMakup']+($_REQUEST['markup']+$totalcostings['totalmealPrice']+$totalcostings['totalextraBaggagePrice'])); ?></td>
      </tr>
    </table>
	
	<?php } ?>
	
	
	<?php } ?>
	
	<div style="margin:10px 0px; color:#000000; font-weight:500; text-align:left;">Important Information</div>
	1). For departure terminal please check with the airline first.<br />
2). You must download & register on the Aarogya Setu App and carry a valid ID.<br />
3). It is mandatory to wear a mask and carry other protective gear.<br />
4). Use the Airline PNR for all Correspondence directly with the Airline.<br />
5). You must web check-in on the airline website and obtain a boarding pass.<br />
6). Date & Time is calculated based on the local time of the city/destination.<br />
7). For rescheduling/cancellation within 4 hours of the departure time contact the airline directly.<br />
8). Your ability to travel is at the sole discretion of the airport authorities and we shall not be held responsible.<br />
9). Reach the terminal at least 2 hours prior to the departure for domestic flight and 4 hours prior to the departure
of international flight	</td>
  </tr>
</table>
</div>
</div>

<?php if($_REQUEST['mail']!=1){ ?>
<?php if($_REQUEST['sm']==''){ ?>
<div style="text-align: right; width: 100%; overflow:hidden; margin-top:20px;">
<?php if($editresult['status']==2 && $editresult['journeyDate']>=date('Y-m-d')){ ?>
<button type="button" class="btn btn-secondary btn-sm" onclick="loadpop('Cancellation Request',this,'700px')"  popaction="action=flightCancellationRequest&id=<?php echo $_REQUEST['id']; ?>" style="float:left; background-color:#e52b30; margin-right:5px;">Cancellation Request</button>
 
<?php } ?>

<button type="button" class="btn btn-secondary btn-sm" onclick='printDiv();' style="float:right;">Print / Download</button>

</div>
<?php } ?>
<script>
function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint'); 
  var newWin=window.open('','Print-Window'); 
  newWin.document.open(); 
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>'); 
  newWin.document.close(); 

}
</script>
<?php } ?>
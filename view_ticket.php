<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$page='flights';

include 'FLYTBOAPI/APIConstants.php';
include 'FLYTBOAPI/RestApiCaller.php';


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
#DivIdToPrint{width:958px; margin:auto; padding:10px; }
#DivIdToPrint2{width:958px; margin:auto; padding:10px; }
.multiflightbox{padding:10px; border:1px solid #000; margin-left:0px; margin-right:0px; margin-bottom:10px;}
#DivIdToPrint table tr td{padding:5px;}
#DivIdToPrint2 table tr td{padding:5px;}
</style>
 
<style>
.flightfooter{display:none;}
</style>


</head>

<body>

<?php include "header.php"; ?>

 
 


 


<div class="container" style="margin-top:20px; margin-bottom:20px;"> 

<?php if($rest['id']!=''){ ?>
<h2>One Way Flight Voucher</h2>

<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">
 <?php if($rest['status']==1){ ?>
<div class="alert alert-warning" role="alert" style="text-align:center; font-size:16px;">
 Fetching PNR
</div>
<?php } ?>

 <?php if($rest['status']==3){ ?>
<div class="alert alert-danger" role="alert" style="text-align:center; font-size:16px;">
 Canceled
</div>
<?php } ?>
 <?php if($rest['status']==2){ ?>
<div class="alert alert-success" role="alert" style="text-align:center; font-size:16px;">
 Confirmed
</div>
<?php } ?>

<div id="DivIdToPrint">
<style>
@media print {
table tr td { font-family:Arial, Helvetica, sans-serif;  font-size:13px; }
}

@page { margin: 0; }
</style>
 




<?php
if($_REQUEST['id']!=''){
$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['i']).'" and agentId="'.$_SESSION['agentUserid'].'" '); 
$editresult=mysqli_fetch_array($a); 


$urs=GetPageRecord('*','sys_userMaster',' id="'.$editresult['agentId'].'" '); 
$agentData=mysqli_fetch_array($urs); 
} 

$urs=GetPageRecord('*','sys_userMaster',' id="'.$editresult['agentId'].'" '); 
$agentData=mysqli_fetch_array($urs);
?>

<table width="100%" border="1" cellpadding="20" cellspacing="0" bordercolor="#CCCCCC">
   
  <tr>
    <td colspan="3" style="border-bottom:1px solid #ddd;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      
      
      <tr>
        <td style="font-size:20px; font-weight:500;">
		<img src="<?php echo $imgurl; ?><?php echo $agentData['companyLogo']; ?>" height="55">		      </td>
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
	<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#E9E9E9">Flight</td>
        <td bgcolor="#E9E9E9">Departure</td>
        <td bgcolor="#E9E9E9">Arrival</td>
        <td bgcolor="#E9E9E9"> Stop </td>
        <td bgcolor="#E9E9E9">Baggage / Cabin</td>
        <td bgcolor="#E9E9E9">Class</td>
      </tr>
      <tr>
        <td align="left" valign="top"><div style="font-size:14px; font-weight:500; color:#000000;"><?php echo $editresult['flightName']; ?></div>
<?php echo $editresult['flightCode']; ?> <?php echo $editresult['flightNo']; ?> </td>
        <td align="left" valign="top">
		<div style="font-size:14px; font-weight:500; color:#000000;"><?php echo date('D, j M Y', strtotime($editresult['journeyDate'])); ?>, <?php echo $editresult['departureTime']; ?></div>
		<?php  $fareType=explode('-',$editresult['source']); 
 			echo getflightdestination($fareType[1]); ?> - Terminal: <?php echo $editresult['flightTerminal']; ?></td>
        <td align="left" valign="top">
		<div style="font-size:14px; font-weight:500; color:#000000;"><?php echo date('D, j M Y', strtotime($editresult['arrivalDate'])); ?>, <?php echo $editresult['arrivalTime']; ?></div>
		<?php  $fareType=explode('-',$editresult['destination']);  echo getflightdestination($fareType[1]); ?><br></td>
        <td align="left" valign="top"><div style="font-size:14px; font-weight:500; color:#000000;"><?php echo $editresult['flightStop']; ?> Stop(s)</div></td>
        <td align="left" valign="top">15kgs / 7kg</td>
        <td align="left" valign="top"><strong><?php echo $editresult['fareClass']; ?></strong></td>
      </tr>
    </table>
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
        <td colspan="2">Rs.<?php echo number_format(round(($editresult['agentBaseFare']+$editresult['agentFixedMakup'])/$_REQUEST['tp'])); ?></td>
        </tr>
      <tr>
        <td width="25%"><strong>Taxes </strong></td>
        <td colspan="2">Rs.<?php echo number_format(round((($editresult['tax']/$_REQUEST['tp'])+$editresult['agentMarkup']/$_REQUEST['tp'])+($_REQUEST['markup']))); ?></td>
      </tr>
     <?php if($editresult['seatPrice']>0){ ?> <tr>
        <td><strong>Seat Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['seatPrice']); ?></td>
      </tr>
	  <?php } ?>
	     <?php if($editresult['mealPrice']>0){ ?> 
      <tr>
        <td><strong>Meal Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['mealPrice']); ?></td>
      </tr>
	    <?php } ?>
		    <?php if($editresult['extraBaggagePrice']>0){ ?> 
      <tr>
        <td><strong>Extra Baggage Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['extraBaggagePrice']); ?></td>
      </tr>
	      <?php } ?>
      <tr>
        <td width="25%"><strong>Total Fare </strong></td>
        <td colspan="2">Rs.<?php echo number_format(round(round(($editresult['agentTotalFare']+$editresult['agentFixedMakup'])/$_REQUEST['tp'])+($_REQUEST['markup']))); ?></td>
      </tr>
    </table>
	<?php } else { ?>
	<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#CCCCCC">
      <tr>
        <td width="25%"><strong>Basic Fare</strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['agentBaseFare']+$editresult['agentFixedMakup']); ?></td>
        </tr>
      <tr>
        <td width="25%"><strong>Taxes </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['tax']+$editresult['agentMarkup']+($_REQUEST['markup'])); ?></td>
      </tr>
     <?php if($editresult['seatPrice']>0){ ?> <tr>
        <td><strong>Seat Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['seatPrice']); ?></td>
      </tr>
	  <?php } ?>
	     <?php if($editresult['mealPrice']>0){ ?> 
      <tr>
        <td><strong>Meal Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['mealPrice']); ?></td>
      </tr>
	    <?php } ?>
		    <?php if($editresult['extraBaggagePrice']>0){ ?> 
      <tr>
        <td><strong>Extra Baggage Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['extraBaggagePrice']); ?></td>
      </tr>
	      <?php } ?>
      <tr>
        <td width="25%"><strong>Total Fare </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['agentTotalFare']+$editresult['agentFixedMakup']+($_REQUEST['markup']+$editresult['mealPrice']+$editresult['extraBaggagePrice'])); ?></td>
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

<div style="margin-top:10px; text-align:center;">
<button type="button" class="btn btn-secondary btn-sm" onClick="printDiv();">Print</button>

</div>

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

</div>
</div>
</div>
</div>
<?php } ?>



 <?php
if($_REQUEST['r']!=''){

$ab=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['r']).'" and agentId="'.$_SESSION['agentUserid'].'"');
$resreturn=mysqli_fetch_array($ab);

 

}

if($resreturn['id']!=''){
 

$a=GetPageRecord('*','flightBookingMaster',' id="'.$resreturn['id'].'" '); 
$editresult=mysqli_fetch_array($a); 

 


 ?>
<h2 style="margin-top:40px;">Round Trip Flight Voucher</h2>

<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">
 <?php if($resreturn['status']==1){ ?>
<div class="alert alert-warning" role="alert" style="text-align:center; font-size:16px;">
 Fetching PNR
</div>
<?php } ?>

 <?php if($resreturn['status']==3){ ?>
<div class="alert alert-danger" role="alert" style="text-align:center; font-size:16px;">
 Canceled
</div>
<?php } ?>
 <?php if($resreturn['status']==2){ ?>
<div class="alert alert-success" role="alert" style="text-align:center; font-size:16px;">
 Confirmed
</div>
<?php } ?>
<div id="DivIdToPrint2">
<style>
@media print {
table tr td { font-family:Arial, Helvetica, sans-serif;  font-size:13px; }
}
</style>
<table width="100%" border="1" cellpadding="20" cellspacing="0" bordercolor="#CCCCCC">
   
  <tr>
    <td colspan="3" style="border-bottom:1px solid #ddd;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      
      
      <tr>
        <td style="font-size:20px; font-weight:500;">
		<img src="<?php echo $imgurl; ?><?php echo $agentData['companyLogo']; ?>" height="55">		      </td>
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
	<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#E9E9E9">Flight</td>
        <td bgcolor="#E9E9E9">Departure</td>
        <td bgcolor="#E9E9E9">Arrival</td>
        <td bgcolor="#E9E9E9"> Stop </td>
        <td bgcolor="#E9E9E9">Baggage / Cabin</td>
        <td bgcolor="#E9E9E9">Class</td>
      </tr>
      <tr>
        <td align="left" valign="top"><div style="font-size:14px; font-weight:500; color:#000000;"><?php echo $editresult['flightName']; ?></div>
<?php echo $editresult['flightCode']; ?> <?php echo $editresult['flightNo']; ?> </td>
        <td align="left" valign="top">
		<div style="font-size:14px; font-weight:500; color:#000000;"><?php echo date('D, j M Y', strtotime($editresult['journeyDate'])); ?>, <?php echo $editresult['departureTime']; ?></div>
		<?php  $fareType=explode('-',$editresult['source']); 
 			echo getflightdestination($fareType[1]); ?> - Terminal: <?php echo $editresult['flightTerminal']; ?></td>
        <td align="left" valign="top">
		<div style="font-size:14px; font-weight:500; color:#000000;"><?php echo date('D, j M Y', strtotime($editresult['arrivalDate'])); ?>, <?php echo $editresult['arrivalTime']; ?></div>
		<?php  $fareType=explode('-',$editresult['destination']);  echo getflightdestination($fareType[1]); ?><br></td>
        <td align="left" valign="top"><div style="font-size:14px; font-weight:500; color:#000000;"><?php echo $editresult['flightStop']; ?> Stop(s)</div></td>
        <td align="left" valign="top">15kgs / 7kg</td>
        <td align="left" valign="top"><strong><?php echo $editresult['fareClass']; ?></strong></td>
      </tr>
    </table>
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
        <td colspan="2">Rs.<?php echo number_format(round(($editresult['agentBaseFare']+$editresult['agentFixedMakup'])/$_REQUEST['tp'])); ?></td>
        </tr>
      <tr>
        <td width="25%"><strong>Taxes </strong></td>
        <td colspan="2">Rs.<?php echo number_format(round((($editresult['tax']/$_REQUEST['tp'])+$editresult['agentMarkup']/$_REQUEST['tp'])+($_REQUEST['markup']))); ?></td>
      </tr>
     <?php if($editresult['seatPrice']>0){ ?> <tr>
        <td><strong>Seat Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['seatPrice']); ?></td>
      </tr>
	  <?php } ?>
	     <?php if($editresult['mealPrice']>0){ ?> 
      <tr>
        <td><strong>Meal Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['mealPrice']); ?></td>
      </tr>
	    <?php } ?>
		    <?php if($editresult['extraBaggagePrice']>0){ ?> 
      <tr>
        <td><strong>Extra Baggage Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['extraBaggagePrice']); ?></td>
      </tr>
	      <?php } ?>
      <tr>
        <td width="25%"><strong>Total Fare </strong></td>
        <td colspan="2">Rs.<?php echo number_format(round(round(($editresult['agentTotalFare']+$editresult['agentFixedMakup'])/$_REQUEST['tp'])+($_REQUEST['markup']))); ?></td>
      </tr>
    </table>
	<?php } else { ?>
	<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#CCCCCC">
      <tr>
        <td width="25%"><strong>Basic Fare</strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['agentBaseFare']+$editresult['agentFixedMakup']); ?></td>
        </tr>
      <tr>
        <td width="25%"><strong>Taxes </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['tax']+$editresult['agentMarkup']+($_REQUEST['markup'])); ?></td>
      </tr>
     <?php if($editresult['seatPrice']>0){ ?> <tr>
        <td><strong>Seat Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['seatPrice']); ?></td>
      </tr>
	  <?php } ?>
	     <?php if($editresult['mealPrice']>0){ ?> 
      <tr>
        <td><strong>Meal Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['mealPrice']); ?></td>
      </tr>
	    <?php } ?>
		    <?php if($editresult['extraBaggagePrice']>0){ ?> 
      <tr>
        <td><strong>Extra Baggage Charges </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['extraBaggagePrice']); ?></td>
      </tr>
	      <?php } ?>
      <tr>
        <td width="25%"><strong>Total Fare </strong></td>
        <td colspan="2">Rs.<?php echo number_format($editresult['agentTotalFare']+$editresult['agentFixedMakup']+($_REQUEST['markup']+$editresult['mealPrice']+$editresult['extraBaggagePrice'])); ?></td>
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


<div style="margin-top:10px; text-align:center;">
<button type="button" class="btn btn-secondary btn-sm" onClick="printDiv2();">Print</button>

</div>

<script>
function printDiv2() 
{

  var divToPrint=document.getElementById('DivIdToPrint2');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();
 

}
</script>

</div>
</div>
</div>
</div>
<?php }  ?>

</div>




  
 
 
 </div>
 
 
 
<?php include "footer.php"; 
 
 
 
if($rest['apiType']=='kafila'){
 
$rs=GetPageRecord('bookingNumber,uniqueSessionId','flightBookingMaster',' id="'.$rest['id'].'" '); 
while($rest=mysqli_fetch_array($rs)){ 
 
 	 $pnrRetreiveJson = '{
							"TYPE": "DC",
							"NAME": "PNR_RETRIVE",
							"STR": [
								{
								"BOOKINGID": "'.$rest['bookingNumber'].'",
								"CLIENT_SESSIONID": "",
								"MODULE": "B2B",
								"HS": "D"
								}
							]
						}';
	
	//logger('JSON POST FOR Flight PNR RETREIVE(PNR_RETREIVE): '.$pnrRetreiveJson);
	
	$ch1 = curl_init();
	curl_setopt($ch1, CURLOPT_URL,$PnrCreateUrl);
	curl_setopt($ch1, CURLINFO_HEADER_OUT, true);
	curl_setopt($ch1, CURLOPT_POST,1);
	curl_setopt($ch1, CURLOPT_POSTFIELDS, $pnrRetreiveJson);
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	$pnrRetResponse = curl_exec($ch1); 
	curl_close($ch1);
	$pnrRetData = json_decode($pnrRetResponse);
	
	
	//print_r($pnrRetResponse);
	//logger('JSON RESPONSE FROM FLIGHT PNR RETREIVE(PNR_RETREIVE): '.$pnrRetResponse);
	
	$flightTerminal = $pnrRetData->FLIGHT{0}->ORG_TRML;
	$fareClass = $pnrRetData->FLIGHT{0}->FARE_CLASS;
	$gpnr = $pnrRetData->PAX{0}->gpnr;
	$apnr = $pnrRetData->PAX{0}->apnr;
	$ticketNo = $pnrRetData->PAX{0}->tktno;
	$receivestatus = $pnrRetData->PAX{0}->status;
	
	$status=1;
	
	if($receivestatus=="Failed"){
		$status = 3;
	}else if($receivestatus=="Confirmed"){
	
	if($apnr!=''){
		$status = 2;
		} else {
		$status = 1;
		}
		
	}else{
		$status = 1;
	}
	
	
	if($apnr==''){
	$apnr=$gpnr;
	}else{
	$apnr=$apnr;
	}
	
	
	
	$namevalue ='status="'.$status.'",flightTerminal="'.$flightTerminal.'",fareClass="'.$fareClass.'",pnrNo="'.$apnr.'",ticketNo="'.$ticketNo.'"'; 
	$where='bookingNumber="'.$rest['bookingNumber'].'"'; 
	 updatelisting('flightBookingMaster',$namevalue,$where); 
	
}



if(decode($_REQUEST['r'])!=''){

$rs=GetPageRecord('bookingNumber,uniqueSessionId','flightBookingMaster',' id="'.$resreturn['id'].'" '); 
while($rest=mysqli_fetch_array($rs)){ 
 
 	 $pnrRetreiveJson = '{
							"TYPE": "DC",
							"NAME": "PNR_RETRIVE",
							"STR": [
								{
								"BOOKINGID": "'.$rest['bookingNumber'].'",
								"CLIENT_SESSIONID": "",
								"MODULE": "B2B",
								"HS": "D"
								}
							]
						}';
	
	//logger('JSON POST FOR Flight PNR RETREIVE(PNR_RETREIVE): '.$pnrRetreiveJson);
	
	$ch1 = curl_init();
	curl_setopt($ch1, CURLOPT_URL,$PnrCreateUrl);
	curl_setopt($ch1, CURLINFO_HEADER_OUT, true);
	curl_setopt($ch1, CURLOPT_POST,1);
	curl_setopt($ch1, CURLOPT_POSTFIELDS, $pnrRetreiveJson);
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	$pnrRetResponse = curl_exec($ch1); 
	curl_close($ch1);
	$pnrRetData = json_decode($pnrRetResponse);
	
	
	//print_r($pnrRetResponse);
	//logger('JSON RESPONSE FROM FLIGHT PNR RETREIVE(PNR_RETREIVE): '.$pnrRetResponse);
	
	$flightTerminal = $pnrRetData->FLIGHT{0}->ORG_TRML;
	$fareClass = $pnrRetData->FLIGHT{0}->FARE_CLASS;
	$gpnr = $pnrRetData->PAX{0}->gpnr;
	$apnr2 = $pnrRetData->PAX{0}->apnr;
	$ticketNo = $pnrRetData->PAX{0}->tktno;
	$receivestatus = $pnrRetData->PAX{0}->status;
	
	$status=1;
	
	if($receivestatus=="Failed"){
		$status = 3;
	}else if($receivestatus=="Confirmed"){
	
	
	
	if($apnr2!=''){
		$status = 2;
		} else {
		$status = 1;
		}
		
	}else{
		$status = 1;
	}
	
	
	if($apnr2==''){
	$apnr2=$gpnr;
	}else{
	$apnr2=$apnr2;
	}
	
	
	
	$namevalue ='status="'.$status.'",flightTerminal="'.$flightTerminal.'",fareClass="'.$fareClass.'",pnrNo="'.$apnr2.'",ticketNo="'.$ticketNo.'"'; 
	$where='bookingNumber="'.$rest['bookingNumber'].'"'; 
	 updatelisting('flightBookingMaster',$namevalue,$where); 
	
}

} else {
$apnr2=1;
}


}

if($rest['apiType']=='tbo')
{
	$ErrorMessage='';
	$rs=GetPageRecord('bookingNumber,uniqueSessionId,IsLCC,pnrNo,tboBookingId','flightBookingMaster',' id="'.$rest['id'].'" '); 
	while($rest=mysqli_fetch_array($rs)){ 
	 
		if($rest['IsLCC']==0 && $rest['isOnHoldFlight']==0)
		{
			$pnrTbo=$rest['pnrNo'];
			$tboBookingId=$rest['tboBookingId'];
			
			include dirname(__FILE__).'/FLYTBOAPI/FlightTicket.php';  //book request
	
			if($ticket_result['Response']['Error']['ErrorCode']>0)
			{
			  $ErrorMessage=$ticket_result['Response']['Error']['ErrorMessage'];
			}
			else
			{
			$PNR=$ticket_result['Response']['Response']['PNR'];
			$BookingId=$ticket_result['Response']['Response']['BookingId'];
			$IsPriceChanged=$ticket_result['Response']['Response']['IsPriceChanged'];
			$IsTimeChanged=$ticket_result['Response']['Response']['IsTimeChanged'];
			$Status=$ticket_result['Response']['Response']['TicketStatus'];
			$PassengerArr=$ticket_result['Response']['Response']['FlightItinerary']['Passenger'];
				if(count($PassengerArr)>0)
				{
					foreach($PassengerArr as $PassengerArrVal)
					{
						$firstName=$PassengerArrVal['FirstName'];
						
						if($PassengerArrVal['PaxType']==1)
						{
						   $ptype='adult';	
						} 
						else if($PassengerArrVal['PaxType']==2)
						{
							$ptype='child';	
						}
						 else if($PassengerArrVal['PaxType']==2)
						{
							$ptype='infant';	
						}
											
						$TicketId=$PassengerArrVal['Ticket']['TicketId'];
						$TicketNumber=$PassengerArrVal['Ticket']['TicketNumber'];
						
						$namevalue ='ticketNo="'.$TicketNumber.'"'; 
						$bookingId2=$rest['id'];
						$where='BookingId="'.$bookingId2.'" and firstName="'.$firstName.'" and paxType="'.$ptype.'" ';
						updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
						
					
					}
				
				}
			
			
			}	
			
			$flightTerminal='';
			$fareClass='';
			$ticketNo='';
			
			if($Status==1)
			{
				$Status=2;
			}
			
			//$namevalue ='status="'.$Status.'",flightTerminal="'.$flightTerminal.'",fareClass="'.$fareClass.'",pnrNo="'.$PNR.'",ticketNo="'.$ticketNo.'"'; 
			$namevalue ='status="'.$Status.'",pnrNo="'.$PNR.'",ticketNo="'.$ticketNo.'"'; 
			$where='bookingNumber="'.$rest['bookingNumber'].'"'; 
			updatelisting('flightBookingMaster',$namevalue,$where); 
			
		}	
		
	}



	if(decode($_REQUEST['r'])!=''){
	
	$rs=GetPageRecord('bookingNumber,uniqueSessionId,IsLCC,pnrNo,tboBookingId','flightBookingMaster',' id="'.$resreturn['id'].'" '); 
	while($rest=mysqli_fetch_array($rs)){ 
	 
		if($rest['IsLCC']==0 && $rest['isOnHoldFlight']==0)
		{
			$pnrTbo=$rest['pnrNo'];
			$tboBookingId=$rest['tboBookingId'];
			
			include dirname(__FILE__).'/FLYTBOAPI/FlightTicket.php';  //book request
	
			if($ticket_result['Response']['Error']['ErrorCode']>0)
			{
			  $ErrorMessage=$ticket_result['Response']['Error']['ErrorMessage'];
			}
			else
			{
			$PNR=$ticket_result['Response']['Response']['PNR'];
			$BookingId=$ticket_result['Response']['Response']['BookingId'];
			$IsPriceChanged=$ticket_result['Response']['Response']['IsPriceChanged'];
			$IsTimeChanged=$ticket_result['Response']['Response']['IsTimeChanged'];
			$Status=$ticket_result['Response']['Response']['TicketStatus'];
			$PassengerArr=$ticket_result['Response']['Response']['FlightItinerary']['Passenger'];
				if(count($PassengerArr)>0)
				{
					foreach($PassengerArr as $PassengerArrVal)
					{
						$firstName=$PassengerArrVal['FirstName'];
						
						if($PassengerArrVal['PaxType']==1)
						{
						   $ptype='adult';	
						} 
						else if($PassengerArrVal['PaxType']==2)
						{
							$ptype='child';	
						}
						 else if($PassengerArrVal['PaxType']==2)
						{
							$ptype='infant';	
						}
											
						$TicketId=$PassengerArrVal['Ticket']['TicketId'];
						$TicketNumber=$PassengerArrVal['Ticket']['TicketNumber'];
						
						$namevalue ='ticketNo="'.$TicketNumber.'"'; 
						$bookingId2=$resreturn['id'];
						$where='BookingId="'.$bookingId2.'" and firstName="'.$firstName.'" and paxType="'.$ptype.'" ';
						updatelisting('flightBookingPaxDetailMaster',$namevalue,$where);
						
					
					}
				
				}
			
			
			}	
			
			$flightTerminal='';
			$fareClass='';
			$ticketNo='';
			
			if($Status==1)
			{
				$Status=2;
			}
			
			//$namevalue ='status="'.$Status.'",flightTerminal="'.$flightTerminal.'",fareClass="'.$fareClass.'",pnrNo="'.$PNR.'",ticketNo="'.$ticketNo.'"'; 
			$namevalue ='status="'.$Status.'",pnrNo="'.$PNR.'",ticketNo="'.$ticketNo.'"'; 
			$where='bookingNumber="'.$rest['bookingNumber'].'"'; 
			updatelisting('flightBookingMaster',$namevalue,$where); 
			
		}	
	 
		 
		
	}
	
	} else {
	$apnr2=1;
	}

}

?>


<?php 

 
 
 
 
if($restreturntwo['pnrNo']=='' || $restone['pnrNo']==''){



if($restone['status']==1 || $restreturntwo['status']==1){

 
 ?>
<script>

var intervalId = window.setInterval(function(){
 parent.location.reload();
}, 10000);

</script>
<?php } } ?>

 
 
</body>
</html>

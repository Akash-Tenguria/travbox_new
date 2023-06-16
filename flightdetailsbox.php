<?php  
if($_REQUEST['preview']==1){
include "inc.php";  
include "config/logincheck.php";
}


if($_REQUEST['tabid']==''){
$_REQUEST['tabid']=1;
}
 
 
$a=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and id="'.$_REQUEST['id'].'" ');
$res=mysqli_fetch_array($a);

	$bagg=explode (",", $res['FLIGHT_INFO']);
 $iB=$bagg[1];
 $cB=$bagg[0];
?>
 <style>
 .detailscontent<?php echo $res['id']; ?> { padding: 10px; border: 1px solid #ddd; display: none; }
 .detailsboxtabs<?php echo $res['id']; ?> { width: 100%; border-bottom: 1px solid #ddd; overflow: hidden; padding-left: 0px; }
 .detailsboxtabs<?php echo $res['id']; ?> a { padding: 5px 10px; margin-right: 5px; float: left; color: #000; padding: 10px 20px; border-radius: 12px !important; border-bottom-left-radius: 0px !important; border-bottom-right-radius: 0px !important; font-weight: 600; }
 .detailsboxtabs<?php echo $res['id']; ?> .active { background-color: var(--blue); color: #fff; }
 </style>
<div class="detailsboxtabs<?php echo $res['id']; ?>" style="position:relative;">
<a <?php if($_REQUEST['tabid']==1){ ?> class="active"<?php } ?> id="fltb1<?php echo $res['id']; ?>"  onClick="flightdetailstab<?php echo $res['id']; ?>('1<?php echo $res['id']; ?>');">Flight Details</a>
<?php if($_REQUEST['preview']!=1){ ?><a <?php if($_REQUEST['']==2){ ?> class="active"<?php } ?> id="fltb2<?php echo $res['id']; ?>" onClick="flightdetailstab<?php echo $res['id']; ?>('2<?php echo $res['id']; ?>');">Fare Details</a><?php } ?>
<a <?php if($_REQUEST['']==3){ ?> class="active"<?php } ?> id="fltb3<?php echo $res['id']; ?>" onClick="flightdetailstab<?php echo $res['id']; ?>('3<?php echo $res['id']; ?>');">Baggage Info</a>
<a  <?php if($_REQUEST['']==4){ ?> class="active"<?php } ?> id="fltb4<?php echo $res['id']; ?>" onClick="flightdetailstab<?php echo $res['id']; ?>('4<?php echo $res['id']; ?>');">Fare Rules</a>


</div>
 
<div class="detailscontent<?php echo $res['id']; ?>" id="tabid1<?php echo $res['id']; ?>">
<div class="row">
<div class="col-12">

<?php
$j=0; 
foreach((array) unserialize(stripslashes($res['CON_DETAILS'])) as $layoverFlight){

if($layoverFlight->FLIGHT_NAME!=''){
?>
<div class="row multiflightbox">
<div class="col-3">
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])); ?>" width="32" height="32"></td>
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
  <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600; border-radius:12px; margin:15px 0px; "><?php echo $layoverFlight->LAYOVER_INFO; ?></div>
<?php } ?>
</div>

	  <?php  $j++; } } ?>
	  
<?php if($j==0){
 
$dd=unserialize(stripslashes($res['searchJson']));
 
 ?>
<?php 
$f=1;
foreach((array) $dd['sI'] as $layoverFlight){ 
$duration='';
?>
<?php if($_SESSION['isRoundTripInt']==1 && $f==1){ ?>
<div style="padding: 5px 10px; background-color: #f1f1f1; font-weight: 700; margin-bottom: 10px;">Departure Flight</div>
<?php } 

$f++;
?>
<div class="row multiflightbox">
<div class="col-4"> 

 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="<?php echo $imgurl.getflightlogo($layoverFlight['fD']['aI']['name']); ?>"  height="32"></td>
    <td>
	<div class="flightname"><?php echo stripslashes($layoverFlight['fD']['aI']['name']); ?></div>
	<div class="flightnumber"><?php echo stripslashes($layoverFlight['fD']['aI']['code']); ?>-<?php echo stripslashes($layoverFlight['fD']['fN']); ?></div>
	
	</td>
  </tr>
</table>  
</div>

<div class="col-8">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div class="coltime"><?php echo date('H:i',strtotime($layoverFlight['dt'])); ?></div>
	<div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($layoverFlight['dt'])); ?></div>
	<div class="graysmalltext">
	
	<?php
	$rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$layoverFlight['da']['code'].'"');
$rscodedep=mysqli_fetch_array($rs); ?>
(<?php echo $layoverFlight['da']['code']; ?>) <?php echo strip($rscodedep['city']); ?><br /><?php echo strip($rscodedep['airportDescription']); ?></div>
	</td>
    <td width="33%" align="center"><div class="nostops"><?php 
 
	echo $hours = intdiv($layoverFlight['duration'], 60).'H :'. ($layoverFlight['duration'] % 60).' M';
	
	$duration=(strtotime($layoverFlight['at'])-strtotime($layoverFlight['dt']))/60;   makeFlightTime($duration); ?>
	</div><div class="graysmalltext"></div></td>
    <td width="33%" align="center"><div class="coltime">
	<?php echo date('H:i',strtotime($layoverFlight['at'])); ?></div>
		<div class="coltime" style="font-size:11px;"><?php echo date('d-m-Y',strtotime($layoverFlight['at'])); ?></div>
	<div class="graysmalltext">
	<?php
	$rs=GetPageRecord('*','flightDestinationMaster',' airportCode="'.$layoverFlight['aa']['code'].'"');
$rscodearr=mysqli_fetch_array($rs); ?>
(<?php echo $layoverFlight['aa']['code']; ?>) <?php echo strip($rscodearr['city']); ?><br /><?php echo strip($rscodearr['airportDescription']); ?></div></td>
  </tr>
</table>

</div>
</div>


<?php if($layoverFlight['cT']>0){ ?>
  <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600; margin:15px 0px;   ">Layover time: <?php echo $hours = intdiv($layoverFlight['cT'], 60).':'. ($layoverFlight['cT'] % 60); ?> hours</div>
<?php } ?>


<?php
 

 if($_SESSION['isRoundTripInt']==1 && trim($res['DES_NAME'])==trim($layoverFlight['aa']['city'])){ ?>
<div style="padding: 5px 10px; background-color: #f1f1f1; font-weight: 700; margin-bottom: 10px; margin-top:10px;">Return Flight</div>
<?php }  ?>

<?php } ?>

<?php } ?>

 
</div>
</div>

</div> 

 
<div class="detailscontent<?php echo $res['id']; ?>"  id="tabid3<?php echo $res['id']; ?>">
<div class="row">
<div class="col-12">
 
 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="baggageclass">
  <tr>
    <td width="33%" align="left" bgcolor="#f5f5f5"><strong>Airline</strong></td>
    <td width="33%" align="left" bgcolor="#f5f5f5"><strong>Check-in Baggage</strong></td>
    <td width="33%" align="left" bgcolor="#f5f5f5"><strong>Cabin Baggage</strong></td>
  </tr>
  <tr>
    <td width="33%" align="left"><table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])); ?>"  height="32"></td>
    <td>
	<div class="flightname"><?php echo stripslashes($res['FLIGHT_NAME']); ?></div>
	<div class="flightnumber"><?php echo stripslashes($res['FLIGHT_CODE']); ?>-<?php echo stripslashes($res['FLIGHT_NO']); ?></div>
	
	</td>
  </tr>
</table></td>
    <td width="33%" align="left"><?php echo $iB; ?></td>
    <td width="33%" align="left"><?php echo $cB; ?></td>
  </tr>
  <tr>
    <td colspan="3" align="left"><div  style="padding:10px; background-color:#F5F5F5;">
					 Baggage information mentioned above is obtained from airline's reservation system, <?php echo stripslashes($getcompanybasicinfo['companyName']); ?> does not guarantee the accuracy of this information.<br />
 The baggage allowance may vary according to stop-overs, connecting flights. changes in airline rules. etc. 
		  </div></td>
    </tr>
</table>

 
 
</div>
</div>

</div> 


 
<div class="detailscontent<?php echo $res['id']; ?>"  id="tabid2<?php echo $res['id']; ?>">
<div class="row">
<div class="col-6">
<div style="margin-bottom:10px; font-size:16px;"><strong>Fare Breakup</strong></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="baggageclass">
  
  <tr>
    <td width="33%" align="left"><strong>Base Fare</strong></td>
    <td width="33%" align="left">&#8377; <?php $str_arr = explode (",", $res['agfare']);  
	$basefare = explode ("=", $str_arr[0]);
	echo $basefare[1];
	  ?></td>
  </tr>
  <tr>
    <td align="left"><strong>Surcharges & Taxes</strong></td>
    <td align="left">&#8377; <?php 
	$basefare = explode ("=", $str_arr[1]);
	echo $basefare[1];
	  ?></td>
  </tr>
  <tr>
    <td align="left"><strong>Pay Amount</strong></td>
    <td align="left">&#8377; <?php 
	$basefare = explode ("=", $str_arr[2]);
	echo $basefare[1];
	  ?></td>
  </tr>
</table>
</div>
</div>
</div> 


 
<div class="detailscontent<?php echo $res['id']; ?>"  id="tabid4<?php echo $res['id']; ?>">
 
 <?php
 
if($res['apiType']=='kafila'){ 
 
$flight_name=stripslashes($res['FLIGHT_NAME']);
$flight_pcc=explode("~",stripslashes($res['PCC'])); 
$pcc_query=GetPageRecord('*','fareTypeMaster','flightName="'.$flight_name.'" and fareTypeName="'.$flight_pcc[1].'"');
$pcc_row=mysqli_fetch_array($pcc_query);
 echo $pcc_row['cancellationPolicy'];
 
 if($pcc_row['cancellationPolicy']==''){
 $arr = unserialize(stripslashes($res['PARAM_DATA']));

 

     $jsonPost = '{
   "NAME":"FARE_CHECK",
   "STR":[
      {
         "FLIGHT":{
            "UID":"'.$res['UID'].'",
            "ID":"'.$res['ResultIndex'].'",
            "TID":"'.$res['TID'].'"
         },
         "PARAM":'.json_encode($arr[0]).',
         "GSTINFO":{
            "hasGST":"false"
         }
      }
   ],
   "TYPE":"AIR"
}';	

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$SeatAvailUrl);
	curl_setopt($ch, CURLINFO_HEADER_OUT, true);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPost);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	
			curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 300); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
	
	$response = curl_exec($ch); 
	curl_close($ch);
	
	
	$data = json_decode($response);	
	 
	
	echo $data->FARE_RULE[0]->FARE_RULE;
	}
	
}	


if($res['apiType']=='tbo'){ 

$ResultIndex=$res['ResultIndex'];
include 'FLYTBOAPI/FareRulesOB.php'; 
$_SESSION['ob-farerule-result']= $fare_rule_result;

$frule_res= $fare_rule_result;; 
$fare_Origin= $frule_res['Response']['FareRules']['0']['Origin'];
$fare_Destination= $frule_res['Response']['FareRules']['0']['Destination'];
$FareRuleDetail= $frule_res['Response']['FareRules']['0']['FareRuleDetail'];
?>
 <div class="fareruledivbox"> 
 
 <div><?php echo str_replace('-------------------------------------------------','<br>',$FareRuleDetail); ?></div>
 </div>
 
<?php
}

if($res['apiType']=='tripjack'){
	include 'tripjackAPI/APIConstants.php';
	include 'tripjackAPI/RestApiCaller.php';
	
	$ResultIndex=$res['ResultIndex'];
	$sourceKey=$res['ORG_CODE']."-".$res['DES_CODE'];
	include_once 'tripjackAPI/fareRule.php';
	
	// $dd=unserialize(stripslashes($res['searchJson']));
	// print_r($dd);
	 
	// print_r($fareRuleResult);
   if(count($fareRuleResult['fareRule'])>0)
   {
   
   $fareRuleResultArr=$fareRuleResult['fareRule'][$sourceKey]['fr'];
   
  // print_r($fareRuleResultArr);
?>
<style>
.detailscontent<?php echo $res['id']; ?> table { caption-side: bottom; border-collapse: collapse; font-family: arial; font-size: 13px; }
</style>
<div style="font-size:18px; font-weight:600; margin-bottom:5px;">Cancellation Fee</div>
<div style="margin-bottom:2px; font-size:15px; font-weight:600; color:#CC0000;">&#8377; <?php echo str_replace('	','',str_replace('__nls__','',$fareRuleResultArr['CANCELLATION']['DEFAULT']['amount'])); ?> +  &#8377;<?php echo $fareRuleResultArr['CANCELLATION']['DEFAULT']['additionalFee']; ?></div>
<div style="margin-bottom:20px;"><?php echo  strip_tags(str_replace('	','',str_replace('__nls__','',$fareRuleResultArr['CANCELLATION']['DEFAULT']['policyInfo']))); ?></div>


<div style="font-size:18px; font-weight:600; margin-bottom:5px;">Date Change Fee</div>
<div style="margin-bottom:2px; font-size:15px; font-weight:600; color:#CC0000;">&#8377; <?php echo str_replace('	','',str_replace('__nls__','',$fareRuleResultArr['DATECHANGE']['DEFAULT']['amount'])); ?> +  &#8377;<?php echo $fareRuleResultArr['DATECHANGE']['DEFAULT']['additionalFee']; ?></div>
<div style="margin-bottom:20px;"><?php echo  strip_tags(str_replace('	','',str_replace('__nls__','',$fareRuleResultArr['DATECHANGE']['DEFAULT']['policyInfo']))); ?></div>


<div style="font-size:18px; font-weight:600; margin-bottom:5px;">No Show</div>
 
<div style="margin-bottom:20px;"><?php echo  strip_tags(str_replace('	','',str_replace('__nls__','',$fareRuleResultArr['NO_SHOW']['DEFAULT']['policyInfo']))); ?></div>

<div style="font-size:18px; font-weight:600; margin-bottom:5px;">Seat Chargeable</div>
 
<div style="margin-bottom:20px;"><?php echo  strip_tags(str_replace('	','',str_replace('__nls__','',$fareRuleResultArr['SEAT_CHARGEABLE']['DEFAULT']['policyInfo']))); ?></div>
 
 
<?php } else { echo "No Data Found"; } ?>



<?php
}
?>






 </div>
 
 
 
 <script>
 function flightdetailstab<?php echo $res['id']; ?>(id){
 $('.detailsboxtabs<?php echo $res['id']; ?> a').removeClass('active');
 $('.detailscontent<?php echo $res['id']; ?>').hide();
 $('#tabid'+id).show(); 
 $('#fltb'+id).addClass('active');
 }
 flightdetailstab<?php echo $res['id']; ?>(1<?php echo $res['id']; ?>);
 </script>
 
<?php 
include "inc.php"; 
include "config/logincheck.php";

 

$a=GetPageRecord('*','wig_flight_json_bkp','   id="'.decode($_REQUEST['id']).'" ');
$res=mysqli_fetch_array($a);
 
if($res['apiType']=='tripjack'){
	include 'tripjackAPI/APIConstants.php';
	include 'tripjackAPI/RestApiCaller.php';
	
	$ResultIndex=$res['ResultIndex'];
	$sourceKey=$res['ORG_CODE']."-".$res['DES_CODE'];
	include_once 'tripjackAPI/fareRule.php';
	
	 
	//print_r($fareRuleResult);
   if(count($fareRuleResult['fareRule'])>0)
   {
   
   $fareRuleResultArr=$fareRuleResult['fareRule'][$sourceKey]['fr'];
   
  // print_r($fareRuleResultArr);
?>
<style>
.detailscontent table { caption-side: bottom; border-collapse: collapse; font-family: arial; font-size: 13px; }
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
} else {
?>

 

  <script>
 $('.showonlyaftercheck').hide();
 $('#confirmingprice').show();
 $('#addpassengersbtn').hide();
 </script>
  
 
<div class="detailscontent">
<div class="row">
<div class="col-12">
 <?php if($res['apiType']=='kafila'){ ?>
 
 <div style="padding: 20px; border: 1px solid #ddd; background-color: #fafafa; border-radius: 4px; margin-bottom: 5px; margin-top:15px; ">
 <?php
$flight_name=stripslashes($res['FLIGHT_NAME']);
$flight_pcc=explode("~",stripslashes($res['PCC'])); 
$pcc_query=GetPageRecord('*','fareTypeMaster','flightName="'.$flight_name.'" and fareTypeName="'.$flight_pcc[1].'"');
$pcc_row=mysqli_fetch_array($pcc_query);
 echo $pcc_row['cancellationPolicy'];
 
 if($pcc_row['cancellationPolicy']=='' || $_REQUEST['checkingflightfare']==1){
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
	
	
	
	
$namevalue ='flightCheckData="'.addslashes(serialize($data)).'"';	 

$where='id="'.$res['id'].'" and agentId="'.$_SESSION['agentUserid'].'"';
updatelisting('wig_flight_json_bkp',$namevalue,$where); 
?>
 </div>
 
 <?php }  ?>
 
 
  <?php
  $a=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and ResultIndex="'.($_REQUEST['id']).'" ');
$res=mysqli_fetch_array($a);
  
   if($res['apiType']=='tbo'){
   
   
 // Mini Fare Rule

		$segmentsDataArr=(array) unserialize(stripslashes($res['PARAM_DATA']));
		$miniFareRules=$segmentsDataArr['MiniFareRules'][0];  
		if(count($miniFareRules)>0)
		{

?>



<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
  
  <tr>
    <td width="30%" bgcolor="#F4F4F4"><strong>Journey Points </strong></td>
    <td width="13%" bgcolor="#F4F4F4"><strong>Type</strong></td>
    <td width="21%" bgcolor="#F4F4F4"><strong>From</strong></td>
    <td width="8%" bgcolor="#F4F4F4"><strong>To</strong></td>
    <td width="11%" bgcolor="#F4F4F4"><strong>Unit</strong></td>
    <td width="17%" bgcolor="#F4F4F4"><strong>Details</strong></td>
  </tr>
  
  <?php

		
		foreach($miniFareRules as $miniFareRulesValue)
		{
  ?>
  
  
  <tr>
    <td><?php echo $miniFareRulesValue['JourneyPoints']; ?></td>
    <td><?php echo $miniFareRulesValue['Type']; ?></td>
    <td><?php echo $miniFareRulesValue['From']; ?></td>
    <td><?php echo $miniFareRulesValue['To']; ?></td>
    <td><?php echo $miniFareRulesValue['Unit']; ?></td>
    <td><?php echo $miniFareRulesValue['Details']; ?></td>
  </tr>
 
  <?php }  ?>
</table>
<?php } ?>  
   
 
 <div style="padding: 20px; border: 1px solid #ddd; background-color: #fafafa; border-radius: 4px; margin-bottom: 5px; margin-top:15px; ">
 <?php
$ResultIndex=$_REQUEST['id'];
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
 </div>
 
 <?php } ?>
</div>
</div>
</div>
 <?php } ?>
 <script>
 $('.showonlyaftercheck').show();
 $('#confirmingprice').hide();
 $('#addpassengersbtn').show();
 </script>
 

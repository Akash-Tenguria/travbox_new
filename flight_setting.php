<?php   
$api=GetPageRecord('*','sys_companyMaster',' id=1'); 

$apiData=mysqli_fetch_array($api); 





$hitSource = 'P'; //Production 

$A_ID = '79820682';

$PWD = 'flyshop1234'; 

$U_ID = 'flyshop';

$MODULE = 'B2B';







/*$hitSource = 'D'; //Development  

$A_ID = '55430334';

$U_ID = 'test';

$PWD = 'test';

$MODULE = 'B2B';*/







//Endpoint URL to hit API:



//For develpoment enviroment url:

/*$TokenUrl = 'http://nauth.ksofttechnology.com/API/AUTH';

$FlightSearchUrl = 'http://stageapi.ksofttechnology.com/API/FLIGHT';

$SeatAvailUrl = 'http://stageapi.ksofttechnology.com/API/AVLT';

$PnrCreateUrl = 'http://stageapi.ksofttechnology.com/API/flight';

$PnrRetreiveUrl = 'http://stageapi.ksofttechnology.com/API/flight'; */



//For Live Enviroment url:

$TokenUrl = 'http://nauth.ksofttechnology.com/API/AUTH';

$FlightSearchUrl = 'http://napi.ksofttechnology.com/API/FLIGHT';

$SeatAvailUrl = 'http://napi.ksofttechnology.com/API/AVLT';

$PnrCreateUrl = 'http://napi.ksofttechnology.com/API/flight';

$PnrRetreiveUrl = 'http://napi.ksofttechnology.com/API/flight';













function logger($errorlog)

{

	$newfile = 	'errorlog/errorlog'.date('dmy').'.txt';



	//rename('errorlog/miserrorlog.txt',$newfile);

  

	if(!file_exists($newfile))

	{

	  file_put_contents($newfile,'');

	}

	$logfile=fopen($newfile,'a');

	

	$ip = $_SERVER['REMOTE_ADDR'];

	date_default_timezone_set('Asia/Kolkata');

	$time = date('d-m-Y h:i:s A',time());

	//$contents = file_get_contents('errorlog/errorlog.txt');

	$contents = "$ip\t$time\t$errorlog\r";

	fwrite($logfile,$contents);

	//file_put_contents('errorlog/errorlog.txt',$contents);

}





function getflightlogo($name){



$a=GetPageRecord('*','sys_flightName',' name like "%'.$name.'%"'); 

$res=mysqli_fetch_array($a); 

if($res['details']!=''){

return stripslashes($res['details']);

} else {

return 'noflightlogo.png';

}

}







function getflightdestination($code){ 

if($code!=''){

$a=GetPageRecord('*','flightDestinationMaster',' airportCode="'.trim($code).'"'); 

$res=mysqli_fetch_array($a);  

return stripslashes($res['city']); 

}

}

  





 



function offlineflight($agentId,$flightName,$fareType){  

 
 

  $a=GetPageRecord('commissionType','sys_userMaster','  id="'.$_SESSION['parentid'].'"');  

$editresultgroup=mysqli_fetch_array($a);  

  



if (strpos($fareType, '~') !== false) {

$fareType=explode('~',$fareType); 

$fareType=$fareType[1];

}



if(trim($fareType[1])==''){

$fareType=$fareType;

}



if(trim($fareType[1])==''){

$fareType=$fareType;

}

 



$ace=GetPageRecord('*','fareTypeofflineflightsbookingMaster',' sectorType="'.$_SESSION['domesticorinter'].'" and name in (select displayType from fareTypeMaster where    FIND_IN_SET("'.trim($fareType).'",fareTypeName) ) and agentTypeGroupId="'.$editresultgroup['commissionType'].'" and flightId in (select id from offlineflightsbookingMaster where name="'.$flightName.'")');  

if(mysqli_num_rows($ace)>0){ 



return '1';



}else{ 





 

 

 

 $a=GetPageRecord('commissionType','sys_userMaster',' id="'.$_SESSION['agentUserid'].'"');  

$editresultgroup=mysqli_fetch_array($a);  

  



if (strpos($fareType, '~') !== false) {

$fareType=explode('~',$fareType); 

$fareType=$fareType[1];

}



if(trim($fareType[1])==''){

$fareType=$fareType;

}



if(trim($fareType[1])==''){

$fareType=$fareType;

}

 



$ace=GetPageRecord('*','fareTypeofflineflightsbookingMaster',' sectorType="'.$_SESSION['domesticorinter'].'" and name in (select displayType from fareTypeMaster where    FIND_IN_SET("'.trim($fareType).'",fareTypeName) ) and agentTypeGroupId="'.$editresultgroup['commissionType'].'" and flightId in (select id from offlineflightsbookingMaster where name="'.$flightName.'")');  

if(mysqli_num_rows($ace)>0){ 



return '1';



}else{ 



return '0';

} 

 

} 

 

 

}



function offlineflightifagentoffline($agentId,$flightName,$fareType){  

 

     

 

 $a=GetPageRecord('commissionType','sys_userMaster',' id="'.$_SESSION['agentUserid'].'"');  

$editresultgroup=mysqli_fetch_array($a);  

  



if (strpos($fareType, '~') !== false) {

$fareType=explode('~',$fareType); 

$fareType=$fareType[1];

}



if(trim($fareType[1])==''){

$fareType=$fareType;

}



if(trim($fareType[1])==''){

$fareType=$fareType;

}

  



$ace=GetPageRecord('*','fareTypeofflineflightsbookingMaster',' sectorType="'.$_SESSION['domesticorinter'].'" and name in (select displayType from fareTypeMaster where    FIND_IN_SET("'.trim($fareType).'",fareTypeName) ) and agentTypeGroupId="'.$editresultgroup['commissionType'].'" and flightId in (select id from offlineflightsbookingMaster where name="'.$flightName.'")');  

if(mysqli_num_rows($ace)>0){ 



return '1';



}else{ 



return '0';

} 

 

 

 

}













 

function offlineflightAgent($agentId,$flightName,$fareType){  

 if($agentId!=''){



$returnData = '0';

 

if (strpos($fareType, '~') !== false) {

$fareType=explode('~',$fareType); 

$fareType=$fareType[1];

}  





if(trim($fareType[1])==''){

$fareType=$fareType;

}

 

$a=GetPageRecord('*','agent_fareTypeofflineflightsbookingMaster',' sectorType="'.$_SESSION['domesticorinter'].'" and agentId="'.($agentId).'" and addBy="'.($agentId).'" and name="'.trim($fareType).'" and flightId in (select id from offlineflightsbookingMaster where name="'.$flightName.'")');   

if(mysqli_num_rows($a)>0){ 

$returnData = '1';  

}else{ 

 $ba=GetPageRecord('*','agent_fareTypeofflineflightsbookingMaster',' sectorType="'.$_SESSION['domesticorinter'].'" and  agentId="'.($agentId).'" and addBy="'.($agentId).'"  and name="All" and flightId in (select id from offlineflightsbookingMaster where name="'.$flightName.'")');

if(mysqli_num_rows($ba)>0){ 

$returnData = '1'; 

} 

} 

} 

 

return $returnData; 



}



 

function getBlockFlights($agentId,$flightName,$fareType){





 $a=GetPageRecord('commissionType','sys_userMaster',' id="'.$_SESSION['agentUserid'].'"');  

$editresultgroup=mysqli_fetch_array($a);  



 $b=GetPageRecord('commissionType','sys_userMaster',' id="'.$_SESSION['parentid'].'"');  

$editresultgroupAdmin=mysqli_fetch_array($b);  

  



if (strpos($fareType, '~') !== false) {

$fareType=explode('~',$fareType); 

$fareType=$fareType[1];

}



if(trim($fareType[1])==''){

$fareType=$fareType;

}



if(trim($fareType[1])==''){

$fareType=$fareType;

}

 

$ace=GetPageRecord('*','fareTypeblockFlightMaster',' sectorType="'.$_SESSION['domesticorinter'].'"  and name in (select displayType from fareTypeMaster where    FIND_IN_SET("'.trim($fareType).'",fareTypeName) ) and agentTypeGroupId="'.$editresultgroupAdmin['commissionType'].'" and addBy=1 and blockFlightId in (select id from blockFlightMaster where name="'.$flightName.'")');  

if(mysqli_num_rows($ace)>0){  



return '1';



} else { 

 



$ace=GetPageRecord('*','fareTypeblockFlightMaster',' sectorType="'.$_SESSION['domesticorinter'].'"  and name in (select displayType from fareTypeMaster where    FIND_IN_SET("'.trim($fareType).'",fareTypeName) ) and agentTypeGroupId="'.$editresultgroup['commissionType'].'" and blockFlightId in (select id from blockFlightMaster where name="'.$flightName.'")');  

if(mysqli_num_rows($ace)>0){ 



return '1';



}else{ 



return '0';

} 



}



}



//fare breakup function by satendra 

function taxBreakupFunc($data){

    $k=1;

	$taxBreakup = explode(',',($data));

	foreach($taxBreakup as $faredetail){

		$newfaredetail = explode('=',$faredetail);

		if($k==1){

			$bareFare = $newfaredetail[1];

		}

		if($k==2){

			$tax = $newfaredetail[1];

		}

		if($k==3){

			$totalFare = $newfaredetail[1];

		}  

		

		

		$k++;

	}

	return  '{"bareFare":"'.$bareFare.'","tax":"'.$tax.'","totalFare":"'.$totalFare.'"}';

    

}



function changedDateFormat($datepost){

	 //$dateData = str_replace(' ', '', $datepost);

	 $dateDatacls = DateTime::createFromFormat('d-m-Y', $datepost);

	 $newDate = $dateDatacls->format('Y-m-d');

	 return $newDate;

}







if($_POST['username']!='' && $_POST['password']!=''){



$cip=$_SERVER['REMOTE_ADDR'];  

$clogin=date('Y-m-d H:i:s');  

$result =mysqli_query (db(),"select * from sys_userMaster where email='".$_POST['username']."' and  password='".md5($_POST['password'])."' and status=1 and (userType='agent') ")  or die(mysqli_error()); 

$number =mysqli_num_rows($result);  

if($number>0){  



$select=''; 

$where=''; 

$rs=''; 

 

$select='*'; 

$where="email='".$_POST['username']."' and  password='".md5($_POST['password'])."'"; 

$rs=GetPageRecord($select,'sys_userMaster',$where); 

$userinfo=mysqli_fetch_array($rs);

  



$_SESSION['parentAgentId']=$userinfo['id'];  

$_SESSION['webusername']=$userinfo['name'];   

$_SESSION['webuseremail']=$userinfo['email'];   

$_SESSION['webparentid']=$userinfo['parentId'];   

$_SESSION['webuserType']=$userinfo['userType'];   





$sql_insk="insert into sys_userLogs set  currentIp='".$cip."',logType='login',details='Agent Login',userId='".$_SESSION['parentAgentId']."',parentId='".$userinfo['parentId']."',addDate='".time()."'"; 

mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 

  



$sql_ins="update sys_userMaster set onlineStatus=1 where id=".$_SESSION['parentAgentId'].""; 

mysqli_query(db(),$sql_ins) or die(mysqli_error()); 

  



header('Location: agent-dashboard.html');

exit();

} else {

$notlogin=1;

}



}



$totalwalletBalance=0;

if($_SESSION['parentAgentId']!='' && $_SESSION['parentAgentId']>0){

$rs8=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet','agentId="'.$_SESSION['parentAgentId'].'" and paymentType="Credit" '); 

$agentCreditAmt=mysqli_fetch_array($rs8); 



$rs8=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','agentId="'.$_SESSION['parentAgentId'].'" and paymentType="Debit" '); 

$agentDebitAmt=mysqli_fetch_array($rs8); 



$totalwalletBalance=($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);







$rs1=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['parentAgentId'].'" and userType="agent" '); 

$AgentProfileData=mysqli_fetch_array($rs1); 

}



 





//--------------------------------------ADMIN + AGENT----------------------------------------



function calculateflightcost($agentId,$flightName,$flightType,$fareType,$pax,$baseFare,$surcharge){  

 if($agentId!=''){

 

$a=GetPageRecord('commissionType','sys_userMaster',' id="'.decode($agentId).'"');  

$editresultgroup=mysqli_fetch_array($a);  

 

 

 

 



$finalBaseFare=$baseFare;

$returnData = array($surcharge, ($baseFare+$surcharge), $finalBaseFare);

 

if (strpos($fareType, '~') !== false) {

$fareType=explode('~',$fareType); 

$fareType=$fareType[1];

} 



if(trim($fareType[1])==''){

$fareType=$fareType;

}



if($flightName!=''){

if($usethis==1){

 //--------------------================Admin Markup========================-------------------

$mainTax=0;

$mainFinalCost=0;

$a=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster',' sectorType="'.$_SESSION['domesticorinter'].'"  and addBy=1 and agentTypeGroupId="'.$editresultgroup['commissionType'].'" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');   

if(mysqli_num_rows($a)>0){

$res=mysqli_fetch_array($a);

if($res['markupType']=='Flat'){

$taxCost=($pax*$res['markupValue']);  

$finalCost=($pax*$res['markupValue']);  



$mainTax+=round($taxCost);

$mainFinalCost+=round($finalCost); 



}



if($res['markupType']=='%'){

$taxCost=($baseFare*$res['markupValue']/100);  

$finalCost=($baseFare*$res['markupValue']/100);  



$mainTax+=round($taxCost);

$mainFinalCost+=round($finalCost); 



} 

}else{



$ba=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster','  sectorType="'.$_SESSION['domesticorinter'].'"  and addBy=1 and agentTypeGroupId="'.$editresultgroup['commissionType'].'" and name="All" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');

if(mysqli_num_rows($ba)>0){

$res=mysqli_fetch_array($ba);



if($res['markupType']=='Flat'){

$taxCost=($pax*$res['markupValue']);  

$finalCost=($pax*$res['markupValue']);  



$mainTax+=round($taxCost);

$mainFinalCost+=round($finalCost); 



}



if($res['markupType']=='%'){

$taxCost=($baseFare*$res['markupValue']/100);  

$finalCost=($baseFare*$res['markupValue']/100);  



$mainTax+=round($taxCost);

$mainFinalCost+=round($finalCost); 



} 

}

}

 







//--------------------================Agent Markup========================-------------------

 

$a=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster',' sectorType="'.$_SESSION['domesticorinter'].'"  and addBy="'.$_SESSION['parentAgentId'].'" and agentTypeGroupId="'.$editresultgroup['commissionType'].'" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');   

if(mysqli_num_rows($a)>0){

$res=mysqli_fetch_array($a);

if($res['B2cmarkupType']=='Flat'){

$taxCost=($pax*$res['B2CmarkupValue']);  

$finalCost=($pax*$res['B2CmarkupValue']);  



$mainTax+=round($taxCost);

$mainFinalCost+=round($finalCost); 



}



if($res['B2cmarkupType']=='%'){

$taxCost=($baseFare*$res['B2CmarkupValue']/100);  

$finalCost=($baseFare*$res['B2CmarkupValue']/100);  



$mainTax+=round($taxCost);

$mainFinalCost+=round($finalCost); 



} 

}else{



$ba=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster',' sectorType="'.$_SESSION['domesticorinter'].'"  and addBy="'.$_SESSION['parentAgentId'].'" and agentTypeGroupId="'.$editresultgroup['commissionType'].'" and name="All" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');

if(mysqli_num_rows($ba)>0){

$res=mysqli_fetch_array($ba);



if($res['B2cmarkupType']=='Flat'){



$taxCost=($pax*$res['B2CmarkupValue']);  

$finalCost=($pax*$res['B2CmarkupValue']);  



$mainTax+=round($taxCost);

$mainFinalCost+=round($finalCost); 



}



if($res['B2cmarkupType']=='%'){

$taxCost=($baseFare*$res['B2CmarkupValue']/100);  

$finalCost=($baseFare*$res['B2CmarkupValue']/100);  



$mainTax+=round($taxCost);

$mainFinalCost+=round($finalCost); 



} 

}

}



 }

$returnData = array(round(($mainTax)+$surcharge), round((($mainTax)+$surcharge)+($finalBaseFare)), ($finalBaseFare+$mainTax));

 

return $returnData; 

}

}

}











//--------------------------------------Gent Net Fare ONLY----------------------------------------



function calculateflightcostForAgentNetFare($agentId,$flightName,$flightType,$fareType,$pax,$baseFare,$surcharge){  



$baseFare=round($baseFare/$pax);

 

 if($agentId!=''){

 

 

$a=GetPageRecord('commissionType','sys_userMaster',' id="'.$_SESSION['agentUserid'].'"');  

$editresultgroup=mysqli_fetch_array($a);  

 

$ab=GetPageRecord('commissionType','sys_userMaster',' id in(select parentId from sys_userMaster where id="'.$_SESSION['agentUserid'].'" ) ');  

$admincommisiontype=mysqli_fetch_array($ab);  

 

 



$finalBaseFare=$baseFare;

$returnData = array($baseFare, ($baseFare+$surcharge), $finalBaseFare);

 

if (strpos($fareType, '~') !== false) {

$fareType=explode('~',$fareType); 

$fareType=$fareType[1];

} 



if(trim($fareType[1])==''){

$fareType=$fareType;

}



 
if($usethis==1){

if($usethis==1){
if($flightName!=''){

 















/*========================================================Admin==============================================================================================*/





 $exbaseFare=$baseFare;

 



$a=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster',' sectorType="'.$_SESSION['domesticorinter'].'"  and agentTypeGroupId="'.$admincommisiontype['commissionType'].'" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');   

if(mysqli_num_rows($a)>0){

$res=mysqli_fetch_array($a);



if($res['markupType']=='Flat'){

$taxCost=($pax*$res['markupValue']);  

$finalCost=$baseFare+($pax*$res['markupValue']); 

$finalCostAdmin=$baseFare+($pax*$res['markupValue']);  





$baseFare=$finalCostAdmin;

$returnData = array(round($finalCost), round($finalCost+$surcharge), $finalBaseFare); 





//$fp = $baseFare.'----'.$flightName.'----'.$fareType.'----'.$res['markupValue'].'----'.$exbaseFare;

 

?>

<script>

//alert('<?php echo $fp; ?>');

</script>

<?php

 

 



}



if($res['markupType']=='%'){

$taxCost=(($baseFare*$res['markupValue']/100));  

$finalCost=$baseFare+(($baseFare*$res['markupValue']/100));  

$finalCostAdmin=$baseFare+(($baseFare*$res['markupValue']/100));  



$baseFare=$finalCostAdmin;

 $returnData = array(round($finalCost), round($finalCost+$surcharge), $finalBaseFare); 



} 

}else{



$ba=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster',' sectorType="'.$_SESSION['domesticorinter'].'"  and name="All" and agentTypeGroupId="'.$admincommisiontype['commissionType'].'" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');

if(mysqli_num_rows($ba)>0){

$res=mysqli_fetch_array($ba);



if($res['markupType']=='Flat'){

$taxCost=($pax*$res['markupValue']);  

$finalCost=$baseFare+($pax*$res['markupValue']); 

$finalCostAdmin=$baseFare+($pax*$res['markupValue']);  





$baseFare=$finalCostAdmin;

 $returnData = array(round($finalCost), round($finalCost+$surcharge), $finalBaseFare); 



}



if($res['markupType']=='%'){

$taxCost=(($baseFare*$res['markupValue']/100));  

$finalCost=$baseFare+(($baseFare*$res['markupValue']/100));  

$finalCostAdmin=$baseFare+(($baseFare*$res['markupValue']/100));  





$baseFare=$finalCostAdmin;

 $returnData = array(round($finalCost), round($finalCost+$surcharge), $finalBaseFare); 



} 

}

}





?>

<script>

  //alert('<?php echo $fp = $baseFare.'----'.$flightName.'----'.$fareType.'----'.$res['markupValue'].'----'.$exbaseFare; ?>');

</script>

<?php

 

 

 



/*=======================================================Agent===============================================================================================================*/

 

$a=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster',' sectorType="'.$_SESSION['domesticorinter'].'"  and agentTypeGroupId="'.$editresultgroup['commissionType'].'" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');   

if(mysqli_num_rows($a)>0){

$res=mysqli_fetch_array($a);



if($res['markupType']=='Flat'){

$taxCost=($pax*$res['markupValue']);  

$finalCost=$baseFare+($pax*$res['markupValue']);  



$returnData = array(round($finalCost), round($finalCost+$surcharge), $finalBaseFare); 



}



if($res['markupType']=='%'){

$taxCost=(($baseFare*$res['markupValue']/100));  

$finalCost=$baseFare+(($baseFare*$res['markupValue']/100));  



$returnData = array(round($finalCost), round($finalCost+$surcharge), $finalBaseFare); 



} 

}else{



$ba=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster',' sectorType="'.$_SESSION['domesticorinter'].'"  and name="All" and agentTypeGroupId="'.$editresultgroup['commissionType'].'" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');

if(mysqli_num_rows($ba)>0){

$res=mysqli_fetch_array($ba);



if($res['markupType']=='Flat'){

$taxCost=($pax*$res['markupValue']);  

$finalCost=$baseFare+($pax*$res['markupValue']);  



$returnData = array(round($finalCost), round($finalCost+$surcharge), $finalBaseFare); 



}



if($res['markupType']=='%'){

$taxCost=(($baseFare*$res['markupValue']/100));  

$finalCost=$baseFare+(($baseFare*$res['markupValue']/100));  



$returnData = array(round($finalCost), round($finalCost+$surcharge), $finalBaseFare); 



} 

}

}







}

}


}
 

 

return $returnData; 

}

}





















//--------------------------------------ADMIN ONLY----------------------------------------

function calculateflightcostForAgent($agentId,$flightName,$flightType,$fareType,$pax,$baseFare,$surcharge){  

 if($agentId!=''){

 

 

 

$a=GetPageRecord('commissionType','sys_userMaster',' id="'.$_SESSION['agentUserid'].'"');  

$editresultgroup=mysqli_fetch_array($a);  

 

$ab=GetPageRecord('commissionType','sys_userMaster',' id in(select parentId from sys_userMaster where id="'.$_SESSION['agentUserid'].'" ) ');  

$admincommisiontype=mysqli_fetch_array($ab);  

 

 



$finalBaseFare=$baseFare;

$returnData = array($surcharge, ($baseFare+$surcharge), $finalBaseFare);

 

if (strpos($fareType, '~') !== false) {

$fareType=explode('~',$fareType); 

$fareType=$fareType[1];

} 



if(trim($fareType[1])==''){

$fareType=$fareType;

}



if($flightName!=''){

 















/*========================================================Admin==============================================================================================*/







 







 $exbaseFare=$baseFare;

 



$a=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster',' sectorType="'.$_SESSION['domesticorinter'].'"  and agentTypeGroupId="'.$admincommisiontype['commissionType'].'" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');   

if(mysqli_num_rows($a)>0){

$res=mysqli_fetch_array($a);



if($res['markupType']=='Flat'){

$taxCost=($pax*$res['markupValue']);  

$finalCost=$baseFare+($pax*$res['markupValue']);  

$finalCostAdmin=$baseFare+($pax*$res['markupValue']);  





$baseFare=$finalCostAdmin; 

$returnData = array(round($taxCost+$surcharge), round($finalCost+$surcharge), $finalBaseFare);  





// $fp = $baseFare.'----'.$flightName.'----'.$fareType.'----'.$res['markupValue'].'----'.$exbaseFare;

 

?>

<script>

// alert('<?php echo $fp; ?>');

</script>

<?php

 

 



}



if($res['markupType']=='%'){

$taxCost=(($baseFare*$res['markupValue']/100));  

$finalCost=$baseFare+(($baseFare*$res['markupValue']/100));  

$finalCostAdmin=$baseFare+(($baseFare*$res['markupValue']/100));  



$baseFare=$finalCostAdmin; 

$returnData = array(round($taxCost+$surcharge), round($finalCost+$surcharge), $finalBaseFare); 

} 



$baseFare=$finalCostAdmin;

}else{



$ba=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster',' sectorType="'.$_SESSION['domesticorinter'].'"  and name="All" and agentTypeGroupId="'.$admincommisiontype['commissionType'].'" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');

if(mysqli_num_rows($ba)>0){

$res=mysqli_fetch_array($ba);



if($res['markupType']=='Flat'){

$taxCost=($pax*$res['markupValue']);  

$finalCost=$baseFare+($pax*$res['markupValue']);  

$finalCostAdmin=$baseFare+($pax*$res['markupValue']);  





$baseFare=$finalCostAdmin; 

  $returnData = array(round($taxCost+$surcharge), round($finalCost+$surcharge), $finalBaseFare); 



}



if($res['markupType']=='%'){

$taxCost=(($baseFare*$res['markupValue']/100));  

$finalCost=$baseFare+(($baseFare*$res['markupValue']/100));  

$finalCostAdmin=$baseFare+(($baseFare*$res['markupValue']/100));  





$baseFare=$finalCostAdmin;

 $returnData = array(round($taxCost+$surcharge), round($finalCost+$surcharge), $finalBaseFare); 

 

 



} 



$baseFare=$finalCostAdmin;

}





}





?>

<script>

  //alert('<?php echo ' sectorType="'.$_SESSION['domesticorinter'].'"  and name in (select displayType from fareTypeMaster where    FIND_IN_SET("'.trim($fareType).'",fareTypeName) ) and agentTypeGroupId="'.$editresultgroup['commissionType'].'" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")' ?>');

</script>

<?php

 

 



 



/*=======================================================Agent===============================================================================================================*/

/*====================================================================================================================================================================================*/

 

$a=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster',' id=0 and sectorType="'.$_SESSION['domesticorinter'].'"  and name in (select displayType from fareTypeMaster where    FIND_IN_SET("'.trim($fareType).'",fareTypeName) ) and agentTypeGroupId="'.$editresultgroup['commissionType'].'" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');   

if(mysqli_num_rows($a)>0){

$res=mysqli_fetch_array($a);

if($res['markupType']=='Flat'){

$taxCost=($pax*$res['markupValue']);  

$finalCost=$baseFare+($pax*$res['markupValue']);  



$returnData = array(round($taxCost+$surcharge), round($finalCost+$surcharge), $finalBaseFare); 



}



if($res['markupType']=='%'){

$taxCost=(($baseFare*$res['markupValue']/100));  

$finalCost=$baseFare+(($baseFare*$res['markupValue']/100));  



$returnData = array(round($taxCost+$surcharge), round($finalCost+$surcharge), $finalBaseFare); 



} 

}else{



$ba=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster',' id=0 and sectorType="'.$_SESSION['domesticorinter'].'"  and name="All" and agentTypeGroupId="'.$editresultgroup['commissionType'].'" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');

if(mysqli_num_rows($ba)>0){

$res=mysqli_fetch_array($ba);



if($res['markupType']=='Flat'){

$taxCost=($pax*$res['markupValue']);  

$finalCost=$baseFare+($pax*$res['markupValue']);  



$returnData = array(round($taxCost+$surcharge), round($finalCost+$surcharge), $finalBaseFare); 



}



if($res['markupType']=='%'){

$taxCost=(($baseFare*$res['markupValue']/100));  

$finalCost=$baseFare+(($baseFare*$res['markupValue']/100));  



$returnData = array(round($taxCost+$surcharge), round($finalCost+$surcharge), $finalBaseFare); 



} 

}

}

}



 

 

return $returnData; 

}



}





//--------------------------------------Agent Markup ONLY----------------------------------------









function calculateflightcostForAgentMarkup($agentId,$flightName,$flightType,$fareType,$pax,$baseFare,$surcharge){  

 

 

 

 

$a=GetPageRecord('commissionType','sys_userMaster',' id="'.$_SESSION['agentUserid'].'"');  

$editresultgroup=mysqli_fetch_array($a);  

  

 

 



$finalBaseFare=$baseFare;

$returnData = array(round(0)); 

 

if (strpos($fareType, '~') !== false) {

$fareType=explode('~',$fareType); 

$fareType=$fareType[1];

} 



if(trim($fareType[1])==''){

$fareType=$fareType;

}



//if($flightType=='D' || $flightType=='I' ){

if($flightType=='W' || $flightType=='K' ){

 






if($usethis==1){
 

$a=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster',' sectorType="'.$_SESSION['domesticorinter'].'"  and name in (select displayType from fareTypeMaster where    FIND_IN_SET("'.trim($fareType).'",fareTypeName) ) and agentTypeGroupId="'.$editresultgroup['commissionType'].'" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');   

if(mysqli_num_rows($a)>0){

$res=mysqli_fetch_array($a);

if($res['markupType']=='Flat'){

$taxCost=($pax*$res['markupValue']);  

$finalCost=$baseFare+($pax*$res['markupValue']);  



$returnData = array(round($taxCost));   



}



if($res['markupType']=='%'){

$taxCost=(($baseFare*$res['markupValue']/100));  

$finalCost=$baseFare+(($baseFare*$res['markupValue']/100));  



$returnData = array(round($taxCost));  



} 

}else{



$ba=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster',' sectorType="'.$_SESSION['domesticorinter'].'"   and name="All" and agentTypeGroupId="'.$editresultgroup['commissionType'].'" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');

if(mysqli_num_rows($ba)>0){

$res=mysqli_fetch_array($ba);



if($res['markupType']=='Flat'){

$taxCost=($pax*$res['markupValue']);  

$finalCost=$baseFare+($pax*$res['markupValue']);  



$returnData = array(round($taxCost));  



}



if($res['markupType']=='%'){

$taxCost=(($baseFare*$res['markupValue']/100));  

$finalCost=$baseFare+(($baseFare*$res['markupValue']/100));  



$returnData = array(round($taxCost));    



} 

}

}

 }



 

 

return $returnData; 

 

}

}



 





function getAgentCommission($baseFare,$flightName,$fareType){



$returnData=0;



if (strpos($fareType, '~') !== false) {

$fareType=explode('~',$fareType); 

$fareType=$fareType[1];

} 





if(trim($fareType[1])==''){

$fareType=$fareType;

}



if($fareType=='CORP' && $flightName=='Air Asia'){



//echo 'fareTypedomesticFlightsCommissionMaster','   commissionType="'.$_SESSION['commissionType'].'" and name="'.trim($fareType).'" and flightId in (select id from domesticFlightsCommissionMaster where name="'.$flightName.'")';



}



$a=GetPageRecord('*','fareTypedomesticFlightsCommissionMaster','   commissionType="'.$_SESSION['commissionType'].'" and flightId in (select id from domesticFlightsCommissionMaster where name="'.$flightName.'")'); 

if(mysqli_num_rows($a)>0){

$res=mysqli_fetch_array($a); 







if($res['markupType']=='Flat'){

$finalCost=$res['markupValue']; 

$returnData = $finalCost;  

}



if($res['markupType']=='%'){

$finalCost=(($baseFare*$res['markupValue']/100)); 

$returnData = $finalCost;  

} 







if($res['cashBackType']=='Flat' && $res['cashBackValue']>0){

$finalCost+=$res['cashBackValue']; 

$returnData=$finalCost;  

}



if($res['cashBackType']=='%' && $res['cashBackValue']>0){

$finalCost+=(($baseFare*$res['cashBackValue']/100)); 

$returnData=$finalCost;  

} 



 

}else{

 

$ba=GetPageRecord('*','fareTypedomesticFlightsCommissionMaster','   commissionType="'.$_SESSION['commissionType'].'" and name="All" and flightId in (select id from domesticFlightsCommissionMaster where name="'.$flightName.'")');

if(mysqli_num_rows($ba)>0){

$res=mysqli_fetch_array($ba);



if($res['markupType']=='Flat'){

$finalCost=$res['markupValue']; 

$returnData = $finalCost;  

}



if($res['markupType']=='%'){

$finalCost=(($baseFare*$res['markupValue']/100)); 

$returnData = $finalCost;  

} 





if($res['cashBackType']=='Flat' && $res['cashBackValue']>0){

$finalCost+=$res['cashBackValue']; 

$returnData=$finalCost;  

}



if($res['cashBackType']=='%' && $res['cashBackValue']>0){

$finalCost+=(($baseFare*$res['cashBackValue']/100)); 

$returnData=$finalCost;  

} 





}

}





 





return $returnData; 





}























































//*********************************  HOTEL MARKUP  ************************************************************************************







//--------------------------------------ADMIN + AGENT----------------------------------------

function calculatehotelcost($agentId,$hotelName,$baseFare,$hotelMasterTax){ 

$totalMarkup=0;

$markupStatus=0;

$markupAdmin=0;

$markupAgent=0;







 if($agentId!=''){

 

$returnData = array(($baseFare+$hotelMasterTax),'0',($baseFare+$tax),'0','0');

  

 



 //--------------------================Admin Markup========================-------------------



$a=GetPageRecord('*','fareTypedomesticHotelMarkupMaster','  1 and   addBy=1 and hotelId in (select id from domesticHotelMarkupMaster where name="'.$hotelName.'") order by id desc');   

if(mysqli_num_rows($a)>0){

$markupStatus=1;

$res=mysqli_fetch_array($a);



if($res['markupType']=='Flat'){

$taxCost=($res['markupValue']);   



$totalMarkup+=round($taxCost); 

$markupAdmin=round($taxCost);

}



if($res['markupType']=='%'){

$taxCost=($baseFare*$res['markupValue']/100);   



$totalMarkup+=round($taxCost); 

$markupAdmin=round($taxCost);

} 

}else{







$a=GetPageRecord('*','fareTypedomesticHotelMarkupMaster',' 1 and  addBy=1 and hotelId in (select id from domesticHotelMarkupMaster where name="All") order by id desc');   

if(mysqli_num_rows($a)>0){

$markupStatus=1;

$res=mysqli_fetch_array($a);



if($res['markupType']=='Flat'){

$taxCost=($res['markupValue']);   



$totalMarkup+=round($taxCost); 

$markupAdmin=round($taxCost);

}



if($res['markupType']=='%'){

$taxCost=($baseFare*$res['markupValue']/100);   



$totalMarkup+=round($taxCost); 

$markupAdmin=round($taxCost);

} 





}

}

 







//--------------------================Agent Markup========================-------------------

 

$a=GetPageRecord('*','fareTypedomesticHotelMarkupMaster',' addBy="'.$_SESSION['parentid'].'" and hotelId in (select id from domesticHotelMarkupMaster where name="'.$hotelName.'") order by id desc');   

if(mysqli_num_rows($a)>0){ 

$markupStatus=1;

$res=mysqli_fetch_array($a);

if($res['markupType']=='Flat'){

$taxCost=($res['markupValue']);   



$totalMarkup+=round($taxCost); 

$markupAgent=round($taxCost);

}



if($res['markupType']=='%'){

$taxCost=($baseFare*$res['markupValue']/100);  



$totalMarkup+=round($taxCost); 

$markupAgent=round($taxCost);

} 

 }else{ 



$a=GetPageRecord('*','fareTypedomesticHotelMarkupMaster',' addBy="'.$_SESSION['parentid'].'" and hotelId in (select id from domesticHotelMarkupMaster where name="All") order by id desc');   

if(mysqli_num_rows($a)>0){





$markupStatus=1;

$res=mysqli_fetch_array($a);

if($res['markupType']=='Flat'){

$taxCost=($res['markupValue']);   



$totalMarkup+=round($taxCost); 

$markupAgent=round($taxCost);

}



if($res['markupType']=='%'){

$taxCost=($baseFare*$res['markupValue']/100);  



$totalMarkup+=round($taxCost); 

$markupAgent=round($taxCost);

} 



}

 }



 if($markupStatus==1){

 $basicCost=($baseFare+$hotelMasterTax);

 $finalCost=round(($baseFare+$hotelMasterTax)+$totalMarkup);

 

$returnData = array($basicCost,$totalMarkup,$finalCost,$markupAgent,$markupAdmin);

 }

return $returnData; 

 

}

}

























 function calculatehotelcostagent($agentId,$hotelName,$baseFare,$hotelMasterTax){ 

$totalMarkup=0;

$markupStatus=0;

$markupAdmin=0;

$markupAgent=0;







 if($agentId!=''){

  

  

 

 



//--------------------================Agent Markup========================-------------------

 

$a=GetPageRecord('*','fareTypedomesticHotelMarkupMaster',' addBy="'.$_SESSION['parentid'].'" and hotelId in (select id from domesticHotelMarkupMaster where name="'.$hotelName.'") order by id desc');   

if(mysqli_num_rows($a)>0){ 





$markupStatus=1;

$res=mysqli_fetch_array($a);

if($res['markupType']=='Flat'){

$taxCost=($res['markupValue']);   



$totalMarkup+=round($taxCost); 

$markupAgent=round($taxCost);

}



if($res['markupType']=='%'){

$taxCost=($baseFare*$res['markupValue']/100);  



$totalMarkup+=round($taxCost); 

$markupAgent=round($taxCost);

} 

 }else{ 



$a=GetPageRecord('*','fareTypedomesticHotelMarkupMaster',' addBy="'.$_SESSION['parentid'].'" and hotelId in (select id from domesticHotelMarkupMaster where name="All") order by id desc');   

if(mysqli_num_rows($a)>0){



$markupStatus=1;

$res=mysqli_fetch_array($a);

if($res['markupType']=='Flat'){

$taxCost=($res['markupValue']);   



$totalMarkup+=round($taxCost); 

$markupAgent=round($taxCost);

}



if($res['markupType']=='%'){

$taxCost=($baseFare*$res['markupValue']/100);  



$totalMarkup+=round($taxCost); 

$markupAgent=round($taxCost);

} 



}

 }



 if($markupStatus==1){

 $basicCost=($baseFare+$hotelMasterTax);

 $finalCost=round(($baseFare+$hotelMasterTax)+$totalMarkup);

 

$returnData = array($basicCost,$totalMarkup,$finalCost,$markupAgent,$markupAdmin);

 }

return $returnData; 

 

}

}







function getHotelAgentCommission($baseFare,$hotelName){

 



$a=GetPageRecord('*','agent_fareTypedomesticHotelsCommissionMaster',' agentId="'.$_SESSION['parentAgentId'].'" and hotelId in (select id from domesticHotelsCommissionMaster where name="'.$hotelName.'")'); 

if(mysqli_num_rows($a)>0){

$res=mysqli_fetch_array($a); 







if($res['markupType']=='Flat'){

$finalCost=$res['markupValue']; 

$returnData = $finalCost;  

}



if($res['markupType']=='%'){

$finalCost=(($baseFare*$res['markupValue']/100)); 

$returnData = $finalCost;  

} 



 

}else{

 

$ba=GetPageRecord('*','agent_fareTypedomesticHotelsCommissionMaster',' agentId="'.$_SESSION['parentAgentId'].'" and hotelId in (select id from domesticHotelsCommissionMaster where name="All")');

if(mysqli_num_rows($ba)>0){

$res=mysqli_fetch_array($ba);



if($res['markupType']=='Flat'){

$finalCost=$res['markupValue']; 

$returnData = $finalCost;  

}



if($res['markupType']=='%'){

$finalCost=(($baseFare*$res['markupValue']/100)); 

$returnData = $finalCost;  

} 

}

}



if($returnData=='' || $returnData==0){

$returnData=0;

}





return $returnData; 





}







function getfaretypedetails($flightname,$faretype){



$fareType=explode('~',$faretype); 

$fareType=$fareType[1];





if(trim($fareType[1])==''){

$fareType=$faretype;

}



$a=GetPageRecord('*','fareTypeMaster',' 1 and  FIND_IN_SET("'.trim($fareType).'",fareTypeName) and flightName="'.trim($flightname).'" '); 

$datares=mysqli_fetch_array($a); 



if($datares['description']!=''){

return stripslashes($datares['description']);

}  

} 





function getfaretypedisplayname($flightname,$faretype){



$fareType=explode('~',$faretype); 

$fareType=$fareType[1];



if(trim($fareType[1])==''){

$fareType=$faretype;

}



$a=GetPageRecord('*','fareTypeMaster',' 1 and  FIND_IN_SET("'.trim($fareType).'",fareTypeName) and flightName="'.trim($flightname).'" '); 

$datares=mysqli_fetch_array($a); 



if($datares['displayType']!=''){

return stripslashes($datares['displayType']);

}  

}





function getfaretypedisplaycolor($flightname,$faretype){



$fareType=explode('~',$faretype); 

$fareType=$fareType[1];



if(trim($fareType[1])==''){

$fareType=$faretype;

}





$a=GetPageRecord('*','fareTypeMaster',' 1 and  FIND_IN_SET("'.trim($fareType).'",fareTypeName) and flightName="'.trim($flightname).'" '); 

$datares=mysqli_fetch_array($a); 



if($datares['displayType']!=''){

return stripslashes($datares['displayColor']);

}  

} 
 




function offlinehotel($hotelName){  
$returnData = 'on'; 

$a=GetPageRecord('*','offlinehotelMaster',' name="'.trim($hotelName).'" ');   

if(mysqli_num_rows($a)>0){ 

$returnData = 'off';  

}else{ 

$ba=GetPageRecord('*','offlinehotelMaster',' name="All" ');

if(mysqli_num_rows($ba)>0){ 

$returnData = 'off'; 

} 

}  

 

return $returnData; 



}



//-------------------Agent Fixed Makup---------------------


 

function agentfixmarkup($agentId,$flightName,$flightType,$fareType,$pax,$baseFare,$surcharge){  

 if($agentId!=''){ 

if($flightName!=''){ 

$a=GetPageRecord('*','sys_flightName',' name="'.$flightName.'"');  
$resflight=mysqli_fetch_array($a); 
 
 //--------------------================Admin Markup========================-------------------

$mainTax=0; 
$mainFinalCost=0;

if($_SESSION['domesticorinter']=='I'){	 
$a=GetPageRecord('*','fixedMarkupAgent',' agentId="'.$_SESSION['agentUserid'].'" and flightId=30'); 
} else { 
$a=GetPageRecord('*','fixedMarkupAgent',' agentId="'.$_SESSION['agentUserid'].'" and flightId="'.$resflight['id'].'"');
}

  
if(mysqli_num_rows($a)>0){ 
$res=mysqli_fetch_array($a);

if($res['type']=='0'){ 
$markup=($pax*$res['value']);   
}
 
if($res['type']=='1'){ 
$markup=round($baseFare*$res['value']/100);    
} 

}else{

$markup=0;

 } 
return $markup; 

}

}

}












//--------------------------------------Make Commission ONLY----------------------------------------





function makecommission($agentId,$flightName,$flightType,$fareType,$pax,$baseFare,$surcharge){  

 if($agentId!=''){

 

 

 

$a=GetPageRecord('commissionType','sys_userMaster',' id="'.$_SESSION['agentUserid'].'"');  

$editresultgroup=mysqli_fetch_array($a);  

 

$ab=GetPageRecord('commissionType','sys_userMaster',' id in(select parentId from sys_userMaster where id="'.$_SESSION['agentUserid'].'" ) ');  

$admincommisiontype=mysqli_fetch_array($ab);  

 

 



$finalBaseFare=$baseFare;

$returnData = array(0,0,0);

 

if (strpos($fareType, '~') !== false) {

$fareType=explode('~',$fareType); 

$fareType=$fareType[1];

} 



if(trim($fareType[1])==''){

$fareType=$fareType;

}



if($flightName!=''){

 















/*========================================================Admin==============================================================================================*/







 







 $exbaseFare=$baseFare;




$a=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster',' sectorType="'.$_SESSION['domesticorinter'].'"  and agentTypeGroupId="'.$admincommisiontype['commissionType'].'" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');   

if(mysqli_num_rows($a)>0){

$res=mysqli_fetch_array($a);



if($res['markupType']=='Flat'){

$taxCost=($pax*$res['markupValue']);  

$finalCost=$baseFare+($pax*$res['markupValue']);  

$finalCostAdmin=$baseFare+($pax*$res['markupValue']);  





$baseFare=$finalCostAdmin; 

$returnData = array(round($taxCost+$surcharge), round($taxCost), $finalBaseFare);  

 

}



if($res['markupType']=='%'){

$taxCost=(($baseFare*$res['markupValue']/100));  

$finalCost=$baseFare+(($baseFare*$res['markupValue']/100));  

$finalCostAdmin=$baseFare+(($baseFare*$res['markupValue']/100));  



$baseFare=$finalCostAdmin; 

$returnData = array(round($taxCost+$surcharge), round($taxCost), $finalBaseFare); 

} 



$baseFare=$finalCostAdmin;

}else{



$ba=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster',' sectorType="'.$_SESSION['domesticorinter'].'"  and name="All" and agentTypeGroupId="'.$admincommisiontype['commissionType'].'" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');

if(mysqli_num_rows($ba)>0){

$res=mysqli_fetch_array($ba);



if($res['markupType']=='Flat'){

$taxCost=($pax*$res['markupValue']);  

$finalCost=$baseFare+($pax*$res['markupValue']);  

$finalCostAdmin=$baseFare+($pax*$res['markupValue']);  





$baseFare=$finalCostAdmin; 

  $returnData = array(round($taxCost+$surcharge), round($taxCost), $finalBaseFare); 



}



if($res['markupType']=='%'){

$taxCost=(($baseFare*$res['markupValue']/100));  

$finalCost=$baseFare+(($baseFare*$res['markupValue']/100));  

$finalCostAdmin=$baseFare+(($baseFare*$res['markupValue']/100));  





$baseFare=$finalCostAdmin;

 $returnData = array(round($taxCost+$surcharge), round($taxCost), $finalBaseFare); 

 

 



} 



$baseFare=$finalCostAdmin;

}





}


 



/*=======================================================Agent===============================================================================================================*/

/*====================================================================================================================================================================================*/


 

$a=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster','  sectorType="'.$_SESSION['domesticorinter'].'"  and name in (select displayType from fareTypeMaster where    FIND_IN_SET("'.trim($fareType).'",fareTypeName) ) and agentTypeGroupId="'.$editresultgroup['commissionType'].'" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');   

if(mysqli_num_rows($a)>0){

$res=mysqli_fetch_array($a);

if($res['markupType']=='Flat'){

$taxCost=($pax*$res['markupValue']);  

$finalCost=$baseFare+($pax*$res['markupValue']);  







$returnData = array(round($taxCost+$surcharge), round($taxCost), $finalBaseFare); 



}



if($res['markupType']=='%'){

$taxCost=(($baseFare*$res['markupValue']/100));  

$finalCost=$baseFare+(($baseFare*$res['markupValue']/100));  



$returnData = array(round($taxCost+$surcharge), round($taxCost), $finalBaseFare); 



} 

}else{



$ba=GetPageRecord('*','agent_fareTypedomesticFlightsMarkupMaster','   sectorType="'.$_SESSION['domesticorinter'].'"  and name="All" and agentTypeGroupId="'.$editresultgroup['commissionType'].'" and flightId in (select id from domesticFlightsMarkupMaster where name="'.$flightName.'")');

if(mysqli_num_rows($ba)>0){

$res=mysqli_fetch_array($ba);



if($res['markupType']=='Flat'){

$taxCost=($pax*$res['markupValue']);  

$finalCost=$baseFare+($pax*$res['markupValue']);  



$returnData = array(round($taxCost+$surcharge), round($taxCost), $finalBaseFare); 



}



if($res['markupType']=='%'){

$taxCost=(($baseFare*$res['markupValue']/100));  

$finalCost=$baseFare+(($baseFare*$res['markupValue']/100));  



$returnData = array(round($taxCost+$surcharge), round($taxCost), $finalBaseFare); 



} 

}

}

}



 
 
 

return $returnData; 

}



}



?>
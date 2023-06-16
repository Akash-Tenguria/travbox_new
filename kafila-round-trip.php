<?php


//include('top-cache.php');

$jsonAuth = '{
   "TYPE":"AUTH",
   "NAME":"GET_AUTH_TOKEN",
   "STR":[
      {
         "A_ID":"'.$A_ID.'",
         "U_ID":"'.$U_ID.'",
         "PWD":"'.$PWD.'",
         "MODULE":"'.$MODULE.'",
         "HS":"'.$hitSource.'"
      }
   ]
}';

//logger("JSON POST FOR AUTH: ".$jsonAuth);
if($_REQUEST['fixedDeparture']!=1){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$TokenUrl);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonAuth);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
curl_setopt($ch, CURLOPT_TIMEOUT, 300); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

$responseAuth = curl_exec($ch); 
curl_close($ch);
$responseAuthArr = json_decode($responseAuth);


//logger("Response return from auth API: ".$responseAuth);


 
}



$tokenId = trim($responseAuthArr->RESULT);
$newSessionId = trim($_SESSION['uniqueId']);
$tripType = trim($_REQUEST['tripType']);
$fromDestinationFlight = trim($_REQUEST['fromDestinationFlight']);
$toDestinationFlight = trim($_REQUEST['toDestinationFlight']);
$journeyDateOne = trim($_REQUEST['journeyDateOne']);
$journeyDateRound = trim($_GET['journeyDateRound']);

$ADT = trim($_REQUEST['ADT']);
$CHD = trim($_REQUEST['CHD']);
$INF = trim($_REQUEST['INF']);
$PC = trim($_REQUEST['PC']);
$toalPaxFinal=$ADT+$CHD+$INF;
$toalPax=$ADT+$CHD;

if($tripType=='1'){ 
	 $journeyDate = date('Y-m-d',strtotime($journeyDateOne));
	 $returnDate = '';
}else{ 
	 
	 $journeyDate = date('Y-m-d',strtotime($journeyDateOne));
	 $returnDate = date('Y-m-d',strtotime($journeyDateRound));
}

$fromdestexp = explode('-',$fromDestinationFlight);
$todestexp = explode('-',$toDestinationFlight);

if (strstr($fromdestexp[1],'India')=='India' && strstr($todestexp[1],'India')=='India') {
  $SECTOR = 'D';
} else {
  $SECTOR = 'I';
}



$jsonPost = '{
			 "TYPE": "AIR",
			 "NAME": "GET_FLIGHT",
			 "STR": [
					 {
						 "AUTH_TOKEN": "'.$tokenId.'",
						 "SESSION_ID": "",
						 "TRIP": "1",
						 "SECTOR": "'.$SECTOR.'",
						 "SRC": "'.$fromdestexp[0].'",
						 "DES": "'.$todestexp[0].'",
						 "DEP_DATE": "'.$journeyDate.'",
						 "RET_DATE": "",
						 "ADT": "'.$ADT.'",
						 "CHD": "'.$CHD.'",
						 "INF": "'.$INF.'",
						 "PC": "'.$PC.'",
						 "PF": "",
						 "HS": "'.$hitSource.'",
					 }
					]
			}';
			
//logger('JSON POST FOR FLIGHT SEARCH: '.$jsonPost);	
//echo $FlightSearchUrl;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$FlightSearchUrl);
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

// print_r($data);
$flightType=$SECTOR; 




foreach((array) $data->FLIGHT as $flightList){
			   
		 
			
		 
			$i = 1;
			$baseFare=0;	
			$surcharge=0;	 
			$taxBreakup = explode(',',$flightList->TAX_BREAKUP);
			foreach($taxBreakup as $faredetail){
			$newfaredetail = explode('=',$faredetail);
			
			if($newfaredetail[0]=='ab'){
			$adultFare = $newfaredetail[1];
			}
			if($newfaredetail[0]=='ay'){
			 $adultay = $newfaredetail[1];
			}
			if($newfaredetail[0]=='at'){
			 $adultat = $newfaredetail[1];
			} 
			if($newfaredetail[0]=='cb'){
			 $childFare = $newfaredetail[1];
			} 
			if($newfaredetail[0]=='cy'){
			 $childTax = $newfaredetail[1];
			} 
			if($newfaredetail[0]=='ct'){
			 $childTax2 = $newfaredetail[1];
			}
			if($newfaredetail[0]=='ib'){
			 $infantFare = $newfaredetail[1];
			}
			
			
			$i++;
			}
			
			$totalPaxFare=round(($adultFare*$ADT)+($childFare*$CHD)+($infantFare*$INF));
			$totalTax=round((($adultay+$adultat)*$ADT)+(($childTax+$childTax2)*$CHD));
			
			if($totalPaxFare<1 && $flightList->F_TYPE){
			$totalPaxFare=$flightList->AMT;
			} 
			
			$getCalCost=calculateflightcost(encode($agentid),$flightList->F_NAME,$flightType,$flightList->PCC,$toalPax,$totalPaxFare,$totalTax);
			$getCalCost2=calculateflightcostForAgent(encode($agentid),$flightList->F_NAME,$flightType,$flightList->PCC,$toalPax,$totalPaxFare,$totalTax);
			
		
		 if($totalPaxFare==getAgentCommission($totalPaxFare,$flightList->F_NAME,$flightList->PCC)){ 
		 
		 $netamount = round($getCalCost[1]);
		 
		  }else{ 
		  
		  $netamount = round($getCalCost2[1]-(getAgentCommission($totalPaxFare,$flightList->F_NAME,$flightList->PCC)));
		  
		   } 
		   
$nefareamountnew=round($flightList->NET_FARE+$getCalCost['3']);
		   
			$getNetFare=calculateflightcostForAgentNetFare(encode($agentid),$flightList->F_NAME,$flightType,$flightList->PCC,$toalPax,$flightList->NET_FARE,$totalTax);
			$netamount = $getNetFare[0];
		   
			
			$flightinfodata = explode('|', $flightList->FLIGHT_INFO);
			
			 $adfare='baseFare='.$totalPaxFare.',tax='.$totalTax.',totalFare='.($totalPaxFare+$totalTax);
			 $agfare='baseFare='.$getCalCost2[2].',tax='.$getCalCost2[0].',totalFare='.$getCalCost2[1];
			 $clfare='baseFare='.$getCalCost[2].',tax='.$getCalCost[0].',totalFare='.$getCalCost[1];
			  
	 if(getBlockFlights($agentId,$flightList->F_NAME,$flightList->PCC)!=1){		 
			
		  $namevalue ='UID="'.$flightList->UID.'",TID="'.$flightList->TID.'",apiType="kafila",ResultIndex="'.$flightList->ID.'",ORG_CODE="'.$fromdestexp[0].'",ORG_NAME="'.$flightList->D_NAME.'",DES_CODE="'.$todestexp[0].'",DES_NAME="'.$flightList->A_NAME.'",DEP_DATE="'.$journeyDate.'",DEP_TIME="'.$flightList->D_TIME.'",ARRV_DATE="'.$flightList->A_DATE.'",ARRV_TIME="'.$flightList->A_TIME.'",FLIGHT_CODE="'.$flightList->F_CODE.'",FLIGHT_NAME="'.$flightList->F_NAME.'",FLIGHT_NO="'.$flightList->F_NO.'",FARE_TYPE="'.$flightList->PCC.'",SEAT="'.$flightList->SEAT.'",STOP="'.$flightList->STOP.'",AMT="'.$flightList->AMT.'",DISPLAY_AMT="'.$getCalCost[1].'",DUR="'.makeFlightTime($flightList->DUR).'",S_CODE="'.$flightList->S_CODE.'",CN_CODE="'.$flightList->CN_CODE.'",OI="'.$flightList->OI.'",PCC="'.$flightList->PCC.'",TAX_BREAKUP="'.$getCalCost[0].'",FLIGHT_INFO="'.$flightList->FLIGHT_INFO.'",NET_FARE="'.$netamount.'",refundyes="'.$flightinfodata[0].'",AirlineRemark="'.$flightinfodata[0].'",F_CLASS="'.$PC.'",SECTOR="'.$SECTOR.'",adfare="'.$adfare.'",agfare="'.$agfare.'",clfare="'.$clfare.'",CON_DETAILS="'.addslashes(serialize($flightList->CON_DETAILS)).'",PARAM_DATA="'.addslashes(serialize($data->PARAM)).'",agentId="'.$_SESSION['agentUserid'].'",searchJson="'.addslashes(serialize($flightList)).'",tripType=2,netFareBeforecomm="'.$netamount.'",acom="'.round($getCalCost2[1]-$netamount).'"';
				
addlistinggetlastid('wig_flight_json_bkp',$namevalue); 
	
	}		
  
 }	
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
//---------------------------Round Trip--------------------------------------- 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 

$jsonPost = '{
			 "TYPE": "AIR",
			 "NAME": "GET_FLIGHT",
			 "STR": [
					 {
						 "AUTH_TOKEN": "'.$tokenId.'",
						 "SESSION_ID": "",
						 "TRIP": "1",
						 "SECTOR": "'.$SECTOR.'",
						 "SRC": "'.$todestexp[0].'",
						 "DES": "'.$fromdestexp[0].'",
						 "DEP_DATE": "'.$returnDate.'",
						 "RET_DATE": "",
						 "ADT": "'.$ADT.'",
						 "CHD": "'.$CHD.'",
						 "INF": "'.$INF.'",
						 "PC": "'.$PC.'",
						 "PF": "",
						 "HS": "'.$hitSource.'",
					 }
					]
			}';
			
//logger('JSON POST FOR FLIGHT SEARCH: '.$jsonPost);	
//echo $FlightSearchUrl;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$FlightSearchUrl);
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

// print_r($data);
$flightType=$SECTOR; 




foreach((array) $data->FLIGHT as $flightList){
			   
		 
			
		 
			$i = 1;
			$baseFare=0;	
			$surcharge=0;	 
			$taxBreakup = explode(',',$flightList->TAX_BREAKUP);
			foreach($taxBreakup as $faredetail){
			$newfaredetail = explode('=',$faredetail);
			
			if($newfaredetail[0]=='ab'){
			$adultFare = $newfaredetail[1];
			}
			if($newfaredetail[0]=='ay'){
			 $adultay = $newfaredetail[1];
			}
			if($newfaredetail[0]=='at'){
			 $adultat = $newfaredetail[1];
			} 
			if($newfaredetail[0]=='cb'){
			 $childFare = $newfaredetail[1];
			} 
			if($newfaredetail[0]=='cy'){
			 $childTax = $newfaredetail[1];
			} 
			if($newfaredetail[0]=='ct'){
			 $childTax2 = $newfaredetail[1];
			}
			if($newfaredetail[0]=='ib'){
			 $infantFare = $newfaredetail[1];
			}
			
			
			$i++;
			}
			
			$totalPaxFare=round(($adultFare*$ADT)+($childFare*$CHD)+($infantFare*$INF));
			$totalTax=round((($adultay+$adultat)*$ADT)+(($childTax+$childTax2)*$CHD));
			
			if($totalPaxFare<1 && $flightList->F_TYPE){
			$totalPaxFare=$flightList->AMT;
			} 
			
			$getCalCost=calculateflightcost(encode($agentid),$flightList->F_NAME,$flightType,$flightList->PCC,$toalPax,$totalPaxFare,$totalTax);
			$getCalCost2=calculateflightcostForAgent(encode($agentid),$flightList->F_NAME,$flightType,$flightList->PCC,$toalPax,$totalPaxFare,$totalTax);
			$nefareamountnew=calculateflightcostForAgent(encode($agentid),$flightList->F_NAME,$flightType,$flightList->PCC,$toalPax,$flightList->NET_FARE,$totalTax);
		
		 if($totalPaxFare==getAgentCommission($totalPaxFare,$flightList->F_NAME,$flightList->PCC)){ 
		 
		 $netamount = round($getCalCost[1]);
		 
		  }else{ 
		  
		  $netamount = round($getCalCost2[1]-(getAgentCommission($totalPaxFare,$flightList->F_NAME,$flightList->PCC)));
		  
		   } 
		   
	 
		   $nefareamountnew=round($flightList->NET_FARE+$getCalCost['3']);
			
			$flightinfodata = explode('|', $flightList->FLIGHT_INFO);
			
			$getNetFare=calculateflightcostForAgentNetFare(encode($agentid),$flightList->F_NAME,$flightType,$flightList->PCC,$toalPax,$flightList->NET_FARE,$totalTax);
			$netamount = $getNetFare[0];
		   
			
			
			 $adfare='baseFare='.$totalPaxFare.',tax='.$totalTax.',totalFare='.($totalPaxFare+$totalTax);
			 $agfare='baseFare='.$getCalCost2[2].',tax='.$getCalCost2[0].',totalFare='.$getCalCost2[1];
			 $clfare='baseFare='.$getCalCost[2].',tax='.$getCalCost[0].',totalFare='.$getCalCost[1];
			  
		 if(getBlockFlights($agentId,$flightList->F_NAME,$flightList->PCC)!=1){			 
			
		  $namevalue ='UID="'.$flightList->UID.'",TID="'.$flightList->TID.'",ResultIndex="'.$flightList->ID.'",apiType="kafila",ORG_CODE="'.$todestexp[0].'",ORG_NAME="'.$flightList->D_NAME.'",DES_CODE="'.$fromdestexp[0].'",DES_NAME="'.$flightList->A_NAME.'",DEP_DATE="'.$journeyDate.'",DEP_TIME="'.$flightList->D_TIME.'",ARRV_DATE="'.$flightList->A_DATE.'",ARRV_TIME="'.$flightList->A_TIME.'",FLIGHT_CODE="'.$flightList->F_CODE.'",FLIGHT_NAME="'.$flightList->F_NAME.'",FLIGHT_NO="'.$flightList->F_NO.'",FARE_TYPE="'.$flightList->PCC.'",SEAT="'.$flightList->SEAT.'",STOP="'.$flightList->STOP.'",AMT="'.$flightList->AMT.'",DISPLAY_AMT="'.$getCalCost[1].'",DUR="'.makeFlightTime($flightList->DUR).'",S_CODE="'.$flightList->S_CODE.'",CN_CODE="'.$flightList->CN_CODE.'",OI="'.$flightList->OI.'",PCC="'.$flightList->PCC.'",TAX_BREAKUP="'.$getCalCost[0].'",FLIGHT_INFO="'.$flightList->FLIGHT_INFO.'",NET_FARE="'.$netamount.'",refundyes="'.$flightinfodata[0].'",AirlineRemark="'.$flightinfodata[0].'",F_CLASS="'.$PC.'",SECTOR="'.$SECTOR.'",adfare="'.$adfare.'",agfare="'.$agfare.'",clfare="'.$clfare.'",CON_DETAILS="'.addslashes(serialize($flightList->CON_DETAILS)).'",PARAM_DATA="'.addslashes(serialize($data->PARAM)).'",agentId="'.$_SESSION['agentUserid'].'",roundTripFlight=1,searchJson="'.addslashes(serialize($flightList)).'",tripType=2,netFareBeforecomm="'.$netamount.'",acom="'.round($getCalCost2[1]-$netamount).'"';
				
addlistinggetlastid('wig_flight_json_bkp',$namevalue); 
			
  }
  
  
 }	
 
 
 
 ?>
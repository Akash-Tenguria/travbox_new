<?php 
include "inc.php"; 
include "config/logincheck.php"; 

error_reporting(E_ALL);
ini_set('display_errors', '1');


$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://omairiq.azurewebsites.net/login',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "Username":"9555202202",
    "Password":"9800830000@api"
}',
  CURLOPT_HTTPHEADER => array(
    'api-key: NTMzNDUwMDpBSVJJUSBURVNUIEFQSToxODkxOTMwMDM1OTk2OlFRYjhLVjNFMW9UV05RY1NWL0VtcnNnb3dGV0o3SzJ1cVptbzJ1bFp1cEE9',
    'Content-Type: application/json'
  ),
));

$responseAK = curl_exec($curl);
curl_close($curl);

$resultAK=json_decode($responseAK,true); 
$access_tokenAK= $resultAK['token'];
$_SESSION['TokenIdAK'] = $access_tokenAK;






/************** Search *******************/


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
$toalPaxFinal=$ADT+$CHD;
$toalPax=$ADT+$CHD;

$_SESSION['ADT']=$ADT;
$_SESSION['CHD']=$CHD;
$_SESSION['INF']=$INF;

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

$departdateAK = date("Y/m/d", strtotime($journeyDate));
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://omairiq.azurewebsites.net/search',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'    {
    "origin":"'.$fromdestexp[0].'",
    "destination":"'.$todestexp[0].'",
    "departure_date":"'.$departdateAK.'",
    "adult":"'.$ADT.'",
    "child":"'.$CHD.'",
    "infant":"'.$INF.'",
    "airline_code":""
}
',
  CURLOPT_HTTPHEADER => array(
    'api-key: NTMzNDUwMDpBSVJJUSBURVNUIEFQSToxODkxOTMwMDM1OTk2OlFRYjhLVjNFMW9UV05RY1NWL0VtcnNnb3dGV0o3SzJ1cVptbzJ1bFp1cEE9',
    'Authorization: '.$access_tokenAK.'',
    'Content-Type: application/json'
  ),
));


$responseAK = curl_exec($curl);
curl_close($curl);
$search_resultAK=json_decode($responseAK,true); 

/*echo "<pre>";
print_r($search_resultAK);*/


$_SESSION['searchresultAK'] = $search_resultAK['data']; 
file_put_contents("FLYTBOJSON/".$_SESSION['agentUserid']."_fixedAK-results.txt",$responseAK);




if(count($search_resultAK['data'])>0)
{
	foreach($search_resultAK['data'] as $searchResultAKValue)
	{
	   
	    $D_TIME= $searchResultAKValue['departure_time'];
		$A_TIME= $searchResultAKValue['arival_time'];


		$msdate1= $A_TIME;
		$msdate1= explode('T',$msdate1); 
		$msdateaxp1= $msdate1['0'].' '.$msdate1['1']; 
		$msdate2= $D_TIME;
		$msdate2= explode('T',$msdate2); 
		$msdateaxp2= $msdate2['0'].' '.$msdate2['1']; 
		$seconds = strtotime($msdateaxp1) - strtotime($msdateaxp2);
		$hours   = floor($seconds / 3600); 
		$minutes = floor(($seconds - ($hours * 3600))/60); 
		$dur= $hours.'H '.$minutes.'M';		
		
		
		$FIXEDID= $searchResultAKValue['ticket_id'];
		$ORG_CODE= $searchResultAKValue['origin'];
		$ORG_NAME= $searchResultAKValue['origin'];
		
		$DES_CODE= $searchResultAKValue['destination'];
		$DES_NAME= $searchResultAKValue['destination'];
		$DEP_DATE= $searchResultAKValue['departure_date'];
		$DEP_TIME= $searchResultAKValue['departure_time'];
		
		$ARRV_DATE= $searchResultAKValue['arival_date'];
		$ARRV_TIME= $searchResultAKValue['arival_time'];
		
		

		
		$flightNoArr=explode(" ",$searchResultAKValue['flight_number']);
		$flightNoGF=trim($flightNoArr[1]);
		
		$FLIGHT_CODE= trim($flightNoArr[0]);
		$FLIGHT_NAME= $searchResultAKValue['airline'];
		
		$FLIGHT_NO= $flightNoGF;
		
		$FARE_TYPE='FEXEDAK';
		
		$SEAT=$searchResultAKValue['pax'];
		$STOP=0;
		
		
		
		$S_CODE=$searchResultAKValue['origin']."-".$searchResultAKValue['destination'];
		$CN_CODE=$searchResultAKValue['flight_number'];
		$FLIGHT_INFO='7 Kg,15 Kg';
		$NET_FARE=($searchResultAKValue['price']+50);
		
		$flightType='D';
		$totalPaxFare=($NET_FARE);
		
		//$totalTax=$searchResultAKValue['tax_and_other_charges'];
		$totalTax=0;
		
		
		
		$totalPaxFare=round($totalPaxFare*$toalPax);
		
		
		if($INF>0){
		$totalPaxFare=$totalPaxFare+($INF*1750);
		}
		$AMT=$totalPaxFare;
		
		
	$getCalCost=calculateflightcost(encode($agentid),$FLIGHT_NAME,$flightType,$FARE_TYPE,$toalPax,$totalPaxFare,$totalTax);
            $getCalCost2=calculateflightcostForAgent(encode($agentid),$FLIGHT_NAME,$flightType,$FARE_TYPE,$toalPax,$totalPaxFare,$totalTax);
			
			 $getAgentTaxonly=calculateflightcostForAgentMarkup(encode($agentid),$FLIGHT_NAME,$flightType,$FARE_TYPE,$toalPax,$totalPaxFare,$totalTax);
             
           
           $getNetFare=calculateflightcostForAgentNetFare(encode($agentid),$FLIGHT_NAME,$flightType,$FARE_TYPE,$toalPax,$NET_FARE,$totalTax);
           $netamount = $getNetFare[0];
     

            
             $adfare='baseFare='.$totalPaxFare.',tax='.$totalTax.',totalFare='.($totalPaxFare+$totalTax);
             $agfare='baseFare='.$getCalCost2[2].',tax='.$getCalCost2[0].',totalFare='.$getCalCost2[1];
             $clfare='baseFare='.$getCalCost[2].',tax='.$getCalCost[0].',totalFare='.$getCalCost[1];
              
			  
			  
			   $adminMarkup=($getCalCost2[1]-$getCalCost[1]);
			  $totaldisplayTax=($getCalCost2[0]+$adminMarkup)-($getAgentTaxonly[0]);
 
         //echo round($flightList->NET_FARE+$getCalCost['3']).'-'.$getCalCost2[1].'-'.$getCalCost['3'].'-'.$flightList->NET_FARE.'+++++++++++++';
         $nefareamountnew=round($NET_FARE+$getCalCost['3']);		
		
		
		 if(getBlockFlights($agentId,$FLIGHT_NAME,$FARE_TYPE)!=1){
		 
		$agentFixedMakup=round(agentfixmarkup(encode($agentid),$FLIGHT_NAME,$flightType,$FARE_TYPE,$toalPax,$getCalCost2[1],$totalTax));
		
$namevalue ='
 UID="",TID=""
 ,ResultIndex=""
 ,FIXEDID="'.$FIXEDID.'"
 ,ORG_CODE="'.$ORG_CODE.'"
 ,apiType="AK"
 ,ORG_NAME="'.$ORG_NAME.'"
 ,DES_CODE="'.$DES_CODE.'"
 ,DES_NAME="'.$DES_NAME.'"
 ,DEP_DATE="'.$DEP_DATE.'"
 ,DEP_TIME="'.$DEP_TIME.'"
 ,ARRV_DATE="'.$ARRV_DATE.'"
 ,ARRV_TIME="'.$ARRV_TIME.'"
 ,FLIGHT_CODE="'.trim($FLIGHT_CODE).'"
 ,FLIGHT_NAME="'.$FLIGHT_NAME.'"
 ,FLIGHT_NO="'.trim($FLIGHT_NO).'"
 ,FARE_TYPE="'.$FARE_TYPE.'"
 ,SEAT="'.$SEAT.'"
 ,STOP="'.$STOP.'"
 ,AMT="'.$getCalCost2[1].'"
 ,DISPLAY_AMT="'.$AMT.'"
 ,DUR="'.$dur.'"
 ,S_CODE="'.$S_CODE.'"
 ,CN_CODE="'.$CN_CODE.'"
 ,OI=""
 ,PCC="'.$FARE_TYPE.'"
 ,TAX_BREAKUP="0"
 ,FLIGHT_INFO="'.$FLIGHT_INFO.'"
 ,agentFixedMakup="'.$agentFixedMakup.'"
 ,NET_FARE="'.$getCalCost2[1].'"
 ,refundyes=""
 ,AirlineRemark=""
 ,F_CLASS=""
 ,SECTOR="'.$flightType.'"

 ,CON_DETAILS=""
 ,PARAM_DATA="",agentId="'.$_SESSION['agentUserid'].'"
 ,searchJson=""
 ,tripType=1
 ,acom="0"
 ,netFareBeforecomm="'.$getCalCost2[1].'"
 ,adfare="'.$adfare.'",agfare="'.$agfare.'",clfare="'.$clfare.'",agentMarkup="'.$getAgentTaxonly[0].'",adminMarkup="'.$adminMarkup.'",totalTax="'.$totaldisplayTax.'"';
 
addlistinggetlastid('wig_flight_json_bkp',$namevalue); 		
		
		}
		
	   
	}
	
}



 ?>
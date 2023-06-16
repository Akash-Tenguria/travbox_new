<?php
$newSessionId = trim($_SESSION['uniqueId']);
$tripType = trim($_REQUEST['tripType']);
$fromDestinationFlight = trim($_REQUEST['fromDestinationFlight']);
$toDestinationFlight = trim($_REQUEST['toDestinationFlight']);
$journeyDateOne = trim($_REQUEST['journeyDateOne']);
$journeyDateRound = trim($_GET['journeyDateRound']);
$tocitydesti = trim($_GET['tocitydesti']);
$tocitydesti = explode('-',$tocitydesti);

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
$PC = trim($_REQUEST['PC']);

$postdata='{
  "searchQuery": {
    "cabinClass": "'.$PC.'",
    "paxInfo": {
      "ADULT": "'.$ADT.'",
      "CHILD": "'.$CHD.'",
      "INFANT": "'.$INF.'"
    },
    "routeInfos": [
      {
        "fromCityOrAirport": {
          "code": "'.$fromdestexp[0].'"
        },
        "toCityOrAirport": {
          "code": "'.$todestexp[0].'"
        },
        "travelDate": "'.$journeyDate.'"
      },
      {
        "fromCityOrAirport": {
          "code": "'.$todestexp[0].'"
        },
        "toCityOrAirport": {
          "code": "'.$fromdestexp[0].'"
        },
        "travelDate": "'.$returnDate.'"
      }	  
    ],
    "searchModifiers": {
      "isDirectFlight": true,
      "isConnectingFlight": true
    }
  }
}';

 // **************** Tripjack API **************************
 
include dirname(__FILE__).'/tripjackAPI/APIConstants.php';
include dirname(__FILE__).'/tripjackAPI/RestApiCaller.php';



try
{

$req=file_put_contents("tripjackAPIJson/SearchRequest.json",$postdata);
$restCaller = new RestApiCaller();
$flightRes = $restCaller->getTripJackResponse(_APISEARCH_, $postdata);
$result=file_put_contents("tripjackAPIJson/SearchResultResponse.json","$flightRes");
$search_result = json_decode($flightRes,true);

}
catch(Exception $e)
{
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Flights Result Are Not Found.";
   // include dirname(dirname(__FILE__)).'/error.php';
    exit;
}

/*echo "International";
echo "<pre>";
print_r($search_result);*/
//die;

// insert data into DB

if($search_result['status']['success']==true)
{
	
	$flightInfoResultOnward=$search_result['searchResult']['tripInfos']['COMBO'];
	if(count($flightInfoResultOnward)>0)
	{
		
			$totalNetFare=0;	
			$totalBaseFare=0;
			$totalTax=0;
			$totalFare=0; 	
			  $adfare='';
			 $agfare='';
			 $clfare='';	
		foreach($flightInfoResultOnward as $flightInfoResultOnwardValue)
		{
			$searchJson=$flightInfoResultOnwardValue;
			// get Source Information
			 $ORG_CODE=$flightInfoResultOnwardValue['sI'][0]['da']['code'];
			 $ORG_NAME=$flightInfoResultOnwardValue['sI'][0]['da']['city'];
			 $ORG_Terminal=$flightInfoResultOnwardValue['sI'][0]['da']['terminal']." - ".$flightInfoResultOnwardValue['sI'][0]['da']['name'];
			 $ORG_country=$flightInfoResultOnwardValue['sI'][0]['da']['country'];
			 $ORG_city=$flightInfoResultOnwardValue['sI'][0]['da']['city'];
			 
			  $departureDate=$flightInfoResultOnwardValue['sI'][0]['dt'];
			  $departureDateArr=explode('T',$departureDate);
			  $departurTime=$departureDateArr[1];
			  
			   $FLIGHT_CODE=$flightInfoResultOnwardValue['sI'][0]['fD']['aI']['code'];
			   $FLIGHT_NAME=$flightInfoResultOnwardValue['sI'][0]['fD']['aI']['name'];
			   $isLcc=$flightInfoResultOnwardValue['sI'][0]['fD']['aI']['isLcc'];
			   
			   $FLIGHT_NO=$flightInfoResultOnwardValue['sI'][0]['fD']['fN'];
			   
			   $duration=$flightInfoResultOnwardValue['sI'][0]['duration'];
			   

			// get Destination Information
			   $destinationLast=count($flightInfoResultOnwardValue['sI'])-1;
			   $totalStop=$destinationLast;	
			 
			 $DEST_CODE=$flightInfoResultOnwardValue['sI'][$destinationLast]['aa']['code'];
			 $DEST_NAME=$flightInfoResultOnwardValue['sI'][$destinationLast]['aa']['city'];
			 $DEST_Terminal=$flightInfoResultOnwardValue['sI'][$destinationLast]['aa']['terminal']." - ".$flightInfoResultOnwardValue['sI'][$destinationLast]['aa']['name'];
			 $DEST_country=$flightInfoResultOnwardValue['sI'][$destinationLast]['aa']['country'];
			 $DEST_city=$flightInfoResultOnwardValue['sI'][$destinationLast]['aa']['city'];	
			 
			 $arrivalDate=$flightInfoResultOnwardValue['sI'][$destinationLast]['at'];	
			 $arrivalDateArr=explode('T',$arrivalDate);
			 $arrivalTime=$arrivalDateArr[1];
			 
			 $FLIGHT_CODE=$flightInfoResultOnwardValue['sI'][0]['fD']['aI']['code'];
			 
			 $FARE_TYPE='';
			 
			 			
			   $S_CODE= $ORG_CODE .'-'. $ORG_city;
			   $CN_CODE= $FLIGHT_CODE . ' ' . $FLIGHT_NO; 
			
			$totalNetFare=0;	
			$totalBaseFare=0;
			$totalTax=0;
			$totalFare=0; 
			 // add all fare
			 foreach($flightInfoResultOnwardValue['totalPriceList'] as $totalPriceListValue)
			 {
			 
			 	// Adult fare 
				$adultNetFare=($totalPriceListValue['fd']['ADULT']['fC']['NF']*$ADT);
				$adultTaxFare=($totalPriceListValue['fd']['ADULT']['fC']['TAF']*$ADT);
				$adultBaseFare=($totalPriceListValue['fd']['ADULT']['fC']['BF']*$ADT);
				$adultTotalFare=($totalPriceListValue['fd']['ADULT']['fC']['TF']*$ADT);
				
				
			 	// Child fare 
				$childNetFare=($totalPriceListValue['fd']['CHILD']['fC']['NF']*$ADT);
				$childTaxFare=($totalPriceListValue['fd']['CHILD']['fC']['TAF']*$ADT);
				$childBaseFare=($totalPriceListValue['fd']['CHILD']['fC']['BF']*$ADT);
				$childTotalFare=($totalPriceListValue['fd']['CHILD']['fC']['TF']*$ADT);	
				
			 	// Infant fare 
				$infantNetFare=($totalPriceListValue['fd']['INFANT']['fC']['NF']*$ADT);
				$infantTaxFare=($totalPriceListValue['fd']['INFANT']['fC']['TAF']*$ADT);
				$infantBaseFare=($totalPriceListValue['fd']['INFANT']['fC']['BF']*$ADT);
				$infantTotalFare=($totalPriceListValue['fd']['INFANT']['fC']['TF']*$ADT);									
				
					
				$totalNetFare=($adultNetFare+$childNetFare+$infantNetFare);
				$totalBaseFare=($adultBaseFare+$childBaseFare+$infantBaseFare);
				$totalTax=($adultTaxFare+$childTaxFare+$infantTaxFare);
				$totalFare=($adultTotalFare+$childTotalFare+$infantTotalFare);
					
					
					//$adultTalFare=$totalPriceListValue['fd']['ADULT']['fC']['TF'];


					$ResultIndex=$totalPriceListValue['id'];
					$seatRemaining=$totalPriceListValue['fd']['ADULT']['sR'];
					
				    $FareBasisCode=	$totalPriceListValue['fd']['ADULT']['fB'];	
					$isRefundable =	$totalPriceListValue['fd']['ADULT']['rT'];	// 1 for refuldatble and 0 for Non Refundable
					
					$CabinBaggage=$totalPriceListValue['fd']['ADULT']['bI']['cB'];
					$Baggage=$totalPriceListValue['fd']['ADULT']['bI']['iB'];
					
					$FLIGHT_INFO= $CabinBaggage.','.$Baggage;
			
			$PCC=$totalPriceListValue['fareIdentifier'];
					
			$flightType='D';		
			$getCalCost=calculateflightcost(encode($agentid),$FLIGHT_NAME,$flightType,$PCC,$toalPaxFinal,$totalBaseFare,$totalTax);
			$getCalCost2=calculateflightcostForAgent(encode($agentid),$FLIGHT_NAME,$flightType,$PCC,$toalPaxFinal,$totalBaseFare,$totalTax);
			
			
			
			//$nefareamountnew=calculateflightcost(encode($agentid),$FLIGHT_NAME,$flightType,$PCC,$toalPax,$flightList->NET_FARE,$totalTax);
			
		   $getNetFare=calculateflightcostForAgentNetFare(encode($agentid),$FLIGHT_NAME,$flightType,$PCC,$toalPaxFinal,$totalNetFare,$totalTax);
		   $netamount = $getNetFare[0];
	 
 
			$flightinfodata = "";
			
			 $adfare='baseFare='.$totalPaxFare.',tax='.$totalTax.',totalFare='.($totalPaxFare+$totalTax);
			 $agfare='baseFare='.$getCalCost2[2].',tax='.$getCalCost2[0].',totalFare='.$getCalCost2[1];
			 $clfare='baseFare='.$getCalCost[2].',tax='.$getCalCost[0].',totalFare='.$getCalCost[1];
			 
			 
			  $agentFixedMakup=round(agentfixmarkup(encode($agentid),$FLIGHT_NAME,$flightType,$PCC,$toalPaxFinal,$getCalCost2[1],$totalTax));
 
 		//echo round($flightList->NET_FARE+$getCalCost['3']).'-'.$getCalCost2[1].'-'.$getCalCost['3'].'-'.$flightList->NET_FARE.'+++++++++++++';
 		$nefareamountnew=round($totalNetFare+$getCalCost['3']);	
		
		if($isLcc)
		{
		  $isLcc=1;		
		}
		else
		{
			$isLcc=0;
		}				
					
	$duration=(strtotime($arrivalDate)-strtotime($departureDate))/60;				
	$namevalue ='UID="",TID="",ResultIndex="'.$ResultIndex.'",apiType="tripjack",ORG_CODE="'.$fromdestexp[0].'",ORG_NAME="'.$ORG_NAME.'",DES_CODE="'.$todestexp[0].'",DES_NAME="'.$tocitydesti[1].'",DEP_DATE="'.$journeyDate.'",DEP_TIME="'.$departurTime.'",ARRV_DATE="'.$arrivalDate.'",ARRV_TIME="'.$arrivalTime.'",FLIGHT_CODE="'.$FLIGHT_CODE.'",FLIGHT_NAME="'.$FLIGHT_NAME.'",FLIGHT_NO="'.$FLIGHT_NO.'",FARE_TYPE="'. $FARE_TYPE.'",SEAT="'.$seatRemaining.'",STOP="'.$totalStop.'",AMT="'.$getCalCost2[2].'",DISPLAY_AMT="'.$getCalCost2[1].'",DUR="'.makeFlightTime($duration).'",S_CODE="'.$S_CODE.'",CN_CODE="'.$CN_CODE.'",OI="",PCC="'.$PCC.'",TAX_BREAKUP="'.$getCalCost[0].'",FLIGHT_INFO="'.$FLIGHT_INFO.'",NET_FARE="'.$totalNetFare.'",refundyes="'.$isRefundable.'",AirlineRemark="",F_CLASS="'.$PC.'",SECTOR="'.$SECTOR.'",adfare="'.$adfare.'",agfare="'.$agfare.'",clfare="'.$clfare.'",CON_DETAILS="",PARAM_DATA="",agentId="'.$_SESSION['agentUserid'].'",searchJson="'.addslashes(serialize($searchJson)).'",netFareBeforecomm="'.$netamount.'",acom="'.round($getCalCost2[1]-$netamount).'",tripType=1,IsLCC= '.$isLcc.',roundTripFlight=0,isRoundTripInt=1,agentFixedMakup="'.$agentFixedMakup.'",uniqueSessionId="'.$_SESSION['uniqueSessionId'].'"';
	addlistinggetlastid('wig_flight_json_bkp',$namevalue); 
	  
	  
	        }
		 

				
			
		
		
		}
	
	
	
	}
	
	
 
  




}








/*echo "<pre>";
print_r($search_result);
die;*/




?>
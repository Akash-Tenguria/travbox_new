<?php
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


$postdata='{
  "searchQuery": {
    "cabinClass": "ECONOMY",
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


/*echo "<pre>";
print_r($search_result);
die;*/

// insert data into DB

if($search_result['status']['success']==true)
{
	
	$flightInfoResultOnward=$search_result['searchResult']['tripInfos']['ONWARD'];
	if(count($flightInfoResultOnward)>0)
	{
		$searchJson='';
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
				
					
				$totalNetFare=round($adultNetFare+$childNetFare+$infantNetFare);
				$totalBaseFare=round($adultBaseFare+$childBaseFare+$infantBaseFare);
				$totalTax=round($adultTaxFare+$childTaxFare+$infantTaxFare);
				$totalFare=round($adultTotalFare+$childTotalFare+$infantTotalFare);
					
					
					//$adultTalFare=$totalPriceListValue['fd']['ADULT']['fC']['TF'];


					$ResultIndex=$totalPriceListValue['id'];
					$seatRemaining=$totalPriceListValue['fd']['ADULT']['sR'];
					
				    $FareBasisCode=	$totalPriceListValue['fd']['ADULT']['fB'];	
					$isRefundable =	$totalPriceListValue['fd']['ADULT']['rT'];	// 1 for refuldatble and 0 for Non Refundable
					
					$CabinBaggage=$totalPriceListValue['fd']['ADULT']['bI']['cB'];
					$Baggage=$totalPriceListValue['fd']['ADULT']['bI']['iB'];
					
					$FLIGHT_INFO= 'Baggage:Cabin='.$CabinBaggage.',Checkin='.$Baggage;
			
			$PCC=$totalPriceListValue['fareIdentifier'];
					
			$flightType='D';		
			
			$airline=$FLIGHT_NAME;

			$FareBasisCode=$PCC;

			$toalPax=$toalPaxFinal;

			$totalPaxFare=$totalBaseFare;

			$ResultFareType=$FARE_TYPE;

			$OfferedFare=$totalNetFare;

					

			 

			

			$getCalCost=calculateflightcost(encode($agentid),$airline,$flightType,$FareBasisCode,$toalPax,$totalPaxFare,$totalTax);

			$getCalCost2=calculateflightcostForAgent(encode($agentid),$airline,$flightType,$FareBasisCode,$toalPax,$totalPaxFare,$totalTax);

			$getAgentTaxonly=calculateflightcostForAgentMarkup(encode($agentid),$airline,$flightType,$FareBasisCode,$toalPax,$totalPaxFare,$totalTax);

			

			

			

			if($totalPaxFare==getAgentCommission($totalPaxFare,$airline,$ResultFareType)){ 

		 

		 $netamount = round($getCalCost[1]);

		 

		  }else{ 

		  

		  $netamount = round($getCalCost2[1]-(getAgentCommission($totalPaxFare,$airline,$ResultFareType)));

		  

		   } 

		   

		   

		   

			

			$flightinfodata = "";

			

			 $adfare='baseFare='.$totalPaxFare.',tax='.$totalTax.',totalFare='.($totalPaxFare+$totalTax);

			 $agfare='baseFare='.$getCalCost2[2].',tax='.$getCalCost2[0].',totalFare='.$getCalCost2[1];

			 $clfare='baseFare='.$getCalCost2[2].',tax='.$getCalCost2[0].',totalFare='.$getCalCost2[1];

			 $nefareamountnew=round($OfferedFare+$getCalCost['3']);

			 

			   $adminMarkup=($getCalCost2[1]-($totalPaxFare+$totalTax));

			  $totaldisplayTax=($getCalCost2[0]);

			 

			 

	 $getNetFare=calculateflightcostForAgentNetFare(encode($agentid),$airline,$flightType,$FareBasisCode,$toalPax,$OfferedFare,$totalTax); 

		   $netamount = $getNetFare[0];

	 

	 $commissiondeff=round(($totalPaxFare+$totalTax)-$OfferedFare);

		   

		   

			$duration=(strtotime($arrivalDate)-strtotime($departureDate))/60;

			if($isLcc)

			{

			$isLcc=1;		

			}

			else

			{

			$isLcc=0;

			}			

			

				if(getBlockFlights($agentId,$airline,$FareBasisCode)!=1){

				

				$namevalue ='UID="",TID="",ResultIndex="'.$ResultIndex.'",ORG_CODE="'.$fromdestexp[0].'",apiType="tripjack",ORG_NAME="'.$ORG_NAME.'",DES_CODE="'.$todestexp[0].'",DES_NAME="'.$DEST_NAME.'",DEP_DATE="'.$journeyDate.'",DEP_TIME="'.$departurTime.'",ARRV_DATE="'.$arrivalDate.'",ARRV_TIME="'.$arrivalTime.'",FLIGHT_CODE="'.trim($FLIGHT_CODE).'",FLIGHT_NAME="'.$FLIGHT_NAME.'",FLIGHT_NO="'.$FLIGHT_NO.'",FARE_TYPE="'.$FARE_TYPE.'",SEAT="'.$seatRemaining.'",STOP="'.$totalStop.'",AMT="'.$getCalCost2[1].'",DISPLAY_AMT="'.$PublishedFare.'",DUR="'.makeFlightTime($duration).'",S_CODE="'.$S_CODE.'",CN_CODE="'.$CN_CODE.'",OI="",PCC="'.$FareBasisCode.'",TAX_BREAKUP="0",FLIGHT_INFO="'.$FLIGHT_INFO.'",NET_FARE="'.$OfferedFare.'",refundyes="'.$isRefundable.'",AirlineRemark="",F_CLASS="'.$PC.'",SECTOR="'.$SECTOR.'",adfare="'.$adfare.'",agfare="'.$agfare.'",clfare="'.$clfare.'",CON_DETAILS="",PARAM_DATA="",agentId="'.$_SESSION['agentUserid'].'",searchJson="'.addslashes(serialize($searchJson)).'",tripType=1,acom="'.$commissiondeff.'",IsLCC="'.$IsLCC.'",netFareBeforecomm="'.($getCalCost2[1]-$commissiondeff).'",agentMarkup="'.$getAgentTaxonly[0].'",adminMarkup="'.$adminMarkup.'",totalTax="'.$totaldisplayTax.'"';

				

				

				addlistinggetlastid('wig_flight_json_bkp',$namevalue); 

				

				}
	  
	  
	        }
		 

				
			
		
		
		}
	
	
	
	}
	
	
  // Return Flight 
  
	$flightInfoResultReturn=$search_result['searchResult']['tripInfos']['RETURN'];
	if(count($flightInfoResultReturn)>0)
	{
		
			$totalNetFare=0;	
			$totalBaseFare=0;
			$totalTax=0;
			$totalFare=0; 	
			  $adfare='';
			 $agfare='';
			 $clfare='';	
		foreach($flightInfoResultReturn as $flightInfoResultReturnValue)
		{
			
			// get Source Information
			 $ORG_CODE=$flightInfoResultReturnValue['sI'][0]['da']['code'];
			 $ORG_NAME=$flightInfoResultReturnValue['sI'][0]['da']['city'];
			 $ORG_Terminal=$flightInfoResultReturnValue['sI'][0]['da']['terminal']." - ".$flightInfoResultReturnValue['sI'][0]['da']['name'];
			 $ORG_country=$flightInfoResultReturnValue['sI'][0]['da']['country'];
			 $ORG_city=$flightInfoResultReturnValue['sI'][0]['da']['city'];
			 
			  $departureDate=$flightInfoResultReturnValue['sI'][0]['dt'];
			  $departureDateArr=explode('T',$departureDate);
			  $departurTime=$departureDateArr[1];
			  
			   $FLIGHT_CODE=$flightInfoResultReturnValue['sI'][0]['fD']['aI']['code'];
			   $FLIGHT_NAME=$flightInfoResultReturnValue['sI'][0]['fD']['aI']['name'];
			   $isLcc=$flightInfoResultReturnValue['sI'][0]['fD']['aI']['isLcc'];
			   
			   $FLIGHT_NO=$flightInfoResultReturnValue['sI'][0]['fD']['fN'];
			   
			   $duration=$flightInfoResultReturnValue['sI'][0]['duration'];
			   

			// get Destination Information
			   $destinationLast=count($flightInfoResultReturnValue['sI'])-1;
			   $totalStop=$destinationLast;	
			 
			 $DEST_CODE=$flightInfoResultReturnValue['sI'][$destinationLast]['aa']['code'];
			 $DEST_NAME=$flightInfoResultReturnValue['sI'][$destinationLast]['aa']['city'];
			 $DEST_Terminal=$flightInfoResultReturnValue['sI'][$destinationLast]['aa']['terminal']." - ".$flightInfoResultReturnValue['sI'][$destinationLast]['aa']['name'];
			 $DEST_country=$flightInfoResultReturnValue['sI'][$destinationLast]['aa']['country'];
			 $DEST_city=$flightInfoResultReturnValue['sI'][$destinationLast]['aa']['city'];	
			 
			 $arrivalDate=$flightInfoResultReturnValue['sI'][$destinationLast]['at'];	
			 $arrivalDateArr=explode('T',$arrivalDate);
			 $arrivalTime=$arrivalDateArr[1];
			 
			 $FLIGHT_CODE=$flightInfoResultReturnValue['sI'][0]['fD']['aI']['code'];
			 
			 $FARE_TYPE='';
			 
			 			
			   $S_CODE= $ORG_CODE .'-'. $ORG_city;
			   $CN_CODE= $FLIGHT_CODE . ' ' . $FLIGHT_NO; 
			
			$totalNetFare=0;	
			$totalBaseFare=0;
			$totalTax=0;
			$totalFare=0; 
			 // add all fare
			 foreach($flightInfoResultReturnValue['totalPriceList'] as $totalPriceListValue)
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
				
					
				$totalNetFare=round($adultNetFare+$childNetFare+$infantNetFare);
				$totalBaseFare=round($adultBaseFare+$childBaseFare+$infantBaseFare);
				$totalTax=round($adultTaxFare+$childTaxFare+$infantTaxFare);
				$totalFare=round($adultTotalFare+$childTotalFare+$infantTotalFare);
					
					
					//$adultTalFare=$totalPriceListValue['fd']['ADULT']['fC']['TF'];


					$ResultIndex=$totalPriceListValue['id'];
					$seatRemaining=$totalPriceListValue['fd']['ADULT']['sR'];
					
				    $FareBasisCode=	$totalPriceListValue['fd']['ADULT']['fB'];	
					$isRefundable =	$totalPriceListValue['fd']['ADULT']['rT'];	// 1 for refuldatble and 0 for Non Refundable
					
					$CabinBaggage=$totalPriceListValue['fd']['ADULT']['bI']['cB'];
					$Baggage=$totalPriceListValue['fd']['ADULT']['bI']['iB'];
					
					$FLIGHT_INFO= 'Baggage:Cabin='.$CabinBaggage.',Checkin='.$Baggage;
			
			$PCC=$totalPriceListValue['fareIdentifier'];
					
			$flightType='D';		
			 
			$airline=$FLIGHT_NAME;

			$FareBasisCode=$PCC;

			$toalPax=$toalPaxFinal;

			$totalPaxFare=$totalBaseFare;

			$ResultFareType=$FARE_TYPE;

			$OfferedFare=$totalNetFare;

					

			 

			

			$getCalCost=calculateflightcost(encode($agentid),$airline,$flightType,$FareBasisCode,$toalPax,$totalPaxFare,$totalTax);

			$getCalCost2=calculateflightcostForAgent(encode($agentid),$airline,$flightType,$FareBasisCode,$toalPax,$totalPaxFare,$totalTax);

			$getAgentTaxonly=calculateflightcostForAgentMarkup(encode($agentid),$airline,$flightType,$FareBasisCode,$toalPax,$totalPaxFare,$totalTax);

			

			

			

			if($totalPaxFare==getAgentCommission($totalPaxFare,$airline,$ResultFareType)){ 

		 

		 $netamount = round($getCalCost[1]);

		 

		  }else{ 

		  

		  $netamount = round($getCalCost2[1]-(getAgentCommission($totalPaxFare,$airline,$ResultFareType)));

		  

		   } 

		   

		   

		   

			

			$flightinfodata = "";

			

			 $adfare='baseFare='.$totalPaxFare.',tax='.$totalTax.',totalFare='.($totalPaxFare+$totalTax);

			 $agfare='baseFare='.$getCalCost2[2].',tax='.$getCalCost2[0].',totalFare='.$getCalCost2[1];

			 $clfare='baseFare='.$getCalCost2[2].',tax='.$getCalCost2[0].',totalFare='.$getCalCost2[1];

			 $nefareamountnew=round($OfferedFare+$getCalCost['3']);

			 

			   $adminMarkup=($getCalCost2[1]-($totalPaxFare+$totalTax));

			  $totaldisplayTax=($getCalCost2[0]);

			 

			 

	 $getNetFare=calculateflightcostForAgentNetFare(encode($agentid),$airline,$flightType,$FareBasisCode,$toalPax,$OfferedFare,$totalTax); 

		   $netamount = $getNetFare[0];

	 

	 $commissiondeff=round(($totalPaxFare+$totalTax)-$OfferedFare);

		   

		   

			$duration=(strtotime($arrivalDate)-strtotime($departureDate))/60;

			if($isLcc)

			{

			$isLcc=1;		

			}

			else

			{

			$isLcc=0;

			}			

			

				if(getBlockFlights($agentId,$airline,$FareBasisCode)!=1){

				

				$namevalue ='UID="",TID="",ResultIndex="'.$ResultIndex.'",ORG_CODE="'.$fromdestexp[0].'",apiType="tripjack",ORG_NAME="'.$ORG_NAME.'",DES_CODE="'.$todestexp[0].'",DES_NAME="'.$DEST_NAME.'",DEP_DATE="'.$journeyDate.'",DEP_TIME="'.$departurTime.'",ARRV_DATE="'.$arrivalDate.'",ARRV_TIME="'.$arrivalTime.'",FLIGHT_CODE="'.trim($FLIGHT_CODE).'",FLIGHT_NAME="'.$FLIGHT_NAME.'",FLIGHT_NO="'.$FLIGHT_NO.'",FARE_TYPE="'.$FARE_TYPE.'",SEAT="'.$seatRemaining.'",STOP="'.$totalStop.'",AMT="'.$getCalCost2[1].'",DISPLAY_AMT="'.$PublishedFare.'",DUR="'.makeFlightTime($duration).'",S_CODE="'.$S_CODE.'",CN_CODE="'.$CN_CODE.'",OI="",PCC="'.$FareBasisCode.'",TAX_BREAKUP="0",FLIGHT_INFO="'.$FLIGHT_INFO.'",NET_FARE="'.$OfferedFare.'",refundyes="'.$isRefundable.'",AirlineRemark="",F_CLASS="'.$PC.'",SECTOR="'.$SECTOR.'",adfare="'.$adfare.'",agfare="'.$agfare.'",clfare="'.$clfare.'",CON_DETAILS="",searchJson="'.addslashes(serialize($searchJson)).'",agentId="'.$_SESSION['agentUserid'].'",searchJson="",tripType=2,acom="'.$commissiondeff.'",IsLCC="'.$IsLCC.'",netFareBeforecomm="'.($getCalCost2[1]-$commissiondeff).'",agentMarkup="'.$getAgentTaxonly[0].'",adminMarkup="'.$adminMarkup.'",totalTax="'.$totaldisplayTax.'",roundTripFlight=1';

				

				

				addlistinggetlastid('wig_flight_json_bkp',$namevalue); 

				

				}
	  
	  
	        }
		 

				
			
		
		
		}
	
	
	
	}	



}








/*echo "<pre>";
print_r($search_result);
die;*/




?>
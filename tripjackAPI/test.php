<?php
include 'APIConstants.php';
include 'RestApiCaller.php';

$postdata='{
  "searchQuery": {
    "cabinClass": "ECONOMY",
    "paxInfo": {
      "ADULT": "1",
      "CHILD": "0",
      "INFANT": "0"
    },
    "routeInfos": [
      {
        "fromCityOrAirport": {
          "code": "DEL"
        },
        "toCityOrAirport": {
          "code": "MAA"
        },
        "travelDate": "2022-12-19"
      }
    ],
    "searchModifiers": {
      "isDirectFlight": true,
      "isConnectingFlight": false
    }
  }
}';


try
{

//$req=file_put_contents("FLYTBOJSON/FlyShopSearchReq2.txt","$req");
//$postdata = file_get_contents("FLYTBOJSON/FlyShopSearchReq2.txt","$req"); //Take JSON input from Postman Client
//echo $postdata; //exit;
$Rurl='https://apitest.tripjack.com/fms/v1/air-search-all';
$restCaller = new RestApiCaller();
$flightRes = $restCaller->getTripJackResponse($Rurl, $postdata);

//$result=file_put_contents("FLYTBOJSON/".$agentId."_FlyShopTBOSearchRes2.txt","$flightRes");
$search_result = json_decode($flightRes,true);

//$traceId = $search_result->TraceId;
//$BaseFare = $search_result->Fare->BaseFare;
}
catch(Exception $e)
{
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Flights Result Are Not Found.";
   // include dirname(dirname(__FILE__)).'/error.php';
    exit;
}



echo "<pre>";
print_r($search_result);

die;


/*$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://apitest.tripjack.com/fms/v1/air-search-all',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "searchQuery": {
    "cabinClass": "ECONOMY",
    "paxInfo": {
      "ADULT": "1",
      "CHILD": "0",
      "INFANT": "0"
    },
    "routeInfos": [
      {
        "fromCityOrAirport": {
          "code": "DEL"
        },
        "toCityOrAirport": {
          "code": "MAA"
        },
        "travelDate": "2022-12-19"
      }
    ],
    "searchModifiers": {
      "isDirectFlight": true,
      "isConnectingFlight": false
    }
  }
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'apikey: 412064383aa387-3b04-4b58-9d8a-ce668d88889e'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;*/

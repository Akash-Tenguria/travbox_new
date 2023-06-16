<?php
/*include dirname(__FILE__).'/APIConstants.php';
include dirname(__FILE__).'/RestApiCaller.php';
header("Content-Type: application/json");*/
$auth=array();
$wsdl = APISEDL;

$auth["SiteName"]="";
$auth["AccountCode"]="";
$auth["UserName"]=APIUSERNAME;
$auth["Password"]=APIPASSWORD;
$Rurl= APISEARCH;

$cabinclass=$data['class'];
if($cabinclass == "Economy" || $cabinclass == "EC"){
   $FlightCabinClass= '2';
}else if($cabinclass == "PremiumEconomy" || $cabinclass == "1"){
    $FlightCabinClass= '3';
}else if($cabinclass == "Business" || $cabinclass == "BU"){
     $FlightCabinClass= '4';
}else if($cabinclass == "PremiumBusiness" || $cabinclass == "4"){
     $FlightCabinClass= '5';
}else if($cabinclass == "First"  || $cabinclass == "3"){
     $FlightCabinClass= '6';
}else if($cabinclass == "All"  || $cabinclass == "5"){
     $FlightCabinClass= '1';
}else{
     $FlightCabinClass= '1';
}


if($type == 'OneWay')
{
    
$FSS = $dbFunction->master->fetchSingle("wig_flight_search_setting", array("id"=> '1')); 
if($FSS['DirectFlight']){$dirflt=$FSS['DirectFlight'];}else{$dirflt='false';}
if($FSS['OneStopFlight']){$oneflt=$FSS['OneStopFlight'];}else{$oneflt='false';}
if($FSS['PreferredAirlines']){$prefer=$FSS['PreferredAirlines'];}else{$prefer='';}

 $opta = array( 
               "EndUserIp" => $ip,
               "TokenId" => $TokenId,
               "AdultCount" => $adult,
               "ChildCount" => $child,
               "InfantCount" => $infant,
               "DirectFlight" => $dirflt,
               "OneStopFlight" => $oneflt,
               "JourneyType" => "1",
               "PreferredAirlines" => $prefer,
               "Segments" => array (array (
                            "Origin" => $origin,
                           "Destination" => $destination,
                           "FlightCabinClass" => $FlightCabinClass,
                           "PreferredDepartureTime" => $departdate.'T00:00:00',
                           "PreferredArrivalTime" => $departdate.'T00:00:00'
            				)
				)
         );

} else{
    
    $opta = array( 
               "EndUserIp" => $ip,
               "TokenId" => $TokenId,
               "AdultCount" => $adult,
               "ChildCount" => $child,
               "InfantCount" => $infant,
               "JourneyType" => "2",
               "PreferredAirlines" => "",
               "Segments" => array (array (
                            "Origin" => $origin,
                           "Destination" => $destination,
                           "FlightCabinClass" => $FlightCabinClass,
                           "PreferredDepartureTime" => $departdate.'T00:00:00',
                           "PreferredArrivalTime" => $departdate.'T00:00:00',
            				),
            				array (
                           "Origin" => "$destination",
                           "Destination" => "$origin",
                           "FlightCabinClass" => $FlightCabinClass,
                           "PreferredDepartureTime" => $returndate.'T00:00:00',
                           "PreferredArrivalTime" => $returndate.'T00:00:00'
            				)
				)
         );
}

$search_result=array();
try
{
$req=str_replace('\/','/',json_encode($opta));
$req=file_put_contents("FLYTBOJSON/FlyShopSearchReq.txt","$req");
  
$postdata = file_get_contents("FLYTBOJSON/FlyShopSearchReq.txt","$req"); //Take JSON input from Postman Client
//echo $postdata; //exit;
$header = array('Content-Type: application/json', 'Accept-Encoding: gzip');
$restCaller = new RestApiCaller();
$flightRes = $restCaller->post($Rurl, $postdata, $header);

$result=file_put_contents("FLYTBOJSON/FlyShopSearchRes.txt","$flightRes");
$search_result = json_decode($flightRes,true);
$traceId = $search_result->TraceId;
$BaseFare = $search_result->Fare->BaseFare;
}
catch(Exception $e)
{
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Flights Result Are Not Found.";
    include dirname(dirname(__FILE__)).'/error.php';
    exit;
}

//echo '<pre>';print nl2br(print_r($search_result, true));echo '</pre>'; exit;
?>
<?php
//include dirname(__FILE__).'/APIConstants.php';
//include dirname(__FILE__).'/RestApiCaller.php';
//header("Content-Type: application/json");
$auth=array();
$Rurl = APITICKET;

$auth["SiteName"]="";
$auth["AccountCode"]="";
$auth["UserName"]=APIUSERNAME;
$auth["Password"]=APIPASSWORD;


$opta =  $arrayToRequest2;       

 
$ticket_result_LCC =array();
try
{
$req=str_replace('\/','/',json_encode($opta));
$req=file_put_contents("FLYTBOJSON/FlyShopTicketLCCReq3_return.txt","$req");

$postdata = file_get_contents("FLYTBOJSON/FlyShopTicketLCCReq3_return.txt","$req"); //Take JSON input from Postman Client
//echo '<pre>';print nl2br(print_r($postdata, true));echo '</pre>'; exit;
$header = array('Content-Type: application/json', 'Accept-Encoding: gzip');
$restCaller = new RestApiCaller();
$flightRes = $restCaller->post($Rurl, $postdata, $header);

$results=file_put_contents("FLYTBOJSON/FlyShopTicketLCCRes3_return.txt","$flightRes");
//$ticket_result_LCC = json_decode($flightRes,true);
$ticket_result_LCC_return = json_decode($flightRes,true);
}
catch(Exception $e)
{
   //echo $e;
   //echo 'Sorry! due to some technical issues, flights results not found';	
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Booking Not done.";
    include dirname(dirname(__FILE__)).'/error.php';
    exit;
}
//print_r($search_result);
//echo '<pre>';print nl2br(print_r($book_result, true));echo '</pre>';  exit;
?>
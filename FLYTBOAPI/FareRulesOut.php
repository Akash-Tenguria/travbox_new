<?php
//include dirname(__FILE__).'/APIConstants.php';
//include dirname(__FILE__).'/RestApiCaller.php';
//header("Content-Type: application/json");
$auth=array();

$auth["SiteName"]="";
$auth["AccountCode"]="";
$auth["UserName"]=APIUSERNAME;
$auth["Password"]=APIPASSWORD;
$Rurl= APIFARERULE;

 $opta = array( 
               "EndUserIp" => $ip,
               "TokenId" => $TokenId,
               "TraceId" => $TraceId,
               "ResultIndex" => $ResultIndex,
            );
 
$fare_rule_result=array();
try
{
$req=str_replace('\/','/',json_encode($opta));
$req=file_put_contents("FLYTBOJSON/FareRuleOBReq.txt","$req");
  
$postdata = file_get_contents("FLYTBOJSON/FareRuleOBReq.txt","$req"); //Take JSON input from Postman Client
//echo $postdata;
$header = array('Content-Type: application/json', 'Accept-Encoding: gzip');
$restCaller = new RestApiCaller();
$flightRes = $restCaller->post($Rurl, $postdata, $header);

$results=file_put_contents("FLYTBOJSON/FareRuleOBRes.txt","$flightRes");
$fare_rule_result = json_decode($flightRes,true);
}
catch(Exception $e)
{
  
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Flights Result Are Not Found.";
    include dirname(dirname(__FILE__)).'/error.php';
    exit;
}
// echo '<pre>';print nl2br(print_r($fare_rule_result, true));echo '</pre>'; exit;
?>
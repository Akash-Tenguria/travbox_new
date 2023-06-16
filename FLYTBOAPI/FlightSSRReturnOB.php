<?php
//include dirname(__FILE__).'/APIConstants.php';
//include dirname(__FILE__).'/RestApiCaller.php';
//header("Content-Type: application/json");
$auth=array();
$Rurl = APISSR;

$auth["SiteName"]="";
$auth["AccountCode"]="";
$auth["UserName"]=APIUSERNAME;
$auth["Password"]=APIPASSWORD;

 $opta = array( 
               
               "EndUserIp" => $ip,
               "TokenId" => $TokenId,
               "TraceId" => $TraceId,
               "ResultIndex" => $segKey,
                );
 
$ssr_result=array();
try
{
$req=str_replace('\/','/',json_encode($opta));
$req=file_put_contents("FLYTBOJSON/FlyShopSsrOBReq.txt","$req");
  
$postdata = file_get_contents("FLYTBOJSON/FlyShopSsrOBReq.txt","$req"); //Take JSON input from Postman Client
//echo $postdata;
$header = array('Content-Type: application/json', 'Accept-Encoding: gzip');
$restCaller = new RestApiCaller();
$flightRes = $restCaller->post($Rurl, $postdata, $header);

$results=file_put_contents("FLYTBOJSON/FlyShopSsrOBRes.txt","$flightRes");
$ssr_result = json_decode($flightRes,true);
}
catch(Exception $e)
{
   //echo $e;
   //echo 'Sorry! due to some technical issues, flights results not found';	
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Flights Result Are Not Found.";
    include dirname(dirname(__FILE__)).'/error.php';
    exit;
}
//print_r($search_result);
//echo '<pre>';print nl2br(print_r($ssr_result, true));echo '</pre>'; exit;
?>
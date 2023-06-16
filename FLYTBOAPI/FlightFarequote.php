<?php
//include dirname(__FILE__).'/APIConstants.php';
//include dirname(__FILE__).'/RestApiCaller.php';
//header("Content-Type: application/json");

$auth=array();
$Rurl = APIFAREQUOTE;

$auth["SiteName"]="";
$auth["AccountCode"]="";
$auth["UserName"]=APIUSERNAME;
$auth["Password"]=APIPASSWORD;

 $opta = array( 
               
               "EndUserIp" => $_SESSION['EndUserIp'],
               "TokenId" => $_SESSION['tbotokenId'],
               "TraceId" => $_SESSION['TraceId'],
               "ResultIndex" => $ResultIndex,
                );
 

$fare_quote_result=array();


try
{
$postdata=str_replace('\/','/',json_encode($opta));
$req=file_put_contents("FLYTBOJSON/AirgennieFarequoteReq.txt","$postdata");
  
//$postdata = file_get_contents("FLYTBOJSON/AirgennieFarequoteReq.txt","$req"); //Take JSON input from Postman Client
//echo $postdata;
$header = array('Content-Type: application/json', 'Accept-Encoding: gzip');
$restCaller = new RestApiCaller();
$flightRes = $restCaller->post($Rurl, $postdata, $header);

/*echo $Rurl;
echo "<br>";
print_r($opta);
echo "<br>";
print_r($flightRes);
die;*/

$results=file_put_contents("FLYTBOJSON/AirgennieFarequoteRes.txt", $flightRes);
$fare_quote_result = json_decode($flightRes,true);
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
//echo "<pre>";
//print_r($fare_quote_result);
//echo '<pre>';print nl2br(print_r($fare_quote_result, true));echo '</pre>'; exit;

?>
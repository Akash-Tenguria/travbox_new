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

 $opta2 = array( 
               
               "EndUserIp" => $_SESSION['EndUserIp'],
               "TokenId" => $_SESSION['tbotokenId'],
               "TraceId" => $_SESSION['TraceId'],
               "ResultIndex" => $ResultIndex2,
                );
 

$fare_quote_result2=array();


try
{
$postdata2=str_replace('\/','/',json_encode($opta2));
$req2=file_put_contents("FLYTBOJSON/AirgennieFarequoteReq2.txt","$postdata2");
  
//$postdata2 = file_get_contents("FLYTBOJSON/AirgennieFarequoteReq2.txt","$req2"); //Take JSON input from Postman Client
//echo $postdata2;
$header2 = array('Content-Type: application/json', 'Accept-Encoding: gzip');
$restCaller2 = new RestApiCaller();
$flightRes2 = $restCaller2->post($Rurl, $postdata2, $header2);

/*echo $Rurl;
echo "<br>";
print_r($opta);
echo "<br>";
print_r($flightRes2);
die;*/

//$results=file_put_contents("FLYTBOJSON/AirgennieFarequoteRes.txt", $flightRes2);
$fare_quote_result2 = json_decode($flightRes2,true);

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
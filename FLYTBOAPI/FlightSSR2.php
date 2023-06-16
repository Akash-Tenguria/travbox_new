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

 $opta2 = array( 
               
               "EndUserIp" => $_SESSION['EndUserIp'],
               "TokenId" => $_SESSION['tbotokenId'],
               "TraceId" =>$_SESSION['TraceId'],
               "ResultIndex" =>$ResultIndex2,
                );
 
$ssr_result2=array();
try
{
$postdata2=str_replace('\/','/',json_encode($opta2));
$req2=file_put_contents("FLYTBOJSON/AirgennieSsrReq2.txt","$req2");
  
//$postdata2 = file_get_contents("FLYTBOJSON/AirgennieSsrReq.txt","$postdata2"); //Take JSON input from Postman Client
//echo $postdata2;
$header2 = array('Content-Type: application/json', 'Accept-Encoding: gzip');
$restCaller2 = new RestApiCaller();
$flightRes2 = $restCaller2->post($Rurl, $postdata2, $header2);

$results2=file_put_contents("FLYTBOJSON/AirgennieSsrRes2.txt","$flightRes2");
$ssr_result2 = json_decode($flightRes2,true);
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
//echo '<pre>';print nl2br(print_r($ssr_result2, true));echo '</pre>'; exit;
?>
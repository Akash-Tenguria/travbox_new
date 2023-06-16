<?php
session_start();
//include dirname(__FILE__).'/APIConstants.php';
//include dirname(__FILE__).'/RestApiCaller.php';
//header("Content-Type: application/json");
$auth=array();
$Rurl = APIBOOK;

$auth["SiteName"]="";
$auth["AccountCode"]="";
$auth["UserName"]=APIUSERNAME;
$auth["Password"]=APIPASSWORD;
                                 
$opta =  $arrayToRequest;


$book_result=array();
try
{
$req=str_replace('\/','/',json_encode($opta));
$req=file_put_contents("FLYTBOJSON/FlyShopBookReq3.txt","$req");
  
$postdata = file_get_contents("FLYTBOJSON/FlyShopBookReq3.txt","$req"); //Take JSON input from Postman Client
	//echo '<pre>';print nl2br(print_r($postdata, true));echo '</pre>'; exit;


$header = array('Content-Type: application/json', 'Accept-Encoding: gzip');
$restCaller = new RestApiCaller();
$flightRes = $restCaller->post($Rurl, $postdata, $header);


$results=file_put_contents("FLYTBOJSON/FlyShopBookRes3.txt","$flightRes");
$book_result = json_decode($flightRes,true);


}
catch(Exception $e)
{
   //echo $e;
   //echo 'Sorry! due to some technical issues, flights results not found';	
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Booking Not Done.";
    include dirname(dirname(__FILE__)).'/error.php';
    exit;
}
//echo '<pre>';print nl2br(print_r($book_result, true));echo '</pre>'; exit;
?>
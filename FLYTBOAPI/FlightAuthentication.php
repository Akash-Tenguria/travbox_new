<?php 
/*include 'APIConstants.php';
include 'RestApiCaller.php';
header("Content-Type: application/json");*/
 function getRealUserIp(){
    switch(true){
      case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
      case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
      case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];
      default : return $_SERVER['REMOTE_ADDR'];
    }
 }
$ip = getRealUserIp();
$Rurl= APIAUTHENTICATE;
$hrequest = array(
  'ClientId' => ClientId,
  'UserName' => APIUSERNAME,
  'Password' => APIPASSWORD,
  'EndUserIp' => $ip);
  $req=str_replace('\/','/',json_encode($hrequest));
  //print_r($hrequest);
  $req=file_put_contents("FLYTBOJSON/FlyShopAuthReq.txt","$req");
$postdata = file_get_contents("FLYTBOJSON/FlyShopAuthReq.txt","$req"); //Take JSON input from Postman Client
//echo $postdata;
$header = array('Content-Type: application/json', 'Accept-Encoding: gzip');
$restCaller = new RestApiCaller();
$flightRes = $restCaller->post($Rurl, $postdata, $header);
$result=file_put_contents("FLYTBOJSON/FlyShopAuthRes.txt","$flightRes");
$json = json_decode($flightRes, true);
$json['TokenId'];
 
?>
<?php

$body1 = '{
  "ClientId": "ApiIntegrationNew",
  "UserName": "AirGennie",
  "Password": "AirGennie@1234",
  "EndUserIp": "119.18.54.40" 
}';

$ch = curl_init();
$url = 'http://api.tektravels.com/SharedServices/SharedData.svc/rest/Authenticate';

$headers = array(
'Content-Type: application/json',
'Content-Length: '.strlen($body1),    
'Accept: application/json',
'UserName: AirGennie',
'APIPassword:AirGennie@1234'
);




curl_setopt($ch , CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$information = curl_getinfo($ch);
//print_r($information);
$result = curl_exec($ch);
//print_r($result);

$json_arr = json_decode($result,true);
$tokenId = $json_arr['TokenId'];
$_SESSION['hotelTokenId']=$tokenId;
?>  
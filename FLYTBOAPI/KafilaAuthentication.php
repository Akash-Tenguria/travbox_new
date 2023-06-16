<?php 
/*include 'APIConstants.php';
include 'RestApiCaller.php';
header("Content-Type: application/json");*/

$Rurl= APIKFAUTHENTICATE;
$mode= LIV;
if($mode=='YES'){$mod='P';}else{$mod='D';}
$hrequest = array(
    
               "NAME" => "GET_AUTH_TOKEN",
               "TYPE" => "AUTH",
               "STR" => array (array (
                           "MODULE" => 'B2B',
                           "A_ID" => A_ID,
                           "PWD" => PWD,
                           "U_ID" => U_ID,
                           "HS" => $mod
            				)
				)
    
);
    $postdata=str_replace('\/','/',json_encode($hrequest));

   // $req=file_put_contents("FLYTBOJSON/FlyShopKafilaAuthReq.txt","$req");
    //$postdata = file_get_contents("FLYTBOJSON/FlyShopKafilaAuthReq.txt","$req"); //Take JSON input from Postman Client
    
    $header = array('Content-Type: application/json', 'Accept-Encoding: gzip');
    $restCaller = new RestApiCaller();
	
	print_r($postdata);
	echo "<br>******************<br>";
	
    $AuthRes = $restCaller->post($Rurl, $postdata, $header);
	
	
		print_r($AuthRes);
	echo "<br>******************<br>";
	
    //$result=file_put_contents("FLYTBOJSON/FlyShopKafilaAuthRes.txt","$AuthRes");
    $jsonKF = json_decode($AuthRes, true); //print_r($jsonKF); exit;	
   $kafilaTokenId= $jsonKF['RESULT'];
?>
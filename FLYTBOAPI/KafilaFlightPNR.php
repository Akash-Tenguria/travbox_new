<?php
include dirname(__FILE__).'/APIConstants.php';
include dirname(__FILE__).'/RestApiCaller.php';
//header("Content-Type: application/json");
$auth=array();


$Rurl= APIKFPNRRETRIVE;
$mode= LIV;
if($mode=='YES'){$mod='P';}else{$mod='D';}

 $opta = array( 
                "TYPE"=> "DC",
                "NAME"=> "PNR_RETRIVE",
                "STR" => array ( array (
                        "BOOKINGID" => $data['booking_id'],
                        "CLIENT_SESSIONID"=> '',
                    	"MODULE"=> "B2B",
                    	"HS"=> $mod
			
				  		
				)
			),
         );

$ticket_result=array();
try
{
$req=str_replace('\/','/',json_encode($opta));
$req=file_put_contents("FLYTBOJSON/FlyShopPNRReq.txt","$req");
  
$postdata = file_get_contents("FLYTBOJSON/FlyShopPNRReq.txt","$req"); //Take JSON input from Postman Client

$header = array('Content-Type: application/json', 'Accept-Encoding: gzip');
$restCaller = new RestApiCaller();
$flightRes = $restCaller->post($Rurl, $postdata, $header);

$results=file_put_contents("FLYTBOJSON/FlyShopPNRRes.txt","$flightRes");
$ticket_result = json_decode($flightRes,true);
}
catch(Exception $e)
{
  
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Booking Not Done.";
    include dirname(dirname(__FILE__)).'/error.php';
    exit;
}

//echo '<pre>';print nl2br(print_r($ticket_result, true));echo '</pre>'; exit;
?>
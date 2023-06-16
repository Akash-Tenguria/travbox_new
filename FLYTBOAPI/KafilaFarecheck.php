<?php
include dirname(__FILE__).'/APIConstants.php';
include dirname(__FILE__).'/RestApiCaller.php';
//header("Content-Type: application/json");
$auth=array();
$Rurl = APIKFFAREQUOTE;

$auth["UserName"]=APIUSERNAME;
$auth["Password"]=APIPASSWORD;

############# GST ###############
 $GSTCompanyAddress = "LOWER GROUND FLOOR, H.NO.10/2, KHASRA NO.619/6 AND 619/3 VILLAGE, CHHATTARPUR NEAR, NEW DELHI, South West Delhi, Delhi, 110074";
 $GSTCompanyContactNumber = "7011229958";
 $GSTCompanyName = "FLYSHOP.IN";
 $GSTNumber = "07DVFPK1987K3ZZ";
 $GSTCompanyEmail = "flyshop.india@gmail.com";
############# GST ###############
               
        $opta = array( 
                "NAME"=> "FARE_CHECK",
                
                "STR" => array ( array (
                        "FLIGHT" => array (
                        "UID"=> $UID,
                    	"ID"=> $ID,
                    	"TID"=> $TID,
				),
				"PARAM" => array (
                            "src"=> $PARAM['src'],
                    		"des"=> $PARAM['des'],
                    		"dep_date"=> $PARAM['dep_date'],
                    		"ret_date"=> $PARAM['ret_date'],
                    		"adt"=> $PARAM['adt'],
                    		"chd"=> $PARAM['chd'],
                    		"inf"=> $PARAM['inf'],
                    		"L_OW"=> $PARAM['L_OW'],
                    		"H_OW"=> $PARAM['H_OW'],
                    		"T_TIME"=> $PARAM['T_TIME'],
                    		"Trip_String"=> $PARAM['Trip_String'],
                    		
				),
				"GSTINFO" => array (
                            "Address"=> $GSTCompanyAddress,
                    		"Company"=> $GSTCompanyName,
                    		"Email"=> $GSTCompanyEmail,
                    		"Mobile"=> $GSTCompanyContactNumber,
                    		"Number"=> $GSTNumber,
                    		"Pin"=> "733134",
                    		"State"=> "West Bengal",
                    		"Type"=> "",
                    		"hasGST"=> "false",
                    		
                    )   		
				)
			),
			"TYPE"=> "AIR",
         );
 
$fare_quote_result=array();
try
{
$req=str_replace('\/','/',json_encode($opta));
$req=file_put_contents("FLYTBOJSON/FlyShopFareQuoteReq.txt","$req");
  
$postdata = file_get_contents("FLYTBOJSON/FlyShopFareQuoteReq.txt","$req"); //Take JSON input from Postman Client
//echo '<pre>';print nl2br(print_r($postdata, true));echo '</pre>'; 
$header = array('Content-Type: application/json', 'Accept-Encoding: gzip');
$restCaller = new RestApiCaller();
$flightRes = $restCaller->post($Rurl, $postdata, $header);

$results=file_put_contents("FLYTBOJSON/FlyShopFareQuoteRes.txt","$flightRes");
$fare_quote_result = json_decode($flightRes,true);
}
catch(Exception $e)
{
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Flight Fare Quotes Not Found.";
    include dirname(dirname(__FILE__)).'/error.php';
    exit;
}

//echo '<pre>';print nl2br(print_r($fare_quote_result, true));echo '</pre>'; exit;
?>
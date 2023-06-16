<?php
/*include dirname(__FILE__).'/APIConstants.php';
include dirname(__FILE__).'/RestApiCaller.php';
header("Content-Type: application/json");*/
$auth=array();

$Rurl= APIKFSEARCH;
$mode= LIV;
if($mode=='YES'){$mod='P';}else{$mod='D';}

/*if($data['flight_type'] == 'DOM'){
   $sector='D'; 
}else{
    $sector='I'; 
}
*/
// FIXED DEFINED
$type='OneWay';
$TokenIdKF=$_SESSION['kafilaTokenId'];
$sector='D';
$origin='DEL';
$destination='BOM';
$departdate="2022-08-10";
$adult=1;
$child=0;
$infant=0;
$mod="P";


if($type == 'OneWay')
{
 $opta = array( 
     
                "TYPE" => "AIR",
                "NAME"=> "GET_FLIGHT",
                "STR" => array (array (
                            "AUTH_TOKEN"=> $TokenIdKF,
                    		"SESSION_ID"=> "",
                    		"TRIP"=> "1",
                    		"SECTOR"=> $sector,
                    		"SRC"=> $origin,
                    		"DES"=> $destination,
                    		"DEP_DATE"=> $departdate,
                    		"RET_DATE"=> "",
                    		"ADT"=> $adult,
                    		"CHD"=> $child,
                    		"INF"=> $infant,
                    		"PC"=> "",
                    		"PF"=> "",
                    		"HS"=> $mod
            				)
				)
         );

}

$search_result=array();
try
{
$postdata=str_replace('\/','/',json_encode($opta));


//$req=file_put_contents("FLYTBOJSON/FlyShopKafilaSearchReq.txt","$req");
  
//$postdata = file_get_contents("FLYTBOJSON/FlyShopKafilaSearchReq.txt","$req"); //Take JSON input from Postman Client

$header = array('Content-Type: application/json', 'Accept-Encoding: gzip');
$restCaller = new RestApiCaller();
$KafilaflightRes = $restCaller->post($Rurl, $postdata, $header);

$result=file_put_contents("FLYTBOJSON/FlyShopKafilaSearchRes.txt","$KafilaflightRes");
$search_result_kafila = json_decode($KafilaflightRes,true); 

//echo "<pre>";
//print_r($search_result_kafila);


}
catch(Exception $e)
{
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Flights Result Are Not Found.";
   // include dirname(dirname(__FILE__)).'/error.php';
    exit;
}

//echo '<pre>';print nl2br(print_r($search_result_kafila, true));echo '</pre>'; exit;
?>
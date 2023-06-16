<?php
include dirname(__FILE__).'/APIConstants.php';
include dirname(__FILE__).'/RestApiCaller.php';
header("Content-Type: application/json");
$auth=array();
$wsdl = APISEDL;

$auth["SiteName"]="";
$auth["AccountCode"]="";
$auth["UserName"]=APIUSERNAME;
$auth["Password"]=APIPASSWORD;
$Rurl= APIKFPNRCREATE;

$psngr_email= $fbdet['email'];      
$psngr_mbl= $fbdet['mobile'];  

$pass= $dbFunction->partner->fetch("wig_flight_passenger", array("order_id" => $mrn, "pass_type" => 'Adult')); 

$passs= $dbFunction->partner->fetch("wig_flight_passenger", array("order_id" => $mrn, "pass_type" => 'Child'));
$pass_infant= $dbFunction->partner->fetch("wig_flight_passenger", array("order_id" => $mrn, "pass_type" => 'Infant'));

$adult = $data['adult'];
$child = $data['child'];
$infant = $data['infant'];

$hotelgst=array();
$lpsn=1;$i=0;
 while($adult > 0 ) {
     
		 $ht_psng['year']= "";
		 $ht_psng['ttl']= $pass[$i]['title'];
		 $ht_psng['fn'] = $pass[$i]['fname'];
		 $ht_psng['ln'] = $pass[$i]['lname'];
		 $ht_psng['type'] = 'adult';
		 $ht_psng['mn'] = "";
    	 $ht_psng['dob'] = "";
		 
		 $ht_psng['meal'] = "";
		 $ht_psng['baggage'] = "";
		 $ht_psng['refundable'] = "";
		 $ht_psng['status'] = "";
		 $ht_psng['apnr'] = "";
		 $ht_psng['gpnr'] = "";
         $ht_psng['tktno'] = "";
         $ht_psng['fare'] = "";
         $ht_psng['ffn'] = "";
		 $ht_psng['tc'] = "";
		 $ht_psng['nat'] = "IN";
		 $ht_psng['pi'] = "IN";
		 $ht_psng['other_info'] = "";
	    	  
    		  $hotelgst[]=$ht_psng;
    		  $adult--;$i++;
 
 }
 
$lpsn11=1;$j=0;
 while($child > 0 ) { 
     
         $ht_psng2['year']= "";
		 $ht_psng2['ttl']= $passs[$j]['title'];
		 $ht_psng2['fn'] = $passs[$j]['fname'];
		 $ht_psng2['ln'] = $passs[$j]['lname'];
		 $ht_psng2['type'] = 'child';
		 $ht_psng2['mn'] = "";
    	 $ht_psng2['dob'] = "";
		 
		 $ht_psng2['meal'] = "";
		 $ht_psng2['baggage'] = "";
		 $ht_psng2['refundable'] = "";
		 $ht_psng2['status'] = "";
		 $ht_psng2['apnr'] = "";
		 $ht_psng2['gpnr'] = "";
         $ht_psng2['tktno'] = "";
         $ht_psng2['fare'] = "";
         $ht_psng2['ffn'] = "";
		 $ht_psng2['tc'] = "";
		 $ht_psng2['nat'] = "IN";
		 $ht_psng2['pi'] = "IN";
		 $ht_psng2['other_info'] = "";
		      
    		  $hotelgst[]=$ht_psng2;
    		 
		  $child --;$j++;
 }

$lpsn111=1;$k=0;
 while($infant > 0 ) { 		
            
         $ht_psng3['year']= "";
		 $ht_psng3['ttl']= $pass_infant[$k]['title'];
		 $ht_psng3['fn'] = $pass_infant[$k]['fname'];
		 $ht_psng3['ln'] = $pass_infant[$k]['lname'];
		 $ht_psng3['type'] = 'infant';
		 $ht_psng3['mn'] = "";
		 $DateOfBirth = date("Y-m-d", strtotime($pass_infant[$k]['dob']));
    	 $ht_psng3['dob'] = $DateOfBirth;
		 
		 $ht_psng3['meal'] = "";
		 $ht_psng3['baggage'] = "";
		 $ht_psng3['refundable'] = "";
		 $ht_psng3['status'] = "";
		 $ht_psng3['apnr'] = "";
		 $ht_psng3['gpnr'] = "";
         $ht_psng3['tktno'] = "";
         $ht_psng3['fare'] = "";
         $ht_psng3['ffn'] = "";
		 $ht_psng3['tc'] = "";
		 $ht_psng3['nat'] = "IN";
		 $ht_psng3['pi'] = "IN";
		 $ht_psng3['other_info'] = "";
		    
    	 $hotelgst[]=$ht_psng3;
		 $infant --;$k++;
 } 

//print_r($hotelgst); exit;

 $opta = array( 
                "STATUS" => array (array (
                    "status"=> "T"
                	)
				),
				"FLIGHT" => array (array (
				    "ID"=> $selectedflight['FLIGHT'][0]['ID'],
            		"TRIPID"=> $selectedflight['FLIGHT'][0]['TRIPID'],
            		"REFID"=> $selectedflight['FLIGHT'][0]['REFID'],
            		"ORG_CODE"=> $selectedflight['FLIGHT'][0]['ORG_CODE'],
                    "ORG_NAME"=> $selectedflight['FLIGHT'][0]['ORG_NAME'],
                    "DES_CODE"=> $selectedflight['FLIGHT'][0]['DES_CODE'],
                    "DES_NAME"=> $selectedflight['FLIGHT'][0]['DES_NAME'],
                    "DEP_DATE"=> $selectedflight['FLIGHT'][0]['DEP_DATE'],
                    "DEP_TIME"=> $selectedflight['FLIGHT'][0]['DEP_TIME'],
                    "ARRV_DATE"=> $selectedflight['FLIGHT'][0]['ARRV_DATE'],
                    "ARRV_TIME"=> $selectedflight['FLIGHT'][0]['ARRV_TIME'],
                    "ORG_TRML"=> $selectedflight['FLIGHT'][0]['ORG_TRML'],
                    "DES_TRML"=> $selectedflight['FLIGHT'][0]['DES_TRML'],
                    "FLIGHT_CODE"=> $selectedflight['FLIGHT'][0]['FLIGHT_CODE'],
                    "FLIGHT_NAME"=> $selectedflight['FLIGHT'][0]['FLIGHT_NAME'],
                    "FLIGHT_NO"=> $selectedflight['FLIGHT'][0]['FLIGHT_NO'],
                    "FLIGHT_LOGO"=> $selectedflight['FLIGHT'][0]['FLIGHT_LOGO'],
                    "FARE_BASIS"=> $selectedflight['FLIGHT'][0]['FARE_BASIS'],
                    "FARE_CLASS"=> $selectedflight['FLIGHT'][0]['FARE_CLASS'],
                    "FARE_TYPE"=> $selectedflight['FLIGHT'][0]['FARE_TYPE'],
                    "SEAT"=> $selectedflight['FLIGHT'][0]['SEAT'],
                    "STOP"=> $selectedflight['FLIGHT'][0]['STOP'],
                    "AMOUNT"=> $selectedflight['FLIGHT'][0]['AMOUNT'],
                    "SERVICE"=> $selectedflight['FLIGHT'][0]['SERVICE'],
                    "DURATION"=> $selectedflight['FLIGHT'][0]['DURATION'],
                    "OPERATION_INFO"=> $selectedflight['FLIGHT'][0]['OPERATION_INFO'],
                    "LAYOVER_INFO"=> $selectedflight['FLIGHT'][0]['LAYOVER_INFO'],
                    "OTHER_INFO"=> $selectedflight['FLIGHT'][0]['OTHER_INFO'],
                    "PCC"=> $selectedflight['FLIGHT'][0]['PCC'],
                    "APPKEY"=> $selectedflight['FLIGHT'][0]['APPKEY'],
                    "MARKUP"=> $selectedflight['FLIGHT'][0]['MARKUP'],
                    "NET_FARE"=> $selectedflight['FLIGHT'][0]['NET_FARE']
                	)
				),
				"CON_FLIGHT" => array (
				),

                "FARE" => array (array (
                    		"ID"=> $selectedflight['FARE'][0]['ID'],
                            "TRIPID"=> $selectedflight['FARE'][0]['TRIPID'],
                            "REFID"=> $selectedflight['FARE'][0]['REFID'],
                            "BASIC_ADT"=> $selectedflight['FARE'][0]['BASIC_ADT'],
                            "BASIC_CHD"=> $selectedflight['FARE'][0]['BASIC_CHD'],
                            "BASIC_INF"=> $selectedflight['FARE'][0]['BASIC_INF'],
                            "YQ_ADT"=> $selectedflight['FARE'][0]['YQ_ADT'],
                            "YQ_CHD"=> $selectedflight['FARE'][0]['YQ_CHD'],
                            "YQ_INF"=> $selectedflight['FARE'][0]['YQ_INF'],
                            "TAX_ADT"=> $selectedflight['FARE'][0]['TAX_ADT'],
                            "TAX_CHD"=> $selectedflight['FARE'][0]['TAX_CHD'],
                            "TAX_INF"=> $selectedflight['FARE'][0]['TAX_INF'],
                            "TOTAL_ADT"=> $selectedflight['FARE'][0]['TOTAL_ADT'],
                            "TOTAL_CHD"=> $selectedflight['FARE'][0]['TOTAL_CHD'],
                            "TOTAL_INF"=> $selectedflight['FARE'][0]['TOTAL_INF'],
                            "GRAND_TOTAL"=> $selectedflight['FARE'][0]['GRAND_TOTAL'],
                            "REFUNDABLE"=> $selectedflight['FARE'][0]['REFUNDABLE'],
                            "FARE_TYPE"=> $selectedflight['FARE'][0]['FARE_TYPE'],
                            "SEAT"=> $selectedflight['FARE'][0]['SEAT'],
                            "FARE_CLASS"=> $selectedflight['FARE'][0]['FARE_CLASS'],
                            "FARE_BASIS_ADT"=> $selectedflight['FARE'][0]['FARE_BASIS_ADT'],
                            "FARE_BASIS_CHD"=> $selectedflight['FARE'][0]['FARE_BASIS_CHD'],
                            "FARE_BASIS_INF"=> $selectedflight['FARE'][0]['FARE_BASIS_INF'],
                            "SERVICE"=> $selectedflight['FARE'][0]['SERVICE'],
                            "OTHER_INFO"=> $selectedflight['FARE'][0]['OTHER_INFO'],
                            "PCC"=> $selectedflight['FARE'][0]['PCC'],
                            "APPKEY"=> $selectedflight['FARE'][0]['APPKEY'],
                            "MARKUP"=> $selectedflight['FARE'][0]['MARKUP']
            				)
				),
				"PARAM" => array (array (
                            "src"=> $selectedflight['PARAM'][0]['src'],
                            "des"=> $selectedflight['PARAM'][0]['des'],
                            "dep_date"=> $selectedflight['PARAM'][0]['dep_date'],
                            "ret_date"=> $selectedflight['PARAM'][0]['ret_date'],
                            "adt"=> $selectedflight['PARAM'][0]['adt'],
                            "chd"=> $selectedflight['PARAM'][0]['chd'],
                            "inf"=> $selectedflight['PARAM'][0]['inf'],
                            "L_OW"=> $selectedflight['PARAM'][0]['L_OW'],
                            "H_OW"=> $selectedflight['PARAM'][0]['H_OW'],
                            "T_TIME"=> $selectedflight['PARAM'][0]['T_TIME'],
                            "Trip_String"=> $selectedflight['PARAM'][0]['Trip_String']
            				)
				),
				"Deal" => array (array (
                            "DISCOUNT"=> $selectedflight['Deal'][0]['DISCOUNT'],
                            "CB"=> $selectedflight['Deal'][0]['CB'],
                            "SERVICE_FEE"=> $selectedflight['Deal'][0]['SERVICE_FEE'],
                            "PROMO"=> $selectedflight['Deal'][0]['PROMO']
            				)
				),
				"FARE_RULE" => array (array (
                            "ID"=>  $selectedflight['FARE_RULE'][0]['ID'],
                            "FCODE"=> $selectedflight['FARE_RULE'][0]['FCODE'],
                            "F_ALIAS"=> $selectedflight['FARE_RULE'][0]['F_ALIAS'],
                            "SECTOR"=> $selectedflight['FARE_RULE'][0]['SECTOR'],
                            "LOGIC_TYPE"=> $selectedflight['FARE_RULE'][0]['LOGIC_TYPE'],
                            "LOGIC"=> $selectedflight['FARE_RULE'][0]['LOGIC'],
                            "FARE_RULE"=> $selectedflight['FARE_RULE'][0]['FARE_RULE'],
                            "CHECKIN_BAG"=> $selectedflight['FARE_RULE'][0]['CHECKIN_BAG'],
                            "CABIN_BAG"=> $selectedflight['FARE_RULE'][0]['CABIN_BAG'],
                            "CANCEL_FEE"=> $selectedflight['FARE_RULE'][0]['CANCEL_FEE'],
                            "DATE_CHANGE_FEE"=> $selectedflight['FARE_RULE'][0]['DATE_CHANGE_FEE'],
                            "ACTIVE"=> $selectedflight['FARE_RULE'][0]['ACTIVE'],
                            "ETIME"=> $selectedflight['FARE_RULE'][0]['ETIME'],
                            "FEE"=> $selectedflight['FARE_RULE'][0]['FEE'],
                            "TAG"=> $selectedflight['FARE_RULE'][0]['TAG']
            				)
				),
				"PAX" => $hotelgst
				,
				"TYPE"=> "DC",
		        "NAME"=> "PNR_CREATION",
				"Others" => array (array (
                            "REMARK"=> A_ID,
                            "CUSTOMER_EMAIL"=> $psngr_email,
                            "CUSTOMER_MOBILE"=> $psngr_mbl
            				)
				)
         );

$book_result=array();
try
{
$req=str_replace('\/','/',json_encode($opta));
$req=file_put_contents("FLYTBOJSON/FlyShopBookReq.txt","$req");

$postdata = file_get_contents("FLYTBOJSON/FlyShopBookReq.txt","$req"); //Take JSON input from Postman Client

$header = array('Content-Type: application/json', 'Accept-Encoding: gzip');
$restCaller = new RestApiCaller();
$flightRes = $restCaller->post($Rurl, $postdata, $header);

$results=file_put_contents("FLYTBOJSON/FlyShopBookRes.txt","$flightRes");
$book_result = json_decode($flightRes,true);
}
catch(Exception $e)
{
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Booking Not Done.";
    include dirname(dirname(__FILE__)).'/error.php';
    exit;
}

//echo '<pre>';print nl2br(print_r($book_result, true));echo '</pre>'; exit;
?>
<?php
//include dirname(__FILE__).'/APIConstants.php';
//include dirname(__FILE__).'/RestApiCaller.php';
header("Content-Type: application/json");
$auth=array();
$Rurl = APITICKET;

$auth["SiteName"]="";
$auth["AccountCode"]="";
$auth["UserName"]=APIUSERNAME;
$auth["Password"]=APIPASSWORD;

$psngr_email= $fbdet['email'];     
$psngr_mbl= $fbdet['mobile']; 
$sr= $data['source']; 
$source = explode(',', $sr);
$source = explode('-', $source[1]);	
$src_code = $source[0]; 

$dt= $data['destination'];
$destination = explode(',', $dt);
$destination = explode('-', $destination[1]);
$dest_code = $destination[0]; 
        
$pass= $dbFunction->partner->fetch("wig_flight_passenger", array("order_id" => $mrn, "pass_type" => 'Adult'));
$passs= $dbFunction->partner->fetch("wig_flight_passenger", array("order_id" => $mrn, "pass_type" => 'Child'));
$pass_infant= $dbFunction->partner->fetch("wig_flight_passenger", array("order_id" => $mrn, "pass_type" => 'Infant'));

$adult = $data['adult'];
$child = $data['child'];
$infant = $data['infant'];
 //$psngr= $adult + $child + $infant;
//$FareBreakdownR = $selectedflightR['FareBreakdown'];

$fare_quote_resultsR=$fare_quote_resultR['Response']['Results'];
$FareBreakdownR = $fare_quote_resultsR['FareBreakdown']; 

   foreach($FareBreakdownR as $fbseR)
{
    $PassengerType=$fbseR['PassengerType'];
	if($PassengerType == '1')
	{
	   $PassengerCount=$fbseR['PassengerCount'];
	   $currencyadlt =  $fbseR['Currency'];
	   
	   $BaseFareadlts = $fbseR['BaseFare']; 
	   $BaseFareadlt= $BaseFareadlts / $PassengerCount;
	   
	   $Taxadlts = $fbseR['Tax']; 
	   $Taxadlt= $Taxadlts / $PassengerCount;
	    
	   $YQTaxadlts = $fbseR['YQTax']; 
	   $YQTaxadlt = $YQTaxadlts / $PassengerCount;
	   
	   $AdditionalTxnFeeOfrdadlt = $fbseR['AdditionalTxnFeeOfrd']; 
	   $AdditionalTxnFeePubadlt = $fbseR['AdditionalTxnFeePub']; 
	   $AdditionalTxnFeePubadlt= $AdditionalTxnFeePubadlt / $PassengerCount;
	   $PGChargeadlt = $fbseR['PGCharge']; 
	   $AirTransFeeadlt = "0"; 
	    
	} 
	if($PassengerType == '2')
	{
	   $PassengerCountchld=$fbseR['PassengerCount'];
	   $currencychld =  $fbseR['Currency'];
	   
	   $BaseFarechlds = $fbseR['BaseFare']; 
	   $BaseFarechld= $BaseFarechlds / $PassengerCountchld;
	   $Taxchlds = $fbseR['Tax']; 
	   $Taxchld = $Taxchlds / $PassengerCountchld;
	   $YQTaxchlds = $fbseR['YQTax']; 
	   $YQTaxchld = $YQTaxchlds / $PassengerCountchld;
	   
	   $AdditionalTxnFeeOfrdchld = $fbseR['AdditionalTxnFeeOfrd']; 
	   $AdditionalTxnFeePubchld = $fbseR['AdditionalTxnFeePub']; 
	   $AdditionalTxnFeePubchld= $AdditionalTxnFeePubchld / $PassengerCountchld;
	   $PGChargechld = $fbseR['PGCharge']; 
	   $AirTransFeechld = "0";
	} 
	if($PassengerType == '3')
	{
	  $PassengerCountinfnt=$fbseR['PassengerCount'];
	   $currencyinfnt =  $fbseR['Currency'];
	   
	   $BaseFareinfnts = $fbseR['BaseFare']; 
	   $BaseFareinfnt = $BaseFareinfnts / $PassengerCountinfnt;
	   $Taxinfnts = $fbseR['Tax']; 
	   $Taxinfnt = $Taxinfnts / $PassengerCountinfnt;
	   $YQTaxinfnts = $fbseR['YQTax']; 
	   $YQTaxinfnt = $YQTaxinfnts / $PassengerCountinfnt;
	   
	   $AdditionalTxnFeeOfrdinfnt = $fbseR['AdditionalTxnFeeOfrd']; 
	   $AdditionalTxnFeePubinfnt = $fbseR['AdditionalTxnFeePub']; 
	   $AdditionalTxnFeePubinfnt= $AdditionalTxnFeePubinfnt / $PassengerCountinfnt;
	   
	   $PGChargeinfnt = $fbse['PGCharge']; 
	   $AirTransFeeinfnt = "0";
	} 
}

 ############# GST ###############
$gstval= $dbFunction->master->fetchSingle("wig_flight_booking", array("order_id" => $mrn));
if($gstval['gst_company_add']){$GSTCompanyAddress = $gstval['gst_company_add'];}else{$GSTCompanyAddress = "LOWER GROUND FLOOR, H.NO.10/2, KHASRA NO.619/6 AND 619/3 VILLAGE, CHHATTARPUR NEAR, NEW DELHI, South West Delhi, Delhi, 110074";}
if($gstval['gst_c_contact']){$GSTCompanyContactNumber = $gstval['gst_c_contact'];}else{$GSTCompanyContactNumber = "7011229958";}
if($gstval['gst_c_name']){$GSTCompanyName = $gstval['gst_c_name'];}else{$GSTCompanyName = "FLYSHOP.IN";}
if($gstval['gst_number']){$GSTNumber = $gstval['gst_number'];}else{$GSTNumber = "07DVFPK1987K3ZZ";}
if($gstval['gst_company_eml']){$GSTCompanyEmail = $gstval['gst_company_eml'];}else{$GSTCompanyEmail = "flyshop.india@gmail.com";}
 ############# GST ###############
 
############# GST ###############
/* $GSTCompanyAddress = "LOWER GROUND FLOOR, H.NO.10/2, KHASRA NO.619/6 AND 619/3 VILLAGE, CHHATTARPUR NEAR, NEW DELHI, South West Delhi, Delhi, 110074";
 $GSTCompanyContactNumber = "7011229958";
 $GSTCompanyName = "FLYSHOP.IN";
 $GSTNumber = "07DVFPK1987K3ZZ";
 $GSTCompanyEmail = "flyshop.india@gmail.com";*/
############# GST ###############

$hotelgst=array();
$lpsn=1;$i=0;
 while($adult > 0 ) {
     
		 $ht_psng['Title']= $pass[$i]['title'];
		 $ht_psng['FirstName'] = $pass[$i]['fname'];
		 $ht_psng['LastName'] = $pass[$i]['lname'];
		 $ht_psng['PaxType'] = '1';
    	 $ht_psng['DateOfBirth'] = "2000-12-06T00:00:00";
		 $ht_psng['Gender'] = "1";
		 $ht_psng['PassportNo'] = "";
		 $ht_psng['PassportExpiry'] = "";
		 $ht_psng['AddressLine1'] = "NEW DELHI";
		 $ht_psng['AddressLine2'] = "";
		 $ht_psng['City'] = "NEW DELHI";
		 $ht_psng['CountryCode'] = "IN";
         $ht_psng['CountryName'] = "India";
         $ht_psng['Nationality'] = "IN";
		 $ht_psng['ContactNo'] = $psngr_mbl;
		 $ht_psng['Email'] = $psngr_email;
		 
		 if($i == '0'){
		 $ht_psng['IsLeadPax'] = "true";
		 }else
		 {
		 $ht_psng['IsLeadPax'] = "false";
		 }
		 
		 $ht_psng['GSTCompanyAddress'] = $GSTCompanyAddress;
		 $ht_psng['GSTCompanyContactNumber'] = $GSTCompanyContactNumber;
		 $ht_psng['GSTCompanyName'] = $GSTCompanyName;
		 $ht_psng['GSTNumber'] = $GSTNumber;
		 $ht_psng['GSTCompanyEmail'] = $GSTCompanyEmail;
		 
		 	$Fare=array();
              $ht_psng1['BaseFare'] = $BaseFareadlt;
              $ht_psng1['Tax'] = $Taxadlt;
              $ht_psng1['TransactionFee'] = "0";
              $ht_psng1['YQTax'] = $YQTaxadlt;
              $ht_psng1['AdditionalTxnFeeOfrd'] = $AdditionalTxnFeeOfrdadlt;
              $ht_psng1['AdditionalTxnFeePub'] = $AdditionalTxnFeePubadlt;
		      $ht_psng1['AirTransFee'] = $AirTransFeeadlt;
		      
    	    	  $Fare[]=$ht_psng1;
    	    	  $ht_psng['Fare'] =  $Fare;
	    	  
    	    ########################### MEAL ########################## 
    		 $mealval= $pass[$i]['meal_price'];
    		 if($mealval){
    		 $mealval= explode(' ,', $mealval); 
    		 foreach($mealprefR as $mlref){ //print_r($mlref);
    		     if($mlref['Code'] == $mealval['0']){
    		               $adtmlAirlineCode= $mlref['AirlineCode'];
    		               $adtmlFlightNumber= $mlref['FlightNumber'];
    		               $adtmlWayType= $mlref['WayType'];
    		               $adtmlCode= $mlref['Code'];
    		               $adtmlDescription= $mlref['Description'];
    		               $adtmlAirlineDescription= $mlref['AirlineDescription'];
    		               $adtmlQuantity= $mlref['Quantity'];
    		               $adtmlCurrency= $mlref['Currency'];
    		               $adtmlPrice= $mlref['Price'];
    		               $adtmlOrigin= $mlref['Origin'];
    		               $adtmlDestination= $mlref['Destination'];
    		     }
    		 }
	    	  
	    	  $MealDynamic= array();
    	      $ht_psngml['WayType'] = $adtmlWayType;
              $ht_psngml['Code'] = $adtmlCode;
              $ht_psngml['Description'] = $adtmlDescription;
              $ht_psngml['AirlineDescription'] = $adtmlAirlineDescription;
              $ht_psngml['Quantity'] = $adtmlQuantity;
              $ht_psngml['Price'] = $adtmlPrice;
    	      $ht_psngml['Currency'] = $adtmlCurrency;
              $ht_psngml['Origin'] = $adtmlOrigin;
              $ht_psngml['Destination'] = $adtmlDestination;
    	          $MealDynamic[]= $ht_psngml;
	    	      $ht_psng['MealDynamic'] =$MealDynamic;
    		 }
	    	  ########################### MEAL ########################## 
	    	  
	    	 ########################### Baggage ########################## 
    		 $baggval= $pass[$i]['baggage_price'];
    		 if($baggval){
    		 $baggval= explode(' ,', $baggval);
    		 $baggvals= explode('KG', $baggval['0']);
    		 
    		 foreach($baggageprefR as $bgref){ //print_r($mlref);
    		     if($bgref['Weight'] == $baggvals['0']){
    		         
    		               $adtbgAirlineCode= $bgref['AirlineCode'];
    		               $adtbgFlightNumber= $bgref['FlightNumber'];
    		               $adtbgWayType= $bgref['WayType'];
    		               $adtbgCode= $bgref['Code'];
    		               $adtbgDescription= $bgref['Description'];
    		               $adtbgWeight= $bgref['Weight'];
    		               $adtbgCurrency= $bgref['Currency'];
    		               $adtbgPrice= $bgref['Price'];
    		               $adtbgOrigin= $bgref['Origin'];
    		               $adtbgDestination= $bgref['Destination'];
    		     }
    		 }
	 	
	    	  $Baggage= array();
    	      $ht_psngbg['WayType'] = $adtbgWayType;
              $ht_psngbg['Code'] = $adtbgCode;
              $ht_psngbg['Description'] = $adtbgDescription;
              $ht_psngbg['Weight'] = $adtbgWeight;
              $ht_psngbg['Currency'] = $adtbgCurrency;
              $ht_psngbg['Price'] = $adtbgPrice;
              $ht_psngbg['Origin'] = $adtbgOrigin;
              $ht_psngbg['Destination'] = $adtbgDestination;
    	          $Baggage[]= $ht_psngbg;
	    	      $ht_psng['Baggage'] =$Baggage;
    		 }
	    ########################### Baggage ##########################   
	    	  
    		  $hotelgst[]=$ht_psng;
    		  $adult--;$i++;
 
 }
 
 //$hotelgstcld=array();
$lpsn11=1;$j=0;
 while($child > 0 ) { 		
		 $ht_psng2['Title']= $passs[$j]['title'];;
		 $ht_psng2['FirstName'] = $passs[$j]['fname'];;
		 $ht_psng2['LastName'] = $passs[$j]['lname'];;
		 $ht_psng2['PaxType'] = '2';
    	 $ht_psng2['DateOfBirth'] = "2015-12-06T00:00:00";
		 $ht_psng2['Gender'] = "1";
		 $ht_psng2['PassportNo'] = "";
		 $ht_psng2['PassportExpiry'] = "";
		 $ht_psng2['AddressLine1'] = "NEW DELHI";
		 $ht_psng2['AddressLine2'] = "";
		 $ht_psng2['City'] = "NEW DELHI";
		 $ht_psng2['CountryCode'] = "IN";
         $ht_psng2['CountryName'] = "India";
         $ht_psng2['Nationality'] = "IN";
		 $ht_psng2['ContactNo'] = $psngr_mbl;
		 $ht_psng2['Email'] = $psngr_email;
		 $ht_psng2['IsLeadPax'] = "false";
		 
		 $ht_psng2['GSTCompanyAddress'] = $GSTCompanyAddress;
		 $ht_psng2['GSTCompanyContactNumber'] = $GSTCompanyContactNumber;
		 $ht_psng2['GSTCompanyName'] = $GSTCompanyName;
		 $ht_psng2['GSTNumber'] = $GSTNumber;
		 $ht_psng2['GSTCompanyEmail'] = $GSTCompanyEmail;
		
		 	$Fare2 =array();
             $ht_psng21['BaseFare'] = $BaseFarechld;
              $ht_psng21['Tax'] = $Taxchld;
              $ht_psng21['TransactionFee'] = "0";
              $ht_psng21['YQTax'] = $YQTaxchld;
              $ht_psng21['AdditionalTxnFeeOfrd'] = $AdditionalTxnFeeOfrdchld;
              $ht_psng21['AdditionalTxnFeePub'] = $AdditionalTxnFeePubchld;
		      $ht_psng21['AirTransFee'] = $AirTransFeechld;
		      
		      $Fare2[]=$ht_psng21;
		      $ht_psng2['Fare'] =  $Fare2;
		      
		      ########################### MEAL ########################## 
    		 $mealval= $passs[$j]['meal_price'];
    		 if($mealval){
    		 $mealval= explode(' ,', $mealval); 
    		 foreach($mealprefR as $mlref){ //print_r($mlref);
    		     if($mlref['Code'] == $mealval['0']){
    		               $cdmlAirlineCode= $mlref['AirlineCode'];
    		               $cdmlFlightNumber= $mlref['FlightNumber'];
    		               $cdmlWayType= $mlref['WayType'];
    		               $cdmlCode= $mlref['Code'];
    		               $cdmlDescription= $mlref['Description'];
    		               $cdmlAirlineDescription= $mlref['AirlineDescription'];
    		               $cdmlQuantity= $mlref['Quantity'];
    		               $cdmlCurrency= $mlref['Currency'];
    		               $cdmlPrice= $mlref['Price'];
    		               $cdmlOrigin= $mlref['Origin'];
    		               $cdmlDestination= $mlref['Destination'];
    		     }
    		 }
	    	  
	    	  $MealDynamic2= array();
    	      $ht_psngml2['WayType'] = $cdmlWayType;
              $ht_psngml2['Code'] = $cdmlCode;
              $ht_psngml2['Description'] = $cdmlDescription;
              $ht_psngml2['AirlineDescription'] = $cdmlAirlineDescription;
              $ht_psngml2['Quantity'] = $cdmlQuantity;
              $ht_psngml2['Price'] = $cdmlPrice;
    	      $ht_psngml2['Currency'] = $cdmlCurrency;
              $ht_psngml2['Origin'] = $cdmlOrigin;
              $ht_psngml2['Destination'] = $cdmlDestination;
    	          $MealDynamic2[]= $ht_psngml2;
	    	      $ht_psng2['MealDynamic'] =$MealDynamic2;
    		 }
	    	  ########################### MEAL ########################## 
	    	  
	    	 ########################### Baggage ########################## 
    		 $baggval= $passs[$j]['baggage_price'];
    		 if($baggval){
    		 $baggval= explode(' ,', $baggval);
    		 $baggvals= explode('KG', $baggval['0']);
    		 
    		 foreach($baggageprefR as $bgref){ //print_r($mlref);
    		     if($bgref['Weight'] == $baggvals['0']){
    		         
    		               $cdbgAirlineCode= $bgref['AirlineCode'];
    		               $cdbgFlightNumber= $bgref['FlightNumber'];
    		               $cdbgWayType= $bgref['WayType'];
    		               $cdbgCode= $bgref['Code'];
    		               $cdbgDescription= $bgref['Description'];
    		               $cdgWeight= $bgref['Weight'];
    		               $cdbgCurrency= $bgref['Currency'];
    		               $cdbgPrice= $bgref['Price'];
    		               $cdbgOrigin= $bgref['Origin'];
    		               $cdbgDestination= $bgref['Destination'];
    		     }
    		 }
	 	
	    	  $Baggage2= array();
    	      $ht_psngbg2['WayType'] = $cdbgWayType;
              $ht_psngbg2['Code'] = $cdbgCode;
              $ht_psngbg2['Description'] = $cdbgDescription;
              $ht_psngbg2['Weight'] = $cdgWeight;
              $ht_psngbg2['Currency'] = $cdbgCurrency;
              $ht_psngbg2['Price'] = $cdbgPrice;
              $ht_psngbg2['Origin'] = $cdbgOrigin;
              $ht_psngbg2['Destination'] = $cdbgDestination;
    	          $Baggage2[]= $ht_psngbg2;
	    	      $ht_psng2['Baggage'] =$Baggage2;
    		 }
	    ########################### Baggage ########################## 
              
    		  $hotelgst[]=$ht_psng2;
    		 
		  $child --;$j++;
 }

$lpsn111=1;$k=0;
 while($infant > 0 ) { 		
  		$ht_psng3['Title']= $pass_infant[$k]['title'];
		 $ht_psng3['FirstName'] = $pass_infant[$k]['fname'];
		 $ht_psng3['LastName'] = $pass_infant[$k]['lname']; 
		 $ht_psng3['PaxType'] = '3';
    	 
    	 $DateOfBirth = date("Y-m-d", strtotime($pass_infant[$k]['dob']));
		 $DateOfBirth= $DateOfBirth.'T00:00:00';
    	 $ht_psng3['DateOfBirth'] = $DateOfBirth;
    	 
		 $ht_psng3['Gender'] = "1";
		 $ht_psng3['PassportNo'] = "";
		 $ht_psng3['PassportExpiry'] = "";
		 $ht_psng3['AddressLine1'] = "NEW DELHI";
		 $ht_psng3['AddressLine2'] = "";
		 $ht_psng3['City'] = "NEW DELHI";
		 $ht_psng3['CountryCode'] = "IN";
         $ht_psng3['CountryName'] = "India";
         $ht_psng3['Nationality'] = "IN";
         
		 $ht_psng3['ContactNo'] = $psngr_mbl;
		 $ht_psng3['Email'] = $psngr_email;
		 $ht_psng3['IsLeadPax'] = "false";
		 
		 $ht_psng3['GSTCompanyAddress'] = $GSTCompanyAddress;
		 $ht_psng3['GSTCompanyContactNumber'] = $GSTCompanyContactNumber;
		 $ht_psng3['GSTCompanyName'] = $GSTCompanyName;
		 $ht_psng3['GSTNumber'] = $GSTNumber;
		 $ht_psng3['GSTCompanyEmail'] = $GSTCompanyEmail;
	
		 	$Fare3 =array();
              $ht_psng31['BaseFare'] = $BaseFareinfnt;
              $ht_psng31['Tax'] = $Taxinfnt;
              $ht_psng31['TransactionFee'] = "0";
              $ht_psng31['YQTax'] = $YQTaxinfnt;
              $ht_psng31['AdditionalTxnFeeOfrd'] = $AdditionalTxnFeeOfrdinfnt;
              $ht_psng31['AdditionalTxnFeePub'] = $AdditionalTxnFeePubinfnt;
		      $ht_psng31['AirTransFee'] = $AirTransFeeinfnt;
		      
		    $Fare3[]=$ht_psng31;
		    $ht_psng3['Fare'] =  $Fare3;
		    
    		$hotelgst[]=$ht_psng3;
		  $infant --;$k++;
 } 
        
                                    
 $opta = array( 
               "EndUserIp" => $ip,
               "TokenId" => $TokenId,
               "TraceId" => $TraceId,
               "ResultIndex" => $idR,
               "Passengers" => $hotelgst
                );
 
$ticket_result_LCC =array();
try
{
$req=str_replace('\/','/',json_encode($opta));
$req=file_put_contents("FLYTBOJSON/FlyShopTicketDomReturnIBLCCreq.txt","$req");
  
$postdata = file_get_contents("FLYTBOJSON/FlyShopTicketDomReturnIBLCCreq.txt","$req"); //Take JSON input from Postman Client
//echo $postdata;

$header = array('Content-Type: application/json', 'Accept-Encoding: gzip');
$restCaller = new RestApiCaller();
$flightRes = $restCaller->post($Rurl, $postdata, $header);

$results=file_put_contents("FLYTBOJSON/FlyShopTicketDomReturnIBLCCres.txt","$flightRes");
$book_resultR = json_decode($flightRes,true);
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
//echo '<pre>';print nl2br(print_r($book_resultR, true));echo '</pre>'; exit;
?>
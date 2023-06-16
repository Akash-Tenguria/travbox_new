<?php
session_start();
include dirname(__FILE__).'/APIConstants.php';
include dirname(__FILE__).'/RestApiCaller.php';
header("Content-Type: application/json");
$auth=array();
$Rurl = APIBOOK;

$auth["SiteName"]="";
$auth["AccountCode"]="";
$auth["UserName"]=APIUSERNAME;
$auth["Password"]=APIPASSWORD;

 $ResultIndex='OB200';  
 $adultArrForTbo=array(); 
 $seatDynamicArr=array();	
 $PassengerDetailArr=array();
 
		$adultArrForTbo['Title']="Mr";
		$adultArrForTbo['FirstName']= "Alim"; 
		$adultArrForTbo['LastName']="Hali"; 
		$adultArrForTbo['PaxType']='1';
		$adultArrForTbo['DateOfBirth']= "2000-12-06T00:00:00"; 
		$adultArrForTbo['Gender']="1";

		$adultArrForTbo['GSTCompanyAddress']="LOWER GROUND FLOOR, H.NO.10/2, KHASRA NO.619/6 AND 619/3 VILLAGE, CHHATTARPUR NEAR, NEW DELHI, South West Delhi, Delhi, 110074";
		$adultArrForTbo['GSTCompanyContactNumber']="9811744268";
		$adultArrForTbo['GSTCompanyName']="Travbizz.IN";
		$adultArrForTbo['GSTNumber']="07DVFPK1987K3ZZ";
		$adultArrForTbo['GSTCompanyEmail']="travbizz.india@gmail.com";			
		
/*		$adultArrForTbo['PassportNo']='';
		$adultArrForTbo['PassportExpiry']='';
		$adultArrForTbo['PassportIssueDate']='';*/
		
		$adultArrForTbo['AddressLine1']="NEW DELHI";
		$adultArrForTbo['AddressLine2']='';
		$adultArrForTbo['City']="NEW DELHI";
		$adultArrForTbo['CountryCode']="IN";
		$adultArrForTbo['CountryName']="India";
		
		$adultArrForTbo['ContactNo']='9811744268';
		$adultArrForTbo['Email']='alimhali01@gmail.com';
		$adultArrForTbo['IsLeadPax']=true;
		

		
		/* fare rule */
		
		$fareArr=array();
		$fareArr['BaseFare']=5170;
		$fareArr['Tax']=785;
		$fareArr['TransactionFee']=0;
		$fareArr['YQTax']=0;
		$fareArr['AdditionalTxnFeeOfrd']=0;
		$fareArr['AdditionalTxnFeePub']=0;
		$fareArr['AirTransFee']=0;
		$adultArrForTbo['Fare'][]=$fareArr;		
		
		/* seat dynamic */
/*		$seatDynamicArr['AirlineCode']='6E';
		$seatDynamicArr['FlightNumber']='546';
		$seatDynamicArr['CraftType']='';
		$seatDynamicArr['Origin']='';
		$seatDynamicArr['Destination']='';
		$seatDynamicArr['AvailablityType']='';
		$seatDynamicArr['Description']='';
		$seatDynamicArr['Code']='';
		$seatDynamicArr['RowNo']='';
		$seatDynamicArr['SeatNo']='';
		$seatDynamicArr['SeatType']='';
		$seatDynamicArr['SeatWayType']='';
		$seatDynamicArr['Compartment']='';
		$seatDynamicArr['Deck']='';
		$seatDynamicArr['Currency']='';
		$seatDynamicArr['Price']='';

		$adultArrForTbo['SeatDynamic'][]=$seatDynamicArr;*/
		$adultArrForTbo['Nationality']='Indian';	
		
		
		$PassengerDetailArr[]=$adultArrForTbo;	
 
 
                                 
 $opta = array( 
				"EndUserIp" => $_SESSION['EndUserIp'],
				"TokenId" => $_SESSION['tbotokenId'],
				"TraceId" => $_SESSION['TraceId'],
                "ResultIndex" =>$ResultIndex,
                "Passengers" => $PassengerDetailArr
                );
 

echo "<pre>"; 
echo print_r($opta);

echo "<br>**********************<br>";


 
 
$book_result=array();
try
{
$req=str_replace('\/','/',json_encode($opta));
$req=file_put_contents("../FLYTBOJSON/FlyShopBookReq2.txt","$req");
  
$postdata = file_get_contents("../FLYTBOJSON/FlyShopBookReq2.txt","$req"); //Take JSON input from Postman Client
	//echo '<pre>';print nl2br(print_r($postdata, true));echo '</pre>'; exit;

echo "<br>**********json************<br>";	
echo $postdata;
echo "<br>**********************<br>";

$header = array('Content-Type: application/json', 'Accept-Encoding: gzip');
$restCaller = new RestApiCaller();
$flightRes = $restCaller->post($Rurl, $postdata, $header);

echo "<br>**********************<br>";

print_r($flightRes);
die;

$results=file_put_contents("../FLYTBOJSON/FlyShopBookRes2.txt","$flightRes");
$book_result = json_decode($flightRes,true);

/*cho "<pre>";
print_r($book_result);
die;*/


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
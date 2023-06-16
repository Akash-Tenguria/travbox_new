<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$page='hotels';

error_reporting(0);
$randnumber='OFF'.rand(111111,999999);
//$retrunhoteloffline=1;

 if($totalwalletBalance>=base64_decode(base64_decode(base64_decode($_REQUEST['ppid']))) && base64_decode(base64_decode(base64_decode($_REQUEST['ppid'])))>350 && $_REQUEST['ResultIndex']!='' && $_REQUEST['HotelCode']!='' && $_REQUEST['HotelName']!=''){

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

ini_set('serialize_precision','-1');

if(isset($_REQUEST['RoomIndex']))
{


$requestDetail=json_decode($_SESSION['hotelSearchRequestSES'],true);
$roomGuestArr=$requestDetail['RoomGuests'];
/*
echo "<br>************************<br>";
echo "<pre>";
print_r($roomGuestArr);

echo "<br>**************************<br>";*/

/************* Hotel Booking - BlockRoom Request to check price changes *****************/
$RoomIndex=$_REQUEST['RoomIndex'];

//echo "<br>***********Room Data Arr***************<br>";	
$roomDataArr=$_SESSION['roomData'];
//	echo "<pre>";
//	print_r($roomDataArr);

if(count($roomDataArr)>0)
{
	foreach($roomDataArr as $keyIndex=>$roomDataArrValue)
	{
	  	if($roomDataArrValue['RoomIndex']== $RoomIndex)
		{
		 	$roomIndexForDataArr=$roomDataArr[$keyIndex];   
		} 
	
	}	


}	


$agentMarkup=0;	
	
//echo "<br>***********Room Data ***************<br>";		
	//$roomIndexForDataArr=$roomDataArr[$RoomIndex-1];

	/*echo "<pre>";
	print_r($roomIndexForDataArr);
	
	echo "<br>**************<br>";*/
	
	
	
	
	
	$RoomTypeCode=$_REQUEST['RoomTypeCode'];
	$RoomTypeName=$_REQUEST['RoomTypeName'];
	$RatePlanCode=$_REQUEST['RatePlanCode'];
	$BedTypeCode=$_REQUEST['BedTypeCode'];
	$SmokingPreference=$_REQUEST['SmokingPreference'];
	$Supplements=$_REQUEST['Supplements'];
	
	$ResultIndex=$_REQUEST['ResultIndex'];
	$HotelCode=$_REQUEST['HotelCode'];
	$HotelName=$_REQUEST['HotelName'];
	$NoOfRooms=$_REQUEST['NoOfRooms'];
	$ClientReferenceNo=$_REQUEST['ClientReferenceNo'];
	$IsVoucherBooking=$_REQUEST['IsVoucherBooking'];

$hotelBlockRoomArr=array();
$room=1;
if(count($roomGuestArr)>0)
{
  foreach($roomGuestArr as $roomGuestArrValue)			  
  {	
	$adultCount=$roomGuestArrValue['NoOfAdults'];
	$childCount=$roomGuestArrValue['NoOfChild'];
	
	$hotelPassengerArr=array();
		
	
	$hotelBlockRoomDetail= array (
		  'RoomIndex' => $RoomIndex,
		  'RoomTypeCode' => $RoomTypeCode,
		  'RoomTypeName' => $RoomTypeName,
		  'RatePlanCode' => $RatePlanCode,
		  'BedTypeCode' => NULL,
		  'SmokingPreference' => 0,
		  'Supplements' => NULL,
		  'Price' => 
		  array (
			'CurrencyCode' => $roomIndexForDataArr['Price']['CurrencyCode'],
			'RoomPrice' => $roomIndexForDataArr['Price']['RoomPrice'],
			'Tax' => $roomIndexForDataArr['Price']['Tax'],
			'ExtraGuestCharge' => $roomIndexForDataArr['Price']['ExtraGuestCharge'],
			'ChildCharge' => $roomIndexForDataArr['Price']['ChildCharge'],
			'OtherCharges' => $roomIndexForDataArr['Price']['OtherCharges'],
			'Discount' => $roomIndexForDataArr['Price']['Discount'],
			'PublishedPrice' => $roomIndexForDataArr['Price']['PublishedPrice'],
			'PublishedPriceRoundedOff' => $roomIndexForDataArr['Price']['PublishedPriceRoundedOff'],
			'OfferedPrice' => $roomIndexForDataArr['Price']['OfferedPrice'],
			'OfferedPriceRoundedOff' => $roomIndexForDataArr['Price']['OfferedPriceRoundedOff'],
			'AgentCommission' => $roomIndexForDataArr['Price']['AgentCommission'],
			'AgentMarkUp' => $roomIndexForDataArr['Price']['AgentMarkUp'],
			'ServiceTax' => $roomIndexForDataArr['Price']['ServiceTax'],
			'TCS' => $roomIndexForDataArr['Price']['TCS'],
			'TDS' => $roomIndexForDataArr['Price']['TDS'],
		  )
		 );
		 
		 
	$hotelBlockRoomArr[]=$hotelBlockRoomDetail;
	$room++;
	}

}	
		  
	$requestBlockRoomArr=array(
	
		'EndUserIp' => $_SERVER['SERVER_ADDR'],
		'TokenId' => $_SESSION['hotelTokenId'],
		'TraceId' => $_SESSION['hotelTraceId'],	
		'ResultIndex' => decode($ResultIndex),
		'HotelCode' => decode($HotelCode),
		'HotelName' => $HotelName,
		'GuestNationality' => 'IN',
		'NoOfRooms' => $NoOfRooms,
		'ClientReferenceNo' => '0',
		'IsVoucherBooking' => 'false',	
		'HotelRoomsDetails'=>$hotelBlockRoomArr
				
	);	
		
	
}


 if($retrunhoteloffline==0){ 

$ch2 = curl_init();
$url2 = 'https://api.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/BlockRoom/';

$header = array('Content-Type: application/json');
$postdata=str_replace('\/','/',json_encode($requestBlockRoomArr,JSON_NUMERIC_CHECK ));

file_put_contents("hotelapijson/hotel_blockroom_request.txt",$postdata); 
 

curl_setopt($ch2 , CURLOPT_URL, $url2);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch2, CURLOPT_HTTPHEADER, $header);

$information2 = curl_getinfo($ch2);
$result2 = curl_exec($ch2);
$blockroomArr = json_decode($result2,true); 	
//echo "<pre>";
//print_r($hotelInfoArr);
 
/*print_r($blockroomArr);*/
//echo "<br>***********Block Room Results***************<br>";
//echo "<pre>";
//print_r($blockroomArr);

file_put_contents("hotelapijson/hotel_blockroom_result.txt",$result2); 


//echo "<br>***************Booking************************<br>";
$IsPackageFare=false;
if($blockroomArr['BlockRoomResult']['IsPackageFare']==1)
{
	$IsPackageFare=true;
}





$hotelBookRoomArr=array();
$room=1;
if(count($roomGuestArr)>0)
{
  foreach($roomGuestArr as $roomGuestArrValue)			  
  {	
	$adultCount=$roomGuestArrValue['NoOfAdults'];
	$childCount=$roomGuestArrValue['NoOfChild'];
	
	 $hotelPassengerArr=array();
	
	 if($adultCount>0)
	 {
			  for($a=1;$a<=$adultCount;$a++)
			  {
					$Title=$_REQUEST['titleAdt'.$a];	
					
					$FirstName=$_REQUEST['firstNameAdt'.$a];
					$LastName=$_REQUEST['lastNameAdt'.$a];
					
					if($guestname=='' && trim($FirstName)!=''){
					 $guestname=$FirstName.' '.$LastName;
					}
					
					
					$MiddleName=null;
					$Phoneno=null;
					$Email=null;
					$PaxType=1;
					if($a==1)
					{
						$LeadPassenger=true;
					}
					else
					{
						$LeadPassenger=false;
					}
					$Age=0;
					$PassportNo=null;
					$PassportIssueDate="0001-01-01T00: 00: 00";
					$PassportExpDate="0001-01-01T00: 00: 00";
					$PAN="EBQPS3333T";
					
					$hotelPassArr=array();
					$hotelPassArr['Title']=$Title;
					$hotelPassArr['FirstName']=$FirstName;  
					$hotelPassArr['MiddleName']=$MiddleName;
					$hotelPassArr['LastName']=$LastName;
					$hotelPassArr['Phoneno']=$Phoneno;
					$hotelPassArr['Email']=$Email;
					$hotelPassArr['PaxType']=$PaxType;
					$hotelPassArr['LeadPassenger']=$LeadPassenger;
					$hotelPassArr['Age']=$Age;
					$hotelPassArr['PassportNo']=$PassportNo;
					$hotelPassArr['PassportIssueDate']=$PassportIssueDate;
					$hotelPassArr['PassportExpDate']=$PassportExpDate;
					$hotelPassArr['PAN']=$PAN;
					
				$hotelPassengerArr[]=$hotelPassArr;	
					
					
					
					 if($guestname=='' && trim($FirstName)!=''){
					 $guestname=$FirstName.' '.$LastName;
					 }	
			  
		    
			  
			  
			  }	 
	 
	 }
	 


	 if($childCount>0)
	 {
			  $ChildAge=$roomGuestArrValue['ChildAge'];
			  
			  for($c=1;$c<=$childCount;$c++)
			  {
					$chdAge=$ChildAge[$c-1];
					
					$Title='Mr.';	
					$FirstName=$_REQUEST['firstNameChd'.$c];
					$LastName=$_REQUEST['lastNameChd'.$c];
					$MiddleName=null;
					$Phoneno=null;
					$Email=null;
					$PaxType=2;
					$LeadPassenger=true;
					$Age=$chdAge;
					$PassportNo=null;
					$PassportIssueDate="0001-01-01T00: 00: 00";
					$PassportExpDate="0001-01-01T00: 00: 00";
					$PAN="EBQPS3333T";
					
					$hotelPassArr=array();
					$hotelPassArr['Title']=$Title;
					$hotelPassArr['FirstName']=$FirstName;
					$hotelPassArr['MiddleName']=$MiddleName;
					$hotelPassArr['LastName']=$LastName;
					$hotelPassArr['Phoneno']=$Phoneno;
					$hotelPassArr['Email']=$Email;
					$hotelPassArr['PaxType']=$PaxType;
					$hotelPassArr['LeadPassenger']=$LeadPassenger;
					$hotelPassArr['Age']=$Age;
					$hotelPassArr['PassportNo']=$PassportNo;
					$hotelPassArr['PassportIssueDate']=$PassportIssueDate;
					$hotelPassArr['PassportExpDate']=$PassportExpDate;
					$hotelPassArr['PAN']=$PAN;
					
				$hotelPassengerArr[]=$hotelPassArr;	
				
				
					 if($guestname=='' && trim($FirstName)!=''){
					  $guestname=$FirstName.' '.$LastName;
					 }
				
				 
					
			  
			  }	 
	 
	 }


	
	
	
	$hotelBlockRoomDetail= array (
		  'RoomIndex' => $RoomIndex,
		  'RoomTypeCode' => $RoomTypeCode,
		  'RoomTypeName' => $RoomTypeName,
		  'RatePlanCode' => $RatePlanCode,
		  'BedTypeCode' => NULL,
		  'SmokingPreference' => 0,
		  'Supplements' => NULL,
		  'Price' => 
		  array (
			'CurrencyCode' => $roomIndexForDataArr['Price']['CurrencyCode'],
			'RoomPrice' => $roomIndexForDataArr['Price']['RoomPrice'],
			'Tax' => $roomIndexForDataArr['Price']['Tax'],
			'ExtraGuestCharge' => $roomIndexForDataArr['Price']['ExtraGuestCharge'],
			'ChildCharge' => $roomIndexForDataArr['Price']['ChildCharge'],
			'OtherCharges' => $roomIndexForDataArr['Price']['OtherCharges'],
			'Discount' => $roomIndexForDataArr['Price']['Discount'],
			'PublishedPrice' => $roomIndexForDataArr['Price']['PublishedPrice'],
			'PublishedPriceRoundedOff' => $roomIndexForDataArr['Price']['PublishedPriceRoundedOff'],
			'OfferedPrice' => $roomIndexForDataArr['Price']['OfferedPrice'],
			'OfferedPriceRoundedOff' => $roomIndexForDataArr['Price']['OfferedPriceRoundedOff'],
			'AgentCommission' => $roomIndexForDataArr['Price']['AgentCommission'],
			'AgentMarkUp' => $roomIndexForDataArr['Price']['AgentMarkUp'],
			'ServiceTax' => $roomIndexForDataArr['Price']['ServiceTax'],
			'TCS' => $roomIndexForDataArr['Price']['TCS'],
			'TDS' => $roomIndexForDataArr['Price']['TDS'],
		  ),
		  
		   'HotelPassenger' => $hotelPassengerArr
		  
		 );
		 
		 
	$hotelBookRoomArr[]=$hotelBlockRoomDetail;
	$room++;
	
	$agentMarkup=$agentMarkup+$roomIndexForDataArr['Price']['AgentMarkUp'];
	
	}

}




	$requestBookingRoomArr=array(
	
		'EndUserIp' => $_SERVER['SERVER_ADDR'],
		'TokenId' => $_SESSION['hotelTokenId'],
		'TraceId' => $_SESSION['hotelTraceId'],	
		'ResultIndex' => decode($ResultIndex),
		'HotelCode' => decode($HotelCode),
		'HotelName' => $HotelName,
		'GuestNationality' => 'IN',
		'NoOfRooms' => $NoOfRooms,
		'ClientReferenceNo' => '0',
		'IsVoucherBooking' => 'false',	
		'IsPackageFare' => $IsPackageFare,
		'HotelRoomsDetails'=>$hotelBookRoomArr
				
	);	



$ch2 = curl_init();
$url2 = 'https://booking.travelboutiqueonline.com/HotelAPI_V10/HotelService.svc/rest/Book/';

$header = array('Content-Type: application/json');
$postdataBooking=str_replace('\/','/',json_encode($requestBookingRoomArr,JSON_NUMERIC_CHECK ));

//echo "<br>***********Book Request***************<br>";
//echo $postdataBooking;

file_put_contents("hotelapijson/hotel_book_request.txt",$postdataBooking); 

//echo "<br>**************************<br>";
//echo $postdata;
//echo "<br>**************************<br>";

curl_setopt($ch2 , CURLOPT_URL, $url2);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $postdataBooking);
curl_setopt($ch2, CURLOPT_HTTPHEADER, $header);

$information2 = curl_getinfo($ch2);
  $result2 = curl_exec($ch2);
$bookRoomDetailArr = json_decode($result2,true); 

file_put_contents("hotelapijson/hotel_book_result.txt",$result2); 

//echo "<br>***********Book Results***************<br>";
//echo "<pre>";
//print_r($bookRoomDetailArr);


	$hotelBasicJsonArr=json_decode($_SESSION['hotelBasicJson'],true);
	
	if($bookRoomDetailArr['BookResult']['ResponseStatus']==1 && $bookRoomDetailArr['BookResult']['Status']==1)
	{
		
		$ConfirmationNo=$bookRoomDetailArr['BookResult']['ConfirmationNo'];
		$BookingRefNo=$bookRoomDetailArr['BookResult']['BookingRefNo'];
		$BookingId=$bookRoomDetailArr['BookResult']['BookingId'];
		$IsPriceChanged=$bookRoomDetailArr['BookResult']['IsPriceChanged'];
		$IsCancellationPolicyChanged=$bookRoomDetailArr['BookResult']['IsCancellationPolicyChanged'];
		
		$Destination=$hotelBasicJsonArr['Destination'];
		$CheckIn=$hotelBasicJsonArr['CheckIn'];
		$CheckOutDate=$hotelBasicJsonArr['CheckOut'];
		$CheckOutDate=$hotelBasicJsonArr['CheckOut'];
		//$CheckIn=$hotelBasicJsonArr['CheckIn'];
		
		// price 
		
		
		
		
	
	$guestname = trim($guestname);
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);
	$companyName = trim($_POST['companyName']);
	$gstNo = trim($_POST['gstNo']);
	$gstEmail = trim($_POST['gstEmail']);
	$address = addslashes($_POST['address']);
	 
	
	
	
	if($guestname!='' && $email!=''){
	$rs5=GetPageRecord('*','clientMaster',' email="'.$email.'"'); 
	$count=mysqli_num_rows($rs5);
	$editresult=mysqli_fetch_array($rs5);
	if($count>0){
	$clientId = $editresult['id'];
	}else{
	$namevalue ='clientType="1",name="'.$guestname.'",email="'.$email.'",phone="'.$phone.'",address="'.$address.'",addDate="'.date('Y-m-d h:i:s').'"';  
	$clientId = addlistinggetlastid('clientMaster',$namevalue);  
	}
	}
		
	 
	
	$adminbase_fare=$_SESSION['PublishedPriceOfRoom'];
	$adminbase_tax=$_SESSION['TaxOfRoom'];
	$adminbase_totalFare=$_SESSION['PublishedPriceOfRoom'];
	
	$agentbase_fare=$_SESSION['PublishedPriceOfRoom'];
	$agentbase_tax=$_SESSION['TaxOfRoom'];
	$agentbase_totalFare=$_SESSION['PublishedPriceOfRoom'];
	
	$CancellationPolicy=$roomIndexForDataArr['CancellationPolicy'];
	
	  
	
	// add pax Master Detail
	
	$hotelBookRoomArr=array();
	$room2=1;
	if(count($roomGuestArr)>0)
	{
	  foreach($roomGuestArr as $roomGuestArrValue)			  
	  {	
		$adultCount=$roomGuestArrValue['NoOfAdults'];
		$childCount=$roomGuestArrValue['NoOfChild'];
		
		 $hotelPassengerArr=array();
		
		 if($adultCount>0)
		 {
				  for($a=1;$a<=$adultCount;$a++)
				  {
						$FirstName='';
						
						$Title=$_REQUEST['titleAdt'.$a];	
						$FirstName=$_REQUEST['firstNameAdt'.$a];
						$LastName=$_REQUEST['lastNameAdt'.$a];
						
						if(trim($FirstName)!=''){
						 $guestname=$FirstName.' '.$LastName;
						}
						
						$namevalue ='bookingTableId="'.$bookinglastId.'",title="'.$Title.'",firstName="'.$FirstName.'",lastName="'.$LastName.'",BookingNumber="'.$randnumber.'",paxType="adult",roomNo="'.$room2.'"';   
						addlistinggetlastid('hotelBookingPaxDetailMaster',$namevalue); 
				  
				  
				  }	 
		 
		 }
		 
	
		 if($childCount>0)
		 {
				  $ChildAge=$roomGuestArrValue['ChildAge'];
				  
				  for($c=1;$c<=$childCount;$c++)
				  {
						$chdAge=$ChildAge[$c-1];
						
						$FirstName='';
						$Title='Mr.';	
						$FirstName=$_REQUEST['firstNameChd'.$c];
						$LastName=$_REQUEST['lastNameChd'.$c];
						$Age=$chdAge;
	
						if(trim($FirstName)!=''){
						 $guestname=$FirstName.' '.$LastName;
						}
						
						$namevalue ='bookingTableId="'.$bookinglastId.'",title="'.$Title.'",firstName="'.$FirstName.'",lastName="'.$LastName.'",BookingNumber="'.$randnumber.'",paxType="child",ageChild="'.$Age.'",roomNo="'.$room2.'" ';   
						addlistinggetlastid('hotelBookingPaxDetailMaster',$namevalue); 
	
				  
				  }	 
		 
		 }
	
		$room2++;
		}
	
	}
	
	
	
	// End Pax Details
	
	
		
	$a ='bookingId="'.$BookingId.'",bookingType="hotel",agentId="'.($_SESSION['agentUserid']).'",amount="'.$_SESSION['balancesheetamount'].'",paymentType="Debit",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
	addlistinggetlastid('sys_balanceSheet',$a);
	
	
	
	
		$namevalue2 ='BookingNumber="'.$BookingId.'"'; 
		$where='BookingNumber="'.$randnumber.'"';
		updatelisting('hotelBookingPaxDetailMaster',$namevalue2,$where);
		
	
	
	 
			
	 
	
	}

}



if(trim($BookingId)>0){	
	$BookingId=$BookingId;
	$status=2;		
} else {
$BookingId=$randnumber;
$ConfirmationNo='';
$BookingRefNo='';
	$adminbase_fare=$_SESSION['PublishedPriceOfRoom'];
	$adminbase_tax=$_SESSION['TaxOfRoom'];
	$adminbase_totalFare=$_SESSION['PublishedPriceOfRoom'];
	
	$agentbase_fare=$_SESSION['PublishedPriceOfRoom'];
	$agentbase_tax=$_SESSION['TaxOfRoom'];
	$agentbase_totalFare=$_SESSION['PublishedPriceOfRoom'];
	$status=1;
} 



$totalagentfare=($_SESSION['hgaid']);

$adminMarukup=round($_SESSION['balancesheetamount']-$totalagentfare);
$agentMarukup=round($totalagentfare-$adminbase_totalFare);




 $namevalue ='confirmationNo="'.$ConfirmationNo.'",BookingRefNo="'.$BookingRefNo.'",BookingNumber="'.$BookingId.'",Destination="'.$_SESSION['citydestination'].'",CheckIn="'.$_SESSION['checkInDate'].'",CheckOutDate="'.$_SESSION['checkOutDate'].'",HotelName="'.$HotelName.'",HotelCode="'.decode($HotelCode).'", TotalRoom="'.$NoOfRooms.'",baseFare="'.$adminbase_fare.'" ,tax="'.$adminbase_tax.'",totalFare="'.$adminbase_totalFare.'",agentBaseFare="'.$agentbase_fare.'",agentTax="'.$agentbase_tax.'",adminMarukup="'.$adminMarukup.'",agentMarukup="'.$agentMarukup.'",agentTotalFare="'.$_SESSION['balancesheetamount'].'",agentOtherCharges="'.$_SESSION['balancesheetothercharges'].'",addDate="'.date('Y-m-d').'",status="'.$status.'",agentId="'.($_SESSION['agentUserid']).'",clientId="'.$clientId.'",Rating="'.$_SESSION['hotelstarcategoryrating'].'",RoomType="'.$_SESSION['syshotelroomname'].'",Address="'.addslashes($_SESSION['HotelDestinationAddress']).'",CancellationPolicy="'.$CancellationPolicy.'",agentMarkup="'.$agentMarkup.'",agentCommision="'.$roomIndexForDataArr['Price']['AgentCommission'].'",PublishedPriceRoundedOff="'.$roomIndexForDataArr['Price']['OfferedPriceRoundedOff'].'" ';  

$bookinglastId = addlistinggetlastid('hotelBookingMaster',$namevalue); 
 
$bookingTableId=$bookinglastId;

$rm=1;
if(count($roomGuestArr)>0)
{
  foreach($roomGuestArr as $roomGuestArrValue)			  
  {	
	$adultCount=$roomGuestArrValue['NoOfAdults'];
	$childCount=$roomGuestArrValue['NoOfChild'];
	
	 $hotelPassengerArr=array();
	
	 if($adultCount>0)
	 {
			  for($a=1;$a<=$adultCount;$a++)
			  {
					$Title=$_REQUEST['titleAdt'.$a];	
					
					$FirstName=$_REQUEST['firstNameAdt'.$a];
					$LastName=$_REQUEST['lastNameAdt'.$a];
					
					if($guestname=='' && trim($FirstName)!=''){
					 $guestname=$FirstName.' '.$LastName;
					}
					
					
					$MiddleName=null;
					$Phoneno=null;
					$Email=null;
					$PaxType=1;
					if($a==1)
					{
						$LeadPassenger=true;
					}
					else
					{
						$LeadPassenger=false;
					}


					 if($guestname=='' && trim($FirstName)!=''){
					 $guestname=$FirstName.' '.$LastName;
					 }	
			  
		    $namevalue ='title="'.$Title.'",firstName="'.$FirstName.'",lastName="'.$LastName.'",BookingNumber="'.$BookingId.'",bookingTableId="'.$bookinglastId.'",paxType="adult",roomNo="'.$rm.'" ';   
  addlistinggetlastid('hotelBookingPaxDetailMaster',$namevalue); 
			  
			  
			  }	 
	 
	 }
	 


	 if($childCount>0)
	 {
			  $ChildAge=$roomGuestArrValue['ChildAge'];
			  
			  for($c=1;$c<=$childCount;$c++)
			  {
					$chdAge=$ChildAge[$c-1];
					
					$Title='Mr.';	
					$FirstName=$_REQUEST['firstNameChd'.$c];
					$LastName=$_REQUEST['lastNameChd'.$c];
					$MiddleName=null;
					$Phoneno=null;
					$Email=null;
					$PaxType=2;
					$LeadPassenger=true;
					$Age=$chdAge;

				
					 if($guestname=='' && trim($FirstName)!=''){
					  $guestname=$FirstName.' '.$LastName;
					 }
				
				  $namevalue ='title="'.$Title.'",firstName="'.$FirstName.'",lastName="'.$LastName.'",BookingNumber="'.$BookingId.'",bookingTableId="'.$bookinglastId.'",ageChild="'.$Age.'",paxType="child",roomNo="'.$rm.'" ';   
 addlistinggetlastid('hotelBookingPaxDetailMaster',$namevalue); 
					
			  
			  }	 
	 
	 }
 
 	$rm++;
 
	}

}






//==================Billing===========================




$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['agentUserid'].'" '); 
$AgentWebsiteData=mysqli_fetch_array($rs);  


if(round($totalwalletBalance)>$_SESSION['balancesheetamount']){
                    
                    
                    
                    $admarkup=($adminMarukup);
                    $agmarkup=($agentMarukup); 
                     

 
        
        
$finalclientcost=($_REQUEST['finalclientcost']+$insuranceAmount+$donateAmount);    


$balnceSheetAmt=($admarkup+$donateAmount+$insuranceAmount+$actCost['agentTotalFare'])-($actCost['agentTotalFare']-$actCost['totalFare']);

$a ='bookingId="'.$BookingId.'",bookingType="hotel",agentId="'.$AgentWebsiteData['id'].'",amount="'.round($_SESSION['balancesheetamount']).'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
addlistinggetlastid('sys_balanceSheet',$a); 

$agentcommission=round($roomIndexForDataArr['Price']['AgentCommission']);
    
 

	if($agentcommission>0){  
		
		
			
			$finalComm=($agentcommission*18/100);
		
		 $a ='bookingId="'.$BookingId.'",agentId="'.$AgentWebsiteData['id'].'",commission="'.$agentcommission.'",gst="'.$finalComm.'"';
		addlistinggetlastid('servicesGST',$a);
		
		
			
			 $a ='bookingId="'.($BookingId).'",bookingType="hotel_commision",agentId="'.$AgentWebsiteData['id'].'",amount="'.round($agentcommission-$finalComm).'",paymentType="Credit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
		addlistinggetlastid('sys_balanceSheet',$a);
		
		$agentFinalTDS=($agentcommission-$finalComm); 
		$agentFinalTDS=round($agentFinalTDS*$actCost['taxValuePerc']/100); 
		
		 $a ='bookingId="'.($BookingId).'",bookingType="hotel_GST",agentId="'.$AgentWebsiteData['id'].'",amount="'.$agentFinalTDS.'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
		addlistinggetlastid('sys_balanceSheet',$a);
		
		
			$tds=round($agentcommission*5/100);
		
				
		 $a ='bookingId="'.($BookingId).'",bookingType="hotelTDS",agentId="'.$AgentWebsiteData['id'].'",amount="'.round($tds).'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
		addlistinggetlastid('sys_balanceSheet',$a);
		
		 
		
			}


$a ='bookingId="'.$BookingId.'",bookingType="hotel",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.round($_SESSION['balancesheetamount']).'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
addlistinggetlastid('sys_balanceSheet',$a); 
 
  
  if($agentcommission>0){  
  
  
  
			$finalComm=($agentcommission*18/100); 
		
		 $a ='bookingId="'.$BookingId.'",agentId="'.$AgentWebsiteData['parentId'].'",commission="'.$agentcommission.'",gst="'.$finalComm.'"';
		addlistinggetlastid('servicesGST',$a);
		  
		  
			
			 $a ='bookingId="'.($BookingId).'",bookingType="hotel_commision",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.round($agentcommission-$finalComm).'",paymentType="Credit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
		addlistinggetlastid('sys_balanceSheet',$a);
		
		
		//-----------------------------------------
		
		 
		$agentFinalTDS=($agentcommission-$finalComm); 
		$agentFinalTDS=round($agentFinalTDS*5/100);  
		
		 
		
		 $a ='bookingId="'.($BookingId).'",bookingType="hotel_GST",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.$agentFinalTDS.'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
		//addlistinggetlastid('sys_balanceSheet',$a);
		 
		 
		 
		 	//-----------------------------------------
		 
		
			$tds=round($agentcommission*5/100); 
		
		
		 $a ='bookingId="'.($BookingId).'",bookingType="hotelTDS",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.round($tds).'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
		addlistinggetlastid('sys_balanceSheet',$a);
		
		 
		
	
		
			}
  
  	//-----------Markup to masteradmin--------------
		
		
		 $a ='bookingId="'.($BookingId).'",bookingType="hotelMarkup",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.round($agentMarukup).'",paymentType="Credit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
		addlistinggetlastid('sys_balanceSheet',$a);
		
		

 


 

}






?>

<script> 
 window.parent.location.href = "<?php echo $fullurl; ?>hotel-booking-confirmation?i=<?php echo base64_encode($BookingId); ?>"; 
</script>

<?php




if($BookingId==''){ ?>
<script>
//alert('Something Went Wrong. Please Try Again.');
//window.parent.location.href = "<?php echo $fullurl; ?>hotels"; 

</script>

<?php

exit();
}


} else { 
?>

<script> alert('Your account balance is low. Please recharge for continue to this booking.'); 
//window.parent.location.href = "<?php echo $fullurl; ?>"; 

</script>
<?php } ?>


 




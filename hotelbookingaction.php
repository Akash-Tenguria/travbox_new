<?php include "inc.php"; 
include "config/logincheck.php"; 
$agentid=$_SESSION['agentUserid'];
	
$aaa=GetPageRecord('*','hotelBookingMaster','id="'.$_POST['bookinglastId'].'" '); 
$actCost=mysqli_fetch_array($aaa);


if($totalwalletBalance>=$_SESSION['totalfaremain']){ } else { 

?>
<script> alert('Your account balance is low. Please recharge for continue to this booking.'); 
parent.$('#loadingwhite').hide();

</script>
<?php
exit();
die();
}


 
if(round($totalwalletBalanceParent)<$_SESSION['totalfaremain'] && round($totalwalletBalanceParent)!=$_SESSION['totalfaremain']){ 
	
 

?>
<script> alert('Your account balance is low. Please recharge for continue to this booking.'); 
parent.$('#loadingwhite').hide();

</script>
<?php
exit();
die();
 } else {
 

 
$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['parentAgentId'].'" '); 
$AgentWebsiteData=mysqli_fetch_array($rs);  

  
if(trim($_POST['action'])=='paxdetailaction'){
$HotelSearchDetails = trim($_POST['HotelSearchDetails']);
$HotelSearchArr = json_decode($HotelSearchDetails); 
//print_r($HotelSearchArr);

/*$hotelJsonData = trim($_POST['hotelJsonData']);
$hotelArr = json_decode($hotelJsonData); 

$RoomDetails = trim($_POST['RoomDetails']);
$RoomArr = json_decode($RoomDetails); 
*/

$guestname = trim($_POST['guestname']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$address = addslashes($_POST['address']);
$HotelReviewDataArr = json_decode($_POST['HotelReviewData']);
//print_r($HotelReviewDataArr);
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




 


	$n=1;
	$roomjson='';
	foreach($HotelSearchArr->RoomDetails as $roomData){
		
		$adult = 1;
		$adultJson = '';
		foreach($roomData->Adult as $adultData){
		$namevalue ='bookingTableId="'.$_POST['bookinglastId'].'",title="'.trim($_POST['titleAdt'.$n.$adult]).'",firstName="'.trim($_POST['firstNameAdt'.$n.$adult]).'",lastName="'.trim($_POST['lastNameAdt'.$n.$adult]).'",paxType="AD",roomNo="'.$n.'"';
		addlistinggetlastid('hotelBookingPaxDetailMaster',$namevalue); 
		
		$adultJson.= '{
					"fN": "'.trim($_POST['firstNameAdt'.$n.$adult]).'",
                    "lN": "'.trim($_POST['lastNameAdt'.$n.$adult]).'",
                    "ti": "'.trim($_POST['titleAdt'.$n.$adult]).'",
                    "pNum": "'.trim($_POST['passportAdt'.$n.$adult]).'",
                    "pt": "ADULT"
		},';
		
		$adult++;
		}
		
		
		
		$child = 1;
		$childJson = '';
		foreach($roomData->Child as $childData){
		$namevalue ='bookingTableId="'.$_POST['bookinglastId'].'",title="'.trim($_POST['titleChd'.$n.$child]).'",firstName="'.trim($_POST['firstNameChd'.$n.$child]).'",lastName="'.trim($_POST['lastNameChd'.$n.$child]).'",paxType="CH",roomNo="'.$n.'",ageChild="'.trim($_POST['ageChild'.$n.$child]).'"';
		addlistinggetlastid('hotelBookingPaxDetailMaster',$namevalue); 
		
		$childJson.= '{
					"fN": "'.trim($_POST['firstNameChd'.$n.$child]).'",
                    "lN": "'.trim($_POST['lastNameChd'.$n.$child]).'",
                    "ti": "'.trim($_POST['titleChd'.$n.$child]).'",
                    "pt": "CHILD"
		},';
		
		$child++;
		}
		
		$finalpaxJson = $adultJson.$childJson;
		$finalpaxJson = rtrim($finalpaxJson,',');
		$roomjson.= '{
            "travellerInfo": ['.$finalpaxJson.']
        },';
		
	$n++; 
	}

$offlineBooking=offlinehotel($actCost['HotelName']);


if($offlineBooking=='off'){
//logger('This is offline booking for hotel: ');
$status = 1;
$bookingNumber = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 8);
$bookingNumber = strtoupper($bookingNumber);
updatelisting('hotelBookingMaster','BookingNumber="'.$bookingNumber.'",status="'.$status.'",clientId="'.$clientId.'",agentId="'.$_SESSION['agentUserid'].'",bookingType=1,agentBookingType=0','id="'.$_POST['bookinglastId'].'"'); 
updatelisting('hotelBookingPaxDetailMaster','bookingNumber="'.$bookingNumber.'"','bookingTableId="'.$_POST['bookinglastId'].'"'); 
$BookingMessage = 'Booking Succesfull';

$bl=GetPageRecord('*','hotelBookingMaster','id="'.$_POST['bookinglastId'].'" '); 
$actCost=mysqli_fetch_array($bl);



$bloff=GetPageRecord('*','offlinehotelMaster','addBy="'.$AgentWebsiteData['parentId'].'" and (name="'.$actCost['HotelName'].'" or name="All")'); 
$offlinemoney=mysqli_fetch_array($bloff);

 

if($offlinemoney['id']>0){

$a ='bookingId="'.$bookinglastId.'",bookingType="Facilitating",agentId="'.$AgentWebsiteData['parentId'].'",amount="10",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
addlistinggetlastid('sys_balanceSheet',$a); 

$a ='bookingId="'.$bookinglastId.'",bookingType="Facilitating_GST",agentId="'.$AgentWebsiteData['parentId'].'",amount="1.80",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
addlistinggetlastid('sys_balanceSheet',$a); 

}



$a ='bookingId="'.$_POST['bookinglastId'].'",bookingType="hotel",agentId="'.($_SESSION['agentUserid']).'",amount="'.$actCost['baseFare'].'",paymentType="Debit",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$a);


if($actCost['agentCommision']>0){

 $a ='bookingId="'.$_POST['bookinglastId'].'",bookingType="hotel_commision",agentId="'.$_SESSION['agentUserid'].'",amount="'.$actCost['agentCommision'].'",paymentType="Credit",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$a);

 $a ='bookingId="'.$_POST['bookinglastId'].'",bookingType="hotel_GST",agentId="'.$_SESSION['agentUserid'].'",amount="'.$actCost['agentFinalGST'].'",paymentType="Debit",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$a);
 }

 
}else{
//logger('Inside online booking for hotel: ');
$url = ''.$tripjackhotelurl.'oms/v1/hotel/book';
$bookingNumber = $HotelReviewDataArr->bookingId;
$jsonPost = '{
    "bookingId": "'.$HotelReviewDataArr->bookingId.'",
    "roomTravellerInfo": ['.rtrim($roomjson,',').'],
    "deliveryInfo": {
        "emails": [
            "'.$email.'"
        ],
        "contacts": [
            "'.$phone.'"
        ],
        "code": [
            "+91"
        ]
    },
    "type": "'.$HotelReviewDataArr->hInfo->pt.'",
    "paymentInfos": [
        {
            "amount": '.$_POST['finalclientcost'].'
        }
    ]
}';




//echo '----------------------------------------';
//logger('JSON POST FOR HOTEL BOOKING: '.$jsonPost);

$result = getHotelApiData($url,$jsonPost,$hotelApiKey);
$bookingResult = json_decode($result);


//print_r($result);





//logger('Response return from hotel booking api: '.$result);

if($bookingResult->status->success=='true'){
$BookingMessage = 'Booking Succesfull';
$status = 2;

$detailurl = ''.$tripjackhotelurl.'hms/v1/hotel/booking-details';
$bookingDetailJson = '{
	"bookingId":"'.$HotelReviewDataArr->bookingId.'"
}';

//$resultDetails = getHotelApiData($detailurl,$bookingDetailJson,$hotelApiKey);
//logger('Booking Detail API Response Return: '.$resultDetails);



}else{
$BookingMessage = 'Booking Failed';
$status = 3;
}


updatelisting('hotelBookingMaster','BookingNumber="'.$bookingNumber.'",status="'.$status.'",clientId="'.$clientId.'",agentId="'.$_SESSION['agentUserid'].'",bookingType=0,agentBookingType=0','id="'.$_POST['bookinglastId'].'"'); 
updatelisting('hotelBookingPaxDetailMaster','bookingNumber="'.$bookingNumber.'"','bookingTableId="'.$_POST['bookinglastId'].'"'); 

$bl=GetPageRecord('*','hotelBookingMaster','id="'.$_POST['bookinglastId'].'" '); 
$actCost=mysqli_fetch_array($bl);


$a ='bookingId="'.$_POST['bookinglastId'].'",bookingType="hotel",agentId="'.($_SESSION['agentUserid']).'",amount="'.$actCost['clientTotalFare'].'",paymentType="Debit",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
addlistinggetlastid('sys_balanceSheet',$a);




$a ='bookingId="'.$_POST['bookinglastId'].'",bookingType="hotel",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.$actCost['clientTotalFare'].'",paymentType="Debit",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
addlistinggetlastid('sys_balanceSheet',$a);

?>
<script>
alert('Request: <?php echo $jsonPost; ?>');
alert('Response: <?php echo $result; ?>');
</script>
<?php
}
	
	
  
  	//-----------Markup to masteradmin--------------
		
		
		 $a ='bookingId="'.$_POST['bookinglastId'].'",bookingType="hotelMarkup",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.$actCost['agentMarkup'].'",paymentType="Credit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
		addlistinggetlastid('sys_balanceSheet',$a);
		
		
 
 
	
	
if($actCost['agentCommision']>0){

$a ='bookingId="'.$_POST['bookinglastId'].'",bookingType="hotel_commision",agentId="'.$_SESSION['agentUserid'].'",amount="'.$actCost['agentCommision'].'",paymentType="Credit",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
addlistinggetlastid('sys_balanceSheet',$a);

$a ='bookingId="'.$_POST['bookinglastId'].'",bookingType="hotel_GST",agentId="'.$_SESSION['agentUserid'].'",amount="'.$actCost['agentFinalGST'].'",paymentType="Debit",addedBy="'.$_SESSION['userid'].'",addDate="'.date('Y-m-d H:i:s').'",billType="hotel"';
addlistinggetlastid('sys_balanceSheet',$a);
}

}


unset($_SESSION['uniqueId']);
$_SESSION['uniqueId']='';


 

?>

<script>
   
  window.parent.location.href = "<?php echo $fullurl; ?>hotel-booking-confirmation?i=<?php echo encode($_POST['bookinglastId']); ?>"; 
</script>

<?php } ?>
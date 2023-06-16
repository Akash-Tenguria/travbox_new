<?php 
include "inc.php"; 
include "config/logincheck.php"; 


$randbookingid='OFF-'.rand(11111111,99999999);
$bookingMethod=trim($_REQUEST["bookingMethod"]);

unset($_SESSION["bookingData"]);

if($bookingMethod==0){
	
$uniqueSessionId=base64_encode(time());
$basefareret=0; 

$ab=GetPageRecord('*','wig_flight_json_bkp',' id="'.decode(decode($_REQUEST['flighttwo'])).'" and agentId="'.$_SESSION['agentUserid'].'"');
$resret=mysqli_fetch_array($ab);

$finalAgentTax=$res['agentMarkup'];


$retrunflightoffline=offlineflight($_SESSION['agentUserid'],$resret['FLIGHT_NAME'],$resret['PCC']);


if($resret['id']!=''){

$str_arr = explode (",", $resret['agfare']);   
$basefareret = explode ("=", $str_arr[2]); 
$basefareret = $basefareret[1];
 
 }



$a=GetPageRecord('*','wig_flight_json_bkp',' id="'.decode(decode($_REQUEST['flightone'])).'" and agentId="'.$_SESSION['agentUserid'].'"');
$res=mysqli_fetch_array($a);




$onewayflightoffline=offlineflight($_SESSION['agentUserid'],$res['FLIGHT_NAME'],$res['PCC']);
$onewayflightoffline=1;

$str_arr = explode (",", $res['agfare']);   
$basefare = explode ("=", $str_arr[2]); 



$discountPrice=0;
$cashbackPrice=0;

if($res['discountType']==1 && $res["couponType"]==1){
$discountPrice=$res['discount'];
}
if($res['discountType']==2 && $res["couponType"]==1){
$discountPrice=trim(($res['discount']*($basefare[1]+$basefareret))/100);
}

if($res['discountType']==1 && $res["couponType"]==2){
$cashbackPrice=$res['discount'];
}
if($res['discountType']==2 && $res["couponType"]==2){
$cashbackPrice=trim(($res['discount']*($basefare[1]+$basefareret))/100);
}

$totalPayableAmount=($basefare[1]+$basefareret)-$discountPrice;



if($_POST['flightone']!='' && $res['id']>0 && $res['id']!="" && $_POST['flightbooking']==1 && $totalwalletBalance>=$totalPayableAmount){
	
if($totalPayableAmount<900){
	exit();
}	
	
$bookingpro=1;
 
  
$adultmain=$_SESSION['ADT'];
$childmain=$_SESSION['CHD'];
$infantmain=$_SESSION['INF'];



$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['agentUserid'].'" '); 
$AgentWebsiteData=mysqli_fetch_array($rs);  


$bl=GetPageRecord('*','taxMaster','id=1 '); 
$taxData=mysqli_fetch_array($bl);

$source=$res['ORG_NAME'].'-'.$res['ORG_CODE'];
$destination=$res['DES_NAME'].'-'.$res['DES_CODE'];
$journeyDate=$res['DEP_DATE'];
$sector=$res['sector'];
$bookingDate=date('Y-m-d H:i:s');
$agentId=$_SESSION['agentUserid'];
$PCC=$res['FARE_TYPE'];
$flightName=$res['FLIGHT_NAME'];
$flightNo=$res['FLIGHT_NO'];
$arrivalTime=$res['ARRV_TIME'];
$arrivalDate=$res['ARRV_DATE'];
$departureTime=$res['DEP_TIME'];
$clientBaseFare=$res['DEP_TIME'];
$agentFixedMakup=$res['agentFixedMakup'];
$markup = '0';
$agentMarkup = '0';
$bookingType = '0'; 
if($res['F_CLASS']=='EC'){ $flightClass='Economy'; } else { $flightClass='Business'; } 
$arr=explode("|",unserialize(stripslashes($res['searchJson']))->FLIGHT_INFO);
$totalBaggage=str_replace(':',': ',str_replace(',',', ',str_replace('=',': ',$arr[2])));
$flightStop=$res['STOP'];
$agentCommision=$res['acom'];


	$clientFareOW = json_decode(taxBreakupFunc($res['clfare']));
	$bareFare = $clientFareOW->bareFare;
	$tax = $clientFareOW->tax;
	$totalFare = $clientFareOW->totalFare;
	
	//Price of admin fare onward flight
	$adminFareOW = json_decode(taxBreakupFunc($res['adfare']));
	$adminBaseFareOW = $adminFareOW->bareFare;
	$adminTaxOW = $adminFareOW->tax;
	$adminTotalOW = $adminFareOW->totalFare;
	
	//Price of agent fare onward flight
	$agentFareOW = json_decode(taxBreakupFunc($res['agfare']));
	$agentBaseFareOW = $agentFareOW->bareFare;
	$agentTaxOW = $agentFareOW->tax;
	$agentTotalOW = $agentFareOW->totalFare;
	
	
		if($taxData['applicableType']=='commission'){
		$agentFinalGST=(($_REQUEST['acom']*$taxData['valuePerc'])/100);
	}
	
	if($taxData['applicableType']=='totalfare'){
		$agentFinalGST=(($adminBaseFareOW*$taxData['valuePerc'])/100);
	}

  
//-------------------Booking Entry-------------------------  

  
  
$finalFlightname=$flightName; 
$finalFareTypename=$PCC; 
  
$namevalue ='uniqueSessionId="'.$uniqueSessionId.'",apiType="AK",source="'.$source.'",status=1,destination="'.$destination.'",journeyDate="'.$journeyDate.'",tripType="1",sector="'.$sector.'",bookingDate="'.$bookingDate.'",agentId="'.$agentId.'",bookingNumber="",pcc="'.$PCC.'",flightName="'.$flightName.'",flightNo="'.$flightNo.'",arrivalTime="'.$arrivalTime.'",arrivalDate="'.$arrivalDate.'",departureTime="'.$departureTime.'",clientBaseFare="'.$bareFare.'",clientTax="'.$tax.'",clientTotalFare="'.$totalFare.'",baseFare="'.$adminBaseFareOW.'",tax="'.$adminTaxOW.'",totalFare="'.$adminTotalOW.'",agentBaseFare="'.$agentBaseFareOW.'",agentTax="'.$agentTaxOW.'",agentTotalFare="'.$agentTotalOW.'",markup="'.$markup.'",agentMarkup="'.$agentMarkup.'",bookingType="'.$bookingType.'",flightClass="'.$flightClass.'",totalBaggage="'.$totalBaggage.'",flightStop="'.$flightStop.'",agentCommision="'.$agentCommision.'",taxApplicableType="'.$taxData['applicableType'].'",taxValuePerc="'.$taxData['valuePerc'].'",taxApplicableOn="'.$taxData['applicableOn'].'",agentFinalGST="'.$agentFinalGST.'",detailArray="'.addslashes($res['searchJson']).'",couponCode="'.$res['couponCode'].'",discountType="'.$res['discountType'].'",couponValue="'.$res['couponValue'].'",couponType="'.$res['couponType'].'",agentFixedMakup="'.$res['agentFixedMakup'].'"';  
$bookinglastId = addlistinggetlastid('flightBookingMaster',$namevalue); 
  
if($res["couponType"]==2){
$a11 ='agentId="'.$_SESSION['agentUserid'].'",amount="'.$cashbackPrice.'",remarks="Cashback offer",paymentMethod="Online",transactionId="'.encode($bookinglastId).'", paymentType="Credit",bookingId="'.encode($bookinglastId).'",bookingType="Flight",addedBy="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$a11);
}
    
//-------------------Booking Entry End-------------------------  
  
  
  
 
for ($adult = 0; $adult <= $adultmain; $adult++){  
$guestname=addslashes($_POST['firstNameAdt'.$adult]);
}


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





//-------------Adult-----------------
 
for ($adult = 0; $adult <= $adultmain; $adult++) { 
 
 if($_REQUEST['adtPassEx'.$adult]==''){
 $adtPassEx='1970-01-01';
 } else {
 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$adult]));
 }
 
 
 $namevalue ='BookingId="'.$bookinglastId.'",bookingNumber="'.$bookinglastId.'",title="'.trim($_POST['titleAdt'.$adult]).'",firstName="'.trim($_POST['firstNameAdt'.$adult]).'",lastName="'.trim($_POST['lastNameAdt'.$adult]).'",dob="'.date('Y-m-d',strtotime($_POST['dobAdt'.$adult])).'",nationality="'.trim($_POST['nationalityAdt'.$adult]).'",passportNumber="'.trim($_POST['passportNumberAdt'.$adult]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="adult"';
addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 


}


//-------------Child-----------------


for ($child = 0; $child <= $childmain; $child++) { 

 if($_REQUEST['adtPassEx'.$child]==''){
 $adtPassEx='1970-01-01';
 } else {
 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$child]));
 }


$namevalue ='BookingId="'.$bookinglastId.'",bookingNumber="'.$bookinglastId.'",title="'.trim($_POST['titleChd'.$child]).'",firstName="'.trim($_POST['firstNameChd'.$child]).'",lastName="'.trim($_POST['lastNameChd'.$child]).'",dob="'.date('Y-m-d',strtotime($_POST['dobChd'.$child])).'",nationality="'.trim($_POST['nationalityChd'.$child]).'",passportNumber="'.trim($_POST['passportNumberChd'.$child]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="child"';
addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 

 
}




//-------------Infant-----------------



for($infant = 0; $infant <= $infantmain; $infant++) { 


 if($_REQUEST['adtPassEx'.$infant]==''){
 $adtPassEx='1970-01-01';
 } else {
 $adtPassEx=date('Y-m-d',strtotime($_REQUEST['adtPassEx'.$infant]));
 }
 




$namevalue ='BookingId="'.$bookinglastId.'",bookingNumber="'.$bookinglastId.'",title="'.trim($_POST['titleInf'.$infant]).'",firstName="'.trim($_POST['firstNameInf'.$infant]).'",lastName="'.trim($_POST['lastNameInf'.$infant]).'",dob="'.date('Y-m-d',strtotime($_POST['dobInf'.$infant])).'",nationality="'.trim($_POST['nationalityInf'.$infant]).'",passportNumber="'.trim($_POST['passportNumberInf'.$infant]).'",passportExpiry="'.$adtPassEx.'",mobile="'.$phone.'",email="'.$email.'",addDate="'.date('Y-m-d h:i:s').'",paxType="infant"';
addlistinggetlastid('flightBookingPaxDetailMaster',$namevalue); 

}









$insuranceAmount=0;
   if($_REQUEST['addInsurance']==1){
   $insurance=addslashes(trim($_REQUEST['insurance']));
   $insuranceAmount=addslashes(trim($_REQUEST['insuranceAmount']));
   $insuranceDetails=addslashes(trim($_REQUEST['insuranceDetails']));
   }
   $donateAmount=0;
   if($_REQUEST['donate']==1){
	$donateDetails=addslashes(trim($_REQUEST['donateDetails']));
	$donateAmount=addslashes(trim($_REQUEST['donateAmount']));
	}
  
  $finalclientcost=($_REQUEST['finalclientcost']+$insuranceAmount+$donateAmount);
  

$bl=GetPageRecord('*','flightBookingMaster','id="'.$bookinglastId.'" '); 
$actCost=mysqli_fetch_array($bl);
  
$admarkup=($actCost['clientTotalFare']-$actCost['agentTotalFare']);
$agmarkup=($actCost['agentTotalFare']-$actCost['totalFare']);


$inv=GetPageRecord('*','flightBookingMaster',' 1 order by invoiceId desc'); 
$lastInv=mysqli_fetch_array($inv); 
$invoiceId=($lastInv['invoiceId']+1);

 
 
 
 
 
 
 
 
 
 
 	$adultgst=array();
	
 	for($adult=1; $adult<=$adultmain; $adult++){
		if($_POST['passportExpiryAdt'.$adult]!=''){
			$adtPassEx = changedDateFormat($_POST['passportExpiryAdt'.$adult]);
		}else{ 
			$adtPassEx = '1970-01-01';
			$adtPassjson = '';
		}

		 $ht_psng['title']= trim($_POST['titleAdt'.$adult]);
		 $ht_psng['first_name'] = trim($_POST['firstNameAdt'.$adult]);
		 $ht_psng['last_name'] = trim($_POST['lastNameAdt'.$adult]);

    	  $adultgst[]=$ht_psng;		
		
	  
	  
 
	}
	
	$childgst=array();
	for($child=1; $child<=$childmain; $child++){
		if($_POST['passportExpiryChd'.$child]!=''){
			$chdPassEx = changedDateFormat($_POST['passportExpiryChd'.$child]);
		}else{ 
			$chdPassEx = '1970-01-01';
			$chdPassjson = '';
		}
		
		 $ht_psng2['title']= trim($_POST['titleChd'.$child]);
		 $ht_psng2['first_name'] = trim($_POST['firstNameChd'.$child]);
		 $ht_psng2['last_name'] = trim($_POST['lastNameChd'.$child]);
    	 $childgst[]=$ht_psng2;		
	  
		
	}
	
	
	$infantgst=array();  
	for($infant=1; $infant<=$infantmain; $infant++){
		if($_POST['passportExpiryInf'.$infant]!=''){
			$infPassEx = changedDateFormat($_POST['passportExpiryInf'.$infant]);
		}else{ 
			$infPassEx = '1970-01-01';
			$infPassjson = '';
		}
		
		
		 $ht_psng3['title']= trim($_POST['titleInf'.$infant]);
		 $ht_psng3['first_name'] = trim($_POST['firstNameInf'.$infant]);
		 $ht_psng3['last_name'] = trim($_POST['lastNameInf'.$infant]);
		 $ht_psng3['travelling_with'] = '1';
		 $DateOfBirth = date("Y/m/d", strtotime($_POST['dobInf'.$infant]));
		 $ht_psng3['dob'] = $DateOfBirth;
    	 $infantgst[]=$ht_psng3;
		
	}
 
 
 
 
 //----------------------Booking Prosess-------------------------
 
 
    
 $data = unserialize(stripslashes($res['flightCheckData']));
  
 
 
 //logger('INSIDE bookinglastIdRet NULL CONDITION');
// echo "<pre>";

 
 
 
 if($onewayflightoffline==0){

  // Call GF API 
 $toalPax=$_SESSION['ADT']+$_SESSION['CHD'];
 $ticketid=$res['FIXEDID'];
 $opta = array( 

           "ticket_id" => $ticketid,
		   "total_pax" => $toalPax,
           "adult" => $_SESSION['ADT'],
           "child" => $_SESSION['CHD'],
           "infant" => $_SESSION['INF'],		   
		   
		   "adult_info" => $adultgst,
	       "child_info" => $childgst,
	       "infant_info" => $infantgst,
         );

         $req=str_replace('\/','/',json_encode($opta));
	     echo $req;
  // 
 
 
$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => 'https://omairiq.azurewebsites.net/login',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'POST',
CURLOPT_POSTFIELDS =>'{
 "Username":"9555202202",
"Password":"9800830000@api"

}',

  CURLOPT_HTTPHEADER => array(

    'api-key: NTMzNDUwMDpBSVJJUSBURVNUIEFQSToxODkxOTMwMDM1OTk2OlFRYjhLVjNFMW9UV05RY1NWL0VtcnNnb3dGV0o3SzJ1cVptbzJ1bFp1cEE9',

    'Content-Type: application/json'

  ),

));



$response = curl_exec($curl);
curl_close($curl);
$result=json_decode($response,true); 
$code= $result['user']['code'];
$access_token= $result['token'];
  
echo "<br>********Token***********<br>"; 
echo $access_token;
 
 //*****************************************//
$curl = curl_init();
curl_setopt_array($curl, array(

  CURLOPT_URL => 'https://omairiq.azurewebsites.net/book',
  CURLOPT_RETURNTRANSFER => true,

  CURLOPT_ENCODING => '',

  CURLOPT_MAXREDIRS => 10,

  CURLOPT_TIMEOUT => 0,

  CURLOPT_FOLLOWLOCATION => true,

  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

  CURLOPT_CUSTOMREQUEST => 'POST',

  CURLOPT_POSTFIELDS => $req,

  CURLOPT_HTTPHEADER => array(

    'api-key: NTMzNDUwMDpBSVJJUSBURVNUIEFQSToxODkxOTMwMDM1OTk2OlFRYjhLVjNFMW9UV05RY1NWL0VtcnNnb3dGV0o3SzJ1cVptbzJ1bFp1cEE9',

    'Authorization: '.$access_token.'',

    'Content-Type: application/json;charset=UTF-8',

    'Accept: application/json, text/plain'

  ),

));



$response = curl_exec($curl);
curl_close($curl);
$book_result=json_decode($response,true); 

file_put_contents("FLYTBOJSON/".$_SESSION['agentUserid']."_".date('Y-m-d:h:s')."_fixedAK_booking_results.txt",$response);

/*echo "<br>********book Result***********<br>"; 
echo "<pre>";
print_r($book_result);*/

$pnr='';
$status=0;
if(count($book_result)>0 && $book_result['booking_id']!='')
{

	$booking_id= $book_result['booking_id'];
  
########### API CALLING ##############

$curl = curl_init();
curl_setopt_array($curl, array(

  CURLOPT_URL => 'https://omairiq.azurewebsites.net/ticket?booking_id='.$booking_id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,

  CURLOPT_FOLLOWLOCATION => true,

  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

  CURLOPT_CUSTOMREQUEST => 'GET',

  CURLOPT_HTTPHEADER => array(

    'Authorization: '.$access_token.'',

   'api-key: NTMzNDUwMDpBSVJJUSBURVNUIEFQSToxODkxOTMwMDM1OTk2OlFRYjhLVjNFMW9UV05RY1NWL0VtcnNnb3dGV0o3SzJ1cVptbzJ1bFp1cEE9',

   'Content-Type: application/json;charset=UTF-8',

   'Accept: application/json, text/plain,'

  ),

));



$response = curl_exec($curl);
curl_close($curl);
$ticket_result=json_decode($response,true);   

//echo "<br>********Ticket Result***********<br>"; 
//echo "<pre>";
//print_r($ticket_result);

	if($ticket_result['data']['pnr']!='')
	{
		$pnr = $ticket_result['data']['pnr'];
		$status=2;
	}

}


// die; 

	//logger('JSON response returnfrom PNR BOOKING(PNR_CREATION): '.$response);
	$bookingNumber=1;
		$bookingNumber = $booking_id;
		
		} else {
		$bookingNumber=$randbookingid;
		}
		
		if($bookingNumber==''){
		$bookingNumber=$randbookingid;
		}
	
		
		if(trim($bookingNumber)==''){	?>
		<script>
alert('Something Went Wrong. Please Try Again.');
window.parent.location.href = "<?php echo $fullurl; ?>"; 
</script>
		
		<?php exit(); }
		
	if(trim($bookingNumber)!=''){	
			
			if($bookingNumber==1){
			$bookingNumber='';
			}
			
			
				if(trim($bookingNumber)!=''){	
					
					$companyName = trim($_POST['companyName']);
					
	 				//$status = 1;
					
					$insuranceAmount=0;
					$donateAmount=0;
					if($_REQUEST['addInsurance']==1){
					$insurance=addslashes(trim($_REQUEST['insurance']));
					$insuranceAmount=addslashes(trim($_REQUEST['insuranceAmount']));
					$insuranceDetails=addslashes(trim($_REQUEST['insuranceDetails']));
					}
					if($_REQUEST['donate']==1){
					$donateDetails=addslashes(trim($_REQUEST['donateDetails']));
					$donateAmount=addslashes(trim($_REQUEST['donateAmount']));
					}
					
					$bl=GetPageRecord('*','flightBookingMaster','id="'.$bookinglastId.'" '); 
					$actCost=mysqli_fetch_array($bl);
					
					
					if(round($totalwalletBalance)>$actCost['clientTotalFare']){
					
					
					
					$admarkup=($actCost['clientTotalFare']-$actCost['agentTotalFare']);
					$agmarkup=($actCost['agentTotalFare']-$actCost['totalFare']);
					
					
					$inv=GetPageRecord('*','flightBookingMaster',' 1 order by invoiceId desc'); 
					$lastInv=mysqli_fetch_array($inv); 
					$invoiceId=($lastInv['invoiceId']+1);
					
					$namevalue ='pnrNo="'.$pnr.'",bookingNumber="'.$bookingNumber.'",status="'.$status.'",clientId="'.$clientId.'",companyName="'.$companyName.'",gstNo="'.$gstNo.'",gstEmail="'.$gstEmail.'",insurance="'.$insurance.'",insuranceAmount="'.$insuranceAmount.'",donateAmount="'.$donateAmount.'",donateDetails="'.$donateDetails.'",invoiceId="'.$invoiceId.'",markup="'.$admarkup.'",agentMarkup="'.$agmarkup.'",insuranceDetails="'.$insuranceDetails.'",agentOffline="'.offlineflightifagentoffline($_SESSION['agentUserid'],$finalFlightname,$finalFareTypename).'"'; 
					
					$where='id="'.$bookinglastId.'" and tripType="1"';
					updatelisting('flightBookingMaster',$namevalue,$where); 
					updatelisting('flightBookingPaxDetailMaster','bookingNumber="'.$bookingNumber.'"','BookingId="'.$bookinglastId.'"'); 
		
		
$finalclientcost=($_REQUEST['finalclientcost']+$insuranceAmount+$donateAmount);	


$balnceSheetAmt=($admarkup+$donateAmount+$insuranceAmount+$actCost['agentTotalFare'])-($actCost['agentTotalFare']-$actCost['totalFare']);

$a ='bookingId="'.$bookinglastId.'",bookingType="flight",agentId="'.$AgentWebsiteData['id'].'",amount="'.$actCost['agentTotalFare'].'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$a); 
	
	if($actCost['agentCommision']>0){}
	
	
	
	if(offlineflightifagentoffline($_SESSION['agentUserid'],$finalFlightname,$finalFareTypename)==0){
	
	$a ='bookingId="'.$bookinglastId.'",bookingType="flight",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.$actCost['agentTotalFare'].'",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$a); 
	

		 $a ='bookingId="'.($bookinglastId).'",bookingType="Markup",agentId="'.$AgentWebsiteData['parentId'].'",amount="'.round($finalAgentTax).'",paymentType="Credit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';
		addlistinggetlastid('sys_balanceSheet',$a);
	
	
	} else { 
	 

$a ='bookingId="'.$bookinglastId.'",bookingType="Facilitating",agentId="'.$AgentWebsiteData['parentId'].'",amount="10",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$a); 

$a ='bookingId="'.$bookinglastId.'",bookingType="Facilitating_GST",agentId="'.$AgentWebsiteData['parentId'].'",amount="1.80",paymentType="Debit",addedBy="'.$AgentWebsiteData['id'].'",addDate="'.date('Y-m-d H:i:s').'"';
addlistinggetlastid('sys_balanceSheet',$a); 
 
	
	}
	
	
	
 

} 

				}
				
			
			 
		
			
	
	 
			
			}
		
			
}


		
deleteRecord('wig_flight_json_bkp','agentId="'.$_SESSION['agentUserid'].'" and uniqueSessionId="'.$_SESSION['uniqueSessionId'].'"');


if($bookingpro!=1){ ?>

<script>
alert('Something Went Wrong. Please Try Again.');
window.parent.location.href = "<?php echo $fullurl; ?>"; 
</script>


<?php 

exit(); 

}

?>



<script> 
window.parent.location.href = "<?php echo $fullurl; ?>flight-bookings"; 
</script>

<?php 

}

/*
else if($bookingMethod==1){

//Redirect to payment gateway 
$_SESSION["bookingData"]=$_POST;
$amount=decode(decode(addslashes($_POST["arq"])));
$namevalue ='agentId="'.$_SESSION['agentUserid'].'",parentAgentId="'.$_SESSION['parentAgentId'].'",agentUsername="'.$_SESSION['agentUsername'].'",parentid="'.$_SESSION['parentid'].'",amount="'.$amount.'",note="Online Flight Book",data="'.addslashes(serialize($_POST)).'",status="pending",dateAdded="'.date("Y-m-d H:i:s").'"';
$txnID = addlistinggetlastid('onlineFlightBook',$namevalue);
$floatValue = number_format((float)$amount, 2, '.', '');  // return float
?>

<script>
window.location.href="<?php echo $fullurl; ?>test.php";
</script>

<?php } */ ?>
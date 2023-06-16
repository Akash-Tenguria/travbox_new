<?php
include "config/database.php";
ini_set('max_execution_time', '300'); //300 seconds = 5 minutes 
include "config/function.php";
include "config/setting.php";
include "agenturlinc.php";
include "flight_setting.php";



$a=GetPageRecord('*','sys_companyMaster','id=1 ');  
$companyProfileData=mysqli_fetch_array($a); 

 
 
$defaultEmail='mohd.m.imran@gmail.com';
$agentid=$_SESSION['parentAgentId'];  
$webagentid=$_SESSION['parentAgentId'];
$hotelApiKey = '710761800c1ff0ed-f1ec-4ca1-abea-8de4d3aeb7bd';
//$hotelApiKey = '';
$tripjackhotelurl='https://api.tripjack.com/';
   
  
$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['agentUserid'].'"'); 
$LoginParentId=mysqli_fetch_array($rs); 

$virtualAcc=GetPageRecord('*','userVirtualAccountDetails','userId="'.$LoginParentId["id"].'"'); 
$virtualAccData=mysqli_fetch_array($virtualAcc); 
   
$_SESSION['commissionType']=$LoginParentId['commissionType'];
  
$ase=GetPageRecord('*','sys_companyMaster','id=1'); 
$adminData=mysqli_fetch_array($ase); 


$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['agentUserid'].'" and email="'.$_SESSION['agentUsername'].'" and parentId="'.$_SESSION['parentid'].'"'); 
$LoginUserDetails=mysqli_fetch_array($rs); 

 

$rst=GetPageRecord('*','sys_userMaster','id="'.$LoginParentId['salesManager'].'" '); 
$acountmanager=mysqli_fetch_array($rst); 

  
$rs2=GetPageRecord('*','sys_companyMaster','userId="'.$_SESSION['parentid'].'"'); 
$LoginUserCompanyDetails=mysqli_fetch_array($rs2); 
  
 
$rs2=GetPageRecord('*','sys_userMaster','parentAgentId="'.$_SESSION['agentUserid'].'"'); 
$LoginUserCompanyDetailslogo=mysqli_fetch_array($rs2); 
   
  
$rs3=GetPageRecord('*','sys_branchMaster','userId="'.$LoginUserDetails['branchId'].'"'); 
$LoginUserBranchDetails=mysqli_fetch_array($rs3);



$rs35=GetPageRecord('*','sys_commissionType','id="'.$LoginUserDetails['commissionType'].'"'); 
$getcommitypename=mysqli_fetch_array($rs35);




date_default_timezone_set('Asia/Calcutta');

function formatOffset($offset) {
        $hours = $offset / 3600;
        $remainder = $offset % 3600;
        $sign = $hours > 0 ? '+' : '-';
        $hour = (int) abs($hours);
        $minutes = (int) abs($remainder / 60);

        if ($hour == 0 AND $minutes == 0) {
            $sign = ' ';
        }
        return $sign . str_pad($hour, 2, '0', STR_PAD_LEFT) .':'. str_pad($minutes,2, '0');

}


function showdatetimesimple($datetime){
return date('d/m/Y - h:i A',strtotime($datetime));
}


function queryreplacetags($id,$content){

$a=GetPageRecord('*','queryMaster',' parentId="'.$_SESSION['parentid'].'" and id="'.$id.'"'); 
$res=mysqli_fetch_array($a);

$a=GetPageRecord('*','clientMaster',' parentId="'.$_SESSION['parentid'].'" and id="'.$res['clientId'].'"'); 
$clientInfo=mysqli_fetch_array($a);

$a=GetPageRecord('*','sys_userMaster',' parentId="'.$_SESSION['parentid'].'" and id="'.$res['assignTo'].'"'); 
$userInfo=mysqli_fetch_array($a);

$rs2=GetPageRecord('*','sys_companyMaster','userId="'.$_SESSION['parentid'].'"'); 
$companyInfo=mysqli_fetch_array($rs2); 

$content=str_replace('#company_name#',stripslashes($companyInfo['companyName']),$content);
$content=str_replace('#customer_name#',stripslashes($clientInfo['nameHead'].' '.$clientInfo['name']),$content);
return $content=str_replace('#user_name#',stripslashes($userInfo['name']),$content);

}



function getquerycloserReasons($id){

$a=GetPageRecord('*','sys_queryClosureReasons',' parentId="'.$_SESSION['parentid'].'" and id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']);

}


function currencyname($id){

$a=GetPageRecord('*','apiCurrencyMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']);

}

function roomCategory($id){

$a=GetPageRecord('*','sys_roomCategory',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']);

}


function cruiseSeatName($id){

$a=GetPageRecord('*','sys_CruiseSeatMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']);

}



function hotelcategory($id){

if($id==1){ 
$star='<i class="fa fa-star" aria-hidden="true"></i>';
}
if($id==2){ 
$star='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
}
if($id==3){ 
$star='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
}
if($id==4){ 
$star='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
}
if($id==5){ 
$star='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
}
if($id==6){ 
$star='<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>';
}

$a=GetPageRecord('*','sys_hotelCategory',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return ' ('.stripslashes($res['name']).')';

//return $star;
}


function getnationality($id){

$a=GetPageRecord('*','sys_nationalityMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['nationality']);

}


function closetags($html) {
    preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
    $openedtags = $result[1];
    preg_match_all('#</([a-z]+)>#iU', $html, $result);
    $closedtags = $result[1];
    $len_opened = count($openedtags);
    if (count($closedtags) == $len_opened) {
        return $html;
    }
    $openedtags = array_reverse($openedtags);
    for ($i=0; $i < $len_opened; $i++) {
        if (!in_array($openedtags[$i], $closedtags)) {
            $html .= '</'.$openedtags[$i].'>';
        } else {
            unset($closedtags[array_search($openedtags[$i], $closedtags)]);
        }
    }
    return $html;
} 


function seo_friendly_url($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
    return strtolower(trim($string, '-'));
}












function quotationreplacetags($id,$content,$quotationURL){

$ab=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['parentid'].'" and id="'.$id.'"'); 
$resQuoation=mysqli_fetch_array($ab);

$a=GetPageRecord('*','queryMaster',' parentId="'.$_SESSION['parentid'].'" and id="'.$resQuoation['queryId'].'"'); 
$res=mysqli_fetch_array($a);

$a=GetPageRecord('*','clientMaster',' parentId="'.$_SESSION['parentid'].'" and id="'.$res['clientId'].'"'); 
$clientInfo=mysqli_fetch_array($a);

$a=GetPageRecord('*','sys_userMaster',' parentId="'.$_SESSION['parentid'].'" and id="'.$_SESSION['agentUserid'].'"'); 
$userInfo=mysqli_fetch_array($a);

$rs2=GetPageRecord('*','sys_companyMaster','userId="'.$_SESSION['parentid'].'"'); 
$companyInfo=mysqli_fetch_array($rs2); 

$quotation_url_replace=$quotationURL;

$content=str_replace('#company_name#',stripslashes($companyInfo['companyName']),$content);
$content=str_replace('#customer_name#',stripslashes($clientInfo['nameHead'].' '.$clientInfo['name']),$content);
$content=str_replace('#user_signature#',stripslashes($userInfo['userSignature']),$content);
$content=str_replace('#quotation_id#','QT'.encode($resQuoation['id']),$content);
$content=str_replace('#user_name#',stripslashes($userInfo['name']),$content);
return $content=str_replace('#quotation_url#',$quotation_url_replace,$content);

}



function getpackagethemename($id){

$a=GetPageRecord('*','sys_packageTheme',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']);

}


function dateDifference($start_date, $end_date)
{ 
    $diff = strtotime($start_date) - strtotime($end_date); 
    return ceil(abs($diff / 86400));
}


function getdestinationname($id){

$a=GetPageRecord('*','sys_destinationMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']);

}

function gethotelcategorytype($id){

$a=GetPageRecord('*','sys_hotelCategory',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']); 
}



function gethotelroomtype($id){
if($id!=''){
$a=GetPageRecord('*','sys_roomTypeMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']); 
}}

function gethotelmealplan($id){

$a=GetPageRecord('*','sys_mealPlanMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']); 
}

function gethotelextra($id){

$a=GetPageRecord('*','sys_extraMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']); 
}

function getactivityname($id){

$a=GetPageRecord('*','activityMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']); 
}

function vehiclename($id){ 
$a=GetPageRecord('*','sys_vehicleMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']); 
}

function vehiclenamepax($id){ 
$a=GetPageRecord('*','sys_vehicleMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['pax']); 
}

function crusename($id){ 
$a=GetPageRecord('*','cruseMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name']); 
}


function getdestinationnamewithlocation($id){
if($id!=''){
$a=GetPageRecord('*','sys_destinationMaster',' id="'.$id.'"'); 
$res=mysqli_fetch_array($a); 
return stripslashes($res['name'].', '.$res['destination']);
}
}

 

$totalwalletBalance=0;
$totalwalletBalanceOffline=0;
if($_SESSION['agentUserid']!='' && $_SESSION['agentUserid']>0){
$rs8=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet','agentId="'.$_SESSION['agentUserid'].'" and paymentType="Credit" and offlineAgent=0 '); 
$agentCreditAmt=mysqli_fetch_array($rs8); 

$rs8=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','agentId="'.$_SESSION['agentUserid'].'" and paymentType="Debit" and offlineAgent=0 '); 
$agentDebitAmt=mysqli_fetch_array($rs8); 

$totalwalletBalance=($agentCreditAmt['totalcreditAmt']-$agentDebitAmt['totaldebitAmt']);

//-------------------Parent Balance----------------------


$rs8=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet',' agentId="'.$_SESSION['parentid'].'" and paymentType="Credit" and offlineAgent=0 '); 
$agentCreditAmtParent=mysqli_fetch_array($rs8); 

$rs8=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet',' agentId="'.$_SESSION['parentid'].'" and paymentType="Debit" and offlineAgent=0 '); 
$agentDebitAmtParent=mysqli_fetch_array($rs8); 

$totalwalletBalanceParent=($agentCreditAmtParent['totalcreditAmt']-$agentDebitAmtParent['totaldebitAmt']);


//-------------------Parent Balance----------------------



//Offline Balance
$rs_offlineCrd=GetPageRecord('SUM(amount) as totalcreditAmt','sys_balanceSheet','agentId="'.$_SESSION['agentUserid'].'" and paymentType="Credit" and offlineAgent=1 '); 
$agentCreditAmtOffline=mysqli_fetch_array($rs_offlineCrd); 

$rs_offlineDbt=GetPageRecord('SUM(amount) as totaldebitAmt','sys_balanceSheet','agentId="'.$_SESSION['agentUserid'].'" and paymentType="Debit" and offlineAgent=1 '); 
$agentDebitAmtOffline=mysqli_fetch_array($rs_offlineDbt); 
$totalwalletBalanceOffline=($agentCreditAmtOffline['totalcreditAmt']-$agentDebitAmtOffline['totaldebitAmt']);



$rs1=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['agentUserid'].'" and userType="agent" '); 
$AgentProfileData=mysqli_fetch_array($rs1); 
}

function getHotelApiData($url,$jsonPost,$apiKey){
    $crl = curl_init($url);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($crl, CURLINFO_HEADER_OUT, true);
    curl_setopt($crl, CURLOPT_POST, true);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $jsonPost);
    
    // Set HTTP Header for POST request 
    curl_setopt($crl, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'APIkey: ' . $apiKey));
    
    // Submit the POST request
    return $result = curl_exec($crl);
    curl_close($crl);
}
 

function bannerBox($bannertype,$agentid,$url){ 
$rs1=GetPageRecord('*','agentBannerMaster','agentId="'.$agentid.'" and bannerType="'.$bannertype.'" order by id rand()'); 
$res=mysqli_fetch_array($rs1);  

if($res['id']!=''){  
return '<a href="'.$res['bannerURL'].'" target"_blank"><img src="'.$url.$res['bannerImage'].'"/></a>'; 
}

}

function convertToHoursMins($time) {
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    $final = $hours.':'.$minutes;
   // return sprintf($format, $hours, $minutes);
   return date('h:i A',strtotime($final));
}
 
 
  function makeFlightTime($duration){

	$hours = floor($duration / 60);
	$min = $duration - ($hours * 60);
	
	return $hours." H :".$min." M";

}
 
 
/* function makeFlightTime($val){

$finalreturn='';

$arr = explode(':',$val);
$day = $arr[0];
$hrs = $arr[1];
$time = $arr[2];

$daym = preg_replace('/[^0-9]/', '', $day);
 
if($daym>0){ $finalreturn.=$daym.'d'; } 

$hrsm = preg_replace('/[^0-9]/', '', $hrs);
if($hrsm>0){ $finalreturn.=' '.$hrsm.'h'; } 

$timem = preg_replace('/[^0-9]/', '', $time);
if($timem>0){ $finalreturn.=' '.$timem.'m'; } 

return $finalreturn;

}*/


function checkifvalue($stringvalue,$selectvalue){
$a = explode(',',$stringvalue);
if (in_array($selectvalue, $a)) {
  echo "checked";
} 
}

function countrynametoflag($name){
if (strpos($name, ' ') !== false) {
$name=explode(" ",$name);
$namefirst=$name[0];
$namelast=$name[1];

$name=strtolower(substr($namefirst,0,1).substr($namelast,0,1));
} else {
$name=strtolower(substr($name,0,2));
}

if($name!=''){
if (file_exists(''.$fullurl.'flags/1x1/'.$name.'.svg')) {
return 'flags/1x1/'.$name.'.svg';
}
 }
}

 


function sendtickettomail($url,$tid){

$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($tid).'" '); 
$editresult=mysqli_fetch_array($a); 

$a=GetPageRecord('*','sys_userMaster','id=1 ');  
$invoiceData=mysqli_fetch_array($a); 

$subject = 'Booking Status - '.$tid.'';

$rs=GetPageRecord('*','sys_userMaster','id="'.$editresult['agentId'].'"'); 
$LoginParentId=mysqli_fetch_array($rs); 

 //$url.'download_ticket.php?id='.$tid;
//exit();
 $mailbody=file_get_contents($url.'download_ticket.php?id='.$tid.'&mail=1'); 
 
 sendmainmail($LoginParentId['email'],$subject,$mailbody);
}



//------------------Hotel Ticket Mail-----------------------




function sendhoteltickettomail($url,$tid){

$a=GetPageRecord('*','hotelBookingMaster',' BookingNumber="'.base64_decode($tid).'" '); 
$editresult=mysqli_fetch_array($a); 

$a=GetPageRecord('*','sys_userMaster','id=1 ');  
$invoiceData=mysqli_fetch_array($a); 

$subject = 'Booking Status - '.$editresult['BookingNumber'].'';

$rs=GetPageRecord('*','sys_userMaster','id="'.$editresult['agentId'].'"'); 
$LoginParentId=mysqli_fetch_array($rs);

 

 //$url.'download_ticket.php?id='.$tid;
//exit();
 $mailbody=file_get_contents($url.'hotel-voucher.php?i='.$tid.'&mail=1'); 
 
 sendmainmail($LoginParentId['email'],$subject,$mailbody);
}

//------------------Bus Ticket Mail-----------------------

 
function sendbustickettomail($url,$tid){

$a=GetPageRecord('*','busbookingMaster',' id="'.base64_decode($tid).'" '); 
$editresult=mysqli_fetch_array($a); 

$a=GetPageRecord('*','sys_userMaster','id=1 ');  
$invoiceData=mysqli_fetch_array($a); 

$subject = 'Booking Status - '.$editresult['ticket_no'].'';

$rs=GetPageRecord('*','sys_userMaster','id="'.$editresult['agentUserid'].'"'); 
$LoginParentId=mysqli_fetch_array($rs); 

 //$url.'download_ticket.php?id='.$tid;
//exit();
 $mailbody=file_get_contents($url.'bus-ticket.php?i='.$tid.'&mail=1'); 
 
 sendmainmail($LoginParentId['email'],$subject,$mailbody);
}









function dateDiff($date1, $date2)

{



    $date1_ts = strtotime(date("Y-m-d",strtotime($date1)));

    $date2_ts = strtotime(date("Y-m-d",strtotime($date2)));

    $diff = $date2_ts - $date1_ts;

    $diff=round($diff / 86400);

	if($diff==1){

		return $diff;

	}else{

		return $diff+1;

	}

}


function sendSMS($mobile,$msg){	
	file_get_contents('http://mobile.itinfosystem.com/api2/send/?username=munir@travelocar.com&hash=Munir@123&numbers='.$mobile.'&sender=TROCAR&message='.str_replace(' ','%20',$msg).'');
}




function nightDiff($date1, $date2)

{



    $date1_ts = strtotime(date("Y-m-d",strtotime($date1)));

    $date2_ts = strtotime(date("Y-m-d",strtotime($date2)));

    $diff = $date2_ts - $date1_ts;

    return round($diff / 86400);

}


function inWords($data){
	$number = ceil($data);
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'ONE', '2' => 'TWO',
    '3' => 'THREE', '4' => 'FOUR', '5' => 'FIVE', '6' => 'SIX',
    '7' => 'SEVEN', '8' => 'EIGHT', '9' => 'NINE',
    '10' => 'TEN', '11' => 'ELEVEN', '12' => 'TWELVE',
    '13' => 'THIRTEEN', '14' => 'FOURTEEN',
    '15' => 'FIFTEEN', '16' => 'SIXTEEN', '17' => 'SEVENTEEN',
    '18' => 'EIGHTEEN', '19' =>'NINETEEN', '20' => 'TWENTY',
    '30' => 'THIRTY', '40' => 'FORTY', '50' => 'FIFTY',
    '60' => 'SIXTY', '70' => 'SEVENTY',
    '80' => 'EIGHTY', '90' => 'NINETY');
   $digits = array('', 'HUNDRED', 'THOUSAND', 'LAKH', 'CRORE');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? ' ' : null;
        $hundred = ($counter == 1 && $str[0]) ? '  ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
		  
		  return $result . "Rupees  " . $points;
}





function getCabContent($id){

$a=GetPageRecord('name','cab_content','id="'.$id.'"'); 

$displayData=mysqli_fetch_array($a);

return $displayData['name'];

}


function hotelimage($cityId,$hotelCode)
{

	$ahotlepic=GetPageRecord('hotelPicture','hotel_data_tbo','cityId="'.$cityId.'" and hotelCode="'.$hotelCode.'"'); 
	$displayData=mysqli_fetch_array($ahotlepic);
	return $displayData['hotelPicture'];

}


 
?>





<?php
date_default_timezone_set('Asia/Calcutta');

function currency_converter($OldCurrVal,$NewCurrVal,$OldPrice){					
	$OldPriceINR = $OldCurrVal * $OldPrice; //Price in INR
	$INR = 1/$NewCurrVal; //convert New old value in INR 
	$NewValue =$OldPriceINR * $INR;
	return $NewValue;
}
function getChangeCurrencyValue_New($oldCurId,$newCurId,$OldPrice){

	if($oldCurId!=''){  
		$selectaa='currencyValue';   
		$whereaa='id="'.$oldCurId.'"'; 
		$rsaa=GetPageRecord($selectaa,_QUERY_CURRENCY_MASTER_,$whereaa); 
		$userss=mysqli_fetch_array($rsaa);  
		$OldCurrVal= $userss['currencyValue'];
	}
	if($newCurId!=''){  
		$selectaa='currencyValue';   
		$whereaa='id="'.$newCurId.'"'; 
		$rsaa=GetPageRecord($selectaa,_QUERY_CURRENCY_MASTER_,$whereaa); 
		$userss=mysqli_fetch_array($rsaa);  
		$NewCurrVal= $userss['currencyValue'];
	}

	// $NewValue = currency_converter($OldCurrVal,$NewCurrVal,$OldPrice)
	$OldPriceINR = $OldCurrVal * $OldPrice; //Price in INR
	$INR = 1/$NewCurrVal; //convert New old value in INR 
	$NewValue =$OldPriceINR * $INR;
	return $NewValue;
}
function getTwoDecimalNumberFormat($value){
 	$values=number_format((float)$value, 2, '.', '');
	return  $values;
}
function showStarrating($id){ 
if($id==7){ 
return 'starh2.png';
}
if($id==6){ 
return 'starh5.png';
}


if($id==8){ 
return 'starh5.png';
}
if($id==5){ 
return 'starh5.png';
}
if($id==4){ 
return 'starh4.png';
}
if($id==3){ 
return 'starh3.png';
}
if($id==2){ 
return 'starh2.png';
}
if($id==1){ 
return 'starh1.png';
}

}




function packageshowStarrating($id){ 
if($id==4){ 
return 'starh4.png';
}
if($id==2){ 
return 'starh2.png';
}
if($id==5){ 
return 'starh5.png';
}

if($id==3){ 
return 'starh3.png';
}

if($id==1){ 
return 'starh1.png';
}
}


function showClientType($type){
if($type==1){
return 'Account';
}
if($type==2){
return 'Contact';
}
}

function showClientTypeUserName($type,$id){

if($type==1){
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,_CORPORATE_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['name'];
}
}



if($type==2){
$selectaa='firstName,lastName';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,_CONTACT_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['firstName'].' '.$userss['lastName'];
}
}

}

function getPrimaryNameCompany($id,$sectionType){  
if($id!=''){ 
$selectaa='contactPerson';   
$whereaa='corporateId="'.$id.'" and deletestatus=0 order by id asc'; 
$rsaa=GetPageRecord($selectaa,'contactPersonMaster',$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['contactPerson'];
}
}
}

function getPrimaryEmailCompany($id,$sectionType){  
if($id!=''){ 
$selectaa='email';   
$whereaa='corporateId="'.$id.'" and deletestatus=0 order by id asc'; 
$rsaa=GetPageRecord($selectaa,'contactPersonMaster',$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['email'];
}
}
}

 function makePackageId($id){ 
 if($id!=''){   
 return str_pad($id, 6, '0', STR_PAD_LEFT); 
 }
 }
 
 
 
function showClientTypeUserNameWithLink($type,$id){

if($type==1){
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,_CORPORATE_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return '<a href="showpage.crm?module=corporate&view=yes&id='.encode($id).'" target="_blank" class="maintablist">'.$userss['name'].'</a>';
}
}



if($type==2){
$selectaa='firstName,lastName';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,_CONTACT_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return '<a href="showpage.crm?module=contacts&view=yes&id='.encode($id).'" target="_blank" class="maintablist">'.$userss['firstName'].' '.$userss['lastName'].'</a>';
}
}

}

function getdestinatinationname($id){

if($id!=''){
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,'destinationMaster',$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return stripslashes($userss['name']);
}
}
}



function getservicetypename($id){

if($id!=''){
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,'serviceType',$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return stripslashes($userss['name']);
}
}
}


function formatBytes($bytes, $precision = 2) {
if($bytes!='0'){
    if ($bytes > pow(1024,3)) return round($bytes / pow(1024,3), $precision)." GB";
    else if ($bytes > pow(1024,2)) return round($bytes / pow(1024,2), $precision)." MB";
    else if ($bytes > 1024) return round($bytes / 1024, $precision)." KB";
    else return ($bytes)." B";
} else {

return '0';
}
}

function getFileIcon($filetype){

$mainfile='images/filetype/fileunknown.png';
if($filetype=='png'){
$mainfile='images/filetype/filepng.png';
}
if($filetype=='docx'){
$mainfile='images/filetype/filedoc.png';
}

if($filetype=='xls'){
$mainfile='images/filetype/filexls.png';
}

if($filetype=='psd'){
$mainfile='images/filetype/filepsd.png';
}

if($filetype=='ppt'){
$mainfile='images/filetype/fileppt.png';
}

if($filetype=='pdf'){
$mainfile='images/filetype/filepdf.png';
}

if($filetype=='mp4'){
$mainfile='images/filetype/filemp4.png';
}

if($filetype=='jpg'){
$mainfile='images/filetype/filejpeg.png';
}
if($filetype=='html'){
$mainfile='images/filetype/filehtml.png';
}

if($filetype=='zip'){
$mainfile='images/filetype/filezip.png';
}

return $mainfile;
}





function getRoomType($id){ 
if($id!=''){  
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,_ROOM_TYPE_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['name'];
}
}
}






function countQueryunreadMails($id){ 
if($id!=''){
$result =mysqli_query (db(),"select id from "._QUERYMAILS_MASTER_." where queryid='".clean($id)."' and description!='' and status=1")  or die(mysqli_error());
$number =mysqli_num_rows($result);  
return $number;
}
}


function micecountQueryunreadMails($id){ 
if($id!=''){
$result =mysqli_query (db(),"select id from maicemails where queryid='".clean($id)."' and description!='' and status=1")  or die(mysqli_error());
$number =mysqli_num_rows($result);  
return $number;
}
}



function makeQueryId($id){ 
if($id!=''){   
return str_pad($id, 6, '0', STR_PAD_LEFT); 
}
}

function makeQueryDisplayId($id){ 
if($id!=''){    
$select22='displayId';  
$where22='id="'.$id.'" '; 
$rs22=GetPageRecord($select22,_QUERY_MASTER_,$where22); 
$requesetdata=mysqli_fetch_array($rs22);  

return str_pad($requesetdata['displayId'], 6, '0', STR_PAD_LEFT); 
}
}



function makeInvoiceId($id){ 
if($id!=''){   
return str_pad($id, 6, '0', STR_PAD_LEFT); 
}
}

function makePaymentId($id){ 
if($id!=''){   
return str_pad($id, 6, '0', STR_PAD_LEFT); 
}
}


function getCorporateCompany($id){ 
if($id!=''){  
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,_CORPORATE_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['name'];
}
}
}




function getsupplierCompany($id){ 
if($id!=''){  
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,_SUPPLIERS_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['name'];
}
}
}


function getDestination($id){ 
if($id!=''){  
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,'cityMaster',$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['name'];
}
}
}


function getsectionstatus($status){

if($status==1){
return '<span class="badge badge-success">Active</span>';
}
if($status==0){
return '<span class="badge badge-secondary">Inactive</span>';
}

}

function getDesignation($id){ 
if($id!=''){  
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,_DESIGNATION_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['name'];
}
}
}



function getNameTitle($id){ 
if($id!=''){  
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,_NAME_TITLE_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['name'];
}
}
}


function getsuppliersType($id){ 
if($id!=''){  
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,_SUPPLIERS_TYPE_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['name'];
}
}
}




function getsuppliersTypeNameList($id){ 
if($id!=''){  
$type='';
$selectaa='*';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,_SUPPLIERS_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){   

$selectaa2='name';   
$whereaa2='id="'.$userss['companyTypeId'].'"'; 
$rsaa2=GetPageRecord($selectaa2,_SUPPLIERS_TYPE_MASTER_,$whereaa2); 
while($userss2=mysqli_fetch_array($rsaa2)){  
$type=$userss2['name'].', '.$type;
}

$selectaa2='name';   
$whereaa2='id="'.$userss['airlinesType'].'"'; 
$rsaa2=GetPageRecord($selectaa2,_SUPPLIERS_TYPE_MASTER_,$whereaa2); 
while($userss2=mysqli_fetch_array($rsaa2)){  
$type=$userss2['name'].', '.$type;
}

$selectaa2='name';   
$whereaa2='id="'.$userss['transferType'].'"'; 
$rsaa2=GetPageRecord($selectaa2,_SUPPLIERS_TYPE_MASTER_,$whereaa2); 
while($userss2=mysqli_fetch_array($rsaa2)){  
$type=$userss2['name'].', '.$type;
}

$selectaa2='name';   
$whereaa2='id="'.$userss['sightseeingType'].'"'; 
$rsaa2=GetPageRecord($selectaa2,_SUPPLIERS_TYPE_MASTER_,$whereaa2); 
while($userss2=mysqli_fetch_array($rsaa2)){  
$type=$userss2['name'].', '.$type;
}
$selectaac='name';   
$whereaac='id="'.$userss['cruiseType'].'"'; 
$rsaac=GetPageRecord($selectaac,_SUPPLIERS_TYPE_MASTER_,$whereaac); 
while($userssc=mysqli_fetch_array($rsaac)){  
$type=$userssc['name'].', '.$type;
}
}
 return ltrim(rtrim($type,', '),',');
}
}




function getUserName($id){ 
if($id!=''){  
$selectaa='*';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,'sys_userMaster',$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return stripslashes($userss['name']);
}
}
}

 

function getcountry($id){ 
if($id!=''){ 
$selectaa='countryId';   
$whereaa='addressParent="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,_ADDRESS_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
$c_country_id = $userss['countryId'];
}
return getCountryName($c_country_id);
}
}
function getCountryName($id){
if($id!=''){   
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,'countryMaster',$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['name'];
}
}
}

function getStateName($id){
if($id!=''){   
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,'stateMaster',$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['name'];
}
}
}

function getstate($id){
if($id!=''){   
$selectaa='stateId';   
$whereaa='addressParent="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,_ADDRESS_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
$c_state_id = $userss['stateId'];
}
return getStateName($c_state_id);
}
}


function getCityName($id){  
if($id!=''){ 
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,'cityMaster',$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['name'];
}
}
}

function getCurrencyName($id){  
if($id!=''){ 
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,'apiCurrencyMaster',$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['name'];
}
}
}


function getcity($id){  
if($id!=''){ 
$selectcaa='cityId';   
$wherecaa='addressParent="'.$id.'"'; 
$rscaa=GetPageRecord($selectcaa,_ADDRESS_MASTER_,$wherecaa); 
while($usercss=mysqli_fetch_array($rscaa)){  
$c_id = $usercss['cityId'];
}
 return getCityName($c_id);
}
}



function getPhoneType($id){  
if($id!=''){ 
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,_PHONE_TYPE_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['name'];
}
}
}


function getEmailType($id){  
if($id!=''){ 
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,_EMAIL_TYPE_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['name'];
}
}
}


function getPrimaryPhone($id,$sectionType){  
if($id!=''){ 
$selectaa='phoneNo';   
$whereaa='masterId="'.$id.'" and sectionType="'.$sectionType.'" and primaryvalue=1'; 
$rsaa=GetPageRecord($selectaa,_PHONE_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['phoneNo'];
}
}
}

function getPrimaryEmail($id,$sectionType){  
if($id!=''){ 
$selectaa='email';   
$whereaa='masterId="'.$id.'"  and sectionType="'.$sectionType.'" and primaryvalue=1'; 
$rsaa=GetPageRecord($selectaa,_EMAIL_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['email'];
}
}
}


function getPrimaryEmailAccount($id,$sectionType){  
if($id!=''){ 
$selectaa='email';   
$whereaa='corporateId="'.$id.'" and contactPerson!="" and deletestatus=0'; 
$rsaa=GetPageRecord($selectaa,'contactPersonMaster',$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['email'];
}
}
}


function getMultiPrimaryEmail($id,$sectionType){  
if($id!=''){ 
$mailsreturn='';
$selectaa='email';   
$whereaa='masterId="'.$id.'"  and sectionType="'.$sectionType.'"  and primaryvalue!=1'; 
$rsaa=GetPageRecord($selectaa,_EMAIL_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
 $mailsreturn.=$userss['email'].',';
}
return $mailsreturn;

}
}

//-----------------Paging Listing-----------------





function GetRecordList($select,$tablename,$where,$limit,$page,$targetpage){

if(is_numeric($page) && $page!=''){

$page=$page;

} else {

$page=1;

}

if(is_numeric($limit) && $limit!=''){

$limit=$limit;

} else {

$limit=25;

} 

$query = "SELECT COUNT(*) as num FROM ".$tablename."  ".$where."";

$total_pages = mysqli_fetch_array(mysqli_query(db(),$query));

$total_pages = $total_pages[num];

$stages = 3;

$page = mysqli_escape_string(db(),$page);

if($page){

$start = ($page - 1) * $limit; 

}else{

$start = 0;	

}	 

$query1 = "SELECT ".$select." FROM ".$tablename."  ".$where." LIMIT $start,  ".$limit."";

$result=mysqli_query(db(),$query1) or die(mysqli_error());



 

//--------------paging--------------------



if ($page == 0){$page = 1;}

$prev = $page - 1;	

$next = $page + 1;		

$lastpage = ceil($total_pages/$limit);	

$LastPagem1 = $lastpage - 1;

$paginate = '';

if($lastpage > 1)

{	

$paginate .= "<div class='paginate'>";

if ($page > 1){

$paginate.= "<a href='".$targetpage."page=$prev'>Previous</a>";

}else{

$paginate.= "<span class='disabled'>Previous</span>";	}



if ($lastpage < 7 + ($stages * 2))

{

for ($counter = 1; $counter <= $lastpage; $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a href='".$targetpage."page=$counter'>$counter</a>";}

}

}

elseif($lastpage > 5 + ($stages * 2))

{

if($page < 1 + ($stages * 2))

{

for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a href='".$targetpage."page=$counter'>$counter</a>";}

}

$paginate.= "...";

$paginate.= "<a href='".$targetpage."page=$LastPagem1'>$LastPagem1</a>";

$paginate.= "<a href='".$targetpage."page=$lastpage'>$lastpage</a>";

}

elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))

{

$paginate.= "<a href='".$targetpage."page=1'>1</a>";

$paginate.= "<a href='".$targetpage."page=2'>2</a>";

$paginate.= "...";

for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a href='".$targetpage."page=$counter'>$counter</a>";}

}

$paginate.= "...";

$paginate.= "<a href='".$targetpage."page=$LastPagem1'>$LastPagem1</a>";

$paginate.= "<a href='".$targetpage."page=$lastpage'>$lastpage</a>";

}

else

{

$paginate.= "<a href='".$targetpage."page=1'>1</a>";

$paginate.= "<a href='".$targetpage."page=2'>2</a>";

$paginate.= "...";

for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a href='".$targetpage."page=$counter'>$counter</a>";}

}

}

} if ($page < $counter - 1){

$paginate.= "<a href='".$targetpage."page=$next'>Next</a>";

}else{

$paginate.= "<span class='disabled'>Next</span>";

}

$paginate.= "</div>";

} 

 
$page=$page-1;
 

if($page>0){
$startpage=($limit*$page+1);
} else {
$startpage=1;
}

if($page>0){
$finaloutof=$startpage+$limit-1;
} else { 
$finaloutof=$startpage+$limit-1;
}


$funaltotal=$total_pages;


if($finaloutof>$total_pages){
$finaloutof=$total_pages;
}  



$total_pages=''.$startpage.'-'.$finaloutof.' of '.$funaltotal;

return array($result,$total_pages,$paginate); 

}



 

//----------------Get Record---------------------





function GetPageRecord($select,$tablename,$where){		

$sql="select ".$select." from ".$tablename." where ".$where."";

$rs=mysqli_query(db(),$sql) or die(mysqli_error());

return $rs;

}





//----------------Delete Record---------------------





function deleteRecord($tablename,$where){	 

 $sql="delete  from ".$tablename." where ".$where."";

mysqli_query(db(),$sql) or die(mysqli_error());

}









//----------------Clear String---------------------





function clean($string){

$string=trim($string); 

$string=addslashes($string);

return addslashes($string);

}





//----------------Strip String---------------------







function strip($string){

return stripslashes(trim($string));

}





function addslash($string){

return addslashes(trim($string));

}



function getstatus($id){ 
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,'queryStatusMaster',$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  

if($id==1){
$classnew='badge-primary';
}

if($id==2){
$classnew='badge-secondary grn';
}

if($id==3){
$classnew='badge-dark';
}

if($id==4){
$classnew='badge-warning rd';
}

if($id==5){
$classnew='badge-success';
}

if($id==6){
$classnew='badge-secondary';
}

if($id==7){
$classnew='badge-danger';
} 

if($id==8){
$classnew='badge-blue';
}
if($id==9){
$classnew='badge-orange';
} 
return '<span class="badge '.$classnew.'">'.$userss['name'].'</span>';
}
}




function getstatusclass($id){ 
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,'queryStatusMaster',$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  

if($id==1){
$classnew='badge-primary';
}

if($id==2){
$classnew='badge-secondary';
}

if($id==3){
$classnew='badge-dark';
}

if($id==4){
$classnew='badge-warning';
}

if($id==5){
$classnew='badge-success';
}

if($id==6){
$classnew='badge-secondary';
}

if($id==7){
$classnew='badge-danger';
} 

return $classnew;
}
}
//----------------Login--------------------- 










function login($username,$password,$ftoken){  
$cip=$_SERVER['REMOTE_ADDR'];  
$clogin=date('Y-m-d H:i:s');  
$result =mysqli_query (db(),"select * from sys_userMaster where email='".$username."' and  password='".md5($password)."' and status=1 ")  or die(mysqli_error()); 
$number =mysqli_num_rows($result);  
if($number>0) 
{  

$select=''; 
$where=''; 
$rs=''; 
 
$select='cLogin,lLogin,id,currentIp,lastIp'; 
$where="email='".$username."' and  password='".md5($password)."'"; 
$rs=GetPageRecord($select,'sys_userMaster',$where); 
$userinfo=mysqli_fetch_array($rs);
$cLogin=$userinfo['cLogin'];
$currentIp=$userinfo['currentIp'];
$id=$userinfo['id'];
$randnum = mt_rand(100000, 999999);
$uSession=$randnum;
  

$_SESSION['userid']=$id;  
$_SESSION['username']=$username; 
$_SESSION['sessionid']=session_id();   
$_SESSION['uSession']=$uSession;

$sql_ins="update sys_userMaster set lLogin='$cLogin',lastIp='$currentIp',cLogin='$clogin',currentIp='$cip',uSession='".$uSession."',firebasetoken='".$ftoken."' where id=".$_SESSION['userid'].""; 
mysqli_query(db(),$sql_ins) or die(mysqli_error()); 


$sql_insk="insert into userLogs set lLogin='$cLogin',lastIp='$currentIp',cLogin='$clogin',currentIp='$cip',uSession='".$uSession."',firebasetoken='".$ftoken."',userid='".$_SESSION['userid']."'";
 
mysqli_query(db(),$sql_insk) or die(mysqli_error(db()));


 return 'yes';  

 }
}









function deletelist($tablename,$check_list,$userid){

if($check_list!=""){ 

for($i=0;$i<=count($check_list)-1;$i++)

{ 

$ansval=trim($check_list[$i]); 

if(trim($ansval) != ''){   



if($userid==''){

$sql_del="delete from ".$tablename."  where id='".$ansval."'";

mysqli_query(db(),$sql_del) or die(mysqli_error());  



} else {



$sql_del="delete from ".$tablename."  where id='".$ansval."' and userid ='".$userid."'";

mysqli_query(db(),$sql_del) or die(mysqli_error()); 



} 



} } } 



return 'yes';

}









function encode($string) 
{ 
if(trim($string)!='' && trim($string)!='0'){
$encoded=$string+202565517;
//$encoded = base64_encode(base64_encode(base64_encode($string)));  
return  $encoded; 
}
}



function decode($string) 
{ 
if(trim($string)!='' && trim($string)!='0'){
$decoded=$string-202565517;
//$decoded = base64_decode(base64_decode(base64_decode($string)));  
return  $decoded; 
}
}



function addlistinggetlastid($tablename,$namevalue){ 
$sql_ins="insert into ".$tablename." set ".$namevalue."";  
mysqli_query(db(),$sql_ins) or die(mysqli_error(db()));
return mysqli_insert_id(db()); 
}





function addlisting($tablename,$namevalue){ 

$sql_ins="insert into ".$tablename." set ".$namevalue."";  
mysqli_query(db(),$sql_ins) or die(mysqli_error(db()));

return 'yes';

}





function updatelisting($tablename,$namevalue,$where){ 

$sql_ins="update ".$tablename." set ".$namevalue." where ".$where.""; 

mysqli_query(db(),$sql_ins) or die(mysqli_error(db()));

return 'yes';

}







function countlisting($select,$tablename,$where){ 

$sql_ins="SELECT ".$select." FROM ".$tablename."  ".$where."";

$sql_ins1 = mysqli_query(db(),$sql_ins);

$totalcount=mysqli_num_rows($sql_ins1);

return $totalcount; 

}







function checkduplicate($tablename,$where){



$result =mysqli_query (db(),"select * from ".$tablename." where ".$where."")  or die(mysqli_error());

$number =mysqli_num_rows($result); 

if($number>0)

{



return 'yes';



} else {



return 'no';



}



}





function substrstring($string,$lenth){ 
return substr($string, 0, $lenth); 
}











// get Menu Id



function getMenuId($isId)

{

   if($isId=="")

   {

        $url = 'http://'. $_SERVER['HTTP_HOST']. $_SERVER['REQUEST_URI'];

		$path = parse_url($url, PHP_URL_PATH); 

		$file_name = basename($path);

		$rs =mysqli_query (db(),"select id from "._menu_master_." where link ='".$file_name."'")  or die(mysqli_error());

		$result=mysqli_fetch_array($rs);

		return $result['id'];

		

   } else {

   

     return $isId;

   }



}







function checkduplicateentry($tablename,$select,$where){



$result = mysqli_query (db(),"select ".$select." from ".$tablename."  ".$where."")  or die(mysqli_error());

$number = mysqli_num_rows($result);

if($number>0)

{

return  'yes';

} else {

return  'no';

}





}















function image_fix_orientation($filename) {
    $exif = exif_read_data($filename);
    if (!empty($exif['Orientation'])) {
        $image = imagecreatefromjpeg($filename);
        switch ($exif['Orientation']) {
            case 3:
                $image = imagerotate($image, 180, 0);
                break;

            case 6:
                $image = imagerotate($image, -90, 0);
                break;

            case 8:
                $image = imagerotate($image, 90, 0);
                break;
        }

        imagejpeg($image, $filename, 90);
    }
}





 



function imageResize($image, $thumb_width, $new_filename)
{
  $max_width = $thumb_width;
  //Check if GD extension is loaded
  if (!extension_loaded('gd') && !extension_loaded('gd2')) {
    trigger_error("GD is not loaded", E_USER_WARNING);
    return false;
  }
  //Get Image size info
  list($width_orig, $height_orig, $image_type) = getimagesize($image);
  switch ($image_type) {
    case 1:
      $im = imagecreatefromgif($image);
      break;
    case 2:
      $im = imagecreatefromjpeg($image);
      break;
    case 3:
      $im = imagecreatefrompng($image);
      break;
    default:
      trigger_error('Unsupported filetype!', E_USER_WARNING);
      break;
  }
  //calculate the aspect ratio
  $aspect_ratio = (float) $height_orig / $width_orig;
  //calulate the thumbnail width based on the height
  $thumb_height = round($thumb_width * $aspect_ratio);
  while ($thumb_height > $max_width) {
    $thumb_width -= 10;
    $thumb_height = round($thumb_width * $aspect_ratio);
  }
  $new_image = imagecreatetruecolor($thumb_width, $thumb_height);
  //Check if this image is PNG or GIF, then set if Transparent
  if (($image_type == 1) OR ($image_type == 3)) {
    imagealphablending($new_image, false);
    imagesavealpha($new_image, true);
    $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
    imagefilledrectangle($new_image, 0, 0, $thumb_width, $thumb_height, $transparent);
  }
  imagecopyresampled($new_image, $im, 0, 0, 0, 0, $thumb_width, $thumb_height, $width_orig, $height_orig);
  //Generate the file, and rename it to $new_filename
  switch ($image_type) {
    case 1:
      imagegif($new_image, $new_filename);
      break;
    case 2:
      imagejpeg($new_image, $new_filename);
      break;
    case 3:
      imagepng($new_image, $new_filename);
      break;
    default:
      trigger_error('Failed resize image!', E_USER_WARNING);
      break;
  }
  return $new_filename;
}










function resize($img){
/*
only if you script on another folder get the file name*/
$r =explode("../",$img);
$name=end($r);
 

$vdir_upload = '../upload/thumb/';
list($width_orig, $height_orig) = getimagesize($img);
//ne size
$dst_width = 150;
$dst_height = ($dst_width/$width_orig)*$height_orig;
$im = imagecreatetruecolor($dst_width,$dst_height);
$image = imagecreatefromjpeg($img);
imagecopyresampled($im, $image, 0, 0, 0, 0, $dst_width, $dst_height, $width_orig, $height_orig);
//modive the name as u need
imagejpeg($im,$vdir_upload . "small" .$datef. $name);
//save memory
imagedestroy($im);
}





function generate_image_thumbnail($source_image_path, $thumbnail_image_path, $thumbnail_image_width, $source_image_height)
{
    list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
    switch ($source_image_type) {
        case IMAGETYPE_GIF:
            $source_gd_image = imagecreatefromgif($source_image_path);
            break;
        case IMAGETYPE_JPEG:
            $source_gd_image = imagecreatefromjpeg($source_image_path);
            break;
        case IMAGETYPE_PNG:
            $source_gd_image = imagecreatefrompng($source_image_path);
            break;
    }
    if ($source_gd_image === false) {
        return false;
    }
    $source_aspect_ratio = $source_image_width / $source_image_height;
    $thumbnail_aspect_ratio = $thumbnail_image_width / $thumbnail_image_height;
    if ($source_image_width <= $thumbnail_image_width && $source_image_height <= $thumbnail_image_height) {
        $thumbnail_image_width = $source_image_width;
        $thumbnail_image_height = $source_image_height;
    } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
        $thumbnail_image_width = (int) ($thumbnail_image_height * $source_aspect_ratio);
        $thumbnail_image_height = $thumbnail_image_height;
    } else {
        $thumbnail_image_width = $thumbnail_image_width;
        $thumbnail_image_height = (int) ($thumbnail_image_width / $source_aspect_ratio);
    }
    $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
    imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);

    $img_disp = imagecreatetruecolor($thumbnail_image_width,$thumbnail_image_width);
    $backcolor = imagecolorallocate($img_disp,0,0,0);
    imagefill($img_disp,0,0,$backcolor);

        imagecopy($img_disp, $thumbnail_gd_image, (imagesx($img_disp)/2)-(imagesx($thumbnail_gd_image)/2), (imagesy($img_disp)/2)-(imagesy($thumbnail_gd_image)/2), 0, 0, imagesx($thumbnail_gd_image), imagesy($thumbnail_gd_image));

    imagejpeg($img_disp, $thumbnail_image_path, 90);
    imagedestroy($source_gd_image);
    imagedestroy($thumbnail_gd_image);
    imagedestroy($img_disp);
    return true;
}










function generateLogs($sectionType,$sectionAction,$sectionId){  


$select='superParentId'; 
$where='id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'"'; 
$rs=GetPageRecord($select,_USER_MASTER_,$where); 
$LoginUserDetails=mysqli_fetch_array($rs);  
$loginusersuperParentId=$LoginUserDetails['superParentId'];



$dateAdded=time();
$namevalue ='userId="'.$loginusersuperParentId.'",modifyBy="'.$_SESSION['userid'].'",sectionType="'.$sectionType.'",sectionAction="'.$sectionAction.'",sectionId="'.$sectionId.'",modifyDate="'.$dateAdded.'"';
$sql_ins="insert into "._SYSTEM_LOGS_MASTER_." set ".$namevalue."";  
mysqli_query(db(),$sql_ins) or die(mysqli_error()); 
return 'yes'; 
}


function datetimemix($date){ 
return date('j F Y, g:i A', $date);
}

function dateDMY($date){ 
return date('d-m-Y', $date);
}


function getExtension($str) {
$i = strrpos($str,".");
if (!$i) { return ""; }
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}













function makedatetime($ptime)
{
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'year',
                 30 * 24 * 60 * 60  =>  'month',
                      24 * 60 * 60  =>  'day',
                           60 * 60  =>  'hour',
                                60  =>  'minute',
                                 1  =>  'second'
                );
    $a_plural = array( 'year'   => 'years',
                       'month'  => 'months',
                       'day'    => 'days',
                       'hour'   => 'hours',
                       'minute' => 'minutes',
                       'second' => 'seconds'
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . '';
        }
    }
}
 


function getCurrencyValue($id){ 
if($id!=''){  
$selectaa='currencyValue';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,_QUERY_CURRENCY_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['currencyValue'];
}
}
}





function getChangeCurrencyValue($id,$changeid,$valuefield){ 

if($id!='' && $changeid!=''){  
$selectaa='currencyValue';   
$whereaa='currencyFrom="'.$id.'" and currencyTo="'.$changeid.'" '; 
$rsaa=GetPageRecord($selectaa,_CURRENCY_CONVERSION_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
$cr1= $userss['currencyValue'];
}


if($id!='' && $changeid!=''){  
$selectaa='currencyValue';   
$whereaa='currencyTo="'.$id.'" and currencyFrom="'.$changeid.'" '; 
$rsaa=GetPageRecord($selectaa,_CURRENCY_CONVERSION_MASTER_,$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
$cr2= $userss['currencyValue'];
}



if($cr1!='' && $cr2!=''){

if($cr1<$cr2){
$finalvalue=$valuefield*$cr2;
} else {
$finalvalue=$valuefield/$cr1;
}


} else {
$finalvalue=$valuefield;
}


}
}

return $finalvalue;
}















//-----------------Jquery Paging Listing-----------------





function GetRecordListJs($select,$tablename,$where,$limit,$page,$targetpage){ 

if(($page) && $page!=''){

$page=$page;

} else {

$page=1;

}

if(($limit) && $limit!=''){

$limit=$limit;

} else {

$limit=25;

} 

$query = "SELECT COUNT(*) as num FROM ".$tablename."  ".$where."";

$total_pages = mysqli_fetch_array(mysqli_query(db(),$query));

$total_pages = $total_pages[num];

$stages = 3;

$page = mysqli_escape_string(db(),$page);

if($page){

$start = ($page - 1) * $limit; 

}else{

$start = 0;	

}	 

$query1 = "SELECT ".$select." FROM ".$tablename."  ".$where." LIMIT $start,  ".$limit."";

$result=mysqli_query(db(),$query1) or die(mysqli_error());



 

//--------------paging--------------------



if ($page == 0){$page = 1;}

$prev = $page - 1;	

$next = $page + 1;		

$lastpage = ceil($total_pages/$limit);	

$LastPagem1 = $lastpage - 1;

$paginate = '';

if($lastpage > 1)

{	

$paginate .= "<div class='paginate'>";

if ($page > 1){

$paginate.= "<a href='#' onclick='insidepageloader();'  pagecon='".$targetpage."page=$prev'>Previous</a>";

}else{

$paginate.= "<span class='disabled'>Previous</span>";	}



if ($lastpage < 7 + ($stages * 2))

{

for ($counter = 1; $counter <= $lastpage; $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a href='#' onclick='insidepageloader();' pagecon='".$targetpage."page=$counter'>$counter</a>";}

}

}

elseif($lastpage > 5 + ($stages * 2))

{

if($page < 1 + ($stages * 2))

{

for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a  onclick='insidepageloader();'  pagecon='".$targetpage."page=$counter'   href='#'>$counter</a>";}

}

$paginate.= "...";

$paginate.= "<a   onclick='insidepageloader();'  pagecon='".$targetpage."page=$LastPagem1'   href='#'>$LastPagem1</a>";

$paginate.= "<a  onclick='insidepageloader();'  pagecon='".$targetpage."page=$lastpage' href='#'>$lastpage</a>";

}

elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))

{

$paginate.= "<a onclick='insidepageloader();'  pagecon='".$targetpage."page=1'  href='#'>1</a>";

$paginate.= "<a onclick='insidepageloader();'  pagecon='".$targetpage."page=2'   href='#'>2</a>";

$paginate.= "...";

for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a onclick='insidepageloader();'  pagecon='".$targetpage."page=$counter' href='#'>$counter</a>";}

}

$paginate.= "...";

$paginate.= "<a onclick='insidepageloader();'  pagecon='".$targetpage."page=$LastPagem1'  href='#'>$LastPagem1</a>";

$paginate.= "<a onclick='insidepageloader();'  pagecon='".$targetpage."page=$lastpage'   href='#'>$lastpage</a>";

}

else

{

$paginate.= "<a onclick='insidepageloader();'  pagecon='".$targetpage."page=1'  href='#'>1</a>";

$paginate.= "<a  onclick='insidepageloader();'  pagecon='".$targetpage."page=2'   href='#'>2</a>";

$paginate.= "...";

for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a onclick='insidepageloader();'  pagecon='".$targetpage."page=$counter'   href='#'>$counter</a>";}

}

}

} if ($page < $counter - 1){

$paginate.= "<a  onclick='insidepageloader();'  pagecon='".$targetpage."page=$next'   href='#'>Next</a>";

}else{

$paginate.= "<span class='disabled'>Next</span>";

}

$paginate.= "</div>";

}











return array($result,$total_pages,$paginate); 

}





function GetRecordListJsbooking($select,$tablename,$where,$limit,$page,$targetpage,$pagediv){ 

if(($page) && $page!=''){

$page=$page;

} else {

$page=1;

}

if(($limit) && $limit!=''){

$limit=$limit;

} else {

$limit=25;

} 

$query = "SELECT COUNT(*) as num FROM ".$tablename."  ".$where."";

$total_pages = mysqli_fetch_array(mysqli_query(db(),$query));

$total_pages = $total_pages[num];

$stages = 3;

$page = mysqli_escape_string(db(),$page);

if($page){

$start = ($page - 1) * $limit; 

}else{

$start = 0;	

}	 

$query1 = "SELECT ".$select." FROM ".$tablename."  ".$where." LIMIT $start,  ".$limit."";

$result=mysqli_query(db(),$query1) or die(mysqli_error());



 

//--------------paging--------------------



if ($page == 0){$page = 1;}

$prev = $page - 1;	

$next = $page + 1;		

$lastpage = ceil($total_pages/$limit);	

$LastPagem1 = $lastpage - 1;

$paginate = '';

if($lastpage > 1)

{	

$paginate .= "<div class='paginate'>";

if ($page > 1){

$paginate.= "<a href='#' onclick='insidepageloaderbooking(".$pagediv.");'  pagecon='".$targetpage."page=$prev'>Previous</a>";

}else{

$paginate.= "<span class='disabled'>Previous</span>";	}



if ($lastpage < 7 + ($stages * 2))

{

for ($counter = 1; $counter <= $lastpage; $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a href='#' onclick='insidepageloaderbooking(".$pagediv.");' pagecon='".$targetpage."page=$counter'>$counter</a>";}

}

}

elseif($lastpage > 5 + ($stages * 2))

{

if($page < 1 + ($stages * 2))

{

for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a  onclick='insidepageloaderbooking(".$pagediv.");'  pagecon='".$targetpage."page=$counter'   href='#'>$counter</a>";}

}

$paginate.= "...";

$paginate.= "<a   onclick='insidepageloaderbooking(".$pagediv.");'  pagecon='".$targetpage."page=$LastPagem1'   href='#'>$LastPagem1</a>";

$paginate.= "<a  onclick='insidepageloaderbooking(".$pagediv.");'  pagecon='".$targetpage."page=$lastpage' href='#'>$lastpage</a>";

}

elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))

{

$paginate.= "<a onclick='insidepageloaderbooking(".$pagediv.");'  pagecon='".$targetpage."page=1'  href='#'>1</a>";

$paginate.= "<a onclick='insidepageloaderbooking(".$pagediv.");'  pagecon='".$targetpage."page=2'   href='#'>2</a>";

$paginate.= "...";

for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a onclick='insidepageloaderbooking(".$pagediv.");'  pagecon='".$targetpage."page=$counter' href='#'>$counter</a>";}

}

$paginate.= "...";

$paginate.= "<a onclick='insidepageloaderbooking(".$pagediv.");'  pagecon='".$targetpage."page=$LastPagem1'  href='#'>$LastPagem1</a>";

$paginate.= "<a onclick='insidepageloaderbooking(".$pagediv.");'  pagecon='".$targetpage."page=$lastpage'   href='#'>$lastpage</a>";

}

else

{

$paginate.= "<a onclick='insidepageloaderbooking(".$pagediv.");'  pagecon='".$targetpage."page=1'  href='#'>1</a>";

$paginate.= "<a  onclick='insidepageloaderbooking(".$pagediv.");'  pagecon='".$targetpage."page=2'   href='#'>2</a>";

$paginate.= "...";

for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)

{

if ($counter == $page){

$paginate.= "<span class='current'>$counter</span>";

}else{

$paginate.= "<a onclick='insidepageloaderbooking(".$pagediv.");'  pagecon='".$targetpage."page=$counter'   href='#'>$counter</a>";}

}

}

} if ($page < $counter - 1){

$paginate.= "<a  onclick='insidepageloaderbooking(".$pagediv.");'  pagecon='".$targetpage."page=$next'   href='#'>Next</a>";

}else{

$paginate.= "<span class='disabled'>Next</span>";

}

$paginate.= "</div>";

}











return array($result,$total_pages,$paginate); 

}







function getAmenitiesName($id){ 
if($id!=''){  
$selectaa='name';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,'amenitiesMaster',$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return $userss['name'];
}
}
}








function getcurrenyWord($amt){
 
$number = $amt;
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
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
  echo ucwords($result . "Rupees Only");
}







function removeSpecialCharacters($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}






 

function starcategory($cat){
for ($x = 0; $x <= ($cat-1); $x++) {
  echo "<i class='fa fa-star' aria-hidden='true'></i>";
}
}



function getquerystatustag($id){  
if($id!=''){ 
$selectaa='*';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,'sys_queryStageMaster',$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return '<span class="badge bg-blue" style="background-color:'.$userss['bgColor'].';">'.$userss['updatedName'].'</span>';
}
}
}

function getquerysourcename($id){  
if($id!=''){ 
$selectaa='*';   
$whereaa='id="'.$id.'"'; 
$rsaa=GetPageRecord($selectaa,'sys_travelSource',$whereaa); 
while($userss=mysqli_fetch_array($rsaa)){  
return stripslashes($userss['name']);
}
}
}


function getquerytypename($id){  
if($id!=''){ 

if($id==1){ return 'B2C'; } if($id==2){ return 'Travel Agent (B2B)'; } if($id==3){ return 'Corporate'; }
 
} }











function makeAgentId($string){
if(trim($string)!='' && trim($string)!='0'){

$a=GetPageRecord('*','sys_userMaster',' agentId="'.$string.'"'); 
$res=mysqli_fetch_array($a); 

//$encoded=$string+4409; 
return $res['mainAgentId']; 


}
}



function sendmainmail($tomail,$subject,$body){


$a=GetPageRecord('*','sys_userMaster',' id=1'); 
$res=mysqli_fetch_array($a); 


$frommail=$res['emailAccount']; 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
$headers .= "From: ".$frommail." \r\n"; 
mail($tomail,$subject,$body,$headers);


}


function loginattampmail($userid,$email){
 
$rs=GetPageRecord('currentIp','sys_userLogs','  userId="'.$userid.'" order by id desc ');  
$LoginUserDetails=mysqli_fetch_array($rs);

$a=GetPageRecord('*','sys_userMaster','id=1 ');  
$invoiceData=mysqli_fetch_array($a);  
  

if($LoginUserDetails['currentIp']!=$_SERVER['REMOTE_ADDR']){

$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['parentid'].'"'); 
$getcompanybasicinfo=mysqli_fetch_array($rs);

 $subject = 'New Login Attempt - '.stripslashes($getcompanybasicinfo['companyName']).'';
 

$mailbody='

<strong>New login attempt with your login credential.</strong><br><br>

<strong>Email: </strong>'.$email.'<br>
<strong>IP: </strong>'.$_SERVER['REMOTE_ADDR'].'<br>
<strong>Time: </strong>'.date('Y-m-d h:i A').'<br><br>

<strong>Note:</strong>  If you feel suspicious login attempt. Please contact administrator.<br /><br />

<strong>'.stripslashes($getcompanybasicinfo['companyName']).'<br />
<strong>Call Us:</strong> '.$getcompanybasicinfo['phone'].'<br />
<strong>Email Us:</strong> '.$getcompanybasicinfo['email'].'<br />

  ';

 
 


sendmainmail($email,$subject,$mailbody);
}



}

?>
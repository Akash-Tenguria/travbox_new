<?php 
include "config/database.php"; 
include "config/function.php"; 
include "config/setting.php";
include "agenturlinc.php";




if($_REQUEST["action"]=="register" && $_POST["firstName"]!="" && $_POST["lastName"]!="" && $_POST["mobile"]!="" && $_POST["email"]!="" && $_POST["password"]!="" && $_POST["confirmpassword"]!="" && $_POST["country"]!="" && $_POST["state"]!="" && $_POST["city"]!="" && $_POST["companyName"]!="" && $_POST["businessType"]!="" && $_POST["iaccept"]>0  ){




$firstName=trim($_REQUEST["firstName"]); 
$salesManager=trim($_REQUEST["salesManager"]); 

$mobile=trim($_REQUEST["mobile"]); 

$password=trim($_REQUEST["password"]);

$confirmpassword=trim($_REQUEST["confirmpassword"]); 

$address=trim($_REQUEST["address"]); 

$lastName=trim($_REQUEST["lastName"]); 

$email=trim($_REQUEST["email"]); 

$pincode=trim($_REQUEST["pincode"]); 

$country=trim($_REQUEST["country"]); 

$state=trim($_REQUEST["state"]); 

$city=trim($_REQUEST["city"]); 

$companyName=trim($_REQUEST["companyName"]);  

$pan=trim($_REQUEST["pan"]); 

$businessType=trim($_REQUEST["businessType"]); 

$gstNumber=trim($_REQUEST["gstNumber"]);

$website=trim($_REQUEST["website"]);
	
$userCountry=trim($_REQUEST["userCountry"]);

$userState=trim($_REQUEST["userState"]);

$userCity=trim($_REQUEST["userCity"]);
	
$companyPincode=trim($_REQUEST["companyPincode"]);
	
$companyAddress=trim($_REQUEST["companyAddress"]);
	
$companyMobile=trim($_REQUEST["companyMobile"]);
	
$agentCode=addslashes($_POST['agentCode']);
	
$aadharNumber=addslashes($_POST['aadharNumber']);
	
$oldpanCopy=addslashes($_POST['panCopy']);
	

	
if($_FILES["panCopy"]["tmp_name"]!=""){  

$rt=mt_rand().strtotime(date("YMDHis")); 
$companyLogoFileName=basename($_FILES['panCopy']['name']); 

$companyLogoFileExtension=pathinfo($companyLogoFileName, PATHINFO_EXTENSION);  
$panCopy=time().$rt.'.'.$companyLogoFileExtension; 

move_uploaded_file($_FILES["panCopy"]["tmp_name"], "upload/{$panCopy}"); 
}

if($panCopy==''){ 
$panCopy=$oldpanCopy; 
}





if(strlen($password)<8){ ?>



<script>

alert('Enter password  minimum length 8 characters!');

</script>



<?php

exit();



}



if($password!=$confirmpassword){ ?>



<script>

alert('Password and confirm password must be same!');

</script>



<?php

exit();



}









 



 

$rs8=GetPageRecord('*','sys_userMaster','email="'.trim($email).'" and parentId="'.$staticparentId.'" ');  

$dubcheck=mysqli_fetch_array($rs8);  

if($dubcheck['id']!=''){





 

?>







<script>



alert('Username (<?php echo $email; ?>) already taken. Please enter diffrent email id!');



</script>







<?php



}else{



$a=GetPageRecord('*','sys_userMaster','id=1 ');  

$invoiceData=mysqli_fetch_array($a); 



$lag=GetPageRecord('*','sys_userMaster',' userType="agent" order by id desc'); 

$lastagentid=mysqli_fetch_array($lag);



$lastAgentId=round($lastagentid['agentId']+1);

 

	//Insert



$namevalue ='name="'.$firstName.'",lastName="'.$lastName.'",salesManager="'.$lastName.'",email="'.$email.'",panCopy="'.$panCopy.'",password="'.md5($password).'",phone="'.$mobile.'",address="'.$address.'",pincode="'.$pincode.'",country="'.$country.'",state="'.$state.'",city="'.$city.'",userCountry="'.$userCountry.'",userState="'.$userState.'",	userCity="'.$userCity.'",companyPincode="'.$companyPincode.'",companyAddress="'.$companyAddress.'",companyMobile="'.$companyMobile.'",businessType="'.$businessType.'",website="'.$website.'",companyName="'.$companyName.'",pan="'.$pan.'",aadharNumber="'.$aadharNumber.'",agentCode="'.$agentCode.'",gstin="'.$gstNumber.'",parentAgentId=1,parentId="'.$staticparentId.'",addDate="'.date('Y-m-d H:i:s').'",addBy="0",userType="agent",status=0,agentId="'.$lastAgentId.'"';

$userId=addlistinggetlastid('sys_userMaster',$namevalue);
$mainAgentId="TZ".$userId;


$namevalue ='mainAgentId="'.$mainAgentId.'"';  
$where=' id="'.$userId.'"';
updatelisting('sys_userMaster',$namevalue,$where); 

$_SESSION['mainAgentId']=$mainAgentId;

$ccmail='';   
$file_name='';  

$subject = 'Login Details - '.strip($getcompanybasicinfo['companyName']).''; 


$mailbody='<div style="text-align:center; width:100%; padding:20px 0px; background-color:#F4F4F4"> 
<table width="638" border="0" align="center" cellpadding="5" cellspacing="0" style="border: 1px solid #efefef; background-color:#FFFFFF;"> 
  <tr> 
    <td colspan="3" style="padding:20px;"><div align="left"><img src="'.$imgurl.$getcompanybasicinfo['companyLogo'].'" height="45"></div></td> 
  </tr> 
  <tr> 
    <td colspan="3"  style="padding:20px;"><div align="left">Dear '.$firstName.',<br /> 
          <br /> 
      Thank you for register with us.<br /> 
  <br /> 
  <strong>Your Login Credentials</strong><br /> 
  <br /> 
      Login Page URL: <a href="'.$fullurl.'" target="_blank">'.$fullurl.'</a><br /> 
  <br /> 

      Agent ID: '.$mainAgentId.'<br />  
      Username: '.$email.'<br />  
      Password: '.$password.'<br /> 
  <br /> 

     <div style="padding:20px; margin-top:10px; background-color:#FFFFCC;"><strong>Note:</strong> Your account is under review process.</div> 

    </div></td>

  </tr>

  <tr>

    <td colspan="3" bgcolor="#dc3545" style="padding:20px; color:#fff;"><table width="100%" border="0" cellpadding="10" cellspacing="0" style="font-size:16px; color:#fff;">

      <tr>

        <td colspan="2" align="center"><strong>HOW TO REACH US</strong></td>

        </tr>

      <tr>

        <td width="48%"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#fff;">

          <tr>

            <td colspan="2"><img src="'.$fullurl.'images/emailphone.png" width="38" height="38"></td>

            <td width="90%" style="padding-left:10px;"><div align="left">Live Assistance

            </div>

              <div style="font-size:18px; ">

                <div align="left"><strong>'.$getcompanybasicinfo['phone'].'</strong></div>

              </div>			</td>

          </tr>

          

        </table></td>

        <td style="border-left:1px solid #fff; padding-left:20px;"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="color:#fff;">

          <tr>

            <td colspan="2"><img src="'.$fullurl.'images/emailemail.png" width="38" height="38"></td>

            <td width="90%" style="padding-left:10px;"><div align="left">E-mail us at</div>

              <div style="font-size:14px; ">

              <div align="left"><a href="mailto:'.$getcompanybasicinfo['email'].'" style="color:#fff; text-decoration:none;">'.$getcompanybasicinfo['email'].'</a></div>

            </div>			</td>

          </tr>

          

        </table></td>

      </tr>

      

    </table></td>

  </tr>

  <tr>

    <td colspan="3" align="center"><img src="'.$fullurl.'images/savingimage.png" width="100%" ></td>

  </tr>

</table>

</div> ';

 



 sendmainmail($email,$subject,$mailbody); 



?>

 
 

<script> 
window.parent.location.href = "<?php echo $fullurl; ?>signup-done"; 

</script> 

<?php 

} 


}



?>
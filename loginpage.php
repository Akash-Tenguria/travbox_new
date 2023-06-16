<?php 
include "config/database.php"; 
include "config/function.php"; 
include "agenturlinc.php";

$rs=GetPageRecord('*','sys_companyMaster','userId=1');  
$getlogo=mysqli_fetch_array($rs); 

if($_POST['username']!='' && $_POST['password']!=''){ 

ini_set('max_execution_time', '300');  

$domainName=str_replace('www.','',$_SERVER['SERVER_NAME']); 
$rs=GetPageRecord('*','sys_userMaster','domainName="'.$domainName.'" ');  
$AgentWebsiteData=mysqli_fetch_array($rs);

$cip=$_SERVER['REMOTE_ADDR'];   
$clogin=date('Y-m-d H:i:s');   
$result =mysqli_query (db(),"select * from sys_userMaster where email='".$_POST['username']."' and id!=1 and  password='".md5($_POST['password'])."' and status=1 and (userType='agent') ")  or die(mysqli_error());  
$number =mysqli_num_rows($result);   
if($number>0)  
{   

$select='';  
$where='';  
$rs='';  
$select='*'; 

$where="email='".$_POST['username']."' and  password='".md5($_POST['password'])."'";  
$rs=GetPageRecord($select,'sys_userMaster',$where);  
$userinfo=mysqli_fetch_array($rs); 

deleteRecord('sys_userLogs','DATE(addLastDate)<"'.date('Y-m-d',strtotime('-2 days')).'"'); 

$_SESSION['agentUserid']=$userinfo['id'];   
$_SESSION['parentAgentId']=$userinfo['parentAgentId'];  
$_SESSION['agentUsername']=$userinfo['email'];    
$_SESSION['parentid']=$userinfo['parentId'];  

loginattampmail($userinfo['id'],$_POST['username']); 

$sql_insk="insert into sys_userLogs set  currentIp='".$cip."',logType='login',details='User Login',userId='".$userinfo['id']."',parentId='".$userinfo['id']."',addDate='".time()."'";  
mysqli_query(db(),$sql_insk) or die(mysqli_error(db())); 
 
$sql_ins="update sys_userMaster set onlineStatus=1 where id=".$_SESSION['agentUserid']."";  
mysqli_query(db(),$sql_ins) or die(mysqli_error());  

header('Location: '.$fullurl.'');

exit();

} else {

$notlogin=1;

}
 
} 


$rs=GetPageRecord('*','sys_userMaster','id="'.$staticparentId.'" ');  
$AgentWebsiteData=mysqli_fetch_array($rs);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Login - <?php echo $systemname; ?></title> 
<?php include "headerinc.php"; ?>
</head>

<body id="loginbg" class="loginbody">
  <!-- header -->
   
<div id="loginouter">
<div id="loginouterin" class="formloginouter">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" class="logintable">
  <tr>
    <td colspan="2" align="left" valign="top"><img src="images/loginbanner.png" class="leftbanner"></td>
    <td width="40%" align="left" valign="">
      <div class="loginform"> 
<form action=""  method="post">
            <div class="formlogo">
              <img src="<?php echo $imgurlagent; ?><?php echo $AgentWebsiteData['companyLogo']; ?>" >
              <p>Login here to your account as</p>
			 <?php if($notlogin==1){?> <div style="margin:10px 0px; color:#CC0000; font-size:12px; font-weight:600;">Invalid Login!</div><?php } ?>
            </div>
            <div class="inputbox">
              <input name="username" type="email" id="username" placeholder="Email">
              <input name="password" type="password" id="password" placeholder="Password">
            </div>
            <div class="loginbutton">
             <a>
                  <button type="submit">Login</button>
				  </a>
               
            </div>
            <div class="reset">
              <p>Forgot your password ? <a style=" cursor:pointer; color:var(--blue);" onclick="loadpop('Reset Password',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=resetpassword">Reset Here</a></p>
              <hr>
              <p class="dontheading">Don't have an account?
              </p>
            </div>
            <p></p>
            <div class="createbutton">
              <a href="sign-up">
                <button type="button">Create Account</button>
              </a>
            </div>
            <div class="loginlinks">
              
              <a href="<?php echo $fullurl; ?>about-us">About</a>
              <a href="<?php echo $fullurl; ?>terms-conditions">Terms & conditions</a>
              <a href="<?php echo $fullurl; ?>privacy-policy">Privacy Policy</a>
              <a href="<?php echo $fullurl; ?>contact-us">Contact</a>
            </div>
        </form>
      </div>
    </td>
  </tr>
</table>

</div>
</div>
<?php include "footerinc.php"; ?>
</body>
</html>

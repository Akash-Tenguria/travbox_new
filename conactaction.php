<?php
include "inc.php";
//include "config/logincheck.php";  
?>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<?php 
 

if($_REQUEST['action']=='sendcontactform' && $_REQUEST['firstName']!='' && $_REQUEST['lastName']!='' && $_REQUEST['email']!='' && $_REQUEST['phone']!='' && $_SESSION['contactpage']==1){ 
 
$firstName=trim($_REQUEST['firstName']);
$lastName=trim($_REQUEST['lastName']);
$email=trim($_REQUEST['email']);
$phone=trim($_REQUEST['phone']); 
$message=trim($_REQUEST['message']); 

 $_SESSION['contactpage']=0;


$to  = stripslashes($getcompanybasicinfo['email']); // note the comma
//$to .= 'wez@example.com';

// subject
$subject = 'New Query From Website '.$fullurl;

// message
$message = '
<html>
<head>
  <title>New Query From Website</title>
</head>
<body>
   <table width="100%" border="0" cellpadding="5">
  <tr>
    <td width="10%"><strong>Name:</strong></td>
    <td width="90%">'.$firstName.'&nbsp;'.$lastName.'</td>
  </tr>
  <tr>
    <td><strong>Email:</strong></td>
    <td>'.$email.'</td>
  </tr>
  <tr>
    <td><strong>Phone:</strong></td>
    <td>'.$phone.'</td>
  </tr>
  <tr>
    <td><strong>Message:</strong></td>
    <td>'.$message.'</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
';

$rs=GetPageRecord('*','sys_branchMaster','id=1'); 
$homeSettings=mysqli_fetch_array($rs);

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: '.stripslashes($getcompanybasicinfo['email']).' <'.$homeSettings['email'].'>' . "\r\n";
$headers .= 'From: '.stripslashes($getcompanybasicinfo['email']).' <'.$homeSettings['email'].'>' . "\r\n"; 

// Mail it
mail($to, $subject, $message, $headers);
?>
<script>
//alert('Query submitted successfully...!'); 
parent.window.location.href='<?php echo $fullurl; ?>contact-us?i=1';
</script>
<?php

} 



?>
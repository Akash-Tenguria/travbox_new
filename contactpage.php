<?php 
include "inc.php";  
$page='about-us';

$rsa=GetPageRecord('*','sys_contentPages','id=5'); 
$pagecontent=mysqli_fetch_array($rsa); 

$rs=GetPageRecord('*','sys_branchMaster','id=1'); 
$getcompanybasicinfo=mysqli_fetch_array($rs);

$_SESSION['contactpage']=1;


$rs=GetPageRecord('*','sys_userMaster','id="'.$staticparentId.'" ');  
$AgentWebsiteData=mysqli_fetch_array($rs);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Contact Us - <?php echo $systemname; ?></title>
     <?php include "headerinc.php"; ?>
</head>

<body id="loginbg">
     
    <div id="loginouter" style="height: auto;margin-top: 20px ;margin-bottom: 20px ; position:inherit;  padding-bottom:130px;">
        <div id="loginouterin" style="height: auto; ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 d-flex" style="border-bottom:1px solid var(--lightgray)">
                        <div>
                            <h1 class=" ms-4 me-4 my-2 pb-3 registerlogo"><a href="<?php echo $fullurl; ?>"><img src="<?php echo $imgurlagent; ?><?php echo $AgentWebsiteData['companyLogo']; ?>"  ></a></h1>

                        </div>
                        <div class="registerlogo ms-auto me-3 aboutlink">
                           <a href="<?php echo $fullurl; ?>">Home</a>
                           <a href="<?php echo $fullurl; ?>about-us">About</a>
              <a href="<?php echo $fullurl; ?>terms-conditions">Terms & conditions</a>
              <a href="<?php echo $fullurl; ?>privacy-policy">Privacy Policy</a>
              <a href="<?php echo $fullurl; ?>contact-us">Contact</a>
                        </div>
                    </div>





                    <div class="row" style="margin:auto;">

                        <div class="col-lg-12">

                            <div style="padding:20px 0px;font-size: 14px;font-weight:600;">
                                <div class="pagebanner">
                                    <img src="<?php echo $imgurl; ?><?php echo $pagecontent['image']; ?>" >
                                    <span>Contact Us</span>
                                </div>  
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="card" style="min-height:497px;  margin-top: 0px;">
                                       
                                                         <div class="card-header">
                                       
                                                            <div class="card-title" style="margin-bottom:0px;"><strong>Get In Touch With Us</strong></div>
                                       
                                                         </div>
                                       
                                                         <div class="card-body">
                                       <?php if($_REQUEST['i']==1){ ?>
				 
				<div style="text-align:center; padding-top:100px;">
				
				<h2>Thank You!</h2>
				<div style="text-align:center; font-size:14px;">Your query has been submitted successfully. <br>
We will contact you shortly.</div>
				</div> 
				 
				 
				 <?php } else { ?>

                                                        
                                                            <form action="conactaction.php" method="post"> 
                                       
                                                               <div class="form-group"> <input type="text" class="form-control" name="firstName" placeholder="First Name" required=""> </div>
                                       
                                                               <div class="form-group"> <input type="text" class="form-control" name="lastName" placeholder="Last Name" required=""> </div>
                                                               
                                                               <div class="form-group"> <input type="number" class="form-control" name="phone" placeholder="Phone Number" required=""> </div>
                                       
                                                               <div class="form-group"> <input type="email" class="form-control" name="email" placeholder="Email Address" required=""> </div>
                                       
                                                               
                                       
                                                               <div class="form-group"> <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea> </div>
                                       
                                                               <input type="hidden" name="action" value="sendcontactform">
                                       
                                                               <button type="submit" class="btn sendbutton">Send Message</button> 
                                       
                                                            </form>
                                                            <?php } ?>
                                                            
                                                         </div>
                                       
                                                      </div>
                                       </div>
                                        <div class="col-lg-7">
                                            <div class="card" style="margin-top:0px;">
                                            <div class="card-body" style="height: 496px;">
                                                
                                                <div  class="contacttabscont">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                  <tbody><tr>
                                                    <td colspan="2" style="background-color: var(--blue);  border-radius: 10px;"><div  class="contacticons"><i class="fa fa-map-marker" aria-hidden="true"></i></div></td>
                                                    <td width="99%" style="padding-left:10px;" class="contactcontent"><div class="contactlable">Address</div>
                                                <?php echo stripslashes($getcompanybasicinfo['address']); ?></td>
                                                  </tr>
                                                </tbody></table>
                                                
                                                 </div>
                                                 
                                                 
                                                 <div  class="contacttabscont">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                  <tbody><tr>
                                                    <td colspan="2" style="background-color: var(--blue); border-radius: 10px;"><div  class="contacticons"><i class="fa fa-phone" aria-hidden="true"></i></div></td>
                                                    <td width="99%" style="padding-left:10px;" class="contactcontent"><div class="contactlable">Phone</div>
													<?php echo stripslashes($getcompanybasicinfo['phone']); ?></td>
                                                  </tr>
                                                </tbody></table>
                                                
                                                 </div>
                                                 
                                                 <div  class="contacttabscont">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                  <tbody><tr>
                                                    <td colspan="2"  style="background-color: var(--blue);  border-radius: 10px;"><div  class="contacticons"><i class="fa fa-envelope" aria-hidden="true"></i></div></td>
                                                    <td width="99%" style="padding-left:10px;" class="contactcontent"><div class="contactlable">Email</div>
                                                      <a href="mailto:<?php echo stripslashes($getcompanybasicinfo['email']); ?>"><?php echo stripslashes($getcompanybasicinfo['email']); ?></a></td>
                                                  </tr>
                                                </tbody></table>
                                                
                                                 </div>
                                                 
                                                 <div  class="contacttabscont">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                  <tbody><tr>
                                                    <td colspan="2"  style="background-color: var(--blue);  border-radius: 10px;"><div  class="contacticons"><i class="fa fa-clock-o" aria-hidden="true"></i></div></td>
                                                    <td width="99%" style="padding-left:10px;" class="contactcontent"><div class="contactlable">Working Hours</div>  
                                                Mon – Sun 10:00 am – 7:00 pm We are open 24*7 of every month, including Sundays & public holidays</td>
                                                  </tr>
                                                </tbody></table>
                                                
                                                 </div>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                        


                        </div>

                    </div>



                </div>
            </div>
        </div>
    </div>
	<style>
	.flightfooter{position:fixed; left:0px; bottom:0px; width:100%;}
	</style>
	
	     <?php include "footer.php"; ?>
</body>

</html>
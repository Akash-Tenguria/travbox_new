<?php 
include "inc.php"; 
include "agenturlinc.php"; 
$page='about-us';

$rsa=GetPageRecord('*','sys_contentPages','id=2'); 
$pagecontent=mysqli_fetch_array($rsa); 


$rs=GetPageRecord('*','sys_userMaster','id="'.$staticparentId.'" ');  
$AgentWebsiteData=mysqli_fetch_array($rs);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php echo stripslashes($pagecontent['title']); ?> - <?php echo $systemname; ?></title>
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
                                    <span><?php echo stripslashes($pagecontent['title']); ?></span>
                                </div>
                                <div class="pagecontent">
                                  <?php echo (stripslashes($pagecontent['description'])); ?>

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
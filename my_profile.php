<?php
include "inc.php"; 
include "config/logincheck.php";  
$selectedpage=''; 
$selectleft=''; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>My Profile - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title> 
<?php include "headerinc.php"; ?>
</head>

<body class="greyouter">
  <?php include "header.php"; ?>



<!--------------Left Menu---------------->


<?php include "left.php"; ?>





<!--------------Mid Body---------------->


<section class="profile">
    <div class="container midcontent">
        <div class="card profilecard">
            <div class="card-body">
               
              <h1>Account Information</h1>
                <p>Basic info,for a faster booking experience</p>                
                <div class="table-responsive"><table class="table table-bordered table-striped profiletable" style=" font-size:13px;">
                                            
                                            <tbody> 
                                     <tr>
                                                  <td align="left" valign="top"><div style="width:120px;"><strong>First Name </strong></div></td>
                                                  <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['name']); ?></td>
                                              </tr>
                                                <tr>
                                                  <td width="10%" align="left" valign="top"><strong>Last Name  </strong></td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['lastName']); ?></td>
                                                </tr>
                                                <tr>
                                                  <td width="10%" align="left" valign="top"><strong>Email </strong></td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['email']); ?></td>
                                              </tr>
                                                <tr>
                                                  <td width="10%" align="left" valign="top"><strong>Contact No. </strong></td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['countryCode']); ?><?php echo stripslashes($LoginUserDetails['phone']); ?></td>
                                              </tr>
                                                <tr>
                                                  <td width="10%" align="left" valign="top"><strong>City</strong></td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo getCityName($LoginUserDetails['city']); ?></td>
                                              </tr>
                                                <tr>
                                                  <td align="left" valign="top"><strong>State</strong></td>
                                                  <td align="left" valign="top" class="profiledetail"><?php echo getStateName($LoginUserDetails['state']); ?></td>
                                              </tr>
                                                <tr>
                                                  <td align="left" valign="top"><strong>Country</strong></td>
                                                  <td align="left" valign="top" class="profiledetail"><?php echo getCountryName($LoginUserDetails['country']); ?></td>
                                              </tr>
                                              <tr>
                                                  <td width="10%" align="left" valign="top"><strong>Address</strong></td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['address']); ?></td>
                                              </tr>
                                              
                                              <tr>
                                                <td align="left" valign="top"><strong>Pin Code </strong></td>
                                                <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['pincode']); ?></td>
                                              </tr>
                                            </tbody>
                                      </table>
                                    </div>
                </div>
          </div>
          <div class="card profilecard">
            <div class="card-body">
               
                <h1>Agency Information</h1>
                <p>Basic info,for a faster booking experience</p>                
                <div class="table-responsive"><table class="table table-bordered table-striped profiletable" style=" font-size:13px;">
                                            
                                            <tbody> 
                                     <tr>
                                                  <td align="left" valign="top"><div style="width:120px;"><strong>Logo</strong></div></td>
                                                  <td align="left" valign="top" class="profiledetail"><img src="<?php echo $imgurl; ?><?php echo $LoginUserDetails['companyLogo']; ?>" alt="<?php echo stripslashes($LoginUserDetails['companyName']); ?>"  ></td>
                                              </tr>
                                                <tr>
                                                  <td width="10%" align="left" valign="top"><strong>Agent ID:</strong></td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail">#<?php echo makeAgentId($LoginUserDetails['agentId']); ?></td>
                                                </tr>
                                                <tr>
                                                  <td width="10%" align="left" valign="top"><strong>Company Name</strong></td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['companyName']); ?></td>
                                              </tr>
                                                <tr>
                                                  <td width="10%" align="left" valign="top"><strong>Business Type</strong></td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php if(1==$LoginUserDetails['businessType']){ echo 'Proprietorship'; } 
								  if(2==$LoginUserDetails['businessType']){ echo 'Partnership'; } 
								  if(3==$LoginUserDetails['businessType']){ echo 'Limited Partnership'; } 
								  if(4==$LoginUserDetails['businessType']){ echo 'Corporation'; } 
								  if(5==$LoginUserDetails['businessType']){ echo 'Limited Liability Company'; } 
								  if(6==$LoginUserDetails['businessType']){ echo 'Nonprofit Organization'; } 
								  if(7==$LoginUserDetails['businessType']){ echo 'Cooperative'; } 
								  
								  ?></td>
                                              </tr>
                                                <tr>
                                                  <td width="10%" align="left" valign="top"><strong>PAN</strong></td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['pan']); ?></td>
                                              </tr>
                                                <tr>
                                                  <td align="left" valign="top"><strong>Agency GSTIN</strong></td>
                                                  <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['gstin']); ?></td>
                                              </tr>
                                                <tr>
                                                  <td align="left" valign="top"><strong>Website</strong></td>
                                                  <td align="left" valign="top" class="profiledetail"><?php echo stripslashes($LoginUserDetails['website']); ?></td>
                                              </tr>
                            
                                            </tbody>
                                      </table>
                                    </div>
                </div>
          </div>
    </div>
</section>




<!-- HTML -->




  <?php include "footerinc.php"; ?>

</body>
</html>

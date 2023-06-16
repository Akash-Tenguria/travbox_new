<?php
include "inc.php"; 
include "config/logincheck.php";  
$selectedpage=''; 
$selectleft='settings'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Settings - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title> 
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
               
              <h1>Security</h1> 
			   <p>Change password for this account</p>                
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
                                                  <td width="10%" align="left" valign="top"><strong>Password</strong></td>
                                                  <td width="90%" align="left" valign="top" class="profiledetail">***********</td>
                                              </tr>
                                            </tbody>
                                      </table>
									  
									  <div class=" " style="position:relative; width:100%; text-align:right;"> 
<a style="cursor:pointer;" onClick="loadpop('Change Password',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=changepassword"><button type="button" class="combutton"  >Change Password</button></a> 

 
</div>
              </div>
                </div>
          </div>
          <div class="card profilecard">
            <div class="card-body">
               
                <h1>Fixed Markup</h1>
                <p>Update fixed markup for flight booking</p>                
                <div class="table-responsive"><form method="post" action="<?php echo $fullur; ?>actionpage.php">
<input type="hidden" class="form-control" name="action" value="fixedMarkupAgent">
		<div class="table-responsive">
			<table class="table balancesheettable" style="font-size:13px; width:50%;">
				<thead style="background-color: #f6f6f6;">
			  <th align="left" valign="middle">Flight</th>
				<th width="30%" align="left" valign="middle">Type</th>
					<th width="30%" align="left" valign="middle">Value</th>
				<tbody> 
<?php
$flight=GetPageRecord('*','sys_flightName','1 and status="1" and name!="International"');
while($flightData=mysqli_fetch_array($flight)){ 


$markUp=GetPageRecord('*','fixedMarkupAgent','1 and flightId="'.$flightData["id"].'" and agentId="'.$_SESSION['agentUserid'].'"');
$markUpData=mysqli_fetch_array($markUp);
?>
<tr>
	<input type="hidden" class="form-control" name="flightId[]" value="<?php echo $flightData["id"]; ?>">
	<td align="left" valign="middle"><div style="width:200px;"><strong><?php echo $flightData["name"]; ?></strong></div></td>
	<td width="30%" align="left" valign="middle">
		<select class="form-control" name="type[]">
			<option value="0" <?php if($markUpData["type"]==0){ ?>selected="selected"<?php } ?>>Flat</option>
			<option value="1" <?php if($markUpData["type"]==1){ ?>selected="selected"<?php } ?>>Percentage</option>
		</select>	</td>
	<td width="30%" align="left" valign="middle">
		<input type="number" class="form-control" name="value[]" value="<?php echo $markUpData["value"]; ?>">	</td>
</tr>

<?php } ?>
<?php
$flight=GetPageRecord('*','sys_flightName','1 and status="1" and name="International"');
while($flightData=mysqli_fetch_array($flight)){ 


$markUp=GetPageRecord('*','fixedMarkupAgent','1 and flightId="'.$flightData["id"].'" and agentId="'.$_SESSION['agentUserid'].'"');
$markUpData=mysqli_fetch_array($markUp);
?>
<tr>
	<input type="hidden" class="form-control" name="flightId[]" value="<?php echo $flightData["id"]; ?>">
	<td align="left" valign="middle" style="background-color:#464646; color:#fff;"><div style="width:200px;"><strong><?php echo $flightData["name"]; ?></strong></div></td>
	<td width="30%" align="left" valign="middle" style="background-color:#464646; color:#fff;">
		<select class="form-control" name="type[]">
			<option value="0" <?php if($markUpData["type"]==0){ ?>selected="selected"<?php } ?>>Flat</option>
			<option value="1" <?php if($markUpData["type"]==1){ ?>selected="selected"<?php } ?>>Percentage</option>
		</select>	</td>
	<td width="30%" align="left" valign="middle" style="background-color:#464646; color:#fff;">
		<input type="text" class="form-control" name="value[]" value="<?php echo $markUpData["value"]; ?>">	</td>
</tr>
 

<?php } ?>
				</tbody>
			</table>
 <div style="margin-top:10px;">
   <button type="submit" class="combutton">Update Markup</button>
 </div>


 

</form>
                                    </div>
                </div>
          </div>
    </div>
</section>




<!-- HTML -->




  <?php include "footerinc.php"; ?>

</body>
</html>

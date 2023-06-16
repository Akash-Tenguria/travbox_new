<?php 
include "config/database.php";
include "config/function.php";
include "config/setting.php";
include "agenturlinc.php";


$rs=GetPageRecord('*','sys_userMaster','id="'.$staticparentId.'" ');  
$AgentWebsiteData=mysqli_fetch_array($rs);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Sign Up - <?php echo $systemname; ?></title> 
<?php include "headerinc.php"; ?>

<script>

function selectcity(){

	var stateId = $('#state').val();

	$('#city').load('loadcity.php?id='+stateId+'&selectId=');

	}

	

	function selectstate(){

	var countryId = $('#country').val(); 
	 

	$('#state').load('loadstate.php?id='+countryId+'&selectId='); 

	}


function selectcityuser(){

	var stateId = $('#userState').val();

	$('#userCity').load('loadcity.php?id='+stateId+'&selectId=');

	}

	

	function selectstateuser(){

	var countryId = $('#userCountry').val(); 
	 

	$('#userState').load('loadstate.php?id='+countryId+'&selectId='); 

	}





function checkUID(uid) {
    if (uid.length != 12) {
        return false;
    }

    var Verhoeff = {
        "d": [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
            [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
            [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
            [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
            [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
            [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
            [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
            [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
            [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]],
        "p": [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
            [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
            [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
            [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
            [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
            [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
            [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]],
        "j": [0, 4, 3, 2, 1, 5, 6, 7, 8, 9],
        "check": function (str) {
            var c = 0;
            str.replace(/\D+/g, "").split("").reverse().join("").replace(/[\d]/g, function (u, i) {
                c = Verhoeff.d[c][Verhoeff.p[i % 8][parseInt(u, 10)]];
            });
            return c;

        },
        "get": function (str) {

            var c = 0;
            str.replace(/\D+/g, "").split("").reverse().join("").replace(/[\d]/g, function (u, i) {
                c = Verhoeff.d[c][Verhoeff.p[(i + 1) % 8][parseInt(u, 10)]];
            });
            return Verhoeff.j[c];
        }
    };

    String.prototype.verhoeffCheck = (function () {
        var d = [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 2, 3, 4, 0, 6, 7, 8, 9, 5],
            [2, 3, 4, 0, 1, 7, 8, 9, 5, 6],
            [3, 4, 0, 1, 2, 8, 9, 5, 6, 7],
            [4, 0, 1, 2, 3, 9, 5, 6, 7, 8],
            [5, 9, 8, 7, 6, 0, 4, 3, 2, 1],
            [6, 5, 9, 8, 7, 1, 0, 4, 3, 2],
            [7, 6, 5, 9, 8, 2, 1, 0, 4, 3],
            [8, 7, 6, 5, 9, 3, 2, 1, 0, 4],
            [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]];
        var p = [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            [1, 5, 7, 6, 2, 8, 3, 0, 9, 4],
            [5, 8, 0, 3, 7, 9, 6, 1, 4, 2],
            [8, 9, 1, 6, 0, 4, 3, 5, 2, 7],
            [9, 4, 5, 3, 1, 2, 6, 8, 7, 0],
            [4, 2, 8, 6, 5, 7, 3, 9, 0, 1],
            [2, 7, 9, 3, 8, 0, 6, 4, 1, 5],
            [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]];

        return function () {
            var c = 0;
            this.replace(/\D+/g, "").split("").reverse().join("").replace(/[\d]/g, function (u, i) {
                c = d[c][p[i % 8][parseInt(u, 10)]];
            });
            return (c === 0);
        };
    })();

    if (Verhoeff['check'](uid) === 0) {
        return true;
		alert();
    } else {
        return false;
    }
}



</script>
</head>

<body id="loginbg" class="loginbody">
  <!-- header -->
   
    <div id="loginouter" style="height: auto;margin-top: 20px ;margin-bottom: 20px ; position:inherit;  padding-bottom:130px;">
<div id="loginouterin" style="height: auto;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex"style="border-bottom:1px solid var(--lightgray)">
                <div>
                    <h1 class="pt-3 ms-4 me-4 my-2 pb-3 createheading">Create Your Account</h1>
                      
                </div>
                <div class="registerlogo ms-auto me-3">
                    <img src="<?php echo $imgurlagent; ?><?php echo $AgentWebsiteData['companyLogo']; ?>" alt="">
                </div>
                </div>



	  <form class="login-form" action="process-signup" id="signupform" target="actoinfrm" method="post">

                <div class="row" style="margin:auto;">
            <div class="col-lg-6">
                <div class="createform">
                
                    <h2 class="accountheading">Account Information</h2>
					      <div class="row" >
              	<div class="col-12" style="display:none;">
                            <div class="mb-3">
                                <label for="agentId" class="form-label">Reference By<span class="mdt">*</span></label> 
								
								<select id="salesManager" name="salesManager" class="form-control select-clear" data-placeholder="Select Sales Manager" >  
						<option value="0">Select Manager</option>
						<?php
						$user=GetPageRecord('*','sys_userMaster',' userType="superadmin_user"   order by name asc');
						while($userData=mysqli_fetch_array($user)){
						?>
						<option value="<?php echo $userData['id']; ?>" <?php if($userData['id']==$editresult['salesManager']){ ?>selected="selected"<?php } ?>><?php echo $userData['name']; ?></option> 
						<?php } ?>
						<option value="100001">Others</option>
						</select>
                            </div>
							</div> 
               
                 <div class="col-6">
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name<span class="mdt">*</span></label>
                                <input type="text" name="firstName" id="firstName" class="form-control"  aria-describedby="emailHelp"  >
                            </div>
							</div>
							
							
							 <div class="col-6">
							<div class="mb-3">
                            <label for="lastName" class="form-label">Last Name<span class="mdt">*</span></label>
                            <input  type="name" name="lastName" class="form-control" id="lastName"  >
                        </div>
						</div>
							
							 <div class="col-6">
                            <div class="mb-3">
                                <label for="mobile" class="form-label">Mobile Number<span class="mdt">*</span></label>
                                <input name="mobile" type="number" class="form-control" id="mobile"  >
                            </div>
							</div>
							
							 <div class="col-6">
							<div class="mb-3">
                            <label for="email" class="form-label">Email Address<span class="mdt">*</span></label>
                            <input type="email" class="form-control" name="email" id="email"  >
                        </div>
						</div>
							
							 <div class="col-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password (Min. 8 characters)<span class="mdt">*</span></label>
                                <input type="password" id="password" class="form-control" name="password"  >
                            </div>
							</div>
							
							 <div class="col-6">
							<div class="mb-3">
                            <label for="confirmpassword" class="form-label">Confirm Password<span class="mdt">*</span></label>
                            <input type="password" id="confirmpassword" name="confirmpassword" class="form-control"   >
                        </div>
						</div>

						 


 
                        
                        
                         <div class="col-6">
                        <div class="mb-3">
                            <label for="pincode" class="form-label">Pincode<span class="mdt">*</span></label>
                            <input type="number" class="form-control"  name="pincode" id="pincode"  >
                        </div>
                        </div>
                		<div class="col-6">
                        <div class="mb-3">
                            <label for="aadharNumber" class="form-label">Aadhar Number</label>
                            <input type="text" class="form-control"  name="aadharNumber" id="aadharNumber" >
                        </div>
                        </div>
                <div class="col-12">
                            <div class="mb-3">
                                <label for="address" class="form-label">Residential Address<span class="mdt">*</span></label><br>
                                <input name="address" type="text" class="form-control" id="address" value="" size="30">
                            </div>
                   </div>
                     
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="country" class="form-label">Select Country<span class="mdt">*</span></label>
                                <select class="form-select form-control" name="userCountry" id="userCountry" aria-label="Default select example"  onChange="selectstateuser();">
                                    <option selected>Select Your Country</option>
                             <?php  

$rs=GetPageRecord('*','countryMaster',' deletestatus=0 and status=1  order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?> 

<option value="<?php echo $rest['id']; ?>" <?php if($rest['name']=='India'){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  

<?php } ?>
                                  </select>
								  
								  
                            </div>

                            
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="state" class="form-label">Select State<span class="mdt">*</span></label>
                                <select class="form-select form-control" id="userState" name="userState" aria-label="Default select example"  onChange="selectcityuser();">
                                <option value="">Select Your State</option>
                                  </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="city" class="form-label">Select City<span class="mdt">*</span></label>
                                <select name="userCity" id="userCity" class="form-select form-control" required="required"  tabindex="11">

            <option value="">Select Your City</option>

        </select>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
            
<!-- leftformends -->

               <!-- rightformstarts -->
            <div class="col-lg-6">
                <div class="agencyform">
                    <h2>Agency Information</h2>
                    <!-- companyrow -->
                    <div class="row">
					   <div class="col-6">
						  <div class="mb-3">
                              <label for="companyName" class="form-label">Company Name<span class="mdt">*</span></label>
                              <input type="companyName" class="form-control" id="companyName" name="companyName"  >
                          </div>
						  </div>
						  
                          <div class="col-6">
                            <label for="panNumber" class="form-label">Pan Number <span class="mdt">*</span></label>
                            <input type="text" class="form-control" id="txtPANNumber" name="pan"   >
                        </div>
					<div class="col-6">
						  <div class="mb-3">
                              <label for="companyNumber" class="form-label">Phone Number<span class="mdt">*</span></label>
                              <input type="number" class="form-control" id="companyMobile" name="companyMobile"  >
                          </div>
						  </div>
						  
						<div class="col-6">
							<label for="panNumber" class="form-label">Attach PAN Card Copy</label>
							<input type="file" class="form-control" id="panCopy" name="panCopy"   >
						</div>
						<div class="col-6">
						<div class="mb-3">
							<label for="companyAddress" class="form-label">Company Address<span class="mdt">*</span></label><br>
							<input name="companyAddress" type="text" class="form-control" id="companyAddress" value="" size="30">
						</div>
						</div>


 
                        
                        
                         <div class="col-6">
                        <div class="mb-3">
                            <label for="companyPincode" class="form-label">Company Pincode<span class="mdt">*</span></label>
                            <input type="number" class="form-control"  name="companyPincode" id="companyPincode"  >
                        </div>
                        </div>
                  
							
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="country" class="form-label">Select Country<span class="mdt">*</span></label>
                                <select class="form-select form-control" name="country" id="country" aria-label="Default select example"  onChange="selectstate();">
                                    <option selected>Select Your Country</option>
                             <?php  

$rs=GetPageRecord('*','countryMaster',' deletestatus=0 and status=1  order by name asc');

while($rest=mysqli_fetch_array($rs)){ 

?> 

<option value="<?php echo $rest['id']; ?>" <?php if($rest['name']=='India'){ ?>selected="selected"<?php } ?>><?php echo $rest['name']; ?></option>  

<?php } ?>
                                  </select>
                            </div>

                            
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="state" class="form-label">Select State<span class="mdt">*</span></label>
                                <select class="form-select form-control" id="state" name="state" aria-label="Default select example"  onChange="selectcity();">
                                <option value="">Select Your State</option>
                                  </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="city" class="form-label">Select City<span class="mdt">*</span></label>
                                <select name="city" id="city" class="form-select form-control" required="required"  tabindex="11">

            <option value="">Select Your City</option>

        </select>
                            </div>
                        </div>
             
                          <div class="col-6">
                              <label for="businessType" class="form-label register-lev">Business Type<span class="mdt">*</span></label>
                             
							 <select id="businessType" name="businessType" class="form-select form-control" data-placeholder="Select Business Type" tabindex="-1" aria-hidden="true">  
										<option value="">Select Type</option>  
										<option value="1">Proprietorship</option>  
										<option value="2">Partnership</option>  
										<option value="3">Limited Partnership</option>  
										<option value="4">Corporation</option>  
										<option value="5">Limited Liability Company </option>  
										<option value="6">Nonprofit Organization </option>  
										<option value="7">Cooperative</option>  
									</select>
							   
                          </div>
                          <div class="col-6">
						  <div class="mb-3">
                            <label for="gstNumber" class="form-label">GST Number</label>
                            <input type="text" class="form-control" name="gstNumber" id="gstNumber"  >
								</div>
                        </div>
                       
                    <div class="col-lg-12 my-4">
                    <h6> <input type="checkbox" name="iaccept" value="1" class="checkbox"> I accept the <a target="_blank" href="terms-conditions">terms &amp; conditions</a></h6>
                    </div>  <!-- atacchaddharcopy -->
					
					</div>
               
            <!-- rightformends -->
        </div>
    </div>
                </div>
                <div class="row" style="border-top: 1px solid var(--lightgray); margin: auto; padding: 20px 10px;">
        <div class="col-lg-6">
            <div class="youhave my-1">
                <p>Already have account? <a href="<?php echo $fullurl; ?>">Login now</a></p>
            </div>
        </div>
        <div class="col-lg-6" style="text-align: right;">
    
            <button type="button" class="btn btn-danger registerbutton" onClick="submitregister();" style=" width:200px;">Register</button>
                </div>
            
        </div>
		<input name="action" type="hidden" value="register">
			<input name="validpan" id="validpan" type="hidden" value="0">
</form>
 
    </div>
</div>
</div>
</div>

<script>
selectstateuser();
selectstate();


$('#txtPANNumber').change(function (event) {     
 var regExp = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/; 
 var txtpan = $(this).val(); 
 if (txtpan.length == 10 ) { 
  if( txtpan.match(regExp) ){ 
   $('#validpan').val('1');
  }
  else {
   alert('Not a valid PAN number');
   event.preventDefault(); 
  } 
 } 
 else { 
       alert('Please enter 10 digits for a valid PAN number');
       event.preventDefault(); 
 } 

});


/*function submitregister(){

var aadharNumber = $('#aadharNumber').val();
 
if(checkUID(aadharNumber)){

if($('#validpan').val()==1){
 
$('#signupform').submit();

} else {
alert('Please enter valid pan number.');
}

} else { 
alert('Please enter correct aadhaar number.');
}


}*/




function submitregister(){

var aadharNumber = $('#aadharNumber').val();
 

if($('#validpan').val()==1){
 
$('#signupform').submit();

} else {
alert('Please enter valid pan number.');
}
 


}








var panVal = $('#pan').val();
var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;

if(regpan.test(panVal)){
   // valid pan card number
} else {
   // invalid pan card number
}
</script>
	<style>
	.flightfooter{position:fixed; left:0px; bottom:0px; width:100%;}
	</style>
<?php include "footerinc.php"; ?>
<?php include "footer.php"; ?> 
</body>
</html>

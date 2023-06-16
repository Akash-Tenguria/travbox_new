<?php
include "inc.php";  
include "config/logincheck.php";

$a=GetPageRecord('*','wig_flight_json_bkp',' id="'.decode($_REQUEST['i']).'" and agentId="'.$_SESSION['agentUserid'].'"');
$res=mysqli_fetch_array($a);


$bookingServiceType="flight";
$_SESSION['serviceId']=$res["id"];


$journeyDate1= date('Y-m-d',strtotime($res['DEP_DATE']));
$infantDate = strtotime($journeyDate1.' -2 year');
$infantDateValidate=date('Y-m-d',$infantDate);

$childDate = strtotime($journeyDate1.' -12 year');
$childDateValidate=date('Y-m-d',$childDate);


if($_REQUEST['r']!=''){

$ab=GetPageRecord('*','wig_flight_json_bkp',' id="'.decode($_REQUEST['r']).'" and agentId="'.$_SESSION['agentUserid'].'"');
$resret=mysqli_fetch_array($ab);

$str_arr = explode (",", $resret['agfare']);  
$basefare = explode ("=", $str_arr[0]);
$basefareret = $basefare[1];


$bst = explode ("=", $str_arr[1]);
$basetaxret = $bst[1];

$bsf = explode ("=", $str_arr[2]);
$totalfareret = $bsf[1];

}


if($res['id']=="" || $res['id']<1){
echo "Something went wrong...<br>Please back to search page.";
exit();
}

 
 
?>
 

 
<div class="top_bg_ofr_sb2 flightreview ">
<div class="container">
<table border="0" align="left" cellpadding="0" cellspacing="0" class="sttable">
  <tr>
    <td >
	 
<table border="0" cellpadding="0" cellspacing="0" class="flightreviewbox active" id="strp1"  >
  <tr>
    <td colspan="2"><div class="iconfa"><i class="fa fa-plane" aria-hidden="true"></i></div></td>
    <td><div class="steptext">FIRST STEP</div>Flight Itinerary</td>
  </tr>
</table>	</td>
	
    <td  class="showonlyaftercheck">
	 
	 <div class="midline"></div>	</td>
 
    <td  class="showonlyaftercheck"> 
	 
	<table border="0" cellpadding="0" cellspacing="0" class="flightreviewbox"  id="strp2" >
  <tr>
    <td colspan="2"><div class="iconfa"><i class="fa fa-user" aria-hidden="true"></i></div></td>
    <td><div class="steptext">SECOND STEP</div>Passenger Details</td>
  </tr>
</table>	</td>
    <td  class="showonlyaftercheck"><div class="midline"></div></td>
     
    <td class="showonlyaftercheck"> <table border="0" cellpadding="0" cellspacing="0" class="flightreviewbox"  id="strp4">
  <tr>
    <td colspan="2"><div class="iconfa"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></div></td>
    <td><div class="steptext">FINISH STEP</div>Payments</td>
  </tr>
</table></td>
  </tr>
</table>

</div>
</div>


 


<div class="container" style="margin-top:20px; margin-bottom:20px;"> 
<form id="flightbookingsubmit" method="post" action="flight-booking-action4">
<div class="row" id="bookingdatainfo">
<div class="col-8" style="min-height:500px;">

<div class="row">
<div class="col-12" style="position:relative; margin-bottom:20px;"  >
<h2>Flight Details</h2>
 


<div class="card cardresult" style="width:100%;">
<div class="card-header">
    <?php echo stripslashes($res['ORG_NAME']); ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php echo stripslashes($res['DES_NAME']); ?> <span>on  <?php echo date('D, M d Y',strtotime(trim($res['DEP_DATE']))); ?> &nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;<?php echo $res['DUR']; ?></span>
  </div>
<div class="card-body">
<div class="detailscontent">
<div class="row">
<div class="col-12">

<?php
$j=0; 

//echo "<pre>";
//print_r ((unserialize(stripslashes($res['CON_DETAILS']))));

foreach((array) unserialize(stripslashes($res['CON_DETAILS'])) as $layoverFlight){

if($layoverFlight->FLIGHT_NAME!=''){
?>
<div class="row multiflightbox">
<div class="col-3">
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])); ?>" width="32" height="32"></td>
    <td>
	<div class="flightname"><?php echo $layoverFlight->FLIGHT_NAME; ?> </div>
	<div class="flightnumber"><?php echo $layoverFlight->FLIGHT_CODE; ?> <?php echo $layoverFlight->FLIGHT_NO; ?></div>
	
	</td>
  </tr>
</table>

</div>

<div class="col-9">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div class="coltime">
	<?php echo date('D, M d Y',strtotime($layoverFlight->DEP_DATE)); ?> <?php echo $layoverFlight->DEP_TIME; ?></div>
	<div class="graysmalltext">
	<?php echo $layoverFlight->ORG_NAME; ?><br>
Terminal <?php if($layoverFlight->ORG_TRML!=''){ echo $layoverFlight->ORG_TRML; } else { echo '1'; } ?></div>
	</td>
    <td width="33%" align="center"><div class="nostops"><?php echo $layoverFlight->DURATION; ?></div> <div style="margin-top:2px;">Non-Stop</div></td>
    <td width="33%" align="center"><div class="coltime">
	<?php echo date('D, M d Y',strtotime($layoverFlight->ARRV_DATE)); ?> <?php echo $layoverFlight->ARRV_TIME; ?></div>
	<div class="graysmalltext">
	<?php echo $layoverFlight->DES_NAME; ?><br>
Terminal <?php if($layoverFlight->DES_TRML!=''){ echo $layoverFlight->DES_TRML; } else { echo '1'; } ?></div></td>
  </tr>
</table>

</div>
<?php
  
$arr=explode("|",unserialize(stripslashes($res['searchJson']))->FLIGHT_INFO)
?>
<div style="margin:0px 0px;"><i class="fa fa-suitcase" aria-hidden="true"></i> <?php echo str_replace(':',': ',str_replace(',',', ',str_replace('=',': ',$arr[2]))); ?></div>
<?php if($layoverFlight->LAYOVER_INFO!=''){ ?>
  <div style="text-align: center; color: #0b0b0b; padding: 5px; background-color: #e4f8ff; font-weight: 600; border-radius: 24px; margin-top:20px;margin-bottom:20px;"><?php echo $layoverFlight->LAYOVER_INFO; ?></div>
<?php } ?>
</div>

	  <?php  $j++; } } ?>
	  
<?php if($j==0){ ?>
<div class="row multiflightbox">
<div class="col-4">
 <table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="<?php echo $imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])); ?>" width="32" height="32"></td>
    <td>
	<div class="flightname"><?php echo stripslashes($res['FLIGHT_NAME']); ?></div>
	<div class="flightnumber"><?php echo stripslashes($res['FLIGHT_CODE']); ?>-<?php echo stripslashes($res['FLIGHT_NO']); ?></div>
	
	</td>
  </tr>
</table>

</div>

<div class="col-8">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="33%" align="center">
	<div class="coltime">
	<?php echo date('D, M d Y',strtotime($res['DEP_DATE'])); ?> <?php echo stripslashes($res['DEP_TIME']); ?></div>
	<div class="graysmalltext">
	<?php echo stripslashes($res['ORG_NAME']); ?></div>
	</td>
    <td width="33%" align="center"><div class="nostops"><?php echo $res['DUR']; ?></div><div class="graysmalltext"><?php if($res['STOP']==0){ ?>
			Non Stop<?php  }else{ ?><span style="color:#bf0000 !important;"><?php echo $res['STOP'].' Stop '; ?></span><?php } ?></div></td>
    <td width="33%" align="center"><div class="coltime">
	<?php echo date('D, M d Y',strtotime($res['ARRV_DATE'])); ?> <?php echo stripslashes($res['ARRV_TIME']); ?></div>
	<div class="graysmalltext">
	<?php echo stripslashes($res['DES_NAME']); ?></div></td>
  </tr>
</table>

</div>
</div>



<?php } ?>



 

</div>
</div>

</div>
</div>

 
 
</div>

</div>


<div class="col-12" style="position:relative;display:none;"  id="steptwopassengerdetails">
<h2>Passenger Details

<script>
 function clearfield(){
 $('#steptwopassengerdetails input').val('');
 $('#steptwopassengerdetails select').val('');
 }
</script>

<button type="button" class="btn btn-danger btn-sm float-left tpbtn" style="position: absolute; right: 80px; background-color:#CC3300;border:1px solid #CC3300;" onClick="clearfield();" >Clear</button><button type="button" class="btn btn-danger btn-sm float-left tpbtn" style="position: absolute; right: 0px;" onClick="loadpop('Import Customer',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=importcustomertobooking" >Import</button>

</h2>
<div class="card cardresult" style="width:100%;">



   <!-- Input -->
				
										
										<?php for($adult=1; $adult<=$_SESSION['ADT']; $adult++){ ?>
										
							 <div class="card-header">Adult <?php echo $adult; ?> (12 + yrs)</div>
										 
						 <div class="card-body">
										<div class="row">
										<div class="col-sm-2 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Title
                                                </label>
												<select class="form-control validate1" name="titleAdt<?php echo $adult; ?>" id="titleAdt<?php echo $adult; ?>">
													<option value="">Select</option> 
													<option value="Mr">Mr.</option> 
													<option value="Mrs">Mrs</option> 
													<option value="Ms">Ms.</option> 
													<option value="Miss">Miss.</option> 
													<option value="Dr">Dr.</option>  
													<option value="Professor">Professor.</option>
												</select>
                                            </div>
                                        </div>
										
                                        <div class="col-sm-4 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    First Name
                                                </label>

                                                <input type="text" class="form-control validate1" name="firstNameAdt<?php echo $adult; ?>" id="firstNameAdt<?php echo $adult; ?>" placeholder="" aria-label="" required
                                                data-msg="Please enter your first name."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <!-- Input -->
                                        <div class="col-sm-3 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Last name
                                                </label>

                                                <input type="text" class="form-control validate1" name="lastNameAdt<?php echo $adult; ?>" id="lastNameAdt<?php echo $adult; ?>" required
                                                data-msg="Please enter your last name."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                                            </div>
                                        </div>
										
										<div class="col-sm-3 mb-4" style="display:none;">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    DOB
                                                </label>
												<div id="datepickerWrapperFromadt<?php echo $adult; ?>" class="u-datepicker input-group">
                        <div class="input-group-prepend"> <span class="d-flex align-items-center mr-2"> <i class="flaticon-calendar text-primary font-weight-semi-bold"></i> </span> </div>
												<input class="font-size-lg-16 form-control validate1 border-1 datepickerfield"  id="dobAdt<?php echo $adult; ?>" name="dobAdt<?php echo $adult; ?>" readonly="readonly" value="01-01-1988">
												</div>	 
                                            </div>
                                        </div>
                                        <!-- End Input -->
										
										<div class="w-100"></div>
										
                                        <!-- Input -->
                                        
                                        <!-- End Input -->
										<?php if($sector=='I'){ ?>
                                        <!-- Input -->
										<div class="col-sm-4 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Passport Provided Country
                                                </label>
                                                <select class="form-control validate1 js-select selectpicker dropdown-select" id="nationalityAdt<?php echo $adult; ?>" name="nationalityAdt<?php echo $adult; ?>" data-msg="Please select country." data-error-class="u-has-error" data-success-class="u-has-success"
                                                    data-live-search="true"
                                                    data-style="form-control validate1 font-size-16 border-width-2 border-gray font-weight-normal">
                                                    <option value="">Select country</option>
                                                    <option value="AF">Afghanistan</option>
                                                    <option value="AX">Åland Islands</option>
                                                    <option value="AL">Albania</option>
                                                    <option value="DZ">Algeria</option>
                                                    <option value="AS">American Samoa</option>
                                                    <option value="AD">Andorra</option>
                                                    <option value="AO">Angola</option>
                                                    <option value="AI">Anguilla</option>
                                                    <option value="AQ">Antarctica</option>
                                                    <option value="AG">Antigua and Barbuda</option>
                                                    <option value="AR">Argentina</option>
                                                    <option value="AM">Armenia</option>
                                                    <option value="AW">Aruba</option>
                                                    <option value="AU">Australia</option>
                                                    <option value="AT">Austria</option>
                                                    <option value="AZ">Azerbaijan</option>
                                                    <option value="BS">Bahamas</option>
                                                    <option value="BH">Bahrain</option>
                                                    <option value="BD">Bangladesh</option>
                                                    <option value="BB">Barbados</option>
                                                    <option value="BY">Belarus</option>
                                                    <option value="BE">Belgium</option>
                                                    <option value="BZ">Belize</option>
                                                    <option value="BJ">Benin</option>
                                                    <option value="BM">Bermuda</option>
                                                    <option value="BT">Bhutan</option>
                                                    <option value="BO">Bolivia, Plurinational State of</option>
                                                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                    <option value="BA">Bosnia and Herzegovina</option>
                                                    <option value="BW">Botswana</option>
                                                    <option value="BV">Bouvet Island</option>
                                                    <option value="BR">Brazil</option>
                                                    <option value="IO">British Indian Ocean Territory</option>
                                                    <option value="BN">Brunei Darussalam</option>
                                                    <option value="BG">Bulgaria</option>
                                                    <option value="BF">Burkina Faso</option>
                                                    <option value="BI">Burundi</option>
                                                    <option value="KH">Cambodia</option>
                                                    <option value="CM">Cameroon</option>
                                                    <option value="CA">Canada</option>
                                                    <option value="CV">Cape Verde</option>
                                                    <option value="KY">Cayman Islands</option>
                                                    <option value="CF">Central African Republic</option>
                                                    <option value="TD">Chad</option>
                                                    <option value="CL">Chile</option>
                                                    <option value="CN">China</option>
                                                    <option value="CX">Christmas Island</option>
                                                    <option value="CC">Cocos (Keeling) Islands</option>
                                                    <option value="CO">Colombia</option>
                                                    <option value="KM">Comoros</option>
                                                    <option value="CG">Congo</option>
                                                    <option value="CD">Congo, the Democratic Republic of the</option>
                                                    <option value="CK">Cook Islands</option>
                                                    <option value="CR">Costa Rica</option>
                                                    <option value="CI">Côte d'Ivoire</option>
                                                    <option value="HR">Croatia</option>
                                                    <option value="CU">Cuba</option>
                                                    <option value="CW">Curaçao</option>
                                                    <option value="CY">Cyprus</option>
                                                    <option value="CZ">Czech Republic</option>
                                                    <option value="DK">Denmark</option>
                                                    <option value="DJ">Djibouti</option>
                                                    <option value="DM">Dominica</option>
                                                    <option value="DO">Dominican Republic</option>
                                                    <option value="EC">Ecuador</option>
                                                    <option value="EG">Egypt</option>
                                                    <option value="SV">El Salvador</option>
                                                    <option value="GQ">Equatorial Guinea</option>
                                                    <option value="ER">Eritrea</option>
                                                    <option value="EE">Estonia</option>
                                                    <option value="ET">Ethiopia</option>
                                                    <option value="FK">Falkland Islands (Malvinas)</option>
                                                    <option value="FO">Faroe Islands</option>
                                                    <option value="FJ">Fiji</option>
                                                    <option value="FI">Finland</option>
                                                    <option value="FR">France</option>
                                                    <option value="GF">French Guiana</option>
                                                    <option value="PF">French Polynesia</option>
                                                    <option value="TF">French Southern Territories</option>
                                                    <option value="GA">Gabon</option>
                                                    <option value="GM">Gambia</option>
                                                    <option value="GE">Georgia</option>
                                                    <option value="DE">Germany</option>
                                                    <option value="GH">Ghana</option>
                                                    <option value="GI">Gibraltar</option>
                                                    <option value="GR">Greece</option>
                                                    <option value="GL">Greenland</option>
                                                    <option value="GD">Grenada</option>
                                                    <option value="GP">Guadeloupe</option>
                                                    <option value="GU">Guam</option>
                                                    <option value="GT">Guatemala</option>
                                                    <option value="GG">Guernsey</option>
                                                    <option value="GN">Guinea</option>
                                                    <option value="GW">Guinea-Bissau</option>
                                                    <option value="GY">Guyana</option>
                                                    <option value="HT">Haiti</option>
                                                    <option value="HM">Heard Island and McDonald Islands</option>
                                                    <option value="VA">Holy See (Vatican City State)</option>
                                                    <option value="HN">Honduras</option>
                                                    <option value="HK">Hong Kong</option>
                                                    <option value="HU">Hungary</option>
                                                    <option value="IS">Iceland</option>
                                                    <option value="IN">India</option>
                                                    <option value="ID">Indonesia</option>
                                                    <option value="IR">Iran, Islamic Republic of</option>
                                                    <option value="IQ">Iraq</option>
                                                    <option value="IE">Ireland</option>
                                                    <option value="IM">Isle of Man</option>
                                                    <option value="IL">Israel</option>
                                                    <option value="IT">Italy</option>
                                                    <option value="JM">Jamaica</option>
                                                    <option value="JP">Japan</option>
                                                    <option value="JE">Jersey</option>
                                                    <option value="JO">Jordan</option>
                                                    <option value="KZ">Kazakhstan</option>
                                                    <option value="KE">Kenya</option>
                                                    <option value="KI">Kiribati</option>
                                                    <option value="KP">Korea, Democratic People's Republic of</option>
                                                    <option value="KR">Korea, Republic of</option>
                                                    <option value="KW">Kuwait</option>
                                                    <option value="KG">Kyrgyzstan</option>
                                                    <option value="LA">Lao People's Democratic Republic</option>
                                                    <option value="LV">Latvia</option>
                                                    <option value="LB">Lebanon</option>
                                                    <option value="LS">Lesotho</option>
                                                    <option value="LR">Liberia</option>
                                                    <option value="LY">Libya</option>
                                                    <option value="LI">Liechtenstein</option>
                                                    <option value="LT">Lithuania</option>
                                                    <option value="LU">Luxembourg</option>
                                                    <option value="MO">Macao</option>
                                                    <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                                    <option value="MG">Madagascar</option>
                                                    <option value="MW">Malawi</option>
                                                    <option value="MY">Malaysia</option>
                                                    <option value="MV">Maldives</option>
                                                    <option value="ML">Mali</option>
                                                    <option value="MT">Malta</option>
                                                    <option value="MH">Marshall Islands</option>
                                                    <option value="MQ">Martinique</option>
                                                    <option value="MR">Mauritania</option>
                                                    <option value="MU">Mauritius</option>
                                                    <option value="YT">Mayotte</option>
                                                    <option value="MX">Mexico</option>
                                                    <option value="FM">Micronesia, Federated States of</option>
                                                    <option value="MD">Moldova, Republic of</option>
                                                    <option value="MC">Monaco</option>
                                                    <option value="MN">Mongolia</option>
                                                    <option value="ME">Montenegro</option>
                                                    <option value="MS">Montserrat</option>
                                                    <option value="MA">Morocco</option>
                                                    <option value="MZ">Mozambique</option>
                                                    <option value="MM">Myanmar</option>
                                                    <option value="NA">Namibia</option>
                                                    <option value="NR">Nauru</option>
                                                    <option value="NP">Nepal</option>
                                                    <option value="NL">Netherlands</option>
                                                    <option value="NC">New Caledonia</option>
                                                    <option value="NZ">New Zealand</option>
                                                    <option value="NI">Nicaragua</option>
                                                    <option value="NE">Niger</option>
                                                    <option value="NG">Nigeria</option>
                                                    <option value="NU">Niue</option>
                                                    <option value="NF">Norfolk Island</option>
                                                    <option value="MP">Northern Mariana Islands</option>
                                                    <option value="NO">Norway</option>
                                                    <option value="OM">Oman</option>
                                                    <option value="PK">Pakistan</option>
                                                    <option value="PW">Palau</option>
                                                    <option value="PS">Palestinian Territory, Occupied</option>
                                                    <option value="PA">Panama</option>
                                                    <option value="PG">Papua New Guinea</option>
                                                    <option value="PY">Paraguay</option>
                                                    <option value="PE">Peru</option>
                                                    <option value="PH">Philippines</option>
                                                    <option value="PN">Pitcairn</option>
                                                    <option value="PL">Poland</option>
                                                    <option value="PT">Portugal</option>
                                                    <option value="PR">Puerto Rico</option>
                                                    <option value="QA">Qatar</option>
                                                    <option value="RE">Réunion</option>
                                                    <option value="RO">Romania</option>
                                                    <option value="RU">Russian Federation</option>
                                                    <option value="RW">Rwanda</option>
                                                    <option value="BL">Saint Barthélemy</option>
                                                    <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                                    <option value="KN">Saint Kitts and Nevis</option>
                                                    <option value="LC">Saint Lucia</option>
                                                    <option value="MF">Saint Martin (French part)</option>
                                                    <option value="PM">Saint Pierre and Miquelon</option>
                                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                                    <option value="WS">Samoa</option>
                                                    <option value="SM">San Marino</option>
                                                    <option value="ST">Sao Tome and Principe</option>
                                                    <option value="SA">Saudi Arabia</option>
                                                    <option value="SN">Senegal</option>
                                                    <option value="RS">Serbia</option>
                                                    <option value="SC">Seychelles</option>
                                                    <option value="SL">Sierra Leone</option>
                                                    <option value="SG">Singapore</option>
                                                    <option value="SX">Sint Maarten (Dutch part)</option>
                                                    <option value="SK">Slovakia</option>
                                                    <option value="SI">Slovenia</option>
                                                    <option value="SB">Solomon Islands</option>
                                                    <option value="SO">Somalia</option>
                                                    <option value="ZA">South Africa</option>
                                                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                    <option value="SS">South Sudan</option>
                                                    <option value="ES">Spain</option>
                                                    <option value="LK">Sri Lanka</option>
                                                    <option value="SD">Sudan</option>
                                                    <option value="SR">Suriname</option>
                                                    <option value="SJ">Svalbard and Jan Mayen</option>
                                                    <option value="SZ">Swaziland</option>
                                                    <option value="SE">Sweden</option>
                                                    <option value="CH">Switzerland</option>
                                                    <option value="SY">Syrian Arab Republic</option>
                                                    <option value="TW">Taiwan, Province of China</option>
                                                    <option value="TJ">Tajikistan</option>
                                                    <option value="TZ">Tanzania, United Republic of</option>
                                                    <option value="TH">Thailand</option>
                                                    <option value="TL">Timor-Leste</option>
                                                    <option value="TG">Togo</option>
                                                    <option value="TK">Tokelau</option>
                                                    <option value="TO">Tonga</option>
                                                    <option value="TT">Trinidad and Tobago</option>
                                                    <option value="TN">Tunisia</option>
                                                    <option value="TR">Turkey</option>
                                                    <option value="TM">Turkmenistan</option>
                                                    <option value="TC">Turks and Caicos Islands</option>
                                                    <option value="TV">Tuvalu</option>
                                                    <option value="UG">Uganda</option>
                                                    <option value="UA">Ukraine</option>
                                                    <option value="AE">United Arab Emirates</option>
                                                    <option value="GB">United Kingdom</option>
                                                    <option value="US">United States</option>
                                                    <option value="UM">United States Minor Outlying Islands</option>
                                                    <option value="UY">Uruguay</option>
                                                    <option value="UZ">Uzbekistan</option>
                                                    <option value="VU">Vanuatu</option>
                                                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                                                    <option value="VN">Viet Nam</option>
                                                    <option value="VG">Virgin Islands, British</option>
                                                    <option value="VI">Virgin Islands, U.S.</option>
                                                    <option value="WF">Wallis and Futuna</option>
                                                    <option value="EH">Western Sahara</option>
                                                    <option value="YE">Yemen</option>
                                                    <option value="ZM">Zambia</option>
                                                    <option value="ZW">Zimbabwe</option>
                                                </select>
                                            </div>
                                        </div>
										
										
                                        <div class="col-sm-4 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Passport Number
                                                </label>
                                                <input type="text" class="form-control validate1" name="passportNumberAdt<?php echo $adult; ?>" id="passportNumberAdt<?php echo $adult;?>" placeholder="" aria-label="" 
                                                data-msg="Please enter passport number"
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope" required>
                                            </div>
                                        </div>
										
										<div class="col-sm-4 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Passport Expiry
                                                </label>
                                                <input type="text" class="form-control validate1 datepickerfieldexpiry" name="passportExpiryAdt<?php echo $adult; ?>" id="passportExpiryAdt<?php echo $adult;?>" placeholder="" aria-label="" 
                                                data-msg="Please enter expiry Date"
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope" required>
                                            </div>
                                        </div>
                                        <!-- End Input -->
										<?php } ?>
								 </div>
								 </div>
										
										<input name="totaladult" type="hidden" value="<?php echo $adult; ?>">
										<?php }
										$totaladultcount=$adult;
										 ?>
										
									
										
										<?php
										for($child=1; $child<=$_SESSION['CHD']; $child++){
										?>
										 				
							 <div class="card-header">Child <?php echo $child; ?> (2 + yrs)</div>
							   			 
						 <div class="card-body">
										
				
										<div class="row">
										
										<div class="col-sm-2 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Title
                                                </label>
												<select class="form-control validate1" name="titleChd<?php echo $child; ?>" id="titleChd<?php echo $child; ?>">
										<option value="">Select</option> 
													<option value="Mr">Mr.</option> 
													<option value="Mrs">Mrs</option> 
													<option value="Ms">Ms.</option> 
													<option value="Miss">Miss.</option>  
												</select>
                                            </div>
                                        </div>
										
                                        <div class="col-sm-4 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    First Name
                                                </label>

                                                <input type="text" class="form-control validate1" name="firstNameChd<?php echo $child; ?>" id="firstNameChd<?php echo $child; ?>" placeholder="" aria-label="" required
                                                data-msg="Please enter your first name."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <!-- Input -->
                                        <div class="col-sm-3 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Last name
                                                </label>

                                                <input type="text" class="form-control validate1" name="lastNameChd<?php echo $child; ?>" id="lastNameChd<?php echo $child; ?>" required
                                                data-msg="Please enter your last name."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                                            </div>
                                        </div>
										
										<div class="col-sm-3 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    DOB
                                                </label>
												<input class="form-control validate1 datepickerfieldchild"  id="dobChd<?php echo $child; ?>" name="dobChd<?php echo $child; ?>" readonly="readonly">				 
                                            </div>
                                        </div>
										
										<?php if($sector=='I'){ ?>
                                        <!-- Input -->
										<div class="col-sm-4 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Passport Provided Country
                                                </label>
                                                <select class="form-control js-select selectpicker dropdown-select" id="nationalityChd<?php echo $child; ?>" name="nationalityChd<?php echo $child; ?>"  data-msg="Please select country." data-error-class="u-has-error" data-success-class="u-has-success"
                                                    data-live-search="true"
                                                    data-style="form-control font-size-16 border-width-2 border-gray font-weight-normal">
                                                    <option value="">Select country</option>
                                                    <option value="AF">Afghanistan</option>
                                                    <option value="AX">Åland Islands</option>
                                                    <option value="AL">Albania</option>
                                                    <option value="DZ">Algeria</option>
                                                    <option value="AS">American Samoa</option>
                                                    <option value="AD">Andorra</option>
                                                    <option value="AO">Angola</option>
                                                    <option value="AI">Anguilla</option>
                                                    <option value="AQ">Antarctica</option>
                                                    <option value="AG">Antigua and Barbuda</option>
                                                    <option value="AR">Argentina</option>
                                                    <option value="AM">Armenia</option>
                                                    <option value="AW">Aruba</option>
                                                    <option value="AU">Australia</option>
                                                    <option value="AT">Austria</option>
                                                    <option value="AZ">Azerbaijan</option>
                                                    <option value="BS">Bahamas</option>
                                                    <option value="BH">Bahrain</option>
                                                    <option value="BD">Bangladesh</option>
                                                    <option value="BB">Barbados</option>
                                                    <option value="BY">Belarus</option>
                                                    <option value="BE">Belgium</option>
                                                    <option value="BZ">Belize</option>
                                                    <option value="BJ">Benin</option>
                                                    <option value="BM">Bermuda</option>
                                                    <option value="BT">Bhutan</option>
                                                    <option value="BO">Bolivia, Plurinational State of</option>
                                                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                    <option value="BA">Bosnia and Herzegovina</option>
                                                    <option value="BW">Botswana</option>
                                                    <option value="BV">Bouvet Island</option>
                                                    <option value="BR">Brazil</option>
                                                    <option value="IO">British Indian Ocean Territory</option>
                                                    <option value="BN">Brunei Darussalam</option>
                                                    <option value="BG">Bulgaria</option>
                                                    <option value="BF">Burkina Faso</option>
                                                    <option value="BI">Burundi</option>
                                                    <option value="KH">Cambodia</option>
                                                    <option value="CM">Cameroon</option>
                                                    <option value="CA">Canada</option>
                                                    <option value="CV">Cape Verde</option>
                                                    <option value="KY">Cayman Islands</option>
                                                    <option value="CF">Central African Republic</option>
                                                    <option value="TD">Chad</option>
                                                    <option value="CL">Chile</option>
                                                    <option value="CN">China</option>
                                                    <option value="CX">Christmas Island</option>
                                                    <option value="CC">Cocos (Keeling) Islands</option>
                                                    <option value="CO">Colombia</option>
                                                    <option value="KM">Comoros</option>
                                                    <option value="CG">Congo</option>
                                                    <option value="CD">Congo, the Democratic Republic of the</option>
                                                    <option value="CK">Cook Islands</option>
                                                    <option value="CR">Costa Rica</option>
                                                    <option value="CI">Côte d'Ivoire</option>
                                                    <option value="HR">Croatia</option>
                                                    <option value="CU">Cuba</option>
                                                    <option value="CW">Curaçao</option>
                                                    <option value="CY">Cyprus</option>
                                                    <option value="CZ">Czech Republic</option>
                                                    <option value="DK">Denmark</option>
                                                    <option value="DJ">Djibouti</option>
                                                    <option value="DM">Dominica</option>
                                                    <option value="DO">Dominican Republic</option>
                                                    <option value="EC">Ecuador</option>
                                                    <option value="EG">Egypt</option>
                                                    <option value="SV">El Salvador</option>
                                                    <option value="GQ">Equatorial Guinea</option>
                                                    <option value="ER">Eritrea</option>
                                                    <option value="EE">Estonia</option>
                                                    <option value="ET">Ethiopia</option>
                                                    <option value="FK">Falkland Islands (Malvinas)</option>
                                                    <option value="FO">Faroe Islands</option>
                                                    <option value="FJ">Fiji</option>
                                                    <option value="FI">Finland</option>
                                                    <option value="FR">France</option>
                                                    <option value="GF">French Guiana</option>

                                                    <option value="PF">French Polynesia</option>
                                                    <option value="TF">French Southern Territories</option>
                                                    <option value="GA">Gabon</option>
                                                    <option value="GM">Gambia</option>
                                                    <option value="GE">Georgia</option>
                                                    <option value="DE">Germany</option>
                                                    <option value="GH">Ghana</option>
                                                    <option value="GI">Gibraltar</option>
                                                    <option value="GR">Greece</option>
                                                    <option value="GL">Greenland</option>
                                                    <option value="GD">Grenada</option>
                                                    <option value="GP">Guadeloupe</option>
                                                    <option value="GU">Guam</option>
                                                    <option value="GT">Guatemala</option>
                                                    <option value="GG">Guernsey</option>
                                                    <option value="GN">Guinea</option>
                                                    <option value="GW">Guinea-Bissau</option>
                                                    <option value="GY">Guyana</option>
                                                    <option value="HT">Haiti</option>
                                                    <option value="HM">Heard Island and McDonald Islands</option>
                                                    <option value="VA">Holy See (Vatican City State)</option>
                                                    <option value="HN">Honduras</option>
                                                    <option value="HK">Hong Kong</option>
                                                    <option value="HU">Hungary</option>
                                                    <option value="IS">Iceland</option>
                                                    <option value="IN">India</option>
                                                    <option value="ID">Indonesia</option>
                                                    <option value="IR">Iran, Islamic Republic of</option>
                                                    <option value="IQ">Iraq</option>
                                                    <option value="IE">Ireland</option>
                                                    <option value="IM">Isle of Man</option>
                                                    <option value="IL">Israel</option>
                                                    <option value="IT">Italy</option>
                                                    <option value="JM">Jamaica</option>
                                                    <option value="JP">Japan</option>
                                                    <option value="JE">Jersey</option>
                                                    <option value="JO">Jordan</option>
                                                    <option value="KZ">Kazakhstan</option>
                                                    <option value="KE">Kenya</option>
                                                    <option value="KI">Kiribati</option>
                                                    <option value="KP">Korea, Democratic People's Republic of</option>
                                                    <option value="KR">Korea, Republic of</option>
                                                    <option value="KW">Kuwait</option>
                                                    <option value="KG">Kyrgyzstan</option>
                                                    <option value="LA">Lao People's Democratic Republic</option>
                                                    <option value="LV">Latvia</option>
                                                    <option value="LB">Lebanon</option>
                                                    <option value="LS">Lesotho</option>
                                                    <option value="LR">Liberia</option>
                                                    <option value="LY">Libya</option>
                                                    <option value="LI">Liechtenstein</option>
                                                    <option value="LT">Lithuania</option>
                                                    <option value="LU">Luxembourg</option>
                                                    <option value="MO">Macao</option>
                                                    <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                                    <option value="MG">Madagascar</option>
                                                    <option value="MW">Malawi</option>
                                                    <option value="MY">Malaysia</option>
                                                    <option value="MV">Maldives</option>
                                                    <option value="ML">Mali</option>
                                                    <option value="MT">Malta</option>
                                                    <option value="MH">Marshall Islands</option>
                                                    <option value="MQ">Martinique</option>
                                                    <option value="MR">Mauritania</option>
                                                    <option value="MU">Mauritius</option>
                                                    <option value="YT">Mayotte</option>
                                                    <option value="MX">Mexico</option>
                                                    <option value="FM">Micronesia, Federated States of</option>
                                                    <option value="MD">Moldova, Republic of</option>
                                                    <option value="MC">Monaco</option>
                                                    <option value="MN">Mongolia</option>
                                                    <option value="ME">Montenegro</option>
                                                    <option value="MS">Montserrat</option>
                                                    <option value="MA">Morocco</option>
                                                    <option value="MZ">Mozambique</option>
                                                    <option value="MM">Myanmar</option>
                                                    <option value="NA">Namibia</option>
                                                    <option value="NR">Nauru</option>
                                                    <option value="NP">Nepal</option>
                                                    <option value="NL">Netherlands</option>
                                                    <option value="NC">New Caledonia</option>
                                                    <option value="NZ">New Zealand</option>
                                                    <option value="NI">Nicaragua</option>
                                                    <option value="NE">Niger</option>
                                                    <option value="NG">Nigeria</option>
                                                    <option value="NU">Niue</option>
                                                    <option value="NF">Norfolk Island</option>
                                                    <option value="MP">Northern Mariana Islands</option>
                                                    <option value="NO">Norway</option>
                                                    <option value="OM">Oman</option>
                                                    <option value="PK">Pakistan</option>
                                                    <option value="PW">Palau</option>
                                                    <option value="PS">Palestinian Territory, Occupied</option>
                                                    <option value="PA">Panama</option>
                                                    <option value="PG">Papua New Guinea</option>
                                                    <option value="PY">Paraguay</option>
                                                    <option value="PE">Peru</option>
                                                    <option value="PH">Philippines</option>
                                                    <option value="PN">Pitcairn</option>
                                                    <option value="PL">Poland</option>
                                                    <option value="PT">Portugal</option>
                                                    <option value="PR">Puerto Rico</option>
                                                    <option value="QA">Qatar</option>
                                                    <option value="RE">Réunion</option>
                                                    <option value="RO">Romania</option>
                                                    <option value="RU">Russian Federation</option>
                                                    <option value="RW">Rwanda</option>
                                                    <option value="BL">Saint Barthélemy</option>
                                                    <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                                    <option value="KN">Saint Kitts and Nevis</option>
                                                    <option value="LC">Saint Lucia</option>
                                                    <option value="MF">Saint Martin (French part)</option>
                                                    <option value="PM">Saint Pierre and Miquelon</option>
                                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                                    <option value="WS">Samoa</option>
                                                    <option value="SM">San Marino</option>
                                                    <option value="ST">Sao Tome and Principe</option>
                                                    <option value="SA">Saudi Arabia</option>
                                                    <option value="SN">Senegal</option>
                                                    <option value="RS">Serbia</option>
                                                    <option value="SC">Seychelles</option>
                                                    <option value="SL">Sierra Leone</option>
                                                    <option value="SG">Singapore</option>
                                                    <option value="SX">Sint Maarten (Dutch part)</option>
                                                    <option value="SK">Slovakia</option>
                                                    <option value="SI">Slovenia</option>
                                                    <option value="SB">Solomon Islands</option>
                                                    <option value="SO">Somalia</option>
                                                    <option value="ZA">South Africa</option>
                                                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                    <option value="SS">South Sudan</option>
                                                    <option value="ES">Spain</option>
                                                    <option value="LK">Sri Lanka</option>
                                                    <option value="SD">Sudan</option>
                                                    <option value="SR">Suriname</option>
                                                    <option value="SJ">Svalbard and Jan Mayen</option>
                                                    <option value="SZ">Swaziland</option>
                                                    <option value="SE">Sweden</option>
                                                    <option value="CH">Switzerland</option>
                                                    <option value="SY">Syrian Arab Republic</option>
                                                    <option value="TW">Taiwan, Province of China</option>
                                                    <option value="TJ">Tajikistan</option>
                                                    <option value="TZ">Tanzania, United Republic of</option>
                                                    <option value="TH">Thailand</option>
                                                    <option value="TL">Timor-Leste</option>
                                                    <option value="TG">Togo</option>
                                                    <option value="TK">Tokelau</option>
                                                    <option value="TO">Tonga</option>
                                                    <option value="TT">Trinidad and Tobago</option>
                                                    <option value="TN">Tunisia</option>
                                                    <option value="TR">Turkey</option>
                                                    <option value="TM">Turkmenistan</option>
                                                    <option value="TC">Turks and Caicos Islands</option>
                                                    <option value="TV">Tuvalu</option>
                                                    <option value="UG">Uganda</option>
                                                    <option value="UA">Ukraine</option>
                                                    <option value="AE">United Arab Emirates</option>
                                                    <option value="GB">United Kingdom</option>
                                                    <option value="US">United States</option>
                                                    <option value="UM">United States Minor Outlying Islands</option>
                                                    <option value="UY">Uruguay</option>
                                                    <option value="UZ">Uzbekistan</option>
                                                    <option value="VU">Vanuatu</option>
                                                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                                                    <option value="VN">Viet Nam</option>
                                                    <option value="VG">Virgin Islands, British</option>
                                                    <option value="VI">Virgin Islands, U.S.</option>
                                                    <option value="WF">Wallis and Futuna</option>
                                                    <option value="EH">Western Sahara</option>
                                                    <option value="YE">Yemen</option>
                                                    <option value="ZM">Zambia</option>
                                                    <option value="ZW">Zimbabwe</option>
                                                </select>
                                            </div>
                                        </div>
										
                                        <div class="col-sm-4 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Passport Number
                                                </label>
                                                <input type="text" class="form-control datepickerfieldexpiry" name="passportNumberChd<?php echo $child; ?>" id="passportNumberChd<?php echo $child;?>" placeholder="" aria-label="" 
                                                data-msg="Please enter passport number"
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope" required>
                                            </div>
                                        </div>
                                        <!-- End Input -->
										<div class="col-sm-4 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Passport Expiry
                                                </label>
                                                <input type="text" class="form-control" name="passportExpiryChd<?php echo $child; ?>" id="passportExpiryChd<?php echo $child;?>" placeholder="" aria-label="" 
                                                data-msg="Please enter expiry Date"
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope" required>
                                            </div>
                                        </div>
										
										<?php } ?>
										
										
										</div>
										
										</div>
										
										
                                    <input name="totalchild" type="hidden" value="<?php echo $child; ?>">
										<?php }
										$totalchildcount=$child;
										 ?>
										
										
										
										<?php
										for($infant=1; $infant<=$_SESSION['INF']; $infant++){
										?>
									 				 <div class="card-header">Infant <?php echo $infant; ?> (0 - 2 yrs)</div>
							   			 
						 <div class="card-body">
										
										
   
										<div class="row">
										
										<div class="col-sm-2 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Title
                                                </label>
												<select class="form-control validate1" name="titleInf<?php echo $infant; ?>" id="titleInf<?php echo $infant; ?>">
											<option value="">Select</option> 
													<option value="Mr">Mr.</option> 
													<option value="Mrs">Mrs</option> 
													<option value="Ms">Ms.</option> 
													<option value="Miss">Miss.</option>  
												</select>
                                            </div>
                                        </div>
										
                                        <div class="col-sm-4 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    First Name
                                                </label>

                                                <input type="text" class="form-control" name="firstNameInf<?php echo $infant; ?>" id="firstNameInf<?php echo $infant; ?>" required
                                                data-msg="Please enter your first name."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <!-- Input -->
                                        <div class="col-sm-3 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Last name
                                                </label>

                                                <input type="text" class="form-control" name="lastNameInf<?php echo $infant; ?>" id="lastNameInf<?php echo $infant; ?>" required
                                                data-msg="Please enter your last name."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope">
                                            </div>
                                        </div>
										
										<div class="col-sm-3 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    DOB
                                                </label>
												<input class="form-control validate1 datepickerfieldinfant"  id="dobInf<?php echo $infant; ?>" name="dobInf<?php echo $infant; ?>" readonly="readonly">
											</div>
                                        </div>
                                        <!-- End Input -->
										<?php if($sector=='I'){ ?>
                                        <!-- Input -->
										<div class="col-sm-4 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Passwort Provided Country
                                                </label>
                                                <select class="form-control js-select selectpicker dropdown-select" id="passportNumberInf<?php echo $infant; ?>" name="passportNumberInf<?php echo $infant; ?>"  data-msg="Please select country." data-error-class="u-has-error" data-success-class="u-has-success"
                                                    data-live-search="true"
                                                    data-style="form-control font-size-16 border-width-2 border-gray font-weight-normal">
                                                    <option value="">Select country</option>
                                                    <option value="AF">Afghanistan</option>
                                                    <option value="AX">Åland Islands</option>
                                                    <option value="AL">Albania</option>
                                                    <option value="DZ">Algeria</option>
                                                    <option value="AS">American Samoa</option>
                                                    <option value="AD">Andorra</option>
                                                    <option value="AO">Angola</option>
                                                    <option value="AI">Anguilla</option>
                                                    <option value="AQ">Antarctica</option>
                                                    <option value="AG">Antigua and Barbuda</option>
                                                    <option value="AR">Argentina</option>
                                                    <option value="AM">Armenia</option>
                                                    <option value="AW">Aruba</option>
                                                    <option value="AU">Australia</option>
                                                    <option value="AT">Austria</option>
                                                    <option value="AZ">Azerbaijan</option>
                                                    <option value="BS">Bahamas</option>
                                                    <option value="BH">Bahrain</option>
                                                    <option value="BD">Bangladesh</option>
                                                    <option value="BB">Barbados</option>
                                                    <option value="BY">Belarus</option>
                                                    <option value="BE">Belgium</option>
                                                    <option value="BZ">Belize</option>
                                                    <option value="BJ">Benin</option>
                                                    <option value="BM">Bermuda</option>
                                                    <option value="BT">Bhutan</option>
                                                    <option value="BO">Bolivia, Plurinational State of</option>
                                                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                                    <option value="BA">Bosnia and Herzegovina</option>
                                                    <option value="BW">Botswana</option>
                                                    <option value="BV">Bouvet Island</option>
                                                    <option value="BR">Brazil</option>
                                                    <option value="IO">British Indian Ocean Territory</option>
                                                    <option value="BN">Brunei Darussalam</option>
                                                    <option value="BG">Bulgaria</option>
                                                    <option value="BF">Burkina Faso</option>
                                                    <option value="BI">Burundi</option>
                                                    <option value="KH">Cambodia</option>
                                                    <option value="CM">Cameroon</option>
                                                    <option value="CA">Canada</option>
                                                    <option value="CV">Cape Verde</option>
                                                    <option value="KY">Cayman Islands</option>
                                                    <option value="CF">Central African Republic</option>
                                                    <option value="TD">Chad</option>
                                                    <option value="CL">Chile</option>
                                                    <option value="CN">China</option>
                                                    <option value="CX">Christmas Island</option>
                                                    <option value="CC">Cocos (Keeling) Islands</option>
                                                    <option value="CO">Colombia</option>
                                                    <option value="KM">Comoros</option>
                                                    <option value="CG">Congo</option>
                                                    <option value="CD">Congo, the Democratic Republic of the</option>
                                                    <option value="CK">Cook Islands</option>
                                                    <option value="CR">Costa Rica</option>
                                                    <option value="CI">Côte d'Ivoire</option>
                                                    <option value="HR">Croatia</option>
                                                    <option value="CU">Cuba</option>
                                                    <option value="CW">Curaçao</option>
                                                    <option value="CY">Cyprus</option>
                                                    <option value="CZ">Czech Republic</option>
                                                    <option value="DK">Denmark</option>
                                                    <option value="DJ">Djibouti</option>
                                                    <option value="DM">Dominica</option>
                                                    <option value="DO">Dominican Republic</option>
                                                    <option value="EC">Ecuador</option>
                                                    <option value="EG">Egypt</option>
                                                    <option value="SV">El Salvador</option>
                                                    <option value="GQ">Equatorial Guinea</option>
                                                    <option value="ER">Eritrea</option>
                                                    <option value="EE">Estonia</option>
                                                    <option value="ET">Ethiopia</option>
                                                    <option value="FK">Falkland Islands (Malvinas)</option>
                                                    <option value="FO">Faroe Islands</option>
                                                    <option value="FJ">Fiji</option>
                                                    <option value="FI">Finland</option>
                                                    <option value="FR">France</option>
                                                    <option value="GF">French Guiana</option>

                                                    <option value="PF">French Polynesia</option>
                                                    <option value="TF">French Southern Territories</option>
                                                    <option value="GA">Gabon</option>
                                                    <option value="GM">Gambia</option>
                                                    <option value="GE">Georgia</option>
                                                    <option value="DE">Germany</option>
                                                    <option value="GH">Ghana</option>
                                                    <option value="GI">Gibraltar</option>
                                                    <option value="GR">Greece</option>
                                                    <option value="GL">Greenland</option>
                                                    <option value="GD">Grenada</option>
                                                    <option value="GP">Guadeloupe</option>
                                                    <option value="GU">Guam</option>
                                                    <option value="GT">Guatemala</option>
                                                    <option value="GG">Guernsey</option>
                                                    <option value="GN">Guinea</option>
                                                    <option value="GW">Guinea-Bissau</option>
                                                    <option value="GY">Guyana</option>
                                                    <option value="HT">Haiti</option>
                                                    <option value="HM">Heard Island and McDonald Islands</option>
                                                    <option value="VA">Holy See (Vatican City State)</option>
                                                    <option value="HN">Honduras</option>
                                                    <option value="HK">Hong Kong</option>
                                                    <option value="HU">Hungary</option>
                                                    <option value="IS">Iceland</option>
                                                    <option value="IN">India</option>
                                                    <option value="ID">Indonesia</option>
                                                    <option value="IR">Iran, Islamic Republic of</option>
                                                    <option value="IQ">Iraq</option>
                                                    <option value="IE">Ireland</option>
                                                    <option value="IM">Isle of Man</option>
                                                    <option value="IL">Israel</option>
                                                    <option value="IT">Italy</option>
                                                    <option value="JM">Jamaica</option>
                                                    <option value="JP">Japan</option>
                                                    <option value="JE">Jersey</option>
                                                    <option value="JO">Jordan</option>
                                                    <option value="KZ">Kazakhstan</option>
                                                    <option value="KE">Kenya</option>
                                                    <option value="KI">Kiribati</option>
                                                    <option value="KP">Korea, Democratic People's Republic of</option>
                                                    <option value="KR">Korea, Republic of</option>
                                                    <option value="KW">Kuwait</option>
                                                    <option value="KG">Kyrgyzstan</option>
                                                    <option value="LA">Lao People's Democratic Republic</option>
                                                    <option value="LV">Latvia</option>
                                                    <option value="LB">Lebanon</option>
                                                    <option value="LS">Lesotho</option>
                                                    <option value="LR">Liberia</option>
                                                    <option value="LY">Libya</option>
                                                    <option value="LI">Liechtenstein</option>
                                                    <option value="LT">Lithuania</option>
                                                    <option value="LU">Luxembourg</option>
                                                    <option value="MO">Macao</option>
                                                    <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                                    <option value="MG">Madagascar</option>
                                                    <option value="MW">Malawi</option>
                                                    <option value="MY">Malaysia</option>
                                                    <option value="MV">Maldives</option>
                                                    <option value="ML">Mali</option>
                                                    <option value="MT">Malta</option>
                                                    <option value="MH">Marshall Islands</option>
                                                    <option value="MQ">Martinique</option>
                                                    <option value="MR">Mauritania</option>
                                                    <option value="MU">Mauritius</option>
                                                    <option value="YT">Mayotte</option>
                                                    <option value="MX">Mexico</option>
                                                    <option value="FM">Micronesia, Federated States of</option>
                                                    <option value="MD">Moldova, Republic of</option>
                                                    <option value="MC">Monaco</option>
                                                    <option value="MN">Mongolia</option>
                                                    <option value="ME">Montenegro</option>
                                                    <option value="MS">Montserrat</option>
                                                    <option value="MA">Morocco</option>
                                                    <option value="MZ">Mozambique</option>
                                                    <option value="MM">Myanmar</option>
                                                    <option value="NA">Namibia</option>
                                                    <option value="NR">Nauru</option>
                                                    <option value="NP">Nepal</option>
                                                    <option value="NL">Netherlands</option>
                                                    <option value="NC">New Caledonia</option>
                                                    <option value="NZ">New Zealand</option>
                                                    <option value="NI">Nicaragua</option>
                                                    <option value="NE">Niger</option>
                                                    <option value="NG">Nigeria</option>
                                                    <option value="NU">Niue</option>
                                                    <option value="NF">Norfolk Island</option>
                                                    <option value="MP">Northern Mariana Islands</option>
                                                    <option value="NO">Norway</option>
                                                    <option value="OM">Oman</option>
                                                    <option value="PK">Pakistan</option>
                                                    <option value="PW">Palau</option>
                                                    <option value="PS">Palestinian Territory, Occupied</option>
                                                    <option value="PA">Panama</option>
                                                    <option value="PG">Papua New Guinea</option>
                                                    <option value="PY">Paraguay</option>
                                                    <option value="PE">Peru</option>
                                                    <option value="PH">Philippines</option>
                                                    <option value="PN">Pitcairn</option>
                                                    <option value="PL">Poland</option>
                                                    <option value="PT">Portugal</option>
                                                    <option value="PR">Puerto Rico</option>
                                                    <option value="QA">Qatar</option>
                                                    <option value="RE">Réunion</option>
                                                    <option value="RO">Romania</option>
                                                    <option value="RU">Russian Federation</option>
                                                    <option value="RW">Rwanda</option>
                                                    <option value="BL">Saint Barthélemy</option>
                                                    <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                                    <option value="KN">Saint Kitts and Nevis</option>
                                                    <option value="LC">Saint Lucia</option>
                                                    <option value="MF">Saint Martin (French part)</option>
                                                    <option value="PM">Saint Pierre and Miquelon</option>
                                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                                    <option value="WS">Samoa</option>
                                                    <option value="SM">San Marino</option>
                                                    <option value="ST">Sao Tome and Principe</option>
                                                    <option value="SA">Saudi Arabia</option>
                                                    <option value="SN">Senegal</option>
                                                    <option value="RS">Serbia</option>
                                                    <option value="SC">Seychelles</option>
                                                    <option value="SL">Sierra Leone</option>
                                                    <option value="SG">Singapore</option>
                                                    <option value="SX">Sint Maarten (Dutch part)</option>
                                                    <option value="SK">Slovakia</option>
                                                    <option value="SI">Slovenia</option>
                                                    <option value="SB">Solomon Islands</option>
                                                    <option value="SO">Somalia</option>
                                                    <option value="ZA">South Africa</option>
                                                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                                                    <option value="SS">South Sudan</option>
                                                    <option value="ES">Spain</option>
                                                    <option value="LK">Sri Lanka</option>
                                                    <option value="SD">Sudan</option>
                                                    <option value="SR">Suriname</option>
                                                    <option value="SJ">Svalbard and Jan Mayen</option>
                                                    <option value="SZ">Swaziland</option>
                                                    <option value="SE">Sweden</option>
                                                    <option value="CH">Switzerland</option>
                                                    <option value="SY">Syrian Arab Republic</option>
                                                    <option value="TW">Taiwan, Province of China</option>
                                                    <option value="TJ">Tajikistan</option>
                                                    <option value="TZ">Tanzania, United Republic of</option>
                                                    <option value="TH">Thailand</option>
                                                    <option value="TL">Timor-Leste</option>
                                                    <option value="TG">Togo</option>
                                                    <option value="TK">Tokelau</option>
                                                    <option value="TO">Tonga</option>
                                                    <option value="TT">Trinidad and Tobago</option>
                                                    <option value="TN">Tunisia</option>
                                                    <option value="TR">Turkey</option>
                                                    <option value="TM">Turkmenistan</option>
                                                    <option value="TC">Turks and Caicos Islands</option>
                                                    <option value="TV">Tuvalu</option>
                                                    <option value="UG">Uganda</option>
                                                    <option value="UA">Ukraine</option>
                                                    <option value="AE">United Arab Emirates</option>


                                                    <option value="GB">United Kingdom</option>
                                                    <option value="US">United States</option>
                                                    <option value="UM">United States Minor Outlying Islands</option>
                                                    <option value="UY">Uruguay</option>
                                                    <option value="UZ">Uzbekistan</option>
                                                    <option value="VU">Vanuatu</option>
                                                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                                                    <option value="VN">Viet Nam</option>
                                                    <option value="VG">Virgin Islands, British</option>
                                                    <option value="VI">Virgin Islands, U.S.</option>
                                                    <option value="WF">Wallis and Futuna</option>
                                                    <option value="EH">Western Sahara</option>
                                                    <option value="YE">Yemen</option>
                                                    <option value="ZM">Zambia</option>
                                                    <option value="ZW">Zimbabwe</option>
                                                </select>
                                            </div>
                                        </div>
										
                                        <div class="col-sm-4 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Passport Number
                                                </label>
                                                <input type="text" class="form-control" name="passportNumberInf<?php echo $infant; ?>" id="passportNumberInf<?php echo $infant;?>" placeholder="" aria-label="" 
                                                data-msg="Please enter passport number"
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope" required>
                                            </div>
                                        </div>
                                        <!-- End Input -->
										<div class="col-sm-4 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Passport Expiry
                                                </label>
                                                <input type="text" class="form-control datepickerfieldexpiry" name="passportExpiryInf<?php echo $infant; ?>" id="passportExpiryInf<?php echo $infant;?>" placeholder="" aria-label="" 
                                                data-msg="Please enter expiry Date"
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope" required>
                                            </div>
                                        </div>
										
										<?php } ?>
										
										</div>
										
										</div>
										    <input name="totalinfant" type="hidden" value="<?php echo $infant; ?>">
										<?php }  
										$totalinfantcount=$infant;
										 ?>

 


</div>

<div class="card cardresult" style="width:100%; margin-top:20px;" id="contactdetailid">
 <div class="card-header">Contact Details</div>
										 
						 <div class="card-body">
						 
						 	 <div class="row"> <!-- Input -->
                                         
										
										<div class="col-sm-6 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Email
                                                </label>

                                                <input type="email" class="form-control validate1" name="email" placeholder="" aria-label="" required
                                                data-msg="Please enter a valid email address."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope" value="<?php echo $LoginUserDetails['email']; ?>">
                                            </div>
                                        </div>
                                        <!-- End Input -->

                                        <!-- Input -->
                                        <div class="col-sm-6 mb-4">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Phone
                                                </label>

                                                <input type="number" class="form-control validate1" name="phone" placeholder="" aria-label="" required
                                                data-msg="Please enter a valid phone number."
                                                data-error-class="u-has-error"
                                                data-success-class="u-has-success" autocomplete="nope"  value="<?php echo $LoginUserDetails['phone']; ?>">
                                            </div>
                                        </div>
                                        <!-- End Input -->
										
										<!-- Input -->
                                         
                                        <!-- End Input -->
										</div>
                                        
										<div class="row" style="position:relative;"> 
								<label style="padding-left: 37px; width: 100%; margin-bottom: 30px;"><input name="gst" type="checkbox" value="1" onClick="ifgst();" class="checkbox_check" style="width: 16px; height: 16px; position: absolute; left: 14px; top: 3px;"> I have a GST number (Optional)</label>
								  <div class="col-sm-4 mb-4 showgst">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Company Name
                                                </label>

                                                <input type="text" class="form-control" name="companyName" placeholder=""  autocomplete="nope">
                                            </div>
                                        </div>
										
										<div class="col-sm-4 mb-4 showgst">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    GST No
                                                </label>

                                                <input type="test" class="form-control" name="gstNo" placeholder=""  autocomplete="nope">
                                            </div>
                                        </div>
										
										<div class="col-sm-4 mb-4 showgst">
                                            <div class="js-form-message">
                                                <label class="form-label">
                                                    Email
                                                </label>

                                                <input type="test" class="form-control" name="gstEmail" placeholder=""  autocomplete="nope">
                                            </div>
                                        </div>
										
										
										
										</div>
						 
						 
						 </div>
				<div class="card-footer text-muted hidefooter">
   
    
   <button type="button" class="btn btn-danger btn-sm" style="float:right;"  onClick="checkInputs();">Proceed To Pay</button>
   
   
  </div>		
  
  
  
  <div class="card-footer text-muted" id="showfooterpay" style="display:none;">
   
   <button type="button" class="btn btn-danger btn-sm float-left" onClick="$('#steponeflightdetails').hide();$('#steptwopassengerdetails').show();$('.flightreviewbox').removeClass('active');$('#strp2').addClass('active');$('.hidefooter').show();$('#showfooterpay').hide();"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Back</button>
   <button type="button" class="btn btn-danger btn-sm" style="float:right;" onClick="$('#steponeflightdetails').hide();$('#steptwopassengerdetails').hide();$('#stepfourpayments').show();$('.flightreviewbox').removeClass('active');$('#strp4').addClass('active');$('.hidefooter').show();$('#showfooterpay').hide();">Proceed To Pay</button>
   
   
  </div> 
</div>

</div>



<?php $str_arr = explode (",", $res['agfare']);   
	$basefare = explode ("=", $str_arr[2]); 
	  ?>
<div class="col-12" style="position:relative; margin-top:20px; display:none;"  id="stepfourpayments">
<h2>Payments</h2>

<div class="card cardresult" style="width:100%;">
<div class="card-header">
Pay By Wallet
</div>

<div class="row">

<div class="col-4"> 

<div style="padding: 40px 0px; text-align: center;  font-size: 30px; border-bottom-left-radius: 5px; <?php if($totalwalletBalance>=$basefare[1]){?>border-right: 2px solid #41e0d2; background-color: #e4f8ff; color:#02C4B0;<?php } else { ?>border-right: 2px solid #e04159; background-color: #ffe4e4;color:#c4021e;<?php } ?>">
<div style="font-weight:600; ">₹<?php echo round($totalwalletBalance); ?></div>
<div style="font-size:14px; color:#000000; "><strong>Your Wallet Balance</strong></div>
</div> 

</div>


<div class="col-8" style="margin-top:0px;">
<div class="card-body">

<?php 
$ifoffile=offlineflight($_SESSION['agentUserid'],$res['FLIGHT_NAME'],$res['PCC']);

 

if($totalwalletBalanceParent>($basefare[1]+$totalfareret)){

if($ifoffile==0){ 

 $totalwalletBalanceParent;

} ?>

<div style="padding-top:10px; padding-bottom:10px; font-size:14px;"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; By placing this order, you agree to our Terms Of Use and Privacy Policy</div>

<input name="termsofuse" type="checkbox" value="1" checked disabled="disabled"> I accept <a href="<?php echo $fullurl; ?>terms-conditions" target="_blank" style="text-decoration:underline;">terms & conditions</a>

<div style=" font-size:14px; margin-bottom:10px; margin-top:15px;">
<?php if($totalwalletBalance>=($basefare[1]+$totalfareret)){ ?>
<button type="button" class="btn btn-danger" onClick="payandbooknow();" >Pay Now ₹<?php  echo ($basefare[1]+$totalfareret); ?></button>
<?php } ?>

<a id="payonlinelink" ><button type="button" class="btn btn-danger payonlinebtnmain" id="payonlinebtn">Pay Online ₹<?php  echo ($finaltotalpay); ?></button></a>

</div>
<input name="flightbooking" id="flightbooking" type="hidden" value="1"> 
<input name="bookingMethod" id="bookingMethod" type="hidden" value="0">
<input name="totalAmountToPay" id="totalAmountToPay" type="hidden" value="<?php echo ($finaltotalpay); ?>">
<?php  /* } else { ?>
<div style="padding-top:10px; padding-bottom:10px; font-size:14px; color:#CC0000;"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; You don't have sufficient balance.</div>
<?php } */  ?>


<?php }  else { ?>
<div style="padding-top:10px; padding-bottom:10px; font-size:14px; background-color:#FF0000; color:#FFFFFF; font-weight:600; padding:20px; text-align:center;">We have found some technical issue. Please contact administrator!</div>
<?php } ?> 



</div>


</div>


</div>



</div>

</div>

 </div>
 
  </div>

<div class="col-4 faresummrybox">
<div class="card">
<div class="card-header">
Fare Summary
</div>
<div class="card-body">

 <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:14px; color:#000000;">
  <tr>
    <td colspan="2" align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Base fare</td>
    <td width="50%" align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php
	$str_arr = explode (",", $res['agfare']);  
	$basefare = explode ("=", $str_arr[0]);
	echo ($basefare[1]+$basefareret); 
	  ?></td>
  </tr>
  <tr>
    <td colspan="2" align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Taxes and fees</td>
    <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<?php 
	$basefare = explode ("=", $str_arr[1]);
	echo $res['totalTax'];
	  ?></td>
  </tr>
<tr style="display:none;" id="discountAmtDiv">
	<td colspan="2" align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Discount Amount</td>
    <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">- ₹<span id="discountAmt"></span></td>
</tr>
  <tr>
    <td colspan="2" align="left" style="padding:10px 0px; border-bottom:1px solid #ddd;">Amount to Pay</td>
    <td align="right" style="padding:10px 0px; border-bottom:1px solid #ddd; font-size:14px;">₹<span id="totalpayAmt"><?php 
	$basefare = explode ("=", $str_arr[2]);
	echo ($basefare[1]+$totalfareret);
	  ?></span></td>
  </tr>
</table>
<?php if($totalwalletBalance>=($basefare[1]+$totalfareret)){} else {?>
<div style="padding-top:10px; padding-bottom:10px; font-size:14px; color:#CC0000;"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; You don't have sufficient balance.</div>
<?php } ?>
</div>

</div>


<?php
$totalFare=round($basefare[1]+$totalfareret);
?>


 
						</div>

<?php
$arq=($totalFare-$wallet30PercBalance);
$arq=$arq+202565517+202565517;
?>

 <input name="flightone" type="hidden" value="<?php echo encode($_REQUEST['i']); ?>">
 <input name="flighttwo" type="hidden" value="<?php echo encode($_REQUEST['r']); ?>">
 <input type="hidden" name="arq" id="arq" value="<?php echo $arq; ?>">
 </form>
</div>




<div class="row" id="bookingloading" style="display:none;">
<div class="col-12" style=" text-align:center;">

<div class="card">
<div class="card-body">

<div style="text-align:center; font-size:30px; padding:80px 0px;">
<div style="text-align:center; "><img src="images/loadinggif.gif" width="40"></div>
Wait Please Processing...</div>

</div>
</div>
</div>
 </div> 
 
 
 </div>
 
 
<script>
 
  function checkInputs(){
  var e='';
  var flag = 0;
  $('.validate1').each(function() {
       if($(this).val() == ''){
	    $('.form-control').removeClass('redborderfiled');
	   $(this).addClass('redborderfiled');
	   $(this).focus();
       e=1;
	   return false;
       }
   });
    
   if(e==1){
   alert('Please fill mandatory fields');
   }
   
   if(e!=1){
   $('#reviewloadbox').addClass('makeReview');
   $('.form-control').removeClass('redborderfiled');
  $('#steponeflightdetails').show();$('#steptwopassengerdetails').show();$('.flightreviewbox').removeClass('active');$('#strp3').addClass('active');$(window).scrollTop(0);$('.hidefooter').hide();$('#showfooterpay').show();$('#stepfourpayments').hide();
  
  $('#steponeflightdetails').hide();$('#steptwopassengerdetails').show();$('#stepfourpayments').show();$('#contactdetailid').hide();$('.flightreviewbox').removeClass('active');$('#strp4').addClass('active');$('.hidefooter').show();$('#showfooterpay').hide();
  }
  
  }
 
 
 function showfarerule(id){
 var farerulebtn = $('.farerulebtn').text();
 if(farerulebtn=='Show Fare Rules'){
 $('.farerulebtn').html('Hide Fare Rules');
 $('#showfarerule').slideDown();
 } else {
 $('.farerulebtn').html('Show Fare Rules');
 $('#showfarerule').slideUp();
 }
 
  if(farerulebtn=='Show Fare Rules'){
 $('#showfarerule').html('Loading...');
 $('#showfarerule').load('showflightfarerule.php?id='+id);
 }
 }
 
 
  function showfarerule2(id){
 var farerulebtn = $('.farerulebtn2').text();
 if(farerulebtn=='Show Fare Rules'){
 $('.farerulebtn2').html('Hide Fare Rules');
 $('#showfarerule2').slideDown();
 } else {
 $('.farerulebtn2').html('Show Fare Rules');
 $('#showfarerule2').slideUp();
 }
 
  if(farerulebtn=='Show Fare Rules'){
 $('#showfarerule2').html('Loading...');
 $('#showfarerule2').load('showflightfarerule.php?id='+id);
 }
 }
 
 
   $( function() {
    $( ".datepickerfield" ).datepicker(
	{
changeMonth: true,
            changeYear: true,
            yearRange: '-100:+0',
			dateFormat: 'dd-mm-yy',
			maxDate: new Date()
	
	}
	
	);
  } );
  
  $( function() {
 
 
    $( ".datepickerfieldinfant" ).datepicker(
	{
			changeMonth: true,
            changeYear: true,
            yearRange: '-100:+0',
			dateFormat: 'dd-mm-yy',
			maxDate:new Date('<?php echo $journeyDate1; ?>'),
			minDate: new Date('<?php echo $infantDateValidate; ?>')
				
	
	}
	
	);
  } );
  
  
  $( function() {
 
 
    $( ".datepickerfieldchild" ).datepicker(
	{
			changeMonth: true,
            changeYear: true,
            yearRange: '-100:+0',
			dateFormat: 'dd-mm-yy',
			maxDate:new Date('<?php echo $journeyDate1; ?>'),
			minDate: new Date('<?php echo $childDateValidate; ?>')
				
	
	}
	
	);
  } );    
  
  $( function() {
    $( ".datepickerfieldexpiry" ).datepicker(
	{
			changeMonth: true,
            changeYear: true,
            yearRange: '-100:+50',
			dateFormat: 'dd-mm-yy',
			minDate: 0
	
	}
	
	);
  } );
 </script> 
 
 <script>
 $('#showfarerule').load('showflightfarerule.php?id=<?php echo encode($res['id']); ?>&checkingflightfare=1');
 <?php if($resret['id']!=''){ ?>
 $('#showfarerule2').load('showflightfarerule.php?id=<?php echo encode($resret['id']); ?>&checkingflightfare=1');
 <?php } ?>
 
 function payandbooknow(){
 $('#flightbooking').val('1');
 $('#bookingMethod').val('0');
 $('#flightbookingsubmit').submit();
 $('#bookingloading').show();
 $('#bookingdatainfo').hide();
 $('.flightreview').hide();
 }

 function payonline(){
 $('#flightbooking').val('1');
 $('#bookingMethod').val('1');
 $('#flightbookingsubmit').submit();
 $('#bookingloading').show();
 $('#bookingdatainfo').hide();
 $('.flightreview').hide();
 }
 
  
 function fillbtnpay(){
 var totalAmountToPay = $('#totalAmountToPay').val();
 $('#paywalletbtn').text('Pay Now ₹'+totalAmountToPay+'');
 $('#payonlinebtn').text('Pay Online ₹'+totalAmountToPay+'');
 $('#payonlinelink').attr('onClick',"window.open('onlinerecharge?b=1&bamount="+totalAmountToPay+"&z=<?php echo encode($_SESSION['agentUserid']); ?>&type=<?php echo $bookingServiceType; ?>&bType=<?php echo $_SESSION['serviceId']; ?>', '_blank', 'location=yes,height=600,width=1000,scrollbars=yes,status=yes')");
 }
 
 fillbtnpay();
 
 
 function allBookingSubmit(){
	 $('#bookingMethod').val('0');
	 $("#flightbookingsubmit").submit();
 }
 
  
 $('#steponeflightdetails').hide();
 $('#steptwopassengerdetails').show();
 $('.flightreviewbox').removeClass('active');
 $('#strp2').addClass('active');
 $('.hidefooter').show();
 $('#showfooterpay').hide();
 $('#stepfourpayments').hide();
 
 
 function bookingFormSubmit(){
	 $("#bookingForm").submit();
 }
 
 $('.showonlyaftercheck').show();
</script>

<iframe id="bookingframe" name="bookingframe" style="display:none;"></iframe>


<style>
.makeReview .flightreview{display:none;}
.makeReview .faresummrybox{display:none;}
.makeReview .col-8{ margin: auto; margin-top: 40px;}
.makeReview .col-8 .col-8{ margin: auto; margin-top: 0px;}
.makeReview .tpbtn{ display:none;}
.makeReview .form-control{ pointer-events:none !important; padding: 0px !important; border: 0px !important;}
</style>
 
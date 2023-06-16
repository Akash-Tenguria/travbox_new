<?php 
include "inc.php"; 
include "config/logincheck.php"; 

if($_SESSION['uniqueSessionId']==''){ 
$_SESSION['uniqueSessionId']=str_pad(mt_rand(1,99999999),8,'0',STR_PAD_LEFT); 
}  
 
$page='flights';
$selectedpage='flights';
$_SESSION['tktone']=0;
$_SESSION['tkttwo']=0;
 

$_SESSION['pgc']='2';
$tripType=1;
if($_REQUEST['tripType']!=''){
$tripType=$_REQUEST['tripType'];
}
$fixedDeparture=0;
if($_REQUEST['fixedDeparture']!=''){
$fixedDeparture=$_REQUEST['fixedDeparture'];
}
$PC='EC';
if($_REQUEST['PC']!=''){
$PC=$_REQUEST['PC'];
}

$travellers='1 Pax, Economy';
if($_REQUEST['travellers']!=''){
$travellers=$_REQUEST['travellers'];
}

$psting='psting';
if($_REQUEST['psting']!=''){
$psting=$_REQUEST['psting'];
}

$fromcitydesti='DEL - NEW DELHI';
if($_REQUEST['fromcitydesti']!=''){
$fromcitydesti=$_REQUEST['fromcitydesti'];
}


$fromDestinationFlight='DEL-India';
if($_REQUEST['fromDestinationFlight']!=''){
$fromDestinationFlight=$_REQUEST['fromDestinationFlight'];
}

$tocitydesti='BOM - MUMBAI';
if($_REQUEST['tocitydesti']!=''){
$tocitydesti=$_REQUEST['tocitydesti'];
}

$toDestinationFlight='BOM-India';
if($_REQUEST['toDestinationFlight']!=''){
$toDestinationFlight=$_REQUEST['toDestinationFlight'];
}


$journeyDateOne=date('d-m-Y');;
if($_REQUEST['journeyDateOne']!=''){
$journeyDateOne=$_REQUEST['journeyDateOne'];
}
  
$journeyDateRound=date('d-m-Y', strtotime('+1 days'));
if($_REQUEST['journeyDateRound']!=''){
$journeyDateRound=$_REQUEST['journeyDateRound'];
}
 
 
 $fromdestexp = explode('-',$_REQUEST['fromcitydesti']);
$todestexp = explode('-',$_REQUEST['tocitydesti']);

 
if($_REQUEST['toDestinationFlight']!=''){

$namevalue ='userFrom="'.$_REQUEST['fromcitydesti'].'",userTo="'.$_REQUEST['tocitydesti'].'",userDeparture="'.date('Y-m-d',strtotime($_REQUEST['journeyDateOne'])).'",userArrival="'.date('Y-m-d',strtotime($_REQUEST['journeyDateRound'])).'",userTraveler="'.$_REQUEST['travellersshow'].'",fromDestinationFlight="'.$_REQUEST['fromDestinationFlight'].'",toDestinationFlight="'.$_REQUEST['toDestinationFlight'].'",tripType="'.$_REQUEST['tripType'].'",userIP="'.$_SERVER['REMOTE_ADDR'].'",agentId="'.$_SESSION['agentUserid'].'",addDate="'.date('Y-m-d H:i:s').'"';  
addlistinggetlastid('flightSearchLog',$namevalue);   

}

$ADT = trim($_REQUEST['ADT']);
$CHD = trim($_REQUEST['CHD']);
$INF = trim($_REQUEST['INF']);
$PC = trim($_REQUEST['PC']);

$_SESSION['PC']=$_REQUEST['PC'];

$_SESSION['ADT']=$ADT;
$_SESSION['CHD']=$CHD;
$_SESSION['INF']=$INF;
$_SESSION['PC']=$PC;






$_SESSION['fromDestinationFlight']=$_REQUEST['fromDestinationFlight'];
$_SESSION['toDestinationFlight']=$_REQUEST['toDestinationFlight'];
$_SESSION['tripType']=$_REQUEST['tripType'];




if ( (strpos(strtolower($_REQUEST['fromDestinationFlight']), 'india') !== false)  &&  (strpos(strtolower($_REQUEST['toDestinationFlight']), 'india') !== false) )
{
  
 
   $_SESSION['isdomestic']='Yes';
   $_SESSION['domesticorinter']='D';
  
}
else
{
	 	 
	 $_SESSION['isdomestic']='No';
	  $_SESSION['domesticorinter']='I';	 
	
}

$isRoundTripInt=0;
if($_REQUEST['tripType']==2)
{
	 if( (strpos(strtolower($_REQUEST['fromDestinationFlight']), 'india')== false)  ||  (strpos(strtolower($_REQUEST['toDestinationFlight']), 'india')== false) )
	 {
		$isRoundTripInt=1;
	 }
 }

$_SESSION['isRoundTripInt']=$isRoundTripInt;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Flight Search - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
<?php include "headerinc.php"; ?>
<style>
.flightfooter{display:none;}
</style>


 

</head>

<body class="greybluebg" >
<div class="mobilefilterbtn">
<i class="fa fa-filter" aria-hidden="true"></i>
</div>

<?php include "header.php"; ?>

<div style="width:100%; position:fixed; left:0px; top:0px; height:100%; z-index:999; background-color:#fff; display:none !Important;" id="flightloadingbox">
<div style="text-align:center; margin-top:20%;"><img src="images/ezgif.com-crop.gif" style="width:220px; margin:auto;"></div>
</div>

 
 <div class="top_bg_ofr_sb top_bg_ofr_sb2other homeflightsearchouterbox searchflightbg bannerbgwhite closesearchbanner" style="height:0px;">
    <div class="flighttopmenuwithback">
    <table border="0" cellpadding="2" cellspacing="0">
      <tbody><tr>
        <td><i class="fa fa-arrow-left" aria-hidden="true" onClick="$('.homeflightsearchouterbox').hide();$('body').css('overflow','auto');"></i></td>
        <td><i class="fa fa-plane" aria-hidden="true"></i></td>
        <td style="padding-left:10px;">Flights</td>
      </tr>
    </tbody></table>
    
    </div>
    
    <div class="container" style="padding:0px 20px;">
    <!-- <h1 style="text-align:center;">Book flights and explore the world with us.</h1> -->
    
    <div class="flightsearchwihite searchflightmainbg flightsearchtab">
    <div class="searchtabs searchflighttab">
 

<a <?php if($_REQUEST['tripType']==1){ ?>class="active"<?php } ?>  id="tb1" onClick="selecttb(1);">One-Way</a>
<a <?php if($_REQUEST['tripType']==2){ ?>class="active"<?php } ?> id="tb2" onClick="selecttb(2);">Round-Trip</a> 
	
	
	</div>
    <script>
    $(document).mouseup(function(e) 
    {
        var container = $("#fromflightdestination"); 
        if (!container.is(e.target) && container.has(e.target).length === 0) 
        {
            $('#searchcitylistsfromCity').hide();
        } else { 
        
        $('#searchcitylistsfromCity2').hide();
        }
        
         var container = $("#toflightdestination"); 
        if (!container.is(e.target) && container.has(e.target).length === 0) 
        {
            $('#searchcitylistsfromCity2').hide();
        } else { 
        
        $('#searchcitylistsfromCity').hide();
        }
    });
    
    
     
    </script>
    <div class="searchboxouter flightsearchhomebox searchflightouter">
    <form  method="GET" id="formids" action="<?php echo $fullurl; ?>flight-search" >
                    <input type="hidden" name="tripType" id="tripType" value="1">
    <div class="tableborder searchflighttableborder">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="flightsearchtable">
      <tbody><tr>
        <td width="20%" align="left" valign="top" id="fromflightdestination"> 
         <label class="greyouter">
        <div class="lable" id="fromlabel">From</div>
        <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity"></div>
          <input type="text" onClick="$('#pickupCitySearchfromCity').select();" class="textfield" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity','fromDestinationFlight','searchcitylistsfromCity');" id="pickupCitySearchfromCity" name="fromcitydesti" value="<?php echo $fromcitydesti; ?>" autocomplete="off">
          <input name="fromDestinationFlight" id="fromDestinationFlight" type="hidden" value="<?php echo $fromDestinationFlight; ?>" autocomplete="nope"></label>
          <div class="swapbtn flightswapbtn" onClick="swapdata();"><i class="fa fa-exchange" aria-hidden="true"></i></div>
         </td> 
        <td width="20%" align="left" valign="top" id="toflightdestination">
         <label class="greyouter" style="padding-left: 20px;"> <div class="lable tolabel" id="twolabel">To</div>
        
        <div class="errorSection" style="display:none;" id="flightdublicate"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> From &amp; To airports cannot be the same</div>
        <div style="height: 0px; font-size: 0px; position: relative; width: 100%; text-align: left; display: none;" id="searchcitylistsfromCity2"></div>
        <input type="text" onClick="$('#pickupCitySearchfromCity2').select();" class="textfield" required="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2','fromDestinationFlight2','searchcitylistsfromCity2');" id="pickupCitySearchfromCity2" name="tocitydesti" value="<?php echo $tocitydesti; ?>" autocomplete="off" >
        <input name="toDestinationFlight" id="fromDestinationFlight2" type="hidden" value="<?php echo $toDestinationFlight; ?>" autocomplete="nope">
		</label>
        </td>
        <td width="18%" align="left" valign="top">  <label class="greyouter"><div class="lable" id="departurelabel">Departure</div><input type="text" id="dt1" name="journeyDateOne" class="textfield"  value="<?php echo trim($journeyDateOne); ?>" autocomplete="off" style="min-width: 140px;"  ><i class="fa fa-calendar" aria-hidden="true"></i></label></td>
        <td width="18%" align="left" valign="top" onClick="selecttb(2);" class="selectreturnflightcl">
         <label class="greyouter"> <div class="lable" id="returnlable">Return</div>
        <input type="text" id="dt2" name="journeyDateRound" class="textfield"  value="<?php echo trim($journeyDateRound); ?>" autocomplete="off" <?php if($tripType==1){ ?>disabled  style="color:#fafafa;" <?php } ?> <?php if($_REQUEST['tripType']==1){ ?>disabled="disabled"<?php } ?>  ><i class="fa fa-calendar" aria-hidden="true"></i>  </label></td>
        <td width="18%" align="left" valign="top">
<div class="greyouter">
	<div class="lable" id="returnlable">Travellers & Class</div>

	<input type="text" id="travellersshow"  name="travellersshow"  class="textfield"  value="<?php echo trim($_REQUEST['travellersshow']); ?>" autocomplete="off" readonly="readonly" onClick="$('#mobileflightsearchpax').show();"  >

				</div>			

							

							  <script>

  $('#basicDropdownClick').click(function(event){

  event.stopPropagation();

});

						
						
						
						function countadultchild(id,selectdiv){ 
						 
						 var remainingpax=0;
						var maxadultchild=10;
						var toadult=1;
						var tochild=0;
						
						if(selectdiv=='adt'){
						toadult=Number(id);
						} else {
						toadult=Number($('#ADT').val());
						}
						
						if(selectdiv=='chd'){
						tochild=Number(id);
						} else {
						tochild=Number($('#CHD').val());
						}
						 
						
						 maxadultchild=Number(maxadultchild-toadult);
					
						 maxadultchild=Number(maxadultchild-tochild);
						 	
							
							if(maxadultchild>0){
							selectadultad(id,selectdiv);
							} else {
							alert('You can not select more then 9 (Adult + Child)');
							}
						
						
						 
						 
						  
						}

 

					 function selectadultad(id,selectdiv){
					 
					 

					 $('.'+selectdiv+' .paxbx').removeClass('active');

					

					 

					 if(selectdiv=='adt'){

					 $('#ADT').val(id);

					  $('#adt'+id).addClass('active');

					  selectpaxs();

					 }

					 

					 if(selectdiv=='chd'){

					 $('#chd'+id).addClass('active');

					 $('#CHD').val(id);

					 selectpaxs();

					 }

					 

					 

					 

					 if(selectdiv=='inft'){

					 $('#inft'+id).addClass('active');

					 $('#INF').val(id);

					 selectpaxs();

					 }

					 

					 }

					 </script>

 

 <div id="mobileflightsearchpax" class="dropdown-menu dropdown-unfold col-11 m-0 " aria-labelledby="basicDropdownClickInvoker" style="width: 370px; right: 0px;">
                   
					  
					  <div class=" "  style="margin-bottom: 10px;">
					  
					  
					  
                        <div class="js-quantity mx-1 row align-items-center justify-content-between">
						   <div class=" "  style="margin-bottom: 10px; width:100%; position:relative;">
					  <strong>Travellers</strong> <i class="fa donebtn1" aria-hidden="true" style="position: absolute; right: 10px; cursor: pointer; top: 4px; font-size: 16px; color: #000;" onClick="$('#mobileflightsearchpax').hide();">Done</i>
					  </div>
						
						 <span class="font-weight-medium" style="argin-bottom: 0px;">Adults</span>
					 <div class="d-flex">
					 <div class="boxselectpax adt">
							 <div class="paxbx <?php echo ($ADT == 1 ? 'active':''); ?>" id="adt1" onClick="selectadultad('1','adt');">1</div>
							 <div class="paxbx <?php echo ($ADT == 2 ? 'active':''); ?>" id="adt2" onClick="selectadultad('2','adt');">2</div>
							 <div class="paxbx <?php echo ($ADT == 3 ? 'active':''); ?>" id="adt3" onClick="selectadultad('3','adt');">3</div>
							 <div class="paxbx <?php echo ($ADT == 4 ? 'active':''); ?>" id="adt4" onClick="selectadultad('4','adt');">4</div>
							 <div class="paxbx <?php echo ($ADT == 5 ? 'active':''); ?>" id="adt5" onClick="selectadultad('5','adt');">5</div>
							 <div class="paxbx <?php echo ($ADT == 6 ? 'active':''); ?>" id="adt6" onClick="selectadultad('6','adt');">6</div>
							 <div class="paxbx <?php echo ($ADT == 7 ? 'active':''); ?>" id="adt7" onClick="selectadultad('7','adt');">7</div>
							 <div class="paxbx <?php echo ($ADT == 8 ? 'active':''); ?>" id="adt8" onClick="selectadultad('8','adt');">8</div>
							 <div class="paxbx <?php echo ($ADT == 9 ? 'active':''); ?>" id="adt9" onClick="selectadultad('9','adt');">9</div>
							 </div>
					 </div>
					 
					 
					 
                          <div class="d-flex" style="display:none !important;">
						  	  
                            <select id="ADT" name="ADT" class="form-control" onChange="selectpaxs();">
                              <option value="1" <?php echo ($ADT == 1 ? 'selected':''); ?>>1</option>
                              <option value="2" <?php echo ($ADT == 2 ? 'selected':''); ?>>2</option>
                              <option value="3" <?php echo ($ADT == 3 ? 'selected':''); ?>>3</option>
                              <option value="4" <?php echo ($ADT == 4 ? 'selected':''); ?>>4</option>
                              <option value="5" <?php echo ($ADT == 5 ? 'selected':''); ?>>5</option>
                              <option value="6" <?php echo ($ADT == 6 ? 'selected':''); ?>>6</option>
                              <option value="7" <?php echo ($ADT == 7 ? 'selected':''); ?>>7</option>
                              <option value="8" <?php echo ($ADT == 8 ? 'selected':''); ?>>8</option>
                              <option value="9" <?php echo ($ADT == 9 ? 'selected':''); ?>>9</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class=""  style="margin-bottom: 10px;">
                        <div class="js-quantity mx-1 row align-items-center justify-content-between"> <span class="d-block font-size-16 text-secondary font-weight-medium">Children (2 - 12 Years )</span>
						
						<div class="d-flex">
					 <div class="boxselectpax chd">
							 <div class="paxbx <?php echo ($CHD == 0 ? 'active':''); ?>" id="chd0" onClick="selectadultad('0','chd');">0</div>
							 <div class="paxbx <?php echo ($CHD == 1 ? 'active':''); ?>" id="chd1" onClick="selectadultad('1','chd');">1</div>
							 <div class="paxbx <?php echo ($CHD == 2 ? 'active':''); ?>" id="chd2" onClick="selectadultad('2','chd');">2</div>
							 <div class="paxbx <?php echo ($CHD == 3 ? 'active':''); ?>" id="chd3" onClick="selectadultad('3','chd');">3</div>
							 <div class="paxbx <?php echo ($CHD == 4 ? 'active':''); ?>" id="chd4" onClick="selectadultad('4','chd');">4</div>
							 <div class="paxbx <?php echo ($CHD == 5 ? 'active':''); ?>" id="chd5" onClick="selectadultad('5','chd');">5</div>
							 <div class="paxbx <?php echo ($CHD == 6 ? 'active':''); ?>" id="chd6" onClick="selectadultad('6','chd');">6</div>
							 <div class="paxbx <?php echo ($CHD == 7 ? 'active':''); ?>" id="chd7" onClick="selectadultad('7','chd');">7</div>
							 <div class="paxbx <?php echo ($CHD == 8 ? 'active':''); ?>" id="chd8" onClick="selectadultad('8','chd');">8</div>
							 </div>
					 </div>
						
                          <div class="d-flex" style="display:none !important;">
                            <select id="CHD" name="CHD" class="form-control" onChange="selectpaxs();">
                              <option value="0" <?php echo ($CHD == 0 ? 'selected':''); ?>>0</option>
                              <option value="1" <?php echo ($CHD == 1 ? 'selected':''); ?>>1</option>
                              <option value="2" <?php echo ($CHD == 2 ? 'selected':''); ?>>2</option>
                              <option value="3" <?php echo ($CHD == 3 ? 'selected':''); ?>>3</option>
                              <option value="4" <?php echo ($CHD == 4 ? 'selected':''); ?>>4</option>
                              <option value="5" <?php echo ($CHD == 5 ? 'selected':''); ?>>5</option>
                              <option value="6" <?php echo ($CHD == 6 ? 'selected':''); ?>>6</option>
                              <option value="7" <?php echo ($CHD == 7 ? 'selected':''); ?>>7</option>
                              <option value="8" <?php echo ($CHD == 8 ? 'selected':''); ?>>8</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="" style="margin-bottom: 10px;">
                        <div class="js-quantity mx-1 row align-items-center justify-content-between"> <span class="d-block font-size-16 text-secondary font-weight-medium">Infants 0-23 Months</span>
                          
						  <div class="d-flex">
					 <div class="boxselectpax inft">
							 <div class="paxbx <?php echo ($INF == 0 ? 'active':''); ?>" id="inft0" onClick="selectadultad('0','inft');">0</div>
							 <div class="paxbx <?php echo ($INF == 1 ? 'active':''); ?>" id="inft1" onClick="selectadultad('1','inft');">1</div>
							 <div class="paxbx <?php echo ($INF == 2 ? 'active':''); ?>" id="inft2" onClick="selectadultad('2','inft');">2</div>
							 <div class="paxbx <?php echo ($INF == 3 ? 'active':''); ?>" id="inft3" onClick="selectadultad('3','inft');">3</div>
							 <div class="paxbx <?php echo ($INF == 4 ? 'active':''); ?>" id="inft4" onClick="selectadultad('4','inft');">4</div>
							 <div class="paxbx <?php echo ($INF == 5 ? 'active':''); ?>" id="inft5" onClick="selectadultad('5','inft');">5</div>
							 <div class="paxbx <?php echo ($INF == 6 ? 'active':''); ?>" id="inft6" onClick="selectadultad('6','inft');">6</div> 
							 </div>
					 </div>
						  <div class="d-flex"  style="display:none !important;">
                            <select id="INF" name="INF" class="form-control" onChange="selectpaxs();">
                              <option value="0" <?php echo ($INF == 0 ? 'selected':''); ?>>0</option>
                              <option value="1" <?php echo ($INF == 1 ? 'selected':''); ?>>1</option>
                              <option value="2" <?php echo ($INF == 2 ? 'selected':''); ?>>2</option>
                              <option value="3" <?php echo ($INF == 3 ? 'selected':''); ?>>3</option>
                              <option value="4" <?php echo ($INF == 4 ? 'selected':''); ?>>4</option>
                              <option value="5" <?php echo ($INF == 5 ? 'selected':''); ?>>5</option>
                              <option value="6" <?php echo ($INF == 6 ? 'selected':''); ?>>6</option>
                            </select>
                          </div>
                        </div>
                      </div>
					  
					  
					  
					  <div class="" style="margin-bottom: 10px;">
                        <div class="js-quantity mx-1 row align-items-center justify-content-between"> <span class="d-block font-size-16 text-secondary font-weight-medium">Preffered Class</span>
                          <div class="d-flex">
                            <select id="PC" name="PC" class="form-control" onChange="selectpaxs();" > 
                       <option value="ECONOMY" <?php if($PC=='ECONOMY'){ echo 'selected'; }?>>ECONOMY</option> 
                              <option value="PREMIUM_ECONOMY" <?php if($PC=='PREMIUM_ECONOMY'){ echo 'selected'; }?>>PREMIUM ECONOMY</option>
                              <option value="BUSINESS" <?php if($PC=='BUSINESS'){ echo 'selected'; }?>>BUSINESS</option>
                              <option value="FIRST" <?php if($PC=='FIRST'){ echo 'selected'; }?>>FIRST</option>

                            </select>
                          </div>
                        </div>
                      </div>
					  <script>
							function selectpaxs(){
							var ADT = Number($('#ADT').val());
							var CHD = Number($('#CHD').val());
							var INF = Number($('#INF').val());
							var PC = $('#PC').val();
							
						 
							
							$('#travellersshow').val(Number(ADT+CHD+INF)+' Pax, '+PC); 
							}
							</script>
					  
                       
                       
              </div>

	

	</td>
	<td class="lastable" width="100%" style="padding-top:0px !important;padding-left: 0px !important;border-right: 0px !important;">
                      <div class="searchsmallbtn searchtabbtn">
                        <button type="submit" onClick="findflight(1);" class="btn"><i class="fa fa-search" aria-hidden="true"></i><span class="searchspan">Search</span></button>

                      </div>
                    </td>
        </tr>
    </tbody>
</table>
</div>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="mobdme2">
      <tbody><tr>
        
        <td>
        <div style="text-align:center;" class="listlastflight">
<div style="background-color: #f2f2f2; border-radius: 10px; display:inline-block; width:auto;text-align: center; height: 39px; overflow: hidden; border-radius:8px;"> 
 <label><table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td valign="bottom"  style="padding:10px 5px 10px 10px !important;line-height: 13px; "><input name="psting"  type="radio" value="" checked></td>
      <td colspan="3" style="padding:10px 10px 10px 2px !important; ">All</td>
      </tr>
  </table></label>
  
<label><table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td valign="bottom"  style="padding:10px 5px 10px 10px !important;line-height: 13px;border-left: 2px solid #fff; "><input name="psting"  type="radio" value="Regular" <?php if($_REQUEST['psting']=='Regular'){ ?>checked="checked"<?php } ?> ></td>
      <td colspan="3" style="padding:10px 10px 10px 2px !important; ">Regular</td>
      </tr>
  </table></label>
<label><table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td valign="bottom"  style="padding:10px 5px 10px 10px !important;line-height: 13px; border-left:2px solid #fff; "><input  type="radio" name="psting" value="Student" <?php if($_REQUEST['psting']=='Student'){ ?>checked="checked"<?php } ?>></td>
      <td colspan="3" style="padding:10px 10px 10px 2px !important; ">Student</td>
      </tr>
  </table></label>
<label><table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td valign="bottom"  style="padding:10px 5px 10px 10px !important;line-height: 13px;  border-left:2px solid #fff;"><input  type="radio" name="psting" value="Senior citizen" <?php if($_REQUEST['psting']=='Senior citizen'){ ?>checked="checked"<?php } ?>></td>
      <td colspan="3" style="padding:10px 10px 10px 2px !important; ">Senior Citizen</td>
      </tr>
  </table></label>
</div> 
 
</div>

        <!-- secondrighttable -->
        <table border="0" align="right" cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                
              <td>
                
              </td>
              <td class="trendingsearch" style="padding-right:10px !important;">
                <h3>Trending<br>
Searches</h3>
              </td>
              <td colspan="3" ><div style="background-color: #f2f2f2; border-radius: 10px; display:inline-block; width:auto;text-align: center; height: 39px; overflow: hidden; border-radius:8px;"> 
 
 <?php

$a=GetPageRecord('*','flightSearchLog',' agentId="'.$_SESSION['agentUserid'].'" order by id desc limit 0,6');

while($flighthistory=mysqli_fetch_array($a)){ 

?>
<a href="flight-search?tripType=<?php echo stripslashes($flighthistory['tripType']); ?>&fromcitydesti=<?php echo stripslashes($flighthistory['userFrom']); ?>&fromDestinationFlight=<?php echo stripslashes($flighthistory['fromDestinationFlight']); ?>&tocitydesti=<?php echo stripslashes($flighthistory['userTo']); ?>&toDestinationFlight=<?php echo stripslashes($flighthistory['toDestinationFlight']); ?>&journeyDateOne=<?php echo date('d-m-Y',strtotime($flighthistory['userDeparture'])); ?>&journeyDateRound=<?php if(date('d-m-Y',strtotime($flighthistory['userArrival']))>'1970-01-01'){ echo date('d-m-Y',strtotime($flighthistory['userArrival'])); } ?>&travellersshow=1+Pax%2C+Economy&ADT=1&CHD=0&INF=0&PC=EC&Submit=SEARCH&action=flightpostaction&changesearch=0" class="flighttrandingsearch">
<label><table border="0" cellpadding="0" cellspacing="0" style="cursor:pointer;">

  <tr>

    <td><?php echo substr(stripslashes($flighthistory['userFrom']), 0, strpos(stripslashes($flighthistory['userFrom']), " - ")); ?></td>

    <td><i class="fa fa-arrow-right" aria-hidden="true"></i></td>

    <td><?php echo substr(stripslashes($flighthistory['userTo']), 0, strpos(stripslashes($flighthistory['userTo']), " - ")); ?></td>

  </tr>

</table></label> 
		</a>
		<?php } ?>
 
</div></td>
            </tr>
            
          </tbody></table>
    
    </td>
        </tr>
    </tbody>


    
</table>


    
    
     
    
    <input type="hidden" name="action" value="flightpostaction">
    <input type="hidden" name="changesearch" id="changesearch" value="0">
    </form>
  </div>
    </div>
    </div>
    </div> 
 
 

<div class="container" style="margin-top:20px; margin-bottom:20px;"> 
<div class="row">
<div class="container" >
<div class="col-12">
<div class="flightsearchcalouter phonenewsearchouter">


<?php

if(date('Y-m-d',strtotime($journeyDateOne))==date('Y-m-d')){
$enddays=6;
 
$journeyDateOnestart=date('Y-m-d',strtotime('+0 day', strtotime($journeyDateOne)));
}

if(date('Y-m-d',strtotime($journeyDateOne))==date('Y-m-d',strtotime('+1 day'))){
$enddays=5;
$journeyDateOnestart=date('Y-m-d',strtotime('-1 day', strtotime($journeyDateOne)));
}

if(date('Y-m-d',strtotime($journeyDateOne))==date('Y-m-d',strtotime('+2 day'))){
$enddays=4;
$journeyDateOnestart=date('Y-m-d',strtotime('-2 day', strtotime($journeyDateOne)));
}
 

if(date('Y-m-d',strtotime($journeyDateOne))==date('Y-m-d',strtotime('+3 day'))){
$enddays=3;
$journeyDateOnestart=date('Y-m-d',strtotime('-3 day', strtotime($journeyDateOne)));
}

if(date('Y-m-d',strtotime($journeyDateOne))>date('Y-m-d',strtotime('+3 day'))){
$enddays=3;
$journeyDateOnestart=date('Y-m-d',strtotime('-3 day', strtotime($journeyDateOne)));
}

 
 

 $begin = new DateTime(date('Y-m-d',strtotime($journeyDateOnestart)));

 $end   = new DateTime(date('Y-m-d',strtotime('+'.$enddays.' day', strtotime($journeyDateOne))));

   

for($i = $begin; $i <= $end; $i->modify('+1 day')){

?>

<div class="datesbox <?php if($i->format("d-m-Y")==$journeyDateOne){ ?>active<?php } ?>"  <?php if($i->format("d-m-Y")!=$journeyDateOne){ ?>onClick="$('#dt1').val('<?php echo $i->format("d-m-Y"); ?>');$('#formids').submit();"<?php } ?>><?php echo $i->format("D, M j"); ?></div>

<?php } ?>

</div>
</div>
</div>

<div class="col-3 filtersidebar" id="allFilterDiv">
<div class="mobilefilterheader mobileshow" onClick="$('.filtersidebar').toggle();"><i class="fa fa-times" aria-hidden="true"></i> &nbsp;Filter</div>
<div class="card nav-pills"  style="margin-top:0px;">
<div class="card-header">
    Price Range
  </div>
<div class="card-body">
		<div class=""> 
			<p class="range-value">
			<input type="text" id="amountfilter" readonly style="border: 0px;">
			</p>
		<div id="slider-ranges" class="range-bar"></div> 
		</div>
</div>

 
<div class="card-body" style="padding-bottom:0px; display:none;">
<a style="cursor:pointer;" id="shownetpricebtn" onClick="$('.mainprice').hide();$('.netpriceshow').show();$('#shownetpricebtn').hide();$('#hidenetpricebtn').show();"><i class="fa fa-eye" aria-hidden="true"></i> <strong>Show Net Fare</strong></a>
<a style="cursor:pointer; display:none;" id="hidenetpricebtn" onClick="$('.mainprice').show();$('.netpriceshow').hide();$('#shownetpricebtn').show();$('#hidenetpricebtn').hide();"><i class="fa fa-eye-slash" aria-hidden="true"></i> <strong>Hide Net Fare</strong></a>
</div>


<div class="card-header">
    Stops
  </div>
<div class="card-body allFilterDiv">
<div class="filterinnerboxes arranddep">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="25%"  ><div class="custom-control custom-checkbox filter-stops" data-value="nonstopss">
                        <input type="checkbox" id="0stop" value="0stop" name="stop" class="custom-control-input i-check"  >
                        <label class="custom-control-label " for="0stop">0<br>Non Stop  </label>
                      </div></td>
    <td width="25%"  ><div class="custom-control custom-checkbox filter-stops" data-value="1">
                        <input type="checkbox" id="1stop" value="1stop" name="stop" class="custom-control-input i-check" >
                        <label class="custom-control-label" for="1stop">1 <br>Stop  </label>
                      </div></td>
    <td width="25%"  ><div class="custom-control custom-checkbox filter-stops" data-value="2">
                        <input type="checkbox" id="2stop" name="stop" value="2stop" class="custom-control-input i-check" >
                        <label class="custom-control-label" for="2stop">2+ <br>Stop  </label>
                      </div></td>
    </tr>
</table>

</div> 
</div>


<?php if($_REQUEST['tripType']==2){ ?>
<div class="card-header">
    Return Stops
  </div>
<div class="card-body allFilterDiv2">
<div class="filterinnerboxes arranddep">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="25%"  ><div class="custom-control custom-checkbox filter-stops" data-value="nonstopss">
                        <input type="checkbox" id="0stop2" value="0stop" name="stop" class="custom-control-input i-check"  >
                        <label class="custom-control-label " for="0stop2">0<br>Non Stop  </label>
                      </div></td>
    <td width="25%"  ><div class="custom-control custom-checkbox filter-stops" data-value="1">
                        <input type="checkbox" id="1stop2" value="1stop" name="stop" class="custom-control-input i-check" >
                        <label class="custom-control-label" for="1stop2">1 <br>Stop  </label>
                      </div></td>
    <td width="25%"  ><div class="custom-control custom-checkbox filter-stops" data-value="2">
                        <input type="checkbox" id="2stop2" name="stop" value="2stop" class="custom-control-input i-check" >
                        <label class="custom-control-label" for="2stop2">2+ <br>Stop  </label>
                      </div></td>
    </tr>
</table>

</div> 
</div>
<?php } ?>



<div class="card-header">
    Departure   
  </div>
<div class="card-body allFilterDiv">
<div class="filterinnerboxes arranddep">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="25%">
	<div class="custom-control custom-checkbox clearfix filter-dtime" data-min="<?php echo strtotime(date('Y-m-d', strtotime($data['dep_date'])).' 06:00:00');?>" data-max="<?php echo strtotime(date("Y-m-d", strtotime($data['dep_date'])).' 11:59:00');?>">
                        <input type="checkbox" id="earlyMorning" name="departureTime[]" value="D6" class="custom-control-input i-check">
                        <label class="custom-control-label clrwht"   for="earlyMorning"><div class="mor-n1"></div>00-06</label>
                  </div>
	
	</td>
    <td width="25%">
	<div class="custom-control custom-checkbox clearfix filter-dtime" data-min="<?php echo strtotime(date('Y-m-d', strtotime($data['dep_date'])).' 12:00:00');?>" data-max="<?php echo strtotime(date("Y-m-d", strtotime($data['dep_date'])).' 17:59:00');?>">
                        <input type="checkbox" id="morning" name="departureTime[]" value="D12"   class="custom-control-input i-check">
                        <label class="custom-control-label clrwht" for="morning"><div class="mor1-n2"></div>06-12</label>
                  </div>
	</td>
    <td width="25%"><div class="custom-control custom-checkbox clearfix filter-dtime" data-min="<?php echo strtotime(date('Y-m-d', strtotime($data['dep_date'])).' 18:00:00');?>" data-max="<?php echo strtotime(date("Y-m-d", strtotime($data['dep_date'])).' 23:59:00');?>">
                        <input type="checkbox" id="midDay" name="departureTime[]"  value="D18"  class="custom-control-input i-check">
                        <label class="custom-control-label clrwht" for="midDay"><div class="mor2-n3"></div>12-18</label>
                      </div></td>
    <td width="25%"><div class="custom-control custom-checkbox clearfix filter-dtime" data-min="<?php echo strtotime(date('Y-m-d', strtotime($data['dep_date'])).' 00:00:00');?>" data-max="<?php echo strtotime(date("Y-m-d", strtotime($data['dep_date'])).' 05:59:00');?>">
                        <input type="checkbox" id="evening" name="departureTime[]"  value="D1"   class="custom-control-input i-check">
                        <label class="custom-control-label clrwht" for="evening"><div class="mor3-n4"></div>18-00</label>
                      </div></td>
  </tr>
</table>

</div> 
</div>

<?php if($_REQUEST['tripType']==2 && $_SESSION['isRoundTripInt']!=1){ ?>
<div class="card-header">
    Return Departure  
  </div>
<div class="card-body allFilterDiv2">
<div class="filterinnerboxes arranddep">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="25%">
	<div class="custom-control custom-checkbox clearfix filter-dtime" data-min="<?php echo strtotime(date('Y-m-d', strtotime($data['dep_date'])).' 06:00:00');?>" data-max="<?php echo strtotime(date("Y-m-d", strtotime($data['dep_date'])).' 11:59:00');?>">
                        <input type="checkbox" id="earlyMorningret" name="departureTime[]" value="D6" class="custom-control-input i-check">
                        <label class="custom-control-label clrwht"   for="earlyMorningret"><div class="mor-n1"></div>00-06</label>
                  </div>
	
	</td>
    <td width="25%">
	<div class="custom-control custom-checkbox clearfix filter-dtime" data-min="<?php echo strtotime(date('Y-m-d', strtotime($data['dep_date'])).' 12:00:00');?>" data-max="<?php echo strtotime(date("Y-m-d", strtotime($data['dep_date'])).' 17:59:00');?>">
                        <input type="checkbox" id="morningret" name="departureTime[]" value="D12"   class="custom-control-input i-check">
                        <label class="custom-control-label clrwht" for="morningret"><div class="mor1-n2"></div>06-12</label>
                  </div>
	</td>
    <td width="25%"><div class="custom-control custom-checkbox clearfix filter-dtime" data-min="<?php echo strtotime(date('Y-m-d', strtotime($data['dep_date'])).' 18:00:00');?>" data-max="<?php echo strtotime(date("Y-m-d", strtotime($data['dep_date'])).' 23:59:00');?>">
                        <input type="checkbox" id="midDayret" name="departureTime[]"  value="D18"  class="custom-control-input i-check">
                        <label class="custom-control-label clrwht" for="midDayret"><div class="mor2-n3"></div>12-18</label>
                      </div></td>
    <td width="25%"><div class="custom-control custom-checkbox clearfix filter-dtime" data-min="<?php echo strtotime(date('Y-m-d', strtotime($data['dep_date'])).' 00:00:00');?>" data-max="<?php echo strtotime(date("Y-m-d", strtotime($data['dep_date'])).' 05:59:00');?>">
                        <input type="checkbox" id="eveningret" name="departureTime[]"  value="D1"   class="custom-control-input i-check">
                        <label class="custom-control-label clrwht" for="eveningret"><div class="mor3-n4"></div>18-00</label>
                      </div></td>
  </tr>
</table>

</div> 
</div>
<?php } ?>


<div class="card-header">
    Arrival  
  </div>
<div class="card-body allFilterDiv">
<div class="filterinnerboxes arranddep">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="25%">
	<div class="custom-control custom-checkbox clearfix filter-dtime" data-min="<?php echo strtotime(date('Y-m-d', strtotime($data['dep_date'])).' 06:00:00');?>" data-max="<?php echo strtotime(date("Y-m-d", strtotime($data['dep_date'])).' 11:59:00');?>">
                        <input type="checkbox" id="earlyMorning2" name="departureTime" value="A6" class="custom-control-input i-check">
                        <label class="custom-control-label clrwht"   for="earlyMorning2"><div class="mor-n1"></div>00-06</label>
                  </div>
	
	</td>
    <td width="25%">
	<div class="custom-control custom-checkbox clearfix filter-dtime" data-min="<?php echo strtotime(date('Y-m-d', strtotime($data['dep_date'])).' 12:00:00');?>" data-max="<?php echo strtotime(date("Y-m-d", strtotime($data['dep_date'])).' 17:59:00');?>">
                        <input type="checkbox" id="morning2" name="departureTime" value="A12"   class="custom-control-input i-check">
                        <label class="custom-control-label clrwht" for="morning2"><div class="mor1-n2"></div>06-12</label>
                  </div>
	</td>
    <td width="25%"><div class="custom-control custom-checkbox clearfix filter-dtime" data-min="<?php echo strtotime(date('Y-m-d', strtotime($data['dep_date'])).' 18:00:00');?>" data-max="<?php echo strtotime(date("Y-m-d", strtotime($data['dep_date'])).' 23:59:00');?>">
                        <input type="checkbox" id="midDay2" name="departureTime"  value="A18"  class="custom-control-input i-check">
                        <label class="custom-control-label clrwht" for="midDay2"><div class="mor2-n3"></div>12-18</label>
                      </div></td>
    <td width="25%"><div class="custom-control custom-checkbox clearfix filter-dtime" data-min="<?php echo strtotime(date('Y-m-d', strtotime($data['dep_date'])).' 00:00:00');?>" data-max="<?php echo strtotime(date("Y-m-d", strtotime($data['dep_date'])).' 05:59:00');?>">
                        <input type="checkbox" id="evening2" name="departureTime"  value="A1"   class="custom-control-input i-check">
                        <label class="custom-control-label clrwht" for="evening2"><div class="mor3-n4"></div>18-00</label>
                      </div></td>
  </tr>
</table>

</div> 
</div>

<?php if($_REQUEST['tripType']==2 && $_SESSION['isRoundTripInt']!=1){ ?>
<div class="card-header">
    Return Arrival  
  </div>
<div class="card-body allFilterDiv2">
<div class="filterinnerboxes arranddep">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="25%">
	<div class="custom-control custom-checkbox clearfix filter-dtime" data-min="<?php echo strtotime(date('Y-m-d', strtotime($data['dep_date'])).' 06:00:00');?>" data-max="<?php echo strtotime(date("Y-m-d", strtotime($data['dep_date'])).' 11:59:00');?>">
                        <input type="checkbox" id="earlyMorning22" name="departureTime" value="A6" class="custom-control-input i-check">
                        <label class="custom-control-label clrwht"   for="earlyMorning22"><div class="mor-n1"></div>00-06</label>
                  </div>
	
	</td>
    <td width="25%">
	<div class="custom-control custom-checkbox clearfix filter-dtime" data-min="<?php echo strtotime(date('Y-m-d', strtotime($data['dep_date'])).' 12:00:00');?>" data-max="<?php echo strtotime(date("Y-m-d", strtotime($data['dep_date'])).' 17:59:00');?>">
                        <input type="checkbox" id="morning22" name="departureTime" value="A12"   class="custom-control-input i-check">
                        <label class="custom-control-label clrwht" for="morning22"><div class="mor1-n2"></div>06-12</label>
                  </div>
	</td>
    <td width="25%"><div class="custom-control custom-checkbox clearfix filter-dtime" data-min="<?php echo strtotime(date('Y-m-d', strtotime($data['dep_date'])).' 18:00:00');?>" data-max="<?php echo strtotime(date("Y-m-d", strtotime($data['dep_date'])).' 23:59:00');?>">
                        <input type="checkbox" id="midDay22" name="departureTime"  value="A18"  class="custom-control-input i-check">
                        <label class="custom-control-label clrwht" for="midDay22"><div class="mor2-n3"></div>12-18</label>
                      </div></td>
    <td width="25%"><div class="custom-control custom-checkbox clearfix filter-dtime" data-min="<?php echo strtotime(date('Y-m-d', strtotime($data['dep_date'])).' 00:00:00');?>" data-max="<?php echo strtotime(date("Y-m-d", strtotime($data['dep_date'])).' 05:59:00');?>">
                        <input type="checkbox" id="evening22" name="departureTime"  value="A1"   class="custom-control-input i-check">
                        <label class="custom-control-label clrwht" for="evening22"><div class="mor3-n4"></div>18-00</label>
                      </div></td>
  </tr>
</table>

</div> 
</div>
<?php } ?>



 
 

<?php if($_REQUEST['tripType']==2){ ?>
 
 
<?php } ?>


<div class="card-header">
    Airline
  </div>
<div class="card-body allFilterDiv bigcheck">

<?php
$a=GetPageRecord('*','sys_flightName','1 order by name asc');
while($res=mysqli_fetch_array($a)){

 
?>
<div class="form-check" id="flightnameid<?php echo str_replace(' ','-',stripslashes($res['name'])); ?>" style="display:none;">
  <input class="form-check-input" name="flightslist" type="checkbox" value="<?php echo str_replace(' ','-',stripslashes($res['name'])); ?>"  >
  <label class="form-check-label" for="flexCheckDefault">
    <?php echo substr(stripslashes($res['name']),'0','12'); ?>... <span class="totalflight<?php echo stripslashes($res['id']); ?> graytextlable"></span>
  </label>
</div>
 <?php } ?>
  
</div>

<?php if($_REQUEST['tripType']==2 && $_SESSION['isRoundTripInt']!=1){ ?>
<div class="card-header">
    Return Airlines
  </div>
<div class="card-body allFilterDiv2 bigcheck">

<?php
$a=GetPageRecord('*','sys_flightName','1 order by name asc');
while($res=mysqli_fetch_array($a)){
?>
<div class="form-check" id="flightnameid2<?php echo str_replace(' ','-',stripslashes($res['name'])); ?>" style="display:none;">
  <input class="form-check-input" name="flightslist" type="checkbox" value="<?php echo str_replace(' ','-',stripslashes($res['name'])); ?>"  >
  <label class="form-check-label" for="flexCheckDefault">
    <?php echo substr(stripslashes($res['name']),'0','12'); ?>... <span class="totalflightret<?php echo stripslashes($res['id']); ?> graytextlable"></span>
  </label>
</div>
 <?php } ?>
  
</div>
<?php } ?>
</div>

 

 

 
</div>


<div class="col-9 cardresult">



<div class="changeflightbox">
<div class="chin">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td class="tdpadding"><div style="color: #fff; background-color: var(--blue); padding: 2px 8px; float: left; font-size: 12px; border-radius: 2px;">Depart</div></td>
    <td class="tdpadding">
	<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td> 
	<div class="subtext"><?php echo $fromdestexp[1]; ?></div>	</td>
    <td>&nbsp;-&nbsp;</td>
    <td> 
	<div class="subtext"><?php echo $todestexp[1]; ?></div>	</td>
  </tr>
</table>	</td>
    <td class="tdpadding">
	 
	<div class="subtext"><?php echo date('D, M d Y',strtotime($journeyDateOne)); ?></div>	</td>
    <?php if($_REQUEST['tripType']==2){ ?>
	 <td class="tdpadding"><div style="color: #fff; background-color: var(--blue); padding: 2px 8px; float: left; font-size: 12px; border-radius: 2px;">Return</div></td>
	<td class="tdpadding">
	 
	<div class="subtext"><?php echo date('D, M d Y',strtotime($journeyDateRound)); ?></div>	</td>
	<?php } ?>
    <td class="tdpadding">
	 
	<div class="subtext"><?php echo $_REQUEST['ADT']; ?> Adult<?php if($_REQUEST['CHD']>0){ echo ', '.$_REQUEST['CHD'].' Child..'; }  ?>, <?php echo $_REQUEST['PC']; ?></div>	</td>
    <td align="right" class="tdpadding"><a  onClick="showmodify();" style="cursor:pointer; color:var(--blue);" id="trmodify">Modify Search</a></td>
  </tr>
</table>

<script>
function showmodify(){
var ddd=$('.top_bg_ofr_sb').css('height');
if(ddd=='250px'){
$('#trmodify').text('Modify Search');
$('.top_bg_ofr_sb').css('height','0px');
$('.top_bg_ofr_sb').css('overflow','hidden');
} else { 
$('#trmodify').text('Close Modify');
$('.top_bg_ofr_sb').css('height','250px');
$('.top_bg_ofr_sb').css('overflow','visible');
}
}
</script>

</div>
</div>
<?php if($_REQUEST['tripType']==1 || ($isRoundTripInt==1 && $_REQUEST['tripType']==2) || ($_REQUEST['tripType']==3) ){ ?>
<div style="position: fixed; left: 0px; top: 58px; z-index: 9; background: rgb(9,181,152); background: linear-gradient(166deg, rgba(9,181,152,1) 0%, rgba(10,161,135,1) 100%); width: 100%; text-align: center; padding: 52px 0px 30px; font-size: 15px; color: #fff; box-shadow: 0px 6px 24px #0000004d; display:none;" id="hideflightloading">
<div style="margin:auto; width:1000px;">
<div style="height:15px; background-color:#058c75;border-radius: 50px; overflow:hidden; position:relative;">
<div id="loadingtopbox" style="position:absolute; left:0px; top:0px; height:15px; background-color:#FFFFFF;border-radius: 50px; width:50%;"></div>

</div>
<div style="text-align:center; font-size:12px; margin-top:10px;">Wait Please...</div>

<style>
#loadingtopbox {
-webkit-transition: width 1s ease-in-out;
    -moz-transition: width 1s ease-in-out;
    -o-transition: width 1s ease-in-out;
    transition: width 1s ease-in-out;
	}
</style>
<script>
var widthbox=15;
setInterval(function() {
   $('#loadingtopbox').css('width',widthbox+'%');
   
   widthbox=Number(widthbox+2);
 }, 500);
</script>

</div>

</div>

<div id="flightresult" class="listouter"></div>
 
 <script>
 
$('#flightresult').load('flight_result_display_one_way_fake.php?undercons=1');
 </script>
 <?php } ?>
 

 
 
<?php if($_REQUEST['tripType']==2 && $isRoundTripInt==0){ ?>


<div id="flightresult" ></div>
 
  <script>
 
$('#flightresult').load('flight_result_display_round_way_fake.php?undercons=1');
 </script>
 
 
 <?php } ?>


 

</div>
</div>
 </div>
 
 
 
 <?php 
$geturl = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$geturl = str_replace($fullurl,'',$geturl);
$geturl = str_replace('flight-search','',$geturl);

if($_REQUEST['tripType']==1){
$pagesearch='one-way-flight-search.php'.$geturl;
 }  
 else if($_REQUEST['tripType']==2){
$pagesearch='round-trip-flight-search.php'.$geturl;
 }

 else if($_REQUEST['tripType']==3){
$pagesearch='round-trip-flight-search-domestic-special.php'.$geturl;
 } 
 
 ?>


<?php if($_REQUEST['tripType']==2){ ?>
<div class="asp-btm">
<div class="container" style="padding:0px 80px;" >
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="40%" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-right:1px solid #fff;">
  <tr>
    <td colspan="2"><div class="row displaytab1" style="color:#FFFFFF;"></div></td>
    <td width="20%" align="center" style="color:#FFFFFF; font-size:16px;">&#8377;<span  id="displaytab1price"></span></td>
  </tr>
  
</table>
</td>
    <td width="40%" align="left">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-right:1px solid #fff;">
  <tr>
    <td colspan="2"><div class="row displaytab2"  style="color:#FFFFFF;"></div></td>
    <td width="20%" align="center" style="color:#FFFFFF; font-size:16px;">&#8377;<span  id="displaytab2price"></span></td>
  </tr>
  
</table>
	</td>
    <td align="right">
	
	<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center" style="font-size:16px; color:#FFFFFF; font-weight:600; padding-right:20px;">₹<span id="combinetotalprice"></span></td>
    <td align="right">
	<form action="<?php echo $fullurl; ?>flight-review-book" method="get">
	<button type="submit" class="btn btn-danger btn-sm">Book Now</button><input name="i" id="i" type="hidden" value="0"><input name="r" id="r" type="hidden" value="0">
	
	</form></td>
  </tr>
</table>

	</td>
  </tr>
</table>

</div>

</div>

<style>

.displaytab1{color: #FFFFFF; padding: 10px; margin-bottom: 5px;}
.displaytab2{color: #FFFFFF; padding: 10px; margin-bottom: 5px;}
.displaytab1 table tr td{padding-right:10px !important;}
.displaytab2 table tr td{padding-right:10px !important;}
</style>
<?php } ?>

<iframe style="display:none;" src="<?php echo $pagesearch; ?>"></iframe>

<?php include "footerinc.php"; ?>


<?php include "footer.php"; ?>






<script>

setInterval(function() { 
var displaytab1price = Number($('#displaytab1price').text());
var displaytab2price = Number($('#displaytab2price').text());
$('#combinetotalprice').text(Number(displaytab1price+displaytab2price));

var i = Number($('#i').val());
var r = Number($('#r').val());

if(i>0 && r>0){
$('.asp-btm').show();
}

 }, 500);

function getflightSearchCIty(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchflightcitylists.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
}
}


function swapdata(){
var pickupCitySearchfromCity = $('#pickupCitySearchfromCity').val();
var pickupCitySearchfromCity2 = $('#pickupCitySearchfromCity2').val();

var fromDestinationFlight = $('#fromDestinationFlight').val();
var fromDestinationFlight2 = $('#fromDestinationFlight2').val();

$('#pickupCitySearchfromCity').val(pickupCitySearchfromCity2);
$('#pickupCitySearchfromCity2').val(pickupCitySearchfromCity);

$('#fromDestinationFlight2').val(fromDestinationFlight);
$('#fromDestinationFlight').val(fromDestinationFlight2);

}

$(".swapbtn").click(function(){
 $(this).toggleClass("down")  ; 
});





 

$(document).ready(function () {
    $("#dt1").datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0,
        onSelect: function () {
            var dt2 = $('#dt2');
            var startDate = $(this).datepicker('getDate');
            //add 30 days to selected date
            startDate.setDate(startDate.getDate() + 30);
            var minDate = $(this).datepicker('getDate');
            var dt2Date = dt2.datepicker('getDate');
            //difference in days. 86400 seconds in day, 1000 ms in second
            var dateDiff = (dt2Date - minDate)/(86400 * 1000);

            //dt2 not set or dt1 date is greater than dt2 date
            if (dt2Date == null || dateDiff < 0) {
                    dt2.datepicker('setDate', minDate);
            }
            //dt1 date is 30 days under dt2 date
            else if (dateDiff > 30){
                    dt2.datepicker('setDate', startDate);
            }
            //sets dt2 maxDate to the last day of 30 days window
            dt2.datepicker('option', 'maxDate', startDate);
            //first day which can be selected in dt2 is selected date in dt1
            dt2.datepicker('option', 'minDate', minDate);
        }
    });
    $('#dt2').datepicker({
        dateFormat: "dd-mm-yy",
        minDate: 0,onSelect: function () { 
        }
    });
	
});
 
 
 
function changeselectsearchtype(){
var selectsearchtype = Number($('#selectsearchtype').val());
if(selectsearchtype<4){
selecttb(selectsearchtype);
}

if(selectsearchtype==4){ 
$( "#groupenquiryid" ).trigger( "click" );
}
$('#selectsearchtype').val(1);
}








function selecttb(id){
$('#returndiv').show();
$('#searchbuttonflight').show();
$('#submitbuttonflight').hide();
$('#notediv').hide();
$('#formids').removeAttr('target');



if(id==1){
$('#tb2').removeClass('active');
$('#tb3').removeClass('active');
$('#tb4').removeClass('active');
$('#tb1').addClass('active');
$('#tripType').val('1');
$('#dt2').attr('disabled','true');
$('#dt3').attr('disabled','true');
$('#dt2').css('color','#f3f7fa');
$('#fixedDeparture').val('0');
}
if(id==2){
$('#tb1').removeClass('active');
$('#tb3').removeClass('active');
$('#tb4').removeClass('active');
$('#tb2').addClass('active');
$('#tripType').val('2');
$('#dt2').removeAttr('disabled');
$('#dt3').removeAttr('disabled');
$('#dt2').css('color','#333333');
$('#fixedDeparture').val('0');
} 
if(id==3){
/*$('#tb1').removeClass('active');
$('#tb2').removeClass('active');
$('#tb4').removeClass('active');
$('#tb3').addClass('active');
$('#tripType').val('1');
$('#dt2').attr('disabled','true');
$('#dt1').removeAttr('disabled');
$('#dt2').css('color','#fafafa');
$('#fixedDeparture').val('1');*/

$('#tb1').removeClass('active');
$('#tb2').removeClass('active');
$('#tb4').removeClass('active');
$('#tb3').addClass('active');
$('#tripType').val('3');
$('#dt2').removeAttr('disabled');
$('#dt3').removeAttr('disabled');
$('#dt2').css('color','#333333');
$('#fixedDeparture').val('0');



}

if(id==4){
$('#returndiv').hide();
$('#tb1').removeClass('active');
$('#tb2').removeClass('active');
$('#tb3').removeClass('active');
$('#tb4').addClass('active');
$('#formids').attr('target','actoinfrm');
$('#formids').attr('action','actionpage.php');
$('#tripType').val('4');
$('#notediv').show();

$('#searchbuttonflight').hide();
$('#submitbuttonflight').show();
}


}






function findflight(id){
var pickupCitySearchfromCity = $('#pickupCitySearchfromCity').val();
var pickupCitySearchfromCity2 = $('#pickupCitySearchfromCity2').val();

if(pickupCitySearchfromCity==pickupCitySearchfromCity2){
$('#flightdublicate').show();
} else {
$('#flightdublicate').hide();


if(id==1){
$('#formids').submit();
}

}
}


function checkdublicatedestination(){
setTimeout(function() { 
findflight(0);
 }, 500);
}


setTimeout(function() { 
$('#flightloadingbox').hide();
 }, 5000);
 
 
 
 
 


/*$(function() {
    $(window).scroll(function(){
        if($(this).scrollTop() > 100) {
            $('.filtersidebar .card').css('position','fixed');
            $('.filtersidebar .card').css('width','225px');
            $('.filtersidebar .card').css('top','-42px');
        } else {
		  $('.filtersidebar .card').css('position','inherit');
            $('.filtersidebar .card').css('width','225px');
            $('.filtersidebar .card').css('top','0px');
		}
    });
});  */ 
</script>

 
<div style="height:50px;">&nbsp;</div>


</body>
</html>

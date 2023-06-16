<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$page='hotels';
$selectedpage='hotels';

$agentid=$_SESSION['agentUserid']; 

if($_POST['action']=="hotelchoosepost"){
$hotelArr = json_decode($_POST['hotelJsonData']);

$jsonPost = '{
	"id": "'.$hotelArr->id.'"
}';


/*echo '<pre>';
print_r($jsonPost);
echo '</pre>';*/

$url = "".$tripjackhotelurl."hms/v1/hotelDetail-search"; // URL To Hit
$result = getHotelApiData($url,$jsonPost,$hotelApiKey);
$hotelArr = json_decode($result);
$hotelDetail = $hotelArr->hotel;
/*echo '<pre>';
print_r($result);
echo '</pre>';*/

 
}

 

 
$numberOfNights=$_REQUEST['nights'];
$adultCount=$_REQUEST['ad'];
$childCount=$_REQUEST['cd'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title><?php echo stripslashes($hotelDetail->name); ?> - Hotel - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
<?php include "headerinc.php"; ?>

<link rel="stylesheet" href="dist/css/lightbox.min.css">
<style>
body{background-color:#f3f7fa !important;}
</style>
</head>

<body class="greybluebg">

<?php include "header.php"; ?>

 
 <section class="hotelgallery phonehotelgallery">
        <div class="container phonehoteldetailcontainer">
		<div class="hoteldetail">
                <div class="hoteldetailone">
                    <div class="topheading">
                     
                            <h1> <?php echo stripslashes($hotelDetail->name); ?> <span class="starcatht" style="font-size:18px; color:#FF9900;"><?php for($i=1; $i<=$hotelDetail->rt; $i++){ ?>
						 <i class="fa fa-star" aria-hidden="true"></i>
						   <?php } ?></h1>
                        
                         
                    </div>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;
                            <?php echo $hotelDetail->ad->adr; ?>
                            </p>
                     
                </div>
                <div class="hoteldetailtwo">
                    <div class="roompricing">
                        <div style="margin-top: 20px;">
                            <h3><strong id="toppriceht">0</strong></h3>
                            <p>Best Price</p>
                        </div>
                        <a href="#pricelist"><button type="button">Select Room</button></a>
                    </div>
                </div>
            </div>
		
		
		
		<div class="row hoteldetailrow">
                <div class="col-lg-5">
                    <div class="roomoneimg borderleft">
                        <img src="" id="img1"  onerror="imgError(this);" >
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="roomtwoimg">
                       
	
	<img src="" id="img2" onerror="imgError(this);"  > 
	<img src="" id="img3" onerror="imgError(this);"  > 

	
 
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="roomoneimg borderright">
                
	
	<img  id="img4"  src="" onerror="imgError(this);"  > 

	
 
 
 <?php
	 
$n=1;	  
	 foreach ($hotelDetail->img as $value) { 

 
	 ?>  
	<script>
	$('#img<?php echo $n; ?>').attr('src','<?php echo $value->url; ?>');
	</script>
	  <?php $n++; } ?>
                        <div class="camerabox">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                            <p>View All</p>
                        </div>

                    </div>
                </div>
            </div>
			
			
			<div class="card descriptioncard">
                <div class="card-body">
                    <div class="description">
                        <h1>Stay <span>Details</span></h1>
                        <p>
                            <?php echo str_replace('{"General Description":"','',str_replace('"}','',str_replace('{"General":"','',nl2br(stripslashes($hotelDetail->des))))); ?></p>
                    </div>
                    <div class="stayamentites">
                        <h1>Stay <span>Amentities</span></h1>
                        <table>
                            <tbody><tr>
                             
                                <td><i class="fa fa-bed" aria-hidden="true"></i><br><span>Rest</span></td>
                                <td><i class="fa fa-bath" aria-hidden="true"></i><br> <span>Bathroom</span></td>
                               <td><i class="fa fa-cutlery" aria-hidden="true"></i><br><span>Restaurant</span></td>
                                <td><i class="fa fa-wifi" aria-hidden="true"></i><br><span>Wifi</span></td>
        
                                <td><i class="fa fa-beer" aria-hidden="true"></i><br><span>Tea Maker</span></td>
                                <td><i class="fa fa-car" aria-hidden="true"></i><br><span>Parking</span></td>
                                </tr>
                        </tbody></table>
                    </div>
                </div>
            </div>
			
			
			<div class="roomtable" id="pricelist">
                <table class="firstrtable">
                    <tbody><tr>
                        <td>Room</td>
                        <td>Options</td>
                        <td>Guest &amp; Rooms</td>
                        <td>Price</td>
                    </tr>
                </tbody></table>
                <table class="secondrtable">
                    <tbody>
					 <?php  
			$n=1;				
	$roomCount = 1;
	foreach($hotelDetail->ops as $roomList){
	$roomData = $roomList->ris{0};
	 
	$roomCostData = $roomList->ris{7};
	$roomCount++;
	?>
					
					<tr>
                        <td>
                            <div class="Premium">
                                <h1><?=$roomData->rt?></h1>
                                <div class="rebox">
                                    <p style="cursor:pointer;" onclick="loadpop('Cancellation Policy',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=cancellationPolicy&hotelid=<?php echo $hotelDetail->id; ?>&roomid=<?php echo $roomList->id; ?>">Cancellation Policy</p>
                                </div>
                                
                                    
                            </div>
                        </td>
                        <td width="20%" align="left" valign="top" style="padding:10px;"><?php
	 
 $url = ''.$tripjackhotelurl.'hms/v1/hotel-cancellation-policy';
$bookingNumber = $HotelReviewDataArr->bookingId;
$jsonPost = '{
		"id":"'.$hotelDetail->id.'",
		"optionId":"'.$roomList->id.'"
}';
 
   $result = getHotelApiData($url,$jsonPost,$hotelApiKey);
$hotelData = json_decode($result);
 
 $values = $hotelData->cancellationPolicy->pd;
 
 ?>
 
 
  <?php 
  $nkm=0;
   $lastdate='';;
   $getifnonrefund='';
   foreach($values as $hotelList){ 
   
   if($nkm==0){
   $getifnonrefund=$hotelList->am;
   $lastdate=$hotelList->tdt;
   }
  $nkm++;} ?>
 <div class="recomd">
 
    <?php if($getifnonrefund>0){?>
    
   
   <p style="cursor:pointer;"  onclick="loadpop('Cancellation Policy',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=cancellationPolicy&hotelid=<?php echo $hotelDetail->id; ?>&roomid=<?php echo $roomList->id; ?>"><i class="fa fa-times" aria-hidden="true" style="border:1px solid var(--blue);padding: 3px 3.5px;color: var(--blue);border-radius: 50px;"></i>&nbsp;
                                    NON Refundable</p>
   <?php } else { ?>
    
   
   <p style="cursor:pointer; color:#38b911;" onclick="loadpop('Cancellation Policy',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=cancellationPolicy&hotelid=<?php echo $hotelDetail->id; ?>&roomid=<?php echo $roomList->id; ?>"><i class="fa fa-check" aria-hidden="true" style="border:1px solid var(--textgray);padding:  3px;color: var(--textgray);border-radius: 50px;"></i>&nbsp;
                                    Refundable</p>
   
   <div style="margin:5px 0px; font-size:12px; color:#CC3300; ">Free Cancellation Till: <strong><?php echo date('d-m-Y',strtotime($lastdate)); ?></strong></div>
   <?php } ?>
	
	
	<div  style="font-weight: 700; font-size: 12px;">
																 
																<i class="fa fa-check" aria-hidden="true"></i> <?=$roomData->mb?>
																
																						 

  
																																																
 <p class="hotels_amenities moreaminities" style="display: none;"><i class="fa fa-check-circle-o" aria-hidden="true" style="color: #ffc107; margin-right:2px;"></i> Room Mirror</p>
 <p class="hotels_amenities moreaminities"  style="display: none;"><i class="fa fa-check-circle-o" aria-hidden="true" style="color: #ffc107; margin-right:2px;"></i> Washroom Mirror</p>
 <p class="hotels_amenities moreaminities" style="display: none;" ><i class="fa fa-check-circle-o" aria-hidden="true" style="color: #ffc107; margin-right:2px;"></i> Iron Facility</p>																																			
																																																 
																																<p class="hotels_amenities showless" style="padding-left: 15px; cursor: pointer; font-weight: 700; color: rgb(0, 0, 0) !important; display: none;" onClick="$('.moreaminities').hide();$('.loadmore').show();$('.showless').hide();">Less...</p>
		    </div>
			
			</div></td>
                        <td>
                            <div style="font-size:14px; margin-bottom:10px;"><strong><i class="fa fa-building" aria-hidden="true"></i> Rooms <?php echo $_REQUEST['empcount']; ?></strong></div>
	<div style="font-size:14px; margin-bottom:10px;"><strong><i class="fa fa-user" aria-hidden="true"></i> Adults <?php echo $adultCount; ?></strong></div>
	<div style="font-size:14px; margin-bottom:10px;"><strong><i class="fa fa-user-circle" aria-hidden="true"></i> Child <?php echo $childCount; ?></strong></div>
                        </td>
                        <td>
                            <div style="color:#666666;">Total Price</div>
	<div style="font-size:24px; color:#000000; font-weight:700; margin-bottom:5px;">&#8377;<?php $hotelCost=calculatehotelcost(encode($agentid),$hotelDetail->name,round($roomData->tp),'0'); echo $hotelCost[2]; ?>
	 
	 
	 
	 
	 
	 </div>
		<form name="roomfrom" method="post" action="hotel-review?i= " >
	<button type="submit" class="btn btn-danger" style=" font-weight:700px; padding:5px 20px;"   >

                                    <span class="ladda-label" style="color: #fff;">Book Now</span>
                                    <span class="ladda-spinner"></span></button>

									
									 <input type="hidden" name="action" value="roompostaction" />
	<input type="hidden" name="HotelSearchDetails" value="<?php echo htmlentities($_POST['HotelSearchDetails']); ?>" />
	<input type="hidden" name="hotelJsonData" value="<?php echo htmlentities($_POST['hotelJsonData']); ?>" >
	<input type="hidden" name="RoomDetails" value="<?php echo htmlentities(json_encode($roomList,true));  ?>" />
	<input type="hidden" name="hotelName" value="<?php echo $hotelDetail->name;  ?>" />
	<input type="hidden" name="hotelRating" value="<?php echo $hotelDetail->rt;  ?>" />
	<input type="hidden" name="hotelAddress" value="<?php echo $hotelDetail->ad->adr;  ?>" />
	<input type="hidden" name="RoomTypeName" value="<?php echo $roomData->rt;  ?>" />
	<input type="hidden" name="hotelnights" value="<?php echo $numberOfNights;  ?>" />
	<input type="hidden" name="toadult" value="<?php echo $adultCount; ?>" />
	<input type="hidden" name="tochild" value="<?php echo $childCount; ?>" />
	
	<input type="hidden" name="NoOfRooms" id="NoOfRooms" value="<?php echo $_REQUEST['empcount']; ?>" >
		<input type="hidden" name="hotelimg" id="hotelimg" value="<?php echo $firstimage; ?>" >
									<input type="hidden" name="hotelnights" id="hotelnights" value="<?php echo $numberOfNights; ?>" >
									
								</form>									
																	
									
									
									<?php if($n==1){ ?>
									<script>
								  $('#toppriceht').html('&#8377;<?php  echo $hotelCost[2];   ?>');
									</script>
									<?php } ?><table class="hoteltable">
                                
                            </table>
                        </td>
                    </tr>
					
					<?php $n++; } ?>
                </tbody></table>
                 
                
            </div>
		
		
		</div>
		
		</section>


<div class="top_bg_ofr_sb" style="display:none;" >
<div class="container"  style="padding:0px 60px;"> 
<div class="searchtabs">
<a <?php if($_REQUEST['tripType']==1){ ?>class="active"<?php } ?>  id="tb1" onClick="selecttb(1);">One-Way</a>
<a <?php if($_REQUEST['tripType']==2){ ?>class="active"<?php } ?> id="tb2" onClick="selecttb(2);">Round-Trip</a></div>

<div class="searchboxouter">
 <form  method="GET" id="formids" action="<?php echo $fullurl; ?>flight-search" >
                <input type="hidden" name="tripType" id="tripType" value="<?php echo $tripType; ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="20%" align="left" valign="top">  
	<div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity"></div>
	  <input type="text" onClick="$('#pickupCitySearchfromCity').select();" class="textfield" requered="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity','fromDestinationFlight','searchcitylistsfromCity');" id="pickupCitySearchfromCity" name="fromcitydesti" value="<?php echo $fromcitydesti; ?>" autocomplete="off">
	  <input name="fromDestinationFlight" id="fromDestinationFlight" type="hidden" value="<?php echo $fromDestinationFlight; ?>" autocomplete="nope">
	  <div class="swapbtn" onClick="swapdata();"><i class="fa fa-exchange" aria-hidden="true"></i></div>
     </td> 
    <td width="20%" align="left" valign="top" >
	<div style="height:0px; font-size:0px; position:relative; width: 100%; text-align: left;" id="searchcitylistsfromCity2"></div>
	<input type="text" onClick="$('#pickupCitySearchfromCity2').select();" class="textfield" requered="" onKeyUp="getflightSearchCIty('pickupCitySearchfromCity2','fromDestinationFlight2','searchcitylistsfromCity2');" id="pickupCitySearchfromCity2" name="tocitydesti" value="<?php echo $tocitydesti; ?>" autocomplete="off" >
	<input name="toDestinationFlight" id="fromDestinationFlight2" type="hidden" value="<?php echo $toDestinationFlight; ?>" autocomplete="nope">
	</td>
    <td width="12%" align="left" valign="top"><input type="text" id="dt1" name="journeyDateOne" class="textfield"  value="<?php echo trim($journeyDateOne); ?>" autocomplete="off"  ><i class="fa fa-calendar" aria-hidden="true"></i></td>
    <td width="12%" align="left" valign="top"  onclick="selecttb(2);"><input type="text" id="dt2" name="journeyDateRound" class="textfield"  value="<?php echo trim($journeyDateRound); ?>" autocomplete="off" <?php if($tripType==1){ ?>disabled  style="color:#fafafa;" <?php } ?> <?php if($_REQUEST['tripType']==1){ ?>disabled="disabled"<?php } ?>  ><i class="fa fa-calendar" aria-hidden="true"></i></td>
    <td width="24%" align="left" valign="top">
	
	<input type="text" id="travellersshow"  name="travellersshow"  class="textfield"  value="<?php echo trim($travellers); ?>" autocomplete="off" readonly="readonly" onClick="$('#basicDropdownClick').show();"  >
							
							
							  <script>
  $('#basicDropdownClick').click(function(event){
  event.stopPropagation();
});
  </script>
 
 <div id="basicDropdownClick" class="dropdown-menu dropdown-unfold col-11 m-0" aria-labelledby="basicDropdownClickInvoker" style="max-width: 300px; width: 250px;">
                   
					  
					  <div class=" "  style="margin-bottom: 10px;">
					  
					  
					  
                        <div class="js-quantity mx-3 row align-items-center justify-content-between">
						   <div class=" "  style="margin-bottom: 10px; width:100%; position:relative;">
					  <strong>Travellers</strong> <i class="fa fa-times" aria-hidden="true" style="position: absolute; right: 0px; cursor: pointer; top: 4px; font-size: 16px; color: #000;" onClick="$('#basicDropdownClick').hide();"></i>
					  </div>
						
						 <span class="d-block font-size-16 text-secondary font-weight-medium">Adults (12y +)</span>
                          <div class="d-flex">
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
                        <div class="js-quantity mx-3 row align-items-center justify-content-between"> <span class="d-block font-size-16 text-secondary font-weight-medium">Children (2y - 12y )</span>
                          <div class="d-flex">
                            <select id="CHD" name="CHD" class="form-control" onChange="selectpaxs();">
                              <option value="0" <?php echo ($CHD == 0 ? 'selected':''); ?>>0</option>
                              <option value="1" <?php echo ($CHD == 1 ? 'selected':''); ?>>1</option>
                              <option value="2" <?php echo ($CHD == 2 ? 'selected':''); ?>>2</option>
                              <option value="3" <?php echo ($CHD == 3 ? 'selected':''); ?>>3</option>
                              <option value="4" <?php echo ($CHD == 4 ? 'selected':''); ?>>4</option>
                              <option value="5" <?php echo ($CHD == 5 ? 'selected':''); ?>>5</option>
                              <option value="6" <?php echo ($CHD == 6 ? 'selected':''); ?>>6</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="" style="margin-bottom: 10px;">
                        <div class="js-quantity mx-3 row align-items-center justify-content-between"> <span class="d-block font-size-16 text-secondary font-weight-medium">Infants (below 2y)</span>
                          <div class="d-flex">
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
                        <div class="js-quantity mx-3 row align-items-center justify-content-between"> <span class="d-block font-size-16 text-secondary font-weight-medium">Preffered Class</span>
                          <div class="d-flex">
                            <select id="PC" name="PC" class="form-control" onChange="selectpaxs();" > 
                              <option value="EC" <?php if($PC=='EC'){ echo 'selected'; }?>>Economy Class</option>
                              <option value="BU" <?php if($PC=='BU'){ echo 'selected'; }?>>Business Class</option>
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
							
							if(PC=='EC'){
							fPC='Economy';
							}
							if(PC=='BU'){
							fPC='Business';
							}
							if(PC==''){
							fPC='All Class';
							}
							
							$('#travellersshow').val(Number(ADT+CHD+INF)+' Pax, '+fPC); 
							}
							</script>
					  
                       
                       <script>
					   selectpaxs();
					   </script>
                    </div>
	
	</td>
     
    <td width="12%" align="left" valign="top"><input type="submit" name="Submit" value="SEARCH" class="redbuttonsearch"></td>
  </tr>
</table>

<input type="hidden" name="action" value="flightpostaction" >
<input type="hidden" name="changesearch" id="changesearch" value="0" >
</form>

</div>

</div>
</div>

 
 

 

 
 
 
  
<iframe style="display:none;" src="<?php echo $pagesearch; ?>"></iframe>






<?php include "footerinc.php"; ?>
<?php include "footer.php"; ?>


 
 <script src="dist/js/lightbox-plus-jquery.min.js"></script>

 
</body>
</html>

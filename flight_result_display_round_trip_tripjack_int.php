<?php 
include "inc.php"; 
include "config/logincheck.php";
 
?>

<?php if($_REQUEST['undercons']==0){ ?>

<div style="padding:40px; text-align:center;"><img src="images/workingonit.gif" height="199" />
  <h1 style="font-size:40px; margin-bottom:4px;">Under Construction!</h1>
<div style="font-size:14px;">Website is in under construction. For more information please contact to website administrator.</div>
</div>

<?php exit(); } ?>
  
<div class="sortingouter">
<table width="100%" border="0" cellpadding="0" cellspacing="0">



                      <tbody><tr>



                        <td width="16%" align="left" style="cursor:pointer;" onClick="getSortedDeparture();"><strong>Sort By:</strong> </td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedDeparture();">Departure <i class="fa fa-caret-down" id="departurefa" aria-hidden="true" style="display: none;"></i>



                          <input name="departurefilterid" type="hidden" id="departurefilterid" value="1"></td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedDuration();">Duration <i class="fa fa-caret-down" id="durationfa" aria-hidden="true" style="display: none;"></i>



                          <input name="durationfilterid" type="hidden" id="durationfilterid" value="1"></td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedArrival();">Arrival <i class="fa fa-caret-down" id="arrivalfa" aria-hidden="true" style="display: none;"></i>



                          <input name="arrivalfilterid" type="hidden" id="arrivalfilterid" value="1">



                        </td>



                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedPrice();" id="pricefilter">Price <i class="fa fa-caret-up" id="pricefa" aria-hidden="true" style="display: inline-block;"></i>
 
                           <input name="pricefilterid" type="hidden" id="pricefilterid" value="1">



                        </td> 

                      </tr>



                    </tbody></table>
</div>




<?php
$minprice=0;
$mainlistcount=1;
//$a=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" group by FLIGHT_NAME,FLIGHT_NO,DEP_TIME order by AMT asc');
$a=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and uniqueSessionId="'.$_SESSION['uniqueSessionId'].'" and isRoundTripInt=1 group by FLIGHT_NAME,FLIGHT_NO,DEP_TIME  order by AMT asc');
while($res=mysqli_fetch_array($a)){




$deptime= $res['DEP_DATE'].' '.$res['DEP_TIME'];
$deptime=date('hi',strtotime($deptime));

$arrtime= $res['DEP_DATE'].' '.$res['ARRV_TIME'];
$arrtime=date('hi',strtotime($arrtime));
  
preg_match("/([0-9]+)/", $res['DUR'], $matches);

$D_TIME= $res['DEP_TIME'];
$arrtime= $res['ARRV_TIME'];

$dd=unserialize(stripslashes($res['searchJson']));

 $departureDateArr=explode('T',$dd['sI'][0]['dt']);
 $arreDateArr=explode('T',$dd['sI'][0]['at']);
 
 

		 
 $seg=0;

$arrStop=(1);
foreach((array) $dd['sI'] as $layoverFlight){   
		$departStop++; 
		$seg++; 
	}
	
  $seg=$seg-1;
  
  $departStop=0;
  $gotosec=0;
  $departTime=0;
  foreach((array) $dd['sI'] as $layoverFlight){   
  if($layoverFlight['aa']['code']!=$res['DES_CODE']){
  $departStop++;   
  }  else {
 
  break;
  }
  
  } 
 
  
  
  
  
  
  if($departStop>2){
  $departStop=2;
  }
  
  
  $departTime=0;
  $fistrowdep='0';
  $std=0;
  $arrTimemain=0; 
  foreach((array) $dd['sI'] as $layoverFlight){ 
	
	if($fistrowdep==0){  
	$departTime=$departTime+$layoverFlight['duration']+$layoverFlight['cT']; 
	}
  
  if($layoverFlight['aa']['code']==$res['DES_CODE'] && $fistrowdep==0){
   $fistrowdep++;
   $arreDateArrtimeTIME=$arreDateArr=explode('T',$layoverFlight['at']);
   $arreDateArrtimeDATE=$arreDateArr=explode('T',$layoverFlight['at']);
   $arreDateArrtime=$arreDateArrtimeTIME[1];
   $arreDateArrdate=$arreDateArrtimeDATE[0];
   }
   
   if($layoverFlight['aa']['code']!=$res['DES_CODE'] && $fistrowdep>0){ 
   $arreDateArrtimeTIME2=$arreDateArr=explode('T',$layoverFlight['at']);
   $arreDateArrtimeDATE2=$arreDateArr=explode('T',$layoverFlight['at']);
   $arreDateArrtime2=$arreDateArrtimeTIME2[1];
   $arreDateArrdate2=$arreDateArrtimeDATE2[0];
    $arrTimemain=$arrTimemain+$layoverFlight['duration']+$layoverFlight['cT'];
	$arrStop++;
	 
   if($std==0){
   $arreDateArr2=explode('T',$layoverFlight['dt']);
   $starttimesecrow=$arreDateArr2[1];
    $std=1; 
   }
   
   
  
   }
   
    
  
  } 
  
  
  
  if($departTime>0 && $arrTimemain>0){ 	
  
?>

<script>
$('#flightnameid<?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>').show();
</script>


<div id="itemlist<?php echo stripslashes($res['id']); ?>" class="bookrow item itemlist"  data-price="" data-duration="<?php echo trim(round($basefares[1]+$flightprice['agentFixedMakup']));?>" data-depart="<?php echo $deptime; ?>" data-arrive="<?php echo str_replace(':','',$arrtime); ?>" data-category="<?php echo $departStop; ?>stop D<?php if(date('H',strtotime($D_TIME))<12 && date('H',strtotime($D_TIME))>5){ echo '12'; } if(date('H',strtotime($D_TIME))<18 && date('H',strtotime($D_TIME))>12){ echo '18'; }  if(date('H',strtotime($D_TIME))<24 && date('H',strtotime($D_TIME))>18){ echo '1'; }  if(date('H',strtotime($D_TIME))<6 && date('H',strtotime($D_TIME))>0){ echo '6'; }   ?> A<?php if(date('H',strtotime($arrtime))<12 && date('H',strtotime($arrtime))>5){ echo '12'; } if(date('H',strtotime($arrtime))<18 && date('H',strtotime($arrtime))>12){ echo '18'; }  if(date('H',strtotime($arrtime))<24 && date('H',strtotime($arrtime))>18){ echo '1'; }  if(date('H',strtotime($arrtime))<6 && date('H',strtotime($arrtime))>0){ echo '6'; } ?> <?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>">

<div class="card-body">
 

 
<div class="row">
<div class="col-9" style="padding-left: 25px;">

<div class="col-lg-12">
                    <div class="bookdetail">
                      <div class="bookimg">
                        <div class="bkimg">
                          <img src="<?php echo $imgurl.getflightlogo($dd['sI'][0]['fD']['aI']['name']); ?>"  height="32">
                        </div>
                        <h6><?php echo stripslashes($dd['sI'][0]['fD']['aI']['name']); ?> <br><span><?php echo stripslashes($dd['sI'][0]['fD']['aI']['code']); ?>-<?php echo stripslashes($dd['sI'][0]['fD']['fN']); ?></span></h6>
                      </div>
                      <div class="bookboxprice">
                        <h6><?php echo $departureDateArr[1]; ?></h6>
                        <p class="destination"><?php echo stripslashes($res['ORG_CODE']); ?></p>
                   
                      </div>

                      <div class="nonstop">
                        <h4><?php echo intdiv($departTime, 60).'H :'. ($departTime % 60).' M'; ?></h4>
                        <div class="nonstopborder"><i class="fa fa-plane" aria-hidden="true"></i>
                        </div>
                        <span><span style="color:#bf0000 !important; cursor:pointer;"  ><?php if($departStop==0){ ?>Non Stop<?php } else { echo $departStop; ?> Stop<?php } ?> </span></span>
							<div class="stoptooltip" id="stoptooltip2693"></div>
                      </div>
                      <div class="bookboxprice">
                        <h6><?php echo $arreDateArrtime; ?>
						
						<?php 
	
	$now = strtotime(date('Y-m-d',strtotime($arreDateArrdate))); // or your date as well
$your_date = strtotime(date('Y-m-d',strtotime($departureDateArr[0])));
$datediff = $now - $your_date;

$plusdays=round($datediff / (60 * 60 * 24));

if($plusdays>0){
?>
<span style="color:#CC3300; font-size:11px; display: block;">+<?php echo $plusdays; ?> Day(s)</span>
 
<?php } ?>
 
</h6>
                        <p class="destination"><?php echo stripslashes($res['DES_CODE']); ?></p> 
                      </div>
                    </div>
           
                    <div class="bookmsg"> 
                       
				 
                    </div>
                    <div class="refundtable" style="margin-top: 8px; margin-bottom: 10px; padding: 5px; border: 1px dashed #ddd; background-color: #cccccc26;">
                      <table>
                        <tbody><tr>
                          <td><i class="fa fa-credit-card-alt" aria-hidden="true"></i> <span class="green"><?php if($dd['totalPriceList'][0]['fd']['ADULT']['rT']=='1'){ echo '<span class="refundablespan">Refundable</span>'; } else { echo '<span class="nonrefundablespan">Non Refundable</span>'; } ?></span>&nbsp;&nbsp;&nbsp;</td>

                          <td><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            <span class="red"> <?php echo stripslashes($dd['totalPriceList'][0]['fd']['ADULT']['sR']);  ?> Seat Left </span>                          </td>
                           
                          <td><div class="blackbox">
                      
						     <h5 style="cursor:pointer;" onclick="loadpop('Flight Details (<?php echo stripslashes($res['FLIGHT_NAME']); ?>  - <?php echo stripslashes($res['FLIGHT_CODE']); ?>-<?php echo stripslashes($res['FLIGHT_NO']); ?>)',this,'800px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=showflightdetails&id=<?php echo $res['id']; ?>"><i class="fa fa-info-circle" aria-hidden="true" ></i> Flight Detail</h5>
						</div></td> 
                        </tr>
                      </tbody></table>
                    </div>
                  </div>

  
 <!-- -----------------------Return---------------------->
  
  
 <div class="col-lg-12">
                    <div class="bookdetail">
                      <div class="bookimg">
                        <div class="bkimg">
                          <img src="<?php echo $imgurl.getflightlogo($dd['sI'][$seg]['fD']['aI']['name']); ?>"   height="32">
                        </div>
                        <h6><?php echo stripslashes($dd['sI'][$seg]['fD']['aI']['name']); ?> <br><span><?php echo stripslashes($dd['sI'][$seg]['fD']['aI']['code']); ?>-<?php echo stripslashes($dd['sI'][$seg]['fD']['fN']); ?></span></h6>
                      </div>
                      <div class="bookboxprice">
                        <h6><?php echo $starttimesecrow; ?></h6>
                        <p class="destination"><?php echo stripslashes($res['DES_CODE']); ?></p>
                   
                      </div>

                      <div class="nonstop">
                        <h4><?php echo intdiv($arrTimemain, 60).'H :'. ($arrTimemain % 60).' M'; ?></h4>
                        <div class="nonstopborder"><i class="fa fa-plane" aria-hidden="true"></i>
                        </div>
                        <span><span style="color:#bf0000 !important; cursor:pointer;"  ><?php if($arrStop==0){ ?>Non Stop<?php } else { echo $arrStop; ?> Stop<?php } ?> </span></span>
							<div class="stoptooltip" id="stoptooltip2693"></div>
                      </div>
                      <div class="bookboxprice">
                        <h6><?php echo $arreDateArrtime2; ?>
						
						<?php 
	
	$now = strtotime(date('Y-m-d',strtotime($arreDateArrdate2))); // or your date as well
$your_date = strtotime(date('Y-m-d',strtotime($arreDateArr2[0])));
$datediff = $now - $your_date;

$plusdays=round($datediff / (60 * 60 * 24));

if($plusdays>0){
?>
<span style="color:#CC3300; font-size:11px; display: block;">+<?php echo $plusdays; ?> Day(s)</span>
 
<?php } ?>
 
</h6>
                        <p class="destination"><?php echo stripslashes($res['ORG_CODE']); ?></p> 
                      </div>
                    </div>
           
                    <div class="bookmsg"> 
                       
				 
                    </div>
                     
                  </div>

 </div>

 


 
<?php if($ns>2){ ?>
<div class="morefrebtnouter">
<a class="morefrebt" id="morefrebt<?php echo stripslashes($res['id']); ?>" onclick="showratetablebox('<?php echo stripslashes($res['id']); ?>');">+ More Fare</a>
</div>
<?php } ?>

<script>
var colorattr = $('#itemlist<?php echo stripslashes($res['id']); ?>').attr('data-category');
$('#itemlist<?php echo stripslashes($res['id']); ?>').attr('data-category','<?php echo $farecolor; ?>'+colorattr)
</script>

<div class="col-3" style="    padding-right: 25px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="pricelisttable">
 <?php
 $flightpricelastid=0;
$ns=1;
$farecolor='';
$b=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and id="'.$res['id'].'" and isRoundTripInt=1 and FLIGHT_NAME="'.$res['FLIGHT_NAME'].'" and FLIGHT_NO="'.$res['FLIGHT_NO'].'" and DEP_TIME="'.$res['DEP_TIME'].'"  order by AMT asc');
while($flightprice=mysqli_fetch_array($b)){ 

 

$str_arr = explode (",", $flightprice['agfare']);  
	$basefares = explode ("=", $str_arr[2]);
	
	$durationHourMinstR=0;
	$segR=unserialize(stripslashes($res['roundIntInboundJson']));
	//$segR = $valArray['Segments'][1];
		unset($inbound);
		foreach($segR as $segmentR)
		{
			$inbound[] = $segmentR;		
		}
	
	$ibound=$inbound[0];

	$NoOfSeatAvailableR = $ibound['NoOfSeatAvailable']; 
    $BaggageR = $ibound['Baggage'];
    $CabinBaggageR = $ibound['CabinBaggage'];
    $airlineR = $ibound['Airline']['AirlineName'];
	$haveAirlineR = $airlinecodeR = $ibound['Airline']['AirlineCode'];
	$airlinenumR = $airlinecodeR."-".$ibound['Airline']['FlightNumber']." ".$ibound['Airline']['FareClass'];    
	$deptimeR = $ibound['Origin']['DepTime'];
	$depcityR = $ibound['Origin']['Airport']['CityName'].", ".$ibound['Origin']['Airport']['CountryName']."(".$ibound['Origin']['Airport']['AirportCode'].")";
	$deptitleR = $ibound['Origin']['Airport']['AirportName']." Airport";     
	$stopcityR = $ibound['Origin']['Airport']['CityName'];
	$confltR = $airlinecodeR."-".$ibound['Airline']['FlightNumber'];
	//$dep_codeR= $ibound['Origin']['Airport']['AirportCode']." ".$stopcityR;
	$dep_codeR= $ibound['Origin']['Airport']['AirportCode'];
	$durationR= $ibound['Duration'];

	
	
	$ibound2=$inbound[count($inbound)-1];
	
	$desitnationstopcityR = $ibound2['Destination']['Airport']['CityName'];
	//$destination_codeR= $ibound['Destination']['Airport']['AirportCode']." ".$desitnationstopcityR;
	$destination_codeR= $ibound2['Destination']['Airport']['AirportCode'];
	$destinationTimeR = $ibound2['Destination']['ArrTime'];
	
	$NoOfSeatAvailableR=$ibound['NoOfSeatAvailable'];
	
		################### TIME CALCULATION #####################

		$msdate1= $destinationTimeR;
		$msdate1= explode('T',$msdate1); 
		$msdateaxp1= $msdate1['0'].' '.$msdate1['1']; 
		
		$msdate2= $deptimeR;
		$msdate2= explode('T',$msdate2); 
		$msdateaxp2= $msdate2['0'].' '.$msdate2['1']; 
		$seconds = strtotime($msdateaxp1) - strtotime($msdateaxp2);
		$hoursR   = floor($seconds / 3600); 
		$minR = floor(($seconds - ($hoursR * 3600))/60); 
		
		$durationHourMinstR= $hoursR."H ".$minR."M";

		################### TIME CALCULATION #####################



//echo '<pre>';print nl2br(print_r($inbound, true));echo '</pre>'; exit;



$flight_segR= count($inbound);
$flight_segmentR = $flight_segR - 1;
	
?>

<?php 
if($ns==1){
$flightpricelastid=$flightprice['id'];
}


if($ns==1 && $mainlistcount==1){



  $minprice=$basefares[1];
  
  }


if($ns==1 ){ 

 ?>

<script>
$('#seatleft<?php echo stripslashes($res['id']); ?>').text('<?php echo stripslashes($flightprice['SEAT']); ?>');
$('#itemlist<?php echo stripslashes($res['id']); ?>').attr('data-price','<?php echo $basefares[1]; ?>');
</script>
<?php } 

 $maxprice=$basefares[1];
?>
 
  <tr>
    <td align="left" valign="top" style="text-align: center; font-weight: 700; border: 0px;"><span class="mainprice" style="font-size:22px;">&#8377;<?php echo $totalfare=round($basefares[1]+$flightprice['agentFixedMakup']); ?></span> <div style="line-height: 0px;"><span class="netpriceshow" style="  width:100%; color:#009933;">&#8377; <?php
	
		$totaltdsdisplay=0;
	$totaltdsdisplay=round($flightprice['acom']*5/100);
	$sellingfare=0;
	 echo $sellingfare=($flightprice['netFareBeforecomm']+$totaltdsdisplay); ?> - <span >Earn. &#8377;<?php

	
	 echo round($totalfare-$sellingfare); ?></span></span></div>	</td>
    </tr>
  <tr>
     <td><a id="booknowlink<?php echo stripslashes($res['id']); ?>" href="<?php echo $fullurl; ?>flight-review-book?i=<?php echo encode($flightpricelastid); ?>"><button type="button" class="btn btn-danger" style="width:100%; margin-top:15px;">Book Now</button></a></td>
    </tr>
  <?php 
  
  $farecolor.=' '.str_replace('#','',getfaretypedisplaycolor(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC']))).' ';
  ?>
  <script>
  $('.filter-<?php echo str_replace('#','',getfaretypedisplaycolor(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC']))); ?>').show();
  </script>
  <?php
  $ns++; } ?>
</table>
</div>


 

</div>

 

<?php
//echo "<pre>";
//print_r($inbound);
 
 ?>

</div>




</div>

<?php $mainlistcount++; } } ?>


<script>
function flightdetailsbox(id,secid,tabid){ 

if(tabid==4){
$('#flightdetails'+id).html('Loading...');
}

var secid = $('input[name="flightprice'+id+'"]:checked').val();
$('#flightdetails'+id).load('flightdetailsbox.php?id='+secid+'&mainid='+id+'&tabid='+tabid);
 
}

function hidedetailbtn(id){

var blk = $('#flightdetails'+id).css('display');

if(blk=='block'){
$('#viewdetailbtn'+id).text('Show Details');
$('#flightdetails'+id).hide();
} else {
$('#viewdetailbtn'+id).text('Hide Details');
$('#flightdetails'+id).show();
}

}


function hideallfilterarrow(){
$('#departurefa').hide();
$('#durationfa').hide();
$('#arrivalfa').hide();
$('#pricefa').hide();
$('#departurefaReturn').hide();
$('#durationfaReturn').hide();
$('#arrivalfaReturn').hide();
$('#pricefaReturn').hide();
}




function getSortedPrice(){

var pricefilterid = $('#pricefilterid').val();
var $wrap = $('.listouter');
hideallfilterarrow(); 
$('#pricefa').show();$wrap.find('.item').sort(function(a, b) 
{if(pricefilterid==1){$('#pricefilterid').val('0'); 
$('#pricefa').removeClass('fa-caret-down');
$('#pricefa').addClass('fa-caret-up');return + a.getAttribute('data-price') - 
+b.getAttribute('data-price'); 
}else{$('#pricefilterid').val('1'); 
$('#pricefa').removeClass('fa-caret-up');
$('#pricefa').addClass('fa-caret-down');return + b.getAttribute('data-price') - 
+a.getAttribute('data-price');
}})
.appendTo($wrap); 
}
 getSortedPrice();
 
function getSortedArrival() 
{
var pricefilterid = $('#arrivalfilterid').val();
var $wrap = $('.listouter');
hideallfilterarrow(); 
$('#arrivalfa').show(); $wrap.find('.item').sort(function(a, b) 
{if(pricefilterid==1){$('#arrivalfilterid').val('0'); 
$('#arrivalfa').removeClass('fa-caret-down');
$('#arrivalfa').addClass('fa-caret-up');return + a.getAttribute('data-arrive') - 
+b.getAttribute('data-arrive'); } else {$('#arrivalfilterid').val('1'); 
$('#arrivalfa').removeClass('fa-caret-up');
$('#arrivalfa').addClass('fa-caret-down');return + b.getAttribute('data-arrive') - 
+a.getAttribute('data-arrive');
}})
.appendTo($wrap); 
} 
function getSortedDeparture() 
{
var pricefilterid = $('#departurefilterid').val();
var $wrap = $('.listouter');
hideallfilterarrow();
$('#departurefa').show(); $wrap.find('.item').sort(function(a, b) 
{if(pricefilterid==1){$('#departurefilterid').val('0'); 
$('#departurefa').removeClass('fa-caret-down');
$('#departurefa').addClass('fa-caret-up');return + a.getAttribute('data-depart') - 
+b.getAttribute('data-depart'); } else {$('#departurefilterid').val('1'); 
$('#departurefa').removeClass('fa-caret-up');
$('#departurefa').addClass('fa-caret-down');return + b.getAttribute('data-depart') - 
+a.getAttribute('data-depart');
}})
.appendTo($wrap); 
} 
function getSortedDuration() 
{
var pricefilterid = $('#durationfilterid').val();
var $wrap = $('.listouter');
hideallfilterarrow(); 
$('#durationfa').show(); $wrap.find('.item').sort(function(a, b) 
{if(pricefilterid==1){$('#durationfilterid').val('0'); 
$('#durationfa').removeClass('fa-caret-down');
$('#durationfa').addClass('fa-caret-up');return + a.getAttribute('data-duration') - 
+b.getAttribute('data-duration'); } else {$('#durationfilterid').val('1'); 
$('#durationfa').removeClass('fa-caret-up');
$('#durationfa').addClass('fa-caret-down');return + b.getAttribute('data-duration') - 
+a.getAttribute('data-duration');
}})
.appendTo($wrap); 
}









var $filterCheckboxes = $('#allFilterDiv input[type="checkbox"]');
$filterCheckboxes.on('change', function() {
  var selectedFilters = {};
  $filterCheckboxes.filter(':checked').each(function() {
    if (!selectedFilters.hasOwnProperty(this.name)) {

      selectedFilters[this.name] = [];

    }
    selectedFilters[this.name].push(this.value);
  });
  // create a collection containing all of the filterable elements

  var $filteredResults = $('.itemlist');
  // loop over the selected filter name -> (array) values pairs

  $.each(selectedFilters, function(name, filterValues) {
    // filter each .flower element

    $filteredResults = $filteredResults.filter(function() {
      var matched = false,

        currentFilterValues = $(this).data('category').split(' ');
      // loop over each category value in the current .flower's data-category

      $.each(currentFilterValues, function(_, currentFilterValue) {
        // if the current category exists in the selected filters array

        // set matched to true, and stop looping. as we're ORing in each

        // set of filters, we only need to match once
        if ($.inArray(currentFilterValue, filterValues) != -1) {

          matched = true;

          return false;

        }

      });
      // if matched is true the current .flower element is returned

      return matched;
    });

  });
  $('.itemlist').hide().filter($filteredResults).show();
});

</script>













	<script>
					$(function() {

					var maxprice = Number($('#maxprice').val()); 

					var minprice = Number($('#minprice').val());

						$( "#slider-ranges" ).slider({
						  range: true,
						  min: minprice,
						  max: maxprice,
						  values: [ minprice, maxprice ],
						  slide: function( event, ui ) {
							$( "#amountfilter" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
							
							showProducts(ui.values[ 0 ], ui.values[ 1 ]);
						  }
						});
						$( "#amountfilter" ).val( "" + $( "#slider-ranges" ).slider( "values", 0 ) +
						  " - " + $( "#slider-ranges" ).slider( "values", 1 ) );
						  
					});

					function showProducts(minPrice, maxPrice) {
					  $(".item").hide().filter(function() {
						var price = parseInt($(this).data("price"), 10);
						return price >= minPrice && price <= maxPrice;
					  }).show();
					}

					</script>
					
					<input name="maxprice" id="maxprice" type="hidden" value="<?php echo $maxprice; ?>">
					<input name="minprice" id="minprice" type="hidden" value="<?php echo $minprice; ?>">
					
					
					
					
					
					
	<script>
function showratetablebox(id){
var morefrebt = $('#morefrebt'+id).text();
if(morefrebt=='+ More Fare'){
$('#ratetablebox'+id).css('height','auto');
$('#morefrebt'+id).text('- Less Fare');
} else { 
$('#ratetablebox'+id).css('height','52px');
$('#morefrebt'+id).text('+ More Fare');
}
}
</script>

<script>
<?php
$a=GetPageRecord('*','sys_flightName','1 order by name asc');
while($res=mysqli_fetch_array($a)){

$ab=GetPageRecord('id','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and FLIGHT_NAME="'.stripslashes($res['name']).'"    group by FLIGHT_NO order by AMT asc');
$flight=mysqli_num_rows($ab);

$abc=GetPageRecord('FLIGHT_NO,DEP_TIME,FLIGHT_CODE','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and FLIGHT_NAME="'.stripslashes($res['name']).'"    group by FLIGHT_NO order by AMT asc');
$resf=mysqli_fetch_array($abc);

$b=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'"  and FLIGHT_NO="'.$resf['FLIGHT_NO'].'" and DEP_TIME="'.$resf['DEP_TIME'].'" and FLIGHT_CODE="'.$resf['FLIGHT_CODE'].'" group by PCC  order by AMT asc  ');
$flightprice=mysqli_fetch_array($b);

$str_arr = explode (",", $flightprice['agfare']);  

	$basefares = explode ("=", $str_arr[2]);

?>
$('.totalflight<?php echo stripslashes($res['id']); ?>').html('(<?php echo stripslashes($flight); ?>)<span>&#8377;<?php echo round($basefares[1]+$flightprice['agentFixedMakup']); ?></span>');
 
 <?php } ?>
 
 </script>
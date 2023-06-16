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



<style>

.sharefooterbox{width:430px; position:fixed; right:0px; bottom:0px; background-color:#FFFFFF; z-index:999; box-shadow: 0px 0px 100px #000000a1; border-radius: 10px; overflow:hidden; padding:15px; font-size:13px; display:none;}

.sharefooterbox .heading { font-size: 15px; margin-bottom: 10px; font-weight: 600; background-color: #eee; padding: 5px 10px; position: relative; border-radius: 4px; }

.sharefooterbox span { position: absolute; right: 16px; font-size: 12px; top:5px; }

.sharefooterbox .loadshareflightbox{max-height:400px; overflow:auto;}



.sharechek{font-size:12px;line-height: 21px;padding-top: 0px;display: inline-block;padding-left: 18px;position: absolute; right:0px; top:10px;}

.sharechek .sck{width: 14px !important;height: 16px !important;position: absolute !important;left: 0px !important;}

.ymessage{margin: 0px !important; font-size: 11px; float: left; width: 100%; padding: 0px; margin-top: 2px !important;}

</style>

<div class="nav hotel-pills mb-3" >

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

$a=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and uniqueSessionId="'.$_SESSION['uniqueSessionId'].'" group by FLIGHT_NO,FLIGHT_CODE order by AMT asc');

while($res=mysqli_fetch_array($a)){


$b=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'"  and FLIGHT_NO="'.$res['FLIGHT_NO'].'" and DEP_TIME="'.$res['DEP_TIME'].'" and FLIGHT_CODE="'.$res['FLIGHT_CODE'].'" group by PCC  order by AMT asc  ');
$flightprice=mysqli_fetch_array($b);

$str_arr = explode (",", $flightprice['agfare']);  

	$basefares = explode ("=", $str_arr[2]);


$deptime= $res['DEP_DATE'].' '.$res['DEP_TIME'];

$deptime=date('hi',strtotime($deptime));



$arrtime= $res['DEP_DATE'].' '.$res['ARRV_TIME'];

$arrtime=date('hi',strtotime($arrtime));

  

preg_match("/([0-9]+)/", $res['DUR'], $matches);



$D_TIME= $res['DEP_TIME'];

$arrtime= $res['ARRV_TIME'];

$DEP_DATE=$res['DEP_DATE'];

$ARRV_DATE=$res['ARRV_DATE'];


if($ns==1 && $mainlistcount==1){ 

  $minprice=$basefares[1]; 
  }
  
   $maxprice=$basefares[1];
?>



<script>

$('#flightnameid<?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>').show();

</script>



<script>

$('#seatleft<?php echo stripslashes($res['id']); ?>').text('<?php echo stripslashes($flightprice['SEAT']); ?>');

$('#itemlist<?php echo stripslashes($res['id']); ?>').attr('data-price','<?php echo $basefares[1]; ?>');

</script>


<div id="itemlist<?php echo stripslashes($res['id']); ?>" class="bookrow item itemlist"  data-price="" data-duration="<?php echo trim($matches[1]);?>" data-depart="<?php echo $deptime; ?>" data-arrive="<?php echo str_replace(':','',$arrtime); ?>" data-category="<?php echo $res['STOP']; ?>stop D<?php if(date('H',strtotime($D_TIME))<12 && date('H',strtotime($D_TIME))>5){ echo '12'; } if(date('H',strtotime($D_TIME))<18 && date('H',strtotime($D_TIME))>12){ echo '18'; }  if(date('H',strtotime($D_TIME))<24 && date('H',strtotime($D_TIME))>18){ echo '1'; }  if(date('H',strtotime($D_TIME))<6 && date('H',strtotime($D_TIME))>0){ echo '6'; }   ?> A<?php if(date('H',strtotime($arrtime))<12 && date('H',strtotime($arrtime))>5){ echo '12'; } if(date('H',strtotime($arrtime))<18 && date('H',strtotime($arrtime))>12){ echo '18'; }  if(date('H',strtotime($arrtime))<24 && date('H',strtotime($arrtime))>18){ echo '1'; }  if(date('H',strtotime($arrtime))<6 && date('H',strtotime($arrtime))>0){ echo '6'; } ?> <?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>">
<div class="row" style="padding: 0px 12px;">
<div class="col-lg-9">
                    <div class="bookdetail">
                      <div class="bookimg">
                        <div class="bkimg">
                          <img src="<?php echo $imgurl.getflightlogo(stripslashes($res['FLIGHT_NAME'])); ?>" alt="">
                        </div>
                        <h6><?php echo stripslashes($res['FLIGHT_NAME']); ?> <br><span><?php echo stripslashes($res['FLIGHT_CODE']); ?>-<?php echo stripslashes($res['FLIGHT_NO']); ?></span></h6>
                      </div>
                      <div class="bookboxprice">
                        <h6><?php echo stripslashes($res['DEP_TIME']); ?></h6>
                        <p class="destination"><?php echo stripslashes($res['ORG_CODE']); ?></p>
                   
                      </div>

                      <div class="nonstop">
                        <h4><?php echo $res['DUR']; ?></h4>
                        <div class="nonstopborder"><i class="fa fa-plane" aria-hidden="true"></i>
                        </div>
                        <span><?php if($flightprice['STOP']==0){ ?>Non Stop<?php  }else{ ?><span style="color:#bf0000 !important; cursor:pointer;" id="hoverstop<?php echo $res['id']; ?>" onmouseout="$('.stoptooltip').hide();" onmouseover="showtooltip(<?php echo $res['id']; ?>);" ><?php echo $flightprice['STOP'].' Stop '; ?></span><?php } ?></span>
							<div class="stoptooltip" id="stoptooltip<?php echo $res['id']; ?>" ></div>
                      </div>
                      <div class="bookboxprice">
                        <h6><?php echo stripslashes($res['ARRV_TIME']); ?><?php 
	
	$now = strtotime(date('Y-m-d',strtotime($res['ARRV_DATE']))); // or your date as well
$your_date = strtotime(date('Y-m-d',strtotime($res['DEP_DATE'])));
$datediff = $now - $your_date;

$plusdays=round($datediff / (60 * 60 * 24));

if($plusdays>0){
?>
<span style="color:#CC3300; font-size:11px; display: block;">+<?php echo $plusdays; ?> Day(s)</span>
 
<?php } ?></h6>
                        <p class="destination"><?php echo stripslashes($res['DES_CODE']); ?></p> 
                      </div>
                    </div>
           
                    <div class="bookmsg"> 
                      <?php if(stripslashes(getfaretypedetails(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC'])))!=''){?><p><?php echo stripslashes(getfaretypedetails(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC']))); ?></p><?php } ?> 
				 
                    </div>
                    <div class="refundtable">
                      <table>
                        <tbody><tr>
                          <td><i class="fa fa-credit-card-alt" aria-hidden="true"></i> <span class="green"><?php if($flightprice['refundyes']=='1'){ echo '<span class="refundablespan">Refundable</span>'; } else { echo '<span class="nonrefundablespan">Non Refundable</span>'; } ?></span>&nbsp;&nbsp;&nbsp;</td>

                          <td><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            <span class="red"> <?php echo stripslashes($flightprice['SEAT']); ?> Seat Left </span>                          </td>
                           
                          <td><div class="blackbox">
                      
						     <h5><i class="fa fa-list" aria-hidden="true"></i> <?php echo $_SESSION['PC'];  ?></h5>
						</div></td> 
                        </tr>
                      </tbody></table>
                    </div>
                  </div>
				  
				  <div class="col-lg-3">
                    <div class="bookbtn">
                      <h4>&#8377;<?php echo $basefares[1]+$flightprice['agentFixedMakup']; ?></h4> </div>
					
                     <a id="booknowlink<?php echo stripslashes($res['id']); ?>" onclick="loadmoreflight('<?php echo stripslashes($res['id']); ?>','<?php echo $res['FLIGHT_NO']; ?>','<?php echo $res['DEP_TIME']; ?>','<?php echo $res['FLIGHT_CODE']; ?>');" style="cursor:pointer;"><button type="button" class="btn btn-danger" style="width:100%;"  >Select <i class="fa fa-angle-down" aria-hidden="true"></i></button></a> 
                    </div>
					</div>
					
<div class="loadmoreprice" id="moreflight<?php echo stripslashes($res['id']); ?>" style="display:none;"></div> 

 

</div>



<?php $mainlistcount++; } ?>





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

					

					

					

					
<div id="shareMail" style="display:none;"></div>
					

					

	<script>

function showratetablebox(id){

var morefrebt = $('#morefrebt'+id).text();

if(morefrebt=='+ More Fare'){

$('#ratetablebox'+id).css('height','auto');

$('#morefrebt'+id).text('- Less Fare');

} else { 

$('#ratetablebox'+id).css('height','50px');

$('#morefrebt'+id).text('+ More Fare');

}

}



function scbfun(){ 
var checkedValue = null; 
 

var totalval='';

var checkedValue = null; 
var inputElements = document.getElementsByClassName('sck');
for(var i=0; inputElements[i]; ++i){ 
      if(inputElements[i].checked){
	  totalval+=checkedValue = inputElements[i].value+',';
	  }
	  
	  }

if(totalval!=''){
$('#loadshareflightbox').load('loadshareflightbox.php?checkval='+totalval);
$('.sharefooterbox').show();
} else {
$('.sharefooterbox').hide();
}

 

}

 
 


    function PrintElem(elem)

    {
        //Popup($(elem).html());
                    var range = document.createRange();
                    range.selectNode(document.getElementById(elem));
                    window.getSelection().removeAllRanges(); // clear current selection
                    window.getSelection().addRange(range); // to select text
                    document.execCommand("copy");
                    window.getSelection().removeAllRanges();// to deselect
    alert('Copied...');
		

    }
	
	function shareEmail(elem){
		
	// If you want to store the data in another HTML element
     $( "#shareMail" ).html( $( "#"+elem ).html() );

     // If you want to store the data in a js var
     myVar = $( "#shareMail" ).html();
		
	//var divData=$("#"+elem).html();	
	window.open('shareFlightDetailsOnMail.php?data='+encodeURI(myVar), 'new div', 'height=400,width=600');
	
    }
	
	function shareWhatsApp(elem){
		
		// If you want to store the data in another HTML element
     $( "#shareMail" ).html( $( ".finalsharewhatsapp").html() ); 

     // If you want to store the data in a js var
     myVar = $( "#shareMail" ).text();
	 
		//myVar = '';
	//var divData=$("#"+elem).html();	
	//window.open('shareFlightDetailsOnMail.php?data='+encodeURI(myVar), 'new div', 'height=400,width=600');
	
	window.open('https://api.whatsapp.com/send?phone=&text='+encodeURI($( ".finalsharewhatsapp").text()),'_blank');

	
    }



    function Popup(data)

    {

        var mywindow = window.open('', 'new div', 'height=400,width=600');

        mywindow.document.write('<html><head><title>Download</title>');

        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');

        mywindow.document.write('<style>@media print { .hidelogos {display:none;} h2{ margin-bottom:0px; padding-bottom:0px;}</style></head><body >');

        mywindow.document.write('<h2><?php echo stripslashes($LoginUserDetails['companyName']); ?></h2>Phone: <?php echo stripslashes($LoginUserDetails['countryCode']); ?><?php echo stripslashes($LoginUserDetails['phone']); ?><br>Email: <?php echo stripslashes($LoginUserDetails['email']); ?></br>Address: <?php echo stripslashes($LoginUserDetails['address']); ?><hr></br>'+data);

        mywindow.document.write('</body></html>');



        mywindow.print();

        mywindow.close();



        return true;

    }



</script>



<div class="sharefooterbox">

<div class="heading">Share Flights <span onclick="$('.sck').prop('checked', false);$('.loadshareflightbox').html('');$('.sharefooterbox').hide();" style="cursor:pointer;">X</span></div>

<div class="loadshareflightbox" id="loadshareflightbox">

</div>

<!--
<button type="button" class="btn btn-danger" style="width:100%;" onclick="PrintElem('#loadshareflightbox');">Download</button>
-->

<button type="button" class="btn btn-danger" style="width:28%;" onclick="PrintElem('loadshareflightbox');">Copy</button>

<button type="button" class="btn btn-success" style="width:30%;" onclick="shareWhatsApp('loadshareflightbox');">WhatsApp</button>

<button type="button" class="btn btn-primary" style="width:28%;" onclick="shareEmail('loadshareflightbox');">Email</button>

</div>


<script>
function showtooltip(id){
$('#stoptooltip'+id).show();
$('#stoptooltip'+id).load('websiteloadpopup.php?action=stoptooltip&id='+id);
}

function loadmoreflight(id,FLIGHT_NO,DEP_TIME,FLIGHT_CODE){

var dd=$('#moreflight'+id).css('display');
var FLIGHT_NO = encodeURI(FLIGHT_NO);
var DEP_TIME = encodeURI(DEP_TIME);
var FLIGHT_CODE = encodeURI(FLIGHT_CODE);

if(dd=='block'){
$('#moreflight'+id).hide();
$('#booknowlink'+id+' i').addClass('fa-angle-down');
$('#booknowlink'+id+' i').removeClass('fa-angle-up');
} else {
$('#moreflight'+id).show();
$('#booknowlink'+id+' i').addClass('fa-angle-up');
$('#booknowlink'+id+' i').removeClass('fa-angle-down');
$('#moreflight'+id).load('loadmoreflight.php?FLIGHT_NO='+FLIGHT_NO+'&DEP_TIME='+DEP_TIME+'&FLIGHT_CODE='+FLIGHT_CODE);
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
$('.totalflight<?php echo stripslashes($res['id']); ?>').html('(<?php echo stripslashes($flight); ?>)<span>&#8377;<?php echo $basefares[1]+$flightprice['agentFixedMakup']; ?></span>');
 
 <?php } ?>
 
 </script>
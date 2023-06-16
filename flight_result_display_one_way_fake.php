<?php 
include "inc.php"; 
include "config/logincheck.php";
$a=GetPageRecord('*','flightSearchLog',' 1 order by id desc');
$reslast=mysqli_fetch_array($a);
?>

<?php if($_REQUEST['undercons']==0){ ?>

<div style="padding:40px; text-align:center;"><img src="images/workingonit.gif" height="199" />
  <h1 style="font-size:40px; margin-bottom:4px;">Under Construction!</h1>
<div style="font-size:14px;">Website is in under construction. For more information please contact to website administrator.</div>
</div>

<?php exit(); } ?>



<div id="itemlist<?php echo stripslashes($res['id']); ?>" class="bookrow item itemlist"  data-price="" data-duration="<?php echo trim($matches[1]);?>" data-depart="<?php echo $deptime; ?>" data-arrive="<?php echo str_replace(':','',$arrtime); ?>" data-category="<?php echo $res['STOP']; ?>stop D<?php if(date('H',strtotime($D_TIME))<12 && date('H',strtotime($D_TIME))>5){ echo '12'; } if(date('H',strtotime($D_TIME))<18 && date('H',strtotime($D_TIME))>12){ echo '18'; }  if(date('H',strtotime($D_TIME))<24 && date('H',strtotime($D_TIME))>18){ echo '1'; }  if(date('H',strtotime($D_TIME))<6 && date('H',strtotime($D_TIME))>0){ echo '6'; }   ?> A<?php if(date('H',strtotime($arrtime))<12 && date('H',strtotime($arrtime))>5){ echo '12'; } if(date('H',strtotime($arrtime))<18 && date('H',strtotime($arrtime))>12){ echo '18'; }  if(date('H',strtotime($arrtime))<24 && date('H',strtotime($arrtime))>18){ echo '1'; }  if(date('H',strtotime($arrtime))<6 && date('H',strtotime($arrtime))>0){ echo '6'; } ?> <?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>">
<div class="row" style="padding: 0px 12px;">
<div class="card-body flightloadingshadow">

<div class="row">

<div class="col-1">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:20px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-8">
<div class="shbox6"></div>
<div class="shbox7"></div> 
<div class="shbox6"></div> 
 

</div>

<div class="col-2">
<div class="shbox8" style="margin-right:20px;"></div>
</div>


 

</div>

</div>
					</div>
					
<div class="loadmoreprice" id="moreflight<?php echo stripslashes($res['id']); ?>" style="display:none;"></div> 

 

</div>
<div id="itemlist<?php echo stripslashes($res['id']); ?>" class="bookrow item itemlist"  data-price="" data-duration="<?php echo trim($matches[1]);?>" data-depart="<?php echo $deptime; ?>" data-arrive="<?php echo str_replace(':','',$arrtime); ?>" data-category="<?php echo $res['STOP']; ?>stop D<?php if(date('H',strtotime($D_TIME))<12 && date('H',strtotime($D_TIME))>5){ echo '12'; } if(date('H',strtotime($D_TIME))<18 && date('H',strtotime($D_TIME))>12){ echo '18'; }  if(date('H',strtotime($D_TIME))<24 && date('H',strtotime($D_TIME))>18){ echo '1'; }  if(date('H',strtotime($D_TIME))<6 && date('H',strtotime($D_TIME))>0){ echo '6'; }   ?> A<?php if(date('H',strtotime($arrtime))<12 && date('H',strtotime($arrtime))>5){ echo '12'; } if(date('H',strtotime($arrtime))<18 && date('H',strtotime($arrtime))>12){ echo '18'; }  if(date('H',strtotime($arrtime))<24 && date('H',strtotime($arrtime))>18){ echo '1'; }  if(date('H',strtotime($arrtime))<6 && date('H',strtotime($arrtime))>0){ echo '6'; } ?> <?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>">
<div class="row" style="padding: 0px 12px;">
<div class="card-body flightloadingshadow">

<div class="row">

<div class="col-1">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:20px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-8">
<div class="shbox6"></div>
<div class="shbox7"></div> 
<div class="shbox6"></div> 
 

</div>

<div class="col-2">
<div class="shbox8" style="margin-right:20px;"></div>
</div>


 

</div>

</div>
					</div>
					
<div class="loadmoreprice" id="moreflight<?php echo stripslashes($res['id']); ?>" style="display:none;"></div> 

 

</div>
<div id="itemlist<?php echo stripslashes($res['id']); ?>" class="bookrow item itemlist"  data-price="" data-duration="<?php echo trim($matches[1]);?>" data-depart="<?php echo $deptime; ?>" data-arrive="<?php echo str_replace(':','',$arrtime); ?>" data-category="<?php echo $res['STOP']; ?>stop D<?php if(date('H',strtotime($D_TIME))<12 && date('H',strtotime($D_TIME))>5){ echo '12'; } if(date('H',strtotime($D_TIME))<18 && date('H',strtotime($D_TIME))>12){ echo '18'; }  if(date('H',strtotime($D_TIME))<24 && date('H',strtotime($D_TIME))>18){ echo '1'; }  if(date('H',strtotime($D_TIME))<6 && date('H',strtotime($D_TIME))>0){ echo '6'; }   ?> A<?php if(date('H',strtotime($arrtime))<12 && date('H',strtotime($arrtime))>5){ echo '12'; } if(date('H',strtotime($arrtime))<18 && date('H',strtotime($arrtime))>12){ echo '18'; }  if(date('H',strtotime($arrtime))<24 && date('H',strtotime($arrtime))>18){ echo '1'; }  if(date('H',strtotime($arrtime))<6 && date('H',strtotime($arrtime))>0){ echo '6'; } ?> <?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>">
<div class="row" style="padding: 0px 12px;">
<div class="card-body flightloadingshadow">

<div class="row">

<div class="col-1">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:20px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-8">
<div class="shbox6"></div>
<div class="shbox7"></div> 
<div class="shbox6"></div> 
 

</div>

<div class="col-2">
<div class="shbox8" style="margin-right:20px;"></div>
</div>


 

</div>

</div>
					</div>
					
<div class="loadmoreprice" id="moreflight<?php echo stripslashes($res['id']); ?>" style="display:none;"></div> 

 

</div>
<div id="itemlist<?php echo stripslashes($res['id']); ?>" class="bookrow item itemlist"  data-price="" data-duration="<?php echo trim($matches[1]);?>" data-depart="<?php echo $deptime; ?>" data-arrive="<?php echo str_replace(':','',$arrtime); ?>" data-category="<?php echo $res['STOP']; ?>stop D<?php if(date('H',strtotime($D_TIME))<12 && date('H',strtotime($D_TIME))>5){ echo '12'; } if(date('H',strtotime($D_TIME))<18 && date('H',strtotime($D_TIME))>12){ echo '18'; }  if(date('H',strtotime($D_TIME))<24 && date('H',strtotime($D_TIME))>18){ echo '1'; }  if(date('H',strtotime($D_TIME))<6 && date('H',strtotime($D_TIME))>0){ echo '6'; }   ?> A<?php if(date('H',strtotime($arrtime))<12 && date('H',strtotime($arrtime))>5){ echo '12'; } if(date('H',strtotime($arrtime))<18 && date('H',strtotime($arrtime))>12){ echo '18'; }  if(date('H',strtotime($arrtime))<24 && date('H',strtotime($arrtime))>18){ echo '1'; }  if(date('H',strtotime($arrtime))<6 && date('H',strtotime($arrtime))>0){ echo '6'; } ?> <?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>">
<div class="row" style="padding: 0px 12px;">
<div class="card-body flightloadingshadow">

<div class="row">

<div class="col-1">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:20px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-8">
<div class="shbox6"></div>
<div class="shbox7"></div> 
<div class="shbox6"></div> 
 

</div>

<div class="col-2">
<div class="shbox8" style="margin-right:20px;"></div>
</div>


 

</div>

</div>
					</div>
					
<div class="loadmoreprice" id="moreflight<?php echo stripslashes($res['id']); ?>" style="display:none;"></div> 

 

</div>
<div id="itemlist<?php echo stripslashes($res['id']); ?>" class="bookrow item itemlist"  data-price="" data-duration="<?php echo trim($matches[1]);?>" data-depart="<?php echo $deptime; ?>" data-arrive="<?php echo str_replace(':','',$arrtime); ?>" data-category="<?php echo $res['STOP']; ?>stop D<?php if(date('H',strtotime($D_TIME))<12 && date('H',strtotime($D_TIME))>5){ echo '12'; } if(date('H',strtotime($D_TIME))<18 && date('H',strtotime($D_TIME))>12){ echo '18'; }  if(date('H',strtotime($D_TIME))<24 && date('H',strtotime($D_TIME))>18){ echo '1'; }  if(date('H',strtotime($D_TIME))<6 && date('H',strtotime($D_TIME))>0){ echo '6'; }   ?> A<?php if(date('H',strtotime($arrtime))<12 && date('H',strtotime($arrtime))>5){ echo '12'; } if(date('H',strtotime($arrtime))<18 && date('H',strtotime($arrtime))>12){ echo '18'; }  if(date('H',strtotime($arrtime))<24 && date('H',strtotime($arrtime))>18){ echo '1'; }  if(date('H',strtotime($arrtime))<6 && date('H',strtotime($arrtime))>0){ echo '6'; } ?> <?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>">
<div class="row" style="padding: 0px 12px;">
<div class="card-body flightloadingshadow">

<div class="row">

<div class="col-1">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:20px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-8">
<div class="shbox6"></div>
<div class="shbox7"></div> 
<div class="shbox6"></div> 
 

</div>

<div class="col-2">
<div class="shbox8" style="margin-right:20px;"></div>
</div>


 

</div>

</div>
					</div>
					
<div class="loadmoreprice" id="moreflight<?php echo stripslashes($res['id']); ?>" style="display:none;"></div> 

 

</div>
<div id="itemlist<?php echo stripslashes($res['id']); ?>" class="bookrow item itemlist"  data-price="" data-duration="<?php echo trim($matches[1]);?>" data-depart="<?php echo $deptime; ?>" data-arrive="<?php echo str_replace(':','',$arrtime); ?>" data-category="<?php echo $res['STOP']; ?>stop D<?php if(date('H',strtotime($D_TIME))<12 && date('H',strtotime($D_TIME))>5){ echo '12'; } if(date('H',strtotime($D_TIME))<18 && date('H',strtotime($D_TIME))>12){ echo '18'; }  if(date('H',strtotime($D_TIME))<24 && date('H',strtotime($D_TIME))>18){ echo '1'; }  if(date('H',strtotime($D_TIME))<6 && date('H',strtotime($D_TIME))>0){ echo '6'; }   ?> A<?php if(date('H',strtotime($arrtime))<12 && date('H',strtotime($arrtime))>5){ echo '12'; } if(date('H',strtotime($arrtime))<18 && date('H',strtotime($arrtime))>12){ echo '18'; }  if(date('H',strtotime($arrtime))<24 && date('H',strtotime($arrtime))>18){ echo '1'; }  if(date('H',strtotime($arrtime))<6 && date('H',strtotime($arrtime))>0){ echo '6'; } ?> <?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>">
<div class="row" style="padding: 0px 12px;">
<div class="card-body flightloadingshadow">

<div class="row">

<div class="col-1">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:20px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-8">
<div class="shbox6"></div>
<div class="shbox7"></div> 
<div class="shbox6"></div> 
 

</div>

<div class="col-2">
<div class="shbox8" style="margin-right:20px;"></div>
</div>


 

</div>

</div>
					</div>
					
<div class="loadmoreprice" id="moreflight<?php echo stripslashes($res['id']); ?>" style="display:none;"></div> 

 

</div>
<div id="itemlist<?php echo stripslashes($res['id']); ?>" class="bookrow item itemlist"  data-price="" data-duration="<?php echo trim($matches[1]);?>" data-depart="<?php echo $deptime; ?>" data-arrive="<?php echo str_replace(':','',$arrtime); ?>" data-category="<?php echo $res['STOP']; ?>stop D<?php if(date('H',strtotime($D_TIME))<12 && date('H',strtotime($D_TIME))>5){ echo '12'; } if(date('H',strtotime($D_TIME))<18 && date('H',strtotime($D_TIME))>12){ echo '18'; }  if(date('H',strtotime($D_TIME))<24 && date('H',strtotime($D_TIME))>18){ echo '1'; }  if(date('H',strtotime($D_TIME))<6 && date('H',strtotime($D_TIME))>0){ echo '6'; }   ?> A<?php if(date('H',strtotime($arrtime))<12 && date('H',strtotime($arrtime))>5){ echo '12'; } if(date('H',strtotime($arrtime))<18 && date('H',strtotime($arrtime))>12){ echo '18'; }  if(date('H',strtotime($arrtime))<24 && date('H',strtotime($arrtime))>18){ echo '1'; }  if(date('H',strtotime($arrtime))<6 && date('H',strtotime($arrtime))>0){ echo '6'; } ?> <?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>">
<div class="row" style="padding: 0px 12px;">
<div class="card-body flightloadingshadow">

<div class="row">

<div class="col-1">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:20px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-8">
<div class="shbox6"></div>
<div class="shbox7"></div> 
<div class="shbox6"></div> 
 

</div>

<div class="col-2">
<div class="shbox8" style="margin-right:20px;"></div>
</div>


 

</div>

</div>
					</div>
					
<div class="loadmoreprice" id="moreflight<?php echo stripslashes($res['id']); ?>" style="display:none;"></div> 

 

</div>
<div id="itemlist<?php echo stripslashes($res['id']); ?>" class="bookrow item itemlist"  data-price="" data-duration="<?php echo trim($matches[1]);?>" data-depart="<?php echo $deptime; ?>" data-arrive="<?php echo str_replace(':','',$arrtime); ?>" data-category="<?php echo $res['STOP']; ?>stop D<?php if(date('H',strtotime($D_TIME))<12 && date('H',strtotime($D_TIME))>5){ echo '12'; } if(date('H',strtotime($D_TIME))<18 && date('H',strtotime($D_TIME))>12){ echo '18'; }  if(date('H',strtotime($D_TIME))<24 && date('H',strtotime($D_TIME))>18){ echo '1'; }  if(date('H',strtotime($D_TIME))<6 && date('H',strtotime($D_TIME))>0){ echo '6'; }   ?> A<?php if(date('H',strtotime($arrtime))<12 && date('H',strtotime($arrtime))>5){ echo '12'; } if(date('H',strtotime($arrtime))<18 && date('H',strtotime($arrtime))>12){ echo '18'; }  if(date('H',strtotime($arrtime))<24 && date('H',strtotime($arrtime))>18){ echo '1'; }  if(date('H',strtotime($arrtime))<6 && date('H',strtotime($arrtime))>0){ echo '6'; } ?> <?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>">
<div class="row" style="padding: 0px 12px;">
<div class="card-body flightloadingshadow">

<div class="row">

<div class="col-1">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:20px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-8">
<div class="shbox6"></div>
<div class="shbox7"></div> 
<div class="shbox6"></div> 
 

</div>

<div class="col-2">
<div class="shbox8" style="margin-right:20px;"></div>
</div>


 

</div>

</div>
					</div>
					
<div class="loadmoreprice" id="moreflight<?php echo stripslashes($res['id']); ?>" style="display:none;"></div> 

 

</div>











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
$('#ratetablebox'+id).css('height','80px');
$('#morefrebt'+id).text('+ More Fare');
}
}

function scbfun(){
 
var checkedValue = null; 
var inputElements = document.getElementsByClassName('sck');

setTimeout( function(){  
$('.loadshareflightbox').html('');  
var k=0;
for(var i=0; inputElements[i]; ++i){

      if(inputElements[i].checked){
	  
	  k=1;
           checkedValue = inputElements[i].value;
		   var flightlogo = $('#flightlogo'+checkedValue).attr('src');
		  var sharecontent = '<table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td colspan="2" align="left" valign="top" class="hidelogos"><img src="'+flightlogo+'" style="width:50px; height:50px;" /></td><td width="90%" align="left" valign="top"><strong>'+$('#flightname'+checkedValue).html()+' - '+$('#flightcode'+checkedValue).html()+'</strong><br />'+$('#deptext'+checkedValue).html()+' - '+$('#aritext'+checkedValue).html()+'<br />('+$('#diptime'+checkedValue).html()+', <?php echo date('j F Y',strtotime($DEP_DATE)); ?> - '+$('#aritime'+checkedValue).html()+', <?php echo date('j F Y',strtotime($ARRV_DATE)); ?>)<br />Duration: '+$('#dur'+checkedValue).html()+' ('+$('#stops'+checkedValue).text()+')<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td colspan="2" valign="bottom"><div style="width:70px;">Price - Rs.</div></td><td width="90%" valign="bottom"><div  contenteditable="true" style="width: 100%; border-bottom: 1px solid #ddd; height: 28px; line-height: 35px; font-weight: 600;"></div></td></tr><tr><td colspan="2" valign="bottom" style="padding-right:5px;">Description: </td><td valign="bottom"><div  contenteditable="true" style="width: 100%; border-bottom: 1px solid #ddd; height: 28px; line-height: 35px; font-weight: 600;"></div></td></tr></table></td></tr></table><hr />';  
		   
		   
		 $('.loadshareflightbox').append(sharecontent);  
		   
         
      }
}

if($('#loadshareflightbox').text()!=""){
$('.sharefooterbox').show();
} else  {
$('.sharefooterbox').hide();
}

  }  , 500 );




}
 

    function PrintElem(elem)
    {
        Popup($(elem).html());
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
<div class="heading">Share Flights <span onclick="$('.sck').prop('checked', false);$('.loadshareflightbox').html('');$('.sharefooterbox').hide();" style="cursor:pointer;">Reset</span></div>
<div class="loadshareflightbox" id="loadshareflightbox">
</div>
<img src="images/loading.gif" style="width:32px;" />
</div>


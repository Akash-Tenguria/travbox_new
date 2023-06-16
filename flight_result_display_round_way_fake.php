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



<style>
.sharefooterbox{width:430px; position:fixed; right:0px; bottom:0px; background-color:#FFFFFF; z-index:999; box-shadow: 0px 0px 100px #000000a1; border-radius: 10px; overflow:hidden; padding:15px; font-size:13px; display:none;}
.sharefooterbox .heading { font-size: 15px; margin-bottom: 10px; font-weight: 600; background-color: #eee; padding: 5px 10px; position: relative; border-radius: 4px; }
.sharefooterbox span { position: absolute; right: 16px; font-size: 12px; top:5px; }
.sharefooterbox .loadshareflightbox{max-height:400px; overflow:auto;}

.sharechek{font-size:12px;line-height: 21px;padding-top: 0px;display: inline-block;padding-left: 18px;position: absolute; right:0px; top:10px;}
.sharechek .sck{width: 14px !important;height: 16px !important;position: absolute !important;left: 0px !important;}
.ymessage{margin: 0px !important; font-size: 11px; float: left; width: 100%; padding: 0px; margin-top: 2px !important;}
</style>
 
<div class="row roundtripbox" style="margin-bottom:70px;">

<div class="col-6 listouter">

 

<div id="itemlist<?php echo stripslashes($res['id']); ?>" class="bookrow item itemlist"  data-price="" data-duration="<?php echo trim($matches[1]);?>" data-depart="<?php echo $deptime; ?>" data-arrive="<?php echo str_replace(':','',$arrtime); ?>" data-category="<?php echo $res['STOP']; ?>stop D<?php if(date('H',strtotime($D_TIME))<12 && date('H',strtotime($D_TIME))>5){ echo '12'; } if(date('H',strtotime($D_TIME))<18 && date('H',strtotime($D_TIME))>12){ echo '18'; }  if(date('H',strtotime($D_TIME))<24 && date('H',strtotime($D_TIME))>18){ echo '1'; }  if(date('H',strtotime($D_TIME))<6 && date('H',strtotime($D_TIME))>0){ echo '6'; }   ?> A<?php if(date('H',strtotime($arrtime))<12 && date('H',strtotime($arrtime))>5){ echo '12'; } if(date('H',strtotime($arrtime))<18 && date('H',strtotime($arrtime))>12){ echo '18'; }  if(date('H',strtotime($arrtime))<24 && date('H',strtotime($arrtime))>18){ echo '1'; }  if(date('H',strtotime($arrtime))<6 && date('H',strtotime($arrtime))>0){ echo '6'; } ?> <?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>">
<div class="row" style="padding: 0px 12px;">
<div class="card-body flightloadingshadow">

<div class="row">

<div class="col-2">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:0px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-7">
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

<div class="col-2">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:0px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-7">
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

<div class="col-2">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:0px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-7">
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

<div class="col-2">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:0px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-7">
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

<div class="col-2">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:0px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-7">
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

<div class="col-2">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:0px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-7">
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

<div class="col-2">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:0px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-7">
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

<div class="col-2">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:0px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-7">
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








 
 

 
</div>

<div class="col-6 listouter">

 

<div id="itemlist<?php echo stripslashes($res['id']); ?>" class="bookrow item itemlist"  data-price="" data-duration="<?php echo trim($matches[1]);?>" data-depart="<?php echo $deptime; ?>" data-arrive="<?php echo str_replace(':','',$arrtime); ?>" data-category="<?php echo $res['STOP']; ?>stop D<?php if(date('H',strtotime($D_TIME))<12 && date('H',strtotime($D_TIME))>5){ echo '12'; } if(date('H',strtotime($D_TIME))<18 && date('H',strtotime($D_TIME))>12){ echo '18'; }  if(date('H',strtotime($D_TIME))<24 && date('H',strtotime($D_TIME))>18){ echo '1'; }  if(date('H',strtotime($D_TIME))<6 && date('H',strtotime($D_TIME))>0){ echo '6'; }   ?> A<?php if(date('H',strtotime($arrtime))<12 && date('H',strtotime($arrtime))>5){ echo '12'; } if(date('H',strtotime($arrtime))<18 && date('H',strtotime($arrtime))>12){ echo '18'; }  if(date('H',strtotime($arrtime))<24 && date('H',strtotime($arrtime))>18){ echo '1'; }  if(date('H',strtotime($arrtime))<6 && date('H',strtotime($arrtime))>0){ echo '6'; } ?> <?php echo str_replace(' ','-',stripslashes($res['FLIGHT_NAME'])); ?>">
<div class="row" style="padding: 0px 12px;">
<div class="card-body flightloadingshadow">

<div class="row">

<div class="col-2">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:0px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-7">
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

<div class="col-2">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:0px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-7">
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

<div class="col-2">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:0px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-7">
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

<div class="col-2">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:0px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-7">
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

<div class="col-2">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:0px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-7">
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

<div class="col-2">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:0px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-7">
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

<div class="col-2">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:0px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-7">
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

<div class="col-2">

<div class="row">
<div class="col-12">
  <div class="shbox1" style="width: 40px; height:40px; margin-left:0px;"></div> 

</div>

 
</div> 


  
 
 
 
 
</div>


<div class="col-7">
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








 
 

 
</div>


</div>

<?php
include "inc.php";
?> 
<?php

 $flightpricelastid=0;

$ns=1;

$farecolor='';

$b=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'"  and FLIGHT_NO="'.$_REQUEST['FLIGHT_NO'].'" and DEP_TIME="'.$_REQUEST['DEP_TIME'].'" and FLIGHT_CODE="'.$_REQUEST['FLIGHT_CODE'].'" group by PCC  order by AMT asc  ');

while($flightprice=mysqli_fetch_array($b)){  
$str_arr = explode (",", $flightprice['agfare']);  

	$basefares = explode ("=", $str_arr[2]);
	$bagg=explode (",", $flightprice['FLIGHT_INFO']);
 $iB=$bagg[1];
 $cB=$bagg[0];
	
 
//print_r(unserialize(stripslashes($flightprice['searchJson'])));
 
?>

<div class="pricelistflight">
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="20%"><div class="flhead">Type</div><div class="flhtext"><span class="green"><?php if($flightprice['refundyes']=='1'){ echo '<span class="refundablespan">Refundable</span>'; } else { echo '<span class="nonrefundablespan">Non Refundable</span>'; } ?></span></div></td>
 <td width="20%"><div class="flhead">Fare Type </div>
   <div class="flhtext"><div class="blackbox" style="margin-left:0px;">
                        <?php if(getfaretypedisplayname(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC']))!=''){?><div class="blackbg"  style="background-color:<?php echo getfaretypedisplaycolor(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC'])); ?>; color:#FFFFFF;"><?php echo getfaretypedisplayname(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC'])); ?></div><?php }  else { ?>
						<div class="blackbg"><?php echo $flightprice['PCC']; ?></div>
						<?php } ?></div></div></td>
 <td width="15%"><div class="flhtext" style="line-height: 18px; color: #393939; text-transform: uppercase; font-size: 11px !important;"><i class="fa fa-suitcase" aria-hidden="true"></i> <?php echo $iB; ?><br />
<i class="fa fa-briefcase" aria-hidden="true"></i> <?php echo $cB; ?></div> <div class="bookmsg"> 
                      <?php if(stripslashes(getfaretypedetails(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC'])))!=''){?><p><?php echo stripslashes(getfaretypedetails(stripslashes($flightprice['FLIGHT_NAME']),stripslashes($flightprice['PCC']))); ?></p><?php } ?> 
				 
      </div></td>
 <td align="center"><?php if($flightprice['apiType']!='AK'){?><i class="fa fa-info-circle" aria-hidden="true" onclick="loadpop('Flight Details (<?php echo stripslashes($res['FLIGHT_NAME']); ?>  - <?php echo stripslashes($res['FLIGHT_CODE']); ?>-<?php echo stripslashes($res['FLIGHT_NO']); ?>)',this,'400px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=changepassword"></i><?php } ?></td>
 
 
 <td width="20%" align="center" style="font-size:20px; font-weight:800;">&#8377; <?php echo $basefares[1]+$flightprice['agentFixedMakup']; ?> 
	<div style="line-height: 0px;"><span class="netpriceshow" style="  width:100%; color:#009933;">&#8377; <?php
	
		$totaltdsdisplay=0;
	$totaltdsdisplay=round($flightprice['acom']*5/100);
	
	 echo ($flightprice['netFareBeforecomm']+$totaltdsdisplay); ?> - <span >Earn. &#8377;<?php

	
	 echo $flightprice['acom']; ?></span></span></div></td>
 <td width="20%" align="right"><a  href="<?php echo $fullurl; ?>flight-review-book?i=<?php echo encode($flightprice['id']); ?>">
   <button type="button" class="btn btn-danger buttonbook"  onclick="$(this).css('background-color','#ddd');$(this).css('border','1px solid #ddd');$(this).text('Wait Please...');$(this).css('color','#000');">Book Now</button></a></td>
  </tr>
</table>

</div> 

<?php } ?>
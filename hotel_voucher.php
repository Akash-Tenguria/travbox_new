<?php  
if($_REQUEST['mail']!=''){
include "config/database.php";
include "config/function.php";
include "config/setting.php";
 }
$rs=GetPageRecord('*','hotelBookingMaster','id="'.decode($_REQUEST['id']).'" '); 
$editresult=mysqli_fetch_array($rs);   

$detailArray = json_decode(stripslashes(unserialize($editresult['detailArray'])));
 
$urs=GetPageRecord('*','sys_userMaster','  id in (select parentId from sys_userMaster where id="'.$editresult['agentId'].'")'); 
$agentData=mysqli_fetch_array($urs); 
?>

<div id="DivIdToPrint">
<style>
@media print {
table tr td { font-family:Arial, Helvetica, sans-serif;  font-size:13px; }
}
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="5" style=" ">
  <tr>
    <td width="50%" align="left" valign="top" style="border-bottom:1px solid #ddd;"><img src="<?php echo $imgurl; ?><?php echo $agentData['companyLogo']; ?>" height="55">dd</td>
    <td width="50%" style="border-bottom:1px solid #ddd;">
		<strong><?php echo stripslashes($agentData['companyName']); ?></strong> <br> 
		<strong>Phone:</strong> <?php echo stripslashes($agentData['phone']); ?><br>
		<strong>Email:</strong> <?php echo stripslashes($agentData['email']); ?><br>
		<strong>Address:</strong> <?php echo stripslashes($agentData['address']); ?> 
</td>
  </tr>
  <tr>
    <td width="50%" style="border-bottom:1px solid #ddd;"><div style=" font-weight:600; color:#60B12E;">Vouchered</div><br />Booking 
      ID : <?php echo str_replace('TJS','',$editresult['BookingNumber']); ?>, #<?php echo encode($editresult['id']); ?> </td>
    <td width="50%" style="border-bottom:1px solid #ddd;">Confirmation No.: <?php echo ($editresult['confirmationNo']); ?><br />
Confirmed By: <?php echo ($editresult['confirmedBy']); ?></td>
  </tr>
  <tr>
    <td width="50%"><?php echo stripslashes($editresult['HotelName']); ?> <?php for($i=1; $i<=$editresult['Rating']; $i++){ ?>
						  						 <i class="fa fa-star" aria-hidden="true" style="font-size:12px;color: #ff8100;"></i>
												 <?php } ?> <br />
  <?php echo stripslashes($editresult['Address']); ?></td>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td colspan="4" bgcolor="#BBE8F7"  ><strong><?php echo stripslashes($editresult['RoomType']); ?></strong></td>
        </tr>
      <tr>
        <td width="25%" bgcolor="#D3F0FA" style="background-color:#D3F0FA;">Check In<br />
          <strong><?php echo date('d/m/Y', strtotime($editresult['CheckIn'])); ?></strong></td>
        <td width="25%" bgcolor="#E4F7FC" style="background-color:#D3F0FA;">Check Out<br />
          <strong><?php echo date('d/m/Y', strtotime($editresult['CheckOutDate'])); ?></strong></td>
        <td width="25%" bgcolor="#D3F0FA" style="background-color:#D3F0FA;">Total Rooms<br />
          <strong><?php echo stripslashes($editresult['TotalRoom']); ?></strong></td>
        <td width="25%" bgcolor="#D3F0FA" style="background-color:#D3F0FA;">Total stay<br />
          <strong><?php $start_ts = strtotime($editresult['CheckIn']); 
$end_ts = strtotime($editresult['CheckOutDate']); 
$diff = $end_ts - $start_ts; 
$totNights = round($diff / 86400); if($totNights==0){ echo '1'; }else{ echo $totNights; } ?> Night(s)</strong></td>
      </tr>
    </table></td>
    </tr>
	<?php 
		$rs6=GetPageRecord('*','hotelBookingPaxDetailMaster',' bookingTableId="'.$editresult['id'].'" and firstName!="" '); 
		while($paxData=mysqli_fetch_array($rs6)){
	  ?>
  <tr>
    <td width="50%" style="border-bottom:1px solid #ddd;">Apartment <br />
      Name : <?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?> (<?php echo ucfirst($paxData['paxType']); ?>)</td>
    <td width="50%" align="center" style="border-bottom:1px solid #ddd;">&nbsp; </td>
  </tr>
  <?php } ?>
  <tr>
    <td width="50%" style="border-bottom:1px solid #ddd;"><strong>Contact Details</strong> <br />
 Email : <?php echo stripslashes($agentData['email']); ?> <br />
 Mobile : <?php echo stripslashes($agentData['phone']); ?></td>
    <td width="50%" style="border-bottom:1px solid #ddd;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" style="border-bottom:1px solid #ddd;"><strong>Cancellation Policy</strong><br />
	<?php
	 
	
	
	$hotelid=$detailArray->hInfo->id;
$roomid=$detailArray->hInfo->ops{0}->id;
/*if($_REQUEST['typ']=='manual'){

$rs=GetPageRecord('*','sys_HotelRoomTypeCost',' id="'.decode($_REQUEST['hotelid']).'" order by id desc');
$hotelPrice=mysqli_fetch_array($rs);
 
} */
$jsonPost = '{
		"id":"'.$hotelid.'",
		"optionId":"'.$roomid.'"
}';

$url = "https://apitest.tripjack.com/hms/v1/hotel-cancellation-policy"; // URL To Hit
$result = getHotelApiData($url,$jsonPost,$hotelApiKey);
$roomPolicy = json_decode($result);
	 ?>
<table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#ddd">
  <tr>
    <td align="center" bgcolor="#E9E9E9" style="background-color:#E9E9E9;"><strong>Cancellation on or After</strong></td>
    <td align="center" bgcolor="#E9E9E9" style="background-color:#E9E9E9;"><strong>Cancellation on or Before</strong></td>
    <td align="center" bgcolor="#E9E9E9" style="background-color:#E9E9E9;"><strong>Cancellation Charges/Comments</strong></td>
  </tr>
  <?php foreach($roomPolicy->cancellationPolicy->pd as $policyDetails){ ?>
  <tr>
    <td width="32%" align="center"><?php echo date('d-M-Y H:iA',strtotime($policyDetails->fdt)); ?></td>
    <td width="32%" align="center"><?php echo date('d-M-Y H:iA',strtotime($policyDetails->tdt)); ?></td>
    <td width="32%" align="center">&#8377;<?php echo $policyDetails->am; ?></td>
  </tr>
  <?php } ?>
</table></td>
    </tr>
  <tr>
    <td colspan="2" style="border-bottom:1px solid #ddd;"><strong>Booking Notes</strong><br />
<?php echo $detailArray->hInfo->ops{0}->inst{0}->msg; ?></td>
    </tr>
  <tr>
    <td colspan="2" style="border-bottom:1px solid #ddd;"><strong>General Terms &amp; Conditions</strong><br />
1. Each country/state may have its own set of COVID-19 guidelines and restrictions. Please check with the
hotel or visit the country's/state's website for the same.<br />
2. Your booking is confirmed. However, your name will be listed in the hotel's reservation system closer to
your arrival date.<br />
3. Guest Photo Id must be presented at the time of check-in.<br />
4. Credit card or cash deposit may be required for extra services at the time of check-in.<br />
5. All extra charges will be borne by the guest directly prior to departure.<br />
6. In case of the guest arrival delayed or postponed due to any unforeseen occurrences, additional charges
will be borne by the guest.<br />
7. In case of incorrect residency and nationality chosen by the user at the time of booking, additional
charges may be applicable which will be borne by the guest and paid to the hotel at the time of checkin/check-out.<br />
8. Any special requests are all subject to availability at the time of check-in and are not guaranteed at the
time of booking (bed type, smoking room, early check-in, late check-out etc.).<br />
9. Full cancellation charges are applicable on early check-out unless otherwise specified.<br />
10. Hotels do not permit unmarried or unrelated couples and it is at the hotel management's discretion to
allow or cancel the booking. In such case no refund is applicable if the hotel disallows check-in.<br />
11. City tax and resort fee (if any) are to be paid directly to the hotel.<br />
12. If your booking offers complimentary car transfer you need to inform the hotel of your travel details 24
hours prior to check-in.<br />
13. Additional GST Payment (if any) to be paid to the hotel directly by the guest.<br /></td>
    </tr>
	<?php if($_REQUEST['ta']!=2){ ?>
  <tr>
    <td width="50%"><strong>FARE SUMMARY</strong></td>
    <td width="50%" align="right">&nbsp;</td>
  </tr>
  
  <tr>
    <td style="border-bottom:1px solid #ddd;">Total Amount</td>
    <td align="right" style="border-bottom:1px solid #ddd;">&#8377;<Span id="displayhotelprice"><?php echo round($editresult['agentTotalFare']-$editresult['agentMarukup']); ?></Span><input  type="hidden" id="totalpricehotel" value="<?php echo round($editresult['agentTotalFare']-$editresult['agentMarukup']); ?>" /></td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
</table>

</div>
 <?php if($_REQUEST['sm']==''){ ?>
<div style="text-align: right; width: 100%;"><button type="button" class="btn btn-secondary btn-sm" onclick='printDiv();'>Print / Download</button></div>
<?php } ?>
<script>
function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint'); 
  var newWin=window.open('','Print-Window'); 
  newWin.document.open(); 
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>'); 
  newWin.document.close(); 

}
</script>
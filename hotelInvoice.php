<?php 
include "inc.php";  
$_SESSION['agentUserid']=$_REQUEST['ag'];
 
if($_REQUEST['id']!=''){
$a=GetPageRecord('*','hotelBookingMaster',' id="'.decode($_REQUEST['id']).'" and agentId="'.$_SESSION['agentUserid'].'"'); 
$rest=mysqli_fetch_array($a); 


if($rest['id']==''){
echo 'Something went wrong. Please try again.';
exit();
}


$b=GetPageRecord('*','sys_userMaster',' id in (select parentId from sys_userMaster where id="'.$rest['agentId'].'")  '); 
$adminData=mysqli_fetch_array($b); 


$urs=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($urs); 
} 


?> 

<div style="margin:auto; padding:10px;" id="DivIdToPrint">
<style>
table { font-size:12px; color:#000000; }
</style>
<style>
@media print {
body{padding:0px;}
table tr td { font-family:Arial, Helvetica, sans-serif;  font-size:13px; }
}

@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
</style>
<table width="100%" border="0" cellpadding="5" style="font-size:12px; ">
  <tr>
    <td width="34%" align="left"><img src="<?php echo $imgurlagent; ?><?php echo $adminData['companyLogo']; ?>" style="width:200px; "></td>
    <td width="33%">&nbsp;</td>
    <td width="33%" align="right" valign="middle"><div style="font-size:24px; text-decoration:underline; font-weight:600">Invoice</div></td>
  </tr>
  <tr>
    <td width="34%" valign="top"><table width="100%" border="0" cellpadding="0">
      <tr>
        <td><strong><?php echo strtoupper($adminData['companyName']); ?></strong></td>
      </tr>
      <tr>
        <td><?php echo stripslashes($adminData['address']); ?></td>
      </tr>
      <tr>
        <td>Tel: <?php echo stripslashes($adminData['phone']); ?> </td>
      </tr>
      <tr>
        <td>Email: <?php echo stripslashes($adminData['email']); ?> </td>
      </tr>
      <tr>
        <td><?php echo stripslashes($adminData['taxId']); ?></td>
      </tr>
      
    </table></td>
    <td width="33%">&nbsp;</td>
    <td width="33%" align="right" valign="top"><table width="100%" border="0" cellpadding="0">
      <tr>
        <td align="right"><strong><?php echo stripslashes($agentData['companyName']); ?></strong></td>
      </tr>
      <tr>
        <td align="right"><?php echo stripslashes($agentData['address']); ?></td>
      </tr>
      
      <tr>
        <td align="right">Mobile No: <?php echo stripslashes($agentData['phone']); ?></td>
      </tr>
      <tr>
        <td align="right">Email: <?php echo stripslashes($agentData['email']); ?></td>
      </tr>
      <tr>
        <td align="right">GSTIN: <?php echo stripslashes($agentData['gstin']); ?></td>
      </tr>
      <tr>
        <td align="right">Pan No: <?php echo stripslashes($agentData['pan']); ?></td>
      </tr>
    </table></td>
  </tr> 
  <tr>
    <td colspan="3"><hr /></td>
    </tr> 
  <tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="0" style="border:1px solid #ddd;">
      <tr>
        <td width="39%"><div>Invoice no:</div>
		<div style="font-size:13px; font-weight:600;"><?php echo encode($rest['id']); ?></div>		</td>
        <td width="28%"><div>Booking Date:</div>
		<div style="font-size:13px; font-weight:600;"><?php echo date('d M Y, H:i A', strtotime($rest['addDate'])); ?></div></td>
        <td width="18%"><div>Confirmation No. :</div>
		  <div style="font-size:13px; font-weight:600;"><?php echo  ($rest['confirmationNo']); ?></div>		</td>
        <td width="15%" align="center"><div>Booked By:</div>
		<div style="font-size:13px; font-weight:600;"><?php echo stripslashes($agentData['companyName']); ?></div>
		</td>
      </tr>
    </table></td>
    </tr> 
  <tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="3" cellspacing="0">
      <tr>
        <td width="22%" colspan="3" style="border-bottom:1px solid #FF6633;"><span style="font-size:13px; "><strong><?php echo stripslashes($rest['HotelName']); ?></strong><br />
<?php echo stripslashes($rest['Address']); ?></span></td>
        <td width="47%" align="right" style="border-bottom:1px solid #FF6633;">Room Type: <strong><?php echo stripslashes($rest['RoomType']); ?></strong><br />
          Check-In : <span style="font-size:13px; font-weight:600;"><?php echo date('d M Y', strtotime($rest['CheckIn'])); ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;Check-Out : <span style="font-size:13px; font-weight:600;"><?php echo date('d M Y', strtotime($rest['CheckOutDate'])); ?></span></td>
        </tr>
 
      <tr>
        <td width="31%" align="left" >
		

		
		
		</td>
      </tr> 
    </table>
	
	<table width="100%" border="0" cellpadding="5" cellspacing="0" bordercolor="#000000">
 <tr>
    <td style="border-bottom:1px solid #ddd;"> 
      <strong>Pax Details</strong> </td>
    </tr>
	<?php 
		$rs6=GetPageRecord('*','hotelBookingPaxDetailMaster',' bookingTableId="'.$rest['id'].'" and firstName!="" '); 
		while($paxData=mysqli_fetch_array($rs6)){
	  ?>
  <tr>
    <td style="border-bottom:1px solid #ddd;"> 
      Name : <?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?> (<?php echo ucfirst($paxData['paxType']); ?>) </td>
    </tr>
	<?php } ?>
</table>
	</td>
    </tr> 
	<?php 
		$c=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="hotel_GST"'); 
		$balanceSheetData=mysqli_fetch_array($c);
		 
		$ct=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="hotelTDS"'); 
		$balanceSheetDataTDS=mysqli_fetch_array($ct); 
		
		$totalAmt=0;
	  ?>
  <tr>
    <td width="34%">&nbsp;</td>
    <td width="33%">&nbsp;</td>
    <td width="33%" align="right"><table width="100%" border="0" cellpadding="0">
      <tr>
        <td width="50%" align="right">Basic</td>
        <td width="6%" align="center">:</td>
        <td width="44%" align="right"><?php echo number_format($rest['baseFare']-$rest['tax']); ?> INR</td>
      </tr>
      
      <tr>
        <td align="right">Taxes</td>
        <td align="center">:</td>
        <td align="right"><?php echo number_format($rest['tax']); ?> INR</td>
      </tr>
     
    <tr>
        <td align="right">Other Charges </td>
        <td align="center">:</td>
        <td align="right"><?php echo number_format($rest['agentOtherCharges']); ?>  INR</td>
      </tr>
      <tr>
        <td align="right">TDS </td>
        <td align="center">:</td>
        <td align="right"><?php echo number_format($tds=round($rest['agentCommision']*5/100)); $gst=round($rest['agentCommision']*18/100); ?>  INR</td>
      </tr>
      <tr>
        <td align="right">Commission</td>
        <td align="center">:</td>
        <td align="right">-(<?php echo number_format($comm=($rest['agentCommision']-$gst));  ?> INR)</td>
      </tr>
      
      <tr>
        <td align="right"><strong>Grand Total</strong></td>
        <td align="center"><strong>:</strong></td>
        <td align="right"><strong><?php echo number_format(($rest['baseFare']+$rest['agentOtherCharges']+$tds)-($comm)); ?> INR</strong></td>
      </tr>
    </table></td>
  </tr> 
  <tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="0">
      <tr>
        <td width="53%">
		<table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:1px solid #ddd;">
  <tr>
    <td><div style=" font-weight:600; text-decoration: underline; padding:10px;">Terms & Condition</div>
		<div  style=" padding:10px;"><?php echo nl2br(stripslashes($adminData['termsCondition'])); ?></div> </td>
  </tr>
</table>
		</td>
        <td width="47%" align="center"><div style=" font-weight:600;">For <?php echo strtoupper($adminData['companyName']); ?>.</div>
		<div>Computer Generated Report, Requires No Signature</div>		</td>
      </tr>
    </table></td>
    </tr>
</table>


</div>
 
 
<button type="button" class="btn btn-secondary btn-sm" onclick='printDiv();' style="float:right;">Print / Download</button>


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
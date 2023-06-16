<?php 
include "inc.php";

$_SESSION['agentUserid']=$_REQUEST['ag'];
 

if($_REQUEST['id']!=''){
$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" and agentId="'.$_SESSION['agentUserid'].'"'); 
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
		<div style="font-size:13px; font-weight:600;"><?php echo date('d M Y, H:i A', strtotime($rest['bookingDate'])); ?></div></td>
        <td width="18%"><div>Pnr:</div>
		<div style="font-size:13px; font-weight:600;"><?php echo stripslashes($rest['pnrNo']); ?></div>		</td>
        <td width="15%" align="center"><div>Booked By:</div>
		<div style="font-size:13px; font-weight:600;"><?php echo stripslashes($agentData['companyName']); ?></div>
		</td>
      </tr>
    </table></td>
    </tr> 
  <tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="3" cellspacing="0">
      <tr>
        <td colspan="3" style="border-bottom:1px solid #FF6633;">Onward: <span style="font-size:13px; font-weight:600;"><?php echo $rest['source']; ?>-<?php echo $rest['destination']; ?> , <?php echo $rest['flightName']; ?> <?php echo $rest['flightNo']; ?></span></td>
        <td colspan="4" align="right" style="border-bottom:1px solid #FF6633;">Travel Date: <span style="font-size:13px; font-weight:600;"><?php echo date('d M Y', strtotime($rest['journeyDate'])); ?></span></td>
        </tr>
      <tr>
        <td width="31%" align="left" style="border-bottom:1px solid #FF6633;">Name</td>
        <td width="8%" align="center" style="border-bottom:1px solid #FF6633;">Type</td>
        <td width="14%" align="center" style="border-bottom:1px solid #FF6633;">Class</td>
        <td width="13%" align="center" style="border-bottom:1px solid #FF6633;">Basic</td>
        <td width="8%" align="center" style="border-bottom:1px solid #FF6633;">YQ</td>
        <td width="13%" align="center" style="border-bottom:1px solid #FF6633;">Taxes</td>
        <td width="13%" align="center" style="border-bottom:1px solid #FF6633;">Total</td>
      </tr>
	  <?php 
		$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" and firstName!="" '); 
		$paxData=mysqli_fetch_array($rs6);
	  ?>
      <tr>
        <td align="left" style="border-bottom:1px solid #ddd;"><?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?> <?php if(mysqli_num_rows($rs6)>1){ ?>+ <?php echo (mysqli_num_rows($rs6)-1); } ?></td>
        <td align="center" style="border-bottom:1px solid #ddd;"><?php echo ucfirst($paxData['paxType']); ?></td>
        <td align="center" style="border-bottom:1px solid #ddd;"><?php echo ucfirst($rest['flightClass']); ?></td>
        <td align="center" style="border-bottom:1px solid #ddd;"><?php echo number_format($rest['agentBaseFare']); ?></td>
        <td align="center" style="border-bottom:1px solid #ddd;">0</td>
        <td align="center" style="border-bottom:1px solid #ddd;"><?php echo number_format($rest['tax']+$rest['agentMarkup']); ?></td>
        <td align="center" style="border-bottom:1px solid #ddd;"><?php echo number_format($rest['agentTotalFare']-$rest['totalWithSSRAmount']); ?></td>
      </tr> 
    </table></td>
    </tr> 
	<?php 
		$c=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="flight_GST"'); 
		$balanceSheetData=mysqli_fetch_array($c);
		 
		$ct=GetPageRecord('*','sys_balanceSheet',' bookingId="'.$rest['id'].'" and bookingType="TDS"'); 
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
        <td width="44%" align="right"><?php echo number_format($rest['baseFare']); $totalAmt+=$rest['agentBaseFare']; ?> INR</td>
      </tr>
      
      <tr>
        <td align="right">Taxes</td>
        <td align="center">:</td>
        <td align="right"><?php echo number_format($rest['tax']+$rest['agentMarkup']); ?> INR</td>
      </tr>
     <?php if($rest['seatPrice']>0){ ?> <tr>
        <td align="right">Seat Charges</td>
        <td align="center">:</td>
        <td align="right"><?php echo number_format($rest['seatPrice']); ?> INR</td>
      </tr>
	  <?php } ?>
       <?php if($rest['mealPrice']>0){ ?> <tr>
        <td align="right">Meal Charges</td>
        <td align="center">:</td>
        <td align="right"><?php echo number_format($rest['mealPrice']); ?> INR</td>
      </tr><?php } ?>
	  <?php if($rest['extraBaggagePrice']>0){ ?>
      <tr>
        <td align="right">Extra Baggage Charges</td>
        <td align="center">:</td>
        <td align="right"><?php echo number_format($rest['extraBaggagePrice']); ?> INR</td>
      </tr>
	  <?php } ?>
      <tr>
        <td align="right">TDS </td>
        <td align="center">:</td>
        <td align="right"><?php echo number_format($balanceSheetDataTDS['amount']); ?>  INR</td>
      </tr>
      <tr>
        <td align="right">Commission</td>
        <td align="center">:</td>
        <td align="right">-(<?php echo number_format($rest['agentCommision']);  ?> INR)</td>
      </tr>
      
      <tr>
        <td align="right"><strong>Grand Total</strong></td>
        <td align="center"><strong>:</strong></td>
        <td align="right"><strong><?php echo number_format(($rest['agentTotalFare']+$balanceSheetDataTDS['amount'])-($rest['agentCommision'])); ?> INR</strong></td>
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
<?php
include "inc.php";
include "agenturlinc.php";  
?>

<script language="JavaScript" type="text/javascript" src="ckeditor/ckeditor.js"></script> 
<script language="JavaScript" type="text/javascript" src="ckeditor/ckfinder/ckfinder.js"></script>

<?php if($_REQUEST['action']=='viewdetails' && $_REQUEST['id']!=""){ 
$a=GetPageRecord('*','sys_specialDeal',' id="'.decode($_REQUEST['id']).'"'); 
$data=mysqli_fetch_array($a);  ?>
<div class="modal-body">
<img src="<?php echo $imgurl; ?><?php echo $data['image']; ?>" style="width:100%; margin-bottom:20px;">
<h5><?php echo stripslashes($data['title']); ?></h3>
<div style="font-size:13px; line-height:20px; margin-top:10px;"><?php echo nl2br(stripslashes($data['description'])); ?></div>
</div>
<?php } ?>

 <?php if($_REQUEST['action']=='changepassword'){   ?>

<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 
<div class="modal-body">	<div class=" ">  
		<div class="form-group">
			<label>Old Password</label>
			<input name="oldPassword" type="password" min="0" class="form-control" id="oldPassword" value=""    >
		</div>	
		
		<div class="form-group">
			<label>New Password</label>
			<input name="newPassword" type="password" min="0" class="form-control" id="newPassword" value=""    >
		</div>	
		
		<div class="form-group">
			<label>Confirm Password</label>
			<input name="confirmPassword" type="password" min="0" class="form-control" id="confirmPassword" value=""    >
		</div>	     
	</div>
	<input name="action" type="hidden" id="action" value="changePassword">   </div>
	<div class="modal-footer showflightbookingcancelaltion" > 
		<button type="submit" class="btn btn-primary">Save&nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
	</div>
</form>

<?php } ?>


<?php if($_REQUEST['action']=='viewTicket' && $_REQUEST['id']!=''){
  
if($_REQUEST['id']!=''){
$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" '); 
$editresult=mysqli_fetch_array($a); 


}
 ?> 
 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 
		 
					<div class="row">
					
					<div class="col-md-3">
						<div class="form-group"> 
							<select name="ticketaction" id="ticketaction" class="form-control" onchange="loadticket();" style="margin-bottom: 10px; font-size: 13px; margin-top: 5px;margin-bottom: 0px;-webkit-appearance: listbox !important"> 
								<option value="1">With Fare Ticket</option>
								<option value="2">Without Fare Ticket</option>  
								<option value="3">Without Company Info.</option>  
								<option value="4">Add Markup</option>
							</select>
						</div>
					</div> 
					<div class="col-md-2 addmrkp" style="display:none;">
						<div class="form-group " > 
							<input name="markup" type="number" placeholder="Markup" min="0" class="form-control" id="markup" value="0"  style="margin-bottom: 10px; font-size: 13px; margin-top: 5px;margin-bottom: 0px;">
						</div> 
					</div> 
					
					<div class="col-md-3 tomail" style="display:none;"> 
						<div class="form-group ">
							<label>To Mail</label> 
							<input name="to" type="text" min="0" class="form-control" id="to" value="">
						</div>
					</div>
					<div class="col-md-3 addmrkp" style="display:none;">
						<button type="button" class="btn btn-primary"  onclick="loadticketwithmarkup();" style="padding: 5px 10px; margin-top: 5px;">Apply Markup</button> 
					</div>
					 <div class="col-md-4 tomail" style="display:none;"><button type="submit" class="btn btn-primary" style="margin-top: 28px;" >Send to Mail</button></div>   
					</div>
					
					  
					<div class="" id="loadticket"> 
					<?php echo file_get_contents($fullurl.'download_ticket.php?id='.$_REQUEST['id'].'&ta=1&psid='.$_REQUEST['psid'].'&tp='.$_REQUEST['tp'].''); ?> 
					</div>
					<script>
					
						function loadticket(){
							var ta = $('#ticketaction').val();
							var markup = Number($('#markup').val());
							if(ta!='' ){ 
								if(ta==4 && markup=='0'){
									$('.addmrkp').show();  
								}else{ 
									$('#markup').val('0');
									$('.addmrkp').hide();
									$('#loadticket').load('download_ticket.php?psid=<?php echo $_REQUEST['psid']; ?>&tp=<?php echo $_REQUEST['tp']; ?>&id=<?php echo $_REQUEST['id']; ?>&ta='+ta); 
								} 
							
							} 
						}
					
					function loadticketwithmarkup(){
					
						var ta = $('#ticketaction').val();
						var markup = Number($('#markup').val());
						
							if(markup>0){
								$('#loadticket').load('download_ticket.php?psid=<?php echo $_REQUEST['psid']; ?>&tp=<?php echo $_REQUEST['tp']; ?>&id=<?php echo $_REQUEST['id']; ?>&ta='+ta+'&markup='+markup); 
							}
					
					}
					
					
					</script>
					 
					 
	 

		<input name="action" type="hidden" id="action" value="ticketsendtomail">  
		<input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 			
		<input name="page" type="hidden" id="page" value="<?php echo $_REQUEST['page']; ?>"> 	
								
    
</form>
<?php } ?>





<?php if($_REQUEST['action']=='viewInvoice' && $_REQUEST['id']!=''){
 
 ?> 
 
					 
					
					  
					<div class="" id="loadticket"> 
					<?php 
					if($_REQUEST['invtype']=='flight'){
					echo file_get_contents($fullurl.'flightInvoice.php?id='.$_REQUEST['id'].'&ag='.$_SESSION['agentUserid'].'');
					}
					if($_REQUEST['invtype']=='hotel'){
					echo file_get_contents($fullurl.'hotelInvoice.php?id='.$_REQUEST['id'].'&ag='.$_SESSION['agentUserid'].'');
					}
					
					 ?> 
					</div>
					  
 
<?php } ?>



 <?php if($_REQUEST['action']=='hotelquery'){   ?>
 
 


<form action="frmaction.html" method="post" target="actoinfrm">
	<div class="modal-body" id="showflightbookingcancelaltion">			
   <div class="row">
	<div class="col-md-6"> 
        <div class="input-box">
			<label class="label-text">First Name <span style="color:red;">*</span></label>
				<div class="form-group"> 
                    <input name="name" type="text" class="form-control" id="name" placeholder="Type your full name" required="required">
				</div>
		</div></div><!-- end input-box -->
		
			<div class="col-md-6"> 
		<div class="input-box">
			<label class="label-text">Mobile Number <span style="color:red;">*</span></label>
            <div class="form-group"> 
            <input class="form-control" type="text" name="mobile" placeholder="Type your mobile number" required="required">
            </div>
		</div>
		
		 
		
	
	</div>
		<div class="col-md-12">
		
			<div class="input-box">
			<label class="label-text">Email Address <span style="color:red;">*</span></label>
			<div class="form-group"> 
				<input class="form-control" type="text" name="email" placeholder="Type your email" required="required">
			</div>
		</div>
		
			 
			
			 
		<input type="hidden" name="action" value="submithotelenquiry" />				
	 

							<!-- end input-box -->
		</div>
		
		<div class="col-md-12">
		<div class="input-box">
			<label class="label-text">Note <span style="color:red;">*</span></label>
			<div class="form-group"> 
				<textarea name="notes" rows="4" class="form-control" id="notes" placeholder="Type your Note"></textarea>
			</div>
		</div>
		</div>
	</div>
	
	<div class="btn-box pt-12  ">
		<button type="submit" class="btn btn-danger" style="width: 100%;">Submit Enquiry</button>
	</div>
   </div>
   
   
   <div id="showflightbookingcancelaltionthanks" style="display:none;">
  <div style="padding:30px; text-align:center;">
  <div style="text-align:center; font-size:24px; color:#CC3300; margin-bottom:10px;">Thank You!</div>
  <div style="text-align:center; font-size:14px; margin-bottom:10px;">One of our team will be in contact with you shortly.</div>
  
  </div>
  </div>
   <input type="hidden" name="hotelName" value="<?php echo $_REQUEST['hotelname']; ?>" />
   <input type="hidden" name="roomName" value="<?php echo $_REQUEST['name']; ?>" />
   <input type="hidden" name="room" value="<?php echo $_REQUEST['room']; ?>" />
   <input type="hidden" name="adult" value="<?php echo $_REQUEST['adult']; ?>" />
   <input type="hidden" name="child" value="<?php echo $_REQUEST['child']; ?>" />
   <input type="hidden" name="startdate" value="<?php echo $_REQUEST['startdate']; ?>" />
   <input type="hidden" name="enddate" value="<?php echo $_REQUEST['enddate']; ?>" />
   <input type="hidden" name="city" value="<?php echo $_REQUEST['city']; ?>" />
</form>

<?php } ?>


 <?php if($_REQUEST['action']=='flightCancellationRequest' && $_REQUEST['id']!=''){  
 
 
 if($_REQUEST['id']!=''){ 
$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" '); 
$editresult=mysqli_fetch_array($a); 

$detailArray = json_decode(stripslashes(unserialize($editresult['detailArray'])));

$urs=GetPageRecord('*','sys_userMaster',' id="'.$editresult['agentId'].'" '); 
$agentData=mysqli_fetch_array($urs); 
} 
 
  ?>
  <div id="showflightbookingcancelaltion">
 <div style="font-size:14px; margin-bottom:10px;"><strong>Flight Booking Information</strong></div>
 <table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#ddd">
      <tr>
        <td bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">Type</td>
        <td colspan="2" bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">Passenger&nbsp;Name</td>
        <td bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">PNR</td>
      </tr>
	  <?php 
		$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$editresult['id'].'" and firstName!="" '); 
		while($paxData=mysqli_fetch_array($rs6)){
	  ?>
      <tr>
        <td><?php echo ucfirst($paxData['paxType']); ?></td>
        <td colspan="2"><?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?></td>
        <td><?php echo $editresult['pnrNo']; ?></td>
      </tr>
	  <?php } ?>
</table>
 <table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#ddd">
      <tr>
        <td width="20%" style="background-color:#486b88; color:#fff; font-weight:500;">Flight</td>
        <td width="20%" align="right" style="background-color:#486b88; color:#fff; font-weight:500;">Departure</td>
        <td width="20%" style="background-color:#486b88; color:#fff; font-weight:500;">&nbsp;</td>
        <td width="20%" style="background-color:#486b88; color:#fff; font-weight:500;">Arrival</td>
   </tr>
		
		  
      
       
	  
	  <?php 
 
	  if ($detailArray->D_CODE != ''){
	   $countstops=$detailArray->STOP; 
	   $OITerminal=$detailArray->OI; 
	 
	  }
	  
	  
		$j = 0;
		foreach ((array)$detailArray->CON_DETAILS as $layoverFlight){ 
		  if ($layoverFlight->FLIGHT_NAME != ''){
		  
 
		?>  
      <tr>
        <td width="20%"><table border="0">
  <tr>
    <td><img class="img-fluid" src="<?php echo $imgurl.getflightlogo($layoverFlight->FLIGHT_NAME); ?>" style="max-width: 50px !important;" ></td>
    <td>&nbsp;</td>
    <td><?php echo $layoverFlight->FLIGHT_NAME; ?><br />
	<?php echo $layoverFlight->FLIGHT_CODE; ?> - <?php echo $layoverFlight->FLIGHT_NO; ?></td>
  </tr>
</table></td>
        <td width="20%" align="right" valign="middle">
			<div style="font-size: 16px; font-weight: 900; color: #1574c3;"><?php echo $layoverFlight->ORG_NAME; ?></div>  
			<div style="border-bottom: 1px solid #000; border-top: 1px solid #000;width: 150px;"><?php echo $layoverFlight->DEP_TIME; ?> - <?php echo date('D, d M y', strtotime($layoverFlight->DEP_DATE)); ?></div>
			<div>Terminal: <?php echo $editresult['flightTerminal']; ?></div></td>
        <td width="20%" align="center" valign="middle"><div style="font-size:30px;"><i class="fa fa-plane" aria-hidden="true"></i></div>
		<div style="border-bottom: 1px solid #000; width: 60px;"><?php echo makeFlightTime($layoverFlight->DURATION); ?></div>
		<div><strong><?php echo $editresult['flightClass']; ?></strong></div>		</td>
        <td width="20%" valign="middle">
				<div style="font-size: 16px; font-weight: 900; color: #1574c3;"><?php echo $layoverFlight->DES_NAME; ?></div>
				<div style="border-bottom: 1px solid #000; border-top: 1px solid #000;width: 150px;"><?php echo $layoverFlight->ARRV_TIME; ?> - <?php echo date('D, d M y', strtotime($layoverFlight->DEP_DATE)); ?></div>	
				<div>Terminal: <?php  if($countstops>0){ echo $layoverFlight->DES_TRML; } else { echo '(Please check with airline)'; } ?></div>			</td>
   </tr>
		<?php if($layoverFlight->LAYOVER_INFO!=''){ ?>
	  <tr>
        <td colspan="4" align="center" style="background-color: #FFF9EA !important; border: 1px solid #FFECD7 !important; font-size:14px;"><?php echo $layoverFlight->LAYOVER_INFO; ?></td>
   </tr>
		<?php } ?>
      <?php $j++; } } ?>
	  <?php if($j==0){  ?>
	  <tr>
        <td width="20%">
		<table border="0">
  <tr>
    <td><img src="<?php echo $imgurl.getflightlogo($detailArray->F_NAME); ?>" width="32" class="img-fluid" style="max-width: 50px !important;" ></td>
    <td>&nbsp;</td>
    <td><strong><?php echo $editresult['flightName']; ?></strong><br />
	 <?php echo $editresult['flightNo']; ?></td>
  </tr>
</table></td>
        <td width="20%" align="right" valign="middle">
			<div style="font-size: 16px; font-weight: 900; color: #1574c3;"><?php  $fareType=explode('-',$editresult['source']); echo getflightdestination($fareType[1]); ?></div>  
			<div style="border-bottom: 1px solid #000; border-top: 1px solid #000;width: 150px;"><?php echo $editresult['departureTime']; ?>,<?php echo date('D, j M Y', strtotime($editresult['journeyDate'])); ?></div>
			<div>Terminal: <?php echo $editresult['flightTerminal']; ?></div></td>
        <td width="20%" align="center" valign="middle"><div style="font-size:30px;"><i class="fa fa-plane" aria-hidden="true"></i></div>
		<div style="border-bottom: 1px solid #000; width: 60px;"><?php echo makeFlightTime($detailArray->DUR); ?></div>
		<div><strong><?php echo $editresult['flightClass']; ?></strong></div>		</td>
        <td width="20%" valign="middle">
				<div style="font-size: 16px; font-weight: 900; color: #1574c3;"><?php  $fareType=explode('-',$editresult['destination']);  echo getflightdestination($fareType[1]); ?></div>
				<div style="border-bottom: 1px solid #000; border-top: 1px solid #000;width: 150px;"><?php echo $editresult['arrivalTime']; ?>,<?php echo date('D, j M Y', strtotime($editresult['arrivalDate'])); ?></div>	
				<div>Terminal: <?php  if($countstops>0){ echo $layoverFlight->DES_TRML; } else { echo '(Please check with airline)'; } ?></div>						</td>
   </tr>
		<?php } ?>
</table>
  <table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#ddd">
      <tr>
        <?php if($_REQUEST['ta']!=2){ ?> <td width="89%" align="right" bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">&nbsp;</td>
        <td width="30%" align="right" bgcolor="#486b88" style="background-color:#486b88; color:#fff; font-weight:500;">&nbsp;</td><?php } ?>
      </tr>
      <tr>
        <?php if($_REQUEST['ta']!=2){ ?> <td align="right">Fare: <br>

Fee & Surcharge: <br>
<?php if($editresult['insuranceAmount']>0){ ?><?php echo strip($editresult['insurance']); ?> <br><?php } ?>

<strong>Total Amount:</strong> </td>
        <td width="30%" align="right"> Rs.<?php echo number_format($editresult['clientBaseFare']); $totalAmt+=$editresult['clientBaseFare']; ?><br> 

Rs.<?php echo number_format($editresult['clientTax']+$editresult['clientExtraMarkup']+$_REQUEST['markup']);  $totalAmt+=($editresult['clientTax']+$editresult['clientExtraMarkup']+$_REQUEST['markup']); ?><br>
<?php if($editresult['insuranceAmount']>0){ ?>Rs.<?php echo strip($editresult['insuranceAmount']); ?><br><?php } ?>
<strong>Rs.<?php echo number_format($totalAmt+$editresult['insuranceAmount']); ?></strong> </td>
		<?php } ?>
      </tr>
    </table>
	
	<div style="padding:20px; background-color:#FFFFFF; border:2px solid #CC3300; color:#CC3300; font-size:14px; margin:20px 0px;">
	<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <strong>Please confirm the following.</strong><br />
    <strong>Warning:</strong> Cancellation - Refund charges may applicable.</div>
	
    <form action="frmaction.html" method="post" target="actoinfrm">
<div class="btn-box pt-12  ">
		<button type="submit" class="btn btn-danger" style="width: 100%;">Confirm</button>
	</div>
   <input type="hidden" name="id" value="<?php echo base64_encode(base64_encode(decode($_REQUEST['id']))); ?>" />
   <input type="hidden" name="action" value="flightcancellation" />
</form>
</div>


  <div id="showflightbookingcancelaltionthanks" style="display:none;">
  <div style="padding:30px; text-align:center;">
  <div style="text-align:center; font-size:24px; color:#CC3300; margin-bottom:10px;">Cancellation Request Submitted Successfully!</div>
  <div style="text-align:center; font-size:14px; margin-bottom:10px;">We will review your request and process asap.</div>
  
  </div>
  </div>

<?php } ?>

 <?php if($_REQUEST['action']=='resetpassword'){ ?>
 
 
 <form action="<?php echo $fullurl; ?>frmaction.html" method="post" target="actoinfrm">
	<div class="modal-body showflightbookingcancelaltion" >			
   <div class="row">
	 <!-- end input-box -->
		
			 
		<div class="col-md-12">
		
			<div class="input-box">
			<label class="label-text" style="margin-bottom:5px;">Enter your registered email address <span style="color:red;">*</span></label>
			<div class="form-group"> 
				<input class="form-control" type="email" name="email" placeholder="Type your email" required="required">
			</div>
		</div> 
			 
		<input type="hidden" name="action" value="submithotelenquiry" />	 
		</div>
		
		 
	</div>
	 </div>
	 <div class="modal-footer showflightbookingcancelaltion"> 
		<button type="submit" class="btn btn-danger" style="width: 120px;">Submit</button> 
	 </div>

  
   
   
   <div id="showflightbookingcancelaltionthanks" style="display:none;">
  <div style="padding:30px; text-align:center;">
  <div style="text-align:center; font-size:24px; color:#CC3300; margin-bottom:10px;">Password Recovery </div>
  <div style="text-align:center; font-size:14px; margin-bottom:10px;">Password reset successfully and sent to your email address.</div>
  
  </div>
  </div>
   <input type="hidden" name="action" value="resetpassword" />
 
</form>
 <?php } ?>
 
 
 <?php if($_REQUEST['action']=='viewHotelVoucher' && $_REQUEST['id']!=''){ 
 
 $id=base64_encode(($_REQUEST['i']));
 $_REQUEST['i']=$id;
 
  
 
 
 ?>
 
 <div class="row">
					
					<div class="col-md-3">
						<div class="form-group"> 
							<select name="ticketaction" id="ticketaction" class="form-control" onchange="loadticket();" style="margin-bottom: 10px; font-size: 13px; margin-top: 5px;margin-bottom: 0px;-webkit-appearance: listbox !important"> 
								<option value="1">With Fare Voucher</option>
								<option value="2">Without Fare Voucher</option>  
								<option value="3">Without Company Info.</option>  
								<option value="4">Add Markup</option>
							</select>
						</div>
						
						<script>
					
						function loadticket(){
							var ta = $('#ticketaction').val();
							var markup = Number($('#markup').val());
						  $('.withoutfare').show();
									$('.hcompanyinfo').show();  
							if(ta!='' ){ 
								if(ta==2){
									$('.withoutfare').hide();  
								} 
								
								if(ta==3){
									$('.hcompanyinfo').hide();  
								} 
							
							} 
						}
					
					function loadticketwithmarkup(){
					
						var ta = Number($('#htotalamount').val());
						var markup = Number($('#markup').val());
						
						 
							$('#displayhtotalamount').text(Number(ta+markup));	
					
					
					}
					
					
					</script>
					</div> 
					<div class="col-md-2 addmrkp" style="display:none;">
						<div class="form-group " > 
							<input name="markup" type="number" placeholder="Markup" min="0" class="form-control" id="markup" value="0"  style="margin-bottom: 10px; font-size: 13px; margin-top: 5px;margin-bottom: 0px;">
						</div> 
					</div> 
					
					<div class="col-md-3 tomail" style="display:none;"> 
						<div class="form-group ">
							<label>To Mail</label> 
							<input name="to" type="text" min="0" class="form-control" id="to" value="">
						</div>
					</div>
					<div class="col-md-3 addmrkp" style="display:none;">
						<button type="button" class="btn btn-primary"  onclick="loadticketwithmarkup();" style="padding: 5px 10px; margin-top: 5px;">Apply Markup</button> 
					</div>
					 <div class="col-md-4 tomail" style="display:none;"><button type="submit" class="btn btn-primary" style="margin-top: 28px;" >Send to Mail</button></div>   
					</div>
					
					<hr />
 
<?php  include "hotel-voucher.php"; ?>
  <script>
					
						function loadticket(){
							var ta = $('#ticketaction').val();
							var markup = Number($('#markup').val());
							if(ta!='' ){ 
								if(ta==4 && markup=='0'){
									$('.addmrkp').show();  
								}else{ 
									$('#markup').val('0');
									$('.addmrkp').hide();
									$('#loadticket').load('download_ticket.php?id=<?php echo $_REQUEST['id']; ?>&ta='+ta); 
								} 
							
							} 
						}
					
					function loadticketwithmarkup(){
				
						var ta = Number($('#htotalamount').val());
						var markup = Number($('#markup').val());
					 
						$('#displayhtotalamount').text(Number(ta+markup));
							 
					
					}
					
					
					</script>
 <?php } ?>
 
 
 
 
 
 
 
 
<?php if($_REQUEST['action']=='selectpackage'){ ?>
<div style="padding:10px;">
<input name="searchpackagekeyword" id="searchpackagekeyword" type="text" style="padding:15px; border:1px solid #ddd; font-size:16px; width:100%; box-sizing:border-box;" placeholder="Search Package" onkeyup="loadselectpackages();" />
</div>
<div style="margin-top:10px; max-height:400px; overflow:auto;" id="loadselectpackages">

</div>
<script>
function loadselectpackages(){
var searchpackagekeyword = encodeURI($('#searchpackagekeyword').val());
var packalready = $('#selectedpackageslist').val();
$('#loadselectpackages').load('loadselectpackages.php?searchpackagekeyword='+searchpackagekeyword+'&packalready='+packalready);
}
loadselectpackages();
</script>

<?php } ?>




<?php if($_REQUEST['action']=='changequerystatus' && $_REQUEST['id']!='' && $_REQUEST['status']!='' && $_REQUEST['statusname']!=''){

 

 ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

			 <div class="" >  

			 <?php if($_REQUEST['statusname2']=='Cancelled' || $_REQUEST['statusname2']=='Lost'){ ?>

						<div class="form-group">

									<label>Query Closure Reasons<span class="text-danger">*</span></label>

									 <select name="closureReasons" class="form-control" id="closureReasons">

											<?php  

										$rs=GetPageRecord('*','sys_queryClosureReasons','  parentId="'.$LoginUserDetails['parentId'].'" and status=1  order by name asc');

										while($rest=mysqli_fetch_array($rs)){ 

										?> 

									   <option value="<?php echo stripslashes($rest['id']); ?>"><?php echo stripslashes($rest['name']); ?></option>

									   <?php } ?>

						  </select>

			   </div>

			   <?php } ?>

						<div class="form-group">

									<label>Comment</label>

									<textarea name="comment" rows="2" class="form-control" id="comment" placeholder="Write a comment..."></textarea>

			   </div>

						     

						 



								

								

   </div><div class="card-footer text-right"  style="text-align:right;">

								 

								

								<button type="submit" class="btn btn-primary">Change Query Status &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="savechangequerystatus">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="status" type="hidden" id="status" value="<?php echo $_REQUEST['status']; ?>">

							    <input name="statusname" type="hidden" id="statusname" value="<?php echo $_REQUEST['statusname']; ?>">

				  </div>

</form>

<?php } ?>


<?php if($_REQUEST['action']=='addquerynote' && $_REQUEST['id']!=''){

 

 ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

			 <div class=" " >  

			 

						

						<div class="form-group"> 

									<textarea name="comment" rows="2" class="form-control" id="comment" placeholder="Enter Note"></textarea>

			   </div>

						     

						 



								

								

   </div><div class="card-footer text-right" style="text-align:right;" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="savequerynote">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

				  </div>

</form>

<?php } ?>












<?php if($_REQUEST['action']=='editinerary' && $_REQUEST['id']!=''){





$rs5=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['agentUserid'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($rs5);



$a=GetPageRecord('*','queryMaster',' addBy="'.$_SESSION['agentUserid'].'" and id="'.($editresult['queryId']).'" '); 

$queryData=mysqli_fetch_array($a);

 

 ?>

 

<script>

 $(document).ready(function() {

    $('#destination').select2({dropdownParent: $('.modal'), tags: true, tokenSeparators: [',', ' ']}); 

});

</script>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					 <div class="col-md-6">

						<div class="form-group">

									<label>Package Title<span class="text-danger">*</span></label>

									<input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($editresult['name']); ?>" maxlength="255">

					   </div> 

				      </div> 

						

						<div class="col-md-6">

						<div class="form-group">

									<label>Package Banner</label>

									<input name="packagebanner" type="file" class="form-control" id="packagebanner" style="padding: 4px;">

					      </div> 

				      </div>



<?php

//Get City Name

$cityName=GetPageRecord('*','cityMaster','  id="'.$editresult['destination'].'" order by name asc');

$cityNameData=mysqli_fetch_array($cityName);

?>

						   <div class="col-md-6">

	<div class="form-group">

		<label>Select Location</label>

		<div style="height:0px; font-size:0px; position:relative;  " id="searchcitylistsfromCity"></div>

			<div class="input-group input-group-lg">  

				<input type="text" class="form-control" requered  onkeyup="getSearchCIty('pickupCitySearchfromCity','pickupCityfromCity','searchcitylistsfromCity');" id="pickupCitySearchfromCity" name="pickupCitySearchfromCity123" value="<?php echo $cityNameData['name']; ?>" autocomplete="nope" >

				<input name="cityName" id="pickupCityfromCity" type="hidden" value="<?php echo stripslashes($editresult['destination']); ?>" autocomplete="nope" />

			</div>

		</div>

</div>







  <div class="col-md-6 d-none">

	<div class="form-group">

		<label>Weekend Getaways</label>

		<div style="height:0px; font-size:0px; position:relative;  " ></div>

			<div class="input-group input-group-lg">  

				 <select name="weekendGatewayLocationId" class="form-control" id="weekendGatewayLocationId">

	<?php  

	$a=GetPageRecord('*','weekendGatewayLocationMaster','  status=1 order by name asc');

	while($locationData=mysqli_fetch_array($a)){



 ?>

	<option value="<?php echo $locationData['id']; ?>" <?php if($locationData['id']==$editresult['weekendGatewayLocationId']){ ?>selected="selected"<?php } ?>><?php echo $locationData['name']; ?></option>

	<?php } ?>

			  </select>

				 

			</div>

		</div>

</div>

						   

						   <?php if($_REQUEST['package']!='detail'){ ?>

						   <div class="col-md-12">

						<div class="form-group">

									<label>Package Itinerary</label>

									 <textarea name="packageItinerary" rows="3" class="form-control" id="packageItinerary" ><?php  echo stripslashes($editresult['packageItinerary']);  ?></textarea>

 <script type="text/javascript"> 

	var editor = CKEDITOR.replace('packageItinerary'); 

	CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ; 

	</script>

						   </div> 

						   </div>

						   <?php } else {?>

						   

						   

						   

						   

						      

						        <div class="col-md-2" <?php if($queryData['id']==''){ ?>style="display:none;"<?php } ?>>

						<div class="form-group">

									<label>Start Date<span class="text-danger">*</span></label>

									<input name="startDate" type="text" class="form-control" id="startDate" value="<?php echo date('d-m-Y',strtotime($editresult['startDate'])); ?>">

						   </div> 

						   </div>

						   

						   <?php if($queryData['id']==''){ ?>

						     <div class="col-md-6">

						<div class="form-group">

									<label>Package Duration<span class="text-danger">*</span></label>

									<select name="nights" class="form-control" id="nights">

	<?php $n=1; for ($x = 1; $x <= 20; ) { ?>

	<option value="<?php echo ($x-1); ?>" <?php if(($x-1)==$editresult['nights']){ ?>selected="selected"<?php } ?>><?php echo ($x-1); ?> Nights / <?php echo $n; ?> Days</option>

	<?php $n++; $x++;} ?>

						  </select>

									

									 

						   </div> 

						   </div>

						   <?php } else { ?>

						   

						    <div class="col-md-2">

						<div class="form-group">

									<label>End Date<span class="text-danger">*</span></label>

									<input name="endDate" type="text" class="form-control" id="endDate" value="<?php echo date('d-m-Y',strtotime($editresult['endDate'])); ?>">

						   </div> 

						   </div>

						   

						   <?php }  ?>

						   

						   

						   

						   

						   

						   	 <div class="col-md-2" style="display:none;">

						<div class="form-group">

									<label>Adult</label>

									<input name="adult" type="number" min="1" class="form-control" id="adult" readonly="readonly" value="<?php echo stripslashes($queryData['adult']); ?>">

						   </div> 

						   </div>

						   

						    <div class="col-md-1"  style="display:none;">

						<div class="form-group">

									<label>Child121</label>

									<input name="child" type="number" min="0" class="form-control" id="child" readonly="readonly" value="<?php echo stripslashes($queryData['child']); ?>">

						   </div> 

						   </div>

						   

						    <div class="col-md-1"  style="display:none;">

						<div class="form-group">

									<label>Infant</label>

									<input name="infant" type="number" min="0" class="form-control" id="infant" readonly="readonly" value="<?php echo stripslashes($queryData['infant']); ?>">

						   </div> 

						   </div>

						   

					 <div class="col-md-6">

						<div class="form-group">

									<label>Package Theme</label>

									<select name="packageTheme" class="form-control" id="packageTheme">

										<?php  

										$rs=GetPageRecord('*','sys_packageTheme','    status=1  order by name asc');

										while($rest=mysqli_fetch_array($rs)){ 

										?> 

										<option value="<?php echo stripslashes($rest['id']); ?>" <?php if($rest['id']==$editresult['packageTheme']){ ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>

										<?php } ?>

						  			</select>

					   </div> 

				      </div>

						   

						   <div class="col-md-6">

						<div class="form-group">

									<label>Show On Website</label>

									<select name="showOnWebsite" class="form-control" id="showOnWebsite">

	 

	<option value="1" <?php if(1==$editresult['showOnWebsite']){ ?>selected="selected"<?php } ?>>Yes</option>

	<option value="0" <?php if(0==$editresult['showOnWebsite']){ ?>selected="selected"<?php } ?>>No</option>

 

						  </select>

						   </div> 

						   </div>

						   

<div class="col-md-12" style="display:none;">

	<div class="form-group">

	<label>Select Location (Multiselect)</label>

	<select class="form-control" multiple="multiple" name="destination[]" id="destination" data-fouc>

	<?php  

		$rs=GetPageRecord('*','sys_destinationMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1  order by name asc');

		while($rest=mysqli_fetch_array($rs)){ 

		if(trim($rest['name'])!=''){ 

			$HiddenProducts = explode(',',$editresult['destination']);

		?> 

		<option value="<?php echo stripslashes($rest['id']); ?>" <?php if (in_array($rest['id'], $HiddenProducts)) { ?>selected="selected"<?php } ?>><?php echo stripslashes($rest['name']); ?></option>

	<?php }} ?>

	</select>

</div> 

</div>





<div class="row" style=" width:100%; padding-left:10px; margin-top:10px; margin-bottom:10px;">

							<div class="col-md-2">

							<div class="checkbox checkbox-primary">

							<input type="checkbox" name="flighticon" id="checkbox2" value="1" <?php if(1==$editresult['flighticon']){ ?> checked="checked" <?php } ?> />

							<label for="checkbox2">

							Flight Icon

							</label>

							</div> 

							</div>

							

							<div class="col-md-2">

							<div class="checkbox checkbox-primary">

							<input type="checkbox" name="hotelicon" id="hotelicon" value="1" <?php if(1==$editresult['hotelicon']){ ?> checked="checked" <?php } ?> />

							<label for="hotelicon">

							Hotel Icon

							</label>

							</div> 

							</div>

							

							<div class="col-md-2">

							<div class="checkbox checkbox-primary">

							<input type="checkbox" name="sightseeingicon" id="sightseeingicon" value="1" <?php if(1==$editresult['sightseeingicon']){ ?> checked="checked" <?php } ?> />

							<label for="sightseeingicon">

							Sightseeing Icon

							</label>

							</div> 

							</div>

							

							<div class="col-md-2">

							<div class="checkbox checkbox-primary">

							<input type="checkbox" name="transfericon" id="transfericon" value="1" <?php if(1==$editresult['transfericon']){ ?> checked="checked" <?php } ?> />

							<label for="transfericon">

							Transfer Icon

							</label>

							</div> 

							</div>

							

							<div class="col-md-2">

							<div class="checkbox checkbox-primary">

							<input type="checkbox" name="activityicon" id="activityicon" value="1" <?php if(1==$editresult['activityicon']){ ?> checked="checked" <?php } ?> />

							<label for="activityicon">

							Activity Icon

							</label>

							</div> 

							</div>

							

							<div class="col-md-2">

							<div class="checkbox checkbox-primary">

							<input type="checkbox" name="cruiseicon" id="cruiseicon" value="1" <?php if(1==$editresult['cruiseicon']){ ?> checked="checked" <?php } ?> />

							<label for="cruiseicon">

							Cruise Icon

							</label>

							</div> 

							</div>



				</div>		    

						   

						    

						   

						    

						   

						    

						   

						   <div class="col-md-12">

						<div class="form-group">

									<label>Package Overview</label>

									 <textarea name="packageItinerary" rows="6" class="form-control" id="packageItinerary" placeholder="Write something about package" ><?php  echo stripslashes($editresult['packageItinerary']);  ?></textarea>

 

						   </div> 

						   </div>

						  <script>









				$( function() {

				$( "#startDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true});

				$( "#endDate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true });

				} );

				</script>

				

						   

						   

						   <?php  } ?>

					</div>

					

		   </div>



								

								

   </div>

				  <div class="card-footer text-right" >

							 	 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

<input name="action" type="hidden" id="action" value="<?php if($_REQUEST['package']=='detail'){?>savedetailpackageotitle<?php }else{ ?>savequickpackageotitle<?php } ?>">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

							    <input name="bannerImg" type="hidden" id="bannerImg" value="<?php echo $editresult['bannerImg']; ?>">

								<input name="adult" type="hidden" id="adult" value="1"> 

				  </div>

</form>

<?php } ?>




<?php if($_REQUEST['action']=='editdetailpackageoptionpeice' && $_REQUEST['id']!='' && $_REQUEST['quotationid']!=''){





$rs5=GetPageRecord('*','sys_quickPackageOptions',' parentId="'.$_SESSION['agentUserid'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($rs5);







$ab=GetPageRecord('*','sys_branchMaster',' parentId="'.$LoginUserDetails['parentId'].'" and  id="'.$LoginUserDetails['branchId'].'" order by id asc '); 

$branchData=mysqli_fetch_array($ab);

 ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					

<div class="col-md-6">

	<div class="form-group">

		<label>Per Adult Price</label>

		<input name="perAdult" type="number" class="form-control" id="perAdult" value="<?php echo stripslashes($editresult['perAdult']); ?>">

	</div> 

</div>



<div class="col-md-6">

	<div class="form-group">

		<label>Per Child Price</label>

		<input name="perChild" type="number" class="form-control" id="perChild" value="<?php echo stripslashes($editresult['perChild']); ?>">

	</div> 

</div>



<div class="col-md-6" style="display:none;">

	<div class="form-group">

		<label>Adult Markup</label>

		<input name="quotationAdultMarkup" type="number" class="form-control" id="quotationAdultMarkup" value="0<?php // echo stripslashes($editresult['quotationAdultMarkup']); ?>">

	</div> 

</div>



<div class="col-md-6"  style="display:none;">

	<div class="form-group">

		<label>Child Markup</label>

		<input name="quotationChildMarkup" type="number" class="form-control" id="quotationChildMarkup" value="0<?php // echo stripslashes($editresult['quotationChildMarkup']); ?>">

	</div> 

</div>

					

					

<input type="hidden" id="currencyId" name="currencyId" value="2755">			

						   

						 

					</div>

					

		   </div>



								

								

   </div>

				  <div class="card-footer text-right" >

							<!--<button type="button" class="btn btn-danger" style="float:left;" data-dismiss="modal" onclick="if(confirm('Are you sure you want to delete this option?')) deleteoptions<?php echo $_REQUEST['id']; ?>('<?php echo $_REQUEST['id']; ?>');">Delete &nbsp;<i class="fa fa-trash" aria-hidden="true"></i></button>-->	 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="savequickpackageoptionpeice">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>">

				  </div>

</form>

<?php } ?>




<?php if($_REQUEST['action']=='editdaydetails' && $_REQUEST['id']!=''){





$rs5=GetPageRecord('*','packageDays',' parentId="'.$_SESSION['agentUserid'].'" and id="'.decode($_REQUEST['id']).'" '); 

$editresult=mysqli_fetch_array($rs5);



$b=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['agentUserid'].'" and id="'.$editresult['quotationId'].'"   '); 

$quotationDetail=mysqli_fetch_array($b);

 

 ?>

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">				   

						   

						   

					

					 <div class="col-md-12">

						<div class="form-group">

									<label>Title<span class="text-danger">*</span></label>

									<input name="title" type="text" class="form-control" id="title" value="<?php echo stripslashes($editresult['title']); ?>" maxlength="255">

					   </div> 

				      </div> 

						 

						   <div class="col-md-12">

						<div class="form-group">

									<label>Day Details</label>

									 <textarea name="description" rows="6" class="form-control" id="packageItinerary" ><?php  echo stripslashes($editresult['description']);  ?></textarea>

 

						   </div> 

						   </div>

						    

					</div>

					

		   </div>



								

								

   </div>

				  <div class="card-footer text-right" >

							 	 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="savedaydetails">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>"> 

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>"> 

							    <input name="daydate" type="hidden" id="daydate" value="<?php echo $_REQUEST['daydate']; ?>"> 

							    <input name="dayid" type="hidden" id="dayid" value="<?php echo $_REQUEST['dayid']; ?>">  

				  </div>

</form>

<?php } ?>








<?php if($_REQUEST['action']=='editpackageterms' && $_REQUEST['quotationid']!='' && $_REQUEST['id']!=''){



if($_REQUEST['id']!=''){

$rs5=GetPageRecord('*','quotationTerms','   id="'.decode($_REQUEST['id']).'"  and quotationId="'.decode($_REQUEST['quotationid']).'" '); 

$editresult=mysqli_fetch_array($rs5);

 }

 

 ?>

  

 <form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					<div class="col-md-12">

						<div class="form-group">

									<label>Title<span class="text-danger">*</span></label>

									<input name="termType" type="text"  class="form-control" id="termType"   value="<?php echo stripslashes($editresult['termType']); ?>">

				      </div> 

				      </div> 

			   

						     <div class="col-md-12">

						<div class="form-group">

									<label>Description</label>

 <textarea name="termDescription" rows="3" class="form-control" id="termDescription" ><?php  echo stripslashes($editresult['termDescription']);  ?></textarea>

 <script type="text/javascript"> 

	var editor = CKEDITOR.replace('termDescription'); 

	CKFinder.setupCKEditor( editor,'ckeditor/ckfinder/' ) ; 

	</script>

						   </div> 

						   </div> 

						

					</div>

					

		   </div>



								

								

   </div><div class="card-footer text-right" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveEventTermDescription">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">

							    <input name="quotationid" type="hidden" id="quotationid" value="<?php echo $_REQUEST['quotationid']; ?>">  

				  </div>

</form>

 

 

  

<?php } ?>




<?php if($_REQUEST['action']=='viewquotation'  && $_REQUEST['id']!=''){



if($_REQUEST['id']!=''){

$rs5=GetPageRecord('*','quotationMaster',' parentId="'.$_SESSION['agentUserid'].'" and id="'.decode($_REQUEST['id']).'"'); 

$quotationInfo=mysqli_fetch_array($rs5);

 }

 

 ?>

<div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">

					  

			   

						  <?php if($quotationInfo['quotationType']=='Quick Package'){ include "quickpackageview.php"; } ?>

						  <?php if($quotationInfo['quotationType']=='Flight'){ include "flightquotationview.php"; } ?>

						  <?php if($quotationInfo['quotationType']=='Sightseeing'){ include "sightseeingquotationview.php"; } ?>

						  <?php if($quotationInfo['quotationType']=='Transport'){ include "transportquotationview.php"; } ?>

						  <?php if($quotationInfo['quotationType']=='Visa'){ include "visaquotationview.php"; } ?>

						  <?php if($quotationInfo['quotationType']=='Miscellaneous'){ include "miscellaneousquotationview.php"; } ?>

						  <?php if($quotationInfo['quotationType']=='Hotel'){ include "hotelquotationview.php"; } ?>

						  <?php if($quotationInfo['quotationType']=='Detailed Package'){ include "detailedpackageview.php"; } ?>

						

					</div>

					

  </div>



								

								

</div>

  

 

 

  

<?php } ?>










<?php if($_REQUEST['action']=='addcustomer' ){

	if($_REQUEST['id']!=''){
	$rs5=GetPageRecord('*','flightBookingPaxDetailMaster','   id="'.decode($_REQUEST['id']).'"    and BookingId in(select id from flightBookingMaster where agentId="'.$_SESSION['agentUserid'].'")  ');  
	$editresult=mysqli_fetch_array($rs5);
	} 
	
 ?>

 <form action="<?php echo $fullurl; ?>frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

		 <div class="modal-body" >	

			<div class="col-md-12">

					<div class="row">
<div class="col-md-4">

						<div class="form-group">

									<label>Title<span class="text-danger">*</span></label>
 <select name="nameHead" class="form-control" >

	 

	<option value="Mr" <?php if('Mr'==$editresult['title']){ ?>selected="selected"<?php } ?>>Mr</option>
	<option value="Ms" <?php if('Ms'==$editresult['title']){ ?>selected="selected"<?php } ?>>Ms</option> 
	<option value="Mrs" <?php if('Mrs'==$editresult['title']){ ?>selected="selected"<?php } ?>>Mrs</option>
	<option value="Mstr" <?php if('Mstr'==$editresult['title']){ ?>selected="selected"<?php } ?>>Mstr</option>
	<option value="Miss" <?php if('Miss'==$editresult['title']){ ?>selected="selected"<?php } ?>>Miss</option> 
 

						  </select>

				      </div> 

				      </div>
					<div class="col-md-8">

						<div class="form-group">

									<label>First Name<span class="text-danger">*</span></label>

									<input name="name" type="text"  class="form-control"     value="<?php echo stripslashes($editresult['firstName']); ?>">

				      </div> 

				      </div> 
					  
				<div class="col-md-6">

						<div class="form-group">

									<label>Last Name<span class="text-danger">*</span></label>

									<input name="lastName" type="text"  class="form-control"  value="<?php echo stripslashes($editresult['lastName']); ?>">

				      </div> 

				      </div>
					  
					  <div class="col-md-6" style="display:none;">

						<div class="form-group">

									<label>Gender</label>

									<select name="gender" class="form-control" id="gender">

	 

	<option value="Male" <?php if('Male'==$editresult['gender']){ ?>selected="selected"<?php } ?>>Male</option>

	<option value="Female" <?php if('Female'==$editresult['gender']){ ?>selected="selected"<?php } ?>>Female</option>

 

						  </select>

				      </div> 

				      </div>
			   

						       <div class="col-md-6">

						<div class="form-group">

									<label>Date of Birth </label>

									 		<input name="dob" type="date"  class="form-control"  value="<?php if(date('Y',strtotime($editresult['dob']))>'1970'){ echo date('Y-m-d',strtotime($editresult['dob'])); } else { echo date('Y/m/d'); } ?>">

				      </div> 

				      </div>
					  
					  <div class="col-md-6">

						<div class="form-group">

									<label>Passport </label>

									 		<input name="passportNumber" type="text"  class="form-control"  value="<?php echo stripslashes($editresult['passportNumber']); ?>">

				      </div> 

				      </div>

						
<div class="col-md-6">

						<div class="form-group">

									<label>Passport Expiry </label>

									 		<input name="passportExpiry" type="date"  class="form-control"  value="<?php if(date('Y',strtotime($editresult['passportExpiry']))>'1970'){ echo date('Y-m-d',strtotime($editresult['passportExpiry'])); } else { echo date('Y/m/d'); } ?>">

				      </div> 

				      </div>
					</div>

					

		   </div>



								

								

   </div><div class="modal-footer showflightbookingcancelaltion" >

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="saveaddcustomer">

							    <input name="editid" type="hidden" id="editid" value="<?php echo $_REQUEST['id']; ?>">
 

				  </div>

</form>

  
<?php } ?>

<?php if($_REQUEST['action']=='importcustomertobooking' ){  ?>
<div style="padding:4px 10px; background-color:#fff;">
<table border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td colspan="2">Please select according to order <strong style="color:#0066CC;">1st Adult (All) </strong>, <strong style="color:#CC3300;">2nd Child (All) </strong>, <strong  style="color:#FF9900;">3rd Infant (All)</strong></td>
    </tr>
  <tr>
    <td>Search</td>
    <td> 
      <input type="text" name="textfield" style="padding:5px 10px; background-color:#FFFFFF; border:1px solid #ddd; width:300px;" placeholder="Enter Keyword" id="loadimportcustomersearch" onkeyup="loadimportcustomers();" /> </td>
  </tr>
</table>

</div>
<div style="width:100%; max-height:400px; overflow:auto;" id="loadimportcustomers">

</div>

<script>
function loadimportcustomers(){
var loadimportcustomersearch = encodeURI($('#loadimportcustomersearch').val());
$('#loadimportcustomers').load('loadimportcustomers.php?keyword='+loadimportcustomersearch);
}

loadimportcustomers();
</script>

<?php } ?>






 <?php if($_REQUEST['action']=='viewbusVoucher' && $_REQUEST['i']!=''){ 
 
 $id=base64_encode(($_REQUEST['i']));
 $_REQUEST['i']=$id;
 
  
 
 
 ?>
 
 <div class="row">
					
					<div class="col-md-3">
						<div class="form-group"> 
							<select name="ticketaction" id="ticketaction" class="form-control" onchange="loadticket();" style="margin-bottom: 10px; font-size: 13px; margin-top: 5px;margin-bottom: 0px;-webkit-appearance: listbox !important"> 
								<option value="1">With Fare Voucher</option>
								<option value="2">Without Fare Voucher</option>  
								<option value="3">Without Company Info.</option>  
								<option value="4">Add Markup</option>
							</select>
						</div>
						
						<script>
					
						function loadticket(){
							var ta = $('#ticketaction').val();
							var markup = Number($('#markup').val());
						  $('.withoutfare').show();
									$('.hcompanyinfo').show();  
							if(ta!='' ){ 
								if(ta==2){
									$('.withoutfare').hide();  
								} 
								
								if(ta==3){
									$('.hcompanyinfo').hide();  
								} 
							
							} 
						}
					
					function loadticketwithmarkup(){
					
						var ta = Number($('#htotalamount').val());
						var markup = Number($('#markup').val());
						
						 
							$('#displayhtotalamount').text(Number(ta+markup));	
					
					
					}
					
					
					</script>
					</div> 
					<div class="col-md-2 addmrkp" style="display:none;">
						<div class="form-group " > 
							<input name="markup" type="number" placeholder="Markup" min="0" class="form-control" id="markup" value="0"  style="margin-bottom: 10px; font-size: 13px; margin-top: 5px;margin-bottom: 0px;">
						</div> 
					</div> 
					
					<div class="col-md-3 tomail" style="display:none;"> 
						<div class="form-group ">
							<label>To Mail</label> 
							<input name="to" type="text" min="0" class="form-control" id="to" value="">
						</div>
					</div>
					<div class="col-md-3 addmrkp" style="display:none;">
						<button type="button" class="btn btn-primary"  onclick="loadticketwithmarkup();" style="padding: 5px 10px; margin-top: 5px;">Apply Markup</button> 
					</div>
					 <div class="col-md-4 tomail" style="display:none;"><button type="submit" class="btn btn-primary" style="margin-top: 28px;" >Send to Mail</button></div>   
					</div>
					
					<hr />
 
<?php  include "bus-ticket.php"; ?>
  <script>
					
						function loadticket(){
							var ta = $('#ticketaction').val();
							var markup = Number($('#markup').val());
							if(ta!='' ){ 
								if(ta==4 && markup=='0'){
									$('.addmrkp').show();  
								}else{ 
									$('#markup').val('0');
									$('.addmrkp').hide();
									$('#loadticket').load('download_ticket.php?id=<?php echo $_REQUEST['id']; ?>&ta='+ta); 
								} 
							
							} 
						}
					
					function loadticketwithmarkup(){
				
						var ta = Number($('#htotalamount').val());
						var markup = Number($('#markup').val());
					 
						$('#displayhtotalamount').text(Number(ta+markup));
							 
					
					}
					
					
					</script>
 <?php } ?>
 
 
 
 <?php if($_REQUEST['action']=='stoptooltip' && $_REQUEST['id']!=''){
 $a=GetPageRecord('*','wig_flight_json_bkp',' agentId="'.$_SESSION['agentUserid'].'" and id="'.$_REQUEST['id'].'" ');
$res=mysqli_fetch_array($a);

$dd=unserialize(stripslashes($res['searchJson']));
$n=1;
foreach((array) $dd['sI'] as $layoverFlight){  ?>
  <div><?php echo stripslashes($layoverFlight['fD']['aI']['code']); ?>-<?php echo stripslashes($layoverFlight['fD']['fN']); ?> - <?php echo stripslashes($layoverFlight['da']['code']); ?> (<?php echo date('H:i',strtotime($layoverFlight['dt'])); ?>) &nbsp;<i class="fa fa-arrow-right" aria-hidden="true"></i> &nbsp;<?php echo stripslashes($layoverFlight['aa']['code']); ?> (<?php echo date('H:i',strtotime($layoverFlight['at'])); ?>)<?php if($n==1){ ?>, Dept. <?php echo stripslashes($layoverFlight['da']['terminal']); } ?></div>
  <?php $n++; } ?>
 
 
 <?php } ?>
 
 
 
 <?php if($_REQUEST['action']=='addflightbookingnote' && $_REQUEST['id']!=''){
 
	
 ?>

 <form action="<?php echo $fullurl; ?>frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 

 

			<div class="col-md-12">

					<div class="row">
 	  
					<div class="col-md-12">
					
					<div class="modal-body">

						<div class="form-group">

									<label>Note<span class="text-danger">*</span></label>

									<textarea name="details" rows="5" class="form-control" id="details"></textarea>

				      </div> 

				      </div> 
				      </div> 
					   
						
 
					</div>

					

		   </div>

 

	 <div class="modal-footer showflightbookingcancelaltion"> 

								 

								

								<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>

								  <input name="action" type="hidden" id="action" value="addflightbookingnote"> 
								  <input name="bookingid" type="hidden" id="bookingid" value="<?php echo $_REQUEST['id']; ?>">
 

				  </div>

</form>

  
<?php } ?>


<?php if($_REQUEST['action']=='addflightbookingamendments' && $_REQUEST['id']!=''){
 
	
 ?>

 <form action="<?php echo $fullurl; ?>flight-booking-amendments" method="get" enctype="multipart/form-data" name="addeditfrm"  id="addeditfrm"> 

 

			<div class="col-md-12">

					
					<div class="modal-body">
 	  <div class="row">
					<div class="col-md-6">

						<div class="form-group">

									<label>Booking Id <span class="text-danger">*</span></label>

									<input name="id" type="text" class="form-control" id="bookingid" value="<?php echo $_REQUEST['id']; ?>" readonly=""  />

				      </div> 

				      </div> 
					   <div class="col-md-6">

						<div class="form-group">

									<label>Amendment Type <span class="text-danger">*</span></label>
 <select name="amendmentType" id="amendmentType" class="form-control"  style="font-size: 13px; margin-top: 0px; margin-bottom: 0px; padding: 8px; -webkit-appearance: listbox !important;"> 
 	<option value="">Select</option>
								<option value="Ssr">Ssr</option>
								<option value="Cancellation Quotation">Cancellation Quotation</option>  
								<option value="Cancellation">Cancellation</option>  
								<option value="Full Refund">Full Refund</option>
								<option value="Reissue Quotation">Reissue Quotation</option>
								<option value="Re-Issue">Re-Issue</option>
								<option value="Miscellaneous">Miscellaneous</option>
								<option value="No Show">No Show</option>
								<option value="Void">Void</option>
								<option value="Correction">Correction</option>
								<option value="Custom">Custom</option> 
							</select>

				      </div> 

				      </div>
						
 
					</div>
					</div>

					

		   </div>

 


	 <div class="modal-footer showflightbookingcancelaltion"> 
								

								<button type="submit" class="btn btn-primary">Raise</button>
 
 

   </div>

</form>

  
<?php } ?>



<?php 
	if($_REQUEST['action']=='addpaymentrequest' ){
?>

<form action="<?php echo $fullurl; ?>frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm"> 
	<div class="modal-body" >	
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<label>Requested Amount<span class="text-danger">*</span></label>
						<input name="requestedAmount" type="number" class="form-control" value="0" required>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="form-group">
						<label>Payment Mode<span class="text-danger">*</span></label>
							<select name="paymentMode" class="form-control" >
								<option value="Cash">Cash</option>
								<option value="Cheque">Cheque</option>
								<option value="NEFT">NEFT</option>
								<option value="DD">DD</option>
								<option value="Credit">Credit</option>
							</select>
					</div>
				</div>
				 

				<div class="col-md-6">
					<div class="form-group">
						<label>Reference Number<span class="text-danger">*</span></label>
						<input name="referenceNumber" type="text"  class="form-control"  value="" required="">
					</div> 
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Attachment</label>
						<input name="attachment" type="file">
					</div> 
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label>Cheque Number<span class="text-danger">*</span></label>
						<input name="chequeNumber" type="text"  class="form-control"  value="" required="">
					</div> 
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Date<span class="text-danger">*</span></label>
						<input name="chequeDate" type="date"  class="form-control"  value="" required="">
					</div> 
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label>Bank<span class="text-danger">*</span></label>
						<input name="bank" type="text"  class="form-control"  value="" required="">
					</div> 
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label>Branch<span class="text-danger">*</span></label>
						<input name="branch" type="text"  class="form-control"  value="" required="">
					</div> 
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<label>Our Bank Account<span class="text-danger">*</span></label>
						<input name="account_number" type="text" placeholder="50200068661036"  class="form-control"  value="" required="" style="font-size:12px;">
					</div> 
				</div>

				
				<div class="col-md-12">
					<div class="form-group">
						<label>Bank Transaction ID<span class="text-danger">*</span></label>
						<input name="bank_transaction_id" type="text"  class="form-control"  value="" required="">
					</div> 
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<label>Remark </label>
						<textarea name="note" type="text"  class="form-control"></textarea>
					</div>
				</div>
			</div>
		</div>

		</div><div class="modal-footer showflightbookingcancelaltion"  >

		<button type="submit" class="btn btn-primary">Save &nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i></button>
		
		<input name="action" type="hidden" id="action" value="addpaymentrequest">
	</div>
</form>
<?php } ?>


<?php 
	if($_REQUEST['action']=='showflightdetails' && $_REQUEST['action']!='' ){
?>

	<div class="modal-body" >	
		<div class="col-md-12"> 
			<?php include "flightdetailsbox.php"; ?> 
			</div>
			</div>
<?php } ?>

 <?php if($_REQUEST['action']=='cancellationPolicy' && $_REQUEST['hotelid']!='' && $_REQUEST['roomid']!=''){
 
 $url = ''.$tripjackhotelurl.'hms/v1/hotel-cancellation-policy';
$bookingNumber = $HotelReviewDataArr->bookingId;
$jsonPost = '{
		"id":"'.$_REQUEST['hotelid'].'",
		"optionId":"'.$_REQUEST['roomid'].'"
}';
 
   $result = getHotelApiData($url,$jsonPost,$hotelApiKey);
$hotelData = json_decode($result);
 
 $values = $hotelData->cancellationPolicy->pd;
		 
		  
		  ?>
 <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC" style=" font-size:13px; font-weight:600;">
   <tr>
     <td bgcolor="#F4F4F4"><strong>From Date</strong></td>
     <td bgcolor="#F4F4F4"><strong>To Date</strong></td>
     <td bgcolor="#F4F4F4"><strong>Penalty amount</strong></td>
   </tr>
  <?php  foreach($values as $hotelList){ ?>
   <tr>
     <td style="border-bottom: 1px solid #ddd;"><?php echo $hotelList->fdt; ?></td>
     <td style="border-bottom: 1px solid #ddd;"><?php echo $hotelList->tdt; ?></td>
     <td style="border-bottom: 1px solid #ddd;">&#8377;<?php echo $hotelList->am; ?></td>
   </tr>
   <?php } ?>
 
</table>

<div style="margin-top:10px; color:#FF0000; font-size:12px; font-weight:600;"><?php echo $hotelData->cancellationPolicy->scnp; ?></div>
 <?php  } ?>
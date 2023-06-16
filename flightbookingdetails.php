<?php
include "inc.php"; 
include "config/logincheck.php";  
$selectedpage=''; 
$selectleft='bookings';
$selectintab='flight';


  if($_REQUEST['id']!=''){ 
$a=GetPageRecord('*','flightBookingMaster',' id="'.decode($_REQUEST['id']).'" and agentId="'.$_SESSION['agentUserid'].'" '); 
$rest=mysqli_fetch_array($a); 

$urs=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($urs); 
}

if($rest['pnrNo']==''){

echo 'You dont permission to view this page.';
exit();

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Flight Bookings - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title> 
<?php include "headerinc.php"; ?>

<style>
.card{ margin-bottom:10px; background-color: var(--white); box-shadow: 0px 10px 18px #29426917 !important; background-color:#fff !important;}
.card{margin-top: 15px;}
.acordian_heading{ font-size: 18px;}
.cart_acordian{ padding: 10px; border-bottom: 1px solid #ddd; font-size:14px;}
.cssCircle-plusdesign{font-size:13px !important;}
.minusSign{ display: none;}
.addsign{ position: absolute; right: 10px; top: 10px;}
.card-field--title{color:#666666;}
.card-field--detail{color:#000; font-weight: 600;}
.font-label-success{ color:#339900;  font-weight: 600;}
.note_list { background: #fff; display: flex; justify-content: space-between; border-radius: 6px; }
.note_list-content { width: 85%; overflow-y: auto; text-overflow: ellipsis; min-height: 100px; padding: 10px; background: #f2f2f2; margin-bottom: 10px; border-radius: 6px; margin-right: 10px; }
.note_list-content.showToAll { background: #ffffa7; }
.note_list-details { color: #686868; background: #ebf6fa; padding: 10px; margin-bottom: 10px; width: 15%; }
.cart_amend-details { border: 1px solid #e5e5e5; min-height: 100px; padding: 5px 0; margin-top: 15px; border-radius: 6px; margin-left: 0; margin-right: 0; transition: 0.25s ease all; }
.amend-highlight { background: #e6f6fc; position: relative; box-shadow: 0 3px 20px rgba(97, 89, 89, 0.5); }
.amend-highlight { border-left: 3px solid #ffb900 !important; padding: 10px; margin: 10px; }
.segment_body { display: flex; display: -webkit-flex; display: -moz-flex; align-items: center; -webkit-align-items: center; -moz-align-items: center; padding: 10px; background-color: #f4f7f8; width: 100%; flex-wrap: wrap; box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14); border-radius: 6px; margin-bottom: 5px; }
.amend-highlight { border-left: 3px solid #ffb900 !important; }
.segment_details-content { padding: 0 15px; background: #fff; margin-bottom:10px; margin-top:10px; }
.input-floating-lebel { font-size: 13px; padding: 13.5px 0; border: none; border-bottom: solid 1px #e5e5e5; width: 100%; box-sizing: border-box; transition: all 0.3s linear; color: #333; font-weight: 400; -webkit-appearance: none; -moz-appearance: none; -o-appearance: none; border-radius: 0; background: transparent; }
.floating-label { position: relative; margin-bottom: 10px; height: 50px; }
.floating-label .input-floating-lebel:not(:placeholder-shown) { padding: 22px 0px 5px 0px; }
.amend_passenger_details { position: relative; background: #f2f1f1; border-radius: 6px; display: inline-block; width: 100%; padding: 5px; }
.amend_passenger_details .bold { font-weight: 500; }
.hoverInfo_content { display: none; position: absolute; top: 45px; right: 15px; z-index: 1; background: #8e8e8e; color: #fff; padding: 5px; border: 1px solid #dcdcdc; min-width: 165px; animation-name: bounceIn; animation-duration: 450ms; animation-timing-function: linear; animation-fill-mode: forwards; box-shadow: 0 1px 4px 0 rgb(0 0 0%); font-weight: 500; }
.hoverInfo:hover .hoverInfo_content { display: block; }
.hover_icon { color: var(--secondary-color); cursor: pointer; width: 20px; height: 20px; text-align: center; }
.segment_body .segment_body-airlogo { display: flex; display: -webkit-flex; display: -moz-flex; align-items: center; -webkit-align-items: center; -moz-align-items: center; width: 20%; text-align: center; }
.segment_body .segment_body-flight-info { width: 33%; text-align: center; }
.segment_body-flight-stop { width: 8%; text-align: center; }
.floating-label label { position: absolute; top: 0px; left: -4px; font-size:10px; opacity: 1; height: 0; z-index: 0; font-weight: 400; color: #555;  }
.collapsable{ display:none;}
.hoverInfo_content-detail { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #9a9a9a; padding: 2px; }

.hoverInfo_content-detail .mg_right-50 { margin-bottom: 3px; width: 60%; float: left; }
.hoverInfo_content-detail .price-width-left { margin-bottom: 3px; width: 40%; float: left; display: inline-table; margin-left: 20px; }
.hoverInfo{position: absolute;
    right: 10px;
    bottom: 10px;}
.airline-logo { margin-right: 8px; width: 30px; }
.segment_body .airline-code { display: block; font-size: 12px; text-align: center; color: #4e4949; margin: 0; }
.segment_body-flight-stop .via-city-codes { font-size: 10px; }
.segment_body-flight-stop .arrow_right-sm { width: 100%; margin: 0; background: #ccc; }
.arrow_right-sm:before { content: ''; position: absolute; height: 8px; top: -6px; width: 2px; background: #004684; right: 3px; transform: rotate(135deg); }
.segment_body-flight-stop .arrow_right-sm:before { background: #ccc; }
.arrow_right-sm:after { content: ''; position: absolute; height: 8px; top: 0; width: 2px; background: #004684; right: 3px; transform: rotate(45deg); }
.segment_body-flight-stop .arrow_right-sm:after { background: #ccc; }

.margin-zero { margin: 0; }
.amend_details-passengers--list { background: #fff; box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14); margin: 10px 0px 0; position: relative; padding: 10px; border-radius: 6px; }

p { margin-top: 0; margin-bottom:2px; }



</style>
</head>

<body class="greyouter">
  <?php include "header.php"; ?>



<!--------------Left Menu---------------->


<?php include "left.php"; ?>





<!--------------Mid Body---------------->


<section class="profile">
        <div class="listcontent">
 
                     <div class="main_container"  style="padding:1px 10px;" >
    <div class="info_main">
        <div class="card">
            <div class="cart_acordian">
                <h3 class="acordian_heading">Booking  Information : <?php echo encode($rest['id']); ?></h3>
          <div class="cssCircle addsign"><span class="cssCircle-plusdesign"><a href="#" style="color:#2196fc; font-weight:600;" onClick="loadpop('View Ticket',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewTicket&id=<?php echo encode($rest['id']); ?>"><i class="fa fa-file-text-o" aria-hidden="true"></i> Ticket</a></span>
		  &nbsp;&nbsp;&nbsp;
		  <span class="cssCircle-plusdesign"><a onClick="loadpop('Flight Invoice (<?php echo encode($rest['id']); ?>)',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewInvoice&id=<?php echo encode($rest['id']); ?>&invtype=flight" style="cursor:pointer; color:#2196fc; font-weight:600;" ><i class="fa fa-print" aria-hidden="true"></i> Invoice</a></span>
		  </div>
                <div class="cssCircle minusSign"> </div>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-4 col-xs-6">
                        <div class="card-field">
                            <p class="card-field--title">Booking Id :<span class="card-field--detail"><span>
                                        &nbsp;<?php echo encode($rest['id']); ?></span></span></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <div class="card-field">
                            <p class="card-field--title">Amount :<span class="card-field--detail"><span>
                                        &nbsp;₹&nbsp;<?php echo stripslashes($rest['agentTotalFare']); ?></span></span></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <div class="card-field">
                            <p class="card-field--title">Status :<span class="font-label-success"><span>
                                        &nbsp;Success</span></span></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <div class="card-field">
                            <p class="card-field--title">Order Type :<span class="card-field--detail"><span>
                                        &nbsp;Air</span></span></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <div class="card-field">
                            <p class="card-field--title">Channel Type :<span class="card-field--detail"><span>
                                        &nbsp;Desktop</span></span></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <div class="card-field">
                            <p class="card-field--title">CreatedOn :<span class="card-field--detail"><span>
                                        &nbsp;<?php echo date('j F Y h:i A', strtotime($rest['bookingDate'])); ?></span></span></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <div class="card-field">
                            <p class="card-field--title">Flow Type :<span class="card-field--detail"><span>
                                        &nbsp;Online</span></span></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <div class="card-field">
                            <p class="card-field--title">Booking Date :<span class="card-field--detail"><span>
                                        &nbsp;<?php echo date('j F Y h:i A', strtotime($rest['bookingDate'])); ?></span></span></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <div class="card-field">
                            <p class="card-field--title">Agent Email :<span class="card-field--detail"><span>
                                        &nbsp;<?php echo stripslashes($agentData['email']); ?></span></span></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <div class="card-field">
                            <p class="card-field--title">Agent Contact :<span class="card-field--detail"><span> &nbsp;<?php echo stripslashes($agentData['phone']); ?></span></span></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-6">
                        <div class="card-field"><a href="#" style="color:#2196fc; font-weight:600;" onClick="loadpop('View Ticket',this,'900px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=viewTicket&id=<?php echo encode($rest['id']); ?>">Booking Summary</a></div>
                    </div>
                     
                     
                </div>
            </div>
        </div>
    </div>
    <div class="card cart_notes">
        <div class="cart_acordian">
            <h3 class="acordian_heading">Notes<span class="ball__mainwrapper"><span class="ball__border info_length-blue"></span></span>
            </h3>
            <div class="cssCircle addsign"><span class="cssCircle-plusdesign"><a href="#" style="color:#2196fc; font-weight:600;" onClick="loadpop('Add Notes',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addflightbookingnote&id=<?php echo encode($rest['id']); ?>">+ Add Notes</a></span></div>
            <div class="cssCircle minusSign"><span><i class="fa fa-angle-down"></i></span></div>
        </div>
		<?php
		$rs6=GetPageRecord('*','flightBookingNotes',' bookingId	="'.$rest['id'].'"  order by id desc '); 
		while($notesdata=mysqli_fetch_array($rs6)){
		
		$a=GetPageRecord('*','sys_userMaster',' id="'.$notesdata['agentId'].'" '); 
		$noteagent=mysqli_fetch_array($a); 
		?>
        <div class="card-body notes_container hidden">
            <div class="note_list">
                <div class="note_list-content showToAll">
                    <p style="font-size: 14px; color: #000;"><?php echo nl2br(stripslashes($notesdata['details'])); ?></p>
                </div>
                <div class="note_list-details">
                    <p><?php echo date('j F Y h:i A', strtotime($notesdata['addDate'])); ?></p>
                    <p><?php echo stripslashes($notesdata['noteType']); ?></p>
                    <p><?php echo $noteagent['name']; ?> <?php echo $noteagent['lastName']; ?> (<?php echo makeAgentId($noteagent['agentId']); ?>)</p>
                </div>
            </div>
             
             
        </div>
		<?php $n=1; } ?>
		<?php if($n!=1){?>
		<div style="padding:20px; text-align:center;">This booking don't have any note!</div>
		<?php } ?>
		
		
    </div>
    <div class="card cart_amend">
        <div class="cart_acordian">
            <h3 class="acordian_heading">Amendments<span class="ball__mainwrapper"><span class="ball__border info_length-green"></span></span>
            </h3>
            <div class="cssCircle addsign"><span class="cssCircle-plusdesign"><a href="#" style="color:#2196fc; font-weight:600;" onClick="loadpop('Raise Amendments',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addflightbookingamendments&id=<?php echo encode($rest['id']); ?>">+ Raise Amendments</a></span></div>
            <div class="cssCircle minusSign"><span><i class="fa fa-angle-down"></i></span></div>
        </div>
        <div class="col-md-12 ">
		<?php
		$b=0;
		$rs6=GetPageRecord('*','flightAmendments',' bookingId="'.$rest['id'].'"  order by id desc '); 
		while($amd=mysqli_fetch_array($rs6)){
		
		$a=GetPageRecord('*','sys_userMaster',' id="'.$amd['addBy'].'" '); 
		$noteagent=mysqli_fetch_array($a); 
		
		$b=GetPageRecord('*','sys_userMaster',' id="'.$amd['assignedUser'].'" '); 
		$assigneduser=mysqli_fetch_array($b); 
		?>
            <div class="row cart_amend-details amend-highlight">
                <div class="col-md-3 col-sm-3 amend_list ">
                    <div class="card-field">
                        <p class="card-field--title">Generation Time : <span class="card-field--detail"><?php echo date('j F Y h:i A', strtotime($amd['generationTime'])); ?></span></p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 amend_list current-amend">
                    <div class="card-field">
                        <p class="card-field--title">Amendment Id : <span class="card-field--detail"><?php echo encode($amd['id']); ?></span></p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 amend_list">
                    <p class="card-field--title">Assigned User : <span class="card-field--detail"><?php echo $assigneduser['name']; ?> <?php echo $assigneduser['lastName']; ?></span></p>
                </div>
                <div class="col-md-3 col-sm-3 amend_list ">
                    <div class="card-field">
                        <p class="card-field--title">Status : <span class="card-field--detail">Success</span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 amend_list ">
                    <div class="card-field">
                        <p class="card-field--title">Processed Time : <span class="card-field--detail"><?php if(date('Y', strtotime($amd['processedTime']))>2000){ echo date('j F Y h:i A', strtotime($amd['processedTime'])); } else { echo '-'; }  ?></span></p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 amend_list">
                    <p class="card-field--title">Raised By : <span class="card-field--detail"><?php echo $noteagent['name']; ?> <?php echo $noteagent['lastName']; ?> (<?php echo makeAgentId($noteagent['agentId']); ?>)</span></p>
                </div>
                <div class="col-md-3 col-sm-3 amend_list ">
                    <div class="card-field">
                        <p class="card-field--title">Remarks : <span class="card-field--detail"><?php echo (stripslashes($amd['remarkDetails'])); ?></span></p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 amend_list ">
                    <div class="card-field">
                        <p class="card-field--title">Type : <span class="card-field--detail"><?php echo (stripslashes($amd['amendmentType'])); ?></span></p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 amend_list ">
                    <div class="card-field">
                        <p class="card-field--title">NextTravelDate : <span class="card-field--detail"><?php if(date('Y', strtotime($amd['nextTravelDate']))>2000){ echo date('j F Y', strtotime($amd['nextTravelDate'])); } else { echo '-'; }  ?></span></p>
                    </div>
                </div>
				
				<div class="col-md-9 col-sm-3 amend_list ">
                    <div class="card-field">
                        <p class="card-field--title">Passenger: <span class="card-field--detail">
						<?php
						 
$string = preg_replace('/\.$/', '', $amd['selectedPax']); //Remove dot at end if exists
$array = explode(',', $string); //split string into array seperated by ', '
foreach($array as $value) //loop over values
{
						
							$rs6a=GetPageRecord('*','flightBookingPaxDetailMaster',' id="'.$value.'"  order by id asc '); 
		while($pass=mysqli_fetch_array($rs6a)){ ?>
		<?php echo $pass['title']; ?>&nbsp;<?php echo $pass['firstName']; ?>&nbsp;<?php echo $pass['lastName']; ?> (<?php echo ucfirst($pass['paxType']); ?>), 
		<?php } } ?>
						
						</span></p>
                    </div>
                </div>
            </div>
			<?php $b=1; } ?>
			
				<?php if($b!=1){?>
		<div style="padding:20px; text-align:center;">This booking don't have any amendments!</div>
		<?php } ?>
        </div>
    </div>
    <div class="cart__info__container">
        <div class="card cart_amend-passenger">
            <div class="cart_acordian">
                <h3 class="acordian_heading">Booking Details</h3>
                <div class="cssCircle minusSign"><span><i class="fa fa-angle-up"></i></span></div>
            </div>
            <div class="cart_segment">
                <div class="amend_details-passengers">
                    <div class="segment_details-content">
                        <div class="segment_body bookingDetails_body">
                            <div class="segment_body-airlogo"><img class="airline-logo" src="<?php echo $imgurl.getflightlogo(stripslashes($rest['flightName'])); ?>">
                                <p class="margin-zero" style="text-align:left;"><?php echo $rest['flightName']; ?><span class="airline-code" style="text-align:left;"><?php echo $rest['flightCode']; ?>-<?php echo $rest['flightNo'];

$src=explode("-",$rest['source']);
$a=GetPageRecord('*','flightDestinationMaster','airportCode="'.$src[1].'"  '); 
$dep=mysqli_fetch_array($a);

								
								 ?></span></p>
                            </div>
                            <div class="segment_body-flight-info">
                                <p class="margin-zero"><?php echo $dep['country']; ?>, <?php echo $dep['airportDescription']; ?> - <?php echo $dep['airportCode']; ?>
                                     </span></p>
                                <p class="margin-zero"><?php echo $rest['departureTime']; ?>, <?php echo date('D, d F Y',strtotime($rest['journeyDate'])); ?></p>
                            </div>
                            <div class="segment_body-flight-stop"><span class="via-city-codes"><?php echo $rest['flightStop']; ?> Stop(s)</span>
                                <div class="arrow_right-sm"><?php echo $layoverFlight->DURATION;
								
								$src=explode("-",$rest['destination']);
$a=GetPageRecord('*','flightDestinationMaster','airportCode="'.$src[1].'"  '); 
$dep=mysqli_fetch_array($a);
								 ?></div>
                            </div>
                            <div class="segment_body-flight-info">
                                <p class="margin-zero"><?php echo $dep['country']; ?>, <?php echo $dep['airportDescription']; ?> - <?php echo $dep['airportCode']; ?></span></p>
                                <p class="margin-zero"><?php echo $rest['arrivalTime']; ?>, <?php echo date('D, d F Y',strtotime($rest['arrivalDate'])); ?></p>
                            </div>
                        </div>
                        <div>
                            <form>
							
							
							
							
							<?php
							$rs6to=GetPageRecord('count(id) as totalpass','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'" and firstName!="" '); 
				$totalpaxData=mysqli_fetch_array($rs6to);
				$_REQUEST['tp']=$totalpaxData['totalpass'];
							
							$n=1;
		$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'"   and firstName!="" '); 
		while($paxData=mysqli_fetch_array($rs6)){ 
		?>
							
                                <div>
                                    <div class="amend_details-passengers--list">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="amend_passenger_details"><span>Last Name/First Name
                                                        Title</span>
                                                    <p class="bold person-name clearfix"><span class="pull-left"><?php echo $n; ?>.
                                                            <?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?> (<?php echo ucfirst($paxData['paxType']); ?>)</span> <span class="pull-right">
                                                            </span></p> 
                                                        <p></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 passenger_faredetail">
                                                <div class="row">
                                                    <div class="col-sm-2 col-xs-6 padd-left-amendment">
                                                        <fieldset class="floating-label">
                                                            <div class="floating-label-wrapper">
                                                                <div class="[object Object] ">
                                                                    <fieldset class="floating-label"><input readonly="" type="text" placeholder="Base Fare" class="input-floating-lebel" id="undefined_" name="16133326_0_BF" min="0" value="₹&nbsp;<?php echo number_format(round(($rest['agentBaseFare']+$rest['agentFixedMakup'])/$_REQUEST['tp'])); ?>"><label for="undefined_" class="select-lebel-class">Base Fare</label>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-sm-2 col-xs-6 padd-left-amendment">
                                                        <fieldset class="floating-label">
                                                            <div class="floating-label-wrapper">
                                                                <div class="[object Object] ">
                                                                    <fieldset class="floating-label"><input readonly="" type="text" placeholder="Taxes" class="input-floating-lebel" id="undefined_" name="16133326_0_TAF" min="0" value="₹ <?php echo number_format(round((($rest['tax']/$_REQUEST['tp'])+$rest['agentMarkup']/$_REQUEST['tp']))); ?>">
                                                                    <label for="undefined_" class="select-lebel-class">Taxes</label>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-sm-2 col-xs-6">
                                                        <fieldset class="floating-label">
                                                            <div class="floating-label-wrapper">
                                                                <div class="[object Object] ">
                                                                    <fieldset class="floating-label"><input type="text" readonly=""  placeholder="Airline PNR" class="input-floating-lebel" id="undefined_" name="16133326_0_PNR" min="0" value="<?php echo $rest['pnrNo']; ?>"><label for="undefined_" class="select-lebel-class">Airline
                                                                            PNR</label></fieldset>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                     
                                                    <div class="col-sm-2 col-xs-6">
                                                        <fieldset class="floating-label">
                                                            <div class="floating-label-wrapper">
                                                                <div class="[object Object] ">
                                                                    <fieldset class="floating-label"><input type="text" readonly=""  class="input-floating-lebel" id="undefined_" name="16133326_0_tknum" min="0" value="<?php echo $paxData['ticketNo']; ?>">
                                                                    <label for="undefined_" class="select-lebel-class">Ticket
                                                                            Number</label></fieldset>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-sm-2 col-xs-6 padd-left-amendment">
                                                        <fieldset class="floating-label">
                                                            <div class="floating-label-wrapper">
                                                                <div class="[object Object] ">
                                                                    <fieldset class="floating-label"><input readonly="" type="text" placeholder="Commision" class="input-floating-lebel" id="undefined_" name="16133326_0_commision" min="0" value="₹&nbsp;<?php echo round($rest['agentCommision']/$_REQUEST['tp']); ?>"><label for="undefined_" class="select-lebel-class">Commision</label>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-sm-2 col-xs-6 padd-left-amendment">
                                                        <fieldset class="floating-label">
                                                            <div class="floating-label-wrapper">
                                                                <div class="[object Object] ">
                                                                    <fieldset class="floating-label"><input readonly="" type="text" placeholder="Net Fare" class="input-floating-lebel" id="undefined_" name="16133326_0_NF" min="0" value="₹&nbsp;<?php echo number_format(round(round(($rest['agentTotalFare']+$rest['agentFixedMakup'])/$_REQUEST['tp'])+($_REQUEST['markup']))-$rest['agentCommision']); ?>"><label for="undefined_" class="select-lebel-class">Net Fare</label>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-sm-2 col-xs-6 padd-left-amendment">
                                                        <fieldset class="floating-label">
                                                            <div class="floating-label-wrapper">
                                                                <div class="[object Object] ">
                                                                    <fieldset class="floating-label"><input readonly="" type="text" placeholder="Gross Fare" class="input-floating-lebel" id="undefined_" name="16133326_0_TF" min="0" value="<?php echo number_format(round(round(($rest['agentTotalFare']+$rest['agentFixedMakup'])/$_REQUEST['tp'])+($_REQUEST['markup']))); ?>"><label for="undefined_" class="select-lebel-class">Gross
                                                                            Fare</label></fieldset>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-sm-2 col-xs-6 padd-left-amendment">
                                                        <fieldset class="floating-label">
                                                            <div class="floating-label-wrapper">
                                                                <div class="[object Object] ">
                                                                    <fieldset class="floating-label"><input   class="input-floating-lebel" type="text" name="16133326_0_cc" readonly="" value="<?php if($rest['fareClass']==''){ echo 'ECONOMY'; } else { echo $rest['fareClass']; } ?>">
                                                                    <label for="">Cabin Class</label></fieldset>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-sm-2 col-xs-6">
                                                        <fieldset class="floating-label">
                                                            <div class="floating-label-wrapper">
                                                                <div class="[object Object] ">
                                                                    <fieldset class="floating-label"><input  class="input-floating-lebel" type="text" name="16133326_0_rT" readonly="" value="<?php if($rest['refundyes']==1){ echo 'Refundable'; } else { echo 'Non-Refundable'; } ?>"><label for="">Refundable</label></fieldset>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                          
                                        </div>
                                    </div>
                                 
								
								<?php $n++; } ?>
								
								
								
								
                           
                                <div>
                                     
                                </div>
                                <div class="segmentSubmitBtn"></div>
                            </form>
                        </div>
                    </div>
                     
                </div>
            </div>
        </div>
    </div>
    
    <div class="info_main">
        <div class="card">
            <div class="cart_acordian">
                <h3 class="acordian_heading">Payment Process </h3>
                <div class="cssCircle minusSign"><i class="fa fa-angle-down"></i></div>
            </div>
            <div class="card-body hidden">
                <table class="table balancesheettable" style=" margin-bottom:0px;">
							<thead>
								<tr style="background-color: #f6f6f6;">
								  <th align="left" bgcolor="#F7F7F7">Date</th>
								  <th align="left" bgcolor="#F7F7F7">Reference No.</th>
								  <th align="left" bgcolor="#F7F7F7">Description</th>
								  <th align="center" bgcolor="#F7F7F7"><div align="center">Method</div></th>
								  <th align="right" bgcolor="#F7F7F7"><div align="right">Credit</div></th>
								  <th align="right" bgcolor="#F7F7F7"><div align="right">Debit</div></th>
							    </tr>
							</thead>
							<tbody> 
<?php
$search='';
if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}

if($_REQUEST['keyword']!=''){
$search.=' and  (bookingId like "%'.decode($_REQUEST['keyword']).'%" ) ';
}
							
$totalCreditAmt=0;
$totalDebitAmt=0;
$balance=0;
								
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1;
  
$targetpage='balance-sheet?view=1&agentCategory='.$_REQUEST['agentCategory'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 

$rs=GetRecordList('*','sys_balanceSheet',' where 1 '.$search.' and agentId="'.$_SESSION['agentUserid'].'" and bookingId="'.$rest['id'].'" and (bookingType="flight" or bookingType="flight_commision" or bookingType="flight_GST" or bookingType="RejectBankRefund"  or bookingType="TDS")   order by id desc  ','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($agentWebsitePages=mysqli_fetch_array($rs[0])){ 
if($agentWebsitePages['amount']>0){
	
//Opening Balance Debit Amount
$openBalDebited=GetPageRecord('SUM(amount)','sys_balanceSheet',' agentId="'.$agentWebsitePages['agentId'].'" and paymentType="Debit" and id<="'.$agentWebsitePages["id"].'" order by id asc'); 
$openBalDebitedData=mysqli_fetch_array($openBalDebited);
$openBalDebitedAmount = $openBalDebitedData["SUM(amount)"];


//Opening Balance Credit Amount
$openBalCredited=GetPageRecord('SUM(amount)','sys_balanceSheet',' agentId="'.$agentWebsitePages['agentId'].'" and paymentType="Credit" and id<="'.$agentWebsitePages["id"].'" order by id asc'); 
$openBalCreditedData=mysqli_fetch_array($openBalCredited);
$openBalCreditedAmount = $openBalCreditedData["SUM(amount)"];
$balance = round($openBalCreditedAmount-$openBalDebitedAmount);	
	

$totalDebit+=$openBalDebitedAmount;

$totalCredit+=$openBalCreditedAmount;

?>
<tr>
	<td align="left" valign="top"><?php echo date('l d M Y h:i A', strtotime($agentWebsitePages['addDate'])); ?></td>
	<td align="left" valign="top"> 
	<?php if($agentWebsitePages['transactionId']!=''){ ?><strong><?php echo $agentWebsitePages['transactionId']; ?></strong><?php } else { ?>
	
	
	
	<?php if($agentWebsitePages['bookingId']>0 && $agentWebsitePages['bookingType']=='flight'){
	$b=GetPageRecord('*','flightBookingMaster','id="'.$agentWebsitePages['bookingId'].'" '); 
	$getflightbookingdata=mysqli_fetch_array($b); 
	?>
	<strong><?php echo encode($getflightbookingdata['id']); ?></strong>  
	<?php } ?>
	<?php if($agentWebsitePages['bookingType']=='flight_commision'  || $agentWebsitePages['bookingType']=='flight_GST' || $agentWebsitePages['bookingType']=='RejectBankRefund' || $agentWebsitePages['bookingType']=='TDS'){ ?>
	<strong><?php echo encode($agentWebsitePages['bookingId']); ?></strong>  
	<?php } ?>
	
	<?php if( $agentWebsitePages['bookingType']=='bus'){ ?>
	<strong><?php echo encode($agentWebsitePages['bookingId']); ?></strong>  
	<?php } ?>
	<?php if($agentWebsitePages['bookingType']=='hotel'||  $agentWebsitePages['bookingType']=='hotel_GST' || $agentWebsitePages['bookingType']=='hotel_commision' || $agentWebsitePages['bookingType']=='TDS' || $agentWebsitePages['bookingType']=='hotelTDS'){ 
	
	$b=GetPageRecord('*','hotelBookingMaster','BookingNumber="'.$agentWebsitePages['bookingId'].'" '); 
	$gethotelbookingdata=mysqli_fetch_array($b); 
	?>
	<strong><?php echo encode($gethotelbookingdata['id']); ?></strong>  
	<?php } ?><?php } ?>	</td>
	<td align="left" valign="top">
	 <?php if($agentWebsitePages['paymentMethod']!=''){ ?>
	<strong><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Wallet Recharge</strong>
	<?php } else { ?>
 
	
	<?php if($agentWebsitePages['bookingType']=='Facilitating' || $agentWebsitePages['bookingType']=='Facilitating_GST'){?>
	
	<?php if($agentWebsitePages['bookingType']=='Facilitating'){ ?>
	<strong style="color:#CC0000;">Facilitating Charges</strong>
	<?php } ?>
	<?php if($agentWebsitePages['bookingType']=='Facilitating_GST'){ ?>
	<strong style="color:#CC0000;">18% GST on Facilitating Charges</strong>
	<?php } ?>
	
	
	<?php } else { ?>
	
	
	
	<?php if( $agentWebsitePages['bookingType']=='flight_GST' || $agentWebsitePages['bookingType']=='flight_commision' || $agentWebsitePages['bookingType']=='TDS' || $agentWebsitePages['bookingType']=='hotel_GST' || $agentWebsitePages['bookingType']=='hotel_commision' || $agentWebsitePages['bookingType']=='hotelTDS' || $agentWebsitePages['bookingType']=='hotelMarkup'){ ?>
	
		
	<?php if($agentWebsitePages['bookingType']=='flight_commision'){ echo '<strong>Flight commission return after detect 18% GST</strong>'; } ?>
	<?php if($agentWebsitePages['bookingType']=='TDS'){ echo '<strong>Flight TDS dedection 5%</strong>'; } ?>
	
	
	 
	 
	<?php if($agentWebsitePages['bookingType']=='hotel_commision'){ echo '<strong>Hotel commission return after detect 18% GST</strong>'; } ?>
	<?php if($agentWebsitePages['bookingType']=='hotelTDS'){ echo '<strong>Hotel TDS dedection 5%</strong>'; } ?>
	
	
	
	
	<?php  } else { ?>
	<?php if($agentWebsitePages['bookingId']>0 && $agentWebsitePages['bookingType']=='flight'){
	$b=GetPageRecord('*','flightBookingMaster','id="'.$agentWebsitePages['bookingId'].'" '); 
	$getflightbookingdata=mysqli_fetch_array($b);
	?>
	Flight: <strong><?php echo stripslashes($getflightbookingdata['flightName']); ?> <?php echo stripslashes($getflightbookingdata['flightNo']); ?></strong><br>
	Destination: <strong><?php echo stripslashes($getflightbookingdata['source']); ?> > <?php echo stripslashes($getflightbookingdata['destination']); ?></strong><br>
	Fare Type: <strong><?php  echo getfaretypedisplayname(stripslashes($getflightbookingdata['flightName']),stripslashes($getflightbookingdata['pcc']));  ?></strong></strong><br>
	Class: <strong><?php echo stripslashes($getflightbookingdata['flightClass']); ?></strong>
	<?php } else { 
	
	if($agentWebsitePages['billType']=='hotel'){
	?>
	Hotel: <strong><?php echo $gethotelbookingdata['HotelName']; ?></strong> <br>
City: <strong><?php echo $gethotelbookingdata['Destination']; ?></strong><br>
Check-In: <strong><?php echo date('d-m-Y',strtotime($gethotelbookingdata['CheckIn'])); ?></strong><br>
Check-Out: <strong><?php echo date('d-m-Y',strtotime($gethotelbookingdata['CheckOutDate'])); ?></strong>
 
 							   
<?php }
if($agentWebsitePages['billType']=='bus'){

$b=GetPageRecord('*','busbookingMaster','id="'.$agentWebsitePages['bookingId'].'" '); 
	$busdata=mysqli_fetch_array($b);
if($busdata['ticket_no']!=''){
 ?>
Ticket No.: <strong><?php echo $busdata['ticket_no']; ?></strong><br>
From: <strong><?php echo $busdata['from_city']; ?></strong><br>
To: <strong><?php echo $busdata['to_city']; ?></strong><br>
Date: <strong><?php echo date('d-m-Y',strtotime($busdata['booking_date'])); ?></strong>
	 
 
 
 							   
<?php
} 
}
 } ?><?php } ?>

<?php if($agentWebsitePages['bookingType']=='Markup'){ ?><span style="color:#339900; font-weight:600;"><?php echo 'Flight Markup'; ?></span><?php } ?>
<?php if($agentWebsitePages['bookingType']=='hotelMarkup'){ ?><span style="color:#339900; font-weight:600;"><?php echo 'Hotel Markup'; ?></span><?php } ?>
<?php } ?>

<?php if($agentWebsitePages['bookingType']=='RejectBankRefund'){ ?> <strong><?php if($agentWebsitePages['remarks']!=''){ ?><div style="font-size:12px; color:#666666;"><?php echo $agentWebsitePages['remarks']; ?></div><?php } ?></strong> <?php }  ?>
 
<?php } ?>
<?php if($agentWebsitePages['remarks']!=''){ ?><div style="font-size:12px; color:#666666;"><?php echo $agentWebsitePages['remarks']; ?></div><?php } ?></td>
	<td align="center" valign="top"><div align="center">
	
	
	
	<?php if($agentWebsitePages['paymentType']=='Credit'){ ?> 
	<span class="badge badge-dark"><?php echo strip($agentWebsitePages['paymentMethod']); ?></span>
	<?php } else { ?>
 
	<span class="badge badge-primary">Wallet</span>
	<?php } ?>	
	
	
								  
	</div></td>
	<td align="right" valign="top"><div align="right">
	<?php if($agentWebsitePages['paymentType']=='Credit'){ $totalCreditAmt+=$agentWebsitePages['amount']; ?>
	<?php echo strip($agentWebsitePages['amount']); ?> INR
	<?php } ?>
	</div></td>
	<td align="right" valign="top"><div align="right">
	<?php if($agentWebsitePages['paymentType']=='Debit'){ $totalDebitAmt+=$agentWebsitePages['amount']; ?>
	<?php echo strip($agentWebsitePages['amount']); ?> INR
	<?php } ?>
	</div></td>
	</tr>
								
								<?php } } ?>
								 
							</tbody>
			    </table>
            </div>
        </div>
    </div>
</div>
  
   
        </div>
    </section>




<!-- HTML -->




  <?php include "footerinc.php"; ?>

</body>
</html>

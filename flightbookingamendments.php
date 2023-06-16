<?php
include "inc.php"; 
include "config/logincheck.php";  
$selectedpage=''; 
$selectleft='bookings';
$selectintab='flight';

if($_REQUEST['amendmentType']=='Ssr' || $_REQUEST['amendmentType']=='Cancellation Quotation' || $_REQUEST['amendmentType']=='Cancellation' || $_REQUEST['amendmentType']=='Full Refund' || $_REQUEST['amendmentType']=='Reissue Quotation' || $_REQUEST['amendmentType']=='Re-Issue' || $_REQUEST['amendmentType']=='Miscellaneous' || $_REQUEST['amendmentType']=='No Show' || $_REQUEST['amendmentType']=='Void' || $_REQUEST['amendmentType']=='Correction' || $_REQUEST['amendmentType']=='Custom'){

} else {

echo 'You dont permission to view this page.';
exit();


}


 $leftpageselect=4;

  $page='1';
  
  
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
$src=explode("-",$rest['source']);
$a=GetPageRecord('*','flightDestinationMaster','airportCode="'.$src[1].'"  '); 
$dep=mysqli_fetch_array($a);


	$src=explode("-",$rest['destination']);
$a=GetPageRecord('*','flightDestinationMaster','airportCode="'.$src[1].'"  '); 
$arr=mysqli_fetch_array($a);
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
.acordian_heading{ font-size: 18px;}
.cart_acordian{ padding: 10px; border-bottom: 1px solid #ddd;}
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
.segment_body { display: flex; display: -webkit-flex; display: -moz-flex; align-items: center; -webkit-align-items: center; -moz-align-items: center; padding: 10px; background-color: #f4f7f8; width: 100%; flex-wrap: wrap; box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14); border-radius: 6px; margin-bottom: 5px; }
.amend-highlight { border-left: 3px solid #ffb900 !important; }
.segment_details-content { padding: 0 15px; background: #fff; margin-bottom:10px; margin-top:15px; }
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
.segment_body-flight-stop .arrow_right-sm { width: 100%; margin: 0; background: #ccc; display:none; }
.arrow_right-sm:before { content: ''; position: absolute; height: 8px; top: -6px; width: 2px; background: #004684; right: 3px; transform: rotate(135deg); }
.segment_body-flight-stop .arrow_right-sm:before { background: #ccc; }
.arrow_right-sm:after { content: ''; position: absolute; height: 8px; top: 0; width: 2px; background: #004684; right: 3px; transform: rotate(45deg); }
.segment_body-flight-stop .arrow_right-sm:after { background: #ccc; }

.margin-zero { margin: 0; }
.amend_details-passengers--list { background: #fff; box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14); margin: 10px 10px 0; position: relative; padding: 10px; border-radius: 6px; }



.passenger_list-details { display: flex; flex-direction: column; display: -webkit-flex; display: -moz-flex; align-items: center; -webkit-align-items: center; -moz-align-items: center; padding-top: 5px; background: #fff; box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14); border-radius: 6px; margin: 8px 0; min-height: 60px; }
.passenger_list-details-erormsg { color: #ff7b39; padding: 5px; width: 100%; display: flex; justify-content: center; }
.segment_header-top { background: #fff; color: #004684; padding: 12px 10px; display: flex; display: -webkit-flex; display: -moz-flex; align-items: center; -webkit-align-items: center; -moz-align-items: center; font-size: 13px; font-weight: 500; border-radius: 6px 6px 0 0; }
.passenger_list div { padding-right: 0; }
.no_margin{ margin-bottom:0px;}

.remarks_text{width:100%; background-color: #fff; border: none; padding: 10px; border: none !important; box-shadow: 2px 2px 4px #d1d1d1;}
p { margin-top: 0; margin-bottom: 2px; }
.card{margin-top: 15px;}
</style>
</head>

<body class="greyouter">
  <?php include "header.php"; ?>



<!--------------Left Menu---------------->


<?php include "left.php"; ?>





<!--------------Mid Body---------------->


<section class="profile">
        <div class="listcontent">
 
                     <div class="main_container"  style="padding:1px 10px;"  >
    <div class="info_main">
        <div class="card">
            <div class="cart_acordian">
                <h3 class="acordian_heading">Amendments</h3>
           
                <div class="cssCircle minusSign"> </div>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="card-field">
                            <p class="card-field--title">Type :<span class="card-field--detail"><span>
                                        &nbsp;<?php echo ($_REQUEST['amendmentType']); ?></span></span></p>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <div class="card-field">
                            <p class="card-field--title">Booking ID :<span class="card-field--detail"><span>
                                        &nbsp;<?php echo encode($rest['id']); ?></span></span></p>
                        </div>
                    </div> 
                     
                     
                </div>
            </div>
        </div>
    </div>
     
     
 <form action="<?php echo $fullurl; ?>actionpage.php" method="post" enctype="multipart/form-data" name="addeditfrm"  id="addeditfrm"> 

    <div class="cart__info__container">
        <div class="card cart_amend-passenger">
            <div class="cart_acordian">
                <h3 class="acordian_heading"><?php echo $dep['city']; ?> &nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i> &nbsp; <?php echo $arr['city']; ?></h3>
                <div class="cssCircle minusSign"><span><i class="fa fa-angle-up"></i></span></div>
            </div>
            <div class="cart_segment">
                <div class="amend_details-passengers">
                    <div class="segment_details-content">
                        <div class="segment_body bookingDetails_body">
                            <div class="segment_body-airlogo"><img class="airline-logo" src="<?php echo $imgurl.getflightlogo(stripslashes($rest['flightName'])); ?>">
                                <p class="margin-zero" style="text-align:left;"><?php echo $rest['flightName']; ?><span class="airline-code" style="text-align:left;"><?php echo $rest['flightCode']; ?>-<?php echo $rest['flightNo'];



								
								 ?></span></p>
                            </div>
                            <div class="segment_body-flight-info">
                                <p class="margin-zero"><?php echo $dep['country']; ?>, <?php echo $dep['airportDescription']; ?> - <?php echo $dep['airportCode']; ?>
                                     </span></p>
                                <p class="margin-zero"><?php echo $rest['departureTime']; ?>, <?php echo date('D, d F Y',strtotime($rest['journeyDate'])); ?></p>
                            </div>
                            <div class="segment_body-flight-stop"><span class="via-city-codes"><?php echo $rest['flightStop']; ?> Stop(s)</span>
                                <div class="arrow_right-sm"><?php echo $layoverFlight->DURATION;
								
							
								 ?></div>
                            </div>
                            <div class="segment_body-flight-info">
                                <p class="margin-zero"><?php echo $arr['country']; ?>, <?php echo $arr['airportDescription']; ?> - <?php echo $arr['airportCode']; ?></span></p>
                                <p class="margin-zero"><?php echo $rest['arrivalTime']; ?>, <?php echo date('D, d F Y',strtotime($rest['arrivalDate'])); ?></p>
                            </div>
                        </div>
                        <div>
                       
							
							
							<div class="passenger_list">
            <div class="row">
			<?php
				 
							
							$n=1;
		$rs6=GetPageRecord('*','flightBookingPaxDetailMaster',' BookingId="'.$rest['id'].'"   and firstName!="" '); 
		while($paxData=mysqli_fetch_array($rs6)){ 
		?>
                <div class="col-md-4 col-xs-6">
                    <div class="passenger_list-details">
                        <div class="passenger_list-details-fix-box">
                            
                            <p class="pax-name no_margin" style="font-weight:600;"><?php echo $paxData['title']; ?>&nbsp;<?php echo $paxData['firstName']; ?>&nbsp;<?php echo $paxData['lastName']; ?> (<?php echo ucfirst($paxData['paxType']); ?>)</span>  
                                                            </p>
                        </div>
                        <div class="passenger_list-details-erormsg"><input type="checkbox" value="<?php echo ($paxData['id']); ?>" class="al-checkfield" name="amPax[]" style="width: 20px; height: 20px;"></div>
                    </div>
                </div>
				<?php $n++; } ?>
                 
                 
            </div>
        </div>
						 
								
								
								
								
                           
                                <div>
                                     
                                </div>
                                <div class="segmentSubmitBtn"></div>
                         
                        </div>
                    </div>
                     
                </div>
            </div>
        </div>
    </div>
	
	<?php if($_REQUEST['amendmentType']=='Re-Issue'){ ?>
    
        <div class="info_main">
        <div class="card">
            <div class="cart_acordian">
                <h3 class="acordian_heading">NEXT TRAVEL DATE</h3>
           
                <div class="cssCircle minusSign"> </div>
            </div>
            <div class="card-body ">
                <div class="row">
             <div class="col-md-3 col-xs-6">
			 <label>Select next travel date</label>

						<div class="form-group">
 

									 		<input name="nextTravelDate" id="nexttraveldate" type="text" readonly=""  class="form-control">
<script>
$( function() {

				$( "#nexttraveldate" ).datepicker({ dateFormat: 'dd-mm-yy',minDate: 0, changeMonth: true, changeYear: true, showButtonPanel: true}); 

				} );
</script>
				      </div> 

				      </div>
                     
                     
                </div>
            </div>
        </div>
    </div>
	
	<?php } ?>
	
	<div class="info_main">
        <div class="card">
            <div class="cart_acordian">
                <h3 class="acordian_heading">Remark</h3>
           
                <div class="cssCircle minusSign"> </div>
            </div>
            <div class="card-body ">
                <div class="row">
             <div class="col-md-12 col-xs-12">
			 <label>Remark</label>

						<div class="form-group">
 

									 		<textarea name="remarkDetails" rows="5" class="form-control" id="remarkDetails"></textarea>
											<div><button type="submit" class="btn btn-danger" style="float: right; margin-top: 10px !important;" onClick="$(this).css('background-color','#ddd');$(this).css('border','1px solid #ddd');$(this).text('Wait Please...');$(this).css('color','#000');">Submit</button></div>
 
				      </div> 

				      </div>
                     
                     
                </div>
            </div>
        </div>
    </div>
	<input name="id" type="hidden" value="<?php echo $_REQUEST['id']; ?>">
	<input name="amType" type="hidden" value="<?php echo $_REQUEST['amendmentType']; ?>">
	  <input name="action" type="hidden"  value="flightbookingamendments">
	</form>
</div>
  
   
        </div>
    </section>




<!-- HTML -->




  <?php include "footerinc.php"; ?>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- Title -->
<title><?php echo getpagemeta($agentid,'Flight','title'); ?></title>
<meta name="keywords" content="<?php echo getpagemeta($agentid,'Flight','keyword'); ?>">
<meta property="description" content="<?php echo getpagemeta($agentid,'Flight','description'); ?>">
<!-- Required Meta Tags Always Come First -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php include dirname(dirname(__FILE__))."/headerinc4.php"; ?>
<?php include dirname(dirname(__FILE__))."/headerinc.php"; ?>

<style>
	  .greentabmsg{ padding: 1px 7px; font-size: 11px; font-weight: 500; display: inline-block; border-radius: 3px; color:#5ac09f;}
	  .redtabmsg{ padding: 1px 7px; font-size: 11px; font-weight: 500; display: inline-block; border-radius: 3px; color:#de5555;}
	  .listboxfooter{border-top: 1px solid #ddd; padding: 0px 4px 4px;}
	  .flightmsg{ color:#FF0000; font-size:12px; }
	  .flightlisting .img-fluid {width: 70px;}
	  @media (min-width: 768px){.col-md-2gdot8 {max-width: 19.66667%;}}
	  @media only screen and (max-width: 600px) {
        .font-size-21 {font-size: 16px!important;}
	    .fnt{margin-left: 15px;}
	    .pdng{padding-left: 3px;padding-right: 4px;}
}
	  .box {padding: 0px 10px;}
	  </style>
</head>
<body>
<!-- ========== HEADER ========== -->
<?php include dirname(dirname(__FILE__))."/header4.php"; ?>
<!-- ========== End HEADER ========== -->
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main" >
  <div class="darkbg flightsearchboxtop">
    <div class="container homepagesearchboxbg">
      <?php include dirname(__FILE__)."/flightsearchboxx.php"; ?>
    </div>
  </div>
  <div class="container paddingzero">
    <div class="row pt-5 pt-xl-4 mb-5 mb-xl-9 pb-xl-1">
      <?php include dirname(__FILE__)."/filter.php"; ?>
      <div class="col-xl-9">
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade active show" id="pills-three-example1" role="tabpanel" aria-labelledby="pills-three-example1-tab" data-target-group="groups">
            <div id="alldiv">
              <div class="listouter" id="searchbody">
                <div class="side-shadowr searchboxtotalresult" style="padding: 10px; margin-bottom:20px;"> <a href="<?php echo $fullurl; ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                  <button class="btn d-xl-none mb-5 p-0 collapsed filtertopright" type="button" onClick="$(window).scrollTop(0);"  data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation"> <i class="fa fa-filter" aria-hidden="true" ></i> </button>
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="left" style="font-size:14px; font-weight:500;color: #1395b9;"><?php echo $sourceCity; ?>&nbsp; <i class="fa fa-arrow-right" aria-hidden="true"></i> &nbsp;<?php echo $destinationCity; ?> | <?php echo date('d M',strtotime($departDate)); ?></td>
                      <td width="30%" align="right" style="font-size:13px;"></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="left" style=" padding-top:2px; font-size:12px;"><?php echo $count_trip;?> Buses Found.</td>
                    </tr>
                  </table>
                </div>
                <div class="mb-2">
                  <div class="border rounded-xs  hideinmobile" style="padding:10px !important; background-color:#fff; font-size:12px;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="16%" align="left" style="cursor:pointer;"  onClick="getSortedDeparture();" ><strong>Sort By:</strong> </td>
                        <td width="21%" align="center" style="cursor:pointer;"  onClick="getSortedDeparture();" >Departure <i class="fa fa-arrow-down" id="departurefa" aria-hidden="true"></i>
                          <input name="departurefilterid" type="hidden" id="departurefilterid" value="1"></td>
                        <td width="21%" align="center" style="cursor:pointer;"  onClick="getSortedDuration();" >Duration <i class="fa fa-arrow-down" id="durationfa" aria-hidden="true"></i>
                          <input name="durationfilterid" type="hidden" id="durationfilterid" value="1"></td>
                        <td width="21%" align="center"  style="cursor:pointer;"  onClick="getSortedArrival();" >Arrival <i class="fa fa-arrow-down" id="arrivalfa" aria-hidden="true"></i>
                          <input name="arrivalfilterid" type="hidden" id="arrivalfilterid" value="1">
                        </td>
                        <td width="21%" align="center" style="cursor:pointer;" onClick="getSortedPrice();" id="pricefilter">Price <i class="fa fa-arrow-down" id="pricefa" aria-hidden="true"></i>
                          <input name="pricefilterid" type="hidden" id="pricefilterid" value="1"></td>
                      </tr>
                    </table>
                  </div>
                </div>
               
               
                <div class="side-shadowr item filghtdatalistdiv flight-list-view" data-price="<?php echo $fares_currency;?>" data-duration="<?php echo $difftime;?>" data-arrival="<?php echo strtotime($arrtime);?>" data-departure="<?php echo strtotime($deptime);?>"  data-boarding="<?php echo $bplocation;?>" data-droping="<?php echo $dropping_location;?>" data-travels="<?php echo "{$value->travels}";?>">
                  <form method="POST" name="bookingform<?php echo $sr; ?>"  id="bookingform<?php echo $sr; ?>" action="#">
                     <div class="flightlisting">
                      <div class="row align-items-center text-center">
                        <div class="col-md mb-4 mb-md-0" style="margin-left: 5px;">
                          <table border="0" cellpadding="0" cellspacing="0" style="font-size:12px;">
                            <tr>
                          
                              <td style="padding-left:10px;text-align:left;"><?php  echo "{$value->travels}";?>
                                <div style="color:#a9a9a9"><?php echo "{$value->busType}"; $mybustype=$value->busType; ?></div></td>
                            </tr>
                          </table>
                          
                        </div>
                        
             
                        <div class="col-md mb-4 mb-md-0 fnt">
                          <div class="flex-content-center">
                            <div class="text-lg-center">
                              <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0"><?php echo $deptime; ?></h6>
                              <span class="font-size-14 text-gray-1"><?php echo $sourceCity; ?></span> </div>
                          </div>
                        </div>
                        <div class="col-md mb-4 mb-md-0">
                          <div class="flex-content-center flex-column">
                            <h6 class="font-size-14 font-weight-bold text-gray-5 mb-0"><?php echo $difftime;?></h6>
                            <div class="c-timeline" style="height: 2px;background-color: rgba(187, 187, 187, 0.49);">
                              <div class="dot"></div>
                              <div class="dot"></div>
                            </div>
                            
                            <div style="text-align:center; font-size:11px; color:#1395b9;"><?php echo "{$value->availableSeats}";?> Seat(s) left</div>
                          </div>
                        </div>
                        
                        <div class="col-md mb-4 mb-md-0">
                          <div class="flex-content-center d-block d-lg-flex">
                            <div class="text-lg-center">
                              <h6 class="font-weight-bold font-size-21 text-gray-5 mb-0"><?php echo $arrtime; ?></h6>
                              <span class="font-size-14 text-gray-1"><?php echo $destinationCity; ?></span> </div>
                          </div>
                        </div>
                        <div class="col-md-2gdot8 pdng">
                          <div class="border-xl-left">
                            <div class="ml-xl-5">
                              <div class="mb-2">
                                <div class="flex-content-center d-block d-lg-flex">
                                  <div class="text-lg-center">
                                    <div class="mb-2 text-lh-1dot4"> <span class="font-weight-bold font-size-22 pricesize">&#8377;<span id="finalCostapi<?php echo $sr; ?>">
                                        56656
                                        </span></span> </div>
                                  </div>
                                </div>
                                <a class="btn btn-outline-primary border-radius-3 d-flex align-items-center justify-content-center min-height-50 font-weight-bold border-width-2 py-2 w-100 popup-ajax" href="#new-card-dialog" data-effect="mfp-zoom-out" data-id="<?php echo $j.'|'.$trip_id.'|'.$bustype.'|'.$bplocation.''.$boardingtime.'|'.$dropping_location.'|'.$dropingtime.'|'.$fares.'|'.$mybustype.'|'.$difftime;?>">View Seats</a>
                               
                              </div>
                              <!-- On Target Modal -->
                              <!-- End On Target Modal -->
                            </div>
                          </div>
                        </div>
                      </div>
                    
                      <!--<div class="ymsg m-0 p-0">kjhgfdgh</div>-->
                     
                      <div class="ffoterbox">
                        <div class="box">
                            <a href="javascript:void(0);" data-value="<?php echo $j.'|'.$trip_id.'|'.$bustype.'|'.$bplocation.'|'.$boardingtime.'|'.$dropping_location.'|'.$dropingtime.'|'.$fares.'|'.$mybustype.'|'.$difftime;?>" data-target=".bus-details" data-toggle="modal"  data-type="" ><span ><i style="color:#1395b9;" class="fa fa-cut (alias)"></i> </span><span style="font-size:12px;color:#1395b9;">Cancellation Policy</span></a> 
                           
                            </div>
                      
                        <div class="box" style="float:right; border-right:0px;">
                            <?php if($value->AC == 'true'){?>
                            <i class="far fa-snowflake" data-toggle="tooltip" data-placement="top" title="Air Condition" aria-hidden="true"  style="color:#210d90;"> AC</i> &nbsp;&nbsp; 
                           <?php }else{ ?>
                             <i class="far fa-snowflake" data-toggle="tooltip" data-placement="top" title="Non AC " aria-hidden="true"  style="color:red;"> Non AC</i> &nbsp;&nbsp;
                            <?php } ?> 
                            </div>
                        <input type="hidden" name="acom" value=""  />
                      </div>
                      
                    </div>
                  </form>
                </div>
              
                <?php  /*}else{?> 
                <div>No Record found.</div>
                <?php } */?>
              </div>
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

		
<?php include dirname(dirname(__FILE__))."/footersort4.php"; ?>
 <script src="<?php echo $siteURL;?>assets/js/magnific.js"></script>
 <script src="<?php echo $siteURL;?>assets/js/flight-filter.js"></script> 
 

 
</div>
</body>
</html>
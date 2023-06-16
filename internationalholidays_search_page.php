<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$page='holidays';
$selectedpage='holidays';
 
function cleanstring($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}


		 $where='';
		 if($_REQUEST['holidaysdestination']!=0){
		 $where=' and destination="'.$_REQUEST['holidaysdestination'].'" ';
		 
		 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>International Holidays - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
<?php include "headerinc.php"; ?>

  <link rel="stylesheet" type="text/css" href="slick/slick.css">
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css">
  <script src="slick/slick.js" type="text/javascript" charset="utf-8"></script>

 <style>
 .holicontainer, .travelcontainer, .lastcon { padding: 0px 60px; }
 </style>
</head>

<body class="greybluebg">

<?php include "header.php"; ?>


<section class="holidaybanner" style="height: 188px;">
    <div class="container holidabancontainer" style="top:65px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="holidaysearch">
                    <h1 >
                    <i class="fa fa-suitcase" aria-hidden="true"></i> International Holiday Tour Packages</h1>
                    <form  method="GET" id="formids" action="international-holidays-search" > 
				<table>
                    <tbody><tr>
                        <td>
                            <select class="textfield"  name="holidaysdestination"> 
                                
                                   <option value="0">Select Destination</option>
	   
	   
	   <?php 
	   
$sql="select * from quotationMaster where status=1 and name!=''  and id in(select quotationId from sys_quickPackageOptions where perAdult>0) and showOnWebsite=1  group by destination order by id asc"; 
$rs=mysqli_query(db(),$sql) or die(mysqli_error()); 
while($res1=mysqli_fetch_array($rs)){

 
$ab=GetPageRecord('*','sys_quickPackageOptions',' quotationId="'.$res1['id'].'"   order by id desc '); 
$optiondata=mysqli_fetch_array($ab);

if($optiondata['perAdult']>0){

$ab=GetPageRecord('*','cityMaster',' id="'.$res1['destination'].'" and name!="" and stateId in (select id from stateMaster where countryId in (select id from countryMaster where name!="India")) '); 
$destinationname=mysqli_fetch_array($ab);
if($destinationname['name']!=''){ 
?>
	   <option value="<?php echo $destinationname['id']; ?>" <?php if($_REQUEST['holidaysdestination']==$destinationname['id']){?>selected="selected"<?php } ?>><?php echo $destinationname['name']; ?></option>
	   <?php } } } ?>
                                       
                                
                              </select>
                        </td>
                        <td width="23%"><input type="submit" name="Submit" value="SEARCH" class="redbuttonsearch"><input type="hidden" name="action" value="flightpostaction" >
<input type="hidden" name="changesearch" id="changesearch" value="0" >
</td>
                    </tr>
                </tbody></table>
				</form>
            </div>
            </div>
        </div>
    </div>
</section>



<section class="holidaydestination"> 
	<div class="container holicontainer" style="margin-top:30px;">
        <div class="row" id="loadallhotels">
		<div class="col-3 filtersidebar hotelfilter"  id="allFilterDiv">
		<div class="card">
		<div class="card-header" style="margin-top: 0px !important;">
    Package Theme
  </div>
  
  <div class="card-body" id="allFilterDiv">
<div class="arranddep">
 
  <?php
			  $a=GetPageRecord('*','sys_packageTheme',' status=1  and id in (select packageTheme from quotationMaster where status=1 '.$where.' and id in( select quotationId from sys_quickPackageOptions where perAdult>0)  and bannerImg!=""   ) order by name');
while($resttheme=mysqli_fetch_array($a)){ 
?>
    <label id="5star" style=""><input type="checkbox" value="<?php echo str_replace(' ','-',stripslashes($resttheme['name'])); ?>" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> <?php echo stripslashes($resttheme['name']); ?></label>
	
	
	              
				<?php } ?>

</div> 
</div>
			<div class="card-header" style="margin-top: 0px !important;">
    Duration
  </div>
  
  <div class="card-body" id="allFilterDiv">
<div class="arranddep">
 
  <?php
			   $bb=GetPageRecord('*','quotationMaster','  destination in (select id from cityMaster where stateId in(select id from stateMaster where countryId in (select id from countryMaster where name!="India"))) and bannerImg!="" '.$where.' and id in( select quotationId from sys_quickPackageOptions where perAdult>0)  group by nights  order by nights desc'); 
while($restduration=mysqli_fetch_array($bb)){ 
 
 
?>
    <label id="5star" style=""><input type="checkbox"  value="<?php echo ($restduration['nights']); ?>nights" style="width: 20px; height: 16px; float: left; margin-right: 3px;"> <?php echo stripslashes($restduration['nights']); ?> Night(s) - <?php echo stripslashes($restduration['nights']+1); ?> Day(s)</label>
	
	
	              
				<?php } ?>

</div> 
</div>
		
		</div>
		
		</div>
		
		
		<div class="col-9 cardresult">
		<h1 class="hotelseachheading" style="position:relative;">International Holiday Tour Packages</h1>
		
		
		<?php
 
		 
		 
		  $bb=GetPageRecord('*','quotationMaster','  destination in (select id from cityMaster where stateId in(select id from stateMaster where countryId in (select id from countryMaster where name!="India"))) and bannerImg!="" '.$where.'   order by rand() asc    '); 
while($packagelist=mysqli_fetch_array($bb)){ 

 
$ab=GetPageRecord('*','sys_quickPackageOptions',' quotationId="'.$packagelist['id'].'"   order by id desc '); 
$optiondata=mysqli_fetch_array($ab);
 
$ab=GetPageRecord('*','sys_packageTheme',' id="'.$packagelist['packageTheme'].'"'); 
$theme=mysqli_fetch_array($ab);


$ab=GetPageRecord('*','packageMarkup',' packageId="'.$packagelist['id'].'"   order by id desc '); 
$mackagemarkup=mysqli_fetch_array($ab);

if($optiondata['perAdult']>0){


$ab=GetPageRecord('*','cityMaster',' id="'.$packagelist['destination'].'" '); 
$destinationname=mysqli_fetch_array($ab);
?>

		
		<div class="row bookrow hotelbookrow hotelsearchlist hotelboxx itemlist" style="width:100%;" data-category="<?php echo ($packagelist['nights']); ?>nights <?php echo str_replace(' ','-',stripslashes($theme['name'])); ?>">
                  <div class="col-lg-9">
                    
                    <div class="hotelbooking">
                        <div class="hotelimg">
                            <img src="<?php echo $imgurl; ?><?php echo $packagelist['bannerImg']; ?>">
                        </div>
                        <div class="hoteltext">
                            <h5><?php echo stripslashes($packagelist['name']); ?></h5>
                             
                            <p class="relocation"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo ($packagelist['nights']); ?> Nights  / <?php echo ($packagelist['nights']+1); ?> Days</p>
                            <p class="relocation"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo stripslashes($destinationname['name']); ?></p>
                            <div class="Deluxe">
                             <div style="margin-top:4px;"><?php if($packagelist['flighticon']==1){ ?>

 <div class="incbox">
 <img src="data:image/png;base64,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" width="32">
 
 <div style=" text-align:center; font-weight:500;">Flight</div>
 </div>
 <?php } ?>
 
 
 <?php if($packagelist['hotelicon']==1){ ?>
 <div class="incbox">
 <img src="data:image/png;base64,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" width="32">
 
 <div style=" text-align:center; font-weight:500;">Hotel</div>
 </div>
  <?php } ?>
 
 <?php if($packagelist['sightseeingicon']==1){ ?>
 <div class="incbox">
 <img src="data:image/png;base64,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" width="32">
 
 <div style=" text-align:center; font-weight:500;">Sightseeing</div>
 </div>
 <?php } ?>
 
  
 <?php if($packagelist['transfericon']==1){ ?>
 <div class="incbox">
 <img src="data:image/png;base64,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" width="32">


 
 <div style=" text-align:center; font-weight:500;">Transfer</div>
 </div>
  <?php } ?>
 
  <?php if($packagelist['activityicon']==1){ ?>
 <div class="incbox">
 <img src="data:image/png;base64,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" width="32">
 
 <div style=" text-align:center; font-weight:500;">Activity</div>
 </div>
 <?php } ?>
 
  <?php if($packagelist['cruiseicon']==1){ ?>
 <div class="incbox">
 <img src="data:image/png;base64,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" width="32">
 
 <div style=" text-align:center; font-weight:500;">Cruise</div>
 </div>
  <?php } ?></div>
                                 
                            </div>
                        </div>
                       
                    </div>
              
                    
                  </div>
                  <div class="col-lg-3">
                    <div class="bookbtn">
                      <h4>&#8377;<?php echo ($optiondata['perAdult']+$mackagemarkup['markupValue']); ?></h4>
                      <div class="blackbox" style="margin-left: 0px !important; margin-bottom: 10px !important;">
                         
                        <h5>Price Per Person</h5>
                      </div>
					 <a  target="_blank" href="<?php echo $fullurl; ?>view-package?i=<?php echo encode($packagelist['id']); ?>&name=<?php echo cleanstring(stripslashes($packagelist['name'])); ?>"><button type="submit" class="btn btn-danger" style="width:100%;">View Detail</button></a>
				 
                    </div>
                  </div>
                  <!-- tabs -->
              
                </div>
				
				<?php } } ?>
		</div>
		
		
		
		
		</div>
    </div> 
	
	</section>



 
	
	
	
	
	 




<?php include "footer.php"; ?>








<script>

    $( function() {
    $( "#departuredate" ).datepicker(
	{
changeMonth: true,
            changeYear: true,
            yearRange: '-100:+0',
			dateFormat: 'dd-mm-yy',
			maxDate: new Date()
	
	}
	
	);
  } );
  
  
  
 function getSearchCityHotel(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchcitylistshotel.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
}
}



var $filterCheckboxes = $('#allFilterDiv input[type="checkbox"]');

$filterCheckboxes.on('change', function() {

  var selectedFilters = {};

  $filterCheckboxes.filter(':checked').each(function() {

    if (!selectedFilters.hasOwnProperty(this.name)) {



      selectedFilters[this.name] = [];



    }

    selectedFilters[this.name].push(this.value);

  });

  // create a collection containing all of the filterable elements



  var $filteredResults = $('.itemlist');

  // loop over the selected filter name -> (array) values pairs



  $.each(selectedFilters, function(name, filterValues) {

    // filter each .flower element



    $filteredResults = $filteredResults.filter(function() {

      var matched = false,



        currentFilterValues = $(this).data('category').split(' ');

      // loop over each category value in the current .flower's data-category



      $.each(currentFilterValues, function(_, currentFilterValue) {

        // if the current category exists in the selected filters array



        // set matched to true, and stop looping. as we're ORing in each



        // set of filters, we only need to match once

        if ($.inArray(currentFilterValue, filterValues) != -1) {



          matched = true;



          return false;



        }



      });

      // if matched is true the current .flower element is returned



      return matched;

    });



  });

  $('.itemlist').hide().filter($filteredResults).show();

});

 
</script>
</body>
</html>

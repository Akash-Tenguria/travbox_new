<?php 
include "inc.php"; 
include "config/logincheck.php";


deleteRecord('wig_flight_json_bkp','agentId="'.$_SESSION['agentUserid'].'"');

if($_SESSION['uniqueId']==''){
	$_SESSION['uniqueId'] = uniqid();
}



$rs=GetPageRecord('*','sys_userMaster','id=1'); 
$getapistatus=mysqli_fetch_array($rs); 

$undercons=0;



/*if($getapistatus['tboAPIRoundTrip']==0){ include "kafila-round-trip.php"; $undercons=1; }

$flightResultDisplayfile='flight_result_display_round_trip.php';

if($getapistatus['tboAPIRoundTrip']==1){ 
	
	if($_SESSION['isRoundTripInt']==1)
	{
		include "tbo-round-trip-Int.php"; 
		$flightResultDisplayfile='flight_result_display_round_trip_int.php';	
	}
	else
	{
		include "tbo-round-trip.php"; 
		
	} 	
    $undercons=1; 
}*/

$undercons=1; 
include "tbo-round-trip-domestic_special_api.php"; 

$flightResultDisplayfile='flight_result_display_round_domesitc_special.php';	
//echo $flightResultDisplayfile;
//die;
 		
?>


<script>
parent.$('#flightresult').load('<?php echo $flightResultDisplayfile; ?>?undercons=<?php echo $undercons; ?>');
</script>
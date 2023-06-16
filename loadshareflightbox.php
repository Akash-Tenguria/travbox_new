<?php include "inc.php"; ?>
<div class="finalsharewhatsapp">
<div><?php echo stripslashes($LoginUserDetails['companyName']); ?></div><br />
<?php $string = preg_replace('/\.$/', '', $_REQUEST['checkval']);
$array = explode(',', $string);
foreach($array as $value){
$a=GetPageRecord('*','wig_flight_json_bkp',' id="'.$value.'"'); 
while($res=mysqli_fetch_array($a)){
$str_arr = explode (",", $res['agfare']);   
	$basefares = explode ("=", $str_arr[2]);
?>
<div><?php echo stripslashes($res['FLIGHT_NAME']); ?> - <?php echo stripslashes($res['FLIGHT_CODE']); ?>-<?php echo stripslashes($res['FLIGHT_NO']); ?></div>
<div><?php echo stripslashes($res['ORG_CODE']); ?> - <?php echo stripslashes($res['DES_CODE']); ?></div>
<div>(<?php echo stripslashes($res['DEP_TIME']); ?>, <?php echo date('j F Y',strtotime($res['DEP_DATE'])); ?> - <?php echo stripslashes($res['ARRV_TIME']); ?>, <?php echo date('j F Y',strtotime($res['ARRV_DATE'])); ?>)</div>
<div>Duration: <?php echo $res['DUR']; ?>, <?php if($res['STOP']==0){ ?>Non Stop<?php  }else{ ?><?php echo $res['STOP'].' Stop '; ?><?php } ?></div>
<div>Price - Rs. <strong  contenteditable="true"><?php echo $basefares[1]+$res['agentFixedMakup']; ?>/-</strong></div>
<div>-----------------------</div><br />
<?php } } ?>
</div>
<?php
include "inc.php";  
if(trim($_REQUEST['keyword'])!=''){
?>
 
<div class="searchdestinationboxclass">

<?php
$rs=GetPageRecord('*','flightDestinationMaster',' airportCode like "%'.trim(strip($_REQUEST['keyword'])).'" or city like "'.trim(strip($_REQUEST['keyword'])).'%" group by airportCode order by airportCode asc limit 0,10');

while($resListing=mysqli_fetch_array($rs)){ 
$no=1;
?>
<div class="list" style="position:relative;padding-right: 32px;" onclick="$('#<?php echo $_REQUEST['cityresultfield']; ?>').val('<?php echo strip($resListing['airportCode']); ?>-<?php echo strip($resListing['country']); ?>');$('#<?php echo $_REQUEST['citysearchfield']; ?>').val('<?php echo strip($resListing['airportCode']); ?> - <?php echo strip($resListing['city']); ?>');$('#<?php echo $_REQUEST['searchcitylists']; ?>').hide();checkdublicatedestination();"><?php echo strip($resListing['airportCode']); ?> - <?php echo strip($resListing['city']); ?>, <?php echo strip($resListing['country']); ?><div style="font-size:11px; color:#666666;"><?php echo strip($resListing['airportDescription']); ?></div><?php if(countrynametoflag($resListing['country'])!=''){ ?><img src="<?php echo countrynametoflag($resListing['country']); ?>" style="position: absolute; width: 22px; right: 10px; top: 14px;" /><?php } ?></div>
<?php } ?>

 </div>
 <?php }  else {?>
 <script>
 $('.searchdestinationboxclass').hide();
 </script>
 <?php } ?>
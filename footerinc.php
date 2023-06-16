<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title mt-0" id="poptitle"></h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>
		<div id="popcontent">
		
		</div>
		</div> 
		</div> 
		</div>
		
		
<script>
function loadpop(pagetitle,obj,width){
$('#popcontent').html('<div style="padding:10px; text-align:center;"><img src="<?php echo $fullurl; ?>images/loading.gif" width="32" ></div>');
var popaction = encodeURI($(obj).attr('popaction')); 
$('#poptitle').html(pagetitle);
$('.modal-dialog').css('max-width',width);
$('.modal-dialog').css('width',width);
$('#popcontent').load('<?php echo $fullurl; ?>websiteloadpopup.php?'+popaction);
}




function redirectpage(pages){
window.location.href = pages;
$('#loadingwhite').hide();
}
</script>

<iframe id="actoinfrm" name="actoinfrm" style="display:none;"></iframe>

 

<div style="position:fixed; left:0px; top:0px; position:fixed; width:100%; height:100%; z-index:999999; background-color:#2f2f2fb8; display:none; " id="paymentframebox"> 
<div style="max-width: 900px;   background-color: #FFFFFF; padding: 10px; margin: auto; margin-top: 3%; border-radius: 10px;">
<div style="text-align: right; width: 100%; margin-top: 0px; margin-right: 10px; margin-bottom: 10px; position:relative;">
<div style="position: absolute; left: 8px; font-size: 20px; font-weight: 800;">Payment</div>

<button type="button" onclick="$('#paymentframebox').hide();"  class="btn btn-danger">Close</button></div>
<iframe width="100%" height="610" frameborder="0" id="paymentframe" name="paymentframe"></iframe>


</div>
</div>


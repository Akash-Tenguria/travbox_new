<?php
include "inc.php"; 
$id=$_REQUEST['id'];
 ?>

<div class="row" id="empInfoId<?php echo $id; ?>" style="margin-right: 0px;margin-left: 1px;">
  <div class="roomguestblockdiv">
    <div class="form-group">
      <div style="font-weight: 500; margin-top:10px">Room - <?php echo $id; ?></div>
    </div>
  </div>
  <div class="roomguestblockdiv">
    <div class="form-group">
      <select class="form-control select2 pax" id="noadults<?php echo $id; ?>" name="noadults<?php echo $id; ?>" onchange="gettotalpax();">
        <option value="1" selected="selected">1 Adult</option>
        <option value="2">2 Adults</option>
        <option value="3">3 Adults</option>
      </select>
    </div>
  </div>
  <div class="roomguestblockdiv">
    <div class="form-group">
      <select class="form-control select2 pax" id="nochilds<?php echo $id; ?>" name="nochilds<?php echo $id; ?>" onchange="showAgeColumn<?php echo $id; ?>(this.value);gettotalpax();">
        <option value="0" selected="selected">0 Child</option>
        <option value="1">1 Child</option>
        <option value="2">2 Childs</option>
      </select>
    </div>
  </div>
  <script>
	function showAgeColumn<?php echo $id; ?>(numChild){
	if(numChild==1){
		$('#childAgediv1<?php echo $id; ?>').show();
		$('#childAgediv2<?php echo $id; ?>').hide();
	}
	if(numChild==2){
		$('#childAgediv1<?php echo $id; ?>').show();
		$('#childAgediv2<?php echo $id; ?>').show();
	}
	if(numChild==0){
		$('#childAgediv1<?php echo $id; ?>').hide();
		$('#childAgediv2<?php echo $id; ?>').hide();
	}
	}
	showAgeColumn<?php echo $id; ?>('0');
	
	
	</script>
	<div class="roomguestblockdiv" id="childAgediv1<?php echo $id; ?>">
					<div class="form-group">
					<select class="form-control" id="age1<?php echo $id; ?>" name="age1<?php echo $id; ?>"> 
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option> 
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
					</select> 
					</div>
					</div>
					<div class="roomguestblockdiv" id="childAgediv2<?php echo $id; ?>">
					<div class="form-group"> 
					<select class="form-control" id="age2<?php echo $id; ?>" name="age2<?php echo $id; ?>"> 
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option> 
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
					</select> 
					</div>
					</div>
		
  <div class="roomguestblockdiv">
    <div class="form-group"> 
      <i class="fa fa-trash" aria-hidden="true" style="margin-top:6px; cursor: pointer; background-color: #f1646c; padding: 6px 8px; color: #fff; border-radius: 2px; font-size: 12px;margin-left: 2px;"  onclick="removeEmpInfo(<?php echo $id; ?>);"></i> </div>
  </div>
</div>

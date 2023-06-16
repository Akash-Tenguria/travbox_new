<?php
include "inc.php";

$where=' and 1 ';
if($_REQUEST['keyword']!=''){
$where=' and (name like "%'.$_REQUEST['keyword'].'%" or lastName like "%'.$_REQUEST['keyword'].'%" or passportNo like "%'.$_REQUEST['keyword'].'%") ';
}
?>

<table class="table">
							<thead>
								<tr style="background-color: #f6f6f6;">
								  <th>Title</th>
								  <th>First&nbsp;Name </th>
								  <th>Last&nbsp;Name </th>
									<th>DOB</th>
									<th>Passport</th>
									<th>Expriry</th>
								    <th>&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							 
							
										<?php   
										$rs=GetPageRecord('*','flightBookingPaxDetailMaster',' firstName!=""  and BookingId in(select id from flightBookingMaster where agentId="'.$_SESSION['agentUserid'].'") '.$where.' order by id desc limit 0,10'); 
										while($rest=mysqli_fetch_array($rs)){  
										?> 	
								<tr>
								  <td align="left" valign="top"><strong><?php echo stripslashes($rest['title']); ?></strong></td>
								  <td align="left" valign="top"><strong><?php echo stripslashes($rest['firstName']); ?></strong></td>
								  <td align="left" valign="top"><strong><?php echo stripslashes($rest['lastName']); ?></strong></td>
									<td align="left" valign="top"><?php if(date('Y',strtotime($rest['dob']))>'1970'){ echo date('d-m-Y',strtotime($rest['dob'])); } else { echo '-'; } ?>									</td>
									<td align="left" valign="top"><?php echo stripslashes($rest['passportNo']); ?></td>
									<td align="left" valign="top"><?php if(date('Y',strtotime($rest['passportExpiry']))>'1970'){ echo date('d-m-Y',strtotime($rest['passportExpiry'])); } else { echo '-'; } ?></td>
								    <td align="left" valign="top">
									
									<a href="#" style="display:block; background-color:#F5F5F5; font-weight:500; color:#000; font-size:12px; text-align:center; padding:5px 5px;" onClick="makethisselect(this);fillpaxfield('<?php echo stripslashes($rest['title']); ?>','<?php echo stripslashes($rest['firstName']); ?>','<?php echo stripslashes($rest['lastName']); ?>','<?php echo stripslashes($rest['gender']); ?>','<?php if(date('Y',strtotime($rest['dob']))>'1970'){ echo date('d-m-Y',strtotime($rest['dob'])); }  ?>','<?php echo stripslashes($rest['passportNo']); ?>','<?php if(date('Y',strtotime($rest['passportExpiry']))>'1970'){ echo date('d-m-Y',strtotime($rest['passportExpiry'])); } ?>');">Select</a>									</td>
								</tr>
								 <?php  } ?>
							</tbody>
						</table>
						
						<script>
						function fillpaxfield(htitile,firstname,lastname,gender,dob,passport,passportexpiry){
						 
						 var adult = 0;
								if($('#firstNameAdt1').length ){
								var firstNameAdt1 = $('#firstNameAdt1').val(); 
								if(firstNameAdt1==''){
								$('#titleAdt1').val(htitile);
								$('#firstNameAdt1').val(firstname);
								$('#lastNameAdt1').val(lastname); 
								$('#passportNumberAdt1').val(passport); 
								$('#passportExpiryAdt1').val(passportexpiry); 
								adult=1;
								} 
								} 	
								
								
								if($('#firstNameAdt2').length ){
								var firstNameAdt2 = $('#firstNameAdt2').val(); 
								if(firstNameAdt2=='' && firstNameAdt1!=''){
								$('#titleAdt2').val(htitile);
								$('#firstNameAdt2').val(firstname);
								$('#lastNameAdt2').val(lastname);
								$('#passportNumberAdt2').val(passport); 
								$('#passportExpiryAdt2').val(passportexpiry); 
								adult=1; 
								} 
								} 
								
								if($('#firstNameAdt3').length ){
								var firstNameAdt3 = $('#firstNameAdt3').val(); 
								if(firstNameAdt3=='' && firstNameAdt2!=''){
								$('#titleAdt3').val(htitile);
								$('#firstNameAdt3').val(firstname);
								$('#lastNameAdt3').val(lastname); 
								$('#passportNumberAdt3').val(passport); 
								$('#passportExpiryAdt3').val(passportexpiry); 
								adult=1;
								} 
								} 	
								
								if($('#firstNameAdt4').length ){
								var firstNameAdt4 = $('#firstNameAdt4').val(); 
								if(firstNameAdt4==''  && firstNameAdt3!=''){
								$('#titleAdt4').val(htitile);
								$('#firstNameAdt4').val(firstname);
								$('#lastNameAdt4').val(lastname); 
								$('#passportNumberAdt4').val(passport); 
								$('#passportExpiryAdt4').val(passportexpiry); 
								adult=1;
								} 
								} 	
								
								if($('#firstNameAdt5').length ){
								var firstNameAdt5 = $('#firstNameAdt5').val(); 
								if(firstNameAdt5==''  && firstNameAdt4!=''){
								$('#titleAdt5').val(htitile);
								$('#firstNameAdt5').val(firstname);
								$('#lastNameAdt5').val(lastname); 
								$('#passportNumberAdt5').val(passport); 
								$('#passportExpiryAdt5').val(passportexpiry); 
								adult=1;
								} 
								} 	
								
								if($('#firstNameAdt6').length ){
								var firstNameAdt6 = $('#firstNameAdt6').val(); 
								if(firstNameAdt6=='' && firstNameAdt5!=''){
								$('#titleAdt6').val(htitile);
								$('#firstNameAdt6').val(firstname);
								$('#lastNameAdt6').val(lastname);
								$('#passportNumberAdt6').val(passport); 
								$('#passportExpiryAdt6').val(passportexpiry); 
								adult=1; 
								} 
								} 	
								
								if($('#firstNameAdt7').length ){
								var firstNameAdt7 = $('#firstNameAdt7').val(); 
								if(firstNameAdt7=='' && firstNameAdt6!=''){
								$('#titleAdt7').val(htitile);
								$('#firstNameAdt7').val(firstname);
								$('#lastNameAdt7').val(lastname);
								$('#passportNumberAdt7').val(passport); 
								$('#passportExpiryAdt7').val(passportexpiry);  
								adult=1;
								} 
								} 	
								
								if($('#firstNameAdt8').length ){
								var firstNameAdt8 = $('#firstNameAdt8').val(); 
								if(firstNameAdt8=='' && firstNameAdt7!=''){
								$('#titleAdt8').val(htitile);
								$('#firstNameAdt8').val(firstname);
								$('#lastNameAdt8').val(lastname); 
								$('#passportNumberAdt8').val(passport); 
								$('#passportExpiryAdt8').val(passportexpiry); 
								adult=1;
								} 
								} 	
								
								if($('#firstNameAdt9').length ){
								var firstNameAdt9 = $('#firstNameAdt9').val(); 
								if(firstNameAdt9=='' && firstNameAdt8!=''){
								$('#titleAdt9').val(htitile);
								$('#firstNameAdt9').val(firstname);
								$('#lastNameAdt9').val(lastname);
								$('#passportNumberAdt9').val(passport); 
								$('#passportExpiryAdt9').val(passportexpiry);  
								adult=1;
								} 
								} 	
								
								
								
								/*----------Child----------------*/
								
								var child=0;
								 if($('#firstNameChd1').length ){
								var firstNameChd1 = $('#firstNameChd1').val(); 
								if(firstNameChd1=='' && adult==0){
								$('#titleChd1').val(htitile);
								$('#firstNameChd1').val(firstname);
								$('#lastNameChd1').val(lastname); 
								$('#dobChd1').val(dob); 
								$('#passportNumberChd1').val(passport); 
								$('#passportExpiryChd1').val(passportexpiry); 
								 child=1;
								} 
								} 
								
								 if($('#firstNameChd2').length ){
								var firstNameChd2 = $('#firstNameChd2').val(); 
								if(firstNameChd2=='' && firstNameChd1!=''){
								$('#titleChd2').val(htitile);
								$('#firstNameChd2').val(firstname);
								$('#lastNameChd2').val(lastname); 
								$('#dobChd2').val(dob); 
								$('#passportNumberChd2').val(passport); 
								$('#passportExpiryChd2').val(passportexpiry); 
								 child=1;
								} 
								} 	
								
								 if($('#firstNameChd3').length ){
								var firstNameChd3 = $('#firstNameChd3').val(); 
								if(firstNameChd3=='' && firstNameChd2!=''){
								$('#titleChd3').val(htitile);
								$('#firstNameChd3').val(firstname);
								$('#lastNameChd3').val(lastname); 
								$('#dobChd3').val(dob); 
								$('#passportNumberChd3').val(passport); 
								$('#passportExpiryChd3').val(passportexpiry); 
								 child=1;
								} 
								} 	 	
								
								
								
								 if($('#firstNameChd4').length ){
								var firstNameChd4 = $('#firstNameChd4').val(); 
								if(firstNameChd4=='' && firstNameChd3!=''){
								$('#titleChd4').val(htitile);
								$('#firstNameChd4').val(firstname);
								$('#lastNameChd4').val(lastname); 
								$('#dobChd4').val(dob); 
								$('#passportNumberChd4').val(passport); 
								$('#passportExpiryChd4').val(passportexpiry); 
								 child=1;
								} 
								} 
								
								
								 if($('#firstNameChd5').length ){
								var firstNameChd5 = $('#firstNameChd5').val(); 
								if(firstNameChd5=='' && firstNameChd4!=''){
								$('#titleChd5').val(htitile);
								$('#firstNameChd5').val(firstname);
								$('#lastNameChd5').val(lastname); 
								$('#dobChd5').val(dob); 
								$('#passportNumberChd5').val(passport); 
								$('#passportExpiryChd5').val(passportexpiry); 
								 child=1;
								} 
								} 
								
								
								 if($('#firstNameChd6').length ){
								var firstNameChd6 = $('#firstNameChd6').val(); 
								if(firstNameChd6=='' && firstNameChd5!=''){
								$('#titleChd6').val(htitile);
								$('#firstNameChd6').val(firstname);
								$('#lastNameChd6').val(lastname); 
								$('#dobChd6').val(dob); 
								$('#passportNumberChd6').val(passport); 
								$('#passportExpiryChd6').val(passportexpiry); 
								 child=1;
								} 
								} 
								
								
								
									/*----------Infant----------------*/
								
								
								 if($('#firstNameInf1').length ){
								var firstNameInf1 = $('#firstNameInf1').val(); 
								if(firstNameInf1=='' && child==0 && adult==0){
								$('#titleInf1').val(htitile);
								$('#firstNameInf1').val(firstname);
								$('#lastNameInf1').val(lastname); 
								$('#dobInf1').val(dob);  
								$('#passportNumberInf1').val(passport); 
								$('#passportExpiryInf1').val(passportexpiry); 
								} 
								} 
								
								 if($('#firstNameInf2').length ){
								var firstNameInf2 = $('#firstNameInf2').val(); 
								if(firstNameInf2=='' && firstNameInf1!=''){
								$('#titleInf2').val(htitile);
								$('#firstNameInf2').val(firstname);
								$('#lastNameInf2').val(lastname); 
								$('#dobInf2').val(dob);  
								$('#passportNumberInf2').val(passport); 
								$('#passportExpiryInf2').val(passportexpiry); 
								} 
								} 
								
								 if($('#firstNameInf3').length ){
								var firstNameInf3 = $('#firstNameInf3').val(); 
								if(firstNameInf3=='' && firstNameInf2!=''){
								$('#titleInf3').val(htitile);
								$('#firstNameInf3').val(firstname);
								$('#lastNameInf3').val(lastname); 
								$('#dobInf3').val(dob);  
								$('#passportNumberInf3').val(passport); 
								$('#passportExpiryInf3').val(passportexpiry); 
								} 
								} 
								
								 if($('#firstNameInf4').length ){
								var firstNameInf4 = $('#firstNameInf4').val(); 
								if(firstNameInf4=='' && firstNameInf3!=''){
								$('#titleInf4').val(htitile);
								$('#firstNameInf4').val(firstname);
								$('#lastNameInf4').val(lastname); 
								$('#dobInf4').val(dob);  
								$('#passportNumberInf4').val(passport); 
								$('#passportExpiryInf4').val(passportexpiry); 
								} 
								} 
								
								 if($('#firstNameInf5').length ){
								var firstNameInf5 = $('#firstNameInf5').val(); 
								if(firstNameInf5=='' && firstNameInf4!=''){
								$('#titleInf5').val(htitile);
								$('#firstNameInf5').val(firstname);
								$('#lastNameInf5').val(lastname); 
								$('#dobInf5').val(dob); 
								$('#passportNumberInf5').val(passport); 
								$('#passportExpiryInf5').val(passportexpiry);  
								} 
								} 
								
								 if($('#firstNameInf6').length ){
								var firstNameInf6 = $('#firstNameInf6').val(); 
								if(firstNameInf6=='' && firstNameInf5!=''){
								$('#titleInf6').val(htitile);
								$('#firstNameInf6').val(firstname);
								$('#lastNameInf6').val(lastname); 
								$('#dobInf6').val(dob); 
								$('#passportNumberInf6').val(passport); 
								$('#passportExpiryInf6').val(passportexpiry);  
								} 
								} 
								
								 if($('#firstNameInf7').length ){
								var firstNameInf7 = $('#firstNameInf7').val(); 
								if(firstNameInf7=='' && firstNameInf6!=''){
								$('#titleInf7').val(htitile);
								$('#firstNameInf7').val(firstname);
								$('#lastNameInf7').val(lastname); 
								$('#dobInf7').val(dob);  
								$('#passportNumberInf7').val(passport); 
								$('#passportExpiryInf7').val(passportexpiry); 
								} 
								} 
								
								 if($('#firstNameInf8').length ){
								var firstNameInf8 = $('#firstNameInf8').val(); 
								if(firstNameInf8=='' && firstNameInf7!=''){
								$('#titleInf8').val(htitile);
								$('#firstNameInf8').val(firstname);
								$('#lastNameInf8').val(lastname); 
								$('#dobInf8').val(dob);  
								$('#passportNumberInf8').val(passport); 
								$('#passportExpiryInf8').val(passportexpiry); 
								} 
								} 
								
								
								 if($('#firstNameInf9').length ){
								var firstNameInf9 = $('#firstNameInf9').val(); 
								if(firstNameInf9=='' && firstNameInf8!=''){
								$('#titleInf9').val(htitile);
								$('#firstNameInf9').val(firstname);
								$('#lastNameInf9').val(lastname); 
								$('#dobInf9').val(dob);  
								$('#passportNumberInf9').val(passport); 
								$('#passportExpiryInf9').val(passportexpiry); 
								} 
								} 
								
								  
						
						}
						
						
						
						
						function makethisselect(obj){
						//alert($(obj).css('background-color'));
						if($(obj).css('background-color')=='rgb(245, 245, 245)'){
						$(obj).css('background-color','rgb(9 181 152)');
						$(obj).css('color','rgb(255 255 255)');
						} 
						}
						</script>

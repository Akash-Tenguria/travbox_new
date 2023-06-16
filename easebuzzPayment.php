<?php
session_start();
include "inc.php";

if(isset($_SESSION['order_id']) && isset($_SESSION['amount']) && isset($_SESSION['first_name']) && isset($_SESSION['last_name']) && isset($_SESSION['phone']) && isset($_SESSION['user_email'])){
?>

<img src="<?php echo $fullurl; ?>dist/images/loading.gif" style="display: block; margin-left: auto; margin-right: auto;">

<form method="POST" name="easebuzz" id="easebuzz" action="easebuzz.php?api_name=initiate_payment" style="display:none;">

<input id="txnid" class="txnid" name="txnid" value="<?php echo $_SESSION["txnID"]; ?>" type="hidden">
<input id="amount" class="amount" name="amount" value="<?php echo $_SESSION["amount"]; ?>" type="hidden">
<input id="firstname" class="firstname" name="firstname" value="<?php echo strip($LoginUserDetails['firstName']); ?> <?php echo strip($LoginUserDetails['lastName']); ?>" type="hidden">
<input id="email" class="email" name="email" value="<?php echo $LoginUserDetails["email"]; ?>" type="hidden">
<input id="phone" class="phone" name="phone" value="<?php echo $LoginUserDetails["phone"]; ?>" type="hidden">
<input id="productinfo" class="productinfo" name="productinfo" value="Online Recharge" type="hidden">
<input id="surl" class="surl" name="surl" value="https://pay.tripzygo.travel/response.php" type="hidden">
<input id="furl" class="furl" name="furl" value="https://pay.tripzygo.travel/response.php" type="hidden">
<input type="hidden" id="udf1" class="udf1" name="udf1" value="<?php echo $_SESSION["amount"]; ?>">
<input type="hidden" id="udf2" class="udf2" name="udf2" value="<?php echo $_SESSION['agentUserid']; ?>">
<input type="hidden" id="udf3" class="udf3" name="udf3" value="<?php echo $_SESSION['agentUsername']; ?>">
<input type="hidden" id="udf4" class="udf4" name="udf4" value="<?php echo $_SESSION['parentAgentId']; ?>">
<input type="hidden" id="udf5" class="udf5" name="udf5" value="<?php echo $_SESSION['parentid']; ?>">
<input type="hidden" id="udf6" class="udf6" name="udf6" value="<?php echo $_SESSION["token"]; ?>">

<input id="unique_id" class="unique_id" name="unique_id" value="<?php echo $LoginUserDetails["id"]; ?>" type="hidden">
<input id="show_payment_mode" class="show_payment_mode" name="show_payment_mode" value="<?php echo $_SESSION["pg_name"]; ?>" type="hidden">
<input type="submit">
</form>

<script type="text/javascript">
	document.easebuzz.submit();
</script>
<?php } ?>
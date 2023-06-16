<?php 
 if($bookingServiceType!='')
 {
 ?>
 <script>
 function getResponseCheck()
 {
	 $('#payResponseId').load('actionpage.php?action=paymentGatewayPayment&serviceId=<?php echo $_SESSION['serviceId']; ?>&type=<?php echo $bookingServiceType; ?>');

 }
 const myTimeout = setInterval(getResponseCheck, 2000);
 </script>

<div id="payResponseId" style="display:none"></div>
<?php } ?> 

<footer class="flightfooter">
    <div class="footerlinks">
  <a href="<?php echo $fullurl; ?>">Home</a>
                           <a href="<?php echo $fullurl; ?>about-us">About</a>
              <a href="<?php echo $fullurl; ?>terms-conditions">Terms & conditions</a>
              <a href="<?php echo $fullurl; ?>privacy-policy">Privacy Policy</a>
              <a href="<?php echo $fullurl; ?>contact-us">Contact</a>
      
    </div>
    <div class="copyrighttext">
 
        <p><?php echo $footerversion; ?></p>
 
    </div>
</footer>
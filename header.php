<div id="header">
    <div id="logo"><a href="<?php echo $fullurl; ?>"><img src="<?php echo $imgurl; ?><?php echo $LoginUserDetails['companyLogo']; ?>"></a></div>
    <div id="menu">
    <a href="<?php echo $fullurl; ?>" <?php if($selectedpage=='dashboard'){ ?>class="active"<?php } ?>><span><i class="fa fa-th-large" aria-hidden="true"></i></span>Dashbaord</a>
    <a href="<?php echo $fullurl; ?>flights" <?php if($selectedpage=='flights'){ ?>class="active"<?php } ?>><span><i class="fa fa-plane" aria-hidden="true"></i></span>Flights</a>
    <a href="<?php echo $fullurl; ?>hotels" <?php if($selectedpage=='hotels'){ ?>class="active"<?php } ?>><span><i class="fa fa-building" aria-hidden="true"></i></span>Hotels</a>
   
  <div class="dropdown dropbuton" style="margin-right:10px; float:left;">  <a href="<?php echo $fullurl; ?>holidays" class="<?php if($selectedpage=='holidays'){ ?>active<?php } ?> dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span><i class="fa fa-suitcase" aria-hidden="true"></i></span>Holidays</a>
  
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
    <a class="dropdown-item" href="domestic-holidays">Domestic</a>
    <a class="dropdown-item" href="international-holidays">International</a>
   
  </div>
  </div>
	
	 
    </div>
    
    
    <div id="rightmenu">
	
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle mainbutton" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span><i class="fa fa-user" aria-hidden="true"></i>
        </span>Account
      </button>
      <button style="display: none;" class="btn btn-secondary dropdown-toggle menubtn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-bars" aria-hidden="true"></i>
      
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
         <a class="dropdown-item" href="<?php echo $fullurl; ?>balance-sheet" style="background-color: #00000080 !important; color: #fff;"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Balance: &#8377;<?php echo round($totalwalletBalance); ?></a>
        <a class="dropdown-item" href="<?php echo $fullurl; ?>my-profile"><i class="fa fa-id-card-o" aria-hidden="true"></i> Agent Id: <?php echo makeAgentId($LoginUserDetails['agentId']); ?></a>
        <a class="dropdown-item" href="<?php echo $fullurl; ?>flight-bookings"><i class="fa fa-list" aria-hidden="true"></i> Bookings</a>
        <a class="dropdown-item" href="<?php echo $fullurl; ?>flight-bookings-invoice"><i class="fa fa-file" aria-hidden="true"></i> Invoices</a>
        <a class="dropdown-item" href="<?php echo $fullurl; ?>balance-sheet"><i class="fa fa-money" aria-hidden="true"></i> Balance Sheet</a>
        <a class="dropdown-item" href="<?php echo $fullurl; ?>online-recharge"><i class="fa fa-retweet" aria-hidden="true"></i> Online Recharge</a>
        <a class="dropdown-item" href="<?php echo $fullurl; ?>topup-request"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Top Up Request</a>
        <a class="dropdown-item" href="<?php echo $fullurl; ?>my-customer"><i class="fa fa-users" aria-hidden="true"></i> Customers</a>
        <a class="dropdown-item" href="<?php echo $fullurl; ?>my-profile"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
        <a class="dropdown-item" href="<?php echo $fullurl; ?>settings"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
        <a class="dropdown-item" href="<?php echo $fullurl; ?>logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
      </div>
    </div>
</div>
</div>
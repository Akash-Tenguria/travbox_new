<?php
include "inc.php"; 
include "config/logincheck.php";  
$selectedpage=''; 
$selectleft='bookings';
$selectintab='holidaysenq';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Bookings - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title> 
<?php include "headerinc.php"; ?>
</head>

<body class="greyouter">
  <?php include "header.php"; ?>



<!--------------Left Menu---------------->


<?php include "left.php"; ?>





<!--------------Mid Body---------------->


<section class="profile">
        <div class="listcontent">

            <div class="card">
                <div class="card-body">
                    <div class="bodysection bodypricesection">
                        <h1>Bookings</h1>
                        <?php include "bookingtabs.php"; ?>
						
                        <div class="tbtabcontent">
						<div class="row">
						<div class="col-lg-12">
 

</div>
</div>
                        
	<div class="table-responsive">

	<table class="table">
							<thead>
								<tr style="background-color: #f6f6f6;">
								  <th>Package </th>
									<th>Destination</th>
									<th>Departure</th>
									<th>Departure Date </th>
									<th>Contact</th>
								</tr>
							</thead>
							<tbody>
								<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 


$search='';

if($_REQUEST['status']!=''){
$search.=' and status="'.$_REQUEST['status'].'" ';
}

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(CheckIn)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(CheckIn)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}


if($_REQUEST['keyword']!=''){
$search.=' and  (Destination like "%'.$_REQUEST['keyword'].'%" or  HotelName like "%'.$_REQUEST['keyword'].'%" or  HotelCode like "%'.$_REQUEST['keyword'].'%" or RoomType like "%'.$_REQUEST['keyword'].'%" or agentId in (select id from sys_userMaster where companyName like "%'.$_REQUEST['keyword'].'%" ) ) ';
}
 
 $targetpage='holidays-enquiries?ga='.$_REQUEST['ga'].'&status='.$_REQUEST['status'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&';
  
$rs=GetRecordList('*','packageEnquiry',' where 1   '.$search.'  and agentId="'.$_SESSION['agentUserid'].'" order by id desc','25',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 
 
 $ag=GetPageRecord('*','sys_userMaster',' id="'.$rest['agentId'].'" '); 
$agentData=mysqli_fetch_array($ag);
?>
								
								<tr>
								  <td align="left" valign="top"><strong><?php echo strip($rest['packageName']); ?></strong><div style="width:140px;"><?php echo date('d-m-Y h:i A', strtotime($rest['addDate'])); ?></div></td>
									<td align="left" valign="top"><?php echo strip($rest['citydestination']); ?></td>
									<td align="left" valign="top"><?php echo strip($rest['departureCity']); ?></td>
									<td align="left" valign="top"><?php echo strip($rest['departureDate']); ?></td>
								  <td align="left" valign="top"><?php echo strip($rest['name']); ?><br />
                                      <strong>Phone:</strong> <?php echo strip($rest['mobile']); ?><br />
<strong>Email:</strong> <?php echo strip($rest['email']); ?></td>
								</tr>
								 <?php $sNo++; } ?>
							</tbody>
						</table>	
						<?php if($sNo==1){?>
<div style="text-align:center; padding:40px;">No Enquiry Found</div>
<?php } ?>
		    </div>

					 <div class="card-footer text-right" style="overflow:hidden;">

		 

										<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>

											<div class="pagingnumbers"><?php echo $paging; ?></div>

											

						 

			  </div>

            </div>

        </div>
        </div>
        </div>
        </div>
    </section>




<!-- HTML -->




  <?php include "footerinc.php"; ?>

</body>
</html>

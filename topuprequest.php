<?php
include "inc.php"; 
include "config/logincheck.php";  
$selectedpage=''; 
$selectleft='topup-request'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Top Up Request - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title> 
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
                        <h1>Top Up Request <button type="button" class="bodyhandbuttonright" onClick="loadpop('Top Up Request',this,'650px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addpaymentrequest">+ Make Request</button></h1>
                         
						
                        <div class="tbtabcontent" style="border-top-left-radius: 14px;">
						<div class="row">
						 
						 
</div>
                        
	<div class="table-responsive">
 

	<table class="table">
							<thead>
								<tr style="background-color: #f6f6f6;">
									<th>Date</th>
									<th>Requested Amount</th>
									<th>Payment Mode</th>
									<th>Reference Number</th>
									<th>Notes</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
<?php 
$limit=clean($_GET['records']);
$page=clean($_GET['page']); 
$sNo=1; 

$search='';

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){
$search.=' and  DATE(addDate)>="'.date('Y-m-d',strtotime($_REQUEST['fromdate'])).'" and  DATE(addDate)<="'.date('Y-m-d',strtotime($_REQUEST['todate'])).'" ';
}

$targetpage='topup-request?ga='.$_REQUEST['ga'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&';
$rs=GetRecordList('*','offlineRechargeRequest',' where agentId="'.$_SESSION['agentUserid'].'" order by id desc ','100',$page,$targetpage); 
$totalentry=$rs[1];
$paging=$rs[2];
while($rest=mysqli_fetch_array($rs[0])){
?>
								
<tr>
	<td align="left" valign="top"><strong><?php echo date("d-m-Y",strtotime($rest['addDate'])); ?></strong></td>
	<td align="left" valign="top"><strong><?php echo number_format($rest['requestedAmount'],2); ?></strong></td>
	<td align="left" valign="top"><strong><?php echo stripslashes($rest['paymentMode']); ?></strong></td>
	<td align="left" valign="top"><?php echo stripslashes($rest['referenceNumber']); ?></td>
	<td align="left" valign="top"><?php echo stripslashes($rest['note']); ?></td>
	<td align="left" valign="top"><?php if($rest['status']=='pending'){ ?><span class="badge bg-blue" style="background-color:#FF6600;text-transform:uppercase;"><?php echo stripslashes($rest['status']); ?></span><?php } ?><?php if($rest['status']=='approved'){ ?><span class="badge bg-blue" style="background-color:#46cd93; text-transform:uppercase;"><?php echo stripslashes($rest['status']); ?></span><?php } ?></td>
</tr>
								 <?php $sNo++; } ?>
							</tbody>
						</table>
					 
<?php if($sNo==1){ ?>
	<div style="text-align:center; padding:30px 0px;">Data Not Found</div>
<?php } ?>

<div class="card-footer text-right">
		<div style="float: left; font-size: 13px; padding: 7px 11px; border: 1px solid #ededed; background-color: #fff; color: #000;">Total Records: <strong><?php echo $totalentry; ?></strong></div>
		<div class="pagingnumbers"><?php echo $paging; ?></div>
	</div>
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

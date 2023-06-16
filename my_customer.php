<?php
include "inc.php"; 
include "config/logincheck.php";  
$selectedpage=''; 
$selectleft='mycustomers'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>My Customers - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title> 
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
                        <h1>My Customers </h1>
                         
						
                        <div class="tbtabcontent" style="border-top-left-radius: 14px;">
						<div class="row">
						 
						 
</div>
                        
	<div class="table-responsive">
 

	<table class="table">
							<thead>
								<tr style="background-color: #f6f6f6;">
								  <th>Title</th>
								  <th>First&nbsp;Name </th>
								  <th>Last&nbsp;Name </th>
									<th>DOB</th>
									<th>Passport</th>
									<th>Expriry</th>
									<th>Update  </th> 
								    <th width="4%" ><div align="center">Edit</div></th>
								    <th width="4%"  style="display:none;" ><div align="center">Delete</div></th>
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


if($_REQUEST['keyword']!=''){
$search.=' and  (name like "%'.$_REQUEST['keyword'].'%" or email like "%'.$_REQUEST['keyword'].'%") ';
}


 $targetpage='my-customer?ga='.$_REQUEST['ga'].'&fromdate='.$_REQUEST['fromdate'].'&todate='.$_REQUEST['todate'].'&keyword='.$_REQUEST['keyword'].'&'; 
$rs=GetRecordList('*','flightBookingPaxDetailMaster',' where  firstName!=""  and BookingId in(select id from flightBookingMaster where agentId="'.$_SESSION['agentUserid'].'")   order by id desc  ','50',$page,$targetpage); 
$totalentry=$rs[1]; 
$paging=$rs[2];  
while($rest=mysqli_fetch_array($rs[0])){ 

 
?>
								
								<tr>
								  <td align="left" valign="top"><strong><?php echo stripslashes($rest['title']); ?></strong></td>
								  <td align="left" valign="top"><strong><a  onClick="loadpop('Edit Customer',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcustomer&id=<?php echo encode($rest['id']); ?>"><?php echo stripslashes($rest['firstName']); ?></a></strong></td>
								  <td align="left" valign="top"><a  onClick="loadpop('Edit Customer',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcustomer&id=<?php echo encode($rest['id']); ?>"><strong><?php echo stripslashes($rest['lastName']); ?></strong></a></td>
									<td align="left" valign="top"><?php if(date('Y',strtotime($rest['dob']))>'1970'){ echo date('d-m-Y',strtotime($rest['dob'])); } else { echo '-'; } ?>									</td>
									<td align="left" valign="top"><?php echo stripslashes($rest['passportNumber']); ?></td>
									<td align="left" valign="top"><?php if(date('Y',strtotime($rest['passportExpiry']))>'1970'){ echo date('d-m-Y',strtotime($rest['passportExpiry'])); } else { echo '-'; } ?></td>
									<td align="left" valign="top"><?php echo date('d-m-Y', strtotime($rest['addDate'])); ?></td>
								    <td width="4%" align="left" valign="top"   ><div align="center"><i class="fa fa-pencil" aria-hidden="true" style="cursor:pointer;" title="Edit" onClick="loadpop('Edit Customer',this,'500px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=addcustomer&id=<?php echo encode($rest['id']); ?>"></i></div></td>
								    <td width="4%" align="left" valign="top"  style="display:none;"> </td>
								</tr>
								 <?php $sNo++; } ?>
							</tbody>
						</table>
						
						<?php if($sNo==1){?>
<div style="text-align:center; padding:40px;">No Customer Found</div>
<?php } ?>	
					 
<div class="card-footer text-right" style="overflow:hidden;">

		 

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

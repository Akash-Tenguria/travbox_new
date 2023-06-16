<?php 
include "inc.php"; 
include "config/logincheck.php"; 
$page='holidays';
$selectedpage='holidays';
 
function cleanstring($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}


		 $where='';
		 if($_REQUEST['holidaysdestination']!=0){
		 $where=' and destination="'.$_REQUEST['holidaysdestination'].'" ';
		 
		 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>International Holidays - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title>
<?php include "headerinc.php"; ?>

  <link rel="stylesheet" type="text/css" href="slick/slick.css">
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css">
  <script src="slick/slick.js" type="text/javascript" charset="utf-8"></script>

 <style>
 .holicontainer, .travelcontainer, .lastcon { padding: 0px 60px; }
 </style>
</head>

<body class="greybluebg">

<?php include "header.php"; ?>


<section class="holidaybanner">
    <div class="container holidabancontainer">
        <div class="row">
            <div class="col-lg-12">
                <div class="holidaysearch">
                    <h1>
                    <i class="fa fa-suitcase" aria-hidden="true"></i> International Holiday Tour Packages</h1>
                 <form  method="GET" id="formids" action="international-holidays-search" > 
				<table>
                    <tbody><tr>
                        <td>
                            <select class="textfield" name="holidaysdestination"> 
                                
                                   <option value="0">Select Destination</option>
	   
	   
	   <?php 
	   
$sql="select * from quotationMaster where status=1 and name!=''  and id in(select quotationId from sys_quickPackageOptions where perAdult>0) and showOnWebsite=1  group by destination order by id asc"; 
$rs=mysqli_query(db(),$sql) or die(mysqli_error()); 
while($res1=mysqli_fetch_array($rs)){

 
$ab=GetPageRecord('*','sys_quickPackageOptions',' quotationId="'.$res1['id'].'"   order by id desc '); 
$optiondata=mysqli_fetch_array($ab);

if($optiondata['perAdult']>0){

$ab=GetPageRecord('*','cityMaster',' id="'.$res1['destination'].'" and name!="" and stateId in (select id from stateMaster where countryId in (select id from countryMaster where name!="India")) '); 
$destinationname=mysqli_fetch_array($ab);
if($destinationname['name']!=''){ 
?>
	   <option value="<?php echo $destinationname['id']; ?>" <?php if($_REQUEST['holidaysdestination']==$destinationname['id']){?>selected="selected"<?php } ?>><?php echo $destinationname['name']; ?></option>
	   <?php } } } ?>
                                       
                                
                              </select>
                        </td>
                        <td width="23%"><input type="submit" name="Submit" value="SEARCH" class="redbuttonsearch"><input type="hidden" name="action" value="flightpostaction" >
<input type="hidden" name="changesearch" id="changesearch" value="0" >
</td>
                    </tr>
                </tbody></table>
				</form>
            </div>
            </div>
        </div>
    </div>
</section>



<section class="holidaydestination"> 
	<div class="container holicontainer">
        <div class="row">
		
		<?php
		 
		 $p=1;
		  $bb=GetPageRecord('*','quotationMaster','  destination in (select id from cityMaster where stateId in(select id from stateMaster where countryId in (select id from countryMaster where name!="India"))) and bannerImg!="" '.$where.'   order by rand() asc  limit 0,40   '); 
while($packagelist=mysqli_fetch_array($bb)){ 

 
$ab=GetPageRecord('*','sys_quickPackageOptions',' quotationId="'.$packagelist['id'].'"   order by id desc '); 
$optiondata=mysqli_fetch_array($ab);
 
$ab=GetPageRecord('*','sys_packageTheme',' id="'.$packagelist['packageTheme'].'"'); 
$theme=mysqli_fetch_array($ab);


$ab=GetPageRecord('*','packageMarkup',' packageId="'.$packagelist['id'].'"   order by id desc '); 
$mackagemarkup=mysqli_fetch_array($ab);

if($optiondata['perAdult']>0){


$ab=GetPageRecord('*','cityMaster',' id="'.$packagelist['destination'].'" '); 
$destinationname=mysqli_fetch_array($ab);

if($p<5){
?>
            <div class="col-lg-3">
                <div class="holidestibox phoneholibox">
                    <div class="card">
                        <div class="holiimg">
                            <a target="_blank" href="<?php echo $fullurl; ?>view-package?i=<?php echo encode($packagelist['id']); ?>&name=<?php echo cleanstring(stripslashes($packagelist['name'])); ?>"><img src="<?php echo $imgurl; ?><?php echo $packagelist['bannerImg']; ?>" class="img-fluid" alt="..."></a>
                        </div>
                        <div class="card-body">
                          <h5 class="card-title"><a target="_blank" href="<?php echo $fullurl; ?>view-package?i=<?php echo encode($packagelist['id']); ?>&name=<?php echo cleanstring(stripslashes($packagelist['name'])); ?>" style="color:#000000;"><?php echo stripslashes($packagelist['name']); ?></a></h5>
                          <p><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo ($packagelist['nights']); ?> Nights  / <?php echo ($packagelist['nights']+1); ?> Days</p>
                          <div class="holipricing">
                            <p><a href="">&#8377;<?php echo ($optiondata['perAdult']+$mackagemarkup['markupValue']); ?></a></p>
                            <div class="holiicon">
							<?php if($packagelist['flighticon']==1){ ?>
                                <i class="fa fa-plane" aria-hidden="true"></i>
								<?php } ?>
                               <?php if($packagelist['hotelicon']==1){ ?>
                                <i class="fa fa-building" aria-hidden="true"></i>
								<?php } ?>
								 <?php if($packagelist['transfericon']==1){ ?>
                                <i class="fa fa-car" aria-hidden="true"></i>
								<?php } ?>
								 <?php if($packagelist['sightseeingicon']==1){ ?>
                                <i class="fa fa-tree" aria-hidden="true"></i>
								<?php } ?>

                            </div>
                        </div>
                        </div>
                      </div>
                </div>
            </div>
			
			<?php } $p++; } }  ?>
             
             
             
        </div>
    </div> 
	
	</section>



<div class="container travelcontainer">

    <div class="row" style="padding-left: 3px !important;padding-right: 3px !important;"> 
    
    <div class="col-lg-12">
    <div class="card" style="border: 0px !important;">
    <div class="card-body">
    
    <div class="row"> 
    <div class="col-lg-3" style="padding-left: 3px;padding-right: 3px;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td colspan="2"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAABmJLR0QA/wD/AP+gvaeTAAAWEElEQVR4nO2deXhURbqH3+ruLJ19h6wQDFs2lrCFRQQCKrIow+aMggooOIjbvXdmnvHOvTo6M8+9OqjDOIPKuOECKIogiEZQtiSILAkBDDtZSdKdpbN1uvvU/SMsCekkp0MnwH36fR7+6NNV9dXJr79zqur7qgAXLly4cOHChQsXLly4cOHChQsXLly4cHHrI250B5zJeim1vcqLhyhaORGFcQhxG9AT8ANsQC1QLAR5SJktFc3OipCajKmir/mGdrwZ/y8EySzN7ys1mqcQ4n4g0JG6AioVWC8UVqeGRhzsoi460p9bl0xjfjJon5eSGYDGCU1+rWiU340JjDrshLY6xS0pyAEp3azGkt9K5HOAu5ObtwpYVV9t/t2E2NgGJ7fdIbecIBkVxb2xyY0IhnSxqSPCZpszKiz6ZBfbacEtJUhGedFABNuB6G4yaZTI6aODI/d1k71bR5C95cXDNUJuA4K72XSNlGLS6JDw/d1h7JYQ5EBZWbhFYzlI0xC2WxjsH4qnVnft5ZNCiH5dabeVxZuNnVLqGo3F60Q3igFwuKrs2ks5ss42sqvt3vSC6CuKX5AwztnttuEBrWiwWTlcVcZg/9AkzyBdnZSyS73kpn5kXRpRnUDgcaP7cgmbolGGdeU85eb2EJt8qavFuOwpdTYr2U2eAHDZK671Ii1wSEp5bTNO85qb1kP2G4oTbMhs7MzATQYD54/kUHA0l/L8fCqKSqgxGrE0mtEIgc7dDZ+gIAIjwgmOjiE6IZ5eg5PxCQpyRtek1MiU0YGRh5zR2LXctB5ikzyIuCpGXVU1OenfkZO+g4LcYwB4B/fAu0cMnlFJCLdjDB7jgxACS6ON2kozFRfzOf79CTI3fIYQgsj4gSSlTSR5chp6P9927V/2jsvvkGYIYROPAsu64LZvTg+RUopMY/EZoHd1WRl7P1rHwa+2YbNYCOo7GO/bRuAbk4Cbz9VffPk3z9MnwY9hk8Jw92z5O6upqOfM0TKO7r1Ifm4JWnd3UqZNZcwv5+EbEtKZLlb4BVX0TBAJjdd1o3boVkFyZa57jSF4rE3Y7haIUQjREynDL/WjXMJ5IcU+KWSJYrGu3LduA7veX4vQ6AgbOpmAQVNw8/K327ZitWAxGQmu/YSx0+yPkPMOGsg+N4q6ktOUHfoGpMLtCx4gde5stG6OPSykRtwxOjD8Bwf/BB3SLY+snaWlPp46y6+rDeJZhBIqLv8OWr4cYwTEIOQ4Y34BG57/I6WnzhA2ZCKhqXPR6X3ataHRueER2IPq4rZ/Yz9nm/EZNBifPkMJSrkHQ9Zn7HhrDbk7v2f2fz1HcHSU6nsSijIBcLogzliybpd95UX3emqtZ5HiLwhCOyp/YvceVi9eiqmihpjpK/Dtm0r9xXOYzh2lpuAEtsa6dusrVpvd60WnqjF7DQLRdMs6Dy963P4gfR/4I6aKGlYvWcaJ3XsduDOR7EBh1XSZh+yUUudpLP4f4ClUPhoPfLmFLa+8RkDPAAaMjiIwJJOgMB3uHloAGuptnMltoLw+Fr+ke0G0blanazUkxWK2sefbBvxGTWj1nVePWG775Ytc2LKST577b6Y9+yTDZkzrsK8SumRy2CWCSClFlrFktYRH1NY58OUWtry8kqFpsUxZmITQ2NewdzwUnC5nz473CRi2oIUoirURL8+W9aQi2fZREd6DltgVEKCh5BjxKXoa+/dhy8srUaxWRsy6t93+Cuih9t4coUsEyawoeQ2kajFO7N7LV399jaFpsdz5cOsnQXlRDT8frCYwzJP4EUFE3ebHWMVE5v6t+CTcc6VcQ+l5+sZejVdJCd98nI/sPR9tG4OBhoJDhOv2kDo1AojA2mhj2+t/xy8sjAFjR7fdaUn74+ZO4vR3SKaxeCpSPqG2vCG/gI0v/on+w8KZsjCp1fe7vihk544wKkMe5UTpGLatzUdRJFF9ffGWeSCVK2VtFT8THtv08rdZFba+dwFzj9l4BNoPn1iqS/Gu/Z7UqVdHZXcuTKJfSjgbX/wTxsKitjsu8MgwFO3JMBZOl1I6bbTq1GFvpsHgJzEfRWUAyWax8tbSxzHXlPHIi+NazR+y9xo4bRiBPmbYlWuNVRex5K3H29tCVU0A/iOuOmL1T+8wd5EXFRfrSN9YgWfCAtz87M8zpKJQu38lsx6NRHPN47Gx3sq/ntuF3q8ni/6xqsMhsYRvFMGSsUERF9Tcd3s41UOkNC/HgWhexvpPKT19lnt/PaSVGFLC8RxaiAHg7t8D7+FPQPwzLcQAEJ4hbHm/kPTtfviMWNGmGAA1x7dy+/TAVmIAuOt13Lt8KCWnTpP52cYO70PAFK0kZ5+xpOPRQAc4TZD1UmoRPKa2vKm8nF3vf8CQtN70jA1o9X1FSQ2awPhW123meurLLrR4VF3GN2E6uuRn8E3+BaKDpXUNFo7/WEVZQY3d73vGBjAkLZYf3n0fk8Gg5pb8hFQ+zygvXqimcNv9chLRFSVTgBi15fd+tA6hkdw+Z4Dd7+uqGxEel17EUqH2/EGqM/6G54V/cpvXF9RmvUJj1cVO99c74T5M4Y/x1QclbZa5fXZ/hJDs+2SD2mZ1CLkmw1h8d2f75TRBBFJ1EKm+2sRPW75iWFovPL3c7JYJjwvEw5hOTdYqrNmvMvS2LOYsDWPSnAiSx/TgvkejsZ14D8Xa+eWkhjO7GJnW9gqwp7cbQyf14qfNW2gw2fckO2iR8uN9pflxnemT0wSRUoxQWzb723QUi4WUO/u0WUarFUx/JIbZj4UybWEksYlBLaYRGo1g3LRgak87Mru+iunYVgbEnmXg8PaX5IffFYvNbCY7Pd2R5v2FVvtGZ/p1XYJIKUVWecnEfYaiV0G2M2hvSc636cQm98Db//piT8Hh3njoHZ9KVR9az+DEQhJHdRwf8fb3ICohkqPpOx01MznDWDjd0UqdFiTDWHx3prH4kCKU7wQ8CejV1KsxGik8/jMDR4V31vQVyqvDcY9xLNxuyl5P6tgq+ib7qa6TmBpK/tGjlJ4775AtKXnKoQp0QpCt8qRHRnnh35FyKzDI0frnD2cjpSRmYKfiEACYKhrY9K8Cso70dbiuuywjuq96MQBiE0OQEt5ZtvxKcEwNAjEhq6zAoTUvh/z9gJRuloqS9Qg5w5F6zcnPPYZ/qB9+waoc6gpV5fXs/bqa+kYvbLpgfJLvR6NzIK1XSkzHthLX2/G5sG+QHr/QQAanpPDpH17g4Tdex79HmJqqQhGau4A8tbYcEsRiKH4dQSsxmicGdIQhP5+QKMeWgU4cNJKT7YdP0uN4q0jdsYfp8FrGjjcT3qdziY+B4QE01NVz5733sO/jdcRPuIPd77xH/vHjAEQPHMiIub+g3+jUFvWkYBzwulo7qu8u01g8VUppd+KnRojLGAuL6JPgpbr8qcMGjub1wXfwXarr2COmj5bwPp1fD/QP86X4dAGLnlnO43MWcP7AARY9uYwho0YghOBw1o+8/eo/KDx2nAmLr64gCEhwxI76n5uUL3Fp7ctekpmdZAC71JtMePmpe4ZbLTYO/eSFb8r1iaFYTAwd4wlYOt2Gl6+OC1XVRPaKYuLUKTzy9OP4B17dG5Q6cTyJKUNYNvtBIuMHNveUDoNyzVElSEZ5YZqEwZc/O+IR19JYV4/Ow/5k8FqqzeH4prQOKjlK7eEP0aYEcD1rqW4ebtTV1qHRaHn6hd/bLePr78fSf3+SDZ981lyQ1utC7WBXECllHtDhEKZZmiXQOrmsLa8x25lc52YZKDhtRqu1MfT2IILCvTm4o8iBxRj7NFaUEB1jtruI6AgS2VZ8qwVDR4/klf/6U/NLJkfs2BXk2iy8jPKig+1tkGn+R+/Ie9y89OT9VM64Gb2vXDuyt4JThlS844fQaLWwfdNH3HlfHXWVZtyvU5CGU1tIWeDQU8Mu5nrQe7X/7ivOLyRr1x5sVgsfPvsfjJw7h7iRwx16nLT7yLrsKWabzXaoqrSjNMtW1NusHLlGIC9fP6RbGEczyklMbZqLlBRY8O7fpLdG54bf0DlkZ7yJxNORe2mFtb6asGATbh7XH9yrN1nxC2j73bd/117yz57nzlkzmDB1Cj/uzuC9l/9Kv3FjrI7YafcvetlTMgxFZkDriCe0RVBkOFXVCrl5PdBoLhI/MoSwcEHe4U/R6Dzw6jcZrbsXVZU6bNcZiJMl+xkx2Tn7e6rLTPSMajtN6GzeaeYtXnDlc9qMqQwfl8rjcxfE3Z00YPy2nBOqUoZUzdQltAgIDPYPZVRQ+BWPcYSQmBhqL+bjP2g2uSd7sfvLQpLHhHDvvAYm31lGbe7nAChBo9CEDuugtfZJHhuMl69zcrUrio1ExfZq8/vmYlzGPzCQR59Z4e7t7f+KWjtql04Km384XFVGprG4U14SnRBPreEijSYDvonTMPrMZuOacs4crcY/2AtPbRXQFCn0jEpxuP3mlB7Pua76l6kyNGAqN5AwuHXMvyOSh6dQX1+XqLa8KkEE7Ha4J20QMzgZIQQ1+U1rQh5BMfiOWM6J0rF8tsZIad5pTBdyMVcUYa4qxdZQ2/TPXO+wraLTlU7p8/GD9QghiB/ieG6cu6e7Q6NtVfMQqRGbhCKfdrg3dvAJDCQyfiC1Z7IIir+6UquPTIbIZNz6l1H23V8ZPqkHVpsGa7XEZhU0NlhQpAZTpYISMg59r47DL0roeL7b8B3D7gjEN1jf6aHvqR+LSRiS3GIiqJbDmT+i99KrdlVVgqQG9NydaSg+5Ky94Ulpk9i+6g3Ca6vQebfMl/LwCyV03DIUNpEywf4C3uZ3dkHM8DYT3y6jjxpEfX0s6Tv3o9SV0bTRRiCslSQOFQxM6XjOZqqwUHTiDDN+4/jv0VRVzZpX31DMNuVFtXXUPbKEUITgtw73qA2SJ09C5+6OMXu73e89gqMpL2o7NJuQ4oMpb4cqWzq9H9790vAdfD9+Q+7Hb8h8fIcvJeeQO1aL/Tzg5uzeUo67pwfjp05RZQ+grqaWvek7efKBxfSfOEHz+62bVYdzHfLhDEPRa8AKR+o0x9poZvcHH5H77Q4qSkvx8PQkMHkKISNnotE1W06RCrq8laTNa3uYmZtpIHt/A+69J6OPGNCyvgrMFYXEaD9nyO1tjxTrayy8/utvUaxX18DCY6JYs3k9AIumz6P4Qn6reh56PTHxAxg+dzb9UkcBmGyKW+TY0NAOZ+0OCbJTSp2noWQjQjocmrSYzXzw1L8RFhTIA8seIaZPLAXnzvPu31ZztrCaXrN+g9Be+qNKiebESqbcH9lum1JKTmcbuHDSTG2dB41eiXjHjVfdJ/PB15j5SNu7rTeuPs+5n07yxIfvXvd2OCF4cFRQxNqOyjkUXJgghHWnlLM8jMUvXwrbqmbvhx8TFhTIC6v+98q1uIH9+eOql/nDit+Q//2HCEstVedysFks+IX4Y7zDn6DwtveFCCGIGxRC3KW45ba1BwD1gtQrwTQ2WFsl6QHkn6wlb08Ok5cudsreRCmZBXQoiMMh3AlCWEcHRzyFlJMRqD5f6ug33/HA463zr4VGw8MrHsOYs5PJ4xN5a+MH/GvzOu65byYfvZSFyah+uCsdzB13jxjBqezWTxFzvZVNfz9MRN84Rs6e5VCbbfdN3faFTme/p4ZEpksph++rLB6rUZgJjAMRCbIHoLVZrexY/TaHt3+DRghqKqvofZv9tJ8+/eJYt+tr9F5Xw7rzFy8EJDs/2s6M5YPt1ruWukY97e+zaolXeBxnj24jvtkIWkrJp6tO0lhXz+zXn0Orc84GAaEyxfa6rAkhFGDXpX9XyDAUWXe+uUZrLi7inxveR0rJ3vTvcXNvOwbeXIzLTJ4xjfVr3lPVl4K8SghQPSFuQmiobfBCyqsj6M1vnaEg5zTzXnyewMgIx9rrwJqaQk7dHzIlMTHax0f/5p/vmq61WS28u3UjQaFNi3szfzXXobaklJw8dhyL2cqnLx9g0oKBBIZ52y2rKJKsHTX4jEy1+317iIABlBX8TGiUD5vfPk3uD7lMffoJ+o9xvK0OKOy4iBO3I0xJTIz29HDL+eWjD3lPnD5VFxAciFar7XR7n7z1HglDBxEQHMTOzVvZ9sXn3P/7ka1EsTba+PrDApTYhbgHOL6pydZYh+e5Nyi9UMX5I+eY9uyTpEy/p+OKjrMxNTjiFx0VcpqH+Pjo35zz0K+85yxa4JQ2PTw9SEppencseGIpeh8v9n62nWnLrq4n1ZksfLX2IvqkR3D36Vyel9lYQt7OU0ibjfkvPd8VngGAlGKTmnJOE6ShvuGOSTPucVp79z04v8XntOnT+PSd9698rjI0sO0TE37DH0fj7liOF4CtoZbyrI2UHNhOz7g4Zj//nwQ5951xBQGVDdqGL9WUvWmP1rgWRbFhsTTtCbHZJN9uMOA/akWH+0CuxVpbhfHI15QdTEdoIG3pEkbOnuW00ZQ9pJB/nhAYq2rp2Wm98PD02JW+acvEeUse6pI7++bzzQgEa/+SQ0CQBsJnqRaj0WSg5nwudWezMOQdQefpybCZ0xg9f46zDqRpj/0NVY2qE+Wc9lK/K7l/f3c3fdb8xQu902ZO0wWHdT53tzmG0jLSv9zKxrXrGDpzOmd/OkT+0VyklHiHhKEPjcLdvydaTz/QXhpWK43Y6qqwVJdQW1pAnaEMIQTRSQkkTZpIUtokPH0dmbF0mnybYh01NjSmnd2jLXHqps+7k+Oi9F4BqxvqzRNtVmubGQqXF+j+sPxZXlj1CktmzAPgrS/XsWj6XIovFFwp6+ntTdzwFCY8upjgqKa1rdrKSs4fyaYg9zjl5y9QUVREbVUVjXUNCAFuej3e/n4ERkYSEhNNdGI8vZKT8ApwKEXqetlvU6z3OSIGdOHhMwekdLMYi09x3ZlVtxYCKqWQf64IrHutM2fKd+lpQPsMhYsE4u2utNHdCNgloRwYCoQBClAAHEeKTQ3ahk1qX+BttN91SCk1WcaSPRLZNYP77qfKTXEbOCw0tLirDHTpaUBCCEWxWRcA1V1pp5uQErGkK8WAbjieaXRY9CkQS4DWx/R0DwrId2n6/0M63YYQYvno4HDV+6M7S5cLApAaHL4eeLY7bF2LlPLJ1ODIhzVCzKQTniqgUsDcUUHhndpV6yjdIghAanDESuAZus9TFKRcMTokchXAyKDwr4RV20/AakBNvq0NeE+DTB4VHPFZl/a0Gd1+CGaGoXguyLeha443ukQ1kodTQyLsHlSyp+xChFbrNlNKeY+APjQFj7Q0nfuYrUF8r0jrx6NDolUtmTuTG3IqaWZpfl+p1b4DjOmC5vdotJoFIwN6nu2CtrucG3ZMbNOpc0UPScQfgN4dVuiY81LI36UGRnwihLhRA4jr5oaf23tASjeroXi+1PAwkvE49l6zSeQPoPmne1DPL4YJ0flNhDcJN1yQ5hwoKwu3ai2TkIyVkgEI4gAfwF9ApYQqBGdBHAWZqdEpX4/0i1J1dpILFy5cuHDhwoULFy5cuHDhwoULFy5cuHDRffwfp74XnMIt2gAAAAAASUVORK5CYII=" width="64">
    
    </td>
        <td width="90%" style="padding-left:5px;"> 
        <div style="font-size:15px; font-weight:600;">Travel With Experts</div>
        <div style="font-size:11px; font-weight:600; color:#666666;">10000+ Happy Customers</div></td>
      </tr>
    </tbody></table>
    
    </div>
    <div class="col-lg-3">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td colspan="2"><img src="data:image/png;base64,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" width="64">
    
    
    
    </td>
        <td width="90%" style="padding-left:5px;"> 
        <div style="font-size:15px; font-weight:600;">Travel Safety Assurance</div>
        <div style="font-size:11px; font-weight:600; color:#666666;">Safe holidays with assured stays, clean cabs &amp; 24x7 support</div></td>
      </tr>
    </tbody></table>
    
    </div>
    <div class="col-lg-3">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td colspan="2"><img src="data:image/png;base64,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" width="64">
    
    
    
    </td>
        <td width="90%" style="padding-left:5px;"> 
        <div style="font-size:15px; font-weight:600;"> Flexible Cancellation</div>
        <div style="font-size:11px; font-weight:600; color:#666666;">Cancel or reschedule your holiday to suit your needs.</div></td>
      </tr>
    </tbody></table>
    
    </div>
    <div class="col-lg-3">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td colspan="2"><img src="data:image/png;base64,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" width="64">
    
    </td>
        <td width="90%" style="padding-left:5px;"> 
        <div style="font-size:15px; font-weight:600;">Unmatched Pricing</div>
        <div style="font-size:11px; font-weight:600; color:#666666;">Best deals and offers in the industry</div></td>
      </tr>
    </tbody></table>
    
    </div>
    </div>
    
    </div>
    </div>
    </div>
    </div>
    </div>
	
	
	
	
	<div class="container lastcon">
 
        
        <div class="row" style="padding-left: 3px;padding-right: 3px;">
		
		<?php 
	   
$sql="select * from quotationMaster where status=1 and name!=''  and id in(select quotationId from sys_quickPackageOptions where perAdult>0) and showOnWebsite=1  group by destination order by id asc"; 
$rs=mysqli_query(db(),$sql) or die(mysqli_error()); 
while($res1=mysqli_fetch_array($rs)){

 
$ab=GetPageRecord('*','sys_quickPackageOptions',' quotationId="'.$res1['id'].'"   order by id desc '); 
$optiondata=mysqli_fetch_array($ab);

if($optiondata['perAdult']>0){

$ab=GetPageRecord('*','cityMaster',' id="'.$res1['destination'].'" and name!="" and stateId in (select id from stateMaster where countryId in (select id from countryMaster where name!="India")) '); 
$destinationname=mysqli_fetch_array($ab);
if($destinationname['name']!=''){ 
?>
        <div class="col-lg-3" style="margin-top:10px; margin-bottom:10px;">
        <div class="card" style="box-shadow: 0px 10px 18px #29426917 !important;margin-top: 0px;border: 0px;">
        <a href="international-holidays-search?holidaysdestination=<?php echo $destinationname['id']; ?>&Submit=SEARCH&action=flightpostaction&changesearch=0">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tbody>
            
               
            <tr>
            
            <td colspan="2"><div style="width:60px; height:60px; margin-right:10px; overflow:hidden;border-radius: 5px;margin-right: 10px;margin: 5px;"><img src="https://ofc.happymytravel.in/upload/167705594118143635871675241541.webp" style="width:100%; height:100%;"></div></td>
            <td width="90%" style="font-size: 15px;padding-left: 10px; font-weight: 700;color:#000 !important;"><?php echo $destinationname['name']; ?>	<div style="font-weight:400; color:#000 !important; font-size:12px;">View packages from <?php echo $destinationname['name']; ?></div>
     
          </td></tr>
        
      
        </tbody></table>
        </a>
    </div>
        </div>
          <?php } } } ?>
             
                 
        
        </div>
        </div>




<?php include "footer.php"; ?>








<script>

    $( function() {
    $( "#departuredate" ).datepicker(
	{
changeMonth: true,
            changeYear: true,
            yearRange: '-100:+0',
			dateFormat: 'dd-mm-yy',
			maxDate: new Date()
	
	}
	
	);
  } );
  
  
  
 function getSearchCityHotel(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchcitylistshotel.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
}
}



var $filterCheckboxes = $('#allFilterDiv input[type="checkbox"]');

$filterCheckboxes.on('change', function() {

  var selectedFilters = {};

  $filterCheckboxes.filter(':checked').each(function() {

    if (!selectedFilters.hasOwnProperty(this.name)) {



      selectedFilters[this.name] = [];



    }

    selectedFilters[this.name].push(this.value);

  });

  // create a collection containing all of the filterable elements



  var $filteredResults = $('.itemlist');

  // loop over the selected filter name -> (array) values pairs



  $.each(selectedFilters, function(name, filterValues) {

    // filter each .flower element



    $filteredResults = $filteredResults.filter(function() {

      var matched = false,



        currentFilterValues = $(this).data('category').split(' ');

      // loop over each category value in the current .flower's data-category



      $.each(currentFilterValues, function(_, currentFilterValue) {

        // if the current category exists in the selected filters array



        // set matched to true, and stop looping. as we're ORing in each



        // set of filters, we only need to match once

        if ($.inArray(currentFilterValue, filterValues) != -1) {



          matched = true;



          return false;



        }



      });

      // if matched is true the current .flower element is returned



      return matched;

    });



  });

  $('.itemlist').hide().filter($filteredResults).show();

});

 
</script>
</body>
</html>

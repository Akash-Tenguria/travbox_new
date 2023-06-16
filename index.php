<?php
include "inc.php"; 
include "config/logincheck.php";  
$selectedpage='dashboard';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Dashboard - <?php echo stripslashes($getcompanybasicinfo['companyName']); ?></title> 
<?php include "headerinc.php"; ?>
</head>

<body>
  <?php include "header.php"; ?>



<!--------------Left Menu---------------->


<?php include "left.php"; ?>





<!--------------Mid Body---------------->


<div id="midbody">

  <div class="mshow">
 
<div class="dashboardboxes">

  <a href="https://partner.tripzygo.travel/new/flights"><i class="fa fa-plane" aria-hidden="true"></i><h6>Flight</h6></a>
  <a href="#"><i class="fa fa-bed" aria-hidden="true"></i><h6>Hotels</h6></a>
  <a href="#"><i class="fa fa-suitcase" aria-hidden="true"></i><h6>Holidays</h6></a>
 
</div>

</div>

<div class="bodyouter">
<h1>Dashboard</h1>
<div class="bodysection bodyflightsection">

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top">
	<div class="dashgraphcard">
	<h2>Sales Performance</h2>
	<div id="chartdiv"></div>
	<div class="chartsalesouter">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="pricetable">
  <tr>
    <td width="33%"><div class="smalgraytext">Flights</div>
	  <div class="fontsize18">₹<?php
	  $ag=GetPageRecord('SUM(agentFixedMakup) as totalmexmarkup,SUM(agentTotalFare) as totalfareagent','flightBookingMaster',' agentId="'.$_SESSION['agentUserid'].'" and status=2 and YEAR(bookingDate)="'.date('Y').'" ');  
$rest=mysqli_fetch_array($ag); echo round($rest['totalmexmarkup']+$rest['totalfareagent']);
?></div>	</td>
    <td width="33%" class="borderleft"><div class="smalgraytext">Hotels</div>
	  <div class="fontsize18">₹0</div></td>
    </tr>
</table>
</div>
	
	</div></td>
    <td width="40%" align="left" valign="top">
	<a href="<?php echo $fullurl; ?>flight-bookings">
	  <div class="blkcolorboxflight">
	  Flight Bookings
	<div class="fontsize30"><?php
	  $ag=GetPageRecord('COUNT(id) as totalflightbooking','flightBookingMaster',' agentId="'.$_SESSION['agentUserid'].'" and status=2 and YEAR(bookingDate)="'.date('Y').'" ');  
$rest=mysqli_fetch_array($ag); echo round($rest['totalflightbooking']);
?></div>
	
	<img src="data:image/png;base64,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">
	</div>
	</a>
	<a href="<?php echo $fullurl; ?>hotels-bookings">
	<div class="blkcolorboxhotel">
	Hotel Bookings
	<div class="fontsize30"><?php
	  $ag=GetPageRecord('COUNT(id) as totalflightbooking','hotelBookingMaster',' agentId="'.$_SESSION['agentUserid'].'" and status=2 and YEAR(addDate)="'.date('Y').'" ');  
$rest=mysqli_fetch_array($ag); echo round($rest['totalflightbooking']);
?></div>
	<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAClElEQVR4nO2bzW7TQBDH/RpFHFCsHhEthyTqE1AqeADEBVqucEJw6nNAT74UIrcXQBxpDxU3SkqlZpWClHrb+ECRMEIpZHsYtJsGxY4/YtXx2rsz0v+yGiuan2dnJqu1YaChoaGF2M+l6kdvqQZ5qVufA+fmdZ9+3J+F/ssrwKyZWHGf30+vgbdiDrRcOf71qLJoXMa8HIPnCgbP1X+RHPwohP8AhCq09ADYRXCd1jZ0WltjQQfX/QBMuByA29WdPAGc1G9EAiCuJxQEEFzPFMDQ1ne+gSwhAMv/pqM01QwgCT+elSbJAO0BMBk1gATIV9+fgmm7cHe3D/cI+PT88Dy1X+kAmLYrFAxqqLR+CMBNzgDe648OPoTMAf51ZTOATSilAZw15oE2bWjTrhDd24TexoIeAM4a83DoOGPP8LU/r+fUB0CbtvChX96IgLmc/beDtc8N9QG0aVf4jL5tnhV8rU1P8gVQu+jvdz6N9/dnX89T+5WuDRIJo3BsBjjH6gOge5vCh+97HjiXs/9uUAOatvqjcG9jIbIL9Oy6+kWQWTMi/XnF50WPi7/50eCVB8B0ngQ7re3I2jG1M8FiAdiKBKDdnyESMRMgAAszAJQdhVmRtgCRMAkiAKtAGVCVMArHnQNq1wUYToKefpMgiSmeWkyCJKbwaVEDSMKfIC0BHIV0AuUBsCJsgVqBToW1GYVJzHO5t0EiAUChDkSIBABSJ8Hvjx9kfgOUK10GhN8TzAWAN4ULkGkBSC2Cnu4ATp88zPwGaKkAkIhBKErDXp/khwBczADALeCWcBI0JdSAQk2CZo4A/q5dlffFSBEA7L5anQjC2DdDKxXqLZu3jLIDWA9RJkEhgBRGdM8ANDQ0Q2X7B13GZa113F5YAAAAAElFTkSuQmCC">
	</div>
	</a>
	
	<a href="<?php echo $fullurl; ?>holidays-enquiries">
	<div class="blkcolorboxpackage">
	Holidays Enquiry
	<div class="fontsize30"><?php
	  $ag=GetPageRecord('COUNT(id) as totalflightbooking','packageEnquiry',' agentId="'.$_SESSION['agentUserid'].'"   ');  
$rest=mysqli_fetch_array($ag); echo round($rest['totalflightbooking']);
?></div>
	<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAOR0lEQVR4nO1aCVSU57n+NUYT06RNU22b05uT2jb3tLnXBRdghkVlU4kUIhDZV/W6RY0yoKKiYqQQFhFEEEGYGUyItk1i0xhxZtiEYUeQYRdUthmWAXFBhnnu+f6fGWYYNNaAEo/vOc9h+Gf53vf53vX7f4p6IS/khbyQF/LTFWD9y5D7OaRcP5plXxLbt0h86p5NaVzR+qL4mdTzLuj1X13evq/ZuDABlJCvxq+yzoRSz7MAO15Fr19CWtNRzMzk0UbPyORVUQL+HkrA+5h6ngU9234BOScrtPYzTBEyxqtxmfch9TwL2na+NtTrL952LUrbcAIB7xD1PAtATYGc81VAVaSm4RmUgB9GCfjbqJ+MET1+eujhrIOcsxe9fkch9/NHr78r5AELSUZ/6Hfl/ht514+O2nmeghKm/g/1U5Do2tADPleP9xkVJuDPeaexID8RSwsTsKEiGpF1ofju5mHIuwL6Ief8A31+tsCBaZpx3yzb2/16JneU2/P3Uz8FWX/1WIoqYf08K/X2SyLuoE4MC/mYJuLBpCgBCY0huN3FqYF8lyX5PuScLa7lMVqfNRQnRqCHY894ECeEgV8Q7V19/kbA1hnUZJGlBSf3TBdx0ykBr4S6zLUc5cYDlIBXO5qMX+ekIKHhb0pFH4fTKA3MeFnEo7O+W3kMaqT72v99MxikEmyqPEZfcy6PxcaKaJAcEVYbhvPNwffrZIEX0OdvQk0qEab/jBJx7SgB7ygl4H1PiXjLKAE/byyPIHAqi8GpxhDZjEwuIYQ29pXh2v9DIIQtFicirC4sGzjwCjVp5XLa+5SQ70sJ+YlLxIl168qjlf5VkfTu/j43GX7XIh/4VhzHa6NzgC5yNP9/PTOlQvXasTS2mposAlBTITd6E93sd2j02/0WvX477nYHNHze9CnWlsVizpVkvJmVinn5idhUGT24pixW4VIWg0BJhPLLpk+HImrD7s3JTZZTAn63Gpf4c+hwUl/jcSgh74upQp78tczU+3srQv/wbAyWG70JGcsFMtZpyFhlkLHvQsYGjS4bDPRsp+P2Nzln1LtHYt5fEgnL4jj8+crpHpP4Q9enCEZ2l1SQkrb9D9Dr9ylwYDo1GQUdhizI2F9CxrqvNliFTiOg2wN5rUF4Ly9Jy5WnCvkgnvB+/mlmuMk+E2/h7PuvP4QeFk8R8JSaVSOk9jOQ7hC3d84eV+X9rkXario+0WpdfKL/YPVnN0va9nMh51g9luGdRn+BlH0ZnWZApzVuy1YzBqsJMIWyZyOi6sIwfYyEdrwumO4PVP/H1awvryparmfp7LuQusz1pgT8Ic3Pu5THYKCHU49Ozu/GjQDDgvjFb2Sm5M/OThZPFfIUJKPal55Acdt+CXr9Vo1pOBxeQqdN7N0u96HkxiP4a2kcfpWdQiv5Xt4pNLdaA53GkHduhkXRSbUB7+bE0X9nZqbgRO0W1HQE4iXRCDHNLVbIyVgx6LLZo9nK1dtzLBIcSmOh6OFUkKaJGlcR8uZTQv6t4YFDOVXIozP03Z6AKM3YQ7fDO/e61rUcrgnHrOyRWH7vSiyOVH2MbxqdASkbPVIvugvUVD7tmjvci/ehvnkl0LUWmsPO2zkJtNfUlZrB0sUHScm21ehc8gYl5HuNJoH0AZD7nR9fAlS1W8D1oIT8eNVi+gUJuCHd8yV5G92O87JbAh/86UqSeidti4OhL47A140uULazobyuj8GG5TAvOkknONXvvClKQlWlJYaqFzPo3ILZOYzXENgVB9ME3GsxQnG2JcquWKCzwfQq2gxnM57Au00JeedUnydtNZktqAmRy9z/poS871SLsQsT0NX1yScXb+67rzqYoMkRR+BWqyXQwYayyUBt3KnqPfT7a8TBeDcrDnZ5B9FStXTE+DpjFLcd0PKO0KrN6tyR/rkNrFx9UZhtBchY5egx/QV1MXU2JeQf06weubeCpOPa+KBn13z0cg7KugPOi24drDzXFFwXWht2R0+ciKjakIHf5qTgo7JYHKsNRlX7Jii77KBsW4ahmmHDhmFcwMS9a34g2qtMtd4jUDZZI6b+b1oECK/aQdliSBMQGuWADzy8cTbNhiFFyv6KTJiUMM1VMxxIiA10czx+tOGDfbtt/3XjUOPWyij8PjdJK95IkjIrjIdX+XE6CxO3JddI0jMrikdQdTgkrTuhbF6NoZoltIFscSw2iHeju8pIx3iagBZHbKk8Rv++QU44bPMOoU/CYt5rNoC01hT3WozR1WAyUlGk7O20skLeOpKjZoi4dDcY1xCS/+Q7jq0zkhuPChbkJ6prLiXkd6peu1893h8oCVcQo70zDuGd3GTslUTgw9ITOr24aWE8vm/eg6F6U3RLTLSNrlrEQEVAmytNHvnudFEqMso/1Pp8RNQaWLv7ICzKXrOnuIM2/XdpxQX8hZSQH0S+b1sS2/fEBHxcGZlLlJ8u5DYMZ/8SSshzo4S8HSXtQafthg3Vy45G2DFHeJUFMf12WSwu1W4FOzcMf8qKxbwcZjcJPiqLgbzWCoriBVDkzsWg6H+1QK4pb7nhndyRCrJBHKBFQHyMDV0JQiIdtJsqGftztfICvgtplvTFCXeemIC3slP6p2fyvqAEafpUBn8JlZ7+Eu0ZPbvWkHBQdWsJl11wPG4N6ltWYZqIGVSO1IRjqGE5bksM8XW5I+3KS3LD8eus01hZGKNjuCaGGp2geeiRVOqhRYBEYIKWAjYaSpdrEyBlD6GL/b5K/1mZyZsdS2IuPjEBpsKR0xiVoG/3rK+agvtVBxsby3djqMMINcVmtBKehYH09VdFXNS3fjKiuGQx+vIWIUnoBMOcY+jPWvhwAqrtaAJ+IzqFl4VcXK1YoUVARYYpNu10wUo3n9EeAEhZMdREykAv5/Cc3OQHJNG8lZmo7GozQ/IZW3Q1mAIdLNRcs8A0IbN7JCkqrzPKD+bPe+Sua4VByXJ6/H07KxFikQUG8uZrEfA1fwUsnH1h6eJL9xbaJLBkwF8mZigCDryS0BDST4z7r+yToswmJgYDj6xFXPyHdIYmCoYU/R/t7tMzuWhrWQ9Fid5jG08jax7sS5ijr9WigwwppXpqAhSSxRD93Rxum9zxoNFwDC8wnJjTH/TuMjQsYG4//TE3tlm14I5AZ4RH22Oolilz96v18bqISWLhtaEYzNJNdj+ESyXedPXYJ9o0TMpcDEmYSvFFkjVOxdqgu8QAilp9XQJk7KAJIUDcGrR3ZiZXQQl4sm8b1+aoFrzwT2tUF5lrualLPpMLVpfEYTDn4fH+KKQVbkBuzuqR0Bj2gshwOzoE1m7wgEKyhA69UcnwnxNCwGe1YSeZcsg1g4xVo1rwuwvWOJ1oq0VAXaU5thXswtu5Z6DIN3giAnSQz+SCfUEONAErXH2GG6dRYSBlSyaEgND6cLuZWdx7VFb6LEhZPaoFt+91wUcbPHU6Om/xHsy5kkTH9HgQoMieS//u0ZA12L3fETFRDOnKmzoEdFETJZ7lx/XIX0jZD1QLnj+3Gm6b3XGnQl+7XldaIrlwOIbHCSQBNmYbQ3xhOfK+MWMIuKFDwANqogUax1v1ZWZ0X0/icbQXDGaNn/GDmXNRKzKh3Z9g/yHHYQIMRifBu0+DAJlqQTKVkfH027NWOgQocuaN3+7nzMXZ09ZqAkglYEJAh4COp0AAu1S1YJ7QCk4bPfDdF2MQUDB//AgQz1cnQILv05kDFGXr6F6AVfQ0CDirWnCwzQh9Tca4kLYC/Ve188BQ+ZOVwLFwt3gxOgrY2LLLmSagVcym14B0dBlk8SeeAClrh+ai3jvcaKUICTpekPvjw4D8Bj/xA+w54IjOYkOciP4r8/v1YzRCUsOJfzwG7UZzNRc9k2IL180e2BHgpEvA1R/vBQNli+C80YMmecMOV7QVsB8W/9CcCCeWBClbolr0fqsxOmpMcb9q5OxPi4SSBU+++yV6yPyHhTr2CUouLqNbb133Z1c9FeOJoJO9W5MAOx9vWrnDR+zHJqFU7wmMX4DBqsVYv91FbbzXVje6H1DeGmMQkrEDqKclkBv8ElJ2n2rxqFh7tZKVl03HJqFyEQavPEZluDIPigpm+PmKx4y/Kpw7swpDdWT3R8c+u5fcf3xqBBCBjHVYpYCk0JxW0HWLO8ovLRuTAE0iFEUL6P6eJDg6UZLXRQvUhqvw78+t6PqvgrzcQHcAmsgp8FGCGwavQsZqVClxLt0G8iYTejgiij+KhB8CcfO/p66kGx4VrmUsBdrGMF7KbkLLwmfzWCxkrGWQshREkfaapXDfymRrGy9v3Mwf++j7caDZ9RE4rvdEf4PmzVV13R+csEOQxxVIWXuJMop2I3huc8dKdx94bXcHN9UGQw26M8IPgSS+gH0faRFw8RvrsdwekBn5U5NBIGNHE4X6b5hgoNUILZJlKMiyRMa3qzB0y5BOXI9jPCl5ZNztKGDhPHcVVrr6wP+QE5Sjkx6z+yepSfUApIwdoTon1Ny9mJNroCT3CFsM6RukqrtEo0EOPMlgRb7jsN4TBZmWqCwwR2e96ZgnwOQxG2qyCWTsnW3VSwdJDtAkIeK4PQbbjXDnpjFuN5ugXWKK9mum6Ks3Qle1MULDRwYdFVa5+6C9ZpnOvK++FTZZ5UE7yzAh0Vb6gacPrD28scLNB1auDEYbqQnyPjnvJ4av9vJG+lmb0cZXoNNIn5qM4uDgMN3S2fcDCyffVHMnn45HGfqfYO1GT4REONxJT7M5IRSaTr7n/Mzc3N4yd/LZP55GPwzmTj43LZx8/Va4uLzxrO2mTE0PTDN3WrfNwsm3Z6INH4OIDnMnH1+KoqY8E+NXOHjNsnD2ufS0DR8DFywdfH75TEh4IS/khbwQ6jmR/wdS0sKv/aunMgAAAABJRU5ErkJggg==">
	</div>
	</a>
	
	
	</td>
  </tr>
</table>

</div>


<h1>Recent Booking / Enquiries</h1>
<div class="bodysection bodypricesection" id="recentbookingid"></div>

<script>
function recentbooking(id){
$('#recentbookingid').load('load_recentbooking.php?id='+id);
}
recentbooking('flight');
</script>


</div>

</div>

<!--------------Right Side---------------->

<div id="dashbaordright">
<div class="inlistright">
<div class="rightbanner">
<img src="images/toprightbanner.png">
</div>

<div class="tourcalouter">


</div>

<script>
function tourcal(d){
$('.tourcalouter').load('load_tour_calender.php?todaydate='+d);

}

tourcal('<?php echo date('Y-m-d'); ?>');
</script>

</div>




</div>






<script>
am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
var root = am5.Root.new("chartdiv");


// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
root.setThemes([
  am5themes_Animated.new(root)
]);

root.dateFormatter.setAll({
  dateFormat: "yyyy",
  dateFields: ["valueX"]
});

var data = [
<?php
$begin = new DateTime(''.date('Y').'-01-01');
$end = new DateTime(''.date('Y').'-12-31');

$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);

foreach ($period as $dt) {
$month=$dt->format("Y-m-d H:i:s");

$month=date("Y-m-d", strtotime($month));
 
$ag=GetPageRecord('agentFixedMakup,agentTotalFare','flightBookingMaster',' agentId="'.$_SESSION['agentUserid'].'" and status=2 and DATE(bookingDate)="'.$month.'" ');  
$rest=mysqli_fetch_array($ag);

?>
{
  "date": "<?php echo $month; ?>",
  "value": <?php echo stripslashes($rest['agentTotalFare']+$rest['agentFixedMakup']); ?>
},
<?php } ?>
];


// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
var chart = root.container.children.push(am5xy.XYChart.new(root, {
  focusable: true,
  panX: true,
  panY: true,
  wheelX: "panX",
  wheelY: "zoomX",
  pinchZoomX:true
}));

var easing = am5.ease.linear;


// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
  maxDeviation: 0.1,
  groupData: false,
  baseInterval: {
    timeUnit: "day",
    count: 1
  },
  renderer: am5xy.AxisRendererX.new(root, {

  }),
  tooltip: am5.Tooltip.new(root, {})
}));

var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
  maxDeviation: 0.2,
  renderer: am5xy.AxisRendererY.new(root, {})
}));


// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
var series = chart.series.push(am5xy.LineSeries.new(root, {
  minBulletDistance: 10,
  connect: false,
  xAxis: xAxis,
  yAxis: yAxis,
  valueYField: "value",
  valueXField: "date",
  tooltip: am5.Tooltip.new(root, {
    pointerOrientation: "horizontal",
    labelText: "{valueY}"
  })
}));

series.fills.template.setAll({
  fillOpacity: 0.2,
  visible: true
});

series.strokes.template.setAll({
  strokeWidth: 2
});


// Set up data processor to parse string dates
// https://www.amcharts.com/docs/v5/concepts/data/#Pre_processing_data
series.data.processor = am5.DataProcessor.new(root, {
  dateFormat: "yyyy-MM-dd",
  dateFields: ["date"]
});

series.data.setAll(data);

series.bullets.push(function() {
  var circle = am5.Circle.new(root, {
    radius: 4,
    fill: root.interfaceColors.get("background"),
    stroke: series.get("fill"),
    strokeWidth: 2
  })

  return am5.Bullet.new(root, {
    sprite: circle
  })
});


// Add cursor
// https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
  xAxis: xAxis,
  behavior: "none"
}));
cursor.lineY.set("visible", false);

// add scrollbar



// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
chart.appear(1000, 100);

}); // end am5.ready()
</script>








<!-- HTML -->




  <?php include "footerinc.php"; ?>

</body>
</html>

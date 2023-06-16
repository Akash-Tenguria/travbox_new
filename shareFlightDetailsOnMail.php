<?php
include "inc.php";
include "config/logincheck.php";
$mailData=$_REQUEST["data"];

if($_REQUEST["action"]=="shareonmail"){
	$to=$_REQUEST["email"];
	$subject=$_REQUEST["subject"];
	$message = $_REQUEST["data"];

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <info@tripzygo.travel>' . "\r\n";
mail($to,$subject,$message,$headers);
?>

<script>
 let new_window =
            open(location, '_self');
       
        new_window.close();
		</script>

<?php
}

?>

<!DOCTYPE html>
<html>
<head>
<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row::after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>

<link href="css/main.css" rel="stylesheet" type="text/css">
</head>
<body>

<h2 style="padding:10px; margin-bottom:0px; font-size:16px;">Share Flights</h2> 

<div class="container">
  <form action="" method="post">
  <input type="hidden" name="action" value="shareonmail">
  <div class="row">
    <div class="col-25">
      <label for="fname">To Email</label>
    </div>
    <div class="col-75">
     <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"> <input type="text" id="email" name="email" placeholder="To email.."></td>
    <td width="10%" style="padding-left:10px;"><input type="submit" value="Send"></td>
  </tr>
</table>

    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="fname">Subject</label>
    </div>
    <div class="col-75">
      <input type="text" id="subject" name="subject" value="Flight details" placeholder="Flight details">
    </div>
  </div>
 
  
  <div class="row" style="overflow:hidden;">
    <div class="col-25">
      <label for="subject">Body</label>
    </div>
    <div class="col-75">
	<div style="padding:10px; background-color:#fff; border:1px solid #ddd; max-height:300px; overflow:auto;">
      <?php
		echo $_REQUEST["data"];
	  ?>
	  </div>
    </div>
  </div> 
  </form>
</div>

</body>
</html>



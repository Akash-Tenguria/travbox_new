<?php
$postdataSSR_Return='
{
  "priceIds" : ["'.$ResultIndex.'", "'.$ResultIndex2.'"]
}';

try
{
//echo $postdata;
//die;
file_put_contents("tripjackAPIJson/ReviewRequest.json",$postdataSSR_Return);


$restCaller = new RestApiCaller();
$flightResSSR_return= $restCaller->getTripJackResponse(_REVIEW_SSR_, $postdataSSR_Return);
file_put_contents("tripjackAPIJson/ReviewResponse.json",$flightResSSR_return);

$reviewSSRResult = json_decode($flightResSSR_return,true);
$_SESSION['reviewSSRResult']=$reviewSSRResult;

}
catch(Exception $e)
{
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Flights Result Are Not Found.";
   // include dirname(dirname(__FILE__)).'/error.php';
    exit;
}


/*echo "<pre>";
print_r($reviewSSRResultReturn);
die;*/





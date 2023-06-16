<?php
$postdata='{
  "id":"'.$ResultIndex.'",
  "flowType":"SEARCH"
}';

$fareRuleResult=array();
try
{
//echo $postdata;
//die;
file_put_contents("tripjackAPIJson/fareRuleRequest.json",$postdata);

$Rurl=_FARE_RULE_;

$restCaller = new RestApiCaller();
$flightRes = $restCaller->getTripJackResponse($Rurl, $postdata);

file_put_contents("tripjackAPIJson/fareRuleResponse.json",$flightRes);

$fareRuleResult = json_decode($flightRes,true);
$_SESSION['fareRuleResult']=$fareRuleResult;

}
catch(Exception $e)
{
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Flights Result Are Not Found.";

    exit;
}






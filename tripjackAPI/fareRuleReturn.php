<?php
$postdataReturn='{
  "id":"'.$ResultIndex2.'",
  "flowType":"SEARCH"
}';

try
{

file_put_contents("tripjackAPIJson/fareRuleRequest.json",$postdataReturn);

$Rurl=_FARE_RULE_;

$restCaller = new RestApiCaller();
$flightResReturn = $restCaller->getTripJackResponse($Rurl, $postdataReturn);

file_put_contents("tripjackAPIJson/fareRuleResponse.json",$flightResReturn);

$fareRuleResultReturn = json_decode($flightResReturn,true);
$_SESSION['fareRuleResultReturn']=$fareRuleResultReturn;

}
catch(Exception $e)
{
    $errhdng="Technical Error !!";
    $errmsg="Sorry Due To Some Technical Issue, Flights Result Are Not Found.";
   // include dirname(dirname(__FILE__)).'/error.php';
    exit;
}






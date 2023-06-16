<?php
class RestApiCaller
{
    function get($urlWithQueryString, $header)
    {
        $ch = curl_init($urlWithQueryString);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        if (curl_error($ch))
            $result = null;
        curl_close($ch);
        if ($this->testGZ($result))
            $result = gzdecode($result);
        return $result;
    }
    function post($url, $data, $header)
    {

	    $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
		
		if(curl_errno($ch)){
			echo 'Request Error:' . curl_error($ch);
		}
				
		
        if (curl_error($ch))
            $result = null;
        curl_close($ch);
        if ($this->testGZ($result))
            $result = gzdecode($result);
        return $result;
    }
    function testGZ($str)
    {
        if ($str === null || strlen($str) < 2)
            return false;
        return (ord(substr($str, 0, 1)) == 0x1f && ord(substr($str, 1, 1)) == 0x8b);
    }
}
?>
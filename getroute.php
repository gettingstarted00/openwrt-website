<?php
//include "token.php";
session_start();
$ip = $_SESSION['ip'];
$token = $_SESSION['token'];
$url2 = "http://$ip/cgi-bin/luci/rpc/sys?auth=";
$url1 = $url2.$token;
//Initiate cURL.
$ch1 = curl_init($url1);
 
//The JSON data.
$jsonData1 = array(
 "params"=> ["ip route | sed -n '1!p' | awk '{print $1}';ip route | sed -n '1!p' | wc -l"],
 "jsonrpc"=> "2.0",
 "id"=> 1,
 "method"=> "exec"

);

 
//Encode the array into JSON.
$jsonDataEncoded1 = json_encode($jsonData1);

//Tell cURL that we want to send a POST request.
curl_setopt($ch1, CURLOPT_POST, 1);
 
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch1, CURLOPT_POSTFIELDS, $jsonDataEncoded1);
 curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1); 
//Set the content type to application/json
curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
 
//Execute the request
$results1 = curl_exec($ch1);

curl_close($ch1);
$result_arr1 = json_decode($results1, true);
$second1 = array_slice($result_arr1, 2, 1);
$route = trim(implode(" ",$second1));
//echo $route;
$nrouter = substr($route, -1);

for($i=1; $i<=$nrouter; $i++){
	$len = strlen($route);
	$pos = strpos($route,'/24');
	${"n$i"} = substr($route,0,$pos);
	$route = substr($route,-($len-$pos-3));	
	
}
echo "hien co $nrouter router";
echo "</br>";
for($i=1; $i<=$nrouter; $i++){
	echo ${"n$i"};
	echo "</br>";
}
?>
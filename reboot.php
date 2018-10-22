<?php
session_start();
$ip = $_SESSION['ip'];
$token = $_SESSION['token'];
$url2 = "http://$ip/cgi-bin/luci/rpc/sys?auth=";
$url1 = $url2.$token;
//Initiate cURL.
$ch1 = curl_init($url1);
//The JSON data.
$jsonData1 = array(
 "params"=> [""],
 "jsonrpc"=> "2.0",
 "id"=> 1,
 "method"=> "reboot"
);

 
//Encode the array into JSON.
$jsonDataEncoded1 = json_encode($jsonData1);

//Tell cURL that we want to send a POST request.
curl_setopt($ch1, CURLOPT_POST, 1);
 
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch1, CURLOPT_POSTFIELDS, $jsonDataEncoded1);
 curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 0); 
//Set the content type to application/json
curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
 
//Execute the request
$results1 = curl_exec($ch1);
session_destroy ();
header('Location:setip.php');
?>
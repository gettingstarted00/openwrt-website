<?php
session_start();
//include "setip.php";
$ip = $_SESSION['ip'];
$url = "http://$ip/cgi-bin/luci/rpc/auth";
//echo "$url";

//Initiate cURL.
$ch = curl_init($url);
 
//The JSON data.
$jsonData = array(
      "id"=> 1,
  "method"=> "login",
  "params"=> [
    "root",
    "root"
  ]

);

 
//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);

//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);
 
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
 
//Execute the request
$results = curl_exec($ch);

curl_close($ch);

$result_arr = json_decode($results, true);

$second = array_slice($result_arr, 1, 1);
$token = implode(" ",$second);
$_SESSION["token"] = $token;
echo $token;
header('Location: index.php');
?>
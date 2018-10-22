<?php
session_start();
$ip = $_SESSION['ip'];
$token = $_SESSION['token'];
$url2 = "http://$ip/cgi-bin/luci/rpc/sys?auth=";
$url1 = $url2.$token;
//khoi tao url
$ch1 = curl_init($url1);
//The JSON data.
$jsonData1 = array(
 "params"=> [" head -2 /proc/cpuinfo"],
 "jsonrpc"=> "2.0",
 "id"=> 1,
 "method"=> "exec"

);

 //gui json
$jsonDataEncoded1 = json_encode($jsonData1);
curl_setopt($ch1, CURLOPT_POST, 1);
curl_setopt($ch1, CURLOPT_POSTFIELDS, $jsonDataEncoded1);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
$results1 = curl_exec($ch1);

//dong noi ket
curl_close($ch1);

//chuyen doi du lieu json => string
$result_arr1 = json_decode($results1, true);
$second1 = array_slice($result_arr1, 2, 1);
$info = implode(" ",$second1);
 
//cat chuoi
$machine = strstr($info,'machine');
echo $machine;
?>
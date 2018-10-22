<?php
	$ip1 = "192.168.10.1";
	$ip2 = "192.168.10.10";
        function Postjson($ip) {
            $url = "http://$ip/cgi-bin/luci/rpc/auth";
			$ch = curl_init($url);
			$jsonData = array(
				  "id"=> 1,
			  "method"=> "login",
			  "params"=> [
				"root",
				"root"
			  ]

			);
			$jsonDataEncoded = json_encode($jsonData);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
			$results = curl_exec($ch);
			curl_close($ch);
			$result_arr = json_decode($results, true);
			$second = array_slice($result_arr, 1, 1);
			$token = implode(" ",$second);
			return $token;
         }
		 
		function Getcpu($ip,$token) {
            $url2 = "http://$ip/cgi-bin/luci/rpc/sys?auth=";
			$url1 = $url2.$token;
			$ch1 = curl_init($url1);
			$jsonData1 = array(
			 "params"=> ["sh cpu.sh"],
			 "jsonrpc"=> "2.0",
			 "id"=> 1,
			 "method"=> "exec"

			);
			$jsonDataEncoded1 = json_encode($jsonData1);
			curl_setopt($ch1, CURLOPT_POST, 1);
			curl_setopt($ch1, CURLOPT_POSTFIELDS, $jsonDataEncoded1);
			curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1); 
			curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
			$results1 = curl_exec($ch1);
			curl_close($ch1);
			$result_arr1 = json_decode($results1, true);
			$second1 = array_slice($result_arr1, 2, 1);
			$cpu = implode(" ",$second1);
			return $cpu;
         }
         
        $token1 = Postjson($ip1);
		$token2 = Postjson($ip2);
		$cpu1 = Getcpu($ip1,$token1);
		$cpu2 = Getcpu($ip2,$token2);
		//echo $cpu1;
		//echo $cpu2;
?>
				<table class="table">
					<thead>
					  <tr>
						<th class= "col-sm-3">Performance</th>
						<th class= "col-sm-9"></th>
					  </tr>
					</thead>
					<tbody>
					  <tr>
						<td>CPU1</td>
						<td>
							<div class="progress" style = "width:150px;height:20px;background-color:white;border:solid 1px;">
								<div id = "progresscpu" class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $cpu1;?>"><?php echo $cpu1;?></div>
							</div>
						</td>
						<td>
							<form action="setip.php" method="post">
								<input type="submit" name="ip" value=<?php echo $ip1;?> style="background:none; border:solid 1px; border-radius:3px; width:110px;" />
							</form>
						</td>
					  </tr>
					  <tr>
						<td>CPU2</td>
						<td>
							<div class="progress" style = "width:150px;height:20px;background-color:white;border:solid 1px;">
								<div id = "progresscpu1" class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $cpu2;?>"><?php echo $cpu2;?></div>
							</div>
						</td>
						<td>
							<form action="setip.php" method="post">
								<input type="submit" name="ip" value=<?php echo $ip2;?> style="background:none; border:solid 1px; border-radius:3px; width:110px;"/>
							</form>
						</td>
					  </tr>
					</tbody>
				</table>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>access point manager</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

<style>
.dropdown:hover .dropdown-menu {
	  display: block;
}
.progress-bar-info{
	color:black;
}
</style>
</head>
<body>
    <div>
		<nav class="navbar navbar-inverse " style = "border-radius:0px;">
		  <div class="container-fluid" style = "padding-left: 15%;">
			<div class="navbar-header">
			  <a class="navbar-brand" href="manage.php">OPENWRT</a>
			</div>
			<ul class="nav navbar-nav" >
			  <li><a href="#">Status</a></li>
			  <li><a id="reboot" onclick="myFunction()" style = "cursor:pointer;">reboot</a></li>
			  <li><a data-toggle="modal" data-target="#myModal" style = "cursor:pointer;">config</a></li>
			  <li><a href="balance.php">balance</a></li>
			  <li><a href="getroute.php">Router list</a></li>
			</ul>
		  </div>
		</nav>
    </div>
	<div class="container">
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
			
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title"><strong>Config</strong></h4>
				</div>
				<div style = "padding:2% 10% 7% 10%;">
				<form action="config.php" method="post">
				  <div class="form-group">
					<label>Ip</label>
					<input type="text" class="form-control" placeholder="vd:192.168.10.10"  name="ipchange">
				  </div>
				  <div class="form-group">
					<label for="pwd">Netmask</label>
					<input type="password" class="form-control" id="pwd">
				  </div>
				  <div class="form-group">
					<label for="pwd">Gateway</label>
					<input type="password" class="form-control" id="pwd">
				  </div>
				  <button type="submit" class="btn btn-default">Submit</button>
				</form>
				</div>
			  </div>
			  
			</div>
		</div>
		<div class = "row">
		 <div class="col-sm-1">
		 </div>
		  <div class="col-sm-10">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home">System</a></li>
				<li><a data-toggle="tab" href="#menu1">Wireless</a></li>
			</ul>
			<div class="tab-content">
				<div id="home" class="tab-pane fade in active">
				<h4><strong>System</strong></h4>
				<table class="table">
					<thead >
					  <tr>
						<th class= "col-sm-3">Info</th>
						<th class= "col-sm-9"></th>
					  </tr>
					</thead>
					<tbody>
					  <tr>
						<td>Hostname</td>
						<td><div id="hostname">OPENWRT</div></td>
					  </tr>
					  <tr>
						<td>Model</td>
						<td><div id="model"></div></td>
					  </tr>
					  <tr>
						<td>Firmware Version</td>
						<td><div id="version"></div></td>
					  </tr>
					  <tr>
						<td>Kernel Version</td>
						<td><div id="kennel"></div></td>
					  </tr>
					  <tr>
						<td>Uptime</td>
						<td><div id="uptime"></div></td>
					</tbody>
				</table>
				<table class="table">
					<thead>
					  <tr>
						<th class= "col-sm-3">Memory</th>
						<th class= "col-sm-9"></th>
					  </tr>
					</thead>
					<tbody>
					  <tr>
						<td>Total/free/available/buffer</td>
						<td><div id="total"></div></td>
					  </tr>
					</tbody>
				</table>
				<table class="table">
					<thead>
					  <tr>
						<th class= "col-sm-3">Performance</th>
						<th class= "col-sm-9"></th>
					  </tr>
					</thead>
					<tbody>
					  <tr>
						<td>CPU</td>
						<td>
							<div class="progress" style = "width:150px;height:20px;background-color:white;border:solid 1px;">
								<div id = "progresscpu" class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
							</div>
						</td>
					  </tr>
					  <tr>
						<td>RAM</td>
						<td>
							<div class="progress" style = "width:150px;height:20px;background-color:white;border:solid 1px;">
								<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
							</div>
						</td>
					  </tr>
					</tbody>
				</table>
				</div>
				<div id="menu1" class="tab-pane fade">
					<h4><strong>Wireless</strong></h4>
					<table class="table">
						<thead >
						  <tr>
							<th class= "col-sm-3">Info</th>
							<th class= "col-sm-9"></th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td>IP</td>
							<td>Doesdsfdsfdsfdsfdsfdsfdsfssdfdsfsdfdsdssdf</td>
						  </tr>
						  <tr>
							<td>Gateway</td>
							<td>Moe</td>
						  </tr>
						</tbody>
					</table>
					<table class="table">
						<thead>
						  <tr>
							<th class= "col-sm-3">Associated Stations</th>
							<th class= "col-sm-9"></div></th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td >Hostname</td>
							<td class= "col-sm-8"><div id="client"></td>
						  </tr>						
						</tbody>
					</table>
				</div>
			</div>
		  </div>
		 <div class="col-sm-1">
		</div>
			
		</div>
	</div>
<script>
(function($)
{
    $(document).ready(function()
    {
		var $container = $("#model");
        $container.load("getmodel.php");
		var $container1 = $("#version");
        $container1.load("getver.php");
		var $container2 = $("#kennel");
        $container2.load("getkennen.php");
		var $container3 = $("#uptime");
		//alert($container6);
        $container3.load("gettime.php");
        var refreshId = setInterval(function()
        {
            $container3.load('gettime.php');
        }, 50000);
		var $container4 = $("#total");
        $container4.load("getmem.php");
        var refreshId4 = setInterval(function()
        {
            $("#total").load('getmem.php');
        }, 3600);
		var $container5 = $("#progresscpu");
        $container5.load("getcpu.php");
		
        var refreshId5 = setInterval(function()
        {
            $container5.load('getcpu.php');
        }, 9000);
		var $container6 = $("#client");
        $container6.load("getclient.php");
        var refreshId5 = setInterval(function()
        {
            $container6.load('getclient.php');
        }, 9000);
    });
})(jQuery);
</script>
<script>
function myFunction() {
    if (window.confirm('ban co muon reboot'))
		{
			window.location="reboot.php";
		}
	else
		{
		//do not thing
		}
}
</script>
<script>
	var a;
	var b = 1800;
	var count = 0;
	setInterval(function()
        {
            a = document.getElementById("progresscpu").innerHTML;
			document.getElementById("progresscpu").style.width = a;
			a = a.substr(0,3);
			if(a >80 ){
				count = count+1;
			}
			else
				count = 0;
			//alert(count);
			if(count==10){
				window.location="xxx.php";
			}
        }, 1800);
	
</script>

</body>
</html>

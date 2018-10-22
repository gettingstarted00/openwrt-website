
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

.progress-bar-info{
	color:black;
}
</style>
</head>
<body>
<div id="xxx">
				
</div>			
<script>
(function($)
{
    $(document).ready(function()
    {
		var $container = $("#xxx");
        $container.load("xxx.php");
        var refreshId = setInterval(function()
        {
            $container.load('xxx.php');
        }, 3600);
    });
})(jQuery);
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
			
			if(count==5){
				alert("qua tai thuc hien can bang");
				<?php
					session_start();
					$_SESSION["ip"] = "192.168.1.2"
				?>
				window.location="index.php";
			}
        }, 1800);
	
</script>

</body>
</html>
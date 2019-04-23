<?php
?>
<!DOCTYPE html>
<html>

<head>
	<title >buttons for masters</title>
    <link rel="stylesheet" href="css/formstyle1.css" type="text/css" />
</head>

<body>

<div id="header">
	<h1 id="heading">View Reports</h1>
</div>

<table width="100%" height="100%" border="0" cellpadding="10" cellspacing="10" id="tablestyle" >

  <tr>
    <td width="52%" height="244" align="center" style="postion:fixed;"><a href="orderreport.php">
	    <canvas id="order" width="300" height="150" style="border:1px solid 	#fff;"  >Your browser does not support the HTML5 canvas tag.</canvas>
		<script>

			var c = document.getElementById("order");
			var ctx = c.getContext("2d");
			//clear background
			ctx.beginPath();
			ctx.fillStyle = "#FFE761";
			ctx.moveTo(50,0);
			ctx.lineTo(0,80);
			ctx.lineTo(300,80);
			ctx.lineTo(250,0);
			ctx.fill();
			// draw font in black
			ctx.fillStyle = "black";
			ctx.font = "20pt sans-serif";
			ctx.fillText("Order Reports", 70, 50);
		</script>
    </a>
    </td>

    <td width="48%" align="center"><a href="salesreport.php">
	    <canvas id="sales" width="300" height="150" style="border:1px solid 	#fff;">Your browser does not support the HTML5 canvas tag.</canvas>
		<script>
			var c = document.getElementById("sales");
			var ctx = c.getContext("2d");
			//clear background
			ctx.beginPath();
			ctx.fillStyle = "#FFE761";
			ctx.moveTo(50,0);
			ctx.lineTo(0,80);
			ctx.lineTo(300,80);
			ctx.lineTo(250,0);
			ctx.fill();
			// draw font in black
			ctx.fillStyle = "black";
			ctx.font = "20pt sans-serif";
			ctx.fillText("Sales Reports", 70, 50);
		</script>
    </a>
    </td>
  </tr>

  <tr>
    <td height="240" align="center"><a href="clientreport.php">
	    <canvas id="client" width="300" height="150" style="border:1px solid 	#fff;">Your browser does not support the HTML5 canvas tag.</canvas>
		<script>
			var c = document.getElementById("client");
			var ctx = c.getContext("2d");
			//clear background
			ctx.beginPath();
			ctx.fillStyle = "#FFE761";
			ctx.moveTo(50,0);
			ctx.lineTo(0,80);
			ctx.lineTo(300,80);
			ctx.lineTo(250,0);
			ctx.fill();
			// draw font in black
			ctx.fillStyle = "black";
			ctx.font = "20pt sans-serif";
			ctx.fillText("Client Reports", 70, 50);
		</script>
    </a>
    </td>

    <td align="center"><a href="diagnosisreport.php">
	    <canvas id="abc" width="300" height="150" style="border:1px solid 	#fff;">Your browser does not support the HTML5 canvas tag.</canvas>
		<script>
			var c = document.getElementById("abc");
			var ctx = c.getContext("2d");
			//clear background
			ctx.beginPath();
			ctx.fillStyle = "#FFE761";
			ctx.moveTo(50,0);
			ctx.lineTo(0,80);
			ctx.lineTo(300,80);
			ctx.lineTo(250,0);
			ctx.fill();
			// draw font in black
			ctx.fillStyle = "black";
			ctx.font = "20pt sans-serif";
			ctx.fillText("Diagnosis Reports", 45, 50);
		</script>
    </a>
    </td>
  </tr>
</table>



</body>

</html>

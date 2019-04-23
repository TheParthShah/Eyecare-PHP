<?php



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Classic EyeCare</title>
<meta name="robots" content="noindex">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<meta http-equiv="pragma" content="no-cache">
<link rel="stylesheet" href="css/formstyle1.css" type="text/css" />

</head>

<body>

<div id="header">
	<h1 id="heading">Search For Informations And Records</h1>
</div>
<table width="100%" height="100%" border="0" cellpadding="10" cellspacing="10" id="tablestyle" >
  <tr>
    <td width="52%" height="244" align="center" style="postion:fixed;"><a href='searchclient.php'>
	    <canvas id="client" width="300" height="150" style="border:1px solid 	#fff;"  >Your browser does not support the HTML5 canvas tag.</canvas>
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
			ctx.fillText("Client", 120, 50);
		</script>
    </a>
    </td>

    <td width="48%" align="center"><a href='searchdiagnosis.php'>
	    <canvas id="diagnosis" width="300" height="150" style="border:1px solid 	#fff;">Your browser does not support the HTML5 canvas tag.</canvas>
		<script>
			var c = document.getElementById("diagnosis");
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
			ctx.fillText("Diagnosis", 90, 50);
		</script>
    </a>
    </td>
  </tr>

  <tr>
    <td height="240" align="center"><a href='searchlens.php'>
	    <canvas id="lens" width="300" height="150" style="border:1px solid 	#fff;">Your browser does not support the HTML5 canvas tag.</canvas>
		<script>
			var c = document.getElementById("lens");
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
			ctx.fillText("Lens", 120, 50);
		</script>
    </a>
    </td>

    <td align="center"><a href='searchlensstock.php'>
	    <canvas id="stock" width="300" height="150" style="border:1px solid 	#fff;">Your browser does not support the HTML5 canvas tag.</canvas>
		<script>
			var c = document.getElementById("stock");
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
			ctx.fillText("Stock", 120, 50);
		</script>
    </a>
    </td>
  </tr>
</table>

</body>
</html>

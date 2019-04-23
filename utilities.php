<?php
?>
<!DOCTYPE html>
<html>

<head>
	<title >buttons for utilities</title>
    <link rel="stylesheet" href="css/formstyle1.css" type="text/css" />
</head>

<body>
	<div id="header">
		<h1 id="heading">Settings</h1>
	</div>

<table width="100%" height="100%" border="0" cellpadding="10" cellspacing="10" id="tablestyle"  >

  <tr>
    <td  width="52%" height="244" align="center" style="postion:fixed;"><a href="DoctorDetails.php">
	    <canvas id="doctordetails" width="300" height="150" style="border:1px solid 	#fff;"  >Your browser does not support the HTML5 canvas tag.</canvas>
		<script>

			var c = document.getElementById("doctordetails");
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
			ctx.fillText("Doctor", 110, 50);
		</script>
    </a>
    </td>

		<td width="48%" align="center"><a href="userdetails.php">
	    <canvas id="user" width="300" height="150" style="border:1px solid 	#fff;">Your browser does not support the HTML5 canvas tag.</canvas>
		<script>
			var c = document.getElementById("user");
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
			ctx.fillText("New Users", 85, 50);
		</script>
    </a>
    </td>
  </tr>

  <tr>
    <td width="48%" align="center"><a href="taxation.php">
	    <canvas id="taxation" width="300" height="150" style="border:1px solid 	#fff;">Your browser does not support the HTML5 canvas tag.</canvas>
		<script>
			var c = document.getElementById("taxation");
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
			ctx.fillText("Taxation", 100, 50);
		</script>
    </a>
    </td>
		<td width="48%" align="center" ><a href="carddetails.php">
		  <canvas id="card" width="300" height="150" style="border:1px solid 	#fff;">Your browser does not support the HTML5 canvas tag.</canvas>
			<script>
				var c = document.getElementById("card");
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
					ctx.fillText("Card Entry", 85, 50);
				</script>
		  	</a>
		</td>
  </tr>

	<tr>
    <td width="48%" align="center"><a href="userdetails.php">
	    <canvas id="user" width="300" height="150" style="border:1px solid 	#fff;">Your browser does not support the HTML5 canvas tag.</canvas>
		<script>
			var c = document.getElementById("user");
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
			ctx.fillText("New Users", 85, 50);
		</script>
    </a>
    </td>

  </tr>
</table>



</body>

</html>

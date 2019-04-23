<?php

?>
<!DOCTYPE>
<html >
<head>
<title>Transaction details</title>
<link type="text/css" href="css/formstyle2.css" rel="stylesheet" />
</head>

<body>
<form>
<div id="header" align="center">
	<h1 id="heading" align="center">Enter New Daily Transaction</h1>
</div>
<table width="100%" height="100%" border="0" cellpadding="10" cellspacing="10" id="tablestyle" >
  <tr>
       <td width="52%" height="244" align="center" style="postion:fixed;" >
	    <a href="AppointmentDetails.php">
	    <canvas id="appointment" width="300" height="150" style="border:1px solid 	#fff;"  >Your browser does not support the HTML5 canvas tag.</canvas>
		<script>

			var c = document.getElementById("appointment");
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
			ctx.fillText("Appoinments", 75, 50);
		</script>
    </a>
    </td>
   <td width="48%" align="center">
    <a href="DiagnosisDetails.php">
	    <canvas id="diagnosisdetails" width="300"  style="border:1px solid 	#fff;"  >Your browser does not support the HTML5 canvas tag.</canvas>
		<script>

			var c = document.getElementById("diagnosisdetails");
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

        <td align="center">
	    <a href="PrescriptionDetails.php">
	    <canvas id="PrescriptionDetails" width="300"  style="border:1px solid 	#fff;"  >Your browser does not support the HTML5 canvas tag.</canvas>
		<script>

			var c = document.getElementById("PrescriptionDetails");
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
			ctx.fillText("Prescription", 80, 50);
		</script>
    </a>
    </td>

     <td align="center" colspan="2">
	    <a href="salesmaster.php" target="_blank">
	    <canvas id="sales" width="300" style="border:1px solid 	#fff;"  >Your browser does not support the HTML5 canvas tag.</canvas>
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
			ctx.fillText("Sales", 120, 50);
		</script>
    </a>
    </td>
  </tr>
  <tr hidden="true">
	  <!--enter the appointment code over here after the presentation midsem and uncomment the card details-->
		<td align="center" colspan="2">
		 <a href="pointsmaster.php" target="_blank">
		 <canvas id="points" width="300" style="border:1px solid 	#fff;"  >Your browser does not support the HTML5 canvas tag.</canvas>
	 <script>

		 var c = document.getElementById("points");
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
		 ctx.fillText("Redemn Points", 63, 50);
	 </script>
	 </a>
	 </td>


  </tr>
</table>
</form>
</body>
</html>

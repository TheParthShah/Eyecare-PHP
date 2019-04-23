<?php
?>
<!DOCTYPE html>
<html>

<head>
 <title >buttons for graphs</title>
    <link rel="stylesheet" href="css/formstyle1.css" type="text/css" />
</head>

<body>
 <div id="header">
   <h1 id="heading" align="center">View Graphs</h1>
 </div>

<table width="100%" height="100%" border="0" cellpadding="10" cellspacing="10" id="tablestyle" >

  <tr>
    <td  width="52%" height="244" align="center" style="postion:fixed;"><a href="clientgraph.php">
     <canvas id="clientgraph" width="300" height="150" style="border:1px solid 	#fff;"  >Your browser does not support the HTML5 canvas tag.</canvas>
   <script>

     var c = document.getElementById("clientgraph");
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
     ctx.fillText("Client Graph", 80, 50);
   </script>
    </a>
    </td>

   <td width="48%" align="center"><a href="diagnosisgraph.php">
     <canvas id="diaggraph" width="300" height="150" style="border:1px solid 	#fff;">Your browser does not support the HTML5 canvas tag.</canvas>
   <script>
     var c = document.getElementById("diaggraph");
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
     ctx.fillText("Diagnosis Graph", 55, 50);
   </script>
    </a>
    </td>
  </tr>
</table>



</body>

</html>

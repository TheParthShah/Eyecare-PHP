<?php
?>
<!DOCTYPE html>
<html>
<body>

<canvas id="myCanvas" width="300" height="150" style="border:1px solid 	#fff;">
Your browser does not support the HTML5 canvas tag.
</canvas>

<script>

var c = document.getElementById("myCanvas");
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
      ctx.fillText("Client Master", 70, 50);
     
</script>

</body>
</html>

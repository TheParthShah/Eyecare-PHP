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
      
      ctx.moveTo(0,0);
	  ctx.lineTo(0,60);
	  ctx.lineTo(150,120);
	  ctx.lineTo(300,60);
	  ctx.lineTo(300,0);
      ctx.fill();
      // draw font in black
      ctx.fillStyle = "black";
      ctx.font = "20pt sans-serif";
      ctx.fillText("Diagnosis Details",48,60);
      //ctx.strokeText("Client Master!", 10, 130);
      
</script>

</body>
</html>

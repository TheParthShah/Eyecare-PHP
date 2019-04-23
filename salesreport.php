<?php

?>

<!DOCTYPE html>
<html>

<head>

<title>Stock Report</title>

<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="css/formstyle2.css" type="text/css">
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
  <script>
$(document).ready(function() {

	$('#diagnosisdate').datepicker({
		defaultDate: 0,
		changeMonth: true,
		changeYear: true,
		maxDate: 0
	});

	$(".txtdate").datepicker({ dateFormat: "dd M yy" });

	var dateFormat = $( ".txtdate" ).datepicker( "option", "dateFormat" );
	$(".txtdate").datepicker( "option", "dateFormat", "dd M yy" );
	$(".txtdate").datepicker('setDate', new Date());

});
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>


</head>

<body>
<div id="header">
	<h1 id="heading">Sales Report</h1>
    <form name="form" id="form">
      <select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('display',this,0)">
        <option>Eyeware</option>
        <option>clientmaster.php</option>
      </select>
    </form>
</div>

<div>
	<form action="" method="post">
		<table border=0	 id="tablestyle">

			<tr>
				<td align="right">
					<label>Total stock sold :</label>
				</td>
				<td colspan="1">
                	<label></label>
				</td>
			</tr>

			<tr>
				<td align="right">
					<label>Total coloured</label>
                    <select name="colors">
    				<option value="black">black</option>
    				<option value="white">white</option>
    				<option value="blue">blue</option>
  					</select>
                    <label>stock sold :</label>
				</td>
				<td>
					<label></label>
				</td>
            </tr>

            <tr>
				<td align="right">
					<label>Number of </label>
                    <select name="gogtype">
    				<option value="wayfarers">wayfarers</option>
    				<option value="aviators">aviators</option>
  					</select>
                    <label>sold :</label>
				</td>
				<td colspan="1">
                	<label></label>
				</td>
			</tr>

	  </table>
  </form>
</div>
</body>
</html>

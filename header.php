<?php
	require('config/connect.php');
	db_connect();

	$selectname = "SELECT DisplayName FROM loggedin WHERE LoggedInId = (SELECT MAX(LoggedInId) FROM loggedin)";

	$rows = db_query($selectname);
	if ($rows === false) {
		$error .= db_error();
	}else {
		foreach ($rows as $key => $list) {
			$displayname = $list["DisplayName"];
			$displayname = $displayname;
		}
	}
?>


<!DOCTYPE html>

<html>

<head>
  <title>EyeCare header</title>
  <meta name="description" content="EyeCare header">
  <meta name="author" content="Wolfvoks">
	<link rel="stylesheet" href="css/jquery-ui.css">
	<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>

	  <script>
		function MM_jumpMenu(targ,selObj,restore){
	  	eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
	  	if (restore) selObj.selectedIndex=0;
		}
	</script>

  <style type="text/css">
	body {
	position:fixed;
	}

	#TitleName {
    vertical-align: middle;
		text-align: center;
		display: inline-table;
		height: 85px;
		width: 170px;
		position:fixed;
	}

	#date {
		vertical-align: top;
		text-align: justify;
		display: inline-block;
		float:right;
		height: 85px;
		width: 170px;
	}


	#headerscroll {
		position:fixed;
	}

	#tablestyle {
    	background-color:#FFE761;
		position:fixed;
		table-layout: fixed;
		width:100%;
		height:20 ;
		border-style:solid;
		border-color:black;
	}
	ul {
			display:block;
			background:#45619D;
			list-style:none;
			margin:0;
			padding:12px 10px;
			height:21px;
	}
	ul li {
			float:left;
			font:13px helvetica;
			font-weight:bold;
			margin:3px 0;
	}
	ul li a {
			color:#FFF;
			text-decoration:none;
			padding:6px 15px;
			cursor:pointer;
	}
	ul li a:hover {
			background:#425B90;
			text-decoration:none;
			cursor:pointer;
	}

	#noti_Container {
			position:relative;
	}

	/* A CIRCLE LIKE BUTTON IN THE TOP MENU. */
	#noti_Button {
			width:22px;
			height:22px;
			line-height:22px;
			border-radius:50%;
			-moz-border-radius:50%;
			-webkit-border-radius:50%;
			background:#FFF;
			margin:-3px 10px 0 10px;
			cursor:pointer;
	}

	/* THE POPULAR RED NOTIFICATIONS COUNTER. */
	#noti_Counter {
			display:block;
			position:absolute;
			background:#E1141E;
			color:#FFF;
			font-size:12px;
			font-weight:normal;
			padding:1px 3px;
			margin:-8px 0 0 25px;
			border-radius:2px;
			-moz-border-radius:2px;
			-webkit-border-radius:2px;
			z-index:1;
	}

	/* THE NOTIFICAIONS WINDOW. THIS REMAINS HIDDEN WHEN THE PAGE LOADS. */
	#notifications {
			display:none;
			width:430px;
			position:absolute;
			top:30px;
			left:0;
			background:#FFF;
			border:solid 1px rgba(100, 100, 100, .20);
			-webkit-box-shadow:0 3px 8px rgba(0, 0, 0, .20);
			z-index: 0;
	}
	/* AN ARROW LIKE STRUCTURE JUST OVER THE NOTIFICATIONS WINDOW */
	#notifications:before {
			content: '';
			display:block;
			width:0;
			height:0;
			color:transparent;
			border:10px solid #CCC;
			border-color:transparent transparent #FFF;
			margin-top:-20px;
			margin-left:10px;
	}

	h3 {
			display:block;
			color:#333;
			background:#FFF;
			font-weight:bold;
			font-size:13px;
			padding:8px;
			margin:0;
			border-bottom:solid 1px rgba(100, 100, 100, .30);
	}

	.seeAll {
			background:#F6F7F8;
			padding:8px;
			font-size:12px;
			font-weight:bold;
			border-top:solid 1px rgba(100, 100, 100, .30);
			text-align:center;
	}
	.seeAll a {
			color:#3b5998;
	}
	.seeAll a:hover {
			background:#F6F7F8;
			color:#3b5998;
			text-decoration:underline;
	}
	</style>

</head>

<body bgcolor="#FFE761">
	<div id="headerscroll">
		<table width="99%" border="1"  id="tablestyle">
			<tr style="width:100%" align="center">
				<td height="21" colspan="3" align="center">Welcome...!!! <?php echo $displayname; ?></td>
				<td width="47%" height="5" rowspan="2" align="center"><img src="images/eyecare.png" alt="eyecare" width="584" height="62" /></td>
				<td width="25%" rowspan="2" align="center">Go Directly To Form<br>
					<!--not working deal with it later on-->
					<select name="jumpMenu" id="jumpMenu" onChange="MM_jumpMenu('parent',this,1)">
	        <option>Select Direct Link</option>
	        <option value="clientmaster">Enter Client Details</option>
					<option value="diagnosisdetails">Enter Diagnosis Details</option>
					<option value="stockmaster">Enter Stock Entry</option>
					<option value="lensstockmaster">Enter Lens Entry</option>
					<option value="carddetails">Enter New Card Details</option>
					<option value="orderdetails">Enter New Order</option>
					<option value="appointmentdetails">Enter New Appointments</option>
					<option value="salesmaster">Enter New Sales Entry</option>
					<option value="prescriptiondetails">Enter New Prescription</option>
	      	</select>
				</td>
			</tr>

			<tr style="width: 100%; font-weight: bold;" align="center">
				<td width="9%" height="20" align="center"><img title="Logout" src="images/exit.png" width="20" height="19" onclick="window.open('index.php', '_top');" /></td>

					<td width="9%" align="center" >
						<img src="images/alert.png" width="20" height="19" id="notifications">
					</td>



				<td width="10%" align="center" style="text-align: center"><img src="images/home.png" width="20" height="20" title="Home" onclick="window.open('template.php', '_top');" /></td>
			</tr>

		</table>

	</div>

</body>

</html>

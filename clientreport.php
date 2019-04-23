<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Cache-Control: post-check=0, pre-check=0', false);
header("Pragma: no-cache");

	require('config/connect.php');
	db_connect();
	error_reporting(0);

	$numrowsid = 0;
  $clientcount=0;
	$cardnumber = 0;
  	$selectid = "SELECT COUNT(*) AS ClientCount FROM clientmaster";
  	$rows = db_select($selectid);
  	if ($rows === false) {
  		$error .= db_error();
  	}else {
  		foreach ($rows as $key => $list) {
  			$clientcount = $list["ClientCount"];
  			$clientcount = $clientcount;
  		}
  	}


    if( $_POST ) {

    $clientname = trim($_POST['clientname']);

    	if(isset ($_POST['subSearch'])) {

    		$selectid = "SELECT ClientId, ClientName, PrimaryNumber, SecondaryNumber, DOB, PostBox, Address, EmailId, Gender, Occupation, Referance FROM clientmaster WHERE ClientName LIKE '$clientname%'";
    		$rowsid = db_select($selectid);
    		if ($rowsid === false) {
    			$error .= db_error();
    		}
    		else {
    			$numrowsid = 10;
    		}
    	}
    }
?>

<!DOCTYPE html>
<html>

<head>

<title>Client Report</title>

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
	<h1 id="heading">Client Reports</h1>
</div>

<div>
	<form action="" method="post">
		<table border=0	 id="tablestyle">
      <tr>
        <td><label>Total Number Of Clients : </label></td>
        <td><label><?php echo $clientcount;?></label></td>
      </tr>
      <tr>
        <td align="right"><label>Client Name : </label></td>
        <td align="right"><input type="text" name="clientname" class="longtext" placeholder="Enter Full Name Only"></td>
        <td><input type="submit" class="button" value="Get Info" name="subSearch"></td>
      </tr>

			<?php if($numrowsid > 0) {
					$counter = 1;
					echo "<tr><td colspan=3>&nbsp;</td></tr>";
					foreach ($rowsid as $idkey => $idlist) {
						$clientcode = $idlist['ClientId'];
						$clientname = $idlist['ClientName'];
						$dateofbirth2 = $idlist['DOB'];
						$dateofbirth = date("d F Y", strtotime($dateofbirth2));
						$primarynumber = $idlist['PrimaryNumber'];
						$othernumber = $idlist['SecondaryNumber'];
						if($othernumber == "0") { $othernumber = "Not Available"; }
						$email = $idlist['EmailId'];
						$postbox = $idlist['PostBox'];
						$address = $idlist['Address'];
						$occupation = $idlist['Occupation'];
						$referer = $idlist['Referance'];
						if(trim($referer == "")) { $referer = "Direct Client"; }
						if($counter&1){
							echo"<table border='2' cellspacing='3' cellpadding='8' align='center' width='1100'><tr class='d3'>";
						}
						else {
							echo"<table border='2' cellspacing='3' cellpadding='8' align='center' width='1100'><tr class='d1'>";
						}
						echo "
							<td >Name:</td>
							<td><font size=2 face=Verdana><strong>$clientname</strong></font></td>
						</tr>
						<tr>
							<td>Card Number: </td>
							<td><font size=2 face=Verdana><strong>$cardnumber</strong></font></td>
						</tr>
						<tr>
							<td>Card Type: </td>
							<td><font size=2 face=Verdana><strong>$cardnumber</strong></font></td>
						</tr>
						<tr>
							<td>Redemn Points: </td>
							<td><font size=2 face=Verdana><strong>$cardnumber</strong></font></td>
						</tr>
						<tr>
							<td>Date of Birth:</td>
							<td><font size=2 face=Verdana><strong>$dateofbirth</strong></font></td>
						</tr>
						<tr>
							<td>Referer: </td>
							<td><font size=2 face=Verdana><strong>$referer</strong></font></td>
						</tr>
						<tr>
							<td>Contact Number: </td>
							<td><font size=2 face=Verdana><strong>$primarynumber</strong></font></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td> <font size=2 face=Verdana><strong>$email</strong></font></td>
						</tr>
						<tr>
							<td>Other Number: </td>
							<td><font size=2 face=Verdana><strong>$othernumber</strong></font></td>
						</tr>
						<tr>
							<td>Postbox:</td>
							<td> <font size=2 face=Verdana><strong>$postbox</strong></font></td>
						</tr>
						<tr>
							<td>Address: </td>
							<td colspan=3><font size=2 face=Verdana><strong>$address</strong></font></td>
						</tr>
						<tr>
							<td>Occupation:</td>
							<td> <font size=2 face=Verdana><strong>$occupation</strong></font></td>
						<tr>
						<tr><td height=25 colspan=3> <div class='hr2'><hr /></div></td></tr></table>
						";

						$counter += 1;
					}  ?>
<!--
				<tr>
					<td height="30">&nbsp;</td>
					<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;
	    				<input type="submit" class="button" value="New Search" name="subReset" ></td>
				</tr>
-->
			<?php } ?>

	  </table>
  </form>
</div>
</body>
</html>

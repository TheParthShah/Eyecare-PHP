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
  $ordercount=0;
		$selectid = "SELECT COUNT(*) AS OrderCount FROM ordermaster";
  	$rows = db_select($selectid);
  	if ($rows === false) {
  		$error .= db_error();
  	}else {
  		foreach ($rows as $key => $list) {
  			$ordercount = $list["OrderCount"];
  			$ordercount = $ordercount;
  		}
  	}


    if( $_POST ) {

    $suppliername = trim($_POST['suppliername']);

    	if(isset ($_POST['subSearch'])) {

    		$selectid = "SELECT OrderId, SupplierName,OrderDate, InwardDate, TotalPrice FROM ordermaster WHERE SupplierName LIKE '$clientname%'";
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

<title>Order Report</title>

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
</script>


</head>

<body>
<div id="header">
	<h1 id="heading">Order Reports</h1>
</div>

<div>
	<form action="" method="post">
		<table border=0	 id="tablestyle">
      <tr>
        <td><label>Total Number Of Order : </label></td>
        <td><label><?php echo $ordercount;?></label></td>
      </tr>
      <tr>
        <td align="right"><label>Supplier Name : </label></td>
        <td align="right"><input type="text" name="suppliername" class="longtext" placeholder="Enter Full Name Only"></td>
        <td><input type="submit" class="button" value="Get Info" name="subSearch"></td>
      </tr>

			<?php if($numrowsid > 0) {
					$counter = 1;
					echo "<tr><td colspan=3>&nbsp;</td></tr>";
					foreach ($rowsid as $idkey => $idlist) {
						$ordercode = $idlist['OrderId'];
						$suppliername = $idlist['SupplierName'];
						$orderdate = $idlist['OrderDate'];
						$orderdate2 = date("d F Y", strtotime($orderdate));
						$totalprice = $idlist['TotalPrice'];
						$inwarddate = $idlist['InwardDate'];
						$inwarddate2 = date("d F Y", strtotime($inwarddate));
						if($counter&1){
							echo"<table border='2' cellspacing='3' cellpadding='8' align='center' width='1100'><tr class='d3'>";
						}
						else {
							echo"<table border='2' cellspacing='3' cellpadding='8' align='center' width='1100'><tr class='d1'>";
						}
						echo "
							<td >Supplier Name:</td>
							<td><font size=2 face=Verdana><strong>$suppliername</strong></font></td>
						</tr>
						<tr>
							<td>Order Date: </td>
							<td><font size=2 face=Verdana><strong>$orderdate2</strong></font></td>
						</tr>
						<tr>
							<td>Inward Date:</td>
							<td><font size=2 face=Verdana><strong>$inwarddate2</strong></font></td>
						</tr>
						<tr>
							<td>Total Price: </td>
							<td><font size=2 face=Verdana><strong>$totalprice</strong></font></td>
						</tr>
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

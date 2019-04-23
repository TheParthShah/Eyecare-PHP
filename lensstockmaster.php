<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Cache-Control: post-check=0, pre-check=0', false);
header("Pragma: no-cache");

	require('config/connect.php');
	db_connect();
	error_reporting(0);

	$selectid = "SELECT MAX(StockId) AS StockId FROM lensstockmaster";

	$rows = db_select($selectid);
	if ($rows === false) {
		$error .= db_error();
	}else {
		foreach ($rows as $key => $list) {
			$stockid = $list["StockId"];
			$stockid = $stockid +1 ;
		}
	}
	if( $_POST ) {

		$err_cust = 0;
		$stockid = $_POST['stockid'];
		$inwarddate = $_POST['inwarddate'];
		$dateinward = date("Y-m-d", strtotime($inwarddate));
		$lensid = $_POST['lensid'];
		$listcode = $_POST['lensid'];
		$listtransition = $_POST['transition'];
		$quantity = trim($_POST['quantity']);

		//print_r($_POST);

		$thisday = date('Y-m-d');
		$checkdob = date("Y-m-d", strtotime($thisday . " -360 days"));

		if(isset ($_POST['subReset'])) {
				$destination_url = "lensstockmaster.php";
				header("Location:$destination_url");
				exit();
		}
		elseif(isset ($_POST['subSave'])) {

			if( trim($listcode) == "" ) {
				echo"<script type='text/javascript'>
					alert( '1. Lens Type Cannot be Blank' );
					</script>";
					$err_cust += 1;
			}
			else {
				if(trim($listcode) == "PS") { $lenstype = "Progressive"; }
				elseif(trim($listcode) == "NR") { $lenstype = "Normal"; }
				else { $lenstype = "Normal"; }
			}

			if( trim($listtransition) == "" ) {
				echo"<script type='text/javascript'>
					alert( '2. Lens Transition Cannot be Blank' );
					</script>";
					$err_cust += 1;
			}
			else {
				if(trim($listtransition) == "PC") { $lenssubtype = "Photochromic"; }
				elseif(trim($listtransition) == "AR") { $lenssubtype = "Anti Reflective"; }
				elseif(trim($listtransition) == "CW") { $lenssubtype = "Clear White"; }
				else { $lenssubtype = "Clear White"; }
			}

			if( trim($quantity) == "" ) {
				echo"<script type='text/javascript'>
					alert( '3. Lens Quantity Cannot be Blank' );
					</script>";
					$err_cust += 1;
			}

			if( $quantity == "0" ) {
				echo"<script type='text/javascript'>
					alert( '4. Lens Quantity Cannot be ZERO' );
					</script>";
					$err_cust += 1;
			}

			if (!is_numeric($quantity)) {
				echo"<script type='text/javascript'>
					alert( '5. Lens Quantity Cannot be Non-Numeric' );
					</script>";
					$err_cust += 1;
			}

			if( $err_cust == '0' ) {
				$lensid = db_string($lensid);
				$lenssubtype = db_string($lenssubtype);
				$quantity = db_string($quantity);


				$queryinsert = "INSERT INTO lensstockmaster(LensId, LensSubType, InwardDate, Quantity, DateUpdated) VALUES
						('$lensid','$lenssubtype','$dateinward','$quantity',NOW())";
				$stockcode = db_insert($queryinsert);

				echo "<script type='text/javascript'>alert('insert')</script>";

				echo "<meta http-equiv='refresh' content='0'>";

			}//end of err_cust if condition

		}//end of iseet if condition

	} //end of $_POST if condition

?>
<!DOCTYPE html>
<html>

<head>
<title >Lens Stock Master</title>
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="css/formstyle1.css" type="text/css">

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
	$("input[name='listcode']").change(function() {

			 var listCodeOp = $(this).val();
			 $('#listcoded').val(listCodeOp);
	 if(listCodeOp == "PS")	{
		 listUrl = "get_lenspowers.php";
		 var datastring = 'listcode=' + listCodeOp;
	 }
	 else if(listCodeOp == "NR") {
		 listUrl = "get_lenspowers.php";
		 var datastring = 'listcode=' + listCodeOp;
	 }

	 $.ajax ({
		 type: "POST",
		 url: listUrl,
		 data: datastring,
		 cache: false,
		 success: function(html)
		 {
			 $('.payee').html(html);
			 $('.payee').trigger('chosen:updated');
			 $('.payee').chosen();
		 }
	 });

	 });
});
</script>
</head>

<body>

<div id="header">
	<h1 id="heading">Enter New Lens Stock Records</h1>
</div>

<div>
		<form action="" method="post">
			<table width="100%" cellpadding="0px" cellspacing="0px" id="tablestyle">
				<tr>
					<td width="109"></td>
					<td width="409"></td>
					<td width="106">
						<label id="label">Stock ID :</label>
					</td>
					<td width="391">
						<label name="stockid"><?php echo $stockid;?></label>
					</td>
				</tr>
				<tr>
					<td height="32"><label>Lens Type :</label></td>
					<td>
						<input type="radio" name="listcode" value="PS" id="radiops" class="listcoderadio"<?php if (isset($_POST['listcoded']) && $_POST['listcoded'] == 'PS'): ?>checked='checked'<?php endif; ?> />
												Progressive
						<input type="radio" name="listcode" value="NR" id="radionr" class="listcoderadio" <?php if (isset($_POST['listcoded']) && $_POST['listcoded'] == 'NR'): ?>checked='checked'<?php endif; ?> />Normal
					</td>
				</tr>
				<tr>
					<td>Lens Power : </td>
						<td><font size="2" face="Verdana" color="black">
							<select name="lensid" id="lensid" class="payee" STYLE="font-family: Verdana; width: 320px;">
								<option value="0" selected>Select a Lens Type...</option>
						</select>
						</font></td>
				</tr>
				<tr>
					<td height="42">
						<label id="label">Lens Transition :</label>
					</td>
					<td>
						<input type="radio" name="transition" value="PC">
						<label>Photo Chromic</label>
						<input type="radio" name="transition" value="AR">
						<label>Anti Reflective</label>
						<input type="radio" name="transition" value="CW">
						<label>Clear White</label>
					</td>
				</tr>
				<tr>
					<td height="50"><label>Quantity :</label></td>
					<td><input type="number" name="quantity" required class="shorttext"></td>
					<td><label id="label">Inward Date :</label></td>
					<td>
						<input type="text" id="inwarddate" class="txtdate" style="width: 100px; height: 20px" name="inwarddate" value="<?php echo date('d F Y');?>">
					</td>
				</tr>
				<tr>
					<td height="67"></td>
					<td><input type="submit" class="button" value="Save" name="subSave">
					<input type="reset" class="button" value="Reset" name="reset" ></td>
				</tr>
			</table>
		</form>
</div>

</body>
</html>

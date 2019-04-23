<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Cache-Control: post-check=0, pre-check=0', false);
header("Pragma: no-cache");

	require('config/connect.php');
	db_connect();
	error_reporting(0);

	$selectid = "SELECT MAX(StockId) AS StockId FROM stockmaster";

	$rows = db_select($selectid);
	if ($rows === false) {
		$error .= db_error();
	}else {
		foreach ($rows as $key => $list) {
			$stockid = $list["StockId"];
			$stockid = $stockid + 1;
		}
	}


	if($_POST) {
		$stockerror = 0;
		$modelname = $_POST['modelname'];
		$stocktype = $_POST['stocktype'];
		$stocksecondarytype = $_POST['stocksecondarytype'];
		$quantity = $_POST['quantity'];
		$stockdetails = $_POST['stockdetails'];
		$sellingprice = $_POST['sellingprice'];
		$purchaseprice = $_POST['purchaseprice'];
		$purchasedate = $_POST['purchasedate'];
		$discount = $_POST['discount'];
		$brand = $_POST['brand'];
		$supplier = $_POST['supplier'];

		if(isset($_POST['subSave'])) {

			if($stockerror == '0') {
				$modelname = db_string($modelname);
				$stocktype = db_string($stocktype);
				$stocksecondarytype = db_string($stocksecondarytype);
				$quantity = db_string($quantity);
				$stockdetails = db_string($stockdetails);
				$sellingprice = db_string($sellingprice);
				$purchaseprice = db_string($purchaseprice);
				$purchasedate = date('Y-m-d', strtotime(str_replace('-', '/', $purchasedate)));
				$discount = db_string($discount);
				$brand = db_string($brand);
				$supplier = db_string($supplier);

				$queryinsert = "INSERT INTO stockmaster (ModelName, StockType,StockSecondaryType, StockDetails, Quantity, SellingPrice, PurchaseDate, PurchasePrice, DiscountRecieved, Brand, Supplier) VALUES ('$modelname','$stocktype','$stocksecondarytype','$stockdetails','$quantity','$sellingprice','$purchasedate','$purchaseprice','$discount','$brand','$supplier')";

				$stockcode = db_query($queryinsert);

				echo "<script type='text/javascript'>alert('insert')</script>";
				echo "<meta http-equiv='refresh' content='0'>";


			}//stockerror check
		}//isset
	}//$_POST


?>
<!DOCTYPE html>
<html>

<head>

<title >Stock Master</title>
 <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" href="css/formstyle1.css" type="text/css">

<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>

<script type="text/javascript">
//code for datepicker
 $(document).ready(function() {
	 $('#purchasedate').datepicker({
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
	<h1 id="heading">Enter New Stock Entry</h1>
</div>


<div class="ui_widget" >
	<form action="stockmaster.php" method="post" >
	  <table width="1016" border="0px" cellpadding="0px" cellspacing="0px" id="tablestyle">
			<tr>
				<td width="209"></td><td width="339"></td>
				<td width="118" >
					<label id="label">Stock ID :</label>

				</td>
				<td width="350">
					<label ><?php echo $stockid?></label>
				</td>
			</tr>

			<tr>
				<td>
					<label>Model Name :</label>
				</td>
				<td colspan="2" >
					<input type="text" name="modelname" required class="longtext auto" id="modelname" />
				</td>
			</tr>

			<tr>
				<td align="label">
					<label>Stock Type :</label>
				</td>
				<td colspan="1">
					<select name="stocktype" id="stocktype" class="my_select_box" style="font-family: Verdana; width: 100px; height: 20px">
							<option value="0" selected>None</option>
							<option value="Frames">Frames</option>
							<option value="Shades">Shades</option>
					</select>
				</td>
			</tr>

			<tr>
				<td>
					<label id="label">Stock Secondary Type :</label>
				</td>
				<td>
					<input type="text" name="stocksecondarytype" class="shorttext">
				</td>
			</tr>

			<tr>
				<td>
					<label>Stock Details :</label>
				</td>
				<td>
				  <textarea rows="3" cols="30" name="stockdetails" required ></textarea>
				</td>
				<td>
					<label>Brand :</label>
				</td>
				<td>
					<input type="Text" name="brand" class="shorttext" >
				</td>
			</tr>

			<tr>
			<td></td><td></td>
				<td>
						<label>Supplier :</label>
				</td>
				<td>
					<input type="text" name="supplier" class="longtext" >
				</td>
			</tr>

			<tr>
				<td>
						<label>Quantity :</label>
				</td>
				<td>
					<input type="number" name="quantity" class="shorttext" >
				</td>
			</tr>

			<tr>
				<td>
					<label id="label">Selling Price :</label>
				</td>
				<td>
					<input type="text" name="sellingprice" class="shorttext">
				</td>
				<td>
					<label>Purchase Price :</label>
				</td>
				<td>
					<input type="text" name="purchaseprice" class="shorttext">
				</td>
			</tr>

			<tr>
				<td></td><td></td>
				<td>
					<label>Purchase Date :</label>
				</td>
				<td>
					<input type="text" id="purchasedate" class="txtdate" style="width: 100px; height: 20px" name="purchasedate" value="<?php echo date('d F Y');?>">
				</td>
			</tr>

			<tr>
				<td>
					<label id="label">Discount Recieved :</label>
				</td>
			    <td>
			    	<input type="text" name="discount" class="shorttext">
			    </td>
			</tr>

			<tr>
				<td height="57"></td>
				<td>
					<input type="submit" class="button" value="Save" name="subSave">
					<input type="reset" class="button" value="Reset" name="reset" >
			  </td>
		  </tr>

		</table>
  </form>
</div>

</body>
</html>

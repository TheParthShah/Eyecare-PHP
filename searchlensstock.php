<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Cache-Control: post-check=0, pre-check=0', false);
header("Pragma: no-cache");

error_reporting(0);

require('config/connect.php');
db_connect();

$numrowsid = 0;



if( $_POST ) {

$modelname = trim($_POST['modelname']);

	if(isset ($_POST['subReset'])) {
		$destination_url = "searchlensstock.php";
		header("Location:$destination_url");
		exit();
	}
	elseif(isset ($_POST['subSearch'])) {



		$selectid = "SELECT StockId,
ModelName,
StockType,
StockSecondaryType,
StockDetails,
Quantity,
SellingPrice,
PurchasePrice,
PurchaseDate,
Brand,
Supplier
FROM stockmaster
WHERE ModelName LIKE '%$modelname%' OR StockType LIKE '%$modelname%'";
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Classic EyeCare</title>
<meta name="robots" content="noindex">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="0">
<meta http-equiv="pragma" content="no-cache">

<link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
<link rel='stylesheet' href="js/jquery-min.js" type="text/css" />
<link rel="stylesheet" href="css/search.css" type="text/css" />

<script type="text/javascript" src="js/jquery-min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
</head>
<body>
		<div id="header" align="center">
			<h1 id="heading">Search Stock Details</h1>
		</div>
		<form action="" method="post" accept-charset="utf-8" name="form1">
			<table border="0" id="tablestyle">
			<?php if($numrowsid == "0") { ?>
				<tr>
					<td width="6%">&nbsp;</td>
					<td width="31%">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td height="30"></td>
					<td align="center">Enter Stock Details :</td>
					<td>
						<input type="text" name="modelname" class="longtext" placeholder="Part Of Model Name OR Stock Type" required="required"  value="<?php echo $modelname ?>">
					</td>
				</tr>
				<tr>
					<td height="30"></td>
					<td>&nbsp;</td>
  					<td>&nbsp;&nbsp;&nbsp;&nbsp;
  						<input type="submit" class="button" value="Get Info" name="subSearch">
  						&nbsp;&nbsp;&nbsp;&nbsp;
	    				<input type="reset" class="button" value="Reset Search" name="subReset" ></td>
				</tr>
			<?php } ?>

			<?php if($numrowsid > 0) {
					$counter = 1;
					echo "<tr><td colspan=3>&nbsp;</td></tr>";
					foreach ($rowsid as $idkey => $idlist) {
						$stockcode = $idlist['StockId'];
						$modelname = $idlist['ModelName'];
						$stocktype = $idlist['StockType'];
						$stocksecondarytype = $idlist['StockSecondaryType'];
						$stockdetails = $idlist['StockDetails'];
						$quantity = $idlist['Quantity'];
						$sellingprice = $idlist['SellingPrice'];
						$purchasedate = $idlist['PurchaseDate'];
						$purchaseprice = $idlist['PurchasePrice'];
						$brand = $idlist['Brand'];
						$supplier = $idlist['Supplier'];
						if($counter&1){
							echo"<tr class='d3'>";
						}
						else {
							echo"<tr class='d1'>";
						}
						echo "
							<td colspan=3>Model Name: <font size=2 face=Verdana><strong>$modelname</strong></font></td>
						</tr>
						<tr>
							<td colspan=3>Stock Type: <font size=2 face=Verdana><strong>$stocktype</strong></font> | Secondary Type: <font size=2 face=Verdana><strong>$stocksecondarytype</strong></font></td>
						</tr>
						<tr>
							<td colspan=3>Stock Details: <font size=2 face=Verdana><strong>$stockdetails</strong></font></td>
						</tr>
						<tr>
							<td colspan=3>Quantity: <font size=2 face=Verdana><strong>$quantity</strong></font> | Selling Price: <font size=2 face=Verdana><strong>$sellingprice</strong></font> | Purchase Price: <font size=2 face=Verdana><strong>$purchaseprice</strong></font></td>
						</tr>
						<tr>
							<td colspan=3>Purchase Date: <font size=2 face=Verdana><strong>$purchasedate</strong></font></td>
						<tr>
						<tr>
							<td colspan=3>Brand: <font size=2 face=Verdana><strong>$brand</strong></font> | supplier: <font size=2 face=Verdana><strong>$supplier</strong></font></td>
						</tr>
						<tr><td height=25 colspan=3> <div class='hr2'><hr /></div></td></tr>
						";

						$counter += 1;
					}  ?>

				<tr>
					<td height="30">&nbsp;</td>
					<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;
	    				<input type="submit" class="button" value="New Search" name="subReset" ></td>
				</tr>

			<?php } ?>

			</table>
		</form>
	</div>
</body>

</html>

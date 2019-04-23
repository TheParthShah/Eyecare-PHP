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

$lenstype = trim($_POST['lenstype']);

	if(isset ($_POST['subReset'])) {
		$destination_url = "searchlens.php";
		header("Location:$destination_url");
		exit();
	}
	elseif(isset ($_POST['subSearch'])) {

		$selectid = "SELECT
lsm.StockId AS StockId,
lsm.LensId AS lensId,
lsm.LensSubType AS LensSubType,
lsm.InwardDate AS InwardDate,
lsm.Quantity AS Quantity,
lm.LensPower AS LensPower,
lm.LensType AS LensType
			FROM lensstockmaster lsm JOIN lensmaster lm ON lsm.LensId = lm.LensId
			WHERE lsm.LensSubType LIKE '%$lenstype%' OR lm.LensType LIKE '%$lenstype%' ";	//searchs any word related to any place of the find.


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
			<h1 id="heading">Search Lens Stock</h1>
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
					<td align="center">Enter Lens Details :</td>
					<td>
						<input type="text" name="lenstype" class="longtext" placeholder="Search By Part Of Lens Type OR Transition" required="required"  value="<?php echo $lenstype ?>">
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
						$lenspower = $idlist['LensPower'];
						$lenstype = $idlist['LensType'];
						$lenstransition = $idlist['LensSubType'];
						$quantity = $idlist['Quantity'];
						$inwarddate = $idlist['InwardDate'];

						if($counter&1){
							echo"<tr class='d3'>";
						}
						else {
							echo"<tr class='d1'>";
						}
						echo "
							<td colspan=2>Lens Type: <font size=2 face=Verdana><strong>$lenstype</strong></font></td>
						</tr>
						<tr>
							<td colspan=3>Lens Power: <font size=2 face=Verdana><strong>$lenspower</strong></font> | Lens Transition: <font size=2 face=Verdana><strong>$lenstransition</strong></font></td>
						</tr>
						<tr>
							<td colspan=3>Quantity: <font size=2 face=Verdana><strong>$quantity</strong></font> | Inward Date: <font size=2 face=Verdana><strong>$inwarddate</strong></font></td>
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

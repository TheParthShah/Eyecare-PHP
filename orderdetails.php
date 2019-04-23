<?php

	require('config/connect.php');
	db_connect();

$orderid=0;
	$selectid = "SELECT MAX(OrderId) AS OrderId FROM ordermaster";
	$rows = db_select($selectid);
	if ($rows === false) {
		$error .= db_error();
	}else {
		foreach ($rows as $key => $list) {
			$orderid = $list["OrderId"];
			$orderid = $orderid +1;
		}
	}

	$ordererror = 0;
	$itemnumber=0;

	if ($_POST) {
		$orderdate = $_POST['orderdate'];
		$suppliername = $_POST['suppliername'];
		$stocktype2 = $_POST['stocktype1'];
		$details2 = $_POST['details1'];
		$qty2 = $_POST['qty1'];
		$cost2 = $_POST['cost1'];
		$price2 = $_POST['price1'];
		$totalprice2 = $_POST['totalprice1'];

		if(isset($_POST['subSave'])) {
			if($ordererror == 0) {
			$orderdate = date('Y-m-d', strtotime(str_replace('/', '-', $orderdate)));
			$suppliername = db_string($suppliername);
			$totalprice = db_string($totalprice);

			$orderinsert = "INSERT INTO ordermaster (SupplierName,OrderDate,Totalprice) VALUES ('$suppliername','$orderdate','$totalprice')";
			$ordercode = db_insert($orderinsert);

			echo "<script type='text/javascript'>alert('Inserted...!!!')</script>";

		}
	}
}//end of $_POST if condn


?>

<!DOCTYPE html>
<html>
<head>
<title>Order Details</title>
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="css/formstyle2.css" type="text/css">
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>

<script>
$(document).ready(function() {

	$('#orderdate').datepicker({
		defaultDate: 0,
		changeMonth: true,
		changeYear: true,

	});

	$(".txtdate").datepicker({ dateFormat: "dd M yy" });

	var dateFormat = $( ".txtdate" ).datepicker( "option", "dateFormat" );
	$(".txtdate").datepicker( "option", "dateFormat", "dd M yy" );
	$(".txtdate").datepicker('setDate', new Date());

});

$(document).ready(function() {
$("#submit").click(function() {
var stocktype = $("#stocktype").val();
var details = $("#details").val();
var qty = $("#qty").val();
var cost = $("#cost").val();
var price = $("#price").val();
var total = $("#total").val();
if {
// Returns successful data submission message when the entered information is stored in database.
$.post("orderdetails.php", {
stocktype1 : stocktype,
details1: details,
qty1: qty,
cost1: cost,
price1: price,
total1: total
}, function(data) {
alert(data);
$('#form')[0].reset(); // To reset form fields
});
}
});
});
</script>



</head>

<body>
<div id="header">
	<h1 id="heading">Enter New Order Details</h1>
</div>

<div>
	<form action="" method="post" id="form">
		<table border=0	 id="tablestyle">
			<tr>
				<td></td><td></td>
				<td >
					<label>Order ID :</label>
				</td>
				<td>
					<label ><?php echo $orderid;?></label>
				</td>
			</tr>
			<tr>
				<td>
					<label>Supplier Name :</label>
				</td>
				<td colspan="1">
        	<input type="text" name="suppliername" class="longtext">
				</td>
			</tr>
      <tr>
				<td>
					<label>Order Date:</label>
				</td>
				<td>
					<input type="text" id="orderdate" class="txtdate" style="width: 100px; height: 20px" name="orderdate" value="<?php echo date('d F Y');?>">
				</td>
				<td></td>
			</tr>

      <tr>
      	<td colspan="6">

					<form id="form" method="post">
					<table border="5"	 id="tablestyle1" CELLPADDING="15" CELLSPACING="1">
						<tr >
							<td align="center">Type :</td>
          		<td CELLPADDING="20" align="center">Details :</td>
          		<td align="center">Quantity :</td>
          		<td align="center">Per Piece price :</td>
          		<td align="center">Total price :</td>
        		</tr>
						<tr class="item-row">
							<td class="item-name">
								<div class="delete-wpr">
									<select name="stocktype" id="stocktype" class="my_select_box" style="font-family: Verdana; width: 100px; height: 20px" id="stocktype">
										<option value="NotSeleted" selected>Select Type</option>
										<option value="Frames">Frames</option>
										<option value="Shades">Shades</option>
										<option value="Lens">Lens</option>
									</select>
								</div>
							</td>
							<td class="description">
								<textarea name="details" id="details"></textarea>
							</td>
							<td>
								<textarea class="qty" name="qty" id="qty"></textarea>
							</td>
							<td>
								<textarea class="cost" name="cost" id="cost"></textarea>
							</td>
							<td>
								<textarea class="price"  name="price" id="price">0</textarea>
							</td>
						</tr>
						<tr>
							<td class="blank" colspan="3"></td>
			      	<td colspan="1" class="total-line">Total (Tsh)</td>
			      	<td class="total-value"><textarea id="total" name="totalprice">0.00</textarea></td>
			  		</tr>
						<tr>
							<td colspan="6">
								<input type="submit" id="addrow" value="Add A Row" name="addrow" class="addrow">
								<script type="text/javascript" src="js/itemtable.js"></script>
								<?php
								if(isset($_POST['addrow'])) {
									if($ordererror == 0) {
										$stocktype2 = db_string($stocktype2);
										$details2 = db_string($details2);
										$qty2 = db_string($qty2);
										$cost2 = db_string($cost2);
										$price2 = db_string($price2);
										$orderid = db_string($orderid);
										$itemnumber = $itemnumber + 1;
										$itemnumber = db_string($itemnumber);

										$iteminsert = "INSERT INTO orderdetails (OrderId,ItemNo,ItemType,ItemDetails,pricePerPiece,Quantity,Price) VALUES ('$orderid','$itemnumber','$stocktype2','$details2','$cost2','$qty2','$price2')";
										$itemcode = db_insert($iteminsert);

									}
								}//end of else if condn

								?>
							</td>
						</tr>
					</table>
				</form>
				</td>
			<tr>
				<td height="66"></td>
				<td>
          <input type="button" class="button" value="Save" name="subSave" id="submit">
					<input type="reset" class="button" value="Reset" name="reset" >
				</td>
		  </tr>
		</table>
	</form>
</div>
</body>
</html>

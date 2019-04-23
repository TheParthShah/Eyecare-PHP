<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Cache-Control: post-check=0, pre-check=0', false);
header("Pragma: no-cache");

	require('config/connect.php');
	db_connect();
	error_reporting(0);

	$selectid = "SELECT MAX(SalesId) AS SalesId FROM salesmaster";

	$rows = db_select($selectid);
	if ($rows === false) {
		$error .= db_error();
	}else {
		foreach ($rows as $key => $list) {
			$salesid = $list["SalesId"];
			$salesid = $salesid +1;
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

	<title>EyeCare Invoice</title>

	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.1.135/jspdf.min.js"></script>
	<script type="text/javascript" src="http://cdn.uriit.ru/jsPDF/libs/adler32cs.js/adler32cs.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2014-11-29/FileSaver.min.js"></script>
	<script type="text/javascript" src="http://cdn.immex1.com/js/jspdf/plugins/jspdf.plugin.split_text_to_size.js"></script>
	<script type="text/javascript" src="http://cdn.immex1.com/js/jspdf/plugins/jspdf.plugin.from_html.js"></script>


</head>

<body>

	<div id="page-wrap">

		<textarea id="header">INVOICE</textarea>

		<div id="identity">
		<!--enter code for address
            <textarea id="address">
            	Chris Coyier
			123 Appleseed Street
			Appleville, WI 53719
			Phone: (555) 555-5555
			</textarea>
			-->

            <div id="logo">
				<h1>Classic EyeCare</h1>
            </div><!--end of logo div-->

		</div>

		<div style="clear:both"></div>

		<div id="customer">

            <input  id="customer-title" value="Enter Client Name" type="text" />

            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><textarea><?php echo $salesid;?></textarea></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td><textarea id="date"></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Due (Tsh)</td>
                    <td><div class="due">0.00</div></td>
                </tr>

            </table>

		</div>

		<table id="items">

		  <tr>
		      <th>Item</th>
		      <th>Description</th>
		      <th>Unit Cost (Tsh)</th>
		      <th>Quantity</th>
		      <th>Price(Tsh)</th>
		  </tr>

		  <tr class="item-row">
		  	<td class="item-name">
		  		<div class="delete-wpr">
		  			<textarea></textarea>
		  			<a class="delete" href="javascript:;" title="Remove row">X</a>
		  		</div>
		  	</td>
		  	<td class="description">
		  		<textarea></textarea>
		  	</td>
		  	<td>
		  		<textarea class="cost">0</textarea>
		  	</td>
		  	<td>
		  		<textarea class="qty">0</textarea>
		  	</td>
		  	<td>
		  		<span class="price">0</span>
		  	</td>
		  </tr>



		  <tr id="hiderow">
		    <td colspan="5"><a id="addrow" title="Add a row">Add a row</a></td>
		  </tr>

		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Subtotal (Tsh)</td>
		      <td class="total-value"><div id="subtotal">0.00</div></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Total (Tsh)</td>
		      <td class="total-value"><div id="total">0.00</div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Paid (Tsh)</td>

		      <td class="total-value"><textarea id="paid">0.00</textarea></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due (Tsh)</td>
		      <td class="total-value balance"><div class="due">0.00</div></td>
		  </tr>

		</table>

		<a href="javascript:doit()"><button>Click To Print</button></a>
	</div>
</body>

</html>

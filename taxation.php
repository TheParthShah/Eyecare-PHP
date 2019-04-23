<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Cache-Control: post-check=0, pre-check=0', false);
header("Pragma: no-cache");

	require('config/connect.php');
	db_connect();
	error_reporting(0);

	$selectid = "SELECT MAX(TaxId) AS TaxId FROM taxationdetails";

	$rows = db_select($selectid);
	if ($rows === false) {
		$error .= db_error();
	}else {
		foreach ($rows as $key => $list) {
			$taxid = $list["TaxId"];
			$taxid = $taxid +1;
		}
	}


	if($_POST) {
		$errtax = 0;
        $taxtype = $_POST['taxtype'];
        $taxamt = $_POST['taxamt'];
		$taxason = $_POST['taxason'];

		if(isset ($_POST['subSave'])) {

			if( $taxtype == "" ) {
				echo"<script type='text/javascript'>
					alert( 'Tax Type Field Is Blank' );
					</script>";
					$errtax = $errtax + 1;
			}

            if( $taxamt == "" ) {
				echo"<script type='text/javascript'>
					alert( 'Tax Amt Field Is Blank' );
					</script>";
					$errtax = $errtax + 1;
			}

			if( $errtax == '0' ) {

				$taxtype = db_string($taxtype);
				$taxamt = db_string($taxamt);
				$taxason = date('Y-m-d', strtotime(str_replace('/', '-', $taxason)));
				$queryinsert = "INSERT INTO taxationdetails (TaxType, TaxAmount, TaxAsOn) VALUES ('$taxtype','$taxamt','$taxason')";
				$taxcode = db_query($queryinsert);
				//echo $taxcode;
				echo "<script type='text/javascript'>alert('inserted..!!!')</script>";

				echo "<meta http-equiv='refresh' content='0'>";

			}
		} //end of isset if condition
	}	//end of $_Post if condition

?>

<!DOCTYPE html>
<html>

<head>

<title>Taxation</title>

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
	<h1 id="heading">Enter New Tax Information</h1>
</div>


<div>
	<form action="" method="post">
		<table border=0	 id="tablestyle">
			<tr>
				<td></td><td></td>
				<td>
					<label id="label">Tax ID :</label>
				</td>
				<td>
					<label><?php echo $taxid;?></label>
				</td>
			</tr>

			<tr>
				<td>
        	        <label>Tax Type:</label>
               	</td>
				<td colspan="1">
                	<input type="text" name="taxtype" class="longtext">
                </td>
			</tr>


			<tr>
				<td>
            		<label>Tax Amount:</label>
                </td>
				<td>
                	<input type="text" name="taxamt" class="shorttext">
                </td>

                <td>
        	        <label>Tax As On:</label>
                </td>
								<td colspan="1">
                	<input type="text" id="diagnosisdate" class="txtdate" style="width: 100px; height: 20px" name="taxason" value="<?php echo date('d F Y');?>">
               </td>

			</tr>

			<tr>
				<td></td>
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

<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Cache-Control: post-check=0, pre-check=0', false);
header("Pragma: no-cache");

	require('config/connect.php');
	db_connect();
	error_reporting(0);

$clientid = $_GET['clientcode'];
$numrowsclient = "0";
$Client_id = 0;

if(trim($clientid) == "") {

	$queryclient="SELECT ClientId, ClientName FROM clientmaster ORDER BY ClientName";
	$result_client = db_select($queryclient);
	$numrowsclient = 1;
	if ($result_client === false) {
		$error = db_error();		// Send the error to an administrator, log to a file, etc.
	}

}
else {
	$selcname = "SELECT ClientName AS ClientName FROM clientmaster WHERE clientid = '$clientid'";
	$rowscname = db_select($selcname);
	if ($rowscname === false) {
		$error .= db_error();
	}
	else {
		foreach ($rowscname as $rowscnamekey => $rowscnamelist) {
			$clientname = $rowscnamelist['ClientName'];
		}
	}
}



	$selectid = "SELECT MAX(CardId) AS CardId FROM carddetails";

	$rows = db_select($selectid);
	if ($rows === false) {
		$error .= db_error();
	}else {
		foreach ($rows as $key => $list) {
			$cardid = $list["CardId"];
			$cardid = $cardid +1;
		}
	}

	if($_POST) {
		$errcard = 0;
        $clientname = $_POST['clientname'];
        $cardtype = $_POST['cardtype'];
				$cardnumber = $_POST['cardnumber'];

		if(isset ($_POST['subSave'])) {

      if( $cardtype == "" ) {
				echo"<script type='text/javascript'>
					alert( 'Card-Type Field Is Blank' );
					</script>";
					$errcard = $errcard + 1;
			}
			if( $cardnumber == "" ) {
				echo"<script type='text/javascript'>
					alert( 'Card-Number Field Is Blank' );
					</script>";
					$errcard = $errcard + 1;
			}
			if( $errcard == '0' ) {

				$clientname = db_string($clientname);
				$cardtype = db_string($cardtype);
				$cardnumber = db_string($cardnumber);
				$querysearch = "SELECT ClientId FROM clientmaster WHERE ClientName LIKE '$clientname' ";
				$searchcode = db_query($querysearch);
				$queryinsert = "INSERT INTO carddetails (ClientName, CardType, CardNumber) VALUES
						('$clientname','$cardtype','$cardnumber')";
				$cardcode = db_query($queryinsert);
				//echo $cardcode;
				echo "<script type='text/javascript'>alert('inserted..!!!')</script>";
				echo "<meta http-equiv='refresh' content='0'>";

			}
		} //end of isset if condition
	}	//end of $_Post if condition

?>

<!DOCTYPE html>
<html>

<head>

<title>Card Details</title>

<link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" href="css/formstyle1.css" type="text/css">

<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" href="js/formscript.js"></script>


</head>

<body>
<div id="header">
	<h1 id="heading">Enter New Card Informations</h1>
</div>

<div>
	<form action="" method="post">
		<table border=0	 id="tablestyle">
			<tr>
				<td></td><td></td>
				<td>
					<label id="label">Card ID :</label>
				</td>
				<td>
					<label><?php echo $cardid;?></label>
				</td>
			</tr>

			<tr>
				<?php if($numrowsclient > 0) { ?>
					<td>&nbsp;</td>
				<?php } else {  ?>
					<td>
						<label>Client Name :</label>
					</td>
					<td><strong><?php echo $clientname ?></strong></td>
					<td><input type="hidden" id="clientid" name="clientid" value="<?php echo $clientid; ?>"></td>
				<?php } ?>
			</tr>
			<?php if($numrowsclient > 0) { ?>
				<tr>
					<td>Client Name : </td>
						<td><font size="2" face="Verdana" color="black">
						<select name="clientid" id="clientid" class="my_select_box" style="font-family: Verdana; width: 400px; height: 20px">
						<option value="0" selected>None</option>
						<?php
						foreach ($result_client as $rclkey => $rsclient) {
							$Client_id = $rsclient["ClientId"];
							$Client_name = $rsclient["ClientName"];
							if ($Client_id==$clientid) {
								echo"<option value='$Client_id' selected>$Client_name</option>";
							}
							else {
								echo"<option value='$Client_id'>$Client_name</option>";
							}
						}
					}
					?>

			<tr>
				<td>
          <label>Card Type:</label>
        </td>
				<td>
          <input type="text" name="cardtype" class="longtext">
        </td>
        <td>
        	<label>Card Number:</label>
        </td>
				<td colspan="1">
          <input type="text" name="cardnumber" class="longtext">
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

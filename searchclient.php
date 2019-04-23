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

$fullname = trim($_POST['fullname']);

	if(isset ($_POST['subReset'])) {
		$destination_url = "searchclient.php";
		header("Location:$destination_url");
		exit();
	}
	elseif(isset ($_POST['subSearch'])) {



		$selectid = "SELECT ClientId, ClientName, PrimaryNumber, SecondaryNumber, DOB, PostBox, Address, EmailId, Gender, Occupation, Referance
			FROM clientmaster WHERE ClientName LIKE '%$fullname%' OR PrimaryNumber LIKE '%$fullname%'";
		$rowsid = db_select($selectid);
		if ($rowsid === false) {
			$error .= db_error();
		}
		else {
			$numrowsid = 10;
		}
	}

	elseif(isset ($_POST['updateclient'])) {
		$primarynumber = $_POST['pnum'];
		$othernumber = $_POST['onum'];
		$address = $_POST['add'];
		$updatecode = "UPDATE clientmaster SET PrimaryNumber='$primarynumber', SecondaryNumber='$othernumber' ,Address='$address' WHERE ClientName='$fullname'";
		$rowsid = db_select($updatecode);
		if ($rowsid === false) {
			$error .= db_error();
		}
		else {
			$numrowsid = 10;
			echo "<script type='text/javascript'>alert('updated...!!!')</script>";

			$destination_url = "searchclient.php";
			header("Location:$destination_url");
			exit();

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

<style>
.longtext {
	height: 20px;
	width: 350px;
}

.shorttext {
	height: 20px;
	width: 150
}

#label {
	text-align: right;
	height: 10px;
}
</style>
</head>
<body>
		<div id="header" align="center">
			<h1 id="heading">Search a Client</h1>
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
					<td align="center">Enter Client Details :</td>
					<td>
						<input type="text" name="fullname" class="longtext" placeholder="Part of the Name OR Full Name OR Phone Number" required="required"  value="<?php echo $fullname ?>">
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
						$clientcode = $idlist['ClientId'];
						$fullname = $idlist['ClientName'];
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
							echo"<tr class='d3'>";
						}
						else {
							echo"<tr class='d1'>";
						}
						echo "
							<td >Name: <input type='text' value='$fullname' name='fullname'></td>
							<td align=center><font size=2 face=Verdana><a href='diagnosisdetails.php?clientcode=$clientcode'><strong>Record Diagnosis</strong></a></font></td>
						 	<td align=center><font size=2 face=Verdana><a href='carddetails.php?clientcode=$clientcode'><strong>Enter New Card Details</strong></a></font></td>
							<td align=center><input type='submit' value='Update Records' style='font-size:13px' name='updateclient' /></td>
						</tr>
						<tr>
							<td colspan=3>Date of Birth: <font size=2 face=Verdana><strong>$dateofbirth</strong></font> | Referer: <font size=2 face=Verdana><strong>$referer</strong></font></td>
						</tr>
						<tr>
							<td colspan=3>Contact Number: <input type='text' value='$primarynumber' name='pnum'>  | Email: <font size=2 face=Verdana><strong>$email</strong></font> | Other Number: <input type='text' value='$othernumber' name='onum'></td>
						</tr>
						<tr>
							<td colspan=3>Postbox: <font size=2 face=Verdana><strong>$postbox</strong></font> | Address: <input type='text' value='$address' name='add' class='longtext'></font></td>
						</tr>
						<tr>
							<td colspan=3>Occupation: <font size=2 face=Verdana><strong>$occupation</strong></font></td>
						<tr>
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

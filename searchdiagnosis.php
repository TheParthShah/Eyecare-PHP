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

	if(isset ($_POST['subReset'])) {
		$destination_url = "searchdiagnosis.php";
		header("Location:$destination_url");
		exit();
	}
	elseif(isset ($_POST['subSearch'])) {

		$fullname = trim($_POST['fullname']);

		$selectid = "SELECT
dm.DiagnosisId AS DiagnosisId,
dm.ClientId AS ClientId,
dm.PatientName AS PatientName,
dm.VRRE AS VRRE,
dm.VRLE AS VRLE,
dm.ORRE AS ORRE,
dm.ORLE AS ORLE,
dm.SRRE AS SRRE,
dm.SRLE AS SRLE,
dm.CC AS CC,
dm.PatientContactNumber AS ContactNumber,
dm.Diagnosis AS Diagnosis,
dm.DiagnosisDate AS DiagnosisDate,
di.DoctorName AS DoctorName
			FROM diagnosisdetails dm JOIN clientmaster cl ON dm.ClientId = cl.ClientId
				JOIN doctordetails di ON dm.DoctorId = di.DoctorId
			WHERE dm.PatientName LIKE '%$fullname%' OR dm.PatientContactNumber = '%$fullname%'";
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
			<h1 id="heading">Search Diagnosis Records</h1>
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
					<td align="center">Enter Patient Details :</td>
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
					// DiagId, CustId, ClientName, VRRE, VRLE, ORRE, ORLE, SRRE, SRLE, CC, Plan, DiagDate, DocName, PatientName
					echo "<tr><td colspan=3>&nbsp;</td></tr>";
					foreach ($rowsid as $idkey => $idlist) {
						$custcode = $idlist['ClientId'];
						$diagid = $idlist['DiagnosisId'];
						$clientname = $idlist['ClientName'];
						$patientname = $idlist['PatientName'];
						$contactnumber = $idlist['ContactNumber'];
						$docname = $idlist['DoctorName'];
						$diagdate2 = $idlist['DiagnosisDate'];
						$diagdate = date("d F Y", strtotime($diagdate2));
						$vrre = $idlist['VRRE'];
						$vrle = $idlist['VRLE'];
						$orre = $idlist['ORRE'];
						$orle = $idlist['ORLE'];
						$srre = $idlist['SRRE'];
						$srle = $idlist['SRLE'];
						$cc = $idlist['CC'];
						$diagnosis = $idlist['Diagnosis'];

						if($counter&1){
							echo"<tr class='d3'>";
						}
						else {
							echo"<tr class='d1'>";
						}
						echo "
							<td colspan=2>Patient: <font size=2 face=Verdana><strong>$patientname</strong></font></td>
							<td align=center><font size=2 face=Verdana><a href='diagnosisdetails.php?clientcode=$clientcode&diagid=$diagid'><strong>Record New Diagnosis</strong></a></font></td>
						</tr>
						<tr>
							<td colspan=3>Contact Number: <font size=2 face=Verdana><strong>$contactnumber</strong></font></td>
						</tr>
						<tr>
							<td colspan=3>Diagnosis Date: <font size=2 face=Verdana><strong>$diagdate</strong></font> | Doctor: <font size=2 face=Verdana><strong>$docname</strong></font></td>
						</tr>
						<tr>
							<td colspan=3>Visual Refraction: Right Eye <font size=2 face=Verdana><strong>$vrre</strong></font> | Left Eye <font size=2 face=Verdana><strong>$vrle</strong></font></td>
						</tr>
						<tr>
							<td colspan=3>Objective Refraction: Right Eye <font size=2 face=Verdana><strong>$orre</strong></font> | Left Eye <font size=2 face=Verdana><strong>$orle</strong></font></td>
						</tr>
						<tr>
							<td colspan=3>Subjective Refraction: Right Eye <font size=2 face=Verdana><strong>$srre</strong></font> | Left Eye <font size=2 face=Verdana><strong>$srle</strong></font></td>
						</tr>
						<tr>
							<td colspan=3>CC: <font size=2 face=Verdana><strong>$cc</strong></font> | Plan: <font size=2 face=Verdana><strong>$diagnosis</strong></font></td>
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

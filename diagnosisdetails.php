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

	$olddiagid = $_GET['diagid'];
	if($olddiagid == "") { $olddiagid = 0; }
	if($olddiagid > 0) {
		$selpatname = "SELECT PatientName AS PatientName FROM diagnosisdetails WHERE DiagnosisId = '$olddiagid'";
		$rowspatname = db_select($selpatname);
		if ($rowspatname === false) {
			$error .= db_error();
		}
		else {
			foreach ($rowspatname as $rowspatnamekey => $rowspatnamelist) {
				$patientname = $rowspatnamelist['PatientName'];
			}
		}
	}


	$selectid = "SELECT MAX(DiagnosisId) AS DiagnosisId FROM diagnosisdetails";

	$rows = db_select($selectid);
	if ($rows === false) {
		$error .= db_error();
	}else {
		foreach ($rows as $key => $list) {
			$diagnosisid = $list["DiagnosisId"];
			$diagnosisid = $diagnosisid +1;
		}
	}

	$doctorid = 0;
	$queryinco="SELECT DoctorId, DoctorName FROM doctordetails ORDER BY DoctorName";
	$result_inco = db_select($queryinco);
	if ($result_inco === false) {
		$error = db_error();		// Send the error to an administrator, log to a file, etc.
		$numrowsinco = 0;
	}
	else {
		$numrowsinco = 1;
	}


$diagerror = 0;

if ($_POST) {
	$diagnosisdate = $_POST['diagnosisdate'];
	$patientname = $_POST['patientname'];
	$clientid = $_POST['clientid'];
	//$clientname = $_POST['clientname'];
	$gender = $_POST['gender'];
	$age = $_POST['age'];
	$contact = $_POST['contact'];
	$occupation = $_POST['occupation'];
	$healthissue = $_POST['healthissue'];
	$cc = $_POST['cc'];
	$vrre = $_POST['vrre'];
	$vrle = $_POST['vrle'];
	$orre = $_POST['orre'];
	$orle = $_POST['orle'];
	$srre = $_POST['srre'];
	$srle = $_POST['srle'];
	$diagnosis = $_POST['diagnosis'];
	//$doctorname = $_POST['doctorname'];
	$doctorid = $_POST['doctorid'];

	if(isset ($_POST['reset'])) {
				$destination_url = "diagnosisdetails.php?clientcode=$clientid";
				header("Location:$destination_url");
				exit();
	}
	elseif(isset($_POST['subSave'])) {
		if($diagerror == 0) {
		$diagnosisdate = date('Y-m-d', strtotime(str_replace('/', '-', $diagnosisdate)));
		$patientname = db_string($patientname);
		$clientid = db_string($clientid);
		$gender = db_string($gender);
		$age = db_string($age);
		$contact = db_string($contact);
		$occupation = db_string($occupation);
		$healthissue = db_string($healthissue);
		$cc = db_string($cc);
		$vrre = db_string($vrre);
		$vrle = db_string($vrle);
		$orre = db_string($orre);
		$orle = db_string($orle);
		$srre = db_string($srre);
		$srle = db_string($srle);
		$diagnosis = db_string($diagnosis);
		//$doctorname = db_string($doctorname);
		$doctorid = db_string($doctorid);

		$diaginsert = "INSERT INTO diagnosisdetails (ClientId,PatientName,Gender,PatientContactNumber,Age,HealthIssue,Occupation,VRRE,VRLE,ORRE,ORLE,SRRE,SRLE,CC,Diagnosis,DiagnosisDate,DoctorId) VALUES ('$clientid','$patientname','$gender','$contact','$age','$healthissue','$occupation','$vrre','$vrle','$orre','$orle','$srre','$srle','$cc','$diagnosis','$diagnosisdate','$doctorid')";
		$diagnosiscode = db_insert($diaginsert);
		//echo $diagnosiscode;
		echo "<script type='text/javascript'>alert('inserted..!!!')</script>";

		$destination_url = "diagnosisdetails.php";
		header("Location:$destination_url");
		exit();
	}
	}

}//end of $_POST if condn

?>

<!DOCTYPE html>
<html>

<head>

<title>Diagnosis Details</title>

<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="css/formstyle2.css" type="text/css">
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

});

 $(function() {
    //autocomplete
    $(".auto").autocomplete({
        source: "autocompletecode/clientnameauto.php",
        minLength: 1
    });

});
  </script>


</head>

<body>
<div id="header">
	<h1 id="heading">Enter New Diagnosis Records</h1>
</div>

<div>
	<form action="" method="post">
		<table border=0	 id="tablestyle">
			<tr>
				<td></td><td></td>
				<td >
					<label>Diagnosis ID :</label>

				</td>
				<td>
					<label><?php echo $diagnosisid; ?></label>
				</td>
			</tr>

			<tr>
				<td></td><td></td>
				<td >
					<label>Diagnosis Date :</label>
				</td>
				<td>
					<input type="text" id="diagnosisdate" class="txtdate" style="width: 100px; height: 20px" name="diagnosisdate" value="<?php echo date('d F Y');?>">
				</td>
			</tr>

			<tr>
				<td align="right">
					<label>Patient Name :</label>
				</td>
				<td colspan="1">
        	<input type="text" name="patientname" class="longtext" value="<?php echo $patientname ?>">
				</td>
				<!--
				<td align="right">
					<label>Client Name :</label>
				</td>
				<td colspan="1">
                	<input type="text" name="clientname" class="longtext">
				</td>
			-->
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
					?>
						</select>
						</font></td>
				</tr>
			<?php } ?>

			<tr>
				<td align="right">
					<label>Gender :</label>
				</td>
				<td>
					<input type="radio" name="gender" value="Male"><label >Male</label>
					<input type="radio" name="gender" value="Female"><label>Female</label>
				</td>
				<td align="right">
					<label>Age :</label>
				</td>
				<td>
					<input type="text" name="age" class="shorttext" placeholder="Enter Patient Age"> Years.
				</td>
			</tr>

            <tr>
            	<td align="right">
					<label>Contact :</label>
				</td>
				<td>
					<input type="text" name="contact" class="longtext">
				</td>
				<td>
					<label>Occupation :</label>
				</td>
				<td>
					<input type="text" name="occupation" class="shorttext">
				</td>
            </tr>

            <tr>
            	<td align="right">
					<label>Health Issue :</label>
				</td>
				<td>
					<input type="text" name="healthissue" class="longtext">
				</td>
				<td align="center">
					<label>C.C : </label>
				</td>
				<td>
					<input type="text" name="cc" class="longtext">
				</td>
        </tr>

            <tr>

            </tr>

			<tr>
				<td colspan="2"> <fieldset>
					<legend>Description</legend>
				<pre><H3><label>VRLE : </label><input type="text" name="vrle" class="shorttext">		<label>VRRE : </label><input type="text" name="vrre" class="shorttext" > </pre>

				<pre><H3><label>ORLE : </label><input type="text" name="orle" class="shorttext">		<label>ORRE : </label><input type="text" name="orre" class="shorttext"></pre>

				<pre><H3><label>SRLE : </label><input type="text" name="srle" class="shorttext">		<label>SRRE : </label><input type="text" name="srre" class="shorttext"></pre>
				</fieldset>
				</td>
				<td align="right">
					<label>Diagnosis :</label>
				</td>
				<td colspan="1">
                	<textarea cols="50" rows="5" name="diagnosis"></textarea>
				</td>
			</tr>

			<tr>
				<td align="right">Doctor : </td>
					<td><font size="2" face="Verdana" color="black">
					<select name="doctorid" id="doctorid" class="my_select_box" style="font-family: Verdana; width: 200px; height: 20px">
					<option value="0" selected>None</option>
					<?php
					foreach ($result_inco as $rincokey => $resultinco) {
						$inco_id = $resultinco["DoctorId"];
						$inco_name = $resultinco["DoctorName"];
						if ($inco_id==$doctorid) {
							echo"<option value='$inco_id' selected>$inco_name</option>";
						}
						else {
							echo"<option value='$inco_id'>$inco_name</option>";
						}
					}
				?>
					</select>
					</font></td>
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

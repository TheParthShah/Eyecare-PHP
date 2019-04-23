<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Cache-Control: post-check=0, pre-check=0', false);
header("Pragma: no-cache");

	require('config/connect.php');
	db_connect();
	error_reporting(0);

	$selectid = "SELECT MAX(PrescriptionId) AS PrescriptionId FROM prescriptiondetails";

	$rows = db_select($selectid);
	if ($rows === false) {
		$error .= db_error();
	}else {
		foreach ($rows as $key => $list) {
			$prescriptionid = $list["PrescriptionId"];
			$prescriptionid = $prescriptionid +1;
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

	if($_POST) {
		$clienterror = 0;
		$patientname = $_POST['patientname'];
		$prescriptiondate = $_POST['prescriptiondate'];
		$doctorname = $_POST['doctorname'];
		$medication = $_POST['medications'];
		$coursetime = $_POST['coursetime'];

		if(isset($_POST['subSave'])) {

			if( $clienterror == '0' ) {
				$patientname = db_string($patientname);
				$prescriptiondate =  date('Y-m-d', strtotime(str_replace('/', '-', $prescriptiondate)));
				$doctorname = db_string($doctorname);
				$medication = db_string($medication);
				$coursetime = db_string($coursetime);

				$queryinsert = "INSERT INTO prescriptiondetails (PatientName, PrescriptionDate, DoctorName, Medication, CourseTime) VALUES 								('$patientname','$prescriptiondate','$doctorname','$medication','$coursetime')";

				$prescriptioncode = db_query($queryinsert);

				echo "<script type='text/javascript'>alert('insert')</script>";

				echo "<meta http-equiv='refresh' content='0'>";



			}//end of err_cust if condition
		}//end of isset
	}//end of $_POST
?>
<!DOCTYPE html>
<html>

<head>

<title>Prescription Details</title>

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


 $(function() {
    //autocomplete
    $(".auto").autocomplete({
        source: "autocompletecode/patientautocode.php",
        minLength: 1
    });

});

  </script>


</head>

<body>

<div id="header">
	<h1 id="heading">Enter New Prescription Records</h1>
</div>


<div>
	<form action="" method="post" >
		<table border=0	 id="tablestyle">
     		<tr>
			<td></td><td></td>
			<td>
				<label id="label">Prescription ID : </label>
			</td>
			<td>
				<label><?php echo $prescriptionid; ?></label>
			</td>
		</tr>
		<tr>
			<td></td><td></td>
			<td>
				<label id="label">Diagnosis ID : </label>
			</td>
			<td>
				<label></label>
			</td>
		</tr>

		<tr>
			<td>
                <label>Patient Name :</label>
            </td>
			<td colspan="1">
				<input type="text" name="patientname" class="longtext auto" />
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
			<td>
				<label>Medications :</label>
			</td>
			<td>
				<textarea rows=4 cols="42" name="medications"></textarea>
			</td>
		</tr>

		<tr>
			<td></td><td></td>
			<td>
				<label>Course Time :</label>
			</td>
			<td>
				<input type="text" name="coursetime" class="shorttext"> Days</td>
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

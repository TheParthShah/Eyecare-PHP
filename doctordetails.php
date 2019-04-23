<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Cache-Control: post-check=0, pre-check=0', false);
header("Pragma: no-cache");

	require('config/connect.php');
	db_connect();
	error_reporting(0);

	$selectid = "SELECT MAX(DoctorId) AS DoctorId FROM DoctorDetails";

	$rows = db_select($selectid);
	if ($rows === false) {
		$error .= db_error();
	}else {
		foreach ($rows as $key => $list) {
			$doctorid = $list["DoctorId"];
			$doctorid = $doctorid +1;
		}
	}


	if($_POST) {
		$errtax = 0;
        $docname = $_POST['docname'];
		if(isset ($_POST['subSave'])) {

			if( $errtax == '0' ) {

				$docname = db_string($docname);

				$queryinsert = "INSERT INTO doctordetails (DoctorName) VALUES ('$docname')";
				$doctorcode = db_query($queryinsert);
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

<title>Doctor Details</title>

<link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" href="css/formstyle1.css" type="text/css">


<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>

</head>

<body>

<div id="header">
	<h1 id="heading">Enter Doctor Details</h1>
</div>


<div>
	<form action="" method="post" >
		<table border=0	 id="tablestyle">
			<tr>
				<td></td><td></td>
				<td>
					<label id="label">Doctor ID :</label>
				</td>
				<td>
					<label><?php echo $doctorid;?></label>
				</td>
			</tr>

			<tr>
				<td>
                			<label>Doctor's Name :</label>
                		</td>
				<td>
                			<input type="text" name="doctorname" class="longtext"></td>
				</td>
			</tr>

            		<tr>
				<td align="center">
                			<label>Signature :</label>
                		</td>
				<td>
                			<input type='file' name='filename' size='10'/>
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

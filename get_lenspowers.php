<?php

if ( !isset($_POST['listcode']) ) {
	$destination_url = "index.php";
	header("Location:$destination_url");
	exit;
}

require('config/connect.php');
db_connect();

if($_POST['listcode'])
{
	$listcode=$_POST['listcode'];
	if($listcode == "PS") { $lenstype = "Progressive"; }
	elseif($listcode == "NR") { $lenstype = "Normal"; }
	else { $lenstype = "Normal"; }

	$queryinco="SELECT LensId, LensPower FROM LensMaster 
		WHERE LensType = '$lenstype'
		ORDER BY LensId";
	$result_inco = db_select($queryinco);
	if ($result_inco === false) {
		$error = db_error();		// Send the error to an administrator, log to a file, etc.
	} 
	else {
		foreach ($result_inco as $rincokey => $resultinco) {
			$lens_id = $resultinco["LensId"];
			$lens_power = $resultinco["LensPower"];
			echo '<option value="'.$lens_id.'">'.$lens_power.'</option>';
		}
	}
	
}
?>
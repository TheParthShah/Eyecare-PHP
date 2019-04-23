<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Cache-Control: post-check=0, pre-check=0', false);
header("Pragma: no-cache");

	require('config/connect.php');
	db_connect();
	error_reporting(0);

	$selectid = "SELECT MAX(ClientId) AS ClientId FROM clientmaster";

	$rows = db_select($selectid);
	if ($rows === false) {
		$error .= db_error();
	}else {
		foreach ($rows as $key => $list) {
			$clientid = $list["ClientId"];
			$clientid = $clientid +1;
		}
	}

	if($_POST) {
		$clienterror = 0;
		$clientname = $_POST['clientname'];
		$primarynumber = $_POST['primarynumber'];
		$secondarynumber = $_POST['secondarynumber'];
		$dob = $_POST['dateofbirth'];
		$gender = $_POST['gender'];
		$email = $_POST['email'];
		$postbox = $_POST['postbox'];
		$address = $_POST['address'];
		$occupation = $_POST['occupation'];
		$reference = $_POST['reference'];

		if(isset($_POST['subSave'])) {
			/*if(!ereg("^[a-z]+$",$clientname) {
				echo"<script type='text/javascript'>
					alert( 'Enter A Valid Name.' );
					</script>";
				$clienterror = $clienterror + 1;
			}*/
			if( (!filter_var($email, FILTER_VALIDATE_EMAIL)) OR ( $email == "" ) ){
				echo"<script type='text/javascript'>
					alert( 'This email address is not a valid email address.' );
					</script>";
				$clienterror = $clienterror + 1;
			}
			if( ($postbox == "" ) OR (!filter_var($postbox, FILTER_VALIDATE_INT) === true) ) {
				echo"<script type='text/javascript'>
					alert( 'Enter A Postbox Number' );
					</script>";
					$clienterror = $clienterror + 1;
			}
			if( $clienterror == '0' ) {
				$clientname = db_string($clientname);
				$primarynumber = db_string($primarynumber);
				$secondarynumber = db_string($secondarynumber);
				$datebirth = db_string($dob);
				$dob =  date('Y-m-d', strtotime(str_replace('/', '-', $datebirth)));
				$gender = db_string($gender);
				$email = db_string($email);
				$postbox = db_string($postbox);
				$address = db_string($address);
				$occupation = db_string($occupation);
				$reference = db_string($reference);

				$queryinsert = "INSERT INTO clientmaster (ClientName, PrimaryNumber, SecondaryNumber, DOB, PostBox, Address, EmailId, Gender, Occupation, Referance) VALUES 								('$clientname','$primarynumber','$secondarynumber','$dob','$postbox','$address','$email','$gender','$occupation','$reference')";

				$clientcode = db_insert($queryinsert);
				echo "<script type='text/javascript'>alert('insert')</script>";

				echo "<meta http-equiv='refresh' content='0'>";



			}//end of err_cust if condition
		}//end of isset
	}//end of $_POST

?>
<!DOCTYPE html>
<html>

<head>

<title >Client Master</title>

<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="css/formstyle1.css" type="text/css">

<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
<script>
 $(document).ready(function() {
   $("#datepicker").datepicker({
           changeMonth: true,
           changeYear: true,
           yearRange: '1910:$.now()',
           maxDate: new Date($.now()),
           dateFormat: 'dd/mm/yy'
   })
   .hide()
   .click(function() {
      //$(this).hide();
   });

   $("#datepickerImage").click(function() {
       $("#datepicker").show();
   });
});
</script>


</head>

<body>

<div id="header">
	<h1 id="heading">Enter New Client Informations</h1>
</div>



<div>
	<form action="clientmaster.php" method="post" >
	  <table border="0px" id="tablestyle" cellpadding="0px" cellspacing="0px">
			<tr>
				<td></td><td></td>
				<td>

					<label id="label">Client ID :</label>
				</td>
				<td>
					<label ><?php echo $clientid;?></label>
				</td>
			</tr>

			<tr>
				<td>
					<label>Client Name :</label>
				</td>
				<td colspan="1">
					<input type="text" name="clientname" required class="longtext">
				</td>
			</tr>

			<tr>
				<td>
					<label>Primary Number :</label>
				</td>
				<td>
					<input type="text" name="primarynumber" required class="longtext" class="longtext" value="+255">
				</td>
				<td>
					<label id="label">Secondary Number :</label>
				</td>
				<td>
					<input type="text" name="secondarynumber" class="longtext" class="longtext" value="+255">
				</td>
			</tr>

			<tr>
				<td>
					<label>D.O.B :</label>
				</td>
				<td>
					<input type="text" name="dateofbirth" required id="datepicker"> <img src="images/iconCalendar.gif" id="datepickerImage">
				</td>
			</tr>

			<tr>
				<td>
					<label>Gender :</label>
				</td>
				<td>
					<input type="radio" name="gender" value="Male"><label >Male</label>
					<input type="radio" name="gender" value="Female"><label>Female</label>
				</td>
			</tr>

			<tr>
				<td>
					<label>Email ID :</label>
				</td>
				<td>
					<input type="email" name="email" class="longtext" class="longtext" >
				</td>
			</tr>

			<tr>
				<td></td><td></td>
				<td>
					<label id="label">Post Box :</label>
				</td>
				<td>
					<input type="text" name="postbox" class="shorttext" class="shorttext">
				</td>
			</tr>

			<tr>
				<td>
					<label>Address :</label>
				</td>
				<td>
				  <textarea rows="4" cols="50" name="address" required ></textarea>
				</td>
			</tr>

			<tr>
				<td>
					<label>Occupation :</label>
				</td>
				<td>
					<input type="text" name="occupation" class="shorttext">
				</td>
				<td>
					<label id="label">reference :</label>
				</td>
			    <td>
			    	<input type="text" name="reference" class="shorttext">
			    </td>
			</tr>

			<tr>
				<td height="57"></td>
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

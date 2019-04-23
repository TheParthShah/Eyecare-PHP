<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Cache-Control: post-check=0, pre-check=0', false);
header("Pragma: no-cache");

require('config/connect.php');
db_connect();
error_reporting(0);

$selectid = "SELECT MAX(UserId) AS UserId FROM usermaster";

$rows = db_select($selectid);
if ($rows === false) {
	$error .= db_error();
}else {
	foreach ($rows as $key => $list) {
		$userid = $list["UserId"];
		$userid = $userid +1;
	}
}

	if($_POST) {
		$usererror = 0;
		$username = $_POST['username'];
		$password = $_POST['password'];
		$useraccess = $_POST['useraccess'];

		if(isset($_POST['subSave'])) {
			if( strlen($password) < 8 ){
				echo"<script type='text/javascript'>
					alert( 'Password Not Long.' );
					</script>";
				$clienterror = $clienterror + 1;
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Details</title>

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
	<h1 id="heading">Enter New User Details</h1>
</div>

<div>
	<form action="" method="post">
		<table border=0	 id="tablestyle">
			<tr>
				<td></td><td></td>
				<td >
					<label>User ID :</label>

				</td>
				<td>
					<label ><?php echo $userid;?></label>
				</td>
			</tr>


			<tr>
				<td>
					<label>User Name :</label>
				</td>
				<td colspan="1">
        	<input type="text" name="username" class="longtext">
				</td>
			</tr>

            <tr>
				<td>
					<label>Password :</label>
				</td>
				<td colspan="1">
                	<input type="text" name="password" class="longtext">
				</td>
			</tr>

<!--
            <tr>
				<td></td><td></td>
                <td>
					<label>User Access :</label>
				</td>
				<td colspan="1">
                	<input type="text" name="useraccess" class="shorttext">
				</td>
			</tr>
-->
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

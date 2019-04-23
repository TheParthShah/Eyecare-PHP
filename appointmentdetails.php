<?php
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Cache-Control: post-check=0, pre-check=0', false);
header("Pragma: no-cache");

	require('config/connect.php');
	db_connect();
	error_reporting(0);

	$selectid = "SELECT MAX(AppointmentId) AS AppointmentId FROM appointmentdetails";

	$rows = db_select($selectid);
	if ($rows === false) {
		$error .= db_error();
	}else {
		foreach ($rows as $key => $list) {
			$appointmentid = $list["AppointmentId"];
			$appointmentid = $appointmentid +1;
		}
	}

	if($_POST) {
		$errappointment = 0;
        $appointmenttype = $_POST['appointmenttype'];
		$clientname = $_POST['clientname'];
        $appointmentdate = $_POST['appointmentdate'];
        $appointmenttime = $_POST['appointmenttime'];
		$appointmentDetails = $_POST['appointmentDetails'];

		if(isset ($_POST['subSave'])) {

			if( $appointmenttype == "" ) {
				echo"<script type='text/javascript'>
					alert( 'Appointment Type Field Is Blank' );
					</script>";
					$errappointment = $errappointment + 1;
			}

            if( $clientname == "" ) {
				echo"<script type='text/javascript'>
					alert( 'Client-Name Field Is Blank' );
					</script>";
					$errappointment = $errappointment + 1;
			}

			if( $appointmentdate == "" ) {
				echo"<script type='text/javascript'>
					alert( 'Appointment Date Field Is Blank' );
					</script>";
					$errappointment = $errappointment + 1;
			}

			if( $appointmenttime == "" ) {
				echo"<script type='text/javascript'>
					alert( 'Appointment Time Field Is Blank' );
					</script>";
					$errappointment = $errappointment + 1;
			}

			if( $appointmentDetails == "" ) {
				echo"<script type='text/javascript'>
					alert( 'Appointment Details Field Is Blank' );
					</script>";
					$errappointment = $errappointment + 1;
			}




			if( $errappointment == '0' ) {

				$appointmenttype = db_string($appointmenttype);
				$clientname = db_string($clientname);
				$appointmentdate = date('Y-m-d', strtotime(str_replace('/', '-', $appointmentdate)));
				$strtotime = strtotime($appointmenttime);
				$mysqltime = date('H:m:s', $strtotime);
				$appointmentDetails = db_string($appointmentDetails);


				$queryinsert = "INSERT INTO appointmentdetails (AppointmentType, ClientName, AppointmentDate, AppointmentTime, AppointmentDetails) VALUES
						('$appointmenttype','$clientname','$appointmentdate','$mysqltime','$appointmentDetails')";
				$appointmentcode = db_query($queryinsert);
				//echo $appointmentcode;
				echo "<script type='text/javascript'>alert('inserted..!!!')</script>";
				echo "<meta http-equiv='refresh' content='0'>";



			} //end of errappointment if condition
		} //end of isset if condition
	}	//end of $_Post if condition


?>

<!DOCTYPE html>
<html>

<head>

<title>Appointment Details</title>


 <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
 <link rel="stylesheet" href="js/jquery-timepicker-master/jquery.timepicker.css" type="text/css">
<link rel="stylesheet" href="css/formstyle1.css" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.8.9/jquery.timepicker.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.8.9/jquery.timepicker.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery-timepicker-master/jquery.timepicker.js"></script>
<script type="text/javascript" src="js/jquery-timepicker-master/jquery.timepicker.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" href="js/formscript.js"></script>
  <script>
  //date picker
$(document).ready(function() {

	$('#datepicker').datepicker({
		defaultDate: 0,
		changeMonth: true,
		changeYear: true,
		minDate: 0
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

//$(document).ready(function(){
//	$('.timepicker').timepicker({
//		timeFormat: 'h:i A',
//		interval: 15,
//		minTime: '9',
//		maxTime: '9:00pm',
//		defaultTime: '9',
//		startTime: '9',
//		dynamic: false,
//		dropdown: true,
//		scrollbar: true
//
//
//	});
//});

$(document).ready(function(){
    // initialize both timepickers at once
    $('input.timepicker').timepicker({
        timeFormat: 'h:i A',
        // year, month, day and seconds are not important
        minTime: new Date(0, 0, 0, 9, 0, 0),
        maxTime: new Date(0, 0, 0, 21, 0, 0),
        // time entries start being generated at 6AM but the plugin
        // shows only those within the [minTime, maxTime] interval
        startHour: 6,
        // the value of the first item in the dropdown, when the input
        // field is empty. This overrides the startHour and startMinute
        // options
        startTime: new Date(0, 0, 0, 9, 0, 0),
        // items in the dropdown are separated by at interval minutes
				stepMinute: 15
    });

    // change select time in timepicker-2.
    $('#tp2').timepicker('setTime', '9:00');

    // change select time in timepicker-1.
    $('input.change-format').click(function() {
        var input = $(this),
            timepicker = input.closest('div').find('.timepicker'),
            instance = timepicker.timepicker();
        instance.option('timeFormat', $(this).data('format'));
    });
});


</script>


</head>

<body>
<div id="header">
	<h1 id="heading">Enter New Appointments</h1>
</div>


<div>
	<form action="" method="post">
		<table width="1014" border=0	 id="tablestyle">
			<tr>
				<td></td><td></td>
				<td>
					<label id="label">Appointment ID :</label>
				</td>
				<td>
					<label><?php echo $appointmentid;?></label>
				</td>
			</tr>

			<tr>
				<td>
        	        <label>Appointment Type :</label>
                </td>
				<td colspan="1">
                	<input type="text" name="appointmenttype" class="longtext">
                </td>
			</tr>

			<tr>
            	<td>
        	        <label>Client Name:</label>
                </td>
				<td colspan="1">
                	<input type="text" name="clientname" class="longtext auto">
                </td>
			</tr>

            <tr>
				<td >
					<label>Appointment Date :</label>

				</td>
				<td>
					<input type="text" id="datepicker" class="txtdate" style="width: 100px; height: 20px" name="appointmentdate" value="<?php echo date('d F Y');?>">
				</td>

                <td>
                	<label>Appointment Time:</label>
                </td>
				<td>
                	<input id="tp2" class="timepicker" style="width: 100px; height: 20px" name="appointmenttime" >
                </td>
			</tr>

        	<tr>
                <td>
                	<label>Appointment Details:</label>
                </td>
				<td>
                	<textarea rows="5" cols="42" name="appointmentDetails"></textarea>
                </td>
			</tr>

			<tr>
				<td height="127"></td>
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

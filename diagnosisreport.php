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
 $diagnosiscount=0;

   $selectid = "SELECT COUNT(*) AS DiagnosisCount FROM diagnosisdetails";
   $rows = db_select($selectid);
   if ($rows === false) {
     $error .= db_error();
   }else {
     foreach ($rows as $key => $list) {
       $diagnosiscount = $list["DiagnosisCount"];
       $diagnosiscount = $diagnosiscount;
     }
   }


   if( $_POST ) {

   $patientname = trim($_POST['patientname']);

     if(isset ($_POST['subSearch'])) {

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
   			WHERE dm.PatientName LIKE '%$patientname%'";

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

 <link rel="stylesheet" href="css/jquery-ui.css">
 <link rel="stylesheet" href="css/formstyle2.css" type="text/css">
 <script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
 <script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>


 </head>
 <body>
   <div id="header">
   	<h1 id="heading">Patient Reports</h1>
   </div>
 		<form action="" method="post" accept-charset="utf-8" name="form1">
 			<table border="0" id="tablestyle">
        <tr>
          <td><label>Total Number Of diagnosis : </label></td>
          <td><label><?php echo $diagnosiscount;?></label></td>
        </tr>
        <tr>
          <td align="right"><label>Patient Name : </label></td>
          <td align="right"><input type="text" name="patientname" class="longtext" placeholder="Enter Full Name Only"></td>
          <td><input type="submit" class="button" value="Get Info" name="subSearch"></td>
        </tr>
        <?php if($numrowsid > 0) {
  					$counter = 1;
  					echo "<tr><td colspan=3>&nbsp;</td></tr>";
            foreach ($rowsid as $idkey => $idlist) {
  						$custcode = $idlist['ClientId'];
  						$diagid = $idlist['DiagnosisId'];
  						$clientnname = $idlist['ClientName'];
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
  						if(trim($referer == "")) { $referer = "Direct Client"; }
  						if($counter&1){
  							echo"<table border='2' cellspacing='3' cellpadding='8' align='center' width='1100'><br /><br /><tr class='d3'>";
  						}
  						else {
  							echo"<table border='2' cellspacing='3' cellpadding='8' align='center' width='1100'><br /><br /><tr class='d1'>";
  						}
  						echo "
              <th colspan=3>Patient Report</th></tr>
              </tr>
                <td>Patient: </td>
                <td><font size=2 face=Verdana><strong>$patientname</strong></font></td>
              </tr>
            <tr>
              <td>Contact Number: </td>
              <td><font size=2 face=Verdana><strong>$contactnumber</strong></font></td>
            </tr>
            <tr>
              <td>Last Diagnosis Date: </td>
              <td><font size=2 face=Verdana><strong>$diagdate</strong></font></td>
            </tr>
            <tr>
              <td> Doctor: </td>
              <td><font size=2 face=Verdana><strong>$docname</strong></font></td>
            </tr>
            <tr>
              <td colspan=3 align='center'><font size=2 face=Verdana align=center><i><b>Visual Refraction:</b></i></font></td>
            </tr>
            <tr>
              <td>Right Eye </td>
              <td><font size=2 face=Verdana><strong>$vrre</strong></font></td>
            </tr>
            <tr>
            <td> Left Eye:</td>
            <td> <font size=2 face=Verdana><strong>$vrle</strong></font></td>
            </tr>
            <tr>
              <td colspan=3 align='center'><font size=2 face=Verdana align=center><i><b>Objective Refraction:</b></i></font> </td>
            </tr>
            <tr>
              <td>Right Eye </td>
              <td><font size=2 face=Verdana><strong>$orre</strong></font></td>
            </tr>
            <tr>
              <td>Left Eye:</td>
              <td> <font size=2 face=Verdana><strong>$orle</strong></font></td>
            </tr>
            <tr>
              <td colspan=3 align='center'><font size=2 face=Verdana align=center><i><b>Subjective Refraction:</b></i></font> </td>
            </tr>
            <tr>
              <td> Right Eye </td>
              <td><font size=2 face=Verdana><strong>$srre</strong></font></td>
            </tr>
            <tr>
              <td>Left Eye:</td>
              <td> <font size=2 face=Verdana><strong>$srle</strong></font></td>
            </tr>
            <tr>
              <td >CC: </td>
              <td><font size=2 face=Verdana><strong>$cc</strong></font></td>
            </tr>
            <tr>
              <td>Diagnosis: </td>
              <td><font size=2 face=Verdana><strong>$diagnosis</strong></font></td>
            </tr>
            <tr><td height=25 colspan=3> <div class='hr2'><hr /></div></td></tr>
            ";

  						$counter += 1;
  					}  ?>

  			<?php } ?>


 			</table>
 		</form>
 	</div>
 </body>

 </html>

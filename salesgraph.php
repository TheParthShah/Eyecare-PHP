<?php

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Cache-Control: post-check=0, pre-check=0', false);
header("Pragma: no-cache");

	require('config/connect.php');
	db_connect();
	error_reporting(0);

  $diagmonth = ""; 	// this year values
  $patientage = ""; 	// last year values
  $maxAmount2 = 0;


  $qgraphm="SELECT monthname(DiagnosisDate) as ddate, age as age FROM diagnosisdetails";
  $qgraphm_rows = db_select($qgraphm);

  if ($qgraphm_rows === false) {
    $error = db_error();
    $listerror = 1;
  }
  else{
    $ticks2 = array();
    foreach ($qgraphm_rows as $graphmkey => $graphmlist) {
      $graphmonth = $graphmlist['DiagnosisDate'];
      $graphage = $graphmlist['Age'];

      array_push($ticks2, substr($graphmonth,0,3));
      //$premonth = substr($graphmonth,0,3);
      //$diagmonth .= "['".$graphmonth."',".number_format($gmsumpremium, 2, '.', '')."],";
      $diagmonth .= "['".$graphmonth."']";
      //$patientage .= "['".$graphage."',".number_format($gmsumcommission, 2, '.', '')."],";
      $patientage .= "['".$graphage."']";
    }
  }

 ?>


<html>

<head>
<title>Working plots functions</title>


<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery.jqplot.js"></script>

<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/plugins/jqplot.barRenderer.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/plugins/jqplot.pieRenderer.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/plugins/jqplot.categoryAxisRenderer.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/plugins/jqplot.pointLabels.js"></script>

<script language="javascript" type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/excanvas.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
<link rel="stylesheet" href="js/jquery-ui-1.10.4.custom/js/jquery.jqplot.css">



<script type="text/javascript">

$(document).ready(function(){
        $.jqplot.config.enablePlugins = true;
        var s1 = [0.5, 4, 7, 9, 34,26,71,23,67,32,54,44];
        var ticks = ['January','Febuary','March','April','May','June','July','August','September','October','November','December'];
				var yticks = ['0-10','11-20','21-30','31-40','41-50','51-60','61-70','71-80']
        plot1 = $.jqplot('chart1', [s1], {
            // Only animate if we're not using excanvas (not in IE 7 or IE 8)..

				    animate: !$.jqplot.use_excanvas,
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                rendererOptions: {
                  barPadding: 200
                }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks,
                    label:'months'
                },
                yaxis:{
										//renderer: $.jqplot.CategoryAxisRenderer,
										//ticks: yticks,
                    label:'Counts',
										min : 0,
        						tickInterval : 10,
            				max:80
                  }
            },
            highlighter: { show: false }
        });

        $('#chart1').bind('jqplotDataClick',
            function (ev, seriesIndex, pointIndex, data) {
                $('#info1').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );
    });

</script>

</head>

<body>
<table>
<tr>
		<th colspan="4" align="center">
			<label>Client Graph</label>
		</th>
</tr>
<tr>
	<td>
		<div id="chart1" style="height:550px;width:1100px;margin:0 auto;top:20px;"></div>
	</td>
</tr>
</table>
</body>

</html>

<?php

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Cache-Control: post-check=0, pre-check=0', false);
header("Pragma: no-cache");

	require('config/connect.php');
	db_connect();
	error_reporting(0);

$totalpatient = "";
$gender = "";
$disp = "";

$qgraphm="SELECT COUNT(Gender) AS TotalPatients, Gender, DiagYear FROM (
	SELECT '0' AS TotalPatients, Gender, EXTRACT(YEAR FROM DiagnosisDate) AS DiagYear
	FROM eyecareproj.diagnosisdetails
) foo
GROUP BY DiagYear, Gender";

$gqcode = db_select($qgraphm);

if($gqcode === false) {
    $error = db_error();
    $listerror = 1;
}
else {
    $ticks2 = array();
    $mpatients = "[";
    $fpatients = "[";
    foreach ($gqcode as $gkey => $glist) {
        $gtp = $glist["TotalPatients"];
        $ggender = $glist["Gender"];
        $gdisp = $glist["DiagYear"];

        if($ggender == "MALE") {
            array_push($ticks2,$gdisp);
			$mpatients .= $gtp.",";
        }
        else {
			$fpatients .= $gtp.",";
        }
    }
    $mpatients = rtrim($mpatients,',');
    $mpatients .= "]";
    $fpatients = rtrim($fpatients,',');
    $fpatients .= "]";
}
?>
<html>

<head>
<title>Working plots functions</title>

<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery.jqplot.js"></script>

<script type="text/javascript" src="js/plugins/jqplot.barRenderer.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.pieRenderer.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.categoryAxisRenderer.js"></script>
<script type="text/javascript" src="js/plugins/jqplot.pointLabels.js"></script>
<link rel="stylesheet" href="js/jquery.jqplot.css">

<script type="text/javascript">

$(document).ready(function(){
        var s1 = [2, 6, 7, 10];
        var s2 = [7, 5, 3, 2];
       //  var ticks = ['a', 'b', 'c', 'd'];

		var s1 = <?php echo $mpatients ?>;
		var s2 = <?php echo $fpatients ?>;
	    var ticks = <?php echo json_encode($ticks2) ?>;

        plot2 = $.jqplot('chart2', [s1, s2], {
            seriesDefaults: {
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
			series:[
				{label:'Male', color: 'blue'},{label:'Female',color:'brown'}
			],
			legend: {
                show: true,
                location: 'e',
                placement: 'outside'
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
										label: 'Years',
                    ticks: ticks
                }
            }
        });

        $('#chart2').bind('jqplotDataHighlight',
            function (ev, seriesIndex, pointIndex, data) {
                $('#info2').html('series: '+seriesIndex+', point: '+pointIndex+', data: '+data);
            }
        );

        $('#chart2').bind('jqplotDataUnhighlight',
            function (ev) {
                $('#info2').html('Nothing');
            }
        );
    });
</script>

</head>

<body>
<table>
<tr>
		<th colspan="4" align="center">
			<label>Gender-wise Patient's Diagnosis Per Year</label>
		</th>
</tr>
<tr>
	<td>
		<div id="chart2" style="height:550px;width:1100px;margin:0 auto;top:20px;"></div>
	</td>
</tr>
</table>
</body>

</html>

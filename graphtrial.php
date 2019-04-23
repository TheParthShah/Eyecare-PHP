<?php

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Cache-Control: post-check=0, pre-check=0', false);
header("Pragma: no-cache");

	require('config/connect.php');
	db_connect();
	error_reporting(0);


// GRAPH #2 This Year vis-a-vis Last Year Performance.
$typrem = ""; 	// this year values
$lyprem = ""; 	// last year values
$tycomm = "";		// this year commission
$lycomm = "";		// last year commission
$maxAmount2 = 0;

$qgraphm="SELECT SalesMonth, MonthOrder, CONVERT(MonthNo,UNSIGNED INTEGER) AS MonthNo, SumPremium, SumCommission FROM MainGraphData WHERE GraphId = 'graphm' ORDER BY MonthNo, MonthOrder";


$qgraphm_rows = db_select($qgraphm);
//print_r($qgraphm_rows);

if ($qgraphm_rows === false) {
  $error = db_error();
  $listerror = 1;
}
else {
  $ticks2 = array();
  foreach ($qgraphm_rows as $graphmkey => $graphmlist) {
    $gmsalesmonth = $graphmlist["DOB"];
    $gmmonthorder = $graphmlist["MonthOrder"];
    $gmmonthno = $graphmlist["MonthNo"];
    $gmsumpremium = $graphmlist["SumPremium"];
    $gmsumcommission = $graphmlist["SumCommission"];

    if(substr($gmmonthorder,0,4) == $thisyear) {
      array_push($ticks2, substr($gmsalesmonth,0,3));
      $premonth = substr($gmsalesmonth,0,3);
      $typrem .= "['".$gmmonthno."',".number_format($gmsumpremium, 2, '.', '')."],";
      $tycomm .= "['".$gmmonthno."',".number_format($gmsumcommission, 2, '.', '')."],";

    } else {
      $premonth2 = substr($gmsalesmonth,0,3);
      $lyprem .= "['".$gmmonthno."',".number_format($gmsumpremium, 2, '.', '')."],";
      $lycomm .= "['".$gmmonthno."',".number_format($gmsumcommission, 2, '.', '')."],";
    }
    if($gmsumpremium > $maxAmount2) {
      $maxAmount2 = $gmsumpremium;
    }
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
   var typ = [<?php echo $typrem ?>];
  var lyp = [<?php echo $lyprem ?>];
  var tyc = [<?php echo $tycomm ?>];
  var lyc = [<?php echo $lycomm ?>];
  var ticks2 = <?php echo json_encode($ticks2) ?>;
  if (thisMonth > 8) {
    var thisPlacement = "insideGrid";
  } else {
    var thisPlacement = "outsideGrid";
  }

  var plot1b = $.jqplot("chart1b", [typ, lyp, tyc, lyc], {
    // Turns on animatino for all series in this plot.
    animate: true,
    // Will animate plot on calls to plot1.replot({resetAxes:true})
    animateReplot: true,
    cursor: {
      show: true,
      zoom: false,
      looseZoom: true,
      showTooltip: false
    },
    legend: {
      show: true,
      placement: thisPlacement
    },
    series:[
      {
        label: thisYear2 + ' Business',
        pointLabels: {
          show: false
        },
        renderer: $.jqplot.BarRenderer,
        showHighlight: true,
        rendererOptions: {
          animation: {
            speed: 2500
          },
          barPadding: 5,
          barMargin: 10,
          highlightMouseOver: false
        }
      },
      {
        label: lastYear2 + ' Business',
        pointLabels: {
          show: false
        },
        renderer: $.jqplot.BarRenderer,
        showHighlight: true,
        rendererOptions: {
          animation: {
            speed: 2500
          },
          barPadding: 5,
          barMargin: 10,
          highlightMouseOver: false
        }
      },
      {
        label: thisYear2 + ' Commission',
        yaxis: 'y2axis',
        rendererOptions: {
          animation: {
            speed: 2000
          }
        }
      },
      {
        label: lastYear2 + ' Commission',
        yaxis: 'y2axis',
        rendererOptions: {
          animation: {
            speed: 2000
          }
        }
      }
    ],
    seriesColors: [ "#993300", "#FE9A2E", "#0489B1", "#FF4000"],
    axesDefaults: {
      pad: 0,
      tickDistribution: 'even'
    },
    axes: {
      // These options will set up the x axis like a category axis.
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer,
        ticks: ticks2,
        label:"" ,
        tickInterval: 5,
        drawMajorGridlines: false,
        drawMinorGridlines: true,
        drawMajorTickMarks: false,
        rendererOptions: {
        }
      },
      yaxis: {
        tickInterval: tickInt21,
         tickOptions: {
          formatString: "   %0.0f "
        },
        rendererOptions: {
          forceTickAt0: true
        }
      },
      y2axis: {
        tickInterval: tickInt21,
        tickOptions: {
          formatString: "   %0.0f "
        },
        rendererOptions: {
          // align the ticks on the y2 axis with the y axis.
          alignTicks: true,
          forceTickAt0: true
        }
      }
    },
    highlighter: {
      show: true,
      showLabel: true,
      tooltipAxes: 'y',
      sizeAdjust: 7.5 ,
      tooltipLocation : 'ne'
    }
  });
     });
 </script>
</head>


<body>
<table>
 <tr>
   <td colspan="2">
     <div class="group">
     <h3 style="color: white; font-size: 12pt; background:none; background-color: #AD8458;" >&nbsp;&nbsp;&nbsp; Premium Throughput Year-on-Year (To-Date)</h3>
       <div  align="center" id="chart1b" style="width:800px; height:300px"></div>
     </div>
   </td>
 </tr>
</table>
 </body>

 </html>

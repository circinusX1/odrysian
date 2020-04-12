<div id='page' hidden>gpsmco</div>

<?php
$patitle="GPS Status";
$paicon="fa_rocket";
$pafoot="information provided by gpstreader";
include ("_header.php");
?>
<div id="timer" hidden></div>

<table width='100%' border=0>
<tr>
  <td width='33%' valign='top'>
     <div id='left'></div>
  </td>
  <td  width="33%">
     <div id='mid' align='center' valign='top'>
     <canvas id='sky' width='380px' height='300px'>
    </div>
  </td>
  <td width='33%' valign='top'>
     <div id='right'></div>
  </td>
</tr>
<tr><td colspan='3'>
gps drift
<?php
	$drift = @file_get_contents("/tmp/gps_drift");
	if(!empty($drift))
	{
		echo "<p id='arrdata' hidden>{$drift}</p>\n";
		echo "<div style='width:98%;height:150px'>".
			  "<canvas id='chart' height='100%'  background='black'></canvas></div>\n";
	}
?>
</td>
</tr>
</table>

<script src="js/chartjs/Chart.js" type="text/javascript"></script>
<script src="js/chartjs/Chart.min.js" type="text/javascript">

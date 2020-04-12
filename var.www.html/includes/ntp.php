<div id="page" hidden>ntp</div>
<div id="timer" hidden></div>

<?php
$patitle="NTP Status";
$paicon="fa_rocket";
$pafoot="information provided ntp";
include ("_header.php");

?>

<pre style='font: Lucida Console;'>
<?php
    echo shell_exec ("ntpq -p");
	echo "<hr>";
    echo shell_exec("/usr/bin/ntpq -c rv localhost");
?>
</pre>


<?php
include ("_footer.php");
?>

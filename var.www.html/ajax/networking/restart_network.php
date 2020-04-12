<?php
	$ret .= shell_exec("sudo /etc/init.d/networking restart");
	$ret .= shell_exec("sudo systemctl restart wpa_supplicant");
	$ret .= shell_exec("sudo service avahi-daemon stop");

	$ifaces = explode(" ",shell_exec("ls /sys/class/net"));
	foreach($ifaces as $iface){
		$ret .= shell_exec("sudo avahi-autoip --kill {$iface}");
	}
	$ret .= shell_exec("sudo service avahi-daemon start");
	echo $ret;
	file_put_contents("/tmp/_web.err",$ret);
?>

<?php
    session_start();
    include_once('../../includes/config.php');
    include_once('../../includes/functions.php');
    if(isset($_POST['interface'])) {
        $int = $_POST['interface'];
        $cfg = [];
        $file = $int.".ini";
        $ip = $_POST[$int.'-ipaddress'];
        $dns1 = $_POST[$int.'-dnssvr'];

        $cfg['net_mask'] = $_POST[$int.'-netmask'];
        $cfg['interface'] = $int;
        $cfg['routers'] = $_POST[$int.'-gateway'];
        $cfg['ip_address'] = $ip;
        $cfg['domain_name_server'] = $dns1;
        $cfg['static'] = $_POST[$int.'-static'];
        $cfg['dhcp'] = $_POST[$int.'-dhcp'];
        $cfg['ifaceoff'] = $_POST[$int.'-ifaceoff'];
        $cfg['ssid'] = $_POST[$int.'-ssid'];
        $cfg['psk'] = $_POST[$int.'-psk'];

        if(write_php_ini($cfg,RASPI_CONFIG_NETWORKING.'/'.$file)) {
            $jsonData = ['return'=>0,'output'=>['Successfully Updated Network Configuration']];
        } else {
            $jsonData = ['return'=>1,'output'=>['Error saving network configuration to file']];
        }
    } else {
        $jsonData = ['return'=>2,'output'=>'Unable to detect interface'];
    }
    echo json_encode($jsonData);
?>

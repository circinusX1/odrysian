<?php
session_start();
include_once('../../includes/config.php');
include_once('../../includes/functions.php');

if(isset($_GET['interface']))
	$_POST['interface']=$_GET['interface'];

$iface =$_POST['interface'];
$mmask=shell_exec("/sbin/ifconfig {$iface} | awk '/Mask:/{ print $4;}' | awk -F':' '{print $2;}'");
$iip =shell_exec("ifconfig {$iface} | grep 'inet addr' | awk '{print $2}' | awk -F':' '{print $2}'");
$nns = shell_exec("cat /etc/resolv.conf  | grep nameserver | awk '{print $2}'");
$gateway = shell_exec("route -n | grep 'UG[ \t]' | awk '{print $2}'");

if(!empty($iip))
{
    $mmask=str_replace("\n","",$mmask);
    $iip=str_replace("\n","",$iip);
    $iip=str_replace("/","",$iip);
    $nns=str_replace("\n","",$nns);
    $gateway=str_replace("\n","",$gateway);
}
else
{
    $mmask="";
    $iip="";
    $iip="";
    $nns="";
    $gateway="";

}

if(isset($_POST['interface'])){// && isset($_POST['csrf_token']) && CSRFValidate()) {
    $int = preg_replace('/[^a-z0-9]/', '', $_POST['interface']);
    if(!file_exists(RASPI_CONFIG_NETWORKING.'/'.$int.'.ini')) {
        touch(RASPI_CONFIG_NETWORKING.'/'.$int.'.ini');
    }
/*
{"return":1,"output":
{"intConfig":
{"interface":"eth0",
"routers":"192.168.1.1",
"ip_address":"192.168.1.16\/24",
"domain_name_server":"8.8.8.8 8.8.8.8",
"static":"false",
"failover":"false",
"ip_netmask":"255.255.255.0"}}}

*/
    $intConfig = parse_ini_file(RASPI_CONFIG_NETWORKING.'/'.$int.'.ini');
//var_dump($intConfig);

    if(!isset($intConfig['interface']))
	$intConfig['interface']=$int;
    if(!isset($intConfig['ip_address']))
	$intConfig['ip_address']=$iip."/".$mmask;
    if(!isset($intConfig['domain_name_server']))
	$intConfig['domain_name_server']=$nns;
    if(!isset($intConfig['routers']))
	$intConfig['routers']=$gateway;

//var_dump($intConfig);die();

    $jsonData = ['return'=>1,'output'=>['intConfig'=>$intConfig]];
    echo json_encode($jsonData);

    // Todo - get dhcp lease information from `dhcpcd -U eth0` ? maybe ?

} else {
    $jsonData = ['return'=>2,'output'=>['Error getting data']];
    echo json_encode($jsonData);
}


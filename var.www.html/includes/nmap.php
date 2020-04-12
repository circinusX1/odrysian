<div id="page" hidden >nmap</div>
<div id="timer" hidden></div>
<?php
$patitle="Network Status";
$paicon="fa_rocket";
$pafoot="information provided by gpstreader";
include ("_header.php");
?>

<?php
    $gateway = "";
    $mask = "";
    $r = explode("\n",shell_exec("/sbin/route -n"));
    $lines = count($r);

    for($line=0;$line<$lines;)
    {
        $pr = preg_split('/ /', $r[$line], -1, PREG_SPLIT_NO_EMPTY);
//		print_r($pr);
        $idx = array_search("Gateway", $pr);
        $idxm = array_search("Genmask", $pr);
//		echo " [".$idx . "] INDEX = <br>";
        if($idx!=FALSE)
        {
            $line++;
            $pr = preg_split('/ /', $r[$line], -1, PREG_SPLIT_NO_EMPTY);
            $gateway = $pr[$idx];
            $line++;
            $pr = preg_split('/ /', $r[$line], -1, PREG_SPLIT_NO_EMPTY);
            $mask = $pr[$idxm];
            break;
        }
        $line++;
    }
    if(strstr($gateway,"."))
    {
		echo $gateway."/ ";
		echo $mask . " / LAN:" ;
        $machineip = machineip($gateway);
        $ip_parts =  explode(".", $machineip);
        $mask_parts =  explode(".", $mask);
        $gtp =  explode(".", $gateway);
        //print_r($gtp);
        $lan =  $gtp[0]. "." . $gtp[1] . "." . $gtp[2] . ".1/24";
		echo $lan;
        $ret = explode("\n", shell_exec("sudo /usr/bin/nmap -sn ".$lan));

        echo "<table width='100%' border='0' style='padding-left:10px;'>";
		echo "<tr><th>NAME</th><th>STAT</th><th>HTTP</th><th>80</th><td> </td></tr>";
        echo "<tr><th width='40%'>Local IP</th><td>".$machineip.
				"</td><td><a href='http://" . $machineip . "'>" . $machineip . "</a></td></tr>";
        echo "<tr><th width='30%'>Gateway</th><td>".$gateway."</td><td>-</td><td> </td></tr>";
        echo "<tr><th width='30%'>Mask</th><td>".$mask."</td><td>-</td><td> </td></tr>";
		$hip = "";
        foreach($ret as $r)
        {
            if(strstr($r,"Starting"))
                continue;
            if(strstr($r,"addresses"))
                continue;
            if(strstr($r,"Nmap")!=FALSE)
            {
		echo "<tr>";
                $r=str_replace("Nmap scan report for ","" ,$r);
                echo "<th> ".$r."</th>";
		$hip=$r;
            }
            else if(strstr($r,"Host")!=FALSE)
            {
					$err="";
					$errs="";
                echo "<td> ".$r."</td>";

					$hip = str_replace("("," ",$hip);
					$hip = str_replace(")"," ",$hip);

					$hipa = explode(" ",$hip);
					$cnt = count($hipa)-1;
					while($cnt>=0){
						$hipok = $hipa[$cnt];
						if(strstr($hipok,"."))break;
						$cnt--;
					}

					echo "<td><a target='_blank' href='http://" . $hipok . "'>" . $hipok . "</a></td>";
					$connection = @fsockopen($hipok, 80,$err,$errs,2);
					if (is_resource($connection)){
						echo "<td><b id='${hipok}'>OPEN</b></td>";
					}else{
						echo "<td>.</td>";
					}

				echo "</tr>";
            }

        }
        echo "</table>";

    }


function machineip($gate)
{
    $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    $res = socket_connect($sock, $gate, 53);
    socket_getsockname($sock, $addr);
    socket_shutdown($sock);
    socket_close($sock);
    return $addr;
}
include ("_footer.php");

?>


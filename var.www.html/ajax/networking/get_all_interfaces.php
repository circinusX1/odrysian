<?php
    exec("ls /sys/class/net | grep -v -w lo", $interfaces);
    echo json_encode($interfaces);
?>

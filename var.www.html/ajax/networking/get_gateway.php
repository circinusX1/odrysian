<?php
echo shell_exec("route -n | grep 'UG[ \t]' | awk '{print $2}'");
?>

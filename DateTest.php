<?php
//Date test function
$Date = date('Y-m-d H:i:s');
echo ('Y-m-d H:i:s', $Date);
$Date = date('Y-m-d H:i:s', strtotime("+1 days"));
echo ('Y-m-d H:i:s', $Date);

?>
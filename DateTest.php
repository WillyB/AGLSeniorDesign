<?php
//Date test function
$Date = date('Y-m-d H:i:s');
echo date('Y-m-d H:i:s', $Date);
$Date = date('Y-m-d H:i:s', strtotime("+1 days"));
echo "<br/>";
echo date('Y-m-d H:i:s', $Date);
echo "<br/>";
$thisDate = date('Y-m-d H:i:s', time());
echo date('Y-m-d H:i:s', $thisDate);
echo "<br/>";
$nextDate = date();
echo date("Y-m-d H:i:s");
?>
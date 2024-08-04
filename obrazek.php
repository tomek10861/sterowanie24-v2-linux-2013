<?php
date_default_timezone_set('Europe/Warsaw');
echo 'Czas lokalny ';
echo date('H:i:s');
echo '<br>';
$time1 = mktime(0, 0, 0, 12, 24, 2013);
$time2 = time();
$time = $time1 - $time2;
if ($time < 0)
{
echo 'Sterowanie działa tylko w nocy (godz. 16 - 4) ';
}
else
{
echo 'Sterowanie zostanie uruchomione za <b>'.ceil($time / 86400);
if ($time == 1) echo '</b> dzień';
else echo '</b> dni';
}
?>


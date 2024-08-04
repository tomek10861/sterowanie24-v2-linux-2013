<?php
$err=array();
if (exec("sudo /var/www/ster/lpt getsbit 3")=='1')
{ 
echo "<span style='color:red'><center><b>UWAGA!<br>Brak wody w obiegu pompy</b></center></span></td>";
$err='1';
}

echo '</td></tr><tr><td>';


if($err=='1')
{
echo '<img src="obrazy/err.png"></img>';
}else{
echo '<img src="obrazy/ok.png"></img>';
}
?>
<?php
//Plik blokady odczytywany jako string
$lock = file_get_contents("lock.txt");
if(date('H')>4 and date('H')<16)
{
$fp = fopen("lock.txt", "w");
// zapisanie danych
fputs($fp, '10'.$lock[2]);
// zamknięcie pliku
fclose($fp); 
exec("sudo /var/www/lpt set 0");
}else{
$fp = fopen("lock.txt", "w");
// zapisanie danych
fputs($fp, '00'.$lock[2]);
// zamknięcie pliku
fclose($fp); 
}

if($lock[0]=='1' or $lock[2]=='1') //jeśli lock 0 lub lock 1 jest równy 1
{
//ustalanie jaki mają mieć stan bity lpt
if($lock[1]=='0')
{
exec("sudo /var/www/lpt set 0");
}else{
if($lock[1]=='1')
{
exec("sudo /var/www/lpt set 255");
}
}
}
?>
<?php
/*//skrypt zajmujący się automatyką sterowania pampą

date_default_timezone_set('Europe/Warsaw');

//deklarowanie zmiennych
$time=array();
$error=array();
$bit1=array();
$bit2=array();
$fp=array();
$ustaw_bit=array();
//sprawdzanie stanu $bit
$bit1=exec("sudo /var/www/ster/lpt getsbit 3");
$bit2=exec("sudo /var/www/ster/lpt getbit 0");

//godziny pracy
if(date('H')>='0' and date('H')<='24')
{
$time = true;
}else{
$time = false;
}

//błedy
if($bit1=='0')
{
$error = false;
}else{
$error = true;
}


//czas pracy
$fp = implode('', file('czas.txt'));
$min = $fp;
$obliczenie= date('i')-$min;
if($obliczenie>=4 or $obliczenie<0)
{
$ustaw_bit=true;
}else{
$ustaw_bit=false;
}

echo 'Time: '.$time.'<br>';
echo 'Error: '.$error.'<br>';
echo 'Ustaw bit: '.$ustaw_bit.'<br>';
echo 'Stan: '.$bit2.'<br>';
echo 'Min: '.$min.'<br>';
echo 'Obliczenie: '.$obliczenie;
//----------------STEROWANIE----------------
if($time==true)
{
if($error!=true)
{
if($ustaw_bit==true)
{
if($bit2=='0')
{
exec("sudo /var/www/ster/lpt setbit 0");
// otwarcie pliku do zapisu
$fp = fopen("czas.txt", "w");
// zapisanie danych
fputs($fp, date('i'));
// zamknięcie pliku
fclose($fp);
}else{
exec("sudo /var/www/ster/lpt clrbit 0");
// otwarcie pliku do zapisu
$fp = fopen("czas.txt", "w");
// zapisanie danych
fputs($fp, date('i'));
// zamknięcie pliku
fclose($fp);
}
}
}else{
exec("sudo /var/www/ster/lpt clrbit 0");
}
}else{
exec("sudo /var/www/ster/lpt clrbit 0");
}


//------------------------------------------
*/
?>
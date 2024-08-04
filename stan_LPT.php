<?php
//Skrypt sprawdzający stan lini danych
		//UWAGA!//
//Skrypt dla większej ilość klientów
for( $x = 0; $x <= 7; $x++ )
{
if (exec("sudo /var/www/lpt getbit $x")=='1')
{ 
$stan[$x]='ON';
$color[$x]='green';
}else{
$stan[$x]='OFF';
$color[$x]='red';
}
}
//zapis stanu bitu
$fp = fopen("stan.txt", "w");
for( $x = 0; $x <= 7; $x++ )
{ 
// zapisanie danych
fputs($fp, $stan[$x].';');
}
// zamknięcie pliku
fclose($fp); 

//zapis koloru
$fp = fopen("color.txt", "w");
for( $x = 0; $x <= 7; $x++ )
{ 
// zapisanie danych
fputs($fp, $color[$x].';');
}
// zamknięcie pliku
fclose($fp); 

//KONIEC/
//-------------------------------------------------------
//Skrypt sprawdzający stan lini statusowych
for( $x = 3; $x <= 7; $x++ )
{
$stan[$x]=exec("sudo /var/www/lpt getsbit $x");
}
//zapis stanu bitu
$fp = fopen("rejestr_statusowy.txt", "w");
for( $x = 3; $x <= 7; $x++ )
{ 
// zapisanie danych
fputs($fp, $stan[$x].';');
}
// zamknięcie pliku
fclose($fp); 
?>

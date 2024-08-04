<?php
$answer = array();
$file = array();
$fp = array();
$name = array();
$stan = array();
$d = array();
$s = array();
$p = array();
if (isset($_GET['d']))
{
$d=$_GET['d'];
}
if (isset($_GET['s']))
{
$s=$_GET['s'];
}
if (isset($_GET['p']))
{
$p=$_GET['p'];
}
//Plik z nazwami kanałów
$name = file("name.txt");
for ($i=0; $i<count($name); $i++)
{
} 
//Odczytywanie plików ze stanem lpt
	$fp = fopen("stan.txt", "r");
$bit = fread($fp, 300);
$stan= explode(";", $bit);
				fclose($fp);
$fp = fopen("color.txt", "r");
$bit = fread($fp, 300);
$color= explode(";", $bit);
				fclose($fp);
		
//Plik blokadyvodczytywany jako string
$lock = file_get_contents("lock.txt");
//Sprawdzanie czy nie nałożono blokady na sterowanie
if($lock[0]=='1' or $lock[2]=='1')
{
$disabled='disabled'; //wyłącznie przycisków
echo '<b>Panel zablokowany przez administratora.</b><br>';
}else{
//Zerowanie	
	if($d=="10")
	{
	exec("sudo /var/www/lpt set 0");
	$color= explode(";", "red;red;red;red;red;red;red;red;");
	$stan= explode(";", "OFF;OFF;OFF;OFF;OFF;OFF;OFF;OFF;");
	}else{
if($d=="11")
	{

	exec("sudo /var/www/lpt set 255");
	$color= explode(";", "green;green;green;green;green;green;green;green;");
	$stan= explode(";", "ON;ON;ON;ON;ON;ON;ON;ON;");
	}
}

//Skrypt zapisujący stany do ltp
	  if ($d=='0' or $d=='1' or $d=='2' or $d=='3' or $d=='4' or $d=='5' or $d=='6' or $d=='7')
	  {
	exec("sudo /var/www/lpt setbit $d");
	$color[$d]= 'green';
	$stan[$d]= 'ON';
		}
//Skrypt kasujacy stany do ltp
	  if ($s=='0' or $s=='1' or $s=='2' or $s=='3' or $s=='4' or $s=='5' or $s=='6' or $s=='7')
	  {
	exec("sudo /var/www/lpt clrbit $s");
	$color[$s]= 'red';
	$stan[$s]= 'OFF';	
		}
$disabled=''; //włącznie przycisków
}

//Skrypt dający chwilowy stan wysoki na bity kontrolne
	  if ($p=='0' or $p=='1' or $p=='2' or $p=='3')
	  {
	exec("sudo /var/www/lpt clrcbit $p");
	exec("sudo /var/www/lpt setcbit $p");
	sleep (1);
	exec("sudo /var/www/lpt clrcbit $p");
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


//Stan bitów statusowych
	$fp = fopen("rejestr_statusowy.txt", "r");
$bit = fread($fp, 20);
$rejestr_statusowy= explode(";", $bit);
				fclose($fp);
//Jeśli "bit 3" != 0 karta LPT odłączona
if($rejestr_statusowy[0]!='0')
{
echo '<span span style="color:orange"><b>Karta LPT odłączona.</b></span></br><hr>';
}else{
//Jeśli "bit 7" == 0 karta panel zablokowany za pomocą przycisku
$fp = fopen("lock.txt", "w");
if($rejestr_statusowy[4]=='0')
{
// zapisanie danych
fputs($fp, '011');
echo '<span span style="color:blue"><b>Panel zablokowany przyciskiem lokalnym</b></span></br><hr>';
}else{
// zapisanie danych
fputs($fp, $lock[0].$lock[1].'0');
}
// zamknięcie pliku
fclose($fp); 
}

echo "<table>";
echo "<tr><td>".$name[0].': </td><td><span style="color:'.$color[0].'">'.$stan[0].'</span><button type="submit" '.$disabled.' onclick="wlacz(0);">Włącz</button> <button type="submit" '.$disabled.' onclick="wylacz(0);">Wyłącz</button> </td><td><button type="submit" onclick="prog(2);">Klik!</button></td></tr>' ;
echo "<tr><td>".$name[1].': </td><td><span style="color:'.$color[1].'">'.$stan[1].'</span><button type="submit" '.$disabled.' onclick="wlacz(1);">Włącz</button> <button type="submit" '.$disabled.' onclick="wylacz(1);">Wyłącz</button> </td><td></td></tr>' ;
echo "<tr><td>".$name[2].': </td><td><span style="color:'.$color[2].'">'.$stan[2].'</span><button type="submit" '.$disabled.' onclick="wlacz(2);">Włącz</button> <button type="submit" '.$disabled.' onclick="wylacz(2);">Wyłącz</button> </td><td></td></tr>' ;
echo "<tr><td>".$name[3].': </td><td><span style="color:'.$color[3].'">'.$stan[3].'</span><button type="submit" '.$disabled.' onclick="wlacz(3);">Włącz</button> <button type="submit" '.$disabled.' onclick="wylacz(3);">Wyłącz</button> </td><td></td></tr>' ;
echo "<tr><td>".$name[4].': </td><td><span style="color:'.$color[4].'">'.$stan[4].'</span><button type="submit" '.$disabled.' onclick="wlacz(4);">Włącz</button> <button type="submit" '.$disabled.' onclick="wylacz(4);">Wyłącz</button> </td><td></td></tr>' ;
echo "<tr><td>".$name[5].': </td><td><span style="color:'.$color[5].'">'.$stan[5].'</span><button type="submit" '.$disabled.' onclick="wlacz(5);">Włącz</button> <button type="submit" '.$disabled.' onclick="wylacz(5);">Wyłącz</button> </td><td></td></tr>' ;
echo "<tr><td>".$name[6].': </td><td><span style="color:'.$color[6].'">'.$stan[6].'</span><button type="submit" '.$disabled.' onclick="wlacz(6);">Włącz</button> <button type="submit" '.$disabled.' onclick="wylacz(6);">Wyłącz</button> </td><td></td></tr>' ;
echo "<tr><td>".$name[7].': </td><td><span style="color:'.$color[7].'">'.$stan[7].'</span><button type="submit" '.$disabled.' onclick="wlacz(7);">Włącz</button> <button type="submit" '.$disabled.' onclick="wylacz(7);">Wyłącz</button> </td><td></td></tr>' ;                    
echo "<table>";
echo '<button type="submit" '.$disabled.' onclick="wlacz(11);">Włącz wszystkie</button><button type="submit" '.$disabled.' onclick="wlacz(10);">Wyłącz wszystkie</button><br>'; 
echo '<br><center><small>Obraz z kamery internetowej ma przesunięcie<br>nawet do 20s względem rzeczywistości</small></center>';

?>
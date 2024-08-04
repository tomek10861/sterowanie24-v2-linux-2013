<?php
$answer = array();
$file = array();
$fp = array();
$name = array();
$stan = array();
$d = array();
$s = array();
if (isset($_GET['d']))
{
$d=$_GET['d'];
}
if (isset($_GET['s']))
{
$s=$_GET['s'];
}
//Plik z nazwami kanałów
$name = file("name.txt");
for ($i=0; $i<count($name); $i++)
{
} 

//Zerowanie	
	if($d=="10")
	{
exec("sudo /var/www/ster/lpt set 0");
}
//Skrypt zapisujący stany do ltp
	  if ($d=='0' or $d=='1' or $d=='2' or $d=='3' or $d=='4' or $d=='5' or $d=='6' or $d=='7')
	  {
	exec("sudo /var/www/ster/lpt setbit $d");
		}
//Skrypt kasujacy stany do ltp
	  if ($s=='0' or $s=='1' or $s=='2' or $s=='3' or $s=='4' or $s=='5' or $s=='6' or $s=='7')
	  {
	exec("sudo /var/www/ster/lpt clrbit $s");
		}

		//UWAGA!//
//Skrypt wymaga modyfikacji dla większej ilość klientów
for( $x = 0; $x <= 7; $x++ )
{
if (exec("sudo /var/www/ster/lpt getbit $x")=='1')
{ 
$stan[$x]='ON';
$color[$x]='green';
}else{
$stan[$x]='OFF';
$color[$x]='red';
}
}
//KONIEC

echo "<table>";
echo "<tr><td>".$name[0].': </td><td><span style="color:'.$color[0].'">'.$stan[0].'</span><button type="submit" onclick="wlacz(0);">Wlacz</button> <button type="submit" onclick="wylacz(0);">Wylacz</button> </td></tr>' ;
echo "<tr><td>".$name[1].': </td><td><span style="color:'.$color[1].'">'.$stan[1].'</span><button type="submit" onclick="wlacz(1);">Wlacz</button> <button type="submit" onclick="wylacz(1);">Wylacz</button> </td></tr>' ;
echo "<tr><td>".$name[2].': </td><td><span style="color:'.$color[2].'">'.$stan[2].'</span><button type="submit" onclick="wlacz(2);">Wlacz</button> <button type="submit" onclick="wylacz(2);">Wylacz</button> </td></tr>' ;
echo "<tr><td>".$name[3].': </td><td><span style="color:'.$color[3].'">'.$stan[3].'</span><button type="submit" onclick="wlacz(3);">Wlacz</button> <button type="submit" onclick="wylacz(3);">Wylacz</button> </td></tr>' ;
echo "<tr><td>".$name[4].': </td><td><span style="color:'.$color[4].'">'.$stan[4].'</span><button type="submit" onclick="wlacz(4);">Wlacz</button> <button type="submit" onclick="wylacz(4);">Wylacz</button> </td></tr>' ;
echo "<tr><td>".$name[5].': </td><td><span style="color:'.$color[5].'">'.$stan[5].'</span><button type="submit" onclick="wlacz(5);">Wlacz</button> <button type="submit" onclick="wylacz(5);">Wylacz</button> </td></tr>' ;
echo "<tr><td>".$name[6].': </td><td><span style="color:'.$color[6].'">'.$stan[6].'</span><button type="submit" onclick="wlacz(6);">Wlacz</button> <button type="submit" onclick="wylacz(6);">Wylacz</button> </td></tr>' ;
echo "<tr><td>".$name[7].': </td><td><span style="color:'.$color[7].'">'.$stan[7].'</span><button type="submit" onclick="wlacz(7);">Wlacz</button> <button type="submit" onclick="wylacz(7);">Wylacz</button> </td></tr>' ;                    
echo "<table>";
echo '<button type="submit" onclick="wlacz(10);">Wyzeruj</button> <br>' ; 

//echo '</td><td><table><tr><td></td><td><button type="submit" onclick="podajDane(0);">'.$opcja7.'</button></td><td></td></tr><tr><td><button type="submit"  onclick="podajDane(2);">'.$opcja5.'</button></td><td></td><td><button type="submit"  onclick="podajDane(3);">'.$opcja4.'</button></td></tr><tr><td></td><td><button type="submit"  onclick="podajDane(1);">'.$opcja6.'</button></td><td></td></tr></Table>';
//echo '</td></tr></table>';
// zamknięcie pliku
//echo $stan;
 

         ?>
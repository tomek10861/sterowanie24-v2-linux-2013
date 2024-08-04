<form action="?" method="get">
	<textarea name="uwagi" cols="50" rows="5">Twoje uwagi...</textarea>
	<input type="submit" value="Wyœlij uwagi" />
</form>
<?php
//zapis koloru
$fp = fopen("ster/uwaga.txt", "rw");
fputs($fp, 'IP:'.$_SERVER['REMOTE_ADDR'].' Czas: '.date('c').'Uwaga: '.$_GET['uwagi']);
// zamkniêcie pliku
fclose($fp); 	
?>
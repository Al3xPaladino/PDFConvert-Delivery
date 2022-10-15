<?php
if(isset($_GET['EAN'])){
	$EANR = strtoupper($_GET['EAN']);//codice da cercare

	// Ottieni il contenuto del file json
	$fileR = "files/Read_".$_SESSION['CodUser'].".json";
	$strJsonFileContentsR = file_get_contents($fileR);

	$arrayRead = json_decode($strJsonFileContentsR, true);//Conversione json in array

	$flagR = true;//flag se continuare a cercare

	for($i=0; $i<@count($arrayRead)&&$flagR; $i++) if($arrayRead[$i]==$EANR) $flagR=false;//controllo se esiste già EAN nel file Read_xxx.json

	$letti = @count($arrayRead);
	/*resto del codice in search.php*/

}else{
	$_SESSION['erro'] = "[ERRORE] Nessun codice da cercare.";
	header("Location: cerca.php");
	die;
}
<?php
if(isset($_GET['EAN'])){
	$EAN = strtoupper($_GET['EAN']);//codice da cercare
	//variabili per salvare risultato
	$ResultEAN = "";
	$ResultVia = "";
	$ResultRiga = "";
	$ResultCAP = "";
	$ResultLocalita = "";
	$ResultContrassegno = "";
	$dimensione = 0;
	$vuoto = 0;
	$flag = true;//flag se continuare a cercare

	// Ottieni il contenuto del file JSON
	$file = "files/".$_SESSION['CodUser'].".json";
	$strJsonFileContents = file_get_contents($file);
	
	$array = json_decode($strJsonFileContents, true);//Conversione json in array

	$dimensione = count($array);//totale dati nel json

	//ricerca ean nell'array
	for($i=0; $i<count($array)&&$flag; $i++){
		if($array[$i]["ean"]==$EAN){
			$ResultEAN = $array[$i]["ean"];
			$ResultVia = $array[$i]["VIA"];
			$ResultRiga = $array[$i]["RIGA"];
			$ResultCAP = $array[$i]["CAP"];
			$ResultLocalita = $array[$i]["LOCALITA"];
			$ResultContrassegno = $array[$i]["contrassegno"];
			$flag = false;
			/*CODICE DI existSearch.php*/
			if($flagR){
				$posR = @count($arrayRead);//prendo ultima posizione array
				$arrayRead[$posR] = $EANR;//inserisco EAN
				$myJSONR = json_encode($arrayRead);//codifico in json
				$read = fopen($fileR, "w");//apro il file in scrittura
				fwrite($read, $myJSONR);//sovrascrivo nuovi dati
				fclose($read);
			}

			$letti = @count($arrayRead);//elementi nel file / EAN già letti
			/*CODICE DI existSearch.php*/
		}
	}
	//controllo se non trovato
	if($ResultEAN==""&&$flag){
		$vuoto = 1;
		/*$_SESSION['erro'] = "[RISULTATO RICERCA] Nessuna corrispondenza trovata.";
		header("Location: cerca.php");
	  	die;*/
	}else if($ResultEAN!=""&&!$flag&&($ResultVia==""||$ResultLocalita==""||$ResultCAP==""||$ResultContrassegno=="")){
		$vuoto = 2;
	}

}else{
	$_SESSION['erro'] = "[ERRORE] Nessun codice da cercare.";
	header("Location: cerca.php");
	die;
}
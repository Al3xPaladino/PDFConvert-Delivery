<?php
session_start();
include 'secure/existFile.php';
if(isset($_POST['mode'])&&isset($_POST['ean'])&&isset($_POST['via'])&&isset($_POST['riga'])&&isset($_POST['cap'])&&isset($_POST['localita'])&&isset($_POST['contrassegno'])){
	$mode = $_POST['mode'];//modalità di ricerca
	$EAN  = $_POST['ean']; //codice da cercare
	
	//variabili da aggiornare
	$via = $_POST['via'];
	$riga = $_POST['riga'];
	$cap = $_POST['cap'];
	$localita = $_POST['localita'];
	$contrassegno = $_POST['contrassegno'];
	$flag = true;//flag se continuare a cercare

	// Ottieni il contenuto del file JSON
	$file = "files/".$_SESSION['CodUser'].".json";
	$strJsonFileContents = file_get_contents($file);
	// Conversione in array
	$array = json_decode($strJsonFileContents, true);
	//ricerca ean nell'array
	for($i=0; $i<count($array)&&$flag; $i++){
		if($array[$i]["ean"]==$EAN){
			if($mode==2){
				$array[$i]["VIA"] = $via;
				$array[$i]["RIGA"] = $riga;
				$array[$i]["CAP"] = $cap;
				$array[$i]["LOCALITA"] = $localita;
				$array[$i]["contrassegno"] = $contrassegno;
			}
			$flag = false;
		}
	}

	//controllo se EAN non trovato
	if($flag){
		if($mode==1){
			$pos = count($array);
			$array[$pos]["ean"] = $EAN;
			$array[$pos]["VIA"] = $via;
			$array[$pos]["RIGA"] = $riga;
			$array[$pos]["CAP"] = $cap;
			$array[$pos]["LOCALITA"] = $localita;
			$array[$pos]["contrassegno"] = $contrassegno;
			$myJSON = json_encode($array);
			$file = fopen($file, "w");
			fwrite($file, $myJSON);
			fclose($file);
			$_SESSION['erro'] = "[AGGIORNAMENTO] EAN aggiunto con successo.";
			header("Location: result.php?EAN=".$EAN."");
	  		die;
		}else if($mode==2){
			$_SESSION['erro'] = "[ERRORE] Nessuna corrispondenza da aggiornare.";
			header("Location: cerca.php");
	  		die;
		}
	}else{//EAN trovato
		if($mode==1){
			$_SESSION['erro'] = "[ERRORE] EAN già esistente.";
			header("Location: result.php?EAN=".$EAN."");
	  		die;
		}else if($mode==2){
			$myJSON = json_encode($array);
			$file = fopen($file, "w");
			fwrite($file, $myJSON);
			fclose($file);
			$_SESSION['erro'] = "[AGGIORNAMENTO] Dati aggiornati con successo.";
			header("Location: result.php?EAN=".$EAN."");
	  		die;
		}
	}

}else{
	$_SESSION['erro'] = "[ERRORE] Dati inesistenti.";
	header("Location: cerca.php");
	die;
}
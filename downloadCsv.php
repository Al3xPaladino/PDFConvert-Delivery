<?php
require 'librerie/jsonToCsv.php';

$fileRead = "files/Read_".$_SESSION["CodUser"].".json";
$fileJSon = "files/".$_SESSION["CodUser"].".json";

if (!file_exists($fileRead)||!file_exists($fileJSon)) {
	$_SESSION['erro'] = "[ERRORE] Nessun PDF esistente per questo utente.";
	header("Location: home.php");
  	die;
}

// Ottieni il contenuto del file JSON
$strJsonFileContents = file_get_contents($fileJSon);
// Conversione in array
$array = json_decode($strJsonFileContents, true);

//esegui download
jsonToCsv($array, false, true);
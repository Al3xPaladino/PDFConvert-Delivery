<?php
if (!isset($_SESSION["username"])||!isset($_SESSION["CodUser"])) {
  $_SESSION['erro'] = "[ERRORE] Nessun utente.";
  header("Location: index.php");
  die;
}else{
	$filePDF = "files/Read_".$_SESSION["CodUser"].".json";
	$fileJSon = "files/".$_SESSION["CodUser"].".json";
	if (!file_exists($filePDF)||!file_exists($fileJSon)) {
		$_SESSION['erro'] = "[ERRORE] Nessun PDF esistente per questo utente.";
		header("Location: home.php");
	  	die;
	}
}
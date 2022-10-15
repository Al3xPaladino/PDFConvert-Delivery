<?php
include "librerie/vendor/autoload.php";

$fullfile = $newName;                                                 	// directory / codUser / pdf
$content = '';
$out = '';
$parser = new \Smalot\PdfParser\Parser();                             	// libreria

$document = $parser->parseFile($fullfile);                            	// apro il file pdf
$pages    = $document->getPages();                                    	// conto il numero di pagine
$tempArray = array();
$flag = true;
$cont=0;

for($i=0; $i<count($pages)&&$flag; $i++){                             	// FOR per tutte le pagine
	$page     = $pages[$i];                                           
	$content  = $page->getText();								      	// prendo il contenuto della pagina numero I
	$righe = explode("\n", $content); 								  	// divido per \n (INVIO)
	for($j=0; $j<count($righe)&&$flag; $j++){						  	// FOR per tutte le righe della pagina
		$temp = explode("	", $righe[$j]);							  	// divido le righe per "	" (SPAZIO LUNGO)
		$temp[0] = str_replace(' ', '', $temp[0]);					  	// elimino gli spazi vuoti
		if(count($temp)>=5){									  		// Se la prima parola contiene dei numeri allora...
			@$myObj[$cont]->ean = $temp[0];							  	// inserisco nell'array->ean
			if($temp[1]=="RACC"){
				@$myObj[$cont]->VIA = trim(substr($temp[3], 5));	 	// prendo solo dal 5° carattere in poi e elimino gli spazi finali
				@$myObj[$cont]->RIGA = $temp[4];
				@$myObj[$cont]->CAP = substr($temp[3], 0, 5);		  	// prendo solo le prime 5 cifre
				@$myObj[$cont]->LOCALITA = $temp[2];
			}else if($temp[1]==""&&$temp[3]==""){					  	// se alcuni campi sono vuoi...
				@$myObj[$cont]->VIA = "";
				@$myObj[$cont]->RIGA = $temp[2];
				@$myObj[$cont]->CAP = "";	
				@$myObj[$cont]->LOCALITA = "";
			}else{
				@$myObj[$cont]->VIA = trim(substr($temp[2], 5));	  	// prendo solo dal 5° carattere in poi e elimino gli spazi finali
				@$myObj[$cont]->RIGA = $temp[3];
				@$myObj[$cont]->CAP = substr($temp[2], 0, 5);		  	// prendo solo le prime 5 cifre
				@$myObj[$cont]->LOCALITA = $temp[1];
			}
			@$myObj[$cont]->contrassegno = "";						  	// lascio il contrassegno vuoto
			//echo print_r($temp)." CONT: {".$cont."}<br>";
			$cont++;
			//array_push($tempArray, $righe[$j]);
		}
		if($temp[0]=="RIEPILOGOCONSEGNE") $flag=false;					// quando arrivo al "RIEPILOGOCONSEGNE", finisco la ricerca
	}
		
}
$newJson = "files/".$_SESSION['CodUser'].".json";					  	//nome file json
$myJSON = json_encode($myObj);											//codifico l'array in json
if($file = fopen($newJson, "w")){									  	//creo file json e controllo che viene creato
	fwrite($file, $myJSON);											  	//inserisco i dati all'interno
	fclose($file);

	$newTxt = "files/Read_".$_SESSION['CodUser'].".json";				//nome File per controllo di ean letti
	$fileT = fopen($newTxt, "w");										//creo file
	fwrite($fileT, "");													//lo inizializzo a vuoto
	fclose($fileT);

	$delPDF = "files/".$_SESSION['CodUser'].".pdf";						//nome File pdf da eliminare
	unlink($delPDF);													//elimino file
	$_SESSION['erro'] = "Il File è stato caricato";
}else{
	$_SESSION['erro'] = "[ERRORE] File non caricato.";
}

//print_r($tempArray);
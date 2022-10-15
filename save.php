<?php
session_start();
$target_dir = "files/";                                               // directory
$target_file = $target_dir . basename($_FILES["FilePDF"]["name"]);    // directory + nome file
$uploadOk = 1;                                                        // flag di controllo upload
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));    // estensione file
$newName = $target_dir.$_SESSION["CodUser"].".".$fileType;            // NewName = directory + codUser + estensione file

// Check if file already exists
if (file_exists($newName)&&($_POST['saveF']==0)) {
  $_SESSION['erro'] = "[ERRORE] File già esistente.";
  $uploadOk = 0;
}

// Check file size (max 10MB==10000000B)
if ($_FILES["FilePDF"]["size"] > 10000000) {
  $_SESSION['erro'] = "[ERRORE] Dimensione file elevata.";
  $uploadOk = 0;
}

// Allow certain file formats
if($fileType != "pdf" ) {
  $_SESSION['erro'] = "[ERRORE] Il file caricato non è un PDF.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 1&&($_POST['saveF']==1)) {
  if (move_uploaded_file($_FILES["FilePDF"]["tmp_name"], $newName)) { //upload pdf con nuovo nome
    $_SESSION['erro'] = "Il File è stato caricato";
    include 'creaJson.php';
  }else{                                                              //se avviene un errore nell'upload del pdf
    $_SESSION['erro'] = "[ERRORE] File non caricato.";
  }
}
header("Location: home.php");
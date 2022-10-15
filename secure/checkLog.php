<?php if (!isset($_SESSION['username'])||!isset($_SESSION['CodUser'])) {//controllo accesso utente
  $_SESSION['erro'] = "[ERRORE] Nessun utente.";
  header("Location: index.php");
  die;
}
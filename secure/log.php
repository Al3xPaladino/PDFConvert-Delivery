<?php if (isset($_SESSION['username'])&&isset($_SESSION['CodUser'])) {//se già loggato
  header("Location: home.php");//torna alla home
  die;
}
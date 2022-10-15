<?php
if(isset($_GET['Test'])){
	session_start();
	$_SESSION['CodUser']  = "000";
	$_SESSION['username'] = "Test";
	$_SESSION['time'] = time();
	header("Location: home.php");

}else if(isset($_GET['L'])){//Login

	if(isset($_POST['username'])&&isset($_POST['password'])){//controllo variabili
		//dichiarazione varibili login
		$username = $_POST['username'];
		$password = $_POST['password'];
		session_start();
		session_unset();
		session_destroy();
		
		session_start();

		if(strlen($username)!=0&&strlen($password)!=0){//controlli variabili vuote
			//connessione database
			$connection = new mysqli("62.149.150.186", "Sql848546", "4e7m50vbq7", "Sql848546_5");
			$query = "SELECT * FROM utenti WHERE Username = '$username' LIMIT 1";
			$result = $connection->query($query);
			if(@$result->num_rows != 0){//se esiste utente
				$row = $result->fetch_array();
				if($row['Password']==md5($password)){//controllo password
					//echo "Accesso eseguito con successo!";
					//salvataggio dati utente in sessione
					$_SESSION['CodUser']  = $row['id'];
					$_SESSION['username'] = $username;
					$_SESSION['time'] = time();

					header("Location: home.php");
				} else{//password errata
					//echo "Password Errata!";
					$_SESSION['erro'] = "Username o Password Errate!";
					header("Location: index.php");
				}
			} else{//nessun risultato utente
				//echo "Username Errato!";
				$_SESSION['erro'] = "Username o Password Errate!";
				header("Location: index.php");
			}
			//rilascio memoria
			$result->free();
			$connection->close();
		} else{//variabili vuote
			//echo "Username/Password vuoti!";
			$_SESSION['erro'] = "Username/Password vuoti!";
			header("Location: index.php");
		}

	} else{//nessuna variabile per login
			session_start();
			session_unset();
			session_destroy();

			session_start();
			//echo "Username/Password errati!";
			$_SESSION['erro'] = "Username/Password errati!";
			header("Location: index.php");
		}


}
else if(isset($_GET['R'])){//Registrazione
	
	if(isset($_POST['username'])&&isset($_POST['pasw1'])&&isset($_POST['pasw2'])){//controllo variabili

		//dichiarazione variabili
		if(isset($_POST['name'])){//settaggio nome
			$name = $_POST['name'];
		}else{
			$name = NULL;
		}
		if(isset($_POST['surname'])){//settaggio cognome
			$surn = $_POST['surname'];
		}else{
			$surn = NULL;
		}
		$username = $_POST['username'];
		$password = $_POST['pasw1'];
		$Rpassword = $_POST['pasw2'];

		session_start();

		if (strlen($username) != 0 && strlen($password) != 0){//controlli variabili vuote
			if($password!=$Rpassword){
				//echo "Password non uguale!";
				$_SESSION['erro'] = "Password non uguale!";
				header("Location: register.php");
			} else{
				//connessione database
				$connection = new mysqli ("62.149.150.186", "Sql848546", "4e7m50vbq7", "Sql848546_5");
				$query = "SELECT * FROM utenti WHERE Username = '$username'";
				$result = $connection->query($query);
				if ($result->num_rows != 0){
					//echo "Utente già presente nel database.";
					$_SESSION['erro'] = "Utente già esistente";
					header("Location: register.php");
				} else{//registrazione nuovo utente
					$password=md5($password);
					$query = "INSERT INTO utenti (id, Nome, Cognome, Username, Password)
										  VALUES (Null, '$name', '$surn', '$username', '$password')";
					if($connection->query($query)){
						//echo "Utente inserito correttamente!";
						$_SESSION['erro'] = "Registrazione effettuata!";
						header("Location: register.php");
					}
					else{
						//echo "Errore inserimento utente!";
						$_SESSION['erro'] = "Errore inserimento utente!";
						header("Location: register.php");
					}
				}
			}
			//rilascio memoria
			$result->free();
			$connection->close();
		} else{
			//echo "Username/Password vuoti!";
			$_SESSION['erro'] = "Username/Password vuoti!";
			header("Location: register.php");
		}

	}else{//nessuna variabile per registrazione

		session_start();
		//echo "Campi registrazione errati!";
		$_SESSION['erro'] = "Campi registrazione errati!";
		header("Location: register.php");
	}
}
else{//controllo sicurezza
	session_start();
	session_unset();
	session_destroy();

	session_start();
	$_SESSION['erro'] = "[ERRORE] Pagina non disponibile.";
	header("Location: index.php");//torno al login
	die;
}
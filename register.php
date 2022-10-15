<!DOCTYPE html>
<?php session_start(); ?>
<?php //include 'secure/checkLog.php';//sicurezza utente già loggato ?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/register.css">
		<title>Register</title>
	</head>
	<body>
		<!-- form registrazione -->
		<form class="login" action="form.php?R=&" method="POST">
		  <center><h1>Nuovo Utente</h1></center>
		  <input type="text" placeholder="Nome" name="name">
		  <input type="text" placeholder="Cognome" name="surname">
		  <input type="text" placeholder="Username" name="username" required>
		  <input type="password" placeholder="Password" name="pasw1" required>
		  <input type="password" placeholder="Ripeti password" name="pasw2" required>
		  <button type="button" class="back" onclick="window.location.href='home.php'">Annulla</button>&nbsp;&nbsp;&nbsp;<button type="submit">Invio</button>
		</form>

	</body>
	<script type="text/javascript">
		<?php //alert per errori
			if(isset($_SESSION['erro'])){
				echo "alert('".$_SESSION['erro']."')";
				unset($_SESSION['erro']);
			}
		?>
	</script>
</html>
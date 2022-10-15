<!DOCTYPE html>
<?php
	if(isset($_GET['Lo'])){//Logout
		session_start();
		//unset variabili
		unset($_SESSION['username']);
		unset($_SESSION['CodUser']);
		unset($_SESSION['time']);
		session_unset();
		session_destroy();
		header("Location: index.php");//Login
	}
?>
<?php session_start(); ?>
<?php include 'secure/log.php';//sicurezza utente già loggato ?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<title>Login</title>
	</head>
	<body>
		<!-- form login -->
		<form class="login" action="form.php?Test=&" method="POST">
		  <input type="text" placeholder="Username" name="username" value="Test" required>
		  <input type="password" placeholder="Password" name="password" value=" " required>
		  <button>Login</button>
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
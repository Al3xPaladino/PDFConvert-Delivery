<!DOCTYPE html>
<?php session_start(); ?>
<?php include 'secure/existFile.php'; ?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/cerca.css">
		<title>Cerca</title>
		<script type="text/javascript">
			<?php 
			if(isset($_SESSION['erro'])){
				echo "alert('".$_SESSION['erro']."')";
				unset($_SESSION['erro']);
			}
		?>
		</script>
		<script src="https://kit.fontawesome.com/c7de94568b.js" crossorigin="anonymous"></script>
	</head>
	<body>
		<img id="altosx" src="image/A-Sx.png" alt="" style="width:223px; height:302px;">
		<a href="home.php">
			<i class="fas fa-arrow-alt-circle-left" style="color: #ee6830; font-size: 24px; position: absolute; left: 210px; top: 22px;">
			</i>
			<span style="color: #ee6830; font-size: 24px; position: absolute; left: 250px; top: 20px;">Menu Iniziale</span>
		</a>
		<div style="position: fixed; top: 50%; left: 50%; margin-top: -100px; margin-left: -150px;">
			<h1 style="color: #233761;">Inserisci codice EAN</h1>
			<div align="center">
				<form id="cerca" action="result.php" method="Get">
					<input type="text" name="EAN" id="EAN" placeholder="Codice EAN..." onchange="invia()" style="width:200px; height: 30px; font-size: 16px;" required>
					<button style="cursor: pointer; position: absolute; background-color: #ee6830; border-radius: 50px; border: none; padding: 12px 12px; margin-top: -5px; margin-left: 10px;">
						<i class="fas fa-search" style="color: white;"></i>
					</button>
					<br><br>
					<div style="position: absolute; margin-left: 40px;">
						<input type="checkbox" id="search" onclick="automatico()">
						<label for="ricercaautomatica" style="color: #233761;">Ricerca automatica</label>
						<br>
					</div>
				</form>
			</div>
		</div>
		<img id="bassodx" src="image/B-Dx.png" style="width:454px; height:336px; position: absolute; bottom: 0; right: 0; z-index: -1;">
	</body>
	<script type="text/javascript">
		let auto = false;

		function automatico(){
			let ceck = document.getElementById('search').checked;
			//alert(ceck);
			if(ceck){
				auto = true;
			}else{
				auto = false;
			}
		}

		function invia(){
			if(auto){
				document.getElementById('cerca').submit();
			}
		}
	</script>
</html>
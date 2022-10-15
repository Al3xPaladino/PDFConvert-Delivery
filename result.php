<!DOCTYPE html>
<?php session_start(); ?>
<?php include 'secure/existFile.php'; ?>
<?php include 'existSearch.php'; ?>
<?php include 'search.php'; ?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="css/result.css">
		<link rel="stylesheet" href="css/popup.css">
		<title>Risultato</title>
		<script src="https://kit.fontawesome.com/c7de94568b.js" crossorigin="anonymous"></script>
	</head>
	<body>
		<img id="altosx" src="image/A-Sx.png" alt="" style="width:223px; height:302px;">
		<a href="home.php">
			<i class="fas fa-arrow-alt-circle-left" style="color: #ee6830; font-size: 24px; position: absolute; left: 210px; top: 22px;">
			</i>
			<span style="color: #ee6830; font-size: 24px; position: absolute; left: 250px; top: 20px;">Menu Iniziale</span>
		</a>
		<div style="position: fixed; top: 50%; left: 50%; margin-top: -200px; margin-left: -150px;">
			<h1 style="color: #233761;">Risultato Ricerca... [<?php echo $letti."/".$dimensione; ?>]</h1>
			<div align="center">
				<div style="text-align: left;">
					<span style="color: #ee6830;font-size: 20px;font-weight: bold;"><i class="fas fa-barcode" style="color: black;"></i> EAN </span>
					
					<input type="text" name="ean" <?php echo "value=\"".$EAN."\""; ?> style="background-color:white;padding-left:5px;font-size: 16px;font-weight: bold;color:#ee6830;border-left:none;border-right:none;border-top: none;border-color: #233761;width: 40%" disabled>
				</div>
				<br>
				<div style="margin-top:10px;text-align: left;">
					<span style="color: #ee6830;font-size: 20px;font-weight: bold;"><i class="fas fa-map-marked-alt" style="color: black;"></i> Comune</span>
					<br>
					<input type="text" id="inp" name="citta" <?php echo "value=\"".$ResultLocalita."\""; ?> style="background-color:white;margin-top:10px;height: 30px;padding-left:25px;font-size: 16px;font-weight: bold;border-left:none;border-right:none;border-top: none;border-color: #233761;" disabled>
				</div>
				<br>
				<div style="margin-top:10px;text-align: left;">
					<span style="color: #ee6830;font-size: 20px;font-weight: bold;"><i class="fas fa-map-marker-alt" style="color: black;"></i> Indirizzo</span>
					<br>
					<input type="text" id="inp" name="via" <?php echo "value=\"".$ResultVia."\""; ?> style="background-color:white;margin-top:5px;height: 30px;padding-left:25px;font-size: 16px;font-weight: bold;border-left:none;border-right:none;border-top: none;border-color: #233761;" disabled>
				</div>
				<br>
				<div style="margin-top:10px;text-align: left;">
					<span style="color: #ee6830;font-size: 20px;font-weight: bold;"><i class="fas fa-university" style="color: black;"></i> CAP </span>
					
					<input type="text" name="riga" <?php echo "value=\"".$ResultCAP."\""; ?> style="background-color:white;padding-left:5px;font-size: 16px;font-weight: bold;border-left:none;border-right:none;border-top: none;border-color: #233761;width: 60px" disabled>
 
					<span style="color: #ee6830;font-size: 20px;font-weight: bold;margin-left: 25px"><i class="fas fa-book-open" style="color: black;"></i> Riga N° </span>
					
					<input type="text" name="riga" <?php echo "value=\"".$ResultRiga."\""; ?> style="background-color:white;padding-left:5px;font-size: 16px;font-weight: bold;border-left:none;border-right:none;border-top: none;border-color: #233761;width: 30px" disabled>
				</div>
				<br>
				<div style="margin-top:10px;text-align: left;">
					<span style="color: #ee6830;font-size: 20px;font-weight: bold;"><i class="fas fa-money-bill-wave" style="color: black;"></i> Importo Contrassegno </span>
					
					<input type="text" name="contrassegno" <?php echo "value=\"".$ResultContrassegno."\""; ?> style="background-color:white;padding-left:5px;font-size: 16px;font-weight: bold;border-left:none;border-right:none;border-top: none;border-color: #233761;width: 80px" disabled><span style="color: #000;font-size: 20px;font-weight: bold;">€</span>
				</div>

				<br>

				<div style="cursor: pointer; color: #ee6830; border: none;">
					<a href="cerca.php"><i class="fas fa-plus-circle fa-5x" style="color: #ee6830;"></i></a>
					<h3>Effettua nuova ricerca</h3>
				</div>
			</div>
		</div>
		<img id="bassodx" src="image/B-Dx.png" style="width:454px; height:336px; position: absolute; bottom: 0; right: 0; z-index: -1;">

	<?php if(($vuoto*1)==1): ?>
		<!-- POPUP[domanda] per ean vuoti -->
		<div id="id00" class="modal" style="display: block;">
  
		  <div class="modal-content animate">
		    <div class="container">
		    	<label for="uname"><h2><b>Nessuna corrispondenza con questo EAN [<?php echo $EAN; ?>], Vuoi inserirlo?</b></h2></label>

		    	<br><br><br>

		    	<button type="button" onclick="exit()" class="cancelbtn">No</button> <button type="button" onclick="aggiungi()">Si</button>
		    </div>
		  </div>
		</div>
		<!-- FINE POPUP[domanda] -->
	<?php endif ?>
	<?php if(($vuoto*1)==2): ?>
		<!-- POPUP[domanda] per altri parametri vuoti -->
		<div id="id01" class="modal" style="display: block;">
  
		  <div class="modal-content animate">
		    <div class="container">
		    	<label for="uname"><h2><b>In questa ricerca mancano dei dati, Vuoi inserirli?</b></h2></label>

		    	<br><br><br>

		    	<button type="button" onclick="esc()" class="cancelbtn">No</button> <button type="button" onclick="modifica()">Si</button>
		    </div>
		  </div>
		</div>
		<!-- FINE POPUP[domanda] -->
	<?php endif ?>
	<?php if(($vuoto*1)>0): ?>
		<!-- POPUP[parametri] per inserimento nuovi dati -->
		<div id="id02" class="modal" style="display: none;">
  
		  <form class="modal-content animate" action="modifica.php" method="Post">
		  	<input type="text" name="mode" <?php echo "value=\"".$vuoto."\""?> style="display: none;">
		    <div class="container">
		    	<div style="margin-top:10px;text-align: left;">
					<span style="color: #ee6830;font-size: 20px;font-weight: bold;"><i class="fas fa-barcode" style="color: black;"></i> EAN </span>
					
					<input type="text" name="ean" <?php echo "value=\"".$EAN."\""; ?> style="background-color:white;padding-left:5px;font-size: 16px;font-weight: bold;border-left:none;border-right:none;border-top: none;border-color: #233761;width: 60%">
				</div>
		    	<br>
		      	<div style="text-align: left;">
					<span style="color: #ee6830;font-size: 20px;font-weight: bold;"><i class="fas fa-map-marked-alt" style="color: black;"></i> Comune</span>
					<br>
					<input type="text" name="localita" <?php if($ResultLocalita!="")echo "value=\"".$ResultLocalita."\""; ?> style="background-color:white;margin-top:10px;height: 30px;font-size: 16px;font-weight: bold;border-left:none;border-right:none;border-top: none;border-color: #233761;width: 100%;">
				</div>
				<br>
				<div style="margin-top:10px;text-align: left;">
					<span style="color: #ee6830;font-size: 20px;font-weight: bold;"><i class="fas fa-map-marker-alt" style="color: black;"></i> Indirizzo</span>
					<br>
					<input type="text" name="via" <?php if($ResultVia!="")echo "value=\"".$ResultVia."\""; ?> style="background-color:white;margin-top:5px;height: 30px;font-size: 16px;font-weight: bold;border-left:none;border-right:none;border-top: none;border-color: #233761;width: 100%;">
				</div>
				<br>
				<div style="margin-top:10px;text-align: left;">
					<span style="color: #ee6830;font-size: 20px;font-weight: bold;"><i class="fas fa-university" style="color: black;"></i> CAP </span>
					
					<input type="text" name="cap" <?php if($ResultCAP!="")echo "value=\"".$ResultCAP."\""; ?> style="background-color:white;padding-left:5px;font-size: 16px;font-weight: bold;border-left:none;border-right:none;border-top: none;border-color: #233761;width: 60px">

					<span style="color: #ee6830;font-size: 20px;margin-left:25px;font-weight: bold;"><i class="fas fa-book-open" style="color: black;"></i> Riga N° </span>
					
					<input type="text" name="riga" <?php if($ResultRiga!="")echo "value=\"".$ResultRiga."\""; ?> style="background-color:white;padding-left:5px;font-size: 16px;font-weight: bold;border-left:none;border-right:none;border-top: none;border-color: #233761;width: 30px">
				</div>
				<br>
				<div style="margin-top:10px;text-align: left;">
					<span style="color: #ee6830;font-size: 20px;font-weight: bold;"><i class="fas fa-money-bill-wave" style="color: black;"></i> Importo Contrassegno </span>
					
					<input type="text" name="contrassegno" <?php if($ResultContrassegno!="")echo "value=\"".$ResultContrassegno."\""; ?> style="background-color:white;padding-left:5px;font-size: 16px;font-weight: bold;border-left:none;border-right:none;border-top: none;border-color: #233761;width: 80px"><span style="color: #000;font-size: 20px;font-weight: bold;">€</span>
				</div>
		        <br><br>
		      <button type="button" onclick="esc()" class="cancelbtn">Annulla</button> <button type="submit">Aggiungi</button>
		    </div>
		  </form>
		</div>
		<!-- FINE POPUP[parametri] -->
	<?php endif ?>
	</body>
	<script type="text/javascript">
		function exit(){
			window.location.href = "cerca.php";
		}
		function aggiungi() {
			document.getElementById('id00').style.display='none';
			document.getElementById('id02').style.display='block';
		}
		function modifica() {
			document.getElementById('id01').style.display='none';
			document.getElementById('id02').style.display='block';
		}
		function esc(){
			if(document.getElementById('id00')!=null)
				document.getElementById('id00').style.display='none';
			if(document.getElementById('id01')!=null)
				document.getElementById('id01').style.display='none';
			document.getElementById('id02').style.display='none';
		}
		<?php 
			if(isset($_SESSION['erro'])){
				echo "alert('".$_SESSION['erro']."')";
				unset($_SESSION['erro']);
			}
		?>
	</script>
</html>
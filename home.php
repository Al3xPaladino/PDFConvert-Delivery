<?php session_start(); ?>
<?php
	if(isset($_GET["DCSV"])){
		include 'downloadCsv.php';
	}
?>
<?php include 'secure/checkLog.php';//controllo accesso utente ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/home.css">
		<title>Home</title>
		<script src="https://kit.fontawesome.com/c7de94568b.js" crossorigin="anonymous"></script>
	</head>
	<body>
		<!-- Immagine e menu in alto a sinistra -->
		<img id="altosx" src="image/A-Sx.png" alt="" style="width:223px; height:302px;">
		<div style="position: absolute; left: 150px; top: 22px;">
		<a href="index.php?Lo" style="text-decoration: none;display: inline;">
			<i class="fas fa-sign-out-alt" style="color: #ee6830; font-size: 24px;">
			</i>
			<span style="color: #ee6830; font-size: 24px;"><?php echo "[".$_SESSION["username"]."]" ?> Logout</span>
		</a> <h1 style="color: #233761;display: inline;">|</h1> <a href="register.php" style="text-decoration: none;display: inline;">
			<i class="fas fa-user-plus" style="color: #ee6830; font-size: 24px;">
			</i>
			<span style="color: #ee6830; font-size: 24px;"> Nuovo Utente</span>
		</a>
		<?php
			$fileRead = "files/Read_".$_SESSION["CodUser"].".json";
			$fileJSon = "files/".$_SESSION["CodUser"].".json";

		if(file_exists($fileRead)&&file_exists($fileJSon)): ?>
			<h1 style="color: #233761;display: inline;">|</h1> <a href="home.php?DCSV=" style="text-decoration: none;display: inline;">
			<i class="fas fa-download" style="color: #ee6830; font-size: 24px;">
			</i>
			<span style="color: #ee6830; font-size: 24px;"> Download CSV</span>
			</a>
		<?php endif ?></div>

		<!-- Body da width 730px -->
		<div id="da730" style="position: fixed; top: 50%; left: 50%; margin-top: -100px; margin-left: -350px;">
			<div align="center" style="float: left; margin-top: -75px;">
				<h1 style="color: #233761; margin-block-end: 0.35em;">Carica Nuovo PDF</h1>
				<button onclick="DopenInput()" style="cursor: pointer;background-color: #ee6830;border-radius: 50px;border: none;padding: 20px 20px;font-size: 40px;width: 100px;height: 100px;">	
					<i class="fas fa-upload" style="color: white; margin-top: -25px;"></i>
				</button>
				<br><br>
				<form id="DupLoadPdf" action="save.php" method="Post" enctype="multipart/form-data">
					<input type="file" id="DpdfUpLoad" accept=".pdf" name="FilePDF" onchange="DupLoad()" style="display: none;">
					<input type="text" name="saveF" id="saveF" readonly style="display: none">
					<!-- Codice implementativo per specificare le pagine da salvare -->
					<!--<br><br>
					<span style="color: #233761;font-size: 15px;font-weight: bold">PAGINE DA SALVARE</span>
					<br>
					Da pag.<input type="number" name="pageMin" value="1" style="width: 40px;"> a pag.<input type="number" name="pageMax" value="1" style="width: 40px;">-->
				</form>
				<span id="DnameFile" style="color: #ee6830;font-size: 20px;"> Scegli un File... </span>
			</div>
			<div style="border-left:1px solid #000;height: 200px;margin-left: 350px;"></div>
			<div align="center" style="margin-left: 450px;float: right;margin-top: -175px;">
				<a href="cerca.php"><i class="fas fa-file-pdf" style="color: #ee6830; font-size: 100px;"></i></a>
				<h1 style="color: #233761; margin-block-end: 0.35em;">Cerca in PDF</h1>
			</div>
		</div>

		<!-- Body fino width 730px -->
		<div id="fino730" style=" display: none; position: fixed; top: 50%; left: 50%; margin-top: -200px; margin-left: -125px;">
			<div align="center" style="">
				<h1 style="font-size: 1.75em; color: #233761; margin-block-end: 0.35em;">Carica Nuovo PDF</h1>
				<button onclick="FopenInput()" style="cursor: pointer; background-color: #ee6830; border-radius: 50px; border: none; padding: 20px 20px; font-size: 40px; width: 100px; height: 100px;">
					<i class="fas fa-upload" style="color: white; margin-top: -25px;"></i>
				</button>
				<br><br>
				<form id="FupLoadPdf" action="save.php" method="Post" enctype="multipart/form-data">
					<input type="file" id="FpdfUpLoad" accept=".pdf" name="FilePDF" onchange="FupLoad()" style="display: none;">
					<input type="text" name="saveF" id="saveF" readonly style="display: none">
				</form>
				<span style="color: #ee6830;"> Scegli un File... </span>
			</div>
			<hr>
			<div align="center" style="">
				<a href="cerca.php"><i class="fas fa-file-pdf" style="color: #ee6830; font-size: 100px;"></i></a>
				<h1 style="font-size: 1.75em; color: #233761; margin-block-end: 0.35em;">Cerca in PDF</h1>
			</div>
		</div>

		<img id="bassodx" src="image/B-Dx.png" style="width:454px; height:336px; position: absolute; bottom: 0; right: 0; z-index: -1;">
	</body>
	<script type="text/javascript">
		<?php 
			$fileName = "files/".$_SESSION['CodUser'].".pdf";
			if(file_exists($fileName)){
				echo "const flagFile = true;";
			}else{
				echo "const flagFile = false;";
			}
		?>
		function DopenInput(){
			if(flagFile){
				if (confirm('Esiste già un PDF salvato, vuoi salvarne uno nuovo?')) {
  					// Save it!
  					document.getElementById('saveF').value=1;
  					document.getElementById('DpdfUpLoad').click();
				} else {
  					// Do nothing!
  					document.getElementById('saveF').value=0;
  					alert("Operazione annullata!");
				}
			}else{
				document.getElementById('saveF').value=1;
				document.getElementById('DpdfUpLoad').click();
			}
		}

		function FopenInput(){
			if(flagFile){
				if (confirm('Esiste già un PDF salvato, vuoi salvarne uno nuovo?')) {
  					// Save it!
  					document.getElementById('saveF').value=1;
  					document.getElementById('FpdfUpLoad').click();
				} else {
  					// Do nothing!
  					document.getElementById('saveF').value=0;
  					alert("Operazione annullata!");
				}
			}else{
				document.getElementById('saveF').value=1;
				document.getElementById('FpdfUpLoad').click();
			}
		}

		function DupLoad(){
    		document.getElementById("DupLoadPdf").submit();
		};

		function FupLoad(){
    		document.getElementById("FupLoadPdf").submit();
		};
		<?php 
			if(isset($_SESSION['erro'])){
				echo "alert('".$_SESSION['erro']."')";
				unset($_SESSION['erro']);
			}
		?>
	</script>
</html>

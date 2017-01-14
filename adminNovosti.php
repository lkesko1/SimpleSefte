<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Simple Sefte</TITLE>
<link rel="stylesheet" type="text/css" href="stil2.css"> 
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<SCRIPT src="./../Scripts/PrikaziMeni.js"></SCRIPT>
<SCRIPT src="./../Scripts/UcitavanjeStranice.js"></SCRIPT>
<SCRIPT src="./../Scripts/OtvoriSliku.js"></SCRIPT>
<SCRIPT src="./../Scripts/Validacija.js"></SCRIPT>
<SCRIPT src="./../Scripts/ButtonFalse.js"></SCRIPT>

</HEAD>
<BODY>
	  <?php include('login_skripta.php') ?>
	    <?php include('createXML.php') ?>
	  <?php 
			if (!isset($_SESSION['username']))
			{
				$message ="Zabranjen pristup stranici. Logujte se!";
				echo "<script type='text/javascript'>
					alert('$message'); 
					location.href='index.php';
					</script>";
			}
					
		?>
	  <?php include('novosti_izmjene.php') ?>
	  <?php
	  	$id = 1;
		$tabela = "<h1> Novosti </h1><br><br><br>";
		
		try
		{
			//Povezivanje s bazom
				$veza = new PDO("mysql:dbname=simpleseftedb; host=localhost; charset=utf8", "wtuser", "sifra");
				$veza->exec("set names utf8");
			//Provjeri da li postoji ta tabela 
			if ($rezultat = $veza->query("SHOW TABLES LIKE 'Novost'")) {
					if(sizeof($rezultat) >0) {
						$rezultat = $veza->prepare("SELECT * FROM Novost order by id desc");
						$rezultat->execute();
						
						$tabela .= "<table>";
						foreach($rezultat->fetchAll() as $r)
						{
							$tabela .= "<tr>";
							$tabela .= "<td>" . $id . ".</td>";		
							
							$tabela .= "<form action='#' method='POST'>";				
							$tabela .= "<td> <textarea rows='4' cols='65' name='novosti" . $id . "' >" . $r['tekst']. "</textarea>";			
							
							$tabela .= "<td> <input type='submit' name='promjenaNovost" . $id . "' value='Promijeni' >";
							$tabela .= "</form>";
							$tabela .= "<form action='#' method='POST'>";
							$tabela .= "<td> <input type='submit' name='brisanjeNovost". $id . "' value='Briši' color='red'>";
							$tabela .= "</form>";
							$tabela .= "</tr>";
							$id++;
						}		
						$tabela .= "</table>";
					}
			}
				
		}
		catch(PDOException $e)
		{
			$message ="Connection failed!" . $e->getMessage();
					echo "<script type='text/javascript'>
						alert('$message'); 
						location.href='index.php';
						</script>";
		}
		$dodajNovost = '<button type="submit" name="dodajNovost" value="true">Dodaj novost </button>';
		
		if(isset($_REQUEST["dodajNovost"])){
		
				$dodavanje =" <table>";
				$dodavanje .= "<table> <th> </th> <th> Novosti </th>";
				
				$dodavanje .= "<tr>";
				$dodavanje .= "<td>" . $id . ".</td>";		
				$dodavanje .= "<form action='#' method='POST'>";	
				$dodavanje .= "<td> <textarea rows='4' cols='65' name='novostText'> </textarea> </td>";		
				
				$dodavanje .= "<td> <input type='submit' name='buttonSpremiNovost' value='Spremi'>";
				
				$dodavanje .= "</form>";
				$dodavanje .= "</tr>";
				$dodavanje .= "</table>";
			}
			else
			{
				$dodavanje="";
			}
		?>
<div class="container">


	<div id="prijava">
		
		<div class = "red">
			<form action="index.php#" method="POST"> <?php echo $button;  echo $tekstPrijave;  ?>  </form>
			<?php 
				if ($tekstPrijave != '')
					echo '<a href="uredi.php" name="uredi"> Uredi &nbsp </a>';
			?>	
		</div>
	</div>
	
	
	<div id="traka"></div>
	<div class="red zaglavlje">
		<div class="kolona logo"> 
			<a href="index.php#">
				<img src="./../Foto/logo.jpg" width="196px" height="130px"></a>
			<div class="red"> Caffe & Pizzeria </div>
		</div>
		<div class="kolona meni">
		<img id="meniButton" src="./../Foto/hambaspng.png" width="50px" height="50px" onclick="prikaziMeni()">
			<ul id="meniLista" class="meniKlasa">			
				<li>|<a href="uredi.php#" >  Nazad  </a>|</li>
			</ul>		
		</div>
	</div>
	<div id="traka"></div>
	
	<div class="glavni">
		
		<div class = "red" style="overflow-y:auto" id = "admin" > <?php  echo $tabela; echo $dodavanje;?> </div>
				<div class="red"> <P id="greskaPHP"> <?php echo $greska; ?> </p></div>

		<div class = "col4"></div>
		<div class = "col4">
		<div class = "red"> <form action="#" method="POST" >  <?php echo $dodajNovost; ?>  </form> </div>
		</div>
		<div class = "col4"></div>
	</div>
	
	
	
	<div id="traka">
		<div class = "col4">
			<img src="./../Foto/fb.png" width="36px" height="36px" >
			<img src="./../Foto/insta.png" width="40px" height="40px"> 
		</div>
		<div class = "col4"> Caffe & Pizzeria 'Simple Sefte' <br> Pehlivanuša br. 2, 71000 Sarajevo	</div> 
		<div class = "col4">Sarajevo, 2016	</div>
	</div>
	
</div>
</BODY>
</HTML>
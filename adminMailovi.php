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
<SCRIPT src="search.js"></SCRIPT>
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
	  <?php include('mailovi_izmjene.php') ?>
	  <?php
		$id = 1;
		$tabela = "<h1> Mailovi </h1><br><br><br>";
		try
		{
			//Povezivanje s bazom
				$veza = new PDO("mysql:dbname=simpleseftedb; host=localhost; charset=utf8", "wtuser", "sifra");
				$veza->exec("set names utf8");
			//Provjeri da li postoji ta tabela 
			if ($rezultat = $veza->query("SHOW TABLES LIKE 'Mail'")) {
					if(sizeof($rezultat) >0) {
						$rezultat = $veza->prepare("SELECT * FROM Mail order by id desc");
						$rezultat->execute();
						
						$tabela .= "<table> <th> </th> <th> Ime i prezime </th> <th> Email </th> <th> Predmet </th> <th> Tekst </th>";
						foreach($rezultat->fetchAll() as $r)
						{
							$tabela .= "<tr>";
							$tabela .= "<td>" . $id . ".</td>";		
							$tabela .= "<form action='#' method='POST'>";
							$tabela .= "<td width='200'> <input type='text' name='ime" . $id . "' value='". $r['name'] . "'></td>";		
							$tabela .= "<td width='230'> <input type='text' name='mail" . $id . "'  value='". $r['adresa']. " '></td>";		
							$tabela .= "<td> <input type='text' name='subject" . $id . "'  value='". $r['subject'] . "'></td>";		
							$tabela .= "<td> <textarea rows='3' name='mailtekst" . $id . "' cols='65'>". $r['tekst'] . "</textarea>";			
							
							$tabela .= "<td> <input type='submit' name='promjenaMail". $id . "' value='Promijeni' >";
							$tabela .= "</form>";
							$tabela .= "<form action='#' method='POST'>";
							$tabela .= "<td> <input type='submit' name='brisanjeMail". $id . "' value='Briši' color='red'>";
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

		$dodajMail = '<button type="submit" name="dodajMail" value="true">Dodaj novi Mail</button>';
		
		if(isset($_REQUEST["dodajMail"])){
		
				$dodavanje =" <table>";
				$dodavanje .= "<table> <th> </th> <th> Ime i prezime </th> <th> Email </th> <th> Predmet </th> <th> Tekst </th>";
				
				$dodavanje .= "<tr>";
				$dodavanje .= "<td>" . $id . ".</td>";		
				$dodavanje .= "<form action='#' method='POST'>";
				
				$dodavanje .= "<td width='150'> <input type='text' name='ime' ></td>";		
				$dodavanje .= "<td  width='230'> <input type='text' name='mail'></td>";		
				$dodavanje .= "<td> <input type='text' name='subject'></td>";		
				$dodavanje .= "<td> <textarea rows='3' cols='65' name='mailtekst'> </textarea> </td>";		
				
				$dodavanje .= "<td> <input type='submit' name='buttonSpremiMail' value='Spremi'>";
				
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
			<a href="index.php#" onclick="otvori('login')"> Admin Log In &nbsp </a> 
		</div>
		
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
				<li>|<a href="uredi.php" >  Nazad  </a>|</li>
			</ul>		
		</div>
	</div>
	<div id="traka"></div>
	
	
	<div id = "traka">
		<div class = "red">
			<form action="#" method="POST">
				<div class="kolona dva txt" style="position:relative"> 
						<input type="text" id="pretragaInput" name="pretragaInput" onkeyup="pretrazivanje(this.value)"> 
							<div id="lista" ></div> 
						 
				</div>
				<div class= "col1"><button type="submit" id ="bSearch" name="bSearch" > Pretraži <img align="left" width="25px" height ="25px" src="./../Foto/search.png"> </button> </div> 
				
			</form>
		</div>
		
		<?php
	
		if (isset($_REQUEST['bSearch']) && isset($_REQUEST['pretragaInput']) && !empty($_REQUEST['pretragaInput']))
		{
			try
			{
					//Povezivanje s bazom
						$veza = new PDO("mysql:dbname=simpleseftedb; host=localhost; charset=utf8", "wtuser", "sifra");
						$veza->exec("set names utf8");
					//Provjeri da li postoji ta tabela 
					if ($rezultat = $veza->query("SHOW TABLES LIKE 'Mail'")) {
						if(sizeof($rezultat) >0) {
							$rezultat = $veza->prepare("SELECT * FROM Mail");
							$rezultat->execute();
	
							$novaTabela = "";
				
							$novaTabela .= "<h1> Rezultati pretrage za " . $_REQUEST['pretragaInput'] . ": </h1><br><br><br>";
							$novaTabela .= "<table> <th> </th> <th> Ime i prezime </th> <th> Email </th> <th> Predmet </th> <th> Tekst </th>";
							$k = 1;
							$i = 1;
							foreach($rezultat->fetchAll() as $r)
							{
								if (isset($_REQUEST['pretragaInput']) &&  (stristr($r['name'], $_REQUEST['pretragaInput']) || stristr($r['name'], $_REQUEST['pretragaInput']) ))
								{
									$novaTabela .= "<tr>";
									$novaTabela .= "<td>" . $k . ".</td>";		
									$novaTabela .= "<form action='#' method='POST'>";
									$novaTabela .= "<td width='200'> <input type='text' name='ime" . $i. "' value='". $r['name'] . "'></td>";		
									$novaTabela .= "<td width='230'> <input type='text' name='mail" . $i. "'  value='".$r['adresa'] . " '></td>";		
									$novaTabela .= "<td> <input type='text' name='subject" .  $i  . "'  value='". $r['subject'] . "'></td>";		
									$novaTabela .= "<td> <textarea rows='3' name='mailtekst" .  $i . "' cols='65'>". $r['tekst'] . "</textarea>";			
									
									$novaTabela .= "<td> <input type='submit' name='promjenaMail". $i . "' value='Promijeni' >";
									$novaTabela .= "</form>";
									$novaTabela .= "<form action='#' method='POST'>";
									$novaTabela .= "<td> <input type='submit' name='brisanjeMail".  $i . "' value='Briši' color='red'>";
									$novaTabela .= "</form>";
									$novaTabela .= "</tr>";
									$k++;
								}
								$i++;
							}
							
							$novaTabela .= "</table>";
							$prikazTabela = $novaTabela;
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
		}
		else
		{
			$novaTabela ="";
			$prikazTabela = $tabela;
		}
		?>
	</div>
	<div class="glavni">		
		<div class = "red" style="overflow-y:auto" id = "admin" > <?php   echo $prikazTabela; echo $dodavanje;?> </div>
		<div class="red"> <P id="greskaPHP"> <?php echo $greska; ?> </p></div>
		<div class = "col4"></div>
		<div class = "col4">
		<div class = "red"> <form action="#" method="POST" >  <?php echo $dodajMail; ?>  </form> </div>
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
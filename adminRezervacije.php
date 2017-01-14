
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
	  <?php include('rezervacije_izmjene.php') ?>
	  <?php
		$id = 1;
		$tabela = "<h1> Rezervacije </h1><br><br><br>";
		try
		{
			//Povezivanje s bazom
				$veza = new PDO("mysql:dbname=simpleseftedb; host=mysql-55-centos7; charset=utf8", "wtuser", "sifra");
				$veza->exec("set names utf8");
			//Provjeri da li postoji ta tabela 
			if ($rezultat = $veza->query("SHOW TABLES LIKE 'Rezervacija'")) {
					if(sizeof($rezultat) >0) {
						$rezultat = $veza->prepare("SELECT * FROM Rezervacija order by id desc");
						$rezultat->execute();
						
						$tabela .= "<table> <th> </th> <th> Ime i prezime </th> <th> Broj telefona </th> <th> Datum </th> <th> Vrijeme </th> <th> Broj osoba </th> <th> Napomena </th>";
						foreach($rezultat->fetchAll() as $r)
						{
								$datumformat = date("Y-m-d", strtotime($r['datum']));
								$tabela .= "<tr>";
								$tabela .= "<td>" . $id . ".</td>";		
								$tabela .= "<form action='#' method='POST'>";
								$tabela .= "<td> <input type='text' name='ime" . $id . "' value='". $r['name'] . "'></td>";		
								$tabela .= "<td width='150'> <input type='tel' name='tel" . $id . "' value='". $r['phone']. " '></td>";		
								$tabela .= "<td> <input type='date' name='date" . $id . "' value=". $datumformat . "></td>";		
								$tabela .= "<td width='80'> <input type='time' name='vrijeme" . $id . "' value='". $r['vrijeme']. "'></td>";		
								$tabela .= "<td width='50'> <input type='number' name='osobe" . $id . "' min='1' max='15' step='1' value='". $r['broj'] . "' ></td>";		
								$tabela .= "<td width='400'> <input type='text' name='napomenatekst" . $id . "' value='". $r['tekst'] . "'></td>";	
							
								$tabela .= "<td> <input type='submit' name='promjenaRez". $id . "' value='Promijeni' >";
								$tabela .= "</form>";
								$tabela .= "<form action='#' method='POST'>";
								$tabela .= "<td> <input type='submit' name='brisanjeRez". $id . "' value='Briši' color='red'>";
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

		$dodajRezervaciju = '<button type="submit" name="dodajRezervaciju" value="true">Dodaj novu rezervaciju</button>';
		
		
			if(isset($_REQUEST["dodajRezervaciju"])){
		
				$dodavanje =" <table>";
				$dodavanje .= "<table> <th> </th> <th> Ime i prezime </th> <th> Broj telefona </th> <th> Datum </th> <th> Vrijeme </th> <th> Broj osoba </th> <th> Napomena </th>";
				
				$dodavanje .= "<tr>";
				$dodavanje .= "<td>" . $id . ".</td>";		
				$dodavanje .= "<form onsubmit='return validateFormRezervacija()' action='#' method='POST' >";
				
				$dodavanje .= "<td > <input type='text' name='ime' ></td>";		
				$dodavanje .= "<td  width='150'> <input type='tel' name='tel'></td>";		
				$dodavanje .= "<td> <input type='date' name='date'></td>";		
				$dodavanje .= "<td width='80'> <input type='time' name='vrijeme'></td>";		
				$dodavanje .= "<td width='50'> <input type='number' name='osobe' min='1' max='15' step='1' ></td>";	
				$dodavanje .= "<td width='400'> <input type='text' name='napomenatekst'></td>!";
				
				$dodavanje .= "<td> <input onclick='return validateFormRezervacija()' type='submit' name='buttonSpremi' value='Spremi'>";
				
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
			<a href="index.php#" >
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
	
		<div class = "red" style="overflow-y:auto" id = "admin" > <?php echo $tabela;  echo $dodavanje;?> </div>
		<div class="red"> <P id="greskaPHP"> <?php echo $greska; ?> </p></div>

		<div class = "col4"></div>
		
		<div class = "col4">
			<div class = "red"> <form action="#" method="POST" >  <?php echo $dodajRezervaciju; ?>  </form> </div>
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
 <head>
 <TITLE>Simple Sefte</TITLE>
<link rel="stylesheet" type="text/css" href="stil2.css"> 
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<SCRIPT src="./../Scripts/PrikaziMeni.js"></SCRIPT>
<SCRIPT src="./../Scripts/UcitavanjeStranice.js"></SCRIPT>
<SCRIPT src="./../Scripts/OtvoriSliku.js"></SCRIPT>
<SCRIPT src="./../Scripts/Validacija.js"></SCRIPT>

 </head>
 <body>
	<?php include('login_skripta.php') ?>
	<?php include('dodavanjeStavke.php') ?>
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
				<li>|<a href="uredi.php#">  Nazad </a>|</li>
			</ul>		
		</div>
	</div>
	<div id="traka"></div>
	
	
	
	<div class="glavni">
		   <h1>Uređivanje</h1>
			<?php
			try {
				$veza = new PDO("mysql:dbname=simpleseftedb; host=mysql-55-centos7; charset=utf8", "wtuser", "sifra");
				$veza->exec("set names utf8");
				$stavke=$veza->query("select id, naziv, cijena from stavka order by naziv desc");
				$vrste = $veza->query("select id, naziv from vrsta");
				$sastojaks = $veza->query("select id, naziv from sastojak");
				$sastojci = $veza->query("select id_stavke, id_sastojka from sastojci");
			}
			catch(PDOException $e)
			{
				$message ="Connection failed!" . $e->getMessage();
				echo "<script type='text/javascript'>
					alert('$message'); 
					location.href='index.php';
					</script>";
			}

			?>
		   
		 <div class="kolona dva">
			<div class="red">
			<form id="Stavka" action="#" method="POST" >
				<table id="adminJelo">
				<tr> <th colspan="4"> Dodavanje nove stavke <br> <br> </th> </tr> 
				<tr> <th> Naziv </th> <th> Cijena </th> <th> Vrsta(ID) </th> </tr> 
				<tr> 
					<td> <input type='text' name='nazivStavke'> </td> 
					<td> <input type="number" name="cijenaStavke" min="0.5" max='30' step='0.5'> </td> 
					
					<td> <?php $broj=sizeof($vrste->fetchAll()); echo "<input type='number' name='vrstaStavkeID' min='1' max ='$broj'>"; ?> </td>
					<td> <small><a href="adminJelovnik.php?q=vrsta" name="ispisVrsta"> Prikazi sve vrste </a> </small> </td>
				</tr>
				<tr> <td> </td> <td> </td> <td colspan="2"> <button type="submit" name="dodajStavku" value="Submit"> Spremi stavku </button> </td> </tr>
				 </table>
			</form>
			</div>
			<div class="red"> </div> 
			
			<div class="red">
			<form id="Dodatak" action="#" method="POST"> 
				<table id="adminJelo">
				<tr> <th colspan="2"> Dodavanje dodataka uz jelo <br> <br> </th> </tr> 
				<tr> <th> Jelo </th> <th> Sastojak </th>  </tr> 
				<tr> 
				<td>
				<?php
					$ispis = "<select name = 'stavkaD'>";
					foreach($stavke as $s)
					{
						$ispis .= "<option name='stavkaD1' value='" . $s['naziv'] . "'>" . $s['naziv'] . "</option>";
					}
					$ispis .= "</select>";
					echo $ispis;
				?> 
				</td>
				<td>
				<?php
					$ispis = "<select name = 'sastojakD'>";
					foreach($sastojaks as $s)
					{
						$ispis .= "<option name='sastojakD1' value='" . $s['naziv'] . "'>" . $s['naziv'] . "</option>";
					}
					$ispis .= "</select>";
					echo $ispis;
				?>
				</td> </tr>
				<tr> <td colspan="2"> <button type="submit" name="dodajDodatak" value="Submit"> Spremi </button> </td> </tr> 
				</table> 
			</form>
			</div>
			
			<div class="red"></div>
			<div class="red">
			<form id="Vrsta" action="#" method ="POST">
				<table id="adminJelo">
					<tr> <th colspan="2"> Dodavanje vrste <br> <br> </th> </tr> 
					<tr> <th> Naziv </th>  </tr> 
					<tr> 
						<td> <input type='text' name='nazivVrste'> </td>
						<td> <a href="adminJelovnik.php?q=vrsta" name="ispisVrsta"> Prikazi sve vrste </a> </td>
					</tr>
					<tr> <td colspan="2"><button type="submit" name="dodajVrstu" value="Submit"> Spremi </button> </td> </tr>
				</table> 
			</form>
			</div>
			
			<div class="red"></div>
			<div class="red">
			<form id="Sastojak" action="#" method="POST">
				<table id="adminJelo">
					<tr> <th colspan="2"> Dodavanje novog sastojka u bazu <br> <br> </th> </tr> 
					<tr> <th> Naziv </th>  </tr> 
					<tr> 
						<td> <input type='text' name='nazivSastojka'> </td> 
						<td> <a href="adminJelovnik.php?q=sastojak" name="ispisSastojaka"> Prikazi sve sastojke </a> </td> 
					</tr> 
					<tr> <td colspan="2"><button type="submit" name="dodajSastojak" value="Submit">Spremi </button> </td> </tr>
				</table> 
			</form>
			</div>
			
	
			</div>
			<div class = "kolona dva">
					<?php
						if (isset($_GET['q']))
						{
							$vrste = $veza->query("select id, naziv from vrsta");
							$sastojaks = $veza->query("select id, naziv from sastojak");
							
							$zaIspis=$_GET['q'];
						
							if ($zaIspis == 'vrsta')
							{ 
						
								foreach ($vrste->fetchAll() as $v)
									print $v['id'] . ". " . $v['naziv'] . "<br>";
							
							}
							else if ($zaIspis == 'sastojak')
							{
								
								foreach ($sastojaks->fetchAll() as $s)
									print $s['id'] . ". " . $s['naziv'] . "<br>";
							}
							else if ($zaIspis == 'stavka')
							{
								$stavke = $veza->query("select * from stavka");
								foreach ($stavke->fetchAll() as $s)
									print $s['id'] . ". " . $s['naziv'] . "<br>";
							}
							else if ($zaIspis == 'veza')
							{
								$veze = $veza->query("select * from sastojci");
								foreach ($veze->fetchAll() as $s){
									print $s['id'] . ". ";
									$br = $s['id_stavke'];
									$stavkeVeza = $veza->query("Select * from stavka where id = $br");
									$br2 = $s['id_sastojka'];
									$sasVeza = $veza->query("Select * from sastojak where id = $br2");
									$stavkaRez = $stavkeVeza->fetch();
									$sasRez = $sasVeza->fetch();
									print $stavkaRez['naziv'] . " / dodatak: " . $sasRez['naziv'] . "<br>";
								}
							}
						}
					?>
					
					<div class ="red"> </div>
					<div class = "red"><h4> Unesite ID onoga što želite izbrisati </h4></div>
					<div class="red">
					<form id="Vrsta" action="#" method ="POST">
						<table id="adminJelo">
							<tr> 
								<td><a href="adminJelovnik.php?q=stavka" name="ispisStavki"> Prikazi stavke </a> </td> 
								<td> <input type='number' name='idStavkeBrisanje'> </td>
								 <td><button type="submit" name="brisanjeStavke" value="Submit"> Brisanje stavke </button></td> 
							</tr>
						</table> 
					</form>
					</div>
					
					<div class="red">
					<form id="Vrsta" action="#" method ="POST">
						<table id="adminJelo">
							<tr> 
								<td><a href="adminJelovnik.php?q=vrsta" name="ispisVrsta"> Prikazi sve vrste </a> </td> 
								<td> <input type='number' name='idVrsteBrisanje'> </td>
								<td><button type="submit" name="brisanjeVrste" value="Submit"> Brisanje vrste </button></td> 
							</tr>
						</table> 
					</form>
					</div>
					
					<div class="red">
					<form id="Vrsta" action="#" method ="POST">
						<table id="adminJelo">
							<tr> 
								<td><a href="adminJelovnik.php?q=sastojak" name="ispisSastojaka"> Prikazi sve sastojke </a> </td>
								<td> <input type='number' name='idSastojkaBrisanje'> </td>
								 <td><button type="submit" name="brisanjeSastojka" value="Submit"> Brisanje sastojka </button></td> 
							</tr>
						</table> 
					</form>
					</div>
					
					<div class="red">
					<form id="Vrsta" action="#" method ="POST">
						<table id="adminJelo">
							<tr> 
								 <td><a href="adminJelovnik.php?q=veza" name="ispisVeza"> Prikazi sve Veze </a> </td> 
								<td> <input type='number' name='idVezeBrisanje'> </td>
								<td><button type="submit" name="brisanjeVeze" value="Submit"> Brisanje sastojka iz stavke </button></td> 							</tr>
						</table> 
					</form>
					</div>
				</div>

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
 </body>
</html>

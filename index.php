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
	 <?php include('createXML.php') ?>
	  <?php include('login_skripta.php') ?>
	 
	  
<div class="container">


	<div id="prijava">
		<div class = "red"> 
			<a href="#" onclick="otvori('login')"> Admin Log In &nbsp </a> 
		</div>
		
		<div class = "red">
			<form action="#" method="POST"> <?php echo $button;  echo $tekstPrijave;  ?>  </form>
			<?php 
				$stranica = "'index.html'";
				if ($tekstPrijave != '')
					echo '<a href="uredi.php" name="uredi"> Uredi &nbsp </a>';
			?>
			
		</div>
		
	</div>
	
	
	<div id="traka"></div>
	<div class="red zaglavlje">
		<div class="kolona logo"> 
			<a href="#" onclick="otvori('Pocetna')">
				<img src="./../Foto/logo.jpg" width="196px" height="130px"></a>
			<div class="red"> Caffe & Pizzeria </div>
		</div>
		<div class="kolona meni">
		<img id="meniButton" src="./../Foto/hambaspng.png" width="50px" height="50px" onclick="prikaziMeni()">
			<ul id="meniLista" class="meniKlasa">			
				<li>|<a href="#" id = "aktivniLink" onclick="otvori('Pocetna')" >  Početna  </a>|</li>
				<li>|<a href="#" onclick="otvori('Novosti')">  Novosti  </a>|</li>
				<li>|<a href="#" onclick="otvori('Galerija')">  Galerija  </a>|</li>
				<li>|<a href="#" onclick="otvori('Cjenovnik')">  Cjenovnik  </a>|</li>
				<li>|<a href="#" onclick="otvori('Rezervacije')">  Rezervacije  </a>|</li>
				<li>|<a href="#" onclick="otvori('Kontakt')">   Kontakt  </a>|</li>
			</ul>		
		</div>
	</div>
	<div id="traka"></div>
	
	<div class="glavni">
		<div class="red"></div>
			<div class="col8"> 
				<img id="pocetna" src="./../Foto/izbor0.jpeg">
			</div>
			<div class="col4"> 
				 <div class="red"> <p> <a target="_blank" href="./../Foto/Stranica.png">  <button name="naruci">Naruči online</button> </a></p></div>
				 <div class="red"> <img src="./../Foto/izbor2.jpg"> </div>
				 <div class="red"> <img src="./../Foto/dostava.jpg"> </div>
				 <div class="red"> <p> <a href="#" onclick="otvori('Cjenovnik')"> <button name="naruci">Meni</button> </a> </p></div>
				
			</div>
	</div>
	<div id="otvorenaSlikaBox">
		<img id="odabranaSlika">
		<p onclick="ZatvoriSliku()"> Zatvori </p>
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
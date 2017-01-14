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
	    <?php include('xmlBaza.php') ?>
	
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
				<li>|<a href="index.php#">  Nazad </a>|</li>
			</ul>		
		</div>
	</div>
	<div id="traka"></div>
	
	<div class="glavni">
		<div class = "red"></div>
		<div class = "red" > 
			<div class = "col4"></div>
			<div class = "col2">
				<div class = "red"  align="center" > Download CSV: </div>
				<div class = "red" >  <a href="csv.php" > <img  src="./../Foto/csv.png" width ='60px' height="60px"> </a> </div>
			</div>
			<div class = "col2">
			 <div class = "red" align="center"> PDF Izvještaj:  </div>
			<a href="pdf.php" > <img src="./../Foto/pdf.png" width ='60px' height="60px"> </a> 
			</div>
			<div class = "col4"> 
				<form action="#" method="POST">
				<button type="submit" name="uBazuButton" value="submit" > Xml u Bazu</button></div>
				</form>
		</div>
		<div class = "col4"></div>
		
		<div class = "col4">
				<div class = "red">
				<form id = "AdminRezervacije" action="adminRezervacije.php" method="POST" >
					<button type="submit" name="rezervacijeButton" value='prikazi' >Prikazi rezervacije</button> 
				</form>
				</div>
				<div class = "red">
				<form id = "AdminOcjene" action="adminOcjene.php" method="POST">
					<button type="submit" name="ocjeneButton" value="Submit" >Prikazi ocjene</button> 
				</form>
				</div>
				<div class = "red">
				<form id = "AdminMailovi" action="adminMailovi.php" method="POST">    
					<button type="submit" name="mailButton" value="Submit" >Prikazi mailove</button> 
				</form>
				</div>
				<div class = "red"> 
				<form id ="AdminNovosti" action = "adminNovosti.php" method = "POST">
					<button type="submit" name="novostiButton" value="Submit"> Prikazi novosti </button>
				</form>
				</div>
				<div class = "red"> 
				<form id ="AdminJelovnik" action = "adminJelovnik.php" method = "POST">
					<button type="submit" name="jelovnikButton" value="Submit"> Uredi jelovnik </button>
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
</BODY>
</HTML>
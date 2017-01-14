<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Simple Sefte</TITLE>
<link rel="stylesheet" type="text/css" href="stil2.css">
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<SCRIPT src="./../Scripts/PrikaziMeni.js"></SCRIPT>
</HEAD>
<BODY>

		<div class="red"> <h1> Cjenovnik </h1> <img src="./../Foto/izbor4.png"></div>
		<div id="traka"></div>
		<div class="col6">  <img src="./../Foto/meni1.jpg" onclick="OtvoriSliku(this)"> </div>
		<div class="col6">  <img src="./../Foto/meni2.jpg" onclick="OtvoriSliku(this)"> </div>	
			<?php 
				$veza = new PDO("mysql:dbname=simpleseftedb; host=mysql-55-centos7; charset=utf8", "wtuser", "sifra");
				$veza->exec("set names utf8");
			
				$vrste = $veza->query("select id, naziv from vrsta");
				$sastojaks = $veza->query("select id, naziv from sastojak");
				$sastojci = $veza->query("select id_stavke, id_sastojka from sastojci");
			?>		
		<div class = "red"> 
			<?php 
			//	if(sizeof($vrste) > 0)
				//{
					$vrste = $veza->query("select id, naziv from vrsta");
					print " <div class='red'> <h3> <div class='col4'> Stavka </div> <div class= 'col2'> Cijena </div> <div class='col6'> Sastav/Dodaci </div> </h3> </div>";
					foreach ($vrste->fetchAll() as $v) 
					{
						print "<h3>" . $v['naziv'] . "</h3>" ;
						$idV = $v['id'];
						$stavke=$veza->prepare("select * from stavka where id_vrste=?");
						$stavke->bindValue(1,$idV, PDO::PARAM_INT);
						$stavke->execute();
						$ispis = "";
						if (sizeof($stavke) > 0)
						{
							foreach ($stavke->fetchAll() as $s)
							{
								$ispis .= " <div class='red'> <div class='col4'>" . $s['naziv'] . "</div> <div class= 'col2'>" . $s['cijena'] . " KM </div> <div class='col6'>";
								
								$sastojci=$veza->prepare("select * from sastojci where id_stavke=?");
								$sastojci->bindValue(1,$s['id'], PDO::PARAM_INT);
								$sastojci->execute();
								
								$k = 1;
								foreach($sastojci->fetchAll() as $sas)
								{
									if ($k > 1) $ispis .= ", ";
									$sastojaks=$veza->prepare("select naziv from sastojak where id=?");
									$sastojaks->bindValue(1,$sas['id_sastojka'], PDO::PARAM_INT);
									$sastojaks->execute();
									
									foreach($sastojaks->fetchAll() as $sastojak)
										$ispis .= $sastojak['naziv'] . " ";
									$k = $k +1;
								}
								$ispis .=  "</div> </div>";
		
							}
							echo $ispis . " <br> <div class='red'> </div>" ;
						}
					}
					
				// }
			?>

		</div>
		
</BODY>
</HTML>
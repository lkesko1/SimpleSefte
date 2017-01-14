<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Simple Sefte Novosti</TITLE>
<link rel="stylesheet" type="text/css" href="stil2.css">
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<SCRIPT src="./../Scripts/Validacija.js"></SCRIPT>
<SCRIPT src="./../Scripts/PrikaziMeni.js"></SCRIPT>
</HEAD>
<BODY>
			<div class="red">  <h1>Novosti</h1> 	</div>
			<div class="col3"> <img src="./../Foto/naslovna.jpg">  </div>
			<?php 
								//if (file_exists("Novosti.xml"))
								try
								{
									$veza = new PDO("mysql:dbname=simpleseftedb; host=localhost; charset=utf8", "wtuser", "sifra");
									$veza->exec("set names utf8");
									$upit = $veza->prepare("select * from Novost order by id desc");
									$upit->execute();
									$textovi = $upit->fetchAll();
									$n1 = "";
									$n2 = "";
									$n3 = "";
									if (sizeof($textovi)>=3)
									{
										$id1 = sizeof($textovi);
										$id2 = sizeof($textovi)-1;
										$id3 = sizeof($textovi)-2;
										$text1 = $veza->prepare("select tekst from novost where id =?");
										$text1->bindParam(1, $id1, PDO::PARAM_INT);
										$text1->execute();
										$text2 = $veza->prepare("select tekst from novost where id =?");
										$text2->bindParam(1, $id2, PDO::PARAM_INT);
										$text2->execute();
										$text3 = $veza->prepare("select tekst from novost where id =?");
										$text3->bindParam(1, $id3, PDO::PARAM_INT);
										$text3->execute();
										
										while($r = $text1->fetch()) 
											$n1 = $r['tekst'];
										while($r = $text2->fetch()) 
											$n2 = $r['tekst'];
										while($r = $text3->fetch()) 
											$n3 = $r['tekst'];
										
										
									}
									else if (sizeof($textovi)==2)
									{
										$id1 = sizeof($textovi);
										$id2 = sizeof($textovi)-1;
										$text1 = $veza->prepare("select tekst from Novost where id =?");
										$text1->bindParam(1, $id1, PDO::PARAM_INT);
										$text1->execute();
										$text2 = $veza->prepare("select tekst from Novost where id =?");
										$text2->bindParam(1, $id2, PDO::PARAM_INT);
										$text2->execute();
								
										while($r = $text1->fetch()) 
											$n1 = $r['tekst'];
										while($r = $text2->fetch()) 
											$n2 = $r['tekst'];
									}
									else if (sizeof($textovi)==1)
									{
										$id1 = sizeof($textovi);
										$text1 = $veza->prepare("select tekst from Novost where id =?");
										$text1->bindParam(1, $id1, PDO::PARAM_INT);
										$text1->execute();
								
										while($r = $text1->fetch()) 
											$n1 = $r['tekst'];
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
								/*	$fajl = new SimpleXMLElement("Novosti.xml",null,true);
									$textovi = array();
									foreach($fajl->Novost as $n)
										array_push($textovi, $n);
									$n1 = "";
									$n2 = "";
									$n3 = "";
									if (sizeof($textovi)>=3)
									{
										$n1 = $textovi[sizeof($textovi)-1];
										$n2 = $textovi[sizeof($textovi)-2];
										$n3 = $textovi[sizeof($textovi)-3];
									}
									else if (sizeof($textovi)==2)
									{
										$n1 = $textovi[sizeof($textovi)-1];
										$n2 = $textovi[sizeof($textovi)-2];
									}
									else if (sizeof($textovi)==1)
										$n1 = $textovi[sizeof($textovi)-1];*/
									
									
			?>
			<div class="col6">
				<div class ="red boks">
						<P>
							<?php echo $n1; ?>				
						
						</P>
				</div>
				<div class ="red boks">
					<P> 	<?php echo $n2; ?>				
						</P>
				</div>
				<div class ="red boks">
					<P>	<?php echo $n3; ?>				
						</P>		
				</div>
			</div>
			<div class="col3">  
				<img src="./../Foto/donerP.jpg">
				<div class="red">
				<form action="#" id="mfidOcjena" onsubmit="return validateFormOcjena()" method="POST">
					<div class="boks">
					Ocijenite nas: <br> <br>
					<div class="red"> <input type="radio" name="ocjena" value="1">1 <br></div>
					<div class="red"><input type="radio" name="ocjena" value="2">2<br></div>
					<div class="red"><input type="radio" name="ocjena" value="3">3<br></div>
					<div class="red"><input type="radio" name="ocjena" value="4">4<br></div>
					<div class="red"><input type="radio" name="ocjena" value="5">5<br><br></div>
					<div class="red">  <p id="GreskaText" class="Validacija" > <img src="./../Foto/icon-error.png" width="25px" height="25px"> Odaberite ocjenu! </p> </div>
						<button type="submit" value="Submit" name="ocjenaButton">Pošalji</button>
					
					</div>
				</form>
				</div>
			</div>
</BODY>
</HTML>
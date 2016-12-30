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
								if (file_exists("Novosti.xml"))
								{
									$fajl = new SimpleXMLElement("Novosti.xml",null,true);
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
										$n1 = $textovi[sizeof($textovi)-1];
									
								}
									
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
ž<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Simple Sefte Kontakt</TITLE>
<link rel="stylesheet" type="text/css" href="stil2.css">
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<SCRIPT src="./../Scripts/Validacija.js"></SCRIPT>
<SCRIPT src="./../Scripts/PrikaziMeni.js"></SCRIPT>
</HEAD>
<BODY>
		<div class="red"> <h1> Kontakt </h1> </div>
			<div class="col8">
				<form  action="#" class="boxPozadina" id="mfidMail" onsubmit="return validateFormMail()" method="POST">
					<P>Kontaktirajte nas. Pošaljite nam mail i saznajte sve što vas zanima ili ostavite vaše utiske. </P> <br> <br>
							<div class = "red">
								<div class="col4" > Ime i prezime:</div>
								<div class="col8" > <input  type="text" name="ime" class="required"> 
									<p id="GreskaIme" class="Validacija"> Ime ne smije sadržavati brojeve i sastoji se od dvije riječi! </p> 
								</div>
							</div>
							<div class = "red">
								<div class="col4" > Email:</div>
								<div class="col8" >  <input  type="text" name="mail" class="required">  
									<p id="GreskaMail" class="Validacija"> Format maila: characters@characters.domain </p> 
								</div>
							</div>
							<div class = "red" >
								<div class="col4" > Subject:</div>
								<div class="col8" >  <input  type="text" name="subject" class="required" onclick="provjeriMail()">
									<p id="GreskaSubject" class="Validacija"> Potrebno je unijeti subject. </p> 
								</div>
							</div>
							<div class = "red" >
								<div class="col4" > Poruka:</div>
								<div class="col8" >  <input  type="text" name="mailtekst" class="required"> 
									<p id="GreskaPoruka" class="Validacija"> Unesite Vašu poruku! </p> 
								</div>
							</div>
							<div class = "red">
								<div class="col4" > </div>
								<div class="col8" >  <p id="GreskaText" class="Validacija" > <img src="./../Foto/icon-error.png" width="25px" height="25px"> Potrebno je ispuniti označena polja! </p>  </div>
							</div>
							<div class = "red">
								<div class="col4" > </div>
								<div class="col8" >  <button type="submit" value="Submit" name="mailButton">Pošalji</button>  </div>
							</div>
				</form>	
			</div>
		
			<div class="col4">
					
						<div class = "red boxPozadina"> Kontakt telefon: <br> 061-300-302 <br> 062-512-700 </div>
						<div class="red boxPozadina" > <P>Naći ćete nas na adresi: <br><b> Pehlivanuša br. 2, 71000 Sarajevo	</b> </p> </div>
						<div class = "red"> <img src="./../Foto/dostava.jpg"> </div>
						<div class = "red boxPozadina" > Pratite nas na društvenim mrežama: <br> 
		
							<a href="https://www.facebook.com/sefte.sarajevo/">  <img src="./../Foto/fbicon.jpg"></a> 
							<a href="https://www.instagram.com/"> <img src="./../Foto/instaicon.png"> </a>
						</div>								
			</div>
			<div class="red">
				<div class="col8">
				Lokacija:<br>
				<a href="https://www.google.ba/maps?espv=2&biw=1164&bih=586&bav=on.2,or.&bvm=bv.137904068,d.bGg&ion=1&q=simple+sefte&um=1&ie=UTF-8&sa=X&ved=0ahUKEwjfx_rUu5DQAhVlCMAKHRD1AmkQ_AUICCgD"><img src="./../Foto/lokacija.jpg"> </a>
				</div>
				<div class="col4"></div>
			</div>
</BODY>
</HTML>
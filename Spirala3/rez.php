<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Simple Sefte Rezervacije</TITLE>
<link rel="stylesheet" type="text/css" href="stil2.css">
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <SCRIPT src="./../Scripts/Validacija.js"></SCRIPT>
 <SCRIPT src="./../Scripts/PrikaziMeni.js"></SCRIPT>
</HEAD>
<BODY>

	<form action="#" id="mfid" onsubmit="return validateFormRezervacija()" method="POST">
		<img src="./../Foto/marg-pizza.png">
		<div class="red"> <h1> Rezervacije</h1> </div>
		<div class="red"> 
			<div class="kolona dva txt"> Ime i prezime:    * </div> 
			<div class="kolona dva"> <input  type="text" name="ime" class="required">  
				<p id="GreskaIme" class="Validacija"> Ime ne smije sadržavati brojeve i sastoji se od dvije riječi! </p> 
			</div>
		</div>
		<div class="red"> 
			<div class="kolona dva txt">Broj telefona:    * </div>
			<div class="kolona dva"> <input  type="tel" name="tel" class="required">
				<p id="GreskaTel"  class="Validacija"> Telefon format: (061)-123-345 ili 061-123-456 ili 061123456 </p> 
			</div>
		</div>
		<div class="red"> 
			<div class="kolona dva txt"> Datum:    * </div>
			<div class="kolona dva"> <input  type="date" name="date" class="required" >  
				<p id="GreskaDatum" class="Validacija"> Datum nije validan! </p>  
			</div>
		</div>
		<div class="red"> 
			<div class="kolona dva txt">Vrijeme:    *</div> 
			<div class="kolona dva"> <input  type="time" name="vrijeme" class="required" min="10:00" max="21:30"> </div>
		</div>
		<div class="red"> 
			<div class="kolona dva txt">Broj osoba (1-15):   *</div> 
			<div class="kolona dva"> <input  type="number" name="osobe" min="1" max="15" step="1" class="required"> 
				<p id="GreskaOsobe"  class="Validacija"> Broj osoba mora biti izmedju 1 i 15! </p> 
			</div>
		</div>
		<div class="red"> 
			<div class="kolona dva txt">Napomena:  </div>
			<div class="kolona dva"><input  type="text" name="napomenatekst">  </div>
		</div>
		<div class="red">  
			<div class= "kolona dva"></div>
			<div class= "kolona dva"> <p id="GreskaText" class="Validacija" > <img src="./../Foto/icon-error.png" width="25px" height="25px"> Potrebno je ispuniti označena polja! </p> </div>
		</div>
		<div class="red">  
			<div class= "kolona dva"></div>
			<div class= "kolona dva"> <button type="submit" name="buttonRezervacija" value="Submit" >Pošalji</button> </div>
		</div>
		
	</form>
</BODY>
</HTML>
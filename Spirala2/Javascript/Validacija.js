
function validateFormRezervacija() {
	var val = document.getElementsByClassName("Validacija");
	var i;
	for (i = 0; i < val.length; i++){
		val[i].style.display="none";
		val[i].style.color="Maroon";
		val[i].style.fontWeight="bold";
		val[i].style.backgroundColor="#FFBABA";
	}
	
	document.getElementsByName('date')[0].valueAsDate = new Date();
    var x = document.getElementsByClassName('required');
	var greska = document.getElementById('GreskaText');
	var bool = 0; /*za detekciju greske*/
	var i;
	var ime = document.getElementsByName('ime')[0];
	/*var reTel = /^06[0-2]-[0-9]{3}-[0-9]{3,4}$/;*/
	var telefonRegEx = /^\(?(\d{3})\)?[-]?(\d{3})[-]?(\d{3})$/;
	var forma=document.getElementById('mfid');
	var imeRegex = /^[A-Za-z]+\s[A-Za-z]+$/;

	for (i = 0; i < x.length; i++)
	{
		if (x[i].value == "" || x[i].value==null || (forma['date'] == x[i] && forma['date'].valueAsDate < new Date()) || ((!telefonRegEx.test(forma['tel'].value)) && x[i]==forma['tel']) || ((!imeRegex.test(forma['ime'].value)) && x[i]==forma['ime'])) {
			x[i].style.borderColor="red";
			x[i].style.border = "3px groove red";
			bool = 1;
			if ((!imeRegex.test(forma['ime'].value)) && x[i]==forma['ime']){
				document.getElementById('GreskaIme').style.display="block";	
			}
			else if ((!telefonRegEx.test(forma['tel'].value)) && x[i] == forma['tel']){
				document.getElementById('GreskaTel').style.display="block";
			}
			else if (forma['date'] == x[i] && forma['date'].valueAsDate < new Date()){
				document.getElementById('GreskaDatum').style.display="block";
			}	
			else if (forma['osobe'] == x[i]){
				document.getElementById('GreskaOsobe').style.display="block";
			}
			
			
		}
		else {
			x[i].style.backgroundColor="white";
			x[i].style.borderColor="#0099cc";
			if (forma['date'] == x[i]){
				document.getElementById('GreskaDatum').style.display="none";
			}
			else if (forma['osobe'] == x[i]){
				document.getElementById('GreskaOsobe').style.display="none";
			}
			else if (x[i] == forma['tel']){
				document.getElementById('GreskaTel').style.display="none";
			}
			else if(x[i] == forma['ime']){
				document.getElementById('GreskaIme').style.display="none";	
			}
		}	
	} 
	if (Boolean(bool))
	{
		greska.style.display="block";
		greska.style.textAlign="center";
		return false;
	}
	greska.style.display="none";
	return true;
}



function validateFormOcjena() {
	var val = document.getElementsByClassName("Validacija");
	var i;
	for (i = 0; i < val.length; i++){
		val[i].style.display="none";
		val[i].style.color="Maroon";
		val[i].style.fontWeight="bold";
		val[i].style.backgroundColor="#FFBABA";
	}
	
	var x = document.getElementsByName("ocjena");
	var greska = document.getElementById("GreskaText");
	var i;
	var bool = 1; /* Za pocetak stavljamo da je false, da nista nije cekirano. */ 
	var forma=document.getElementById("mfidOcjena");
	for (i = 0; i < x.length; i++){
		if (x[i].checked == true){
			bool = 0; /* Ako je jedan chekiran, bool ce se promijeniti */
			break;
		}
	}
	if (Boolean(bool)) /*Ako je ostao bool = 1, ispisuje se greska */
	{
		greska.style.display="inline-block";
		greska.style.textAlign="center";
		greska.style.width = "100%";
		return false;
	}
	greska.style.display="none";
	return true;
}




function validateFormMail() {
		var val = document.getElementsByClassName("Validacija");
	var i;
	for (i = 0; i < val.length; i++){
		val[i].style.display="none";
		val[i].style.color="Maroon";
		val[i].style.fontWeight="bold";
		val[i].style.backgroundColor="#FFBABA";
	}
	
    var x = document.getElementsByClassName('required');
	var greska = document.getElementById('GreskaText');
	var bool = 0; /*za detekciju greske*/
	var i;
	var forma=document.getElementById('mfidMail');
	var imeRegex = /^[A-Za-z]+\s[A-Za-z]+$/;
	var mailRegex = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;

	for (i = 0; i < x.length; i++)
	{
		if (x[i].value == "" || x[i].value==null || ((!mailRegex.test(forma['mail'].value)) && x[i]==forma['mail']) || ((!imeRegex.test(forma['ime'].value)) && x[i]==forma['ime'])) {
			x[i].style.borderColor="red";
			x[i].style.border = "3px groove red";
			bool = 1;
			if ((!imeRegex.test(forma['ime'].value)) && x[i]==forma['ime']){
				document.getElementById('GreskaIme').style.display="block";	
			}
			else if ((!mailRegex.test(forma['mail'].value)) && x[i] == forma['mail']){
				document.getElementById('GreskaMail').style.display="block";
			}
			else if (forma['subject'] == x[i]){
				document.getElementById('GreskaSubject').style.display="block";
			}
			else if (forma['napomena'] == x[i]){
				document.getElementById('GreskaPoruka').style.display="block";
			}
			
		}
		else {
			x[i].style.backgroundColor="white";
			x[i].style.borderColor="#0099cc";
			if(x[i] == forma['ime']){
				document.getElementById('GreskaIme').style.display="none";	
			}
			else if (forma['mail'] == x[i]){
				document.getElementById('GreskaMail').style.display="none";
			}
			else if (x[i] == forma['subject']){
				document.getElementById('GreskaSubject').style.display="none";
			} 
			else if (forma['napomena'] == x[i]){
				document.getElementById('GreskaPoruka').style.display="none";
			}
		}	
	} 
	if (Boolean(bool))
	{
		greska.style.display="block";
		greska.style.textAlign="center";
		return false;
	}
	greska.style.display="none";
	return true;
}



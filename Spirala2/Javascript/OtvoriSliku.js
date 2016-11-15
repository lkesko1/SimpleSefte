
function OtvoriSliku(reference){
	var x = reference.src;
	var slika = document.getElementById('odabranaSlika');
	var box = document.getElementById('otvorenaSlikaBox');
	
	slika.src = x;
	box.style.display="block";	
}

function ZatvoriSliku(){
	document.getElementById('otvorenaSlikaBox').style.display = "none";
	/*document.getElementById('odabranaSlika').style.display = "none";*/
}
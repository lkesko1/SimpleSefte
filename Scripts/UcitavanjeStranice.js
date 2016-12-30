function otvori(stranica) {
	var ajax;
	if (window.XMLHttpRequest) {
		ajax = new XMLHttpRequest();
	} else {
		ajax = new ActiveXObject("Microsoft.XMLHTTP");
	}
    ajax.onreadystatechange = function () {
		if (ajax.readyState == 4 && ajax.status == 200){
			document.getElementsByClassName("glavni")[0].innerHTML = ajax.responseText;
		}
		if (ajax.readyState == 4 && ajax.status == 404){
			document.getElementsByClassName("glavni")[0].innerHTML = stranica;
		}
    }
	
	var x = document.getElementById("aktivniLink");
	x.id="";
	
    if (stranica === 'Pocetna') {
        ajax.open("POST", "pocetna.php", true);
        ajax.send();
		
		var stranica = document.getElementsByTagName('li')[0];
		var linkStranice = stranica.getElementsByTagName("a")[0];
		linkStranice.id = "aktivniLink";
    }
    if (stranica === 'Novosti') {
        ajax.open("POST", "novosti.php", true);
        ajax.send();
		var stranica = document.getElementsByTagName('li')[1];
		var linkStranice = stranica.getElementsByTagName("a")[0];
		linkStranice.id = "aktivniLink";
    }
	if (stranica === 'Galerija') {
        ajax.open("POST", "galerija.php", true);
        ajax.send();
	
		var stranica = document.getElementsByTagName('li')[2];
		var linkStranice = stranica.getElementsByTagName("a")[0];
		linkStranice.id = "aktivniLink";
    }
	if (stranica === 'Cjenovnik') {
        ajax.open("POST", "cjenovnik.php", true);
        ajax.send();
		
		var stranica = document.getElementsByTagName('li')[3];
		var linkStranice = stranica.getElementsByTagName("a")[0];
		linkStranice.id = "aktivniLink";
    }
  
	if (stranica === 'Rezervacije') {
        ajax.open("POST", "rez.php", true);
        ajax.send();
		
		var stranica = document.getElementsByTagName('li')[4];
		var linkStranice = stranica.getElementsByTagName("a")[0];
		linkStranice.id = "aktivniLink";
     }
	if (stranica === 'Kontakt') {
        ajax.open("POST", "kontakt.php", true);
        ajax.send();
		
		var stranica = document.getElementsByTagName('li')[5];
		var linkStranice = stranica.getElementsByTagName("a")[0];
		linkStranice.id = "aktivniLink";
    }
	if (stranica === 'uredjivanje') {
        ajax.open("POST", "uredi.php", true);
        ajax.send();
		var linkStranice = document.getElementsByName('uredi')[0];
		linkStranice.value = "Lejla";
		linkStranice.id = "aktivniLink";
    }
	if (stranica === 'login') {
        ajax.open("POST", "login.php", true);
        ajax.send();
		var linkStranice = document.getElementsByTagName("a")[0];
		linkStranice.id = "aktivniLink";
    }
	var lista = document.getElementById('meniLista');
	lista.className = "meniKlasa";
}



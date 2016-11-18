function otvori(stranica) {
    var ajax = new XMLHttpRequest();
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
        ajax.open("POST", "pocetna.html", true);
        ajax.send();
		
		var stranica = document.getElementsByTagName('li')[0];
		var linkStranice = stranica.getElementsByTagName("a")[0];
		linkStranice.id = "aktivniLink";

    }
    if (stranica === 'Novosti') {
        ajax.open("POST", "novosti.html", true);
        ajax.send();
	
		var stranica = document.getElementsByTagName('li')[1];
		var linkStranice = stranica.getElementsByTagName("a")[0];
		linkStranice.id = "aktivniLink";
    }
	if (stranica === 'Galerija') {
        ajax.open("POST", "galerija.html", true);
        ajax.send();
	
		var stranica = document.getElementsByTagName('li')[2];
		var linkStranice = stranica.getElementsByTagName("a")[0];
		linkStranice.id = "aktivniLink";
    }
	if (stranica === 'Cjenovnik') {
        ajax.open("POST", "cjenovnik.html", true);
        ajax.send();
		
		var stranica = document.getElementsByTagName('li')[3];
		var linkStranice = stranica.getElementsByTagName("a")[0];
		linkStranice.id = "aktivniLink";
    }
  
	if (stranica === 'Rezervacije') {
        ajax.open("POST", "rez.html", true);
        ajax.send();
		
		var stranica = document.getElementsByTagName('li')[4];
		var linkStranice = stranica.getElementsByTagName("a")[0];
		linkStranice.id = "aktivniLink";
     }
	if (stranica === 'Kontakt') {
        ajax.open("POST", "kontakt.html", true);
        ajax.send();
		
		var stranica = document.getElementsByTagName('li')[5];
		var linkStranice = stranica.getElementsByTagName("a")[0];
		linkStranice.id = "aktivniLink";
    }
	var lista = document.getElementById('meniLista');
	lista.className = "meniKlasa";
}


function otvoriIndex(stranica) {
	var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200)
            document.getElementsByClassName("glavni")[0].innerHTML = ajax.responseText;
		if (ajax.readyState == 4 && ajax.status == 404){
			document.getElementsByClassName("glavni")[0].innerHTML = stranica;
		}
		var linkovi = document.getElementsByTagName("a");
        ajax.open("POST", "index.html", true);
        ajax.send();
		if (stranica === 'Cjenovnik') otvori('Cjenovnik');
		
	}		
}

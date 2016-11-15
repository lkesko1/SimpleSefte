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
    if (stranica === 'Pocetna') {
        ajax.open("POST", "pocetna.html", true);
        ajax.send();
    }
    if (stranica === 'Novosti') {
        ajax.open("POST", "novosti.html", true);
        ajax.send();
    }
	if (stranica === 'Cjenovnik') {
        ajax.open("POST", "cjenovnik.html", true);
        ajax.send();
    }
    if (stranica === 'Galerija') {
        ajax.open("POST", "galerija.html", true);
        ajax.send();
    }
	if (stranica === 'Rezervacije') {
        ajax.open("POST", "rez.html", true);
        ajax.send();
     }
	if (stranica === 'Galerija') {
        ajax.open("POST", "galerija.html", true);
        ajax.send();
    }
	if (stranica === 'Kontakt') {
        ajax.open("POST", "kontakt.html", true);
        ajax.send();
    }
}


function otvoriIndex(stranica) {
	var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200)
            document.getElementsByClassName("glavni")[0].innerHTML = ajax.responseText;
		if (ajax.readyState == 4 && ajax.status == 404){
			document.getElementsByClassName("glavni")[0].innerHTML = stranica;
			var linkovi = document.getElementsByTagName("a");
            ajax.open("POST", "index.html", true);
            ajax.send();
			if (stranica === 'Cjenovnik') ucitaj("Cjenovnik");
		}
	}		
}

function prikaziMeni() {
    var lista = document.getElementById('meniLista');
	switch(lista.className){
		case "meniKlasa": 
			lista.className = "meniKlasa otvoren";
			break;
		case "meniKlasa otvoren": 
			lista.className = "meniKlasa";
			break;
	}
}
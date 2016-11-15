I  - Šta je uraðeno?
-Uraðena je validacija sljedeæih formi:
1) Forma na podstranici Novosti, mora biti ocjenjenja. Ukoliko nije, javlja se greška iznad buttona i dugme za slanje je onemoguæeno.
2) Sva polja forme na podstranici Rezervacije su validirana, na naèin da sva zahtjevana polja (sa zvjezdicom) moraju biti unesena. Ukoliko postoje greške ispod svakog pogrešno unesenog polja se javlja odgovarajuæa poruka, a nevalidna polja ogranièe se crvenom bojom. Za ime je napravljen kraæi regex, da se ime mora sastojati od barem dvije rijeèi i da ne smije sadržavati slova. Za polje broj telefona, je uraðen regex za format telefona. Za DatePicker je izvršena validacija da izabrani datum ne smije biti manji od današnjeg. Za polje vrijeme, postavljene su odreðene granice. Isto to je uraðeno za polje Broj Osoba, gdje je potrebno unijeti broj izmeðu 1 i 15. 
Polje Napomena nije validirano jer je to opcionalno polje.
3) Forma na podstranici Kontakt je validirana na naèin da polja moraju biti unesena. Za polje e-mail, imam odgovarajuæi regex. Za polje korišten je regexx kao u formi 2) i validirano je polje Subject. 
Odgovarajuæe poruke se prikažu ispod svakog pogrešno unesenog polja, a iznad buttona se dobije obavještenje da oznaèena polja moraju biti unesena. Sve dok postoje greške Buttoni su onemoguæeni. 

- Uraðen je dropdown meni za mobitele u vidu slike za padajuæu listu. Padajuæa lista izgleda kao prethodna verzija menija na mobitelu. 
- Uraðena je galerija u sklopu Spirale 1, a sada sam omoguæila otvaranje slike u odgovarajuæim dimenzijama. Slika se zatvara na tekst "Zatvori".

- Korišten je Ajax kako se stranice ne bi osvježavale prilikom klika na linkove iz menija. To je isto uraðeno za button na poèetnoj stranici, koji vodi na Meni.


II  - Šta nije uraðeno?
Nisu uraðene boje da se mijenja za svaki link, kako bi oznaèilo na kojoj se podstranici korisnik nalazi.
 
III i IV - Bugovi
- Kod DatePickera na formi podstranice Rezervacije, vraæa grešku i ukoliko se unese trenutni datum. 

V  - Lista fajlova 
Folder Spirala 2: 
	-Stil2.css - css za html stranice
	1. Javascript - Folder u kojem se nalaze skripte. Napravljene su 4 skripte kako bi ih razvrstala:
		a) Validacija - sadrži tri funkcije, za 3 forme;
		b) PrikaziMeni - sadrži funkciju za prikaz dropdown menija;
		c) OtvoriSliku - sadrži funkciju za otvaranje slike;
		d) UcitavanjeStranice - sadrži 2 funkcije: za otvaranje stranica putem indexa i za otvaranje odgovarajuæe stranice putem buttona Meni;
	2. HTML - Folder sa svim html podstranicama: 
		- index.html - poèetna stranica sa zaglavljem i podnožjem, kao i dijelom u koji se unose sadržaji stranica pobrojanih ispod;
		a) pocetna.html - pocetna stranica na kojoj se nalaze pojedine slike i buttoni ;
		b) novosti.html - stranica koja nudi posljednje novosti vezane za lokal (obavještenja i sl.) i moguænost ocjenjivanja;
		c) galerija.html - stranica koja nudi slike vezane za lokal;
		d) cjenovnik.html - stranica sa menijem pizzerije ;
		e) rezervacije.html - stranica koja sadrži formu za rezervisanje mjesta;
		f) kontakt.html - stranica koja sadrži sve informacije kako pronaæi lokal i kako ih kontaktirati;
	


 
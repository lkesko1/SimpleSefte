I  - �ta je ura�eno?
-Ura�ena je validacija sljede�ih formi:
1) Forma na podstranici Novosti, mora biti ocjenjenja. Ukoliko nije, javlja se gre�ka iznad buttona i dugme za slanje je onemogu�eno.
2) Sva polja forme na podstranici Rezervacije su validirana, na na�in da sva zahtjevana polja (sa zvjezdicom) moraju biti unesena. Ukoliko postoje gre�ke ispod svakog pogre�no unesenog polja se javlja odgovaraju�a poruka, a nevalidna polja ograni�e se crvenom bojom. Za ime je napravljen kra�i regex, da se ime mora sastojati od barem dvije rije�i i da ne smije sadr�avati slova. Za polje broj telefona, je ura�en regex za format telefona. Za DatePicker je izvr�ena validacija da izabrani datum ne smije biti manji od dana�njeg. Za polje vrijeme, postavljene su odre�ene granice. Isto to je ura�eno za polje Broj Osoba, gdje je potrebno unijeti broj izme�u 1 i 15. 
Polje Napomena nije validirano jer je to opcionalno polje.
3) Forma na podstranici Kontakt je validirana na na�in da polja moraju biti unesena. Za polje e-mail, imam odgovaraju�i regex. Za polje kori�ten je regexx kao u formi 2) i validirano je polje Subject. 
Odgovaraju�e poruke se prika�u ispod svakog pogre�no unesenog polja, a iznad buttona se dobije obavje�tenje da ozna�ena polja moraju biti unesena. Sve dok postoje gre�ke Buttoni su onemogu�eni. 

- Ura�en je dropdown meni za mobitele u vidu slike za padaju�u listu. Padaju�a lista izgleda kao prethodna verzija menija na mobitelu. 
- Ura�ena je galerija u sklopu Spirale 1, a sada sam omogu�ila otvaranje slike u odgovaraju�im dimenzijama. Slika se zatvara na tekst "Zatvori".

- Kori�ten je Ajax kako se stranice ne bi osvje�avale prilikom klika na linkove iz menija. To je isto ura�eno za button na po�etnoj stranici, koji vodi na Meni.


II  - �ta nije ura�eno?
Nisu ura�ene boje da se mijenja za svaki link, kako bi ozna�ilo na kojoj se podstranici korisnik nalazi.
 
III i IV - Bugovi
- Kod DatePickera na formi podstranice Rezervacije, vra�a gre�ku i ukoliko se unese trenutni datum. 

V  - Lista fajlova 
Folder Spirala 2: 
	-Stil2.css - css za html stranice
	1. Javascript - Folder u kojem se nalaze skripte. Napravljene su 4 skripte kako bi ih razvrstala:
		a) Validacija - sadr�i tri funkcije, za 3 forme;
		b) PrikaziMeni - sadr�i funkciju za prikaz dropdown menija;
		c) OtvoriSliku - sadr�i funkciju za otvaranje slike;
		d) UcitavanjeStranice - sadr�i 2 funkcije: za otvaranje stranica putem indexa i za otvaranje odgovaraju�e stranice putem buttona Meni;
	2. HTML - Folder sa svim html podstranicama: 
		- index.html - po�etna stranica sa zaglavljem i podno�jem, kao i dijelom u koji se unose sadr�aji stranica pobrojanih ispod;
		a) pocetna.html - pocetna stranica na kojoj se nalaze pojedine slike i buttoni ;
		b) novosti.html - stranica koja nudi posljednje novosti vezane za lokal (obavje�tenja i sl.) i mogu�nost ocjenjivanja;
		c) galerija.html - stranica koja nudi slike vezane za lokal;
		d) cjenovnik.html - stranica sa menijem pizzerije ;
		e) rezervacije.html - stranica koja sadr�i formu za rezervisanje mjesta;
		f) kontakt.html - stranica koja sadr�i sve informacije kako prona�i lokal i kako ih kontaktirati;
	


 
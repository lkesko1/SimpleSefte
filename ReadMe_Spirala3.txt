I  - Šta je uraðeno?
ZADATAK 1.
Uraðena je serijalizacija sljedeæih formi: Rezervacije, slanje maila i ocjenjivanje. Takoðer je za admina dodano da postavlja novosti koji su takoðer serijalizovane, a koje se postavljaju na podstranicu Novosti.
Za osnovne stranice ostavljen je AjAX, a za admin stranice uèitavam stranice bez AJAX. Stranicama ipak nije moguæe pristupiti sve dok se ne uspostavi sesija. 
Prijaviti se može samo admin. 
Nakon prijave, na vrhu stranice je button za Log Out admina i za ureðivanje stranice. Na stranici Uredi postoje buttoni: Prikazi rezervacije, mailove, ocjene i novosti. Zavisno od toga šta želi vidjeti, uèitavaju se podaci iz odgovarajuæeg xml-a. Podaci u XML-u su uneseni od strane korisnika preko formi sa podstranica Rezervacije, Novosti i Kontakt (rezervacije, ocjene i mailovi). 
Admin može sve podatke brisati, mijenjati ili dodavati nove te vrste, pri èemu su opet izvršene validacije i u php-u sa ispisom greške. 

ZADATAK 2. i 3.
Na samoj stranici Uredjivanja, nalazi se i download CSV-a i to za Rezervacije. 
Takoðer, izvjestaj u PDF sadrži rezervacije u obliku tabele. (Nije navedeno da moraju biti razlièite forme za PDF i CSV). Za pdf koristen je fpdf.
Te podatke može vidjeti samo admin, s obzirom da je smisleno da ih samo on vidi.


ZADATAK 4. 
Kako mi korisnici nemaju šta pretraživati na stranici, Search sam postavila za Admina na stranici adminMailovi.php. Pretraživanje se vrši prema imenu i mailu. 
Npr, na samom poèetku, na stranici su izlistani svi mailovi. Kada se pretražuje, kucanjem "LE" izbacit æe prvih 10 imena ili mailova koji sadrže taj string. Ukoliko se klikne na button pretraživanja, prikazuje se nova tabela koja predstravlja rezultat pretraživanja i to sve rezultate, a ne samo 10. Prikazane su ponovo svi podaci za te rezultate koje admin može ponovo ureðivati.

II  - Šta nije uraðeno? III i IV - Bugovi
Nije uraðena validacija datuma za formu rezervacije jer vraæa greške ili datum ne validira kako treba. U XML se uvijek spašava današnji datum, a zatim na ispisu iz XML-a, datum se ignoriše kao da nije postavlje. Pa je uvijek u sluèaju izmjena potrebno ponovo postavljati datum. Probala sam riješiti problem na razlièite naèine, ali neuspješno

V  - Lista fajlova 
1. index.php - osnovna stranica, na koju se uèitavaju sve podstranice novosti.php, kontakt.php, rez.php, galerija.php, pocetna.php, cjenovnik.php
2. login.php - stranica za logovanje admina
3. uredi.php - stranica na kojoj se adminu pruža moguænost da pregleda/preuzima ili uredi podatke
2. 	adminMailovi.php - stranica za pregled mailova u obliku tabele. Mailove je moguæe brisati, mijenjati ili dodavati nove (jer tako traži u zadatku). Na ovoj podstranici je realizovan i veæ opisani Search
	adminNovosti.php - stranica za pregled, izmjenu i dodavanje novosti koje se prikazuju na podstranici Novosti.php 
	adminOcjene.php - stranica za pregled, izmjenu i dodavanje ocjena korisnika
	adminRezervacije.php - stranica za pregled, izmjenu i dodavanje rezervacija
3. csv.php - php za kreiranje csv dokumenta iz Rezervacije.xml ako postoji
   pdf.php - php za kreiranje pdf izvještaja iz Rezervacije.xml ako postoji
4. search.php- php za realizovanje search-a u adminMailovi.php, pri èemu se iz dokumenta preuzimaju vrijednosti za Name i Email i vrši se pretraga prema ta dva polja. Broje se vrijednosti koje æe se pokazati u padajuæoj listi. (klik na search button je realizovan u adminMailovi.php)
  search.js - javascript koji koristi AJAX i poziva search.php kako bi se obavilo dinamièko pretraživanje bez refreshanja stranice.
5. Folder Foto-odgovarajuæe slike 
6. a) login_skripta.php - skripta php za uspostavljanje sesije. Provjeravaju se uneseni podaci sa podacima iz fajla Admin.xml koji sadrži username i sifru.
  b) createXML.php - php skripta za kreiranje odgovarajuæeg XML-a ili unosa podataka u XML. Realizovano je za sve forme, ali se koristi i kada Admin unosi nove rezervacije/mailove/novosti/ocjene. Provjerava da li fajl veæ postoji, ako ne postoji kreira ga, a ako postoji dopisuje u njega. 
  c)rezervacije_izmjene.php - skripta za brisanje ili promjenu rezervacija koje postoje u Rezervacije.xml. Provjerava se koji je button kliknut i koji se objekat mora obrisati ili izmijenit. Takoðer, u sluèaju provjere vrši se validacija. 
 d)mailovi_izmjene.php - skripta za brisanje ili promjenu mailova koje postoje u Mailovi.xml. Provjerava se koji je button kliknut i koji se objekat mora obrisati ili izmijenit. Takoðer, u sluèaju provjere vrši se validacija. 
  e) ocjene_izmjene.php - skripta za brisanje ili promjenu ocjena koje postoje u Ocjene.xml. Provjerava se koji je button kliknut i koji se objekat mora obrisati ili izmijenit. Takoðer, u sluèaju provjere vrši se validacija. 
   f) novosti_izmjene.php- skripta za brisanje ili promjenu novosti koje postoje u Novosti.xml. Provjerava se koji je button kliknut i koji se objekat mora obrisati ili izmijenit. Takoðer, u sluèaju provjere vrši se validacija.
7. Folder Scripts - sadrži sljedece skripte: 
	a)Validacija.js - za validaciju formi
	b)UcitavanjeStranice.js - za uèitavanje stranica preko Ajaxa
	c)PrikaziMeni.js - za prikazivanje menija zavisno od ureðaja
	d)OtvoriSliku.js - za otvaranje slika kod galerije
 
8. Admin.xml - sadrži podatke za username i sifru
   Rezervacije.xml, Novosti.xml, Ocjene.xml, Mailovi.xml - xml kreiran prilikom unosa podataka na odgovarajuæoj formi. sadržaj ovih fajlova admin vidi preko stranice adminRezervacije.php i ostalih. Može ih mijenjati ili dodavati nove. Sve promjene se odražavaju na fajlove.
9. Folder fpdf -  korišten za kreiranje pdf izvještaja
10. stil2.css, login.css - korišteni css-ovi	





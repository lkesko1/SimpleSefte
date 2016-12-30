I  - �ta je ura�eno?
ZADATAK 1.
Ura�ena je serijalizacija sljede�ih formi: Rezervacije, slanje maila i ocjenjivanje. Tako�er je za admina dodano da postavlja novosti koji su tako�er serijalizovane, a koje se postavljaju na podstranicu Novosti.
Za osnovne stranice ostavljen je AjAX, a za admin stranice u�itavam stranice bez AJAX. Stranicama ipak nije mogu�e pristupiti sve dok se ne uspostavi sesija. 
Prijaviti se mo�e samo admin. 
Nakon prijave, na vrhu stranice je button za Log Out admina i za ure�ivanje stranice. Na stranici Uredi postoje buttoni: Prikazi rezervacije, mailove, ocjene i novosti. Zavisno od toga �ta �eli vidjeti, u�itavaju se podaci iz odgovaraju�eg xml-a. Podaci u XML-u su uneseni od strane korisnika preko formi sa podstranica Rezervacije, Novosti i Kontakt (rezervacije, ocjene i mailovi). 
Admin mo�e sve podatke brisati, mijenjati ili dodavati nove te vrste, pri �emu su opet izvr�ene validacije i u php-u sa ispisom gre�ke. 

ZADATAK 2. i 3.
Na samoj stranici Uredjivanja, nalazi se i download CSV-a i to za Rezervacije. 
Tako�er, izvjestaj u PDF sadr�i rezervacije u obliku tabele. (Nije navedeno da moraju biti razli�ite forme za PDF i CSV). Za pdf koristen je fpdf.
Te podatke mo�e vidjeti samo admin, s obzirom da je smisleno da ih samo on vidi.


ZADATAK 4. 
Kako mi korisnici nemaju �ta pretra�ivati na stranici, Search sam postavila za Admina na stranici adminMailovi.php. Pretra�ivanje se vr�i prema imenu i mailu. 
Npr, na samom po�etku, na stranici su izlistani svi mailovi. Kada se pretra�uje, kucanjem "LE" izbacit �e prvih 10 imena ili mailova koji sadr�e taj string. Ukoliko se klikne na button pretra�ivanja, prikazuje se nova tabela koja predstravlja rezultat pretra�ivanja i to sve rezultate, a ne samo 10. Prikazane su ponovo svi podaci za te rezultate koje admin mo�e ponovo ure�ivati.

II  - �ta nije ura�eno? III i IV - Bugovi
Nije ura�ena validacija datuma za formu rezervacije jer vra�a gre�ke ili datum ne validira kako treba. U XML se uvijek spa�ava dana�nji datum, a zatim na ispisu iz XML-a, datum se ignori�e kao da nije postavlje. Pa je uvijek u slu�aju izmjena potrebno ponovo postavljati datum. Probala sam rije�iti problem na razli�ite na�ine, ali neuspje�no

V  - Lista fajlova 
1. index.php - osnovna stranica, na koju se u�itavaju sve podstranice novosti.php, kontakt.php, rez.php, galerija.php, pocetna.php, cjenovnik.php
2. login.php - stranica za logovanje admina
3. uredi.php - stranica na kojoj se adminu pru�a mogu�nost da pregleda/preuzima ili uredi podatke
2. 	adminMailovi.php - stranica za pregled mailova u obliku tabele. Mailove je mogu�e brisati, mijenjati ili dodavati nove (jer tako tra�i u zadatku). Na ovoj podstranici je realizovan i ve� opisani Search
	adminNovosti.php - stranica za pregled, izmjenu i dodavanje novosti koje se prikazuju na podstranici Novosti.php 
	adminOcjene.php - stranica za pregled, izmjenu i dodavanje ocjena korisnika
	adminRezervacije.php - stranica za pregled, izmjenu i dodavanje rezervacija
3. csv.php - php za kreiranje csv dokumenta iz Rezervacije.xml ako postoji
   pdf.php - php za kreiranje pdf izvje�taja iz Rezervacije.xml ako postoji
4. search.php- php za realizovanje search-a u adminMailovi.php, pri �emu se iz dokumenta preuzimaju vrijednosti za Name i Email i vr�i se pretraga prema ta dva polja. Broje se vrijednosti koje �e se pokazati u padaju�oj listi. (klik na search button je realizovan u adminMailovi.php)
  search.js - javascript koji koristi AJAX i poziva search.php kako bi se obavilo dinami�ko pretra�ivanje bez refreshanja stranice.
5. Folder Foto-odgovaraju�e slike 
6. a) login_skripta.php - skripta php za uspostavljanje sesije. Provjeravaju se uneseni podaci sa podacima iz fajla Admin.xml koji sadr�i username i sifru.
  b) createXML.php - php skripta za kreiranje odgovaraju�eg XML-a ili unosa podataka u XML. Realizovano je za sve forme, ali se koristi i kada Admin unosi nove rezervacije/mailove/novosti/ocjene. Provjerava da li fajl ve� postoji, ako ne postoji kreira ga, a ako postoji dopisuje u njega. 
  c)rezervacije_izmjene.php - skripta za brisanje ili promjenu rezervacija koje postoje u Rezervacije.xml. Provjerava se koji je button kliknut i koji se objekat mora obrisati ili izmijenit. Tako�er, u slu�aju provjere vr�i se validacija. 
 d)mailovi_izmjene.php - skripta za brisanje ili promjenu mailova koje postoje u Mailovi.xml. Provjerava se koji je button kliknut i koji se objekat mora obrisati ili izmijenit. Tako�er, u slu�aju provjere vr�i se validacija. 
  e) ocjene_izmjene.php - skripta za brisanje ili promjenu ocjena koje postoje u Ocjene.xml. Provjerava se koji je button kliknut i koji se objekat mora obrisati ili izmijenit. Tako�er, u slu�aju provjere vr�i se validacija. 
   f) novosti_izmjene.php- skripta za brisanje ili promjenu novosti koje postoje u Novosti.xml. Provjerava se koji je button kliknut i koji se objekat mora obrisati ili izmijenit. Tako�er, u slu�aju provjere vr�i se validacija.
7. Folder Scripts - sadr�i sljedece skripte: 
	a)Validacija.js - za validaciju formi
	b)UcitavanjeStranice.js - za u�itavanje stranica preko Ajaxa
	c)PrikaziMeni.js - za prikazivanje menija zavisno od ure�aja
	d)OtvoriSliku.js - za otvaranje slika kod galerije
 
8. Admin.xml - sadr�i podatke za username i sifru
   Rezervacije.xml, Novosti.xml, Ocjene.xml, Mailovi.xml - xml kreiran prilikom unosa podataka na odgovaraju�oj formi. sadr�aj ovih fajlova admin vidi preko stranice adminRezervacije.php i ostalih. Mo�e ih mijenjati ili dodavati nove. Sve promjene se odra�avaju na fajlove.
9. Folder fpdf -  kori�ten za kreiranje pdf izvje�taja
10. stil2.css, login.css - kori�teni css-ovi	





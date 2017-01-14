1.
Kreirala sam bazu na phpmyadmin koja se zove SimpleSefteDB. Kreirane su 4 manje tabele za kreiranje jelovnika. Pobrojane su tabele:
Stavka - obuhvata hranu i pice koje se mo�e na�i na jelovniku, a sadr�i kolona:
	id - primary key AI
	naziv - naziv jela ili pi�a varchar 80
	cijena - double 
	id_vrste - koja je vrsta hrane ili pi�e - foreign key
Vrsta - odnosi se na vrstu hranu ili pi�a npr: Pizza, sendvic, topli napitak i sl.
	id - primary key AI
	naziv - neki od navedenih naziva 
Sastojak - odnosi se na dodatni opis hrane npr: pomfrit, pecivo i slicno.
	id - primary key AI
	naziv - naziv dodatka
Sastojci - tabela koja povezuje Sastojak i Stavku jer je to veza vi�e prema vi�e.
	id_stavke - foreign key
	id_sastojka - foreign key

Kada se Admin loguje, na njegovoj stranici za uredjivanje ima button za uredjivanje jelovnika, odnosno mo�e dodavati nove stavke, vrste i sastojke i za odredjeno jelo dodavati neki prilog. Mo�e prikazati sve elemente iz baze pri �emu se prikazuje i ID tog elementa na osnovu kojeg bri�e pojedini element iz baze. Kako su forme male, nisam stavljala izmjene, ako ne�to ne odgovara, mo�e izbrisati pa opet dodati. Izmjene za bazu sam implementirala kroz stare forme koje su postojale. 

2. Napravljena je php skripta xmlBaza koji prebacuje sve elemente iz xml dokumenata Novosti, rezervacije, ocjene i mailovi u bazu u njihove odgovaraju�e tabele. 
Ja sam shvatila da se prebacuju samo oni koji ve� ne postoje, tako da se uvijek provjerava da li su ili svi elementi isti u bazi ili kljucni elementi, npr za mail su mi svi elementi kljucni i provjeravam da li su sva polja ista, ako nisuu, onda se dodaje. Za Rezervacije provjerama sva polja osim napomene i broj ljudi, ako je isto ime, telefon, datum i vrijeme to je kao da je isti element u bazi (ostale info i nisu toliko bitne). 

3. Sve skripte u kojima se u�itivalo iz XML-a ili upisivalo  u XML su prepravljene: search, pdf, csv, potvrda nakon unosa u forme, ispis iz formi za rezervacije, novosti, mailove i ocjene. Tako�er kako je implementiran Jelovnik, njegovi su elementi djelomi�no uneseni u bazu, pa se veza izmedju te tri tabele iz baze pokazuje u cjenovnik.php ili podstranici Cjenovnik.

4. Ura�en je openshift na stranici: http://ssefte-simple-sefte.44fs.preview.openshiftapps.com/

5. Ure�en je rest za jelovnik gdje se prikazuju sve vrste jela/pi�a odnosno stavki preko GET metode jer je trebalo samo da vra�a JSON. Ukoliko je postavljena i vrsta sa tacnim nazivom, onda se prikazuju samo stavke te vrste, a ukoliko je vrsta prazan string ponovo se prikazuju sve stavke. 
Ovdje je ura�eno i da se za id_vrste umjesto samo id-a vrste (jer nam to bas nesto i ne znaci) iz tabele Vrsta povuceno ta�no naziv vrste koje je stavka(da li je Pizza, Kebab i slicno) pa je to posebno jos izdvojeno. 

6. Ura�eno je nekoliko Screenshotova POSTMANA kako bi pokazala sve navedeno pod 5. 


II  - �ta nije ura�eno? III i IV - Bugovi
Sada je problem sa datumom na jos jednom mjestu, na prosloj spirali je funkcionisalo kada admin prepravljala neku rezervaciju i zeli spremiti, mogao je promijeniti datum, medjutim sada se opet datum refresha?. Promjene rade regularno na ostalim formama.


V  - Lista fajlova

OVDJE SADA STA GOD UKLJUCE XML; ODNOSI SE NA BAZU 
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

11. xmlBaza.php za pprebacivanje iz XMLA u Bazu
12. adminJelovnik.php za uredjivanje jelovnika
13. simpleseftedb.sql baza podataka sa phpmyadmin
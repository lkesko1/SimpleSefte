1.
Kreirala sam bazu na phpmyadmin koja se zove SimpleSefteDB. Kreirane su 4 manje tabele za kreiranje jelovnika. Pobrojane su tabele:
Stavka - obuhvata hranu i pice koje se može naæi na jelovniku, a sadrži kolona:
	id - primary key AI
	naziv - naziv jela ili piæa varchar 80
	cijena - double 
	id_vrste - koja je vrsta hrane ili piæe - foreign key
Vrsta - odnosi se na vrstu hranu ili piæa npr: Pizza, sendvic, topli napitak i sl.
	id - primary key AI
	naziv - neki od navedenih naziva 
Sastojak - odnosi se na dodatni opis hrane npr: pomfrit, pecivo i slicno.
	id - primary key AI
	naziv - naziv dodatka
Sastojci - tabela koja povezuje Sastojak i Stavku jer je to veza više prema više.
	id_stavke - foreign key
	id_sastojka - foreign key

Kada se Admin loguje, na njegovoj stranici za uredjivanje ima button za uredjivanje jelovnika, odnosno može dodavati nove stavke, vrste i sastojke i za odredjeno jelo dodavati neki prilog. Može prikazati sve elemente iz baze pri èemu se prikazuje i ID tog elementa na osnovu kojeg briše pojedini element iz baze. Kako su forme male, nisam stavljala izmjene, ako nešto ne odgovara, može izbrisati pa opet dodati. Izmjene za bazu sam implementirala kroz stare forme koje su postojale. 

2. Napravljena je php skripta xmlBaza koji prebacuje sve elemente iz xml dokumenata Novosti, rezervacije, ocjene i mailovi u bazu u njihove odgovarajuæe tabele. 
Ja sam shvatila da se prebacuju samo oni koji veæ ne postoje, tako da se uvijek provjerava da li su ili svi elementi isti u bazi ili kljucni elementi, npr za mail su mi svi elementi kljucni i provjeravam da li su sva polja ista, ako nisuu, onda se dodaje. Za Rezervacije provjerama sva polja osim napomene i broj ljudi, ako je isto ime, telefon, datum i vrijeme to je kao da je isti element u bazi (ostale info i nisu toliko bitne). 

3. Sve skripte u kojima se uèitivalo iz XML-a ili upisivalo  u XML su prepravljene: search, pdf, csv, potvrda nakon unosa u forme, ispis iz formi za rezervacije, novosti, mailove i ocjene. Takoðer kako je implementiran Jelovnik, njegovi su elementi djelomièno uneseni u bazu, pa se veza izmedju te tri tabele iz baze pokazuje u cjenovnik.php ili podstranici Cjenovnik.

4. Uraðen je openshift na stranici: http://ssefte-simple-sefte.44fs.preview.openshiftapps.com/

5. Ureðen je rest za jelovnik gdje se prikazuju sve vrste jela/piæa odnosno stavki preko GET metode jer je trebalo samo da vraæa JSON. Ukoliko je postavljena i vrsta sa tacnim nazivom, onda se prikazuju samo stavke te vrste, a ukoliko je vrsta prazan string ponovo se prikazuju sve stavke. 
Ovdje je uraðeno i da se za id_vrste umjesto samo id-a vrste (jer nam to bas nesto i ne znaci) iz tabele Vrsta povuceno taèno naziv vrste koje je stavka(da li je Pizza, Kebab i slicno) pa je to posebno jos izdvojeno. 

6. Uraðeno je nekoliko Screenshotova POSTMANA kako bi pokazala sve navedeno pod 5. 


II  - Šta nije uraðeno? III i IV - Bugovi
Sada je problem sa datumom na jos jednom mjestu, na prosloj spirali je funkcionisalo kada admin prepravljala neku rezervaciju i zeli spremiti, mogao je promijeniti datum, medjutim sada se opet datum refresha?. Promjene rade regularno na ostalim formama.


V  - Lista fajlova

OVDJE SADA STA GOD UKLJUCE XML; ODNOSI SE NA BAZU 
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

11. xmlBaza.php za pprebacivanje iz XMLA u Bazu
12. adminJelovnik.php za uredjivanje jelovnika
13. simpleseftedb.sql baza podataka sa phpmyadmin
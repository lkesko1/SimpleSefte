 <?php
	 
	 global $greska;
	 $greska = "";
	if (isset($_REQUEST['buttonRezervacija']) || isset($_REQUEST['buttonSpremi']))
	{
	// Ispitivanje da li su uneseni svi potrebni inputi u formi
	if (!empty($_REQUEST['ime']) && !empty($_REQUEST['tel']) && !empty($_REQUEST['date']) && !empty($_REQUEST['vrijeme']) && !empty($_REQUEST['osobe']) &&
		isset($_REQUEST['ime']) && isset($_REQUEST['tel']) && isset($_REQUEST['date']) && isset($_REQUEST['vrijeme']) && isset($_REQUEST['osobe']) )
		{
			/*VALIDACIJA, valjda se ovako misli na validaciju*/
			//$imeRegex = /^[A-Za-z]+\s[A-Za-z]+$/;
			//$telefonRegex = /^\(?(\d{3})\)?[-]?(\d{3})[-]?(\d{3})$/;
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			  $ime = input($_POST["ime"]);
			  $tel = input($_POST["tel"]);
			  $datum = (isset($_POST["date"]) ? input($_POST["date"]) : null); // ne radi, sprema uvijek danasnji datum 
			  $vrijeme = input($_POST["vrijeme"]);
			  $broj = input($_POST["osobe"]);
			  if (isset($_POST["napomenatekst"])) $napomena = input($_POST["napomenatekst"]);
			  
			}
			
			$danasnjiDatum = date("Y/m/d");
			$datum = date("Y/m/d", strtotime($_POST['date']));
			
			// Postavka vremena za radno vrijeme tj moguce sate rezervacije
			$vrijemeMin="10:00:00";
			$vrijemeMax="21:30:00";	

			// Validacija svakog inputa prema regexu, i slicno; nema validacije datuma jer uvijek upisuje danasnji datum :(
			if (preg_match('/^\(?(\d{3})\)?[-]?(\d{3})[-]?(\d{3})$/', $tel) && preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $ime) && 
				intval($broj) > 0 && intval($broj) < 16 && strtotime($vrijeme) >= strtotime($vrijemeMin) &&  strtotime($vrijeme) <=strtotime($vrijemeMax))
				{
					//Niz svih vrijednosti inputa
					$Unos = array('Name'=>$ime, 'Phone_number'=>$tel, 'Date'=>$datum, 'Time'=>$vrijeme, 'Broj'=>$broj, 'Napomena'=>$napomena);
							
				
					if (file_exists ("Rezervacije.xml")){ 
						$fajl = file_get_contents("Rezervacije.xml");
						if ($fajl == '') // moguce je da file postoji ali je prazan
							$fajl = $fajl . kreiraj_xml($Unos, 0);
						else //fajl postoji i u njemu je neki sadržaj
						{
							
							$niz = file("Rezervacije.xml");
							unset($niz[count($niz)-1]);
							$fajl = implode('', $niz);
							$fajl = $fajl . kreiraj_xml($Unos, 1);
						}
					}
					else
						$fajl = kreiraj_xml($Unos, 0); //fajl uopce ne postoji, pa se kreira novi
			
					// Upisivanje sadržaja u file Rezervacije.xml
					file_put_contents("Rezervacije.xml",  $fajl); 
					
				}
			else
			{
				$greska = "Nisu validni sljedeći podaci: "; 
				if (preg_match('/^\(?(\d{3})\)?[-]?(\d{3})[-]?(\d{3})$/', $tel) == false) $greska .= "broj telefona" ;
				if (preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $ime) == false) $greska .= " ime";
				if (intval($broj) < 1 || intval($broj) > 15) $greska .= " broj osoba";
				if (strtotime($vrijeme) < strtotime($vrijemeMin) ||  strtotime($vrijeme) > strtotime($vrijemeMax)) $greska .= " vrijeme";
				
				
			}
		}
		else
		{
			$greska = "Sva polja osim napomene su obavezna.";
		}
	}
		

		
	function kreiraj_xml($unos, $prazan)
	{
		
		
		//Ako je file prazan unosi se ovaj prvi red
		if ($prazan === 0)
			$string = '<?xml version="1.0" encoding="UTF-8" ?>' . PHP_EOL . '<Rezervacije>'  . PHP_EOL;
		else //ako file nije prazan nastavlja se upisivanje u file u novom redu
			$string = '';
		
		$brojReda = 2;
		$podatak = 'Rezervacija';
		$string = $string . uvuci($brojReda - 1) . '<' .$podatak. '>' . PHP_EOL;
		
		foreach($unos as $tag => $vrijednost)
		{
			if(!is_array($vrijednost))
				$string.= uvuci($brojReda) . '<' . htmlspecialchars($tag) . '>' . $vrijednost . '</' . htmlspecialchars($tag) . '>' . PHP_EOL;
			else
				$string = $string . kreiraj_xml($vrijednost, $tag, $brojReda + 1) . PHP_EOL;
		}
		
		$brojUvlacenja = $brojReda - 1;
		$string = $string . uvuci($brojUvlacenja) . '</' . $podatak . '>'  . PHP_EOL . '</Rezervacije>';
		

		return $string;
	}


	function uvuci($brojUvlacenja)
	{
		// Koristi se za formatiranje xml file-a, da bi postojao odgovarajući broj tabova
		$tabovi = "";
		if ($brojUvlacenja > 0)
		{
			for($i = 1; $i <= $brojUvlacenja; $i++) 
				$tabovi = $tabovi . "\t"; 
		}
		return $tabovi;
	}
	
	
	/* PHP VALIDACIJA I KREIRANJE XML-A SA OCJENAMA*/ 
	if (isset($_REQUEST["ocjenaButton"]) || isset($_REQUEST["buttonSpremiOcjenu"]) )
	{
		// DA LI JE KLIKNUTA NEKA OCJENA, AKO NIJE NECE SPREMITI U XML NISTA 
			if (isset($_REQUEST["ocjena"]) && $_REQUEST["ocjena"]>0 && $_REQUEST["ocjena"]<6 )
			{
				if (file_exists ("Ocjene.xml") == false){ 
					$file = new DOMDocument('1.0', 'utf-8');
					$file->formatOutput = true;
					$tagOcjene = $file->createElement("Ocjene");
					$file->appendChild( $tagOcjene );
					$file->save("Ocjene.xml");
				}
				$file = new DOMDocument();
				$file->load("Ocjene.xml");
				$tagOcjene = $file->documentElement;
				$ocjena = $_REQUEST["ocjena"];
				$o = $file->createElement("Ocjena");
				$o->appendChild($file->createTextNode( $ocjena ));
				$tagOcjene->appendChild($o);
				$file->save("Ocjene.xml");
			}
			else{
				$greska = "Potrebno je unijeti ocjenu!";
			}
	}
	
	if (isset($_REQUEST["mailButton"]) || isset($_REQUEST["buttonSpremiMail"]))
	{
		if (!empty($_REQUEST['ime']) && !empty($_REQUEST['mail']) && !empty($_REQUEST['subject']) && !empty($_REQUEST['mailtekst']) &&
		isset($_REQUEST['ime']) && isset($_REQUEST['mail']) && isset($_REQUEST['subject']) && isset($_REQUEST['mailtekst'])){
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			  $ime = input($_POST["ime"]);
			  $mail = input($_POST["mail"]);
			  $subject = input($_POST["subject"]);
			  $text = input($_POST["mailtekst"]);
			}
				if (preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/', $mail) && preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $ime))
				{
					// Ispitivanje da li file postoji uopce, ako postoji u njega se upisuje, a ako ne postoji, kreira se novi
						if (file_exists ("Mailovi.xml") == false){ 
							$file = new DOMDocument('1.0', 'utf-8');
							$file->formatOutput = true;
							$tagMailovi = $file->createElement("Mailovi");
							$file->appendChild( $tagMailovi );
							$file->save("Mailovi.xml");
						}
						$file = new DOMDocument();
						$file->load("Mailovi.xml");
						$tagMailovi = $file->documentElement;
						$tagMail = $file->createElement("Mail");
						
						$tagName = $file->createElement("Name");
						$tagName->appendChild($file->createTextNode($ime));
						$tagMail->appendChild($tagName);
						
						$tagEmail = $file->createElement("Email");
						$tagEmail->appendChild($file->createTextNode($mail));
						$tagMail->appendChild($tagEmail);
						
						$tagSubject = $file->createElement("Subject");
						$tagSubject->appendChild($file->createTextNode($subject));
						$tagMail->appendChild($tagSubject);
						
						$tagText= $file->createElement("Text");
						$tagText->appendChild($file->createTextNode($text));
						$tagMail->appendChild($tagText);
						
						$tagMailovi->appendChild($tagMail);
						
						$file->save("Mailovi.xml");
			
						$message = "Poruka je uspješno poslana.";
				}
				else
				{
					$greska = "Nisu validni sljedeći podaci:"; 
					if (preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/', $mail) == false) $greska .= " email" ;
					if (preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $ime) == false) $greska .= " ime";
				}
			
		}
		else{
			$greska ="Sva polja su obavezna!";
		}
		
	}
	
	if (isset($_REQUEST["buttonSpremiNovost"]))
	{
			if (isset($_REQUEST["novostText"]))
			{
				if (file_exists ("Novosti.xml") == false){ 
					$file = new DOMDocument('1.0', 'utf-8');
					$file->formatOutput = true;
					$tagNovosti = $file->createElement("Novosti");
					$file->appendChild( $tagNovosti );
					$file->save("Novosti.xml");
				}
				$file = new DOMDocument();
				$file->load("Novosti.xml");
				$tagNovosti = $file->documentElement;
				$novost = input($_REQUEST["novostText"]);
				$o = $file->createElement("Novost");
				$o->appendChild($file->createTextNode( $novost ));
				$tagNovosti->appendChild($o);
				$file->save("Novosti.xml");
			}
			{
				$greska ="Potrebno je unijeti tekst!";
			}
	}
	
	function input($unos) {
	  $unos = trim($unos); // da se \n ne interpretira kao novi red i slicno
	  $unos = stripslashes($unos); // ukidanje backslasha
	  $unos = htmlspecialchars($unos); // zamjena < sa &lt i slicno
	  return $unos;
	}
	
	
	?>
	


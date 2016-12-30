<?php
	
	global $tabela;
	global $dodajRezervaciju;
		if (file_exists ("Rezervacije.xml"))
		{
			$file = new simpleXMLElement("Rezervacije.xml", null, true);

			$id = 1;
			foreach ($file->Rezervacija as $r) {		
				//BRISANJE 
				if (isset($_POST['brisanjeRez' . $id]))
				{
					unset($file->Rezervacija[$id-1]);
					$file->asXML("Rezervacije.xml");
					break;
				}	
				//PROMJENA
				if (isset($_POST['promjenaRez' . $id]))
				{

					//VALIDACIJA ZA PROMJENU
					if (!empty($_REQUEST['ime' . $id]) && !empty($_REQUEST['tel' . $id]) && !empty($_REQUEST['date' . $id]) && !empty($_REQUEST['vrijeme' . $id]) && !empty($_REQUEST['osobe' . $id]) &&
						isset($_REQUEST['ime' . $id]) && isset($_REQUEST['tel' . $id]) && isset($_REQUEST['date' . $id]) && isset($_REQUEST['vrijeme' . $id]) && isset($_REQUEST['osobe' . $id]) )
					{
					
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
						  $ime = input($_POST["ime" . $id]);
						  $tel = input($_POST["tel" . $id]);
						  $datum = $_POST["date" . $id];
						//  $datum = (isset($_POST["date" . $id]) ? input($_POST["date" . $id]) : null); // ne radi, sprema uvijek danasnji datum 
						  $vrijeme = input($_POST["vrijeme" . $id]);
						  $broj = input($_POST["osobe" . $id]);
						  if (isset($_POST["napomenatekst" . $id])) $napomena = input($_POST["napomenatekst" . $id]);
						  else $napomena = "";
						  
						}
						
						$danasnjiDatum = date("Y/m/d");
						//$datum = date("Y/m/d", strtotime($_POST['date' . $id]));
						
						// Postavka vremena za radno vrijeme tj moguce sate rezervacije
						$vrijemeMin="10:00:00";
						$vrijemeMax="21:30:00";	

						// Validacija svakog inputa prema regexu, i slicno; nema validacije datuma jer uvijek upisuje danasnji datum :(
						if ($datum > $danasnjiDatum && preg_match('/^\(?(\d{3})\)?[-]?(\d{3})[-]?(\d{3})$/', $tel) && preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $ime) && 
							intval($broj) > 0 && intval($broj) < 16 && strtotime($vrijeme) >= strtotime($vrijemeMin) &&  strtotime($vrijeme) <=strtotime($vrijemeMax))
							{
								$r->Name = $ime;
								$r->Phone_number = $tel;
								$r->Date = $datum;
								$r->Time = $vrijeme;
								$r->Broj = $broj;
								$r->Napomena = $napomena;
								$file->asXML("Rezervacije.xml");
								$greska = "";
							}
							else
							{
								$greska = "Nisu validni sljedeći podaci: "; 
								if (preg_match('/^\(?(\d{3})\)?[-]?(\d{3})[-]?(\d{3})$/', $tel) == false) $greska .= "broj telefona" ;
								if (preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $ime) == false) $greska .= " ime";
								if (intval($broj) < 1 || intval($broj) > 15) $greska .= " broj osoba";
								if (strtotime($vrijeme) < strtotime($vrijemeMin) ||  strtotime($vrijeme) > strtotime($vrijemeMax)) $greska .= " vrijeme";
								if ($datum <= $danasnjiDatum)  $greska .= " datum";
							}
							break;
					}
					else
					{
						$greska = "Sva polja osim napomene su obavezna!";
					}
				}
				$id++;
			
			}
		}
		


	
?>
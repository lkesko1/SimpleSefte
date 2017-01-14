<?php
	
	global $tabela;
	global $dodajRezervaciju;
			$id = 1;
			$veza = new PDO("mysql:dbname=simpleseftedb; host=localhost; charset=utf8", "wtuser", "sifra");
			$veza->exec("set names utf8");
			$rezultatR = $veza->prepare("SELECT * FROM Rezervacija order by id desc");
			$rezultatR->execute();
			$rezultat=$rezultatR->fetchAll();
			sizeof($rezultat);
			foreach ($rezultat as $r) {			
				if (isset($_POST['brisanjeRez' . $id]))
				{
					$brojID = $r['id'];
					$upit = $veza->prepare("delete FROM Rezervacija WHERE id=:brojID");
					$upit->bindParam(':brojID', $brojID);
					$upit->execute(); 
					break; 
				}	

				if (isset($_POST['promjenaRez' . $id]))
				{
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
						if ($datum >= $danasnjiDatum && preg_match('/^\(?(\d{3})\)?[-]?(\d{3})[-]?(\d{3})$/', $tel) && preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $ime) && 
							intval($broj) > 0 && intval($broj) < 16 && strtotime($vrijeme) >= strtotime($vrijemeMin) &&  strtotime($vrijeme) <=strtotime($vrijemeMax))
							{
								$brojID = $r['ID'];
								$unos = $veza->prepare("update rezervacija set name=?, phone=?, datum=?, vrijeme=?, broj=?, tekst=?  WHERE id=:brojID");
								$unos->bindValue(1, $ime, PDO::PARAM_INT); 
								$unos->bindValue(2, $phone, PDO::PARAM_INT); 
								$unos->bindValue(3, $datum, PDO::PARAM_INT); 
								$unos->bindValue(4, $vrijeme, PDO::PARAM_INT); 
								$unos->bindValue(5, $broj, PDO::PARAM_INT); 
								$unos->bindValue(6, $tekstNapomena, PDO::PARAM_INT); 
								$unos->execute();
								$greska = "";
							}
							else
							{
								$greska = "Nisu validni sljedeći podaci: "; 
								if (preg_match('/^\(?(\d{3})\)?[-]?(\d{3})[-]?(\d{3})$/', $tel) == false) $greska .= "broj telefona" ;
								if (preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $ime) == false) $greska .= " ime";
								if (intval($broj) < 1 || intval($broj) > 15) $greska .= " broj osoba";
								if (strtotime($vrijeme) < strtotime($vrijemeMin) ||  strtotime($vrijeme) > strtotime($vrijemeMax)) $greska .= " vrijeme";
								if ($datum < $danasnjiDatum)  $greska .= " datum";
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
		


	
?>
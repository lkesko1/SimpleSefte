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
			  $datum = $_POST["date"];
			//  $datum = (isset($_POST["date"]) ? input($_POST["date"]) : null); // ne radi, sprema uvijek danasnji datum 
			  $vrijeme = input($_POST["vrijeme"]);
			  $broj = input($_POST["osobe"]);
			  if (isset($_POST["napomenatekst"])) $napomena = input($_POST["napomenatekst"]);  
			}
			
			$danasnjiDatum = date("Y/m/d");
	//		$datum = date("Y/m/d", strtotime($_POST['date'])); // NE RADI NI OVO 
			
			// Postavka vremena za radno vrijeme tj moguce sate rezervacije
			$vrijemeMin="10:00:00";
			$vrijemeMax="21:30:00";	

			// Validacija svakog inputa prema regexu, i slicno; nema validacije datuma jer uvijek upisuje danasnji datum :(
			if (preg_match('/^\(?(\d{3})\)?[-]?(\d{3})[-]?(\d{3})$/', $tel) && preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $ime) && 
				intval($broj) > 0 && intval($broj) < 16 && strtotime($vrijeme) >= strtotime($vrijemeMin) &&  strtotime($vrijeme) <=strtotime($vrijemeMax))
				{
					
					//UNOS U BAZU
					try
					{
						$veza = new PDO("mysql:dbname=simpleseftedb; host=localhost; charset=utf8", "wtuser", "sifra");
						$veza->exec("set names utf8");
						$unos = $veza->prepare("Insert into Rezervacija set name =?, phone =?, datum =?, vrijeme =?, broj =?, tekst =?");
						$unos->bindValue(1,$ime, PDO::PARAM_INT);
						$unos->bindValue(2,$tel, PDO::PARAM_INT);
						$unos->bindValue(3,$datum, PDO::PARAM_INT);
						$unos->bindValue(4,$vrijeme, PDO::PARAM_INT);
						$unos->bindValue(5,$broj, PDO::PARAM_INT);
						$unos->bindValue(6,$napomena, PDO::PARAM_INT);
						$unos->execute();
					}
					catch(PDOException $e)
					{
						$message ="Connection failed!" . $e->getMessage();
						echo "<script type='text/javascript'>
							alert('$message'); 
							location.href='index.php';
							</script>";
					}
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
	
	/* PHP VALIDACIJA I KREIRANJE XML-A SA OCJENAMA*/ 
	if (isset($_REQUEST["ocjenaButton"]) || isset($_REQUEST["buttonSpremiOcjenu"]) )
	{
		// DA LI JE KLIKNUTA NEKA OCJENA, AKO NIJE NECE SPREMITI U XML NISTA 
			if (isset($_REQUEST["ocjena"]) && $_REQUEST["ocjena"]>0 && $_REQUEST["ocjena"]<6 )
			{
				try
				{
				$veza = new PDO("mysql:dbname=simpleseftedb; host=localhost; charset=utf8", "wtuser", "sifra");
					$veza->exec("set names utf8");
					$ocjena=$_REQUEST['ocjena'];
					$unos = $veza->prepare("Insert into ocjena set broj =?");
					$unos->bindValue(1,$ocjena, PDO::PARAM_INT);
					$unos->execute();
				}
				catch(PDOException $e)
				{
					$message ="Connection failed!" . $e->getMessage();
					echo "<script type='text/javascript'>
						alert('$message'); 
						location.href='index.php';
						</script>";
				}
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
					
					//UNOS U BAZU
					try
					{
						$veza = new PDO("mysql:dbname=simpleseftedb; host=localhost; charset=utf8", "wtuser", "sifra");
						$veza->exec("set names utf8");
						$unos = $veza->prepare("Insert into mail set name =?, adresa =?, subject =?, tekst =?");
						$unos->bindValue(1,$ime, PDO::PARAM_INT);
						$unos->bindValue(2,$mail, PDO::PARAM_INT);
						$unos->bindValue(3,$subject, PDO::PARAM_INT);
						$unos->bindValue(4,$text, PDO::PARAM_INT);
						$unos->execute();
					}
					catch(PDOException $e)
					{
						$message ="Connection failed!" . $e->getMessage();
						echo "<script type='text/javascript'>
							alert('$message'); 
							location.href='index.php';
							</script>";
					}
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
				
				//UNOS U BAZU
				try
				{
					$veza = new PDO("mysql:dbname=simpleseftedb; host=localhost; charset=utf8", "wtuser", "sifra");
					$veza->exec("set names utf8");
					$novost = input($_REQUEST["novostText"]);
					$unos = $veza->prepare("Insert into novost set tekst =?");
					$unos->bindValue(1,$novost, PDO::PARAM_INT);
					$unos->execute();
				}
				catch(PDOException $e)
				{
					$message ="Connection failed!" . $e->getMessage();
					echo "<script type='text/javascript'>
						alert('$message'); 
						location.href='index.php';
						</script>";
				}
			}
			else
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
	


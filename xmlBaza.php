<?php
if(isset($_REQUEST['uBazuButton']))
{
		try
		{
				$veza = new PDO("mysql:dbname=simpleseftedb; host=localhost; charset=utf8", "wtuser", "sifra");
				$veza->exec("set names utf8");
		}
		catch(PDOException $e)
		{
			$message ="Connection failed!" . $e->getMessage();
					echo "<script type='text/javascript'>
						alert('$message'); 
						location.href='index.php';
						</script>";
		}
		
		
	if (file_exists("Rezervacije.xml"))
	{
		$brUnesenihRez = 0;
		//Kupi domom redom elemente iz xml
		//poredi da li se već nalazi u bazi
		$fajl = new SimpleXMLElement("Rezervacije.xml",null,true);
		$rezXML = array();
		foreach($fajl->Rezervacija as $r)
		{
			$ime = ($r->Name);
			$phone =  ($r->Phone_number);
			$vrijeme = ($r->Time);
			$datum =($r->Date);
			$broj =  ($r->Broj);
			if (isset($r->Napomena) && !empty($r->Napomena)) $tekstNapomena = ($r->Napomena);
		
			$vrijemeMin="10:00:00";
			$vrijemeMax="21:30:00";	
			$datumN = date("Y/m/d", strtotime($datum));
			
		if (preg_match('/^\(?(\d{3})\)?[-]?(\d{3})[-]?(\d{3})$/', $phone) && preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $ime) &&
			$broj > 0 && $broj < 16 && strtotime($vrijeme) >= strtotime($vrijemeMin) &&  strtotime($vrijeme) <=strtotime($vrijemeMax))
			{
				$upit = $veza->prepare("SELECT * FROM rezervacija WHERE name=:ime AND phone=:tel AND datum=:datum AND vrijeme=:vrijeme");
				$upit->bindParam(':ime', $ime);
				$upit->bindParam(':tel', $phone);
				$upit->bindParam(':datum', $datumN);
				$upit->bindParam(':vrijeme', $vrijeme);
				//$upit->bindParam(':br', $broj);
				//$upit->bindParam(':txt', $tekstNapomena);
				$upit->execute();
		
				$brojPronadjenih = sizeof($upit->fetchAll());
				if ($brojPronadjenih==0)
				{
					$unos = $veza->prepare("insert into rezervacija set name=?, phone=?, datum=?, vrijeme=?, broj=?, tekst=?");
					/*$unos->bindParam(':ime', $ime);
					
					$unos->bindParam(':tel', $phone);
					$unos->bindParam(':dat', $datumN);
					$unos->bindParam(':vr', $vrijeme);
					$unos->bindParam(':br', $broj);
					$unos->bindParam(':txt', $tekstNapomena); */
					$unos->bindValue(1, $ime, PDO::PARAM_INT); 
					$unos->bindValue(2, $phone, PDO::PARAM_INT); 
					$unos->bindValue(3, $datumN, PDO::PARAM_INT); 
					$unos->bindValue(4, $vrijeme, PDO::PARAM_INT); 
					$unos->bindValue(5, $broj, PDO::PARAM_INT); 
					$unos->bindValue(6, $tekstNapomena, PDO::PARAM_INT); 
					$unos->execute();
					$brUnesenihRez = $brUnesenihRez+1;
				}
			}
			else
			{
				$message ="Unos u Rezervacija XML nije validan!";
						echo "<script type='text/javascript'>
							alert('$message'); 
							location.href='index.php';
							</script>";
			} 
		} 
	}
	if (file_exists("Novosti.xml"))
	{
		$brUnesenihNovosti=0;
		$fajl = new SimpleXMLElement("Novosti.xml",null,true);
		foreach($fajl->Novost as $n)
		{
			$tekstXML = input($n);
			if (sizeof($tekstXML) > 0)
			{
				$upit = $veza->prepare("SELECT * FROM Novost WHERE tekst=:txt ");
				$upit->bindParam(':txt', $tekstXML);
				$upit->execute();
		
				$brojPronadjenih = sizeof($upit->fetchAll());
				if ($brojPronadjenih==0)
				{
					$unos = $veza->prepare("Insert into Novost set tekst =?");
					$unos->bindValue(1, $tekstXML, PDO::PARAM_INT);
					$unos->execute();
					$brUnesenihNovosti = $brUnesenihNovosti+1;
				}
			}
			else
			{
				$message ="Unos u XML nije validan!";
						echo "<script type='text/javascript'>
							alert('$message'); 
							location.href='index.php';
							</script>";
			}
		}
			
	}
	
	
	if (file_exists("Mailovi.xml"))
	{
		
		$brUnesenihMailova = 0;
		$fajl = new SimpleXMLElement("Mailovi.xml",null,true);
		foreach($fajl->Mail as $m)
		{
			//PITANJE: Treba li ovdje pozivati input funkciju?
			$ime = ($m->Name);
			$adr = ($m->Email);
			$predmet= ($m->Subject);
			$tekst = ($m->Text);
		
			if (preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/', $adr) && preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $ime))
			{

				$upit = $veza->prepare("SELECT * FROM Mail WHERE name=:n AND adresa=:a AND subject=:p AND tekst=:txt ");
				$upit->bindParam(':n', $ime);
				$upit->bindParam(':a', $adr);
				$upit->bindParam(':p', $predmet);
				$upit->bindParam(':txt', $tekst );
				$upit->execute();
		
				$brojPronadjenih = sizeof($upit->fetchAll());
				if ($brojPronadjenih==0)
				{
					$unos = $veza->prepare("Insert into Mail set name=?, adresa=?, subject=?, tekst=?");
					$unos->bindValue(1, $ime, PDO::PARAM_INT);
					$unos->bindValue(2, $adr, PDO::PARAM_INT);
					$unos->bindValue(3, $predmet, PDO::PARAM_INT);
					$unos->bindValue(4, $tekst, PDO::PARAM_INT);
					$unos->execute();
					$brUnesenihMailova = $brUnesenihMailova+1;
				}
			}
			else
			{
				$message ="Unos u XML nije validan!";
						echo "<script type='text/javascript'>
							alert('$message'); 
							location.href='index.php';
							</script>";
			}
		}
	}
	if (file_exists("Ocjene.xml"))
	{
		$brUnesenihOcjena = 0;
		$fajl = new SimpleXMLElement("Ocjene.xml",null,true);
		foreach($fajl->Ocjena as $o)
		{
			$ocjena = $o;
		
			if ($ocjena == 1 || $ocjena == 2 || $ocjena == 3 || $ocjena == 4 || $ocjena == 5)
			{
				$upit = $veza->prepare("SELECT * FROM Ocjena WHERE broj=:br ");
				$upit->bindParam(':br', $ocjena);
				$upit->execute();
		
				$brojPronadjenih = sizeof($upit->fetchAll());
				if ($brojPronadjenih==0)
				{
					$unos = $veza->prepare("Insert into Ocjena set broj =?");
					$unos->bindValue(1, $ocjena, PDO::PARAM_INT);
					$unos->execute();
					$brUnesenihOcjena = $brUnesenihOcjena+1;
				}
			}
			else
			{
				$message ="Unos u XML nije validan!";
						echo "<script type='text/javascript'>
							alert('$message'); 
							location.href='index.php';
							</script>";
			} 
		}
	}
}

		
	function input($unos) {
	  $unos = trim($unos); // da se \n ne interpretira kao novi red i slicno
	  $unos = stripslashes($unos); // ukidanje backslasha
	  $unos = htmlspecialchars($unos); // zamjena < sa &lt i slicno
	  return $unos;
	}
?>
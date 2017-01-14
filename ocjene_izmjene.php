<?php

global $tabela;
	global $dodajOcjenu;
			$id = 1;
			$veza = new PDO("mysql:dbname=simpleseftedb; host=localhost; charset=utf8", "wtuser", "sifra");
			$veza->exec("set names utf8");
			$rezultatOcjene = $veza->prepare("SELECT * FROM Ocjena order by id desc");
			$rezultatOcjene->execute();
			$rezultat=$rezultatOcjene->fetchAll();
			foreach ($rezultat as $r) {			
				if (isset($_POST['brisanjeOcjene' . $id]))
				{
					$brojID = $r['id'];
					$upit = $veza->prepare("delete FROM Ocjena WHERE id=:brojID");
					$upit->bindParam(':brojID', $brojID);
					$upit->execute(); 
					break; 
				}		
				
				if (isset($_POST['promjenaOcjene' . $id]))
				{
					if (!empty($_REQUEST['ocjena' . $id]) && isset($_REQUEST['ocjena' . $id]))
					{
							if ($_SERVER["REQUEST_METHOD"] == "POST") 
							  $n = input($_POST["ocjena" . $id]);
							
							if ($n <= 5 && $n >= 1)
							{
								$brojID = $r['id'];
								$upit = $veza->prepare("update Ocjena set broj=:n WHERE id=:brojID");
								$upit->bindParam(':n', $n);
								$upit->bindParam(':brojID', $brojID);
								$upit->execute(); 
								$greska = "";
							}
							else{
								$greska = "Ocjena nije validna. Mora biti od 1 do 5!";
							}
							
								
						break;
					}
					else
					{
						$greska = "Potrebno je unijeti ocjenu!";
					}
				}				
				$id++;
			}		
		
?>
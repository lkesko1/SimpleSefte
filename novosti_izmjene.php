<?php
global $tabela;
	global $dodajNovost;

			$id = 1;
			$veza = new PDO("mysql:dbname=simpleseftedb; host=localhost; charset=utf8", "wtuser", "sifra");
			$veza->exec("set names utf8");
			$rezultatNovost = $veza->prepare("SELECT * FROM Novost order by id desc");
			$rezultatNovost->execute();
			$rezultat=$rezultatNovost->fetchAll();
			sizeof($rezultat);
			foreach ($rezultat as $r) {			
				if (isset($_POST['brisanjeNovost' . $id]))
				{
					$brojID = $r['ID'];
					$upit = $veza->prepare("delete FROM Novost WHERE ID=:brojID");
					$upit->bindParam(':brojID', $brojID);
					$upit->execute(); 
					break; 
				}		
			
				if (isset($_POST['promjenaNovost' . $id]))
				{
					if (!empty($_REQUEST['novosti' . $id]) && isset($_REQUEST['novosti' . $id]))
					{
							if ($_SERVER["REQUEST_METHOD"] == "POST") 
							  $n = input($_POST["novosti" . $id]);
							
							$brojID = $r['ID'];
							$upit = $veza->prepare("update Novost set tekst=:n WHERE id=:brojID");
							$upit->bindParam(':n', $n);
							$upit->bindParam(':brojID', $brojID);
							$upit->execute(); 
							$greska = "";
						break;
					}
					else
					{
						$greska = "Potrebno je unijeti text!";
					}
				}				
				
				$id++;
			}
?>
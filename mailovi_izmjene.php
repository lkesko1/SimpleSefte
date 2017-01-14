<?php
global $tabela;
 global $greska;
	 $greska = "";
			$id = 1;
			$veza = new PDO("mysql:dbname=simpleseftedb; host=mysql-55-centos7; charset=utf8", "wtuser", "sifra");
			$veza->exec("set names utf8");
			$rezultatMail = $veza->prepare("SELECT * FROM Mail order by id desc");
			$rezultatMail->execute();
			$rezultat=$rezultatMail->fetchAll();
			sizeof($rezultat);
			foreach ($rezultat as $r) {			
				if (isset($_POST['brisanjeMail' . $id]))
				{
					$brojID = $r['id'];
					$upit = $veza->prepare("delete FROM Mail WHERE id=:brojID");
					$upit->bindParam(':brojID', $brojID);
					$upit->execute(); 
					break; 
				}	
		
			
				if (isset($_POST['promjenaMail' . $id]))
				{
					$ime = $_REQUEST['ime' . $id];
					if (!empty($_REQUEST['ime' . $id]) && !empty($_REQUEST['mail' . $id]) && !empty($_REQUEST['subject' . $id]) && !empty($_REQUEST['mailtekst' . $id]) &&
						isset($_REQUEST['ime' . $id]) && isset($_REQUEST['mail' . $id]) && isset($_REQUEST['subject' . $id]) && isset($_REQUEST['mailtekst' . $id]))
					{
			
							if ($_SERVER["REQUEST_METHOD"] == "POST") {
							  $ime = input($_POST["ime". $id]);
							  $mail = input($_POST["mail". $id]);
							  $subject = input($_POST["subject". $id]);
							  $text = input($_POST["mailtekst". $id]);
							}
							
						if (preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/', $mail) && preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $ime))
						{
								$brojID = $r['ID'];
								$upit = $veza->prepare("update Mail set name=:n AND adresa=:a AND subject=:s AND tekst=:t WHERE id=:brojID");
								$upit->bindParam(':n', $ime);
								$upit->bindParam(':n', $mail);
								$upit->bindParam(':n', $ime);
								$upit->bindParam(':n', $ime);
								$upit->bindParam(':brojID', $brojID);
								$upit->execute(); 
						}
						else{
							$greska = "Nisu validni sljedeći podaci: "; 
							if (preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/', $mail) == false) $greska .= "email" ;
							if (preg_match('/^[A-Za-z]+\s[A-Za-z]+$/', $ime) == false) $greska .= " ime";
						}
						break;
					}
					else
					{
						$greska = "Sva polja su obavezna!";
					}
				}				
				
				$id++;
			}
		
?>
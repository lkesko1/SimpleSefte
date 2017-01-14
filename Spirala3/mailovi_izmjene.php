<?php
global $tabela;
 global $greska;
	 $greska = "";
		if (file_exists ("Mailovi.xml"))
		{
			$file = new simpleXMLElement("Mailovi.xml", null, true);

			$id = 1;
			foreach ($file->Mail as $r) {			
				if (isset($_POST['brisanjeMail' . $id]))
				{
					unset($file->Mail[$id-1]);
					$file->asXML("Mailovi.xml");
					break;
				}	
				//PROMJENA
				if (isset($_POST['promjenaMail' . $id]))
				{
					//VALIDACIJA ZA PROMJENU
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
								$r->Name = $ime;
								$r->Email = $mail;
								$r->Subject = $subject;
								$r->Text = $text;
								$file->asXML("Mailovi.xml");
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
			
			
		}
		
?>
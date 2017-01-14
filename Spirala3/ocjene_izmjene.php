<?php

global $tabela;
	global $dodajOcjenu;
		if (file_exists ("Ocjene.xml"))
		{
			$file = new simpleXMLElement("Ocjene.xml", null, true);
			$id = 1;
			foreach ($file->Ocjena as $r) {			
				if (isset($_POST['brisanjeOcjene' . $id]))
				{
					unset($file->Ocjena[$id-1]);
					$file->asXML("Ocjene.xml");
					break;
				}		
				//PROMJENA
				if (isset($_POST['promjenaOcjene' . $id]))
				{
				
					//VALIDACIJA ZA PROMJENU
					if (!empty($_REQUEST['ocjena' . $id]) && isset($_REQUEST['ocjena' . $id]))
					{
							if ($_SERVER["REQUEST_METHOD"] == "POST") 
							  $n = input($_POST["ocjena" . $id]);
							
							if ($n <= 5 && $n >= 1)
							{
								$file->Ocjena[$id-1] = $n;
								$file->asXML("Ocjene.xml");
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
		}
		
?>
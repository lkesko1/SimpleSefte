<?php
global $tabela;
	global $dodajNovost;
		if (file_exists ("Novosti.xml"))
		{
			$file = new simpleXMLElement("Novosti.xml", null, true);

			$id = 1;
			foreach ($file->Novost as $r) {			
				if (isset($_POST['brisanjeNovost' . $id]))
				{
					unset($file->Novost[$id-1]);
					$file->asXML("Novosti.xml");
					break;
				}		
				//PROMJENA
				if (isset($_POST['promjenaNovost' . $id]))
				{
				
					//VALIDACIJA ZA PROMJENU
					if (!empty($_REQUEST['novosti' . $id]) && isset($_REQUEST['novosti' . $id]))
					{
							if ($_SERVER["REQUEST_METHOD"] == "POST") 
							  $n = input($_POST["novosti" . $id]);
							
							
								$file->Novost[$id-1] = $n;
								$file->asXML("Novosti.xml");
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
			
		}
		
		if (isset($_POST['dodajNovost']))
		{
			
		
		}
?>
<?php

global $idevi;
$idevi ="";
$idevi = array();
	
	
if (file_exists('Mailovi.xml'))
{
	
	$fajl=new DOMDocument();
	$fajl->load('Mailovi.xml');
	$mailovi = $fajl->getElementsByTagName('Mail');
	$q = $_GET['q'];
	$string = "";

	$k = 0;
	
	if (strlen($q)>0) 
	{
		$broj = 0;
		$velicina = $mailovi->length;
		for ($i = 0; $i <$velicina; $i++)
		{
			$ime = $mailovi->item($i)->getElementsByTagName('Name');
			$mail = $mailovi->item($i)->getElementsByTagName('Email');
			if ($ime->item(0)->nodeType==1)
			{
				if (stristr($ime->item(0)->childNodes->item(0)->nodeValue, $q) || stristr($mail->item(0)->childNodes->item(0)->nodeValue, $q))
				{
					if ($string == "")
					{
						if (stristr($ime->item(0)->childNodes->item(0)->nodeValue, $q) && $broj < 10)
						{
							$string = $string . "<br/>" . $ime->item(0)->childNodes->item(0)->nodeValue . PHP_EOL;
							$broj++;
						}
						if (stristr($mail->item(0)->childNodes->item(0)->nodeValue, $q) && $broj < 10)
						{
							$string = $string . "<br/>" . $mail->item(0)->childNodes->item(0)->nodeValue . PHP_EOL;
							$broj++;
						}
					}
					else
					{
						if (stristr($ime->item(0)->childNodes->item(0)->nodeValue, $q) && $broj < 10)
						{
							$string = $string . "<br/>" . $ime->item(0)->childNodes->item(0)->nodeValue . PHP_EOL;
							$broj++;
						}
						if (stristr($mail->item(0)->childNodes->item(0)->nodeValue, $q) && $broj < 10) 
						{
							$string = $string . "<br/>" . $mail->item(0)->childNodes->item(0)->nodeValue . PHP_EOL;
							$broj++;
						}
					}
					$k++;
					array_push($idevi, $k);
				}
			}
		}
	}
	
	echo $string;
}
	?>

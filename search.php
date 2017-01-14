<?php

global $idevi;
$idevi ="";
$idevi = array();

try
		{
			//Povezivanje s bazom
				$veza = new PDO("mysql:dbname=simpleseftedb; host=mysql-55-centos7; charset=utf8", "wtuser", "sifra");
				$veza->exec("set names utf8");
			//Provjeri da li postoji ta tabela 
			if ($rezultat = $veza->query("SHOW TABLES LIKE 'Mail'")) {
					if(sizeof($rezultat) >0) {
						$rezultat = $veza->prepare("SELECT * FROM Mail");
						$rezultat->execute();
				
						
							$q = $_GET['q'];
							$string = "";

							$k = 0;
							
							if (strlen($q)>0) 
							{
								$broj = 0;
								foreach($rezultat->fetchAll() as $r)
								{
									$ime = $r['name'];
									$mail = $r['adresa'];
								//	if ($ime->item(0)->nodeType==1)
									//{
										if (stristr($ime, $q) || stristr($mail, $q))
										{
											if ($string == "")
											{
												if (stristr($ime, $q) && $broj < 10)
												{
													$string = $string . "<br/>" . $ime . PHP_EOL;
													$broj++;
												}
												if (stristr($mail, $q) && $broj < 10)
												{
													$string = $string . "<br/>" . $mail . PHP_EOL;
													$broj++;
												}
											}
											else
											{
												if (stristr($ime, $q) && $broj < 10)
												{
													$string = $string . "<br/>" . $ime . PHP_EOL;
													$broj++;
												}
												if (stristr($mail, $q) && $broj < 10) 
												{
													$string = $string . "<br/>" . $mail . PHP_EOL;
													$broj++;
												}
											}
											$k++;
											array_push($idevi, $k);
										}
									//}
								}
							}
							
							echo $string;
						
						
					}
			}
				
		}
		catch(PDOException $e)
		{
			$message ="Connection failed!" . $e->getMessage();
					echo "<script type='text/javascript'>
						alert('$message'); 
						location.href='index.php';
						</script>";
		}	
	
	?>

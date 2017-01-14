<?php 
try
{
	$veza = new PDO("mysql:dbname=simpleseftedb; host=localhost; charset=utf8", "wtuser", "sifra");
	$veza->exec("set names utf8");

//Provjera da li postoji tabela	
	if ($tabele = $veza->query("SHOW TABLES LIKE 'Mail'")) {
		if(sizeof($tabele) >0) {
			$rezultatR = $veza->prepare("SELECT * FROM Rezervacija order by id desc");
			$rezultatR->execute();
			$rezultat=$rezultatR->fetchAll();
			header('Content-Type: application/excel');
			header('Content-Disposition: attachment; filename="Rezervacije.csv"');
			$fajl = fopen('php://output', 'w');
			sizeof($rezultat);
			foreach ($rezultat as $r) {		
				$datumformat = date("Y-m-d", strtotime($r['datum']));			
				$string = array($r['name'], $r['phone'], $datumformat, $r['vrijeme'], $r['broj'], $r['tekst'],);
				fputcsv($fajl, $string);  
			}
			fclose($fajl);
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

<?php
require('./fpdf181/fpdf.php');
class IZVJESTAJ extends FPDF
{
    function Header()
    {
        $this->SetFont('Times', 'B', 18);
        $this->Cell(50, 20, 'Rezervacije', 0, 20);
		$this->SetFont('Times', 'B', 12);
		$this->Cell(41, 6, "Ime i prezime", 1,  0, 'C');
		$this->Cell(25, 6, 'Telefon', 1, 0, 'C');
		$this->Cell(22, 6, 'Datum', 1, 0, 'C');
		$this->Cell(15, 6, 'Vrijeme', 1, 0, 'C');
		$this->Cell(11, 6, 'Broj', 1);
		$this->Cell(70, 6, 'Napomena', 1);
		$this->Ln();
	}
}

$file = new IZVJESTAJ();
$file->AddPage();
$file->SetFont('Times','',12);
try
{
	$veza = new PDO("mysql:dbname=simpleseftedb; host=mysql-55-centos7; charset=utf8", "wtuser", "sifra");
	$veza->exec("set names utf8");

//Provjera da li postoji tabela	
	if ($tabele = $veza->query("SHOW TABLES LIKE 'Mail'")) {
		if(sizeof($tabele) >0) {
			$rezultatR = $veza->prepare("SELECT * FROM Rezervacija order by id desc");
			$rezultatR->execute();
			$rezultat=$rezultatR->fetchAll();
			sizeof($rezultat);
			foreach ($rezultat as $r) {	
				$datumformat = date("Y-m-d", strtotime($r['datum']));
				$file->Cell(41, 6, $r['name'], 1);
				$file->Cell(25, 6, $r['phone'], 1);
				$file->Cell(22, 6, $datumformat, 1, 0, 'C');
				$file->Cell(15, 6, $r['vrijeme'], 1, 0, 'C');
				$file->Cell(11, 6, $r['broj'], 1, 0, 'C');
				$file->Multicell(70, 6, $r['tekst'], 1);
				$file->Ln();
			}
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

$file->Output();

?>

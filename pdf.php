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
if (file_exists("Rezervacije.xml")){
$izvjestaj = new SimpleXMLElement("Rezervacije.xml",null,true);

// $file->Write(5, $string); 
foreach ($izvjestaj->Rezervacija as $r) {
	$file->Cell(41, 6, $r->Name, 1);
	$file->Cell(25, 6, $r->Phone_number, 1);
	$file->Cell(22, 6, $r->Date, 1, 0, 'C');
	$file->Cell(15, 6, $r->Time, 1, 0, 'C');
	$file->Cell(11, 6, $r->Broj, 1, 0, 'C');
	$file->Cell(70, 6, $r->Napomena, 1);
	$file->Ln();
//	$string = str_pad(, 30) . " " . str_pad($r->Phone_number, 15) ." " . str_pad(, 15) . " " . str_pad(, 15)
	//		. " " . str_pad($r->Broj, 15) . " " . str_pad($r->Napomena, 15) . PHP_EOL;
  //  $file->Write(5, $string); 
}
}
$file->Output();

?>

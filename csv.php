<?php 
if (file_exists("Rezervacije.xml")){
	
	$csv = new SimpleXMLElement("Rezervacije.xml",null,true);
	
	header('Content-Type: application/excel');
	header('Content-Disposition: attachment; filename="Rezervacije.csv"');
	$fajl = fopen('php://output', 'w');
	foreach ($csv->Rezervacija as $r) {
		$string = array($r->Name, $r->Phone_number, $r->Date, $r->Time, $r->Broj, $r->Napomena);
		fputcsv($fajl, $string);  
	}
	fclose($fajl);
}

?>

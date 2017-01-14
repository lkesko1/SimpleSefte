

<?php


function zaglavlje() {
	header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
	header('Content-Type: text/html');
	header('Access-Control-Allow-Origin: *');
}

function rest_get($request, $data, $vrsta) 
{
	try
	{
		$veza = new PDO("mysql:dbname=simpleseftedb; host=localhost; charset=utf8", "wtuser", "sifra");
		$veza->exec("set names utf8");
		if ($vrsta=='')
		{
			$rezultatStavka = $veza->prepare("SELECT * from Stavka");
			$rezultatStavka->execute();
		}	
		else
		{
			$rezultatVrsta = $veza->prepare("SELECT * from Vrsta where naziv=:v");
			$rezultatVrsta->bindParam(':v', $vrsta);
			$rezultatVrsta->execute();
			while($v = $rezultatVrsta->fetch(PDO::FETCH_ASSOC))
			{
				$idV = $v['id'];
				break;
			}
			$rezultatStavka = $veza->prepare("SELECT * from Stavka where id_vrste=:idV");
			$rezultatStavka->bindParam(':idV', $idV);
			$rezultatStavka->execute();	
		}
		
			$niz = array();
			while($s = $rezultatStavka->fetch(PDO::FETCH_ASSOC)){
				
				$idV =  $s['id_vrste'];
				$rezultatVrsta = $veza->prepare("SELECT naziv from Vrsta where id=:idV");
				$rezultatVrsta->bindParam(':idV', $idV);
				$rezultatVrsta->execute();
				$s['id_vrste'] = $rezultatVrsta->fetchAll(PDO::FETCH_OBJ);
				array_push($niz, $s);
			} 
			echo "{ 'cjenovnik': " . json_encode($niz) . "}";	
		
	}
	catch(PDOException $e)
	{
		$message ="Connection failed!" . $e->getMessage();
				echo "<script type='text/javascript'>
					alert('$message'); 
					location.href='index.php';
					</script>";
	}

}

function rest_post($request, $data) { }
function rest_delete($request) { }
function rest_put($request, $data) { }
function rest_error($request) { }

$method = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];

switch($method){
	case 'GET':
		zaglavlje(); 
		$data=$_GET; 
		$vrsta ='';
		if(isset($_GET['vrsta'])){
			$vrsta= $_GET['vrsta'];
		}
		rest_get($request, $data, $vrsta);
			
			
		break;
	default:
		header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
}


?>


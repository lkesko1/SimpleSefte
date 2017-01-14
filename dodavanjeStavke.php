<?php
	if (isset($_REQUEST['dodajStavku']))
	{
		if (isset($_REQUEST['nazivStavke']) && isset($_REQUEST['cijenaStavke']) && !empty($_REQUEST['nazivStavke']) && !empty($_REQUEST['cijenaStavke']) && isset($_REQUEST['vrstaStavkeID']) && !empty($_REQUEST['vrstaStavkeID']))
		{
			try{
			//spajanje na bazu
			$veza = new PDO("mysql:dbname=simpleseftedb; host=mysql-55-centos7; charset=utf8", "wtuser", "sifra");
			$veza->exec("set names utf8");
			$stavke=$veza->prepare("select id, naziv, cijena from stavka");
			$stavke->execute();
			$vrste = $veza->prepare("select id, naziv from vrsta");
			$vrste->execute();
			//Validacija
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			  $naziv = input($_POST["nazivStavke"]);
			  $cijena = input($_POST["cijenaStavke"]); 
			  $vrstaID = input($_POST["vrstaStavkeID"]);			  
			}
			if (preg_match('/^[A-Za-z][A-Za-z]+(\s[A-Za-z]*)*$/',  $naziv))
			{
				$flag = 0;
				//Provjera da li već postoji naziv za ovu stavku 
				foreach($stavke->fetchAll() as $s)
				{
					if ($s['naziv'] == $naziv)
						$flag = 1;
				}
				//Ako ne postoji unesi je u bazu
				if ($flag==0)
				{
					$unos = $veza->prepare("INSERT INTO stavka SET naziv=?,cijena=?, id_vrste=?");
					$unos->bindValue(1, $naziv, PDO::PARAM_INT);
					$unos->bindValue(2, $cijena, PDO::PARAM_INT);
					$unos->bindValue(3, $vrstaID, PDO::PARAM_INT);
					$unos->execute();
				}
				else
				{
					//Ako postoji obavijesti admina
					$message ="Ovaj naziv za stavku već postoji!";
					echo "<script type='text/javascript'>
						alert('$message'); 
						location.href='index.php';
						</script>";
				}
			}
			else 
			{
				//Nije zadovoljen regex
				$message ="Naziv mora imati barem 2 slova!";
				echo "<script type='text/javascript'>
					alert('$message'); 
					location.href='index.php';
					</script>";
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
		}
		else 
		{
		}
	}
	
	if (isset($_REQUEST['dodajDodatak']))
	{
		
		if (isset($_REQUEST['stavkaD']) && isset($_REQUEST['sastojakD']) && !empty($_REQUEST['stavkaD']) && !empty($_REQUEST['sastojakD']))
		{
			try{
			//spajanje na bazu
			$veza = new PDO("mysql:dbname=simpleseftedb; host=mysql-55-centos7; charset=utf8", "wtuser", "sifra");
			$veza->exec("set names utf8");
			$stavke=$veza->prepare("select id, naziv, cijena from stavka");
			$stavke->execute();
			$sastojaks = $veza->prepare("select id, naziv from sastojak");
			$sastojaks->execute();
					
			//Validacija
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			  $stavkaNaziv = ($_POST["stavkaD"]);
			  $sastojakNaziv = ($_POST["sastojakD"]); 			  
			}
			$stavkaID=0;
			$sastojakID=0;
			$rezultatSstavkaID= $veza->prepare("select * from stavka where naziv=?");
			$rezultatSstavkaID->bindValue(1, $stavkaNaziv, PDO::PARAM_INT);
			$rezultatSstavkaID->execute();
			
			
			foreach($rezultatSstavkaID->fetchAll() as $s)
			{
				$stavkaID = $s['id'];
				break;
			}
			$rezultatSasID= $veza->prepare("select * from sastojak where naziv=?");
			$rezultatSasID->bindValue(1, $sastojakNaziv, PDO::PARAM_INT);
			$rezultatSasID->execute();
			foreach($rezultatSasID->fetchAll() as $sas)
			{
				$sastojakID = $sas['id'];
				break;
			}

			$sastojci = $veza->prepare("select id_stavke, id_sastojka from sastojci where id_stavke=?");
			$sastojci->bindValue(1, $stavkaID, PDO::PARAM_INT);
			$sastojci->execute();
			
			$flag = 0;
			//Provjera da li već postoji taj dodatak za tu hranu
			foreach($sastojci->fetchAll() as $SS)
			{
				if ($SS['id_sastojka'] == $sastojakID)
					$flag = 1;
			}
			
			//Ako ne postoji unesi je u bazu
			if ($flag == 0)
			{
				$unos = $veza->prepare("INSERT INTO sastojci SET id_stavke=?,id_sastojka=?");
				$unos->bindValue(1, $stavkaID, PDO::PARAM_INT);
				$unos->bindValue(2, $sastojakID, PDO::PARAM_INT);
				$unos->execute();
			}
			else
			{
				//Ako postoji obavijesti admina
				$message ="Ovaj dodatak već postoji za izabrano jelo!";
				echo "<script type='text/javascript'>
					alert('$message'); 
					location.href='index.php';
					</script>";
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
		}
		else 
		{
			//Unos nije validan
		}
	}
	
	
	//DODAVANJE NOVOG SASTOJKA 
	if (isset($_REQUEST['dodajSastojak']))
	{
		if (isset($_REQUEST['nazivSastojka']) && !empty($_REQUEST['nazivSastojka']))
		{
			try{
			//spajanje na bazu
			$veza = new PDO("mysql:dbname=simpleseftedb; host=mysql-55-centos7; charset=utf8", "wtuser", "sifra");
			$veza->exec("set names utf8");
			$sastojci=$veza->prepare("select id, naziv from sastojak");
			$sastojci->execute();
				
			//Validacija
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			  $nazivS = input($_POST["nazivSastojka"]);		  
			}
			if (preg_match('/^[A-Za-z][A-Za-z]+(\s[A-Za-z]*)*$/', $nazivS) == true)
			{
				$flag = 0;
				//Provjera da li već postoji naziv za ovaj sastojak 
				foreach($sastojci->fetchAll() as $v)
				{
					if ($v['naziv'] == $nazivS)
						$flag = 1;
				}
				
				//Ako ne postoji unesi ga u bazu
				if ($flag == 0)
				{
					$unos = $veza->prepare("INSERT INTO sastojak SET naziv=?");
					$unos->bindValue(1, $nazivS, PDO::PARAM_INT);
					$unos->execute();
				}
				else
				{
					//Ako postoji obavijesti admina
					$message ="Ovaj naziv za dodatak već postoji!";
					echo "<script type='text/javascript'>
						alert('$message'); 
						location.href='index.php';
						</script>";
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
		}
		else 
		{
			//Unos nije validan
		}
	}
	
	//DODAVANJE NOVE VRSTE
	if (isset($_REQUEST['dodajVrstu']))
	{
		
		if (isset($_REQUEST['nazivVrste']) && !empty($_REQUEST['nazivVrste']))
		{
			
			try
			{
			//spajanje na bazu
			$veza = new PDO("mysql:dbname=simpleseftedb; host=mysql-55-centos7; charset=utf8", "wtuser", "sifra");
			$veza->exec("set names utf8");
			$vrste=$veza->prepare("select id, naziv from vrste");
			$vrste->execute();
				
			//Validacija
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
			  $nazivVrste = input($_POST["nazivVrste"]);		  
			}
			
			if (preg_match('/^[A-Za-z][A-Za-z]+(\s[A-Za-z]*)*$/',  $nazivVrste))
			{
				$flag = 0;
				//Provjera da li već postoji naziv za ovu vrstu 
				foreach($vrste->fetchAll() as $v)
				{
					if ($v['naziv'] == $nazivVrste)
						$flag = 1;
				}
				
				//Ako ne postoji unesi je u bazu
				if ($flag == 0)
				{
					$unos = $veza->prepare("INSERT INTO vrsta SET naziv=?");
					$unos->bindValue(1, $nazivVrste, PDO::PARAM_INT);
					$unos->execute();
				}
				else
				{
					//Ako postoji obavijesti admina
					$message ="Ovaj naziv za vrstu već postoji!";
					echo "<script type='text/javascript'>
						alert('$message'); 
						location.href='index.php';
						</script>";
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
		}
		else 
		{
			$message ="Unos nije validan!";
					echo "<script type='text/javascript'>
						alert('$message'); 
						location.href='index.php';
						</script>";
		}
	}
	
	
	if (isset($_REQUEST['brisanjeStavke']))
	{
		try{
			$veza = new PDO("mysql:dbname=simpleseftedb; host=mysql-55-centos7; charset=utf8", "wtuser", "sifra");
			$veza->exec("set names utf8");
			
			if (isset($_REQUEST['idStavkeBrisanje']))
			{
				$br = $_REQUEST['idStavkeBrisanje'];
				$upit = $veza->prepare("delete from stavka where id=?");
				$upit->bindValue(1, $br, PDO::PARAM_INT);
				$upit->execute();
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
	}
	
	if (isset($_REQUEST['brisanjeVeze']))
	{
		try{
			$veza = new PDO("mysql:dbname=simpleseftedb; host=mysql-55-centos7; charset=utf8", "wtuser", "sifra");
			$veza->exec("set names utf8");
			
			if (isset($_REQUEST['idVezeBrisanje']))
			{
				$br = $_REQUEST['idVezeBrisanje'];
				$upit = $veza->prepare("delete from sastojci where id=?");
				$upit->bindValue(1, $br, PDO::PARAM_INT);
				$upit->execute();
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
	}
	
	
	if (isset($_REQUEST['brisanjeSastojka']))
	{
		try{
			$veza = new PDO("mysql:dbname=simpleseftedb; host=mysql-55-centos7; charset=utf8", "wtuser", "sifra");
			$veza->exec("set names utf8");
			
			if (isset($_REQUEST['idSastojkaBrisanje']))
			{
				$br = $_REQUEST['idSastojkaBrisanje'];
				$upit = $veza->prepare("delete from sastojak where id=?");
				$upit->bindValue(1, $br, PDO::PARAM_INT);
				$upit->execute();
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
	}
	
	
	if (isset($_REQUEST['brisanjeVrste']))
	{
		try{
			$veza = new PDO("mysql:dbname=simpleseftedb; host=mysql-55-centos7; charset=utf8", "wtuser", "sifra");
			$veza->exec("set names utf8");
			
			if (isset($_REQUEST['idVrsteBrisanje']))
			{
				$br = $_REQUEST['idVrsteBrisanje'];
				$upit = $veza->prepare("delete from Vrsta where id=?");
				$upit->bindValue(1, $br, PDO::PARAM_INT);
				$upit->execute();
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
	}
	
	function input($unos) {
	  $unos = trim($unos); // da se \n ne interpretira kao novi red i slicno
	  $unos = stripslashes($unos); // ukidanje backslasha
	  $unos = htmlspecialchars($unos); // zamjena < sa &lt i slicno
	  return $unos;
	}
?>